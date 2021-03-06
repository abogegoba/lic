<?php

namespace App\Business\Services;

use App\Business\Interfaces\Gateways\Criteria\BusinessTypeSearchCriteria;
use App\Business\Interfaces\Gateways\Criteria\GeneralCriteria;
use App\Business\Interfaces\Gateways\Criteria\JobTypeSearchCriteria;
use App\Business\Interfaces\Gateways\Criteria\PrefectureSearchCriteria;
use App\Business\Interfaces\Gateways\Expression\Builders\GeneralExpressionBuilder;
use App\Business\Interfaces\Gateways\Repositories\BusinessTypeRepository;
use App\Business\Interfaces\Gateways\Repositories\CareerRepository;
use App\Business\Interfaces\Gateways\Repositories\CertificationRepository;
use App\Business\Interfaces\Gateways\Repositories\JobTypeRepository;
use App\Business\Interfaces\Gateways\Repositories\LanguageAndCertificationRepository;
use App\Business\Interfaces\Gateways\Repositories\MemberRepository;
use App\Business\Interfaces\Gateways\Repositories\PrefectureRepository;
use App\Business\Interfaces\Gateways\Repositories\SelfIntroductionRepository;
use App\Business\Interfaces\Gateways\Repositories\UploadedFileRepository;
use App\Business\Interfaces\Gateways\Repositories\UserAccountRepository;
use App\Business\Interfaces\Interactors\Admin\MemberCreate\MemberCreateInitializeOutputPort;
use App\Business\Interfaces\Interactors\Admin\MemberCreate\MemberCreateStoreInputPort;
use App\Domain\Entities\BusinessType;
use App\Domain\Entities\Career;
use App\Domain\Entities\Certification;
use App\Domain\Entities\JobType;
use App\Domain\Entities\LanguageAndCertification;
use App\Domain\Entities\Member;
use App\Domain\Entities\Prefecture;
use App\Domain\Entities\School;
use App\Domain\Entities\SelfIntroduction;
use App\Domain\Entities\Tag;
use App\Domain\Entities\UploadedFile;
use App\Domain\Entities\UserAccount;
use App\Utilities\Log;
use Carbon\Carbon;
use ReLab\Commons\Exceptions\BusinessException;
use ReLab\Commons\Exceptions\FatalBusinessException;
use ReLab\Commons\Exceptions\ObjectNotFoundException;
use ReLab\Commons\Utilities\File;
use ReLab\Commons\Wrappers\CriteriaFactory;
use ReLab\Commons\Wrappers\Data;
use ReLab\Commons\Wrappers\Mail;

/**
 * Trait MemberAdminServiceTrait
 *
 * @package App\Business\Services
 */
trait MemberAdminServiceTrait
{
    use ListCreateTrait;

    /**
     * @var UserAccountRepository
     */
    private $userAccountRepository;

    /**
     * @var MemberRepository
     */
    private $memberRepository;

    /**
     * @var UploadedFileRepository
     */
    private $uploadedFileRepository;

    /**
     * @var SelfIntroductionRepository
     */
    private $selfIntroductionRepository;

    /**
     * @var CertificationRepository
     */
    private $certificationRepository;

    /**
     * @var LanguageAndCertificationRepository
     */
    private $languageAndCertificationRepository;

    /**
     * @var CareerRepository
     */
    private $careerRepository;

    /**
     * MemberCreateUseCase constructor.
     *
     * @param JobTypeRepository $jobTypeRepository
     * @param PrefectureRepository $prefectureRepository
     * @param BusinessTypeRepository $businessTypeRepository
     * @param UserAccountRepository $userAccountRepository
     * @param MemberRepository $memberRepository
     * @param UploadedFileRepository $uploadedFileRepository
     * @param SelfIntroductionRepository $selfIntroductionRepository
     * @param CertificationRepository $certificationRepository
     * @param LanguageAndCertificationRepository $languageAndCertificationRepository
     * @param CareerRepository $careerRepository
     */
    public function __construct(
        JobTypeRepository $jobTypeRepository,
        PrefectureRepository $prefectureRepository,
        BusinessTypeRepository $businessTypeRepository,
        UserAccountRepository $userAccountRepository,
        MemberRepository $memberRepository,
        UploadedFileRepository $uploadedFileRepository,
        SelfIntroductionRepository $selfIntroductionRepository,
        CertificationRepository $certificationRepository,
        LanguageAndCertificationRepository $languageAndCertificationRepository,
        CareerRepository $careerRepository
    )
    {
        $this->jobTypeRepository = $jobTypeRepository;
        $this->prefectureRepository = $prefectureRepository;
        $this->businessTypeRepository = $businessTypeRepository;
        $this->userAccountRepository = $userAccountRepository;
        $this->memberRepository = $memberRepository;
        $this->uploadedFileRepository = $uploadedFileRepository;
        $this->selfIntroductionRepository = $selfIntroductionRepository;
        $this->certificationRepository = $certificationRepository;
        $this->languageAndCertificationRepository = $languageAndCertificationRepository;
        $this->careerRepository = $careerRepository;
    }

