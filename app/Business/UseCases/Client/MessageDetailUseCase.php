<?php

namespace App\Business\UseCases\Client;

use App\Adapters\Gateways\Criteria\MessageDetailSearchDoctrineCriteria;
use App\Business\Interfaces\Gateways\Criteria\MessageSearchCriteria;
use App\Business\Interfaces\Gateways\Expression\Builders\GeneralExpressionBuilder;
use App\Business\Interfaces\Gateways\Expression\Builders\MessageSearchExpressionBuilder;
use App\Business\Interfaces\Gateways\Expression\Builders\MessageDetailSearchExpressionBuilder;
use App\Business\Interfaces\Gateways\Repositories\CompanyAccountRepository;
use App\Business\Interfaces\Gateways\Repositories\CompanyRepository;
use App\Business\Interfaces\Gateways\Repositories\MemberRepository;
use App\Business\Interfaces\Gateways\Repositories\MessageRepository;
use App\Business\Interfaces\Gateways\Repositories\ModelSentenceRepository;
use App\Business\Interfaces\Gateways\Repositories\UserAccountRepository;
use App\Business\Interfaces\Interactors\Client\MessageDetail\MessageDetailInitializeInputPort;
use App\Business\Interfaces\Interactors\Client\MessageDetail\MessageDetailInitializeInteractor;
use App\Business\Interfaces\Interactors\Client\MessageDetail\MessageDetailInitializeOutputPort;
use App\Business\Interfaces\Interactors\Client\MessageDetail\MessageDetailSendInputPort;
use App\Business\Interfaces\Interactors\Client\MessageDetail\MessageDetailSendInteractor;
use App\Business\Interfaces\Interactors\Client\MessageDetail\MessageDetailSendOutputPort;
use App\Business\Services\UseLoggedInCompanyAccountTrait;
use App\Domain\Entities\Message;
use App\Domain\Entities\ModelSentence;
use App\Domain\Entities\UserAccount;
use App\Utilities\Log;
use Pusher\Pusher;
use ReLab\Commons\Exceptions\FatalBusinessException;
use ReLab\Commons\Exceptions\ObjectNotFoundException;
use ReLab\Commons\Wrappers\CriteriaFactory;
use ReLab\Commons\Wrappers\Data;
use ReLab\Commons\Wrappers\Mail;
use ReLab\Commons\Wrappers\Transaction;
use ReLab\Doctrine\Criteria\GeneralDoctrineCriteria;

/**
 * Class MessageDetailUseCase
 *
 * @package App\Business\UseCases\Client
 */
class MessageDetailUseCase implements MessageDetailInitializeInteractor, MessageDetailSendInteractor
{
    use UseLoggedInCompanyAccountTrait;

    /**
     * @var UserAccountRepository
     */
    private $userAccountRepository;

    /**
     * @var MessageRepository
     */
    private $messageRepository;

    /**
     * @var CompanyAccountRepository
     */
    private $companyAccountRepository;

    /**
     * @var ModelSentenceRepository
     */
    private $modelSentenceRepository;

    /**
     * MessageDetailUseCase constructor.
     * @param UserAccountRepository $userAccountRepository
     * @param MessageRepository $messageRepository
     * @param CompanyAccountRepository $companyAccountRepository
     * @param ModelSentenceRepository $modelSentenceRepository
     */
    public function __construct(
        UserAccountRepository $userAccountRepository,
        MessageRepository $messageRepository,
        CompanyAccountRepository $companyAccountRepository,
        ModelSentenceRepository $modelSentenceRepository)
    {
        $this->userAccountRepository = $userAccountRepository;
        $this->messageRepository = $messageRepository;
        $this->companyAccountRepository = $companyAccountRepository;
        $this->modelSentenceRepository = $modelSentenceRepository;
    }

