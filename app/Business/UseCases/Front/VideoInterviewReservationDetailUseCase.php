<?php

namespace App\Business\UseCases\Front;

use App\Business\Interfaces\Gateways\Criteria\GeneralCriteria;
use App\Business\Interfaces\Gateways\Expression\Builders\GeneralExpressionBuilder;
use App\Business\Interfaces\Gateways\Repositories\InterviewAppointmentRepository;
use App\Business\Interfaces\Gateways\Repositories\MemberRepository;
use App\Business\Interfaces\Gateways\Repositories\UserAccountRepository;
use App\Business\Interfaces\Interactors\Front\VideoInterviewReservationDetail\VideoInterviewReservationDetailInitializeInputPort;
use App\Business\Interfaces\Interactors\Front\VideoInterviewReservationDetail\VideoInterviewReservationDetailInitializeInteractor;
use App\Business\Interfaces\Interactors\Front\VideoInterviewReservationDetail\VideoInterviewReservationDetailInitializeOutputPort;
use App\Business\Services\UseLoggedInMemberTrait;
use App\Domain\Entities\InterViewAppointment;
use App\Utilities\Log;
use ReLab\Commons\Exceptions\FatalBusinessException;
use ReLab\Commons\Exceptions\ObjectNotFoundException;
use ReLab\Commons\Wrappers\CriteriaFactory;

/**
 * Class VideoInterviewReservationDetailUseCase
 *
 * @package App\Business\UseCases\Front
 */
class VideoInterviewReservationDetailUseCase implements VideoInterviewReservationDetailInitializeInteractor
{
    use UseLoggedInMemberTrait;

    /**
     * @var MemberRepository
     */
    private $memberRepository;

    /**
     * @var InterviewAppointmentRepository
     */
    private $interviewAppointmentRepository;

    /**
     * VideoInterviewListUseCase constructor.
     *
     * @param MemberRepository $memberRepository
     * @param UserAccountRepository $userAccountRepository
     * @param InterviewAppointmentRepository $interviewAppointmentRepository
     */
    public function __construct(
        MemberRepository $memberRepository,
        InterviewAppointmentRepository $interviewAppointmentRepository
    ) {
        $this->memberRepository = $memberRepository;
        $this->interviewAppointmentRepository = $interviewAppointmentRepository;
    }

    /**
     * ????????????
     *
     * @param VideoInterviewReservationDetailInitializeInputPort $inputPort
     * @param VideoInterviewReservationDetailInitializeOutputPort $outputPort
     * @throws FatalBusinessException
     */
    public function initialize(VideoInterviewReservationDetailInitializeInputPort $inputPort, VideoInterviewReservationDetailInitializeOutputPort $outputPort): void
    {
        //????????????
        Log::infoIn();

        $interviewAppointmentId = $inputPort->interviewAppointmentId;

        // ??????????????????
        $criteriaFactory = CriteriaFactory::getInstance();
        try {
            $interviewAppointment = $this->interviewAppointmentRepository->findOneByCriteria(
                $criteriaFactory->create(GeneralCriteria::class, GeneralExpressionBuilder::class,
                    [
                        "id" => $interviewAppointmentId,
                        "status" => [
                            InterviewAppointment::STATUS_RESERVATION,
                            InterviewAppointment::STATUS_CLOSE,
                        ]
                    ]
                )
            );
        } catch (ObjectNotFoundException $e) {
            throw new FatalBusinessException("select_target_not_found");
        }

        // ???????????????????????????
        $companyUserAccount = $interviewAppointment->getCompanyUserAccount();
        $company = $companyUserAccount->getCompanyAccount()->getCompany();

        // ?????????
        $companyName = $company->getName();
        $outputPort->companyName = $companyName;

        // ????????????
        $businessTypes = $company->getBusinessTypes();
        $businessTypeList = [];
        foreach ($businessTypes as $businessType) {
            $businessTypeName = $businessType->getName();
            $businessTypeList[] = $businessTypeName;
        }
        $formattedBusinessTypes = implode('/', $businessTypeList);
        $outputPort->formattedBusinessTypes = $formattedBusinessTypes;

        // ???????????????
        $headOfficePrefecture = $company->getPrefecture()->getName();
        $outputPort->headOfficePrefecture = $headOfficePrefecture;

        // ???????????????
        $introductorySentence = $company->getIntroductorySentence();
        $outputPort->introductorySentence = $introductorySentence;

        // ????????????
        $appointmentDatetime = $interviewAppointment->getAppointmentDatetime();
        setlocale(LC_ALL, 'ja_JP.UTF-8');
        $appointmentDate = $appointmentDatetime->formatLocalized('%Y???%m???%d???(%a)');
        $appointmentTime = $appointmentDatetime->format('H:i');
        $outputPort->appointmentDate = $appointmentDate;
        $outputPort->appointmentTime = $appointmentTime;

        // ??????URL
        $outputPort->videoInterviewRoomUrl = route("front.video-interview.room", ["interviewAppointmentId" => $interviewAppointmentId]);
        // ?????????????????????URL
        $outputPort->videoInterviewCancelUrl = route("front.video-interview.cancel-confirm", ["interviewAppointmentId" => $interviewAppointmentId]);

        // ??????
        $content = $interviewAppointment->getContent();
        $outputPort->content = $content;

        //????????????
        Log::infoOut();
    }
}