    /**
     * ????????????????????????????????????
     *
     * @param MemberCreateInitializeOutputPort $outputPort
     */
    private function outputChoiceLists(MemberCreateInitializeOutputPort $outputPort)
    {
        // ????????????
        Log::infoIn();
        $outputPort->overseasList = Member::CITIZENSHIP_OVERSEAS_LIST;
        // ?????????????????????
        $outputPort->prefectureList = $this->createPrefectureList();
        // ?????????????????????
        $outputPort->schoolTypeList = School::SCHOOL_TYPE_LIST;
        // ?????????????????????
        $outputPort->facultyTypeList = School::FACULTY_TYPE_LIST;
        $outputPort->overseasFacultyTypeList = School::OVERSEAS_FACULTY_TYPE_LIST;
        // ????????????
        $outputPort->yearList = School::getGraduationTwelveYearListYearAgo();
        // ????????????
        $outputPort->monthList = School::getAllMonthList();
        // ?????????????????????????????????????????????
        $outputPort->hashTagColorClassList = Tag::TAG_COLLAR_CLASS_LIST;
        // ?????????????????????????????????
        $outputPort->affiliationExperienceLabelList = Member::AFFILIATION_EXPERIENCE_LABEL_LIST;
        // ??????????????????????????????????????????
        $outputPort->instagramFollowerNumberLabelList = Member::INSTAGRAM_FOLLOWER_NUMBER_LABEL_LIST;
        // ???????????????
        $outputPort->businessTypeList = $this->createBusinessTypeList();
        // ???????????????
        $outputPort->jobTypeList = $this->createJobTypeList();
        // ????????????????????????
        $outputPort->statusList = Member::STATUS_LIST;

        // ????????????
        Log::infoOut();
    }