    /**
     * ????????????
     *
     * @param MessageDetailInitializeInputPort $inputPort
     * @param MessageDetailInitializeOutputPort $outputPort
     * @throws FatalBusinessException
     */
    public function initialize(MessageDetailInitializeInputPort $inputPort, MessageDetailInitializeOutputPort $outputPort): void
    {
        //????????????
        Log::infoIn();

        $companyAccount = $this->getLoggedInCompanyAccount($inputPort);

        $loggedInUserAccount = $companyAccount->getUserAccount();
        $loggedInUserAccountId = $loggedInUserAccount->getId();
        $outputPort->loggedInUserAccountId = $loggedInUserAccountId;

        $criteriaFactory = CriteriaFactory::getInstance();
        $messages = $this->messageRepository->findByCriteria(
            $criteriaFactory->create(MessageSearchCriteria::class, MessageSearchExpressionBuilder::class,
                [
                    "exchangeUserAccountId" => $loggedInUserAccountId
                ]
            )
        );
        $exchangeUserAccountInformationList = [];
        if (!empty($messages)) {
            // ?????????????????????????????????????????????????????????????????????????????????????????????????????? or ???????????????????????????????????????????????????
            foreach ($messages as $message) {
                $exchangeSendingUserAccount = $message->getSendingUserAccount();
                $exchangeSendingUserAccountId = $exchangeSendingUserAccount->getId();
                $exchangeReceivingUserAccount = $message->getReceivingUserAccount();
                $exchangeReceivingUserAccountId = $exchangeReceivingUserAccount->getId();
                if (
                    $exchangeSendingUserAccountId !== $loggedInUserAccountId
                    && !array_key_exists($exchangeSendingUserAccountId, $exchangeUserAccountInformationList)
                ) {
                    // ??????????????????????????????????????????????????????
                    $exchangeUserAccountInformationList[$exchangeSendingUserAccountId] = $this->setMessageInformationForList($exchangeSendingUserAccount, $exchangeSendingUserAccountId, $message);
                    // ?????????????????????????????????????????????????????????????????????????????????????????????
                    $exchangeUserAccountInformationList[$exchangeSendingUserAccountId]["unreadCount"] = $message->getAlreadyRead() ? 0 : 1;
                } elseif (
                    $exchangeReceivingUserAccountId !== $loggedInUserAccountId
                    && $exchangeReceivingUserAccount->isMember() === true
                    && !array_key_exists($exchangeReceivingUserAccountId, $exchangeUserAccountInformationList)
                ) {
                    $exchangeUserAccountInformationList[$exchangeReceivingUserAccountId] = $this->setMessageInformationForList($exchangeReceivingUserAccount, $exchangeReceivingUserAccountId, $message);
                    $exchangeUserAccountInformationList[$exchangeReceivingUserAccountId]["latestMessageSendingUserAccountId"] = $exchangeSendingUserAccountId;
                } elseif (
                    array_key_exists($exchangeSendingUserAccountId, $exchangeUserAccountInformationList)
                    && !$message->getAlreadyRead()
                ) {
                    $exchangeUserAccountInformationList[$exchangeSendingUserAccountId]["unreadCount"]++;
                } else {
                    // Do Nothing.
                }
            }
            $outputPort->exchangeUserAccountInformationList = $exchangeUserAccountInformationList;
        }

        $memberUserAccountId = $inputPort->memberUserAccountId;

        if (!$memberUserAccountId) {
            Log::infoOut();
            return;
        }

        try {
            // ??????????????????????????????????????????
            $memberUserAccount = $this->userAccountRepository->findOneByCriteria(
                CriteriaFactory::getInstance()->create(GeneralDoctrineCriteria::class, GeneralExpressionBuilder::class,
                    [
                        "id" => $memberUserAccountId
                    ]
                )
            );
        } catch (ObjectNotFoundException $e) {
            throw new FatalBusinessException("data_not_found");
        }
        $member = $memberUserAccount->getMember();

        // ??????????????????????????????
        $privateImage = $member->getPrivatePhotoFilePathForClientShow();
        $outputPort->privateImage = $privateImage;

        //??????????????????
        $idImage = $member->getIdPhotoFilePathForClientShow();
        $outputPort->idImage = $idImage;

        // ???????????????
        $memberLastName = $member->getLastName();
        $memberFirstName = $member->getFirstName();
        $memberName = "$memberLastName $memberFirstName";
        $outputPort->memberName = $memberName;

        $criteriaFactory = CriteriaFactory::getInstance();
        $messages = $this->messageRepository->findByCriteria(
            $criteriaFactory->create(MessageDetailSearchDoctrineCriteria::class, MessageDetailSearchExpressionBuilder::class,
                [
                    "opponentUserAccountId" => $memberUserAccountId,
                    "oneselfUserAccountId" => $loggedInUserAccountId
                ]
            )
        );
        $exchangeMessageList = [];
        foreach ($messages as $message) {
            $receivingUserAccountId = $message->getReceivingUserAccount()->getId();
            $sendingUserAccountId = $message->getSendingUserAccount()->getId();
            if ($sendingUserAccountId === $memberUserAccountId && $receivingUserAccountId === $loggedInUserAccountId) {
                // ???????????????????????????????????????????????????????????????????????????????????????
                // ?????????????????????
                $alreadyRead = $message->getAlreadyRead();
                if ($alreadyRead === false) {
                    $message->setAlreadyRead(true);
                    $this->messageRepository->saveOrUpdate($message, true);
                }
                $exchangeMessageList[] = $this->setMessageInformationForDetail($memberUserAccountId, $idImage, $message);
            } elseif ($sendingUserAccountId === $loggedInUserAccountId && $receivingUserAccountId === $memberUserAccountId) {
                // ?????????????????????????????????
                $exchangeMessageList[] = $this->setMessageInformationForDetail($loggedInUserAccountId, null, $message);
            }
        }
        $outputPort->exchangeMessageList = $exchangeMessageList;

        $outputPort->memberUserAccountId = $memberUserAccountId;

        $outputPort->messageSendToName = $member->getLastName().' '.$member->getFirstName();

        // ????????????URL
        $outputPort->studentDetailUrl = route("client.student.detail", ["userAccountId" => $memberUserAccountId]);

        // ????????????????????????URL
        $outputPort->videoInterviewCancelUrl = route("client.video-interview.reservation-detail", ["userAccountId" => $memberUserAccountId]);
        // ????????????????????????URL
        $outputPort->videoInterviewEntryUrl = route("client.video-interview.entry", ["userAccountId" => $memberUserAccountId]);


        $modelSentences = $this->modelSentenceRepository->findByCriteria(
            $criteriaFactory->create(GeneralDoctrineCriteria::class, GeneralExpressionBuilder::class,
                [
                    "modelSentenceType" => ModelSentence::FOR_CLIENT
                ]
            )
        );
        $modelSentenceNameList = [];
        $modelSentenceContentList = [];
        foreach ($modelSentences as $modelSentence){
            $modelSentenceNameList[] = $modelSentence->getName();
            $modelSentenceContentList[] = $modelSentence->getContent();
        }
        $outputPort->modelSentenceNameList = ['' => "????????????????????????"]+$modelSentenceNameList;
        $outputPort->modelSentenceContentList = ['' => ""]+$modelSentenceContentList;

        //????????????
        Log::infoOut();
    }

