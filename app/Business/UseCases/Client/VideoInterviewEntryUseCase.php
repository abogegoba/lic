<?php

namespace App\Business\UseCases\Client;

use App\Business\Interfaces\Gateways\Criteria\GeneralCriteria;
use App\Business\Interfaces\Gateways\Expression\Builders\GeneralExpressionBuilder;
use App\Business\Interfaces\Gateways\Repositories\CompanyAccountRepository;
use App\Business\Interfaces\Gateways\Repositories\InterviewAppointmentRepository;
use App\Business\Interfaces\Gateways\Repositories\MemberRepository;
use App\Business\Interfaces\Interactors\Client\VideoInterviewEntry\VideoInterviewEntryConfirmInitializeInteractor;
use App\Business\Interfaces\Interactors\Client\VideoInterviewEntry\VideoInterviewEntryConfirmInitializeInputPort;
use App\Business\Interfaces\Interactors\Client\VideoInterviewEntry\VideoInterviewEntryConfirmInitializeOutputPort;
use App\Business\Interfaces\Interactors\Client\VideoInterviewEntry\VideoInterviewEntryExecuteInputPort;
use App\Business\Interfaces\Interactors\Client\VideoInterviewEntry\VideoInterviewEntryExecuteInteractor;
use App\Business\Interfaces\Interactors\Client\VideoInterviewEntry\VideoInterviewEntryExecuteOutputPort;
use App\Business\Interfaces\Interactors\Client\VideoInterviewEntry\VideoInterviewEntryInitializeInputPort;
use App\Business\Interfaces\Interactors\Client\VideoInterviewEntry\VideoInterviewEntryInitializeInteractor;
use App\Business\Interfaces\Interactors\Client\VideoInterviewEntry\VideoInterviewEntryInitializeOutputPort;
use App\Business\Interfaces\Interactors\Client\VideoInterviewEntry\VideoInterviewEntryToConfirmInputPort;
use App\Business\Interfaces\Interactors\Client\VideoInterviewEntry\VideoInterviewEntryToConfirmInteractor;
use App\Business\Interfaces\Interactors\Client\VideoInterviewEntry\VideoInterviewEntryToConfirmOutputPort;
use App\Business\Services\UseLoggedInCompanyAccountTrait;
use App\Domain\Entities\InterViewAppointment;
use App\Domain\Entities\Member;
use App\Domain\Entities\Tag;
use App\Utilities\Log;
use Carbon\Carbon;
use ReLab\Commons\Exceptions\FatalBusinessException;
use ReLab\Commons\Exceptions\ObjectNotFoundException;
use ReLab\Commons\Utilities\UUID;
use ReLab\Commons\Wrappers\CriteriaFactory;
use ReLab\Commons\Wrappers\Data;
use ReLab\Commons\Wrappers\Mail;

/**
 * Class VideoInterviewEntryUseCase
 *
 * @package App\Business\UseCases\Client
 */
class VideoInterviewEntryUseCase implements VideoInterviewEntryInitializeInteractor, VideoInterviewEntryToConfirmInteractor, VideoInterviewEntryConfirmInitializeInteractor, VideoInterviewEntryExecuteInteractor
{
    use UseLoggedInCompanyAccountTrait;

    /**
     * @var MemberRepository
     */
    private $memberRepository;

    /**
     * @var InterviewAppointmentRepository
     */
    private $interviewAppointmentRepository;

    /**
     * @var
     */
    private $companyAccountRepository;

    /**
     * VideoInterviewReservationDetailUseCase constructor.
     *
     * @param MemberRepository $memberRepository
     * @param InterviewAppointmentRepository $interviewAppointmentRepository
     * @param CompanyAccountRepository $companyAccountRepository
     */
    public function __construct(
        MemberRepository $memberRepository,
        InterviewAppointmentRepository $interviewAppointmentRepository,
        CompanyAccountRepository $companyAccountRepository
    ) {
        $this->memberRepository = $memberRepository;
        $this->interviewAppointmentRepository = $interviewAppointmentRepository;
        $this->companyAccountRepository = $companyAccountRepository;
    }