    /**
     * ???????????????????????????
     *
     * @param Member $member
     * @param MemberCreateStoreInputPort $inputPort
     * @throws BusinessException
     * @throws FatalBusinessException
     */
    private function saveOrUpdate(Member $member, MemberCreateStoreInputPort $inputPort)
    {
        // ????????????
        Log::infoIn();

        // ???????????????????????????????????????????????????
        $this->checkDuplicateMailAddress($inputPort->mailAddress, $this->userAccountRepository, $member->getId());

        // ?????????????????????????????????????????????
        $this->checkCanStoreGraduationPeriod($inputPort->graduationPeriodYear, $inputPort->graduationPeriodMonth);

        /** @var UploadedFile[] $newPhotos */
        $newPhotos = [];
        /** @var UploadedFile[] $deletePhotos */
        $deletePhotos = [];
        /** @var UploadedFile[] $newPrVideos */
        $newPrVideos = [];
        /** @var UploadedFile[] $deletePrVideos */
        $deletePrVideos = [];
        /** @var SelfIntroduction[] $deleteSelfIntroductions */
        $deleteSelfIntroductions = [];

        $prefectureRepository = $this->prefectureRepository;
        $selfIntroductionRepository = $this->selfIntroductionRepository;
        Data::mappingToObject($inputPort, $member, [
            // ????????????
            "birthday" => function ($value, $inputPort, $toObject) {
                /**
                 * @var string $value
                 * @var MemberCreateStoreInputPort $inputPort
                 * @var Member $toObject
                 */
                $toObject->setBirthday(Carbon::make($value));
            },
            // ????????????
            "prefecture" => function ($value, $inputPort, $toObject) use ($prefectureRepository) {
                /**
                 * @var int $value
                 * @var MemberCreateStoreInputPort $inputPort
                 * @var Member $toObject
                 */
                try {
                    $prefecture = $prefectureRepository->findOneByCriteria(
                        CriteriaFactory::getInstance()->create(PrefectureSearchCriteria::class, GeneralExpressionBuilder::class,
                            [
                                "id" => $value
                            ]
                        )
                    );
                    /** @var Member $toObject */
                    $toObject->setPrefecture($prefecture);
                } catch (ObjectNotFoundException $e) {
                    throw new FatalBusinessException("select_target_not_found");
                }
            },
            // ??????
            "schoolType" => function ($value, $fromObject, $toObject) {
                /**
                 * @var int $value
                 * @var MemberCreateStoreInputPort $fromObject
                 * @var Member $toObject
                 */
                $school = $toObject->getOldSchool();
                if (empty($school)) {
                    $school = new School();
                    $school->setMember($toObject);
                }
                $school->setSchoolType($value);
                $school->setname($fromObject->schoolName);
                $school->setDepartmentName($fromObject->departmentName);
                $school->setFacultyType($fromObject->facultyType);
                $school->setGraduationPeriod(new Carbon($fromObject->graduationPeriodYear . sprintf('%02d', $fromObject->graduationPeriodMonth) . '01'));
                $toObject->setOldSchool($school);
            },
            // ????????????
            "idPhotoName" => function ($value, $fromObject, $toObject) use (&$newPhotos, &$deletePhotos) {
                /**
                 * @var string $value
                 * @var MemberCreateStoreInputPort $fromObject
                 * @var Member $toObject
                 */
                $idPhotoName = $fromObject->idPhotoName;
                $idPhotoPath = $fromObject->idPhotoPath;
                if (!empty($idPhotoName) && !empty($idPhotoPath)) {
                    $realIdPhotoPath = STORAGE_PUBLIC_DIR_PATH . DS . $fromObject->idPhotoPath;

                    $newPhoto = false;
                    $existIdentificationImage = $toObject->getIdentificationImage();
                    if (isset($existIdentificationImage) && $realIdPhotoPath != $existIdentificationImage->getRealFilePath()) {
                        $deletePhotos[] = $existIdentificationImage;
                        $newPhoto = true;
                    } else if (!isset($existIdentificationImage)) {
                        $newPhoto = true;
                    }

                    if ($newPhoto && file_exists($realIdPhotoPath)) {
                        $physicalFileName = str_replace(STORAGE_PUBLIC_TEMP_DIR_PATH . DS, "", $realIdPhotoPath);
                        $uploadedFile = new UploadedFile();
                        $uploadedFile->setMember($toObject);
                        $uploadedFile->setFileName($value);
                        $uploadedFile->setFilePath("member/" . $toObject->getId() . "/" . $physicalFileName);
                        $uploadedFile->setPhysicalFileName($physicalFileName);
                        $toObject->setIdentificationImage($uploadedFile);
                        $newPhotos[$realIdPhotoPath] = $uploadedFile;
                    }
                }
            },
            // ????????????????????????
            "privatePhotoName" => function ($value, $fromObject, $toObject) use (&$newPhotos, &$deletePhotos) {
                /**
                 * @var string $value
                 * @var MemberCreateStoreInputPort $fromObject
                 * @var Member $toObject
                 */
                $privatePhotoName = $fromObject->privatePhotoName;
                $privatePhotoPath = $fromObject->privatePhotoPath;
                if (!empty($privatePhotoName) && !empty($privatePhotoPath)) {
                    $realPrivatePhotoPath = STORAGE_PUBLIC_DIR_PATH . DS . $fromObject->privatePhotoPath;

                    $newPhoto = false;
                    $existPrivateImage = $toObject->getPrivateImage();
                    if (isset($existPrivateImage) && $realPrivatePhotoPath != $existPrivateImage->getRealFilePath()) {
                        $deletePhotos[] = $existPrivateImage;
                        $newPhoto = true;
                    } else if (!isset($existPrivateImage)) {
                        $newPhoto = true;
                    }

                    if ($newPhoto && file_exists($realPrivatePhotoPath)) {
                        $physicalFileName = str_replace(STORAGE_PUBLIC_TEMP_DIR_PATH . DS, "", $realPrivatePhotoPath);
                        $uploadedFile = new UploadedFile();
                        $uploadedFile->setMember($toObject);
                        $uploadedFile->setFileName($value);
                        $uploadedFile->setFilePath("member/" . $toObject->getId() . "/" . $physicalFileName);
                        $uploadedFile->setPhysicalFileName($physicalFileName);
                        $toObject->setPrivateImage($uploadedFile);
                        $newPhotos[$realPrivatePhotoPath] = $uploadedFile;
                    }
                }
            },
            // ??????????????????
            "hashTag" => function ($value, $fromObject, $toObject) {
                /**
                 * @var int $value
                 * @var MemberCreateStoreInputPort $fromObject
                 * @var Member $toObject
                 */
                $hashTag = $toObject->getHashTag();
                if (empty($hashTag)) {
                    $hashTag = new Tag();
                    $hashTag->setMember($toObject);
                    $hashTag->setFixingFlag(Tag::HASH_TAG);
                }
                $hashTag->setName($value);
                $hashTag->setColor($fromObject->hashTagColor);
                $toObject->setHashTag($hashTag);
            },
            // ???????????????????????????
            "mailAddress" => function ($value, $fromObject, $toObject) {
                /**
                 * @var int $value
                 * @var MemberCreateStoreInputPort $fromObject
                 * @var Member $toObject
                 */
                $userAccount = $toObject->getUserAccount();
                if (empty($userAccount)) {
                    $userAccount = new UserAccount();
                    $userAccount->setMember($toObject);
                }
                $userAccount->setMailAddress($value);
                $userAccount->setPassword($fromObject->password);
                $toObject->setUserAccount($userAccount);
            },
            // PR??????
            "prVideoNames" => function ($prVideoNames, $fromObject, $toObject) use (&$newPrVideos, &$deletePrVideos) {
                /**
                 * @var int $value
                 * @var MemberCreateStoreInputPort $fromObject
                 * @var Member $toObject
                 */
                /** @var UploadedFile[] $existPrVideos */
                $existPrVideos = [];
                $prVideos = $toObject->getPrVideos();
                foreach ($prVideos as $prVideo) {
                    $existPrVideos[$prVideo->getRealFilePath()] = $prVideo;
                }

                $prVideoPaths = $fromObject->prVideoPaths;
                $prVideoTitles = $fromObject->prVideoTitles;
                $prVideoDescriptions = $fromObject->prVideoDescriptions;
                foreach ($prVideoNames as $index => $prVideoName) {
                    if (isset($prVideoPaths[$index])) {
                        $prVideoPath = STORAGE_PUBLIC_DIR_PATH . DS . $prVideoPaths[$index];
                        if (isset($existPrVideos[$prVideoPath])) {
                            // ?????????PR?????????????????????????????????????????????
                            $existPrVideos[$prVideoPath]->setSortNumber($index + 1);
                            if (isset($prVideoTitles[$index])) {
                                $existPrVideos[$prVideoPath]->setTitle($prVideoTitles[$index]);
                            }
                            if (isset($prVideoDescriptions[$index])) {
                                $existPrVideos[$prVideoPath]->setDescription($prVideoDescriptions[$index]);
                            }
                            unset($existPrVideos[$prVideoPath]);
                        } else if (file_exists($prVideoPath)) {
                            // ??????PR???????????????????????????UploadedFile????????????????????????????????????
                            $physicalFileName = str_replace(STORAGE_PUBLIC_TEMP_DIR_PATH . DS, "", $prVideoPath);
                            $uploadedFile = new UploadedFile();
                            $uploadedFile->setMember($toObject);
                            $uploadedFile->setFileName($prVideoName);
                            $uploadedFile->setFilePath("member/" . $toObject->getId() . "/" . $physicalFileName);
                            $uploadedFile->setPhysicalFileName($physicalFileName);
                            $uploadedFile->setSortNumber($index + 1);
                            if (isset($prVideoTitles[$index])) {
                                $uploadedFile->setTitle($prVideoTitles[$index]);
                            }
                            if (isset($prVideoDescriptions[$index])) {
                                $uploadedFile->setDescription($prVideoDescriptions[$index]);
                            }
                            $newPrVideos[$prVideoPath] = $uploadedFile;
                        }
                    }
                }
                $toObject->setPrVideos($newPrVideos);
                $deletePrVideos = $existPrVideos;
            },
            // ????????????
            "selfIntroductions" => function ($value, $fromObject, $toObject) use ($selfIntroductionRepository) {
                /**
                 * @var string[] $value
                 * @var MemberCreateStoreInputPort $fromObject
                 * @var Member $toObject
                 */
                $memberId = $toObject->getId();
                $titleList = SelfIntroduction::SELF_TITLE_LIST;
                $titleList[SelfIntroduction::SELF_DISPLAY_NUMBER_10] = $fromObject->selfIntroduction10Title;
                $selfIntroductions = [];
                foreach ($value as $displayNumber => $inputtedSelfIntroduction) {
                    $selfIntroduction = null;
                    if (!empty($memberId)) {
                        try {
                            $selfIntroduction = $selfIntroductionRepository->findOneByCriteria(
                                CriteriaFactory::getInstance()->create(GeneralCriteria::class, GeneralExpressionBuilder::class, [
                                    "displayNumber" => $displayNumber,
                                    "member" => $memberId,
                                ])
                            );
                        } catch (ObjectNotFoundException $e) {
                            $selfIntroduction = null;
                        }
                    }
                    if (!empty($inputtedSelfIntroduction)) {
                        if ($selfIntroduction === null) {
                            $selfIntroduction = new SelfIntroduction();
                            $selfIntroduction->setMember($toObject);
                            $selfIntroduction->setDisplayNumber($displayNumber);
                        }
                        $selfIntroduction->setTitle($titleList[$displayNumber]);
                        $selfIntroduction->setContent($inputtedSelfIntroduction);
                        $selfIntroductions[] = $selfIntroduction;
                    } elseif ($selfIntroduction !== null) {
                        // ???????????????????????????????????????????????????????????????????????????
                        $deleteSelfIntroductions[] = $selfIntroduction;
                    }
                }
                $toObject->setAspirationSelfIntroductions($selfIntroductions);
            }
        ]);

        // ????????????
        $industries[] = $inputPort->industry1;
        $industries[] = $inputPort->industry2;
        $industries[] = $inputPort->industry3;
        /** @var BusinessType[] $aspirationBusinessTypes */
        $aspirationBusinessTypes = [];
        foreach ($industries as $industryId) {
            if (!empty($industryId)) {
                try {
                    $businessType = $this->businessTypeRepository->findOneByCriteria(
                        CriteriaFactory::getInstance()->create(BusinessTypeSearchCriteria::class, GeneralExpressionBuilder::class,
                            [
                                "id" => $industryId
                            ]
                        )
                    );
                    $aspirationBusinessTypes[] = $businessType;
                } catch (ObjectNotFoundException $e) {
                    throw new FatalBusinessException("select_target_not_found");
                }
            }
        }
        $member->setAspirationBusinessTypes($aspirationBusinessTypes);

        // ????????????
        $jobTypes[] = $inputPort->jobType1;
        $jobTypes[] = $inputPort->jobType2;
        $jobTypes[] = $inputPort->jobType3;
        /** @var JobType[] $aspirationJobTypes */
        $aspirationJobTypes = [];
        foreach ($jobTypes as $jobTypeId) {
            if (!empty($jobTypeId)) {
                try {
                    $jobType = $this->jobTypeRepository->findOneByCriteria(
                        CriteriaFactory::getInstance()->create(JobTypeSearchCriteria::class, GeneralExpressionBuilder::class,
                            [
                                "id" => $jobTypeId
                            ]
                        )
                    );
                    $aspirationJobTypes[] = $jobType;
                } catch (ObjectNotFoundException $e) {
                    throw new FatalBusinessException("select_target_not_found");
                }
            }
        }
        $member->setAspirationJobTypes($aspirationJobTypes);

        // ???????????????
        $locations[] = $inputPort->location1;
        $locations[] = $inputPort->location2;
        $locations[] = $inputPort->location3;
        /** @var Prefecture[] $aspirationPrefectures */
        $aspirationPrefectures = [];
        foreach ($locations as $locationId) {
            if (!empty($locationId)) {
                try {
                    $prefecture = $this->prefectureRepository->findOneByCriteria(
                        CriteriaFactory::getInstance()->create(PrefectureSearchCriteria::class, GeneralExpressionBuilder::class,
                            [
                                "id" => $locationId
                            ]
                        )
                    );
                    $aspirationPrefectures[] = $prefecture;
                } catch (ObjectNotFoundException $e) {
                    throw new FatalBusinessException("select_target_not_found");
                }
            }
        }
        $member->setAspirationPrefectures($aspirationPrefectures);

        // ???????????????
        $languageAndCertification = $member->getLanguageAndCertification();
        $beforeCertificationDisplayNumberList = [];
        $memberId = $member->getId();
        if ($languageAndCertification === null) {
            // ??????????????????????????????????????????????????????????????????
            $languageAndCertification = new LanguageAndCertification();
            $languageAndCertification->setMember($member);
        } else {
            // ???????????????????????????????????????????????????????????????????????????????????????????????????????????????
            $beforeCertifications = $certification = $this->certificationRepository->findValuesByCriteria(
                CriteriaFactory::getInstance()->create(GeneralCriteria::class, GeneralExpressionBuilder::class, [
                    "languageAndCertification.member" => $memberId,
                ]), ["displayNumber"]
            );
            $beforeCertificationDisplayNumberList = array_column($beforeCertifications, "displayNumber");
        }

        // TOEIC???TOEFL?????????
        $languageAndCertification->setToeflScore($inputPort->toeflScore);
        $languageAndCertification->setToeicScore($inputPort->toeicScore);

        // ?????????????????????????????????????????????
        $certifications = [];
        $inputtedCertificationList = $inputPort->certificationList;
        foreach ($inputtedCertificationList as $index => $inputtedCertification) {
            if (!empty($inputtedCertification)) {
                $certification = $this->getCertificationByDisplayNumberAndMemberId($index, $memberId);
                if ($certification === null) {
                    $certification = new Certification();
                    $certification->setDisplayNumber($index);
                    $certification->setLanguageAndCertification($languageAndCertification);
                }
                $certification->setName($inputtedCertification);
                $certifications[] = $certification;
                // ?????????????????????????????????
                unset($beforeCertificationDisplayNumberList[array_search($index, $beforeCertificationDisplayNumberList)]);
            }
        }
        $languageAndCertification->setCertifications($certifications);
        $member->setLanguageAndCertification($languageAndCertification);

        // ????????????
        $originalCareers = $member->getCareers();
        $beforeCareerDisplayNumberList = [];
        if ($originalCareers !== null) {
            foreach ($originalCareers as $originalCareer) {
                $beforeCareerDisplayNumberList[] = $originalCareer->getDisplayNumber();
            }
        }
        $careerNames = $inputPort->careerNames;
        $memberId = $member->getId();
        $careers = [];
        if(!is_null($inputPort->careerPeriodYears) && !is_null($inputPort->careerPeriodMonths)){
            foreach ($careerNames as $index => $careerName) {
                $periodYear = $inputPort->careerPeriodYears[$index];
                $periodMonth = $inputPort->careerPeriodMonths[$index];
                // ????????????????????????????????????????????????????????????
                if (!empty($careerName) && !empty($periodYear) && !empty($periodMonth)) {
                    $career = $this->getCareerByDisplayNumberAndMemberId($index, $memberId);
                    if ($career === null) {
                        $career = new Career();
                        $career->setDisplayNumber($index);
                    }
                    $career->setPeriod(new Carbon($periodYear . sprintf('%02d', $periodMonth) . '01'));
                    $career->setName($careerName);
                    $career->setMember($member);
                    $careers[] = $career;
                    unset($beforeCareerDisplayNumberList[array_search($index, $beforeCareerDisplayNumberList)]);
                }
            }
        }

        $member->setCareers($careers);

        // ?????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????
        $idPhotoPath = $inputPort->idPhotoPath;
        if (empty($idPhotoPath)) {
            $identificationImage = $member->getIdentificationImage();
            if (!empty($identificationImage)) {
                $deletePhotos[] = $identificationImage;
            }
        }

        // ?????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????
        $privatePhotoPath = $inputPort->privatePhotoPath;
        if (empty($privatePhotoPath)) {
            $privateImage = $member->getPrivateImage();
            if (!empty($privateImage)) {
                $deletePhotos[] = $privateImage;
            }
        }

        // ????????????????????????????????????PR????????????????????????????????????????????????????????????PR???????????????????????????
        $prVideoNames = $inputPort->prVideoNames;
        $prVideoPaths = $inputPort->prVideoPaths;
        if (empty($prVideoNames) || empty($prVideoPaths)) {
            $deletePrVideos = $member->getPrVideos();
        }

        // ?????????????????????
        $this->memberRepository->saveOrUpdate($member, true);
        $this->languageAndCertificationRepository->saveOrUpdate($languageAndCertification, true);

        // ???????????????????????????????????????????????????
        if (count($deletePhotos) > 0) {
            $this->uploadedFileRepository->delete($deletePhotos);
        }

        // ???????????????????????????????????????????????????
        if (count($deletePhotos) > 0) {
            $this->uploadedFileRepository->delete($deletePhotos);
        }

        // ??????????????????PR?????????????????????????????????
        if (count($deletePrVideos) > 0) {
            $this->uploadedFileRepository->delete($deletePrVideos);
        }

        // ???????????????????????????????????????????????????
        if (count($deleteSelfIntroductions) > 0) {
            foreach ($deleteSelfIntroductions as $deleteSelfIntroduction) {
                $this->selfIntroductionRepository->physicalDelete($deleteSelfIntroduction);
                Log::infoOperationDeleteLog("", ["selfIntroduction" => (array)$deleteSelfIntroduction], "");
            }
        }

        // ???????????????????????????????????????????????????
        if (count($beforeCertificationDisplayNumberList) > 0) {
            foreach ($beforeCertificationDisplayNumberList as $beforeCertificationDisplayNumber) {
                $deletedCertification = $this->getCertificationByDisplayNumberAndMemberId($beforeCertificationDisplayNumber, $memberId);
                if (isset($deletedCertification)) {
                    $this->certificationRepository->physicalDelete($deletedCertification);
                    Log::infoOperationDeleteLog("", ["certification" => (array)$deletedCertification], "");
                }
            }
        }

        // ??????????????????????????????????????????????????????????????????
        if (count($beforeCareerDisplayNumberList) > 0) {
            foreach ($beforeCareerDisplayNumberList as $beforeCareerDisplayNumber) {
                $deletedCareer = $this->getCareerByDisplayNumberAndMemberId($beforeCareerDisplayNumber, $memberId);
                $this->careerRepository->physicalDelete($deletedCareer);
                Log::infoOperationDeleteLog("", ["career" => (array)$deletedCareer], "");
            }
        }

        // ???????????????TMP??????????????????????????????????????????????????????
        foreach ($newPhotos as $path => $photo) {
            File::createDir($photo->getRealFileDir());
            File::rename($path, $photo->getRealFilePath());
        }

        // ????????????????????????????????????
        foreach ($deletePhotos as $photo) {
            File::remove($photo->getRealFilePath());
        }

        // ??????PR?????????TMP??????????????????????????????????????????????????????
        foreach ($newPrVideos as $prVideoPath => $newPrVideo) {
            File::createDir($newPrVideo->getRealFileDir());
            File::rename($prVideoPath, $newPrVideo->getRealFilePath());
        }

        // ???????????????PR?????????????????????
        foreach ($deletePrVideos as $deletePrVideo) {
            File::remove($deletePrVideo->getRealFilePath());
        }

        // ???????????????
        if ($inputPort->sendMail) {
            if ($member->getStatus() == Member::STATUS_TEMPORARY_MEMBER) {
                // ???????????????????????????????????????????????????????????????
                $this->sendEntryReceptionMail($member);
            } else if ($member->getStatus() == Member::STATUS_REAL_MEMBER) {
                // ?????????????????????????????????????????????????????????????????????
                $this->sendEntryCompleteMail($member);
            }
        }

        // ????????????
        Log::infoOut();
    }