    /**
     * ??????????????????????????????
     *
     * @param MessageDetailSendInputPort $inputPort
     * @param MessageDetailSendOutputPort $outputPort
     * @throws FatalBusinessException
     */
    public function sendMessage(MessageDetailSendInputPort $inputPort, MessageDetailSendOutputPort $outputPort): void
    {
        //????????????
        Log::infoIn();

        $companyAccount = $this->getLoggedInCompanyAccount($inputPort);

        $loggedInUserAccount = $companyAccount->getUserAccount();
        $loggedInUserAccountId = $loggedInUserAccount->getId();
        $outputPort->loggedInUserAccountId = $loggedInUserAccountId;

        $memberUserAccountId = $inputPort->memberUserAccountId;

        try {
            $memberUserAccount = $this->userAccountRepository->findOneByCriteria(
                CriteriaFactory::getInstance()->create(GeneralDoctrineCriteria::class, GeneralExpressionBuilder::class,
                    [
                        "id" => $memberUserAccountId
                    ]
                )
            );
        } catch (ObjectNotFoundException $e) {
            throw new FatalBusinessException("data_not_found");
        }

        $companyFile = $loggedInUserAccount->getCompanyAccount()->getCompany()->getCompanyLogoImage()->getFilePathForFrontShow();

        $sendTime = Transaction::getInstance()->getDateTime();

        $message = new Message();
        $message->setSendingUserAccount($loggedInUserAccount);
        $message->setContent($inputPort->messageToSend);
        $message->setContributionDatetime($sendTime);
        $message->setAlreadyRead(false);
        $message->setStatus(Message::STATUS_DISPLAY);
        $message->setReceivingUserAccount($memberUserAccount);

        // ????????????
        $this->messageRepository->saveOrUpdate($message, true);

        // ??????????????????????????????????????????
        $template = "mail.front.client.message_send_mail";
        $mailAddress = $memberUserAccount->getMailAddress();
        $companyName = $loggedInUserAccount->getCompanyAccount()->getCompany()->getName();
        $companyAccountLastName = $loggedInUserAccount->getCompanyAccount()->getLastName();
        $companyAccountFirstName = $loggedInUserAccount->getCompanyAccount()->getFirstName();
        $sendUserName = $companyAccountLastName . " " . $companyAccountFirstName;
        $memberLastName = $memberUserAccount->getMember()->getLastName();
        $memberFirstName = $memberUserAccount->getMember()->getFirstName();
        $memberName = $memberLastName . " " . $memberFirstName;
        $title = "???LinkT???" . $companyName ." " .$sendUserName." ?????????????????????????????????????????????";
        $dataList["content"] = $inputPort->messageToSend;
        $dataList["sendUserName"] = $sendUserName;
        $dataList["sendTime"] = $sendTime->format("Y/n/j H:i:s");
        $dataList["companyName"] = $companyName;
        $dataList["memberName"] = $memberName;
        $dataList["frontLoginURL"] = env('FRONT_LOGIN_URL');
        $data = Data::wrap($dataList);

        $mail = Mail::getInstance($template, $mailAddress, trans($title), $data);
        $mailResult = $mail->send();

        if ($mailResult !== true) {
            throw new FatalBusinessException("not_send_mail");
        }

        // ????????????
        Log::infoOperationCreateLog("", ["message" => (array)$message], "");

        //pusher
        $options = [
            'cluster' => 'ap3',
            'useTLS' => true
        ];

        $pusher = new Pusher(
            env('PUSHER_APP_KEY'),
            env('PUSHER_APP_SECRET'),
            env('PUSHER_APP_ID'),
            $options
        );

        $data = [
            'from' => $loggedInUserAccountId,
            'to' => $memberUserAccountId,
            'notification_type' => 'message',
            'name' => $companyName,
            'company_logo' => $companyFile,
            'sending_date' => date('Y-m-d H:i:s')
        ];

        $pusher->trigger('my-front-channel','my-front-event',$data);

        $outputPort->memberUserAccountId = $memberUserAccountId;

        //????????????
        Log::infoOut();
    }
    /**
     * ??????????????????????????????????????????
     *
     * @param UserAccount $userAccount
     * @param $userAccountId
     * @param Message $message
     * @return array
     */
    private function setMessageInformationForList(UserAccount $userAccount, int $userAccountId, Message $message)
    {
        return [
            'messageDetailUrl' => route("client.message.detail", ["userAccountId" => $userAccountId]),
            'idImage' => $this->getIdImageFilePath($userAccount),
            'memberName' => $userAccount->getMember()->getLastName().' '. $userAccount->getMember()->getFirstName(),
            'content' => $message->getContent(),
            'contributionDatetime' => $message->getContributionDatetime()->format('Y/n/j H:i:s'),
            'alreadyRead' => $message->getAlreadyRead()
        ];
    }

    /**
     * ???????????????????????????????????????
     *
     * @param int $uerAccountId
     * @param null|string $idImage
     * @param Message $message
     * @return array
     */
    private function setMessageInformationForDetail(int $uerAccountId, ?string $idImage, Message $message)
    {
        return [
            'sendingUserAccountId' => $uerAccountId,
            'idImage' => $idImage,
            'content' => $message->getContent(),
            'contributionDatetime' => $message->getContributionDatetime()->format('Y/n/j H:i:s'),
            'alreadyRead' => true,
            'status' => $message->getStatus(),
            'id' => $message->getId(),
        ];
    }

    /**
     * ??????????????????????????????????????????
     *
     * @param UserAccount $userAccount
     * @return string|null
     */
    private function getIdImageFilePath(UserAccount $userAccount)
    {
        if ($userAccount->isMember() === true) {
            $IdImageFilePath = $userAccount->getMember()->getIdPhotoFilePathForClientShow();
        } else {
            return null;
        }
        return $IdImageFilePath;
    }
}
