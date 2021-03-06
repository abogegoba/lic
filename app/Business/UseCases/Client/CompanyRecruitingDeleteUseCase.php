<?php

namespace App\Business\UseCases\Client;

use App\Business\Interfaces\Gateways\Repositories\CompanyAccountRepository;
use App\Business\Interfaces\Gateways\Repositories\CompanyRepository;
use App\Business\Interfaces\Gateways\Repositories\JobApplicationRepository;
use App\Business\Interfaces\Gateways\Repositories\JobTypeRepository;
use App\Business\Interfaces\Gateways\Repositories\PrefectureRepository;
use App\Business\Interfaces\Interactors\Client\CompanyRecruitingDelete\CompanyRecruitingDeleteInitializeInputPort;
use App\Business\Interfaces\Interactors\Client\CompanyRecruitingDelete\CompanyRecruitingDeleteInitializeInteractor;
use App\Business\Interfaces\Interactors\Client\CompanyRecruitingDelete\CompanyRecruitingDeleteInitializeOutputPort;
use App\Business\Interfaces\Interactors\Client\CompanyRecruitingDelete\CompanyRecruitingDeleteInputPort;
use App\Business\Interfaces\Interactors\Client\CompanyRecruitingDelete\CompanyRecruitingDeleteInteractor;
use App\Business\Interfaces\Interactors\Client\CompanyRecruitingDelete\CompanyRecruitingDeleteOutputPort;
use App\Business\Interfaces\Interactors\Client\Profile\ProfileInitializeInputPort;
use App\Business\Interfaces\Interactors\Client\Profile\ProfileInitializeInteractor;
use App\Business\Interfaces\Interactors\Client\Profile\ProfileInitializeOutputPort;
use App\Business\Services\UseSelectedJobApplicationTrait;
use App\Domain\Entities\JobApplication;
use App\Utilities\Log;
/**
 * Class ProfileUseCase
 *
 * @package App\Business\UseCases\Client
 */
class CompanyRecruitingDeleteUseCase implements CompanyRecruitingDeleteInitializeInteractor,CompanyRecruitingDeleteInteractor
{
    use UseSelectedJobApplicationTrait;

    /**
     * @var JobApplicationRepository
     */
    private $jobApplicationRepository;

    /**
     * @var JobTypeRepository
     */
    private $jobTypeRepository;

    /**
     * @var PrefectureRepository
     */
    private $prefectureRepository;

    /**
     * @var companyAccountRepository
     */
    private $companyAccountRepository;

    /**
     * @var CompanyRepository
     */
    private $companyRepository;

    /**
     * CompanyRecruitingEditUseCase constructor.
     * @param JobApplicationRepository $jobApplicationRepository
     * @param JobTypeRepository $jobTypeRepository
     * @param PrefectureRepository $prefectureRepository
     */
    public function __construct(
        JobApplicationRepository $jobApplicationRepository,
        JobTypeRepository $jobTypeRepository,
        PrefectureRepository $prefectureRepository,
        CompanyAccountRepository $companyAccountRepository,
        CompanyRepository $companyRepository
    )
    {
        $this->jobApplicationRepository = $jobApplicationRepository;
        $this->jobTypeRepository = $jobTypeRepository;
        $this->prefectureRepository = $prefectureRepository;
        $this->companyAccountRepository = $companyAccountRepository;
        $this->companyRepository = $companyRepository;
    }

    /**
     * ??????????????????
     *
     * @param CompanyRecruitingDeleteInitializeInputPort $inputPort
     * @param CompanyRecruitingDeleteInitializeOutputPort $outputPort
     */
    public function initialize(CompanyRecruitingDeleteInitializeInputPort $inputPort, CompanyRecruitingDeleteInitializeOutputPort $outputPort): void
    {
        //????????????
        Log::infoIn();

        //?????????????????????????????????
        $inputPort->selectedJobApplicationsId;
        $jobApplication = $this->getSelectedJobApplication($inputPort);

        //????????????????????????????????????
        $outputPort->title = $jobApplication->getTitle();
        $outputPort->jobTypeName = $jobApplication->getRecruitmentJobType()->getName();
        $outputPort->jobConditions = $this->createJobConditions($jobApplication);


        //????????????
        Log::infoOut();
    }

    /**
     * ??????????????????
     *
     * @param CompanyRecruitingDeleteInputPort $inputPort
     * @param CompanyRecruitingDeleteOutputPort $outputPort
     * @throws \ReLab\Commons\Exceptions\FatalBusinessException
     */
    public function delete(CompanyRecruitingDeleteInputPort $inputPort, CompanyRecruitingDeleteOutputPort $outputPort): void
    {
        //????????????
        Log::infoIn();

        //????????????????????????????????????
        $inputPort->selectedJobApplicationsId;
        $deletedJobApplication = $this->getSelectedJobApplication($inputPort);

        //??????????????????????????????????????????
        $recruitmentWorkLocations = $deletedJobApplication->getRecruitmentWorkLocations();


        if (count($recruitmentWorkLocations) > 0){
            foreach ($recruitmentWorkLocations as $recruitmentWorkLocation){
                $recruitmentWorkLocations->removeElement($recruitmentWorkLocation);
            }
        }

        //??????
       $this->jobApplicationRepository->saveOrUpdate($deletedJobApplication,true);
       $this->jobApplicationRepository->delete($deletedJobApplication);


        //????????????
        Log::infoOut();
    }


    /**
     * ??????????????????
     *
     * @param JobApplication $jobApplication
     * @return string
     */
    private function createJobConditions(JobApplication $jobApplication): string
    {
        $recruitmentWorkLocations = $jobApplication->getRecruitmentWorkLocations();
        $location = '';
        if (!is_null($recruitmentWorkLocations)) {
            foreach ($recruitmentWorkLocations as $recruitmentWorkLocation) {
                $name = $recruitmentWorkLocation->getName();
                if (!empty($name)) {
                    $location = $location . $name . '???';
                }
            }
            if (!empty($location)) {
                $location = mb_substr($location, 0, -1);
            }
        }

        $employmentType = $jobApplication->getEmploymentType();
        $employmentTypeName = '';
        if (!is_null($employmentType)) {
            if ($employmentType === JobApplication::EMPLOYMENT_TYPE_REGULAR) {
                $employmentTypeName = JobApplication::EMPLOYMENT_TYPE_NAME_REGULAR;
            } else if ($employmentType === JobApplication::EMPLOYMENT_TYPE_CONTRACT) {
                $employmentTypeName = JobApplication::EMPLOYMENT_TYPE_NAME_CONTRACT;
            }
        }

        $jobConditions =  '';
        if ($location !== '' && $employmentTypeName !== ''){
            $jobConditions = $location . '???' . $employmentTypeName;
        } else if ($location === '' && $employmentTypeName !== '') {
            $jobConditions = $employmentTypeName;
        } else if ($location !== '' && $employmentTypeName === '') {
            $jobConditions = $location;
        }

        if ($jobConditions !== '') {
            $jobConditions = '???' . $jobConditions . '???';
        }

        return $jobConditions;
    }

    /**
     * ???????????????
     *
     * @param JobApplication $jobApplication
     * @return string
     */
    private function getJobTypeName(JobApplication $jobApplication): string
    {
        $jobType = $jobApplication->getRecruitmentJobType();
        $jobName = '';
        if (!is_null($jobType)) {
            $jobName = $jobType->getName();
        }

        return $jobName;
    }
}