    /**
     * ????????????????????????????????????????????????ID????????????
     *
     * @param int $displayNumber
     * @param int $memberId
     * @return Certification|null
     */
    private function getCertificationByDisplayNumberAndMemberId(int $displayNumber, ?int $memberId): ?Certification
    {
        $certification = null;
        if (!empty($memberId)) {
            try {
                $certification = $this->certificationRepository->findOneByCriteria(
                    CriteriaFactory::getInstance()->create(GeneralCriteria::class, GeneralExpressionBuilder::class, [
                        "displayNumber" => $displayNumber,
                        "languageAndCertification.member" => $memberId,
                    ])
                );
            } catch (ObjectNotFoundException $e) {
                $certification = null;
            }
        }
        return $certification;
    }

    /**
     * ?????????????????????????????????ID????????????
     *
     * @param int $displayNumber
     * @param int $memberId
     * @return Career|null
     */
    private function getCareerByDisplayNumberAndMemberId(int $displayNumber, ?int $memberId): ?Career
    {
        $career = null;
        if (!empty($memberId)) {
            try {
                $career = $this->careerRepository->findOneByCriteria(
                    CriteriaFactory::getInstance()->create(GeneralCriteria::class, GeneralExpressionBuilder::class, [
                        "displayNumber" => $displayNumber,
                        "member" => $memberId,
                    ])
                );
            } catch (ObjectNotFoundException $e) {
                $career = null;
            }
        }
        return $career;
    }

