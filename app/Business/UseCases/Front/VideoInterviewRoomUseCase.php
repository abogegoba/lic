<?php

namespace App\Business\UseCases\Front;


use App\Business\Interfaces\Gateways\Criteria\GeneralCriteria;
use App\Business\Interfaces\Gateways\Expression\Builders\GeneralExpressionBuilder;
use App\Business\Interfaces\Gateways\Repositories\InterviewAppointmentRepository;
use App\Business\Interfaces\Gateways\Repositories\UserAccountRepository;
use App\Business\Interfaces\Gateways\Repositories\VideoCallHistoryRepository;
use App\Business\Interfaces\Interactors\Client\VideoInterviewRoom\VideoInterviewRoomEndInputPort;
use App\Business\Interfaces\Interactors\Client\VideoInterviewRoom\VideoInterviewRoomEndInteractor;
use App\Business\Interfaces\Interactors\Client\VideoInterviewRoom\VideoInterviewRoomEndOutputPort;
use App\Business\Interfaces\Interactors\Client\VideoInterviewRoom\VideoInterviewRoomStartInputPort;
use App\Business\Interfaces\Interactors\Client\VideoInterviewRoom\VideoInterviewRoomStartInteractor;
use App\Business\Interfaces\Interactors\Client\VideoInterviewRoom\VideoInterviewRoomStartOutputPort;
use App\Business\Interfaces\Interactors\Front\VideoInterviewRoom\VideoInterviewRoomInitializeInputPort;
use App\Business\Interfaces\Interactors\Front\VideoInterviewRoom\VideoInterviewRoomInitializeInteractor;
use App\Business\Interfaces\Interactors\Front\VideoInterviewRoom\VideoInterviewRoomInitializeOutputPort;
use App\Domain\Entities\InterViewAppointment;
use App\Domain\Entities\UserAccount;
use App\Domain\Entities\VideoCallHistory;
use App\Domain\Model\MemberAuthentication;
use App\Utilities\Log;
use Carbon\Carbon;
use ReLab\Commons\Exceptions\FatalBusinessException;
use ReLab\Commons\Exceptions\ObjectNotFoundException;
use ReLab\Commons\Wrappers\CriteriaFactory;
use ReLab\Commons\Wrappers\Transaction;

/**
 * Class VideoInterviewRoomUseCase
 *
 * @package App\Business\UseCases\Front
 */
class VideoInterviewRoomUseCase implements VideoInterviewRoomInitializeInteractor, VideoInterviewRoomStartInteractor, VideoInterviewRoomEndInteractor
{
    /**_
     * @var UserAccountRepository
     */
    private $userAccountRepository;

    /**
     * @var InterviewAppointmentRepository
     */
    private $interviewAppointmentRepository;

    /**
     * @var VideoCallHistoryRepository
     */
    private $videoCallHistoryRepository;

    /**
     * VideoInterviewRoomUseCase constructor.
     *
     * @param UserAccountRepository $userAccountRepository
     * @param InterviewAppointmentRepository $interviewAppointmentRepository
     * @param VideoCallHistoryRepository $videoCallHistoryRepository
     */
    public function __construct(UserAccountRepository $userAccountRepository,
                                InterviewAppointmentRepository $interviewAppointmentRepository,
                                VideoCallHistoryRepository $videoCallHistoryRepository)
    {
        $this->userAccountRepository = $userAccountRepository;
        $this->interviewAppointmentRepository = $interviewAppointmentRepository;
        $this->videoCallHistoryRepository = $videoCallHistoryRepository;
    }

    /**
     * ????????????
     *
     * @param VideoInterviewRoomInitializeInputPort $inputPort
     * @param VideoInterviewRoomInitializeOutputPort $outputPort
     * @throws FatalBusinessException
     */
    public function initialize(VideoInterviewRoomInitializeInputPort $inputPort, VideoInterviewRoomInitializeOutputPort $outputPort): void
    {
        //????????????
        Log::infoIn();

        $interviewAppointment = $this->findInterviewAppointmentById($inputPort->interviewAppointmentId);
        $outputPort->companyPeerId = $interviewAppointment->getCompanyPeerId();
        $outputPort->memberPeerId = $interviewAppointment->getMemberPeerId();

        //????????????
        Log::infoOut();
    }