    /**
     * ????????????
     *
     * @param VideoInterviewEntryInitializeInputPort $inputPort
     * @param VideoInterviewEntryInitializeOutputPort $outputPort
     * @throws FatalBusinessException
     */
    public function initialize(VideoInterviewEntryInitializeInputPort $inputPort, VideoInterviewEntryInitializeOutputPort $outputPort): void
    {
        //????????????
        Log::infoIn();

        $memberUserAccountId = $inputPort->memberUserAccountId;
        $member = $this->getMember($memberUserAccountId);

        // ?????????
        $memberLastName = $member->getLastName();
        $memberFirstName = $member->getFirstName();
        $outputPort->memberName = "$memberLastName $memberFirstName";

        // ????????????????????????
        $privateImage = $member->getPrivatePhotoFilePathForClientShow();
        $outputPort->privateImage = $privateImage;

        //????????????
        $idImage = $member->getIdPhotoFilePathForClientShow();
        $outputPort->idImage = $idImage;

        // ????????????
        $schoolName = $member->getOldSchool()->getName();
        $departmentName = $member->getOldSchool()->getDepartmentName();
        $birthday = $member->getBirthday()->format("Ymd");
        $age = $this->setAge($birthday);
        $graduationPeriod = $member->getOldSchool()->getGraduationPeriod()->format("Y");
        $outputPort->schoolName = $schoolName;
        $outputPort->departmentName = $departmentName;
        $outputPort->age = $age;
        $outputPort->graduationPeriod = $graduationPeriod;

        // ??????????????????
        $hashTag = $member->getHashTag();
        if (isset($hashTag)) {
            $hashTagName = $hashTag->getName();
            $hashTagColor = Tag::TAG_COLLAR_CLASS_LIST[$hashTag->getColor()];
            $outputPort->hashTagName = $hashTagName;
            $outputPort->hashTagColor = $hashTagColor;
        }

        $outputPort->memberUserAccountId = $memberUserAccountId;

        $outputPort->messageDetailUrl = route("client.message.detail", ["userAccountId" => $memberUserAccountId]);

        //????????????
        Log::infoOut();
    }

    /**
     * ??????????????????
     *
     * @param VideoInterviewEntryToConfirmInputPort $inputPort
     * @param VideoInterviewEntryToConfirmOutputPort $outputPort
     */
    public function toConfirm(VideoInterviewEntryToConfirmInputPort $inputPort, VideoInterviewEntryToConfirmOutputPort $outputPort): void
    {
        //????????????
        Log::infoIn();

        $memberUserAccountId = $inputPort->memberUserAccountId;

        $outputPort->memberUserAccountId = $memberUserAccountId;

        //????????????
        Log::infoOut();
    }

    /**
     * ??????????????????
     *
     * @param VideoInterviewEntryConfirmInitializeInputPort $inputPort
     * @param VideoInterviewEntryConfirmInitializeOutputPort $outputPort
     * @throws FatalBusinessException
     */
    public function confirmInitialize(VideoInterviewEntryConfirmInitializeInputPort $inputPort, VideoInterviewEntryConfirmInitializeOutputPort $outputPort): void
    {
        //????????????
        Log::infoIn();

        $memberUserAccountId = $inputPort->memberUserAccountId;
        $member = $this->getMember($memberUserAccountId);

        // ?????????
        $memberLastName = $member->getLastName();
        $memberFirstName = $member->getFirstName();
        $outputPort->memberName = "$memberLastName $memberFirstName";

        // ????????????????????????
        $privateImage = $member->getPrivatePhotoFilePathForClientShow();
        $outputPort->privateImage = $privateImage;

        //????????????
        $idImage = $member->getIdPhotoFilePathForClientShow();
        $outputPort->idImage = $idImage;

        // ????????????
        $schoolName = $member->getOldSchool()->getName();
        $departmentName = $member->getOldSchool()->getDepartmentName();
        $birthday = $member->getBirthday()->format("Ymd");
        $age = $this->setAge($birthday);
        $graduationPeriod = $member->getOldSchool()->getGraduationPeriod()->format("Y");
        $outputPort->schoolName = $schoolName;
        $outputPort->departmentName = $departmentName;
        $outputPort->age = $age;
        $outputPort->graduationPeriod = $graduationPeriod;

        // ??????????????????
        $hashTag = $member->getHashTag();
        if (isset($hashTag)) {
            $hashTagName = $hashTag->getName();
            $hashTagColor = Tag::TAG_COLLAR_CLASS_LIST[$hashTag->getColor()];
            $outputPort->hashTagName = $hashTagName;
            $outputPort->hashTagColor = $hashTagColor;
        }

        // ??????????????????????????????
        $date = new Carbon($inputPort->date);
        setlocale(LC_ALL, 'ja_JP.UTF-8');
        $formattedDate = $date->formatLocalized('%Y???%m???%d???(%a)');
        $outputPort->date = $formattedDate;

        // ????????????
        $outputPort->time = $inputPort->time;

        // ??????
        $outputPort->content = $inputPort->content;

        $outputPort->memberUserAccountId = $memberUserAccountId;

        // ????????????URL
        $outputPort->videoInterviewReviseUrl = route("client.video-interview.revise", ["userAccountId" => $memberUserAccountId]);

        //????????????
        Log::infoOut();
    }