    /**
     * ???????????????????????????????????????????????????
     *
     * @param string $mailAddress
     * @param UserAccountRepository $userAccountRepository
     * @param int|null $memberId
     * @throws BusinessException
     */
    private function checkDuplicateMailAddress(string $mailAddress, UserAccountRepository $userAccountRepository, ?int $memberId)
    {
        $userAccountSameMailAddress = $userAccountRepository->findByCriteria(
            CriteriaFactory::getInstance()->create(GeneralCriteria::class, GeneralExpressionBuilder::class,
                [
                    "mailAddress" => $mailAddress
                ]
            )
        );
        if (count($userAccountSameMailAddress) > 0) {
            foreach ($userAccountSameMailAddress as $userAccount) {
                if (($userAccount->getMember() !== null &&
                    $userAccount->getMember()->getId() !== $memberId &&
                    $userAccount->getMember()->getStatus() !== Member::STATUS_WITHDRAWN_MEMBER)) {
                    // ????????????????????????????????????????????????????????????????????????????????????????????????????????????
                    throw new BusinessException('duplication.mail_address');
                }
            }
        }
    }

    /**
     * ?????????????????????????????????????????????
     *
     * @param int|null $graduationPeriodYear
     * @param int|null $graduationPeriodMonth
     * @throws BusinessException
     */
    private function checkCanStoreGraduationPeriod(?int $graduationPeriodYear, ?int $graduationPeriodMonth)
    {
        $graduationTwelveYearListYearAgo = YearMonthTrait::getGraduationTwelveYearListYearAgo();
        $allMonthList = YearMonthTrait::getAllMonthList();
        if (!array_key_exists($graduationPeriodYear, $graduationTwelveYearListYearAgo) || !array_key_exists($graduationPeriodMonth, $allMonthList)) {
            // ????????????????????????2????????????10?????????????????????
            throw new BusinessException('cant_store_graduation_period');
        }
    }