    /**
     * ????????????????????????
     *
     * @param VideoInterviewRoomStartInputPort $inputPort
     * @param VideoInterviewRoomStartOutputPort $outputPort
     * @throws FatalBusinessException
     */
    public function startVideo(VideoInterviewRoomStartInputPort $inputPort, VideoInterviewRoomStartOutputPort $outputPort): void
    {
        //????????????
        Log::infoIn();

        // ????????????????????????????????????
        $interviewAppointment = $this->findInterviewAppointmentById($inputPort->interviewAppointmentId);
        $memberAuthentication = MemberAuthentication::loadSession();
        $memberUserAccount = $this->userAccountRepository->findOneByCriteria(
            CriteriaFactory::getInstance()->create(GeneralCriteria::class, GeneralExpressionBuilder::class,
                [
                    "id" => $memberAuthentication->getUserAccountId()
                ]
            )
        );
        $videoCallHistory = new VideoCallHistory();
        $videoCallHistory->setMemberUserAccount($memberUserAccount);
        $videoCallHistory->setCompanyUserAccount($interviewAppointment->getCompanyUserAccount());

        // ?????????????????????????????????????????????????????????
        $videoCallHistory->setStartDatetime(Transaction::getInstance()->getDateTime());
        $this->videoCallHistoryRepository->saveOrUpdate($videoCallHistory, true);

        // ???????????????????????????
        $outputPort->videoCallHistoryId = $videoCallHistory->getId();

        //????????????
        Log::infoOut();
    }

    /**
     * ????????????????????????
     *
     * @param VideoInterviewRoomEndInputPort $inputPort
     * @param VideoInterviewRoomEndOutputPort $outputPort
     * @throws FatalBusinessException
     */
    public function endVideo(VideoInterviewRoomEndInputPort $inputPort, VideoInterviewRoomEndOutputPort $outputPort): void
    {
        //????????????
        Log::infoIn();

        // ????????????????????????????????????
        try {
            $memberAuthentication = MemberAuthentication::loadSession();
            $interviewAppointment = $this->findInterviewAppointmentById($inputPort->interviewAppointmentId, true);
            $videoCallHistory = $this->videoCallHistoryRepository->findOneByCriteria(
                CriteriaFactory::getInstance()->create(GeneralCriteria::class, GeneralExpressionBuilder::class,
                    [
                        "id" => $inputPort->videoCallHistoryId,
                        "memberUserAccount.id" => $memberAuthentication->getUserAccountId()
                    ],
                    [
                        "forUpdate" => true
                    ]
                )
            );
        } catch (ObjectNotFoundException $e) {
            throw new FatalBusinessException("select_target_not_found");
        }
        // ??????????????????????????????????????????update??????
        $interviewAppointment->setStatus(InterviewAppointment::STATUS_CLOSE);
        $this->interviewAppointmentRepository->saveOrUpdate($interviewAppointment, true);

        // ????????????????????????????????????????????????????????????
        $videoCallHistory->setCallMinutes($videoCallHistory->getStartDatetime()->diffInMinutes(Transaction::getInstance()->getDateTime()));
        $this->videoCallHistoryRepository->saveOrUpdate($videoCallHistory, true);

        // ???????????????????????????
        $outputPort->callMinutes = $videoCallHistory->getCallMinutes();

        //????????????
        Log::infoOut();
    }

    /**
     * ???????????????????????????
     *
     * @param int $interviewAppointmentId
     * @param int $forUpdate
     * @return InterviewAppointment
     * @throws FatalBusinessException
     */
    private function findInterviewAppointmentById(int $interviewAppointmentId, bool $forUpdate = false): InterViewAppointment
    {
        $interviewAppointment = null;
        try {
            $memberAuthentication = MemberAuthentication::loadSession();
            $interviewAppointment = $this->interviewAppointmentRepository->findOneByCriteria(
                CriteriaFactory::getInstance()->create(GeneralCriteria::class, GeneralExpressionBuilder::class,
                    [
                        "id" => $interviewAppointmentId,
                        "memberUserAccount.id" => $memberAuthentication->getUserAccountId()
                    ],
                    [
                        "forUpdate" => $forUpdate
                    ]
                )
            );
        } catch (ObjectNotFoundException $e) {
            throw new FatalBusinessException("select_target_not_found");
        }
        return $interviewAppointment;
    }
}