    /**
     * ????????????
     *
     * @param VideoInterviewEntryExecuteInputPort $inputPort
     * @param VideoInterviewEntryExecuteOutputPort $outputPort
     * @throws FatalBusinessException
     */
    public function execute(VideoInterviewEntryExecuteInputPort $inputPort, VideoInterviewEntryExecuteOutputPort $outputPort): void
    {
        //????????????
        Log::infoIn();

        $companyAccount = $this->getLoggedInCompanyAccount($inputPort);
        $loggedInUserAccount = $companyAccount->getUserAccount();

        $memberUserAccountId = $inputPort->memberUserAccountId;
        $member = $this->getMember($memberUserAccountId);
        $memberUserAccount = $member->getUserAccount();

        $dateTime = $date = $inputPort->date . $inputPort->time;
        $appointmentDatetime = new Carbon($dateTime);
        $interViewAppointment = new InterViewAppointment();
        $interViewAppointment->setAppointmentDatetime($appointmentDatetime);
        $interViewAppointment->setContent($inputPort->content);
        $interViewAppointment->setStatus(InterViewAppointment::STATUS_RESERVATION);
        $interViewAppointment->setMemberUserAccount($memberUserAccount);
        $interViewAppointment->setCompanyUserAccount($loggedInUserAccount);
        $interViewAppointment->setMemberPeerId(UUID::generate(UUID::UUID_RANDOM, UUID::FMT_STRING));
        $interViewAppointment->setCompanyPeerId(UUID::generate(UUID::UUID_RANDOM, UUID::FMT_STRING));

        // ????????????
        $this->interviewAppointmentRepository->saveOrUpdate($interViewAppointment, true);

        // ???????????????
        $memberTemplate = "mail.front.member.interview_appointment_mail";
        $companyTemplate = "mail.front.client.interview_appointment_mail";
        $mailAddress = $member->getUserAccount()->getMailAddress();
        $companyMailAddress = $loggedInUserAccount->getMailAddress();
        $companyName = $companyAccount->getCompany()->getName();
        $pic_name = $companyAccount->getCompany()->getPicName();
        $title = "???LinkT?????????????????????????????????";
        $interViewAppointmentId = $interViewAppointment->getId();
        $memberName = $member->getLastName() . " " . $member->getFirstName();
        $dataList["memberName"] = $memberName;
        $frontAppURL = env('FRONT_APP_URL');
        $contactURL = "$frontAppURL/mypage/contact";
        $dataList["contactURL"] = $contactURL;
        $frontAppURL = env('FRONT_APP_URL');
        $memberVideoInterviewReservationDetailURL = "$frontAppURL/mypage/video/$interViewAppointmentId/reservation-detail";
        $dataList["memberVideoInterviewReservationDetailUrl"] = $memberVideoInterviewReservationDetailURL;
        $dataList["companyName"] = $companyName;
        $dataList["pic_name"] = $pic_name;
        $dataList["companyAccountUserName"] = $companyAccount->getLastName() . " " . $companyAccount->getFirstName();
        $dataList["companyVideoInterviewReservationDetailUrl"] = route("client.video-interview.reservation-detail", ["userAccountId" => $interViewAppointmentId]);
        $dataList["appointmentDatetime"] = $appointmentDatetime->year."???".$appointmentDatetime->month."???".$appointmentDatetime->day."??? ".$appointmentDatetime->hour.":".str_pad($appointmentDatetime->minute,2,0,STR_PAD_LEFT);
        $data = Data::wrap($dataList);

        // ?????????????????????????????????????????????
        $mail = Mail::getInstance($memberTemplate, $mailAddress, trans($title), $data);
        $mail->send();

        // ????????????????????????????????????????????????
        $companyMail = Mail::getInstance($companyTemplate, $companyMailAddress, trans($title), $data);
        $companyMail->send();

        //????????????
        Log::infoOut();
    }

    /**
     * ????????????
     *
     * @param int $memberUserAccountId
     * @return Member
     * @throws FatalBusinessException
     */
    private function getMember(int $memberUserAccountId)
    {
        $criteriaFactory = CriteriaFactory::getInstance();
        try {
            $member = $this->memberRepository->findOneByCriteria(
                $criteriaFactory->create(GeneralCriteria::class, GeneralExpressionBuilder::class,
                    [
                        "userAccount.id" => $memberUserAccountId,
                        "status" => Member::STATUS_REAL_MEMBER
                    ]
                )
            );
        } catch (ObjectNotFoundException $e) {
            throw new FatalBusinessException("select_target_not_found");
        }
        return $member;
    }

    /**
     * ????????????????????????????????????
     *
     * @param string $birthday
     * @return int
     */
    private function setAge(string $birthday)
    {
        $now = date("Ymd");
        $age = floor($now - $birthday) / 10000;
        return intval($age);
    }
}