    /**
     * ???????????????????????????????????????
     *
     * @param Member $member
     * @throws FatalBusinessException
     */
    private function sendEntryReceptionMail(Member $member)
    {
        // ????????????
        Log::infoIn();

        // ????????????URL??????
        $userAccount = $member->getUserAccount();
        $createdAt = $userAccount->getCreatedAt();
        $formattedCreatedAt = $createdAt->format("Y-m-d H:i:s");
        $pass = 'memberAccount';
        $encryptedCreatedAt = $userAccount->encrypt($formattedCreatedAt, $pass);
        $memberId = $member->getId();
        $encryptedId = $userAccount->encrypt($memberId, $pass);
        $urlEncodeCreatedAt = urlencode($encryptedCreatedAt);
        $urlEncodeId = urlencode($encryptedId);
        $completionURL = env('FRONT_APP_URL') . '/entry/complete?param=' . $urlEncodeCreatedAt . '&def=' . $urlEncodeId;
        $dataList["completionURL"] = $completionURL;
        $dataList["member"] = $member;
        $data = Data::wrap($dataList);
        $template = "mail.admin.member.entry_reception_mail";
        $title = "???LinkT??? ????????????????????????????????????????????????";
        $this->sendMail($userAccount, $template, $title, $data);

        // ????????????
        Log::infoOut();
    }

    /**
     * ???????????????????????????????????????
     *
     * @param Member $member
     * @throws FatalBusinessException
     */
    public function sendEntryCompleteMail(Member $member)
    {
        // ????????????
        Log::infoIn();

        $userAccount = $member->getUserAccount();
        $dataList["member"] = $member;
        $data = Data::wrap($dataList);
        $template = "mail.admin.member.entry_complete_mail";
        $title = "???LinkT??? ??????????????????????????????????????????";
        $this->sendMail($userAccount, $template, $title, $data);

        // ????????????
        Log::infoOut();
    }

    /**
     * ???????????????
     *
     * @param UserAccount $userAccount
     * @param string $template
     * @param string $title
     * @param Data $data
     * @return bool
     * @throws FatalBusinessException
     */
    public function sendMail(UserAccount $userAccount, string $template, string $title, Data $data)
    {
        // ????????????
        Log::infoIn();

        $mailAddress = $userAccount->getMailAddress();

        // ??????????????????????????????getInstance ??????(view???????????????????????????to???????????????(??????)?????????(??????)????????????)
        $mail = Mail::getInstance($template, $mailAddress, trans($title), $data);
        $result = $mail->send();
        if ($result !== true) {
            throw new FatalBusinessException("not_send_mail");
        }

        // ????????????
        Log::infoOut();

        return $result;
    }
}
