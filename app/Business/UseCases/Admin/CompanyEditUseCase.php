<?php

namespace App\Business\UseCases\Admin;

use App\Business\Interfaces\Gateways\Criteria\BusinessTypeSearchCriteria;
use App\Business\Interfaces\Gateways\Criteria\GeneralCriteria;
use App\Business\Interfaces\Gateways\Criteria\PrefectureSearchCriteria;
use App\Business\Interfaces\Gateways\Expression\Builders\GeneralExpressionBuilder;
use App\Business\Interfaces\Gateways\Repositories\CompanyAccountRepository;
use App\Business\Interfaces\Gateways\Repositories\CompanyRepository;
use App\Business\Interfaces\Gateways\Repositories\JobApplicationRepository;
use App\Business\Interfaces\Gateways\Repositories\PrefectureRepository;
use App\Business\Interfaces\Gateways\Repositories\BusinessTypeRepository;
use App\Business\Interfaces\Gateways\Repositories\CompanyUploadedFileRepository;
use App\Business\Interfaces\Gateways\Repositories\TagRepository;
use App\Business\Interfaces\Gateways\Repositories\UserAccountRepository;
use App\Business\Interfaces\Interactors\Admin\CompanyEdit\CompanyEditInitializeInputPort;
use App\Business\Interfaces\Interactors\Admin\CompanyEdit\CompanyEditInitializeInteractor;
use App\Business\Interfaces\Interactors\Admin\CompanyEdit\CompanyEditInitializeOutputPort;
use App\Business\Interfaces\Interactors\Admin\CompanyEdit\CompanyEditUpdateInputPort;
use App\Business\Interfaces\Interactors\Admin\CompanyEdit\CompanyEditUpdateInteractor;
use App\Business\Interfaces\Interactors\Admin\CompanyEdit\CompanyEditUpdateOutputPort;
use App\Business\Interfaces\Interactors\Client\CompanyBasicInformationEdit\CompanyBasicInformationEditStoreInputPort;
use App\Business\Services\ListCreateTrait;
use App\Domain\Entities\Company;
use App\Domain\Entities\CompanyAccount;
use App\Domain\Entities\Tag;
use App\Domain\Entities\CompanyUploadedFile;
use App\Domain\Entities\UserAccount;
use App\Utilities\Log;
use ReLab\Commons\Exceptions\BusinessException;
use ReLab\Commons\Exceptions\FatalBusinessException;
use ReLab\Commons\Exceptions\ObjectNotFoundException;
use ReLab\Commons\Utilities\File;
use ReLab\Commons\Wrappers\CriteriaFactory;
use ReLab\Commons\Wrappers\Data;

/**
 * Class CompanyEditUseCase
 *
 * @package App\Business\UseCases\Admin
 */
class CompanyEditUseCase implements CompanyEditInitializeInteractor, CompanyEditUpdateInteractor
{
    use ListCreateTrait;

    /**
     * @var PrefectureRepository
     */
    private $prefectureRepository;

    /**
     * @var BusinessTypeRepository
     */
    private $businessTypeRepository;

    /**
     * @var CompanyRepository
     */
    private $companyRepository;

    /**
     * @var companyAccountRepository
     */
    private $companyAccountRepository;

    /**
     * @var CompanyUploadedFileRepository
     */
    private $companyUploadedFileRepository;

    /**
     * @var TagRepository
     */
    private $tagRepository;

    /**
     * @var JobApplicationRepository
     */
    private $jobApplicationRepository;

    /**
     * @var UserAccountRepository
     */
    private $userAccountRepository;

    /**
     * CompanyRecruitingCreateUseCase constructor.
     *
     * @param PrefectureRepository $prefectureRepository
     * @param BusinessTypeRepository $businessTypeRepository
     * @param CompanyRepository $companyRepository
     * @param CompanyAccountRepository $companyAccountRepository
     * @param CompanyUploadedFileRepository $companyUploadedFileRepository
     * @param TagRepository $tagRepository
     * @param JobApplicationRepository $jobApplicationRepository
     * @param UserAccountRepository $userAccountRepository
     */
    public function __construct(
        PrefectureRepository $prefectureRepository,
        BusinessTypeRepository $businessTypeRepository,
        CompanyRepository $companyRepository,
        CompanyAccountRepository $companyAccountRepository,
        CompanyUploadedFileRepository $companyUploadedFileRepository,
        TagRepository $tagRepository,
        JobApplicationRepository $jobApplicationRepository,
        UserAccountRepository $userAccountRepository
    ) {
        $this->prefectureRepository = $prefectureRepository;
        $this->businessTypeRepository = $businessTypeRepository;
        $this->companyRepository = $companyRepository;
        $this->companyAccountRepository = $companyAccountRepository;
        $this->companyUploadedFileRepository = $companyUploadedFileRepository;
        $this->tagRepository = $tagRepository;
        $this->jobApplicationRepository = $jobApplicationRepository;
        $this->userAccountRepository = $userAccountRepository;
    }

    /**
     * ???????????????
     *
     * @param CompanyEditInitializeInputPort $inputPort
     * @param CompanyEditInitializeOutputPort $outputPort
     * @throws FatalBusinessException
     */
    public function initialize(CompanyEditInitializeInputPort $inputPort, CompanyEditInitializeOutputPort $outputPort): void
    {
        //????????????
        Log::infoIn();

        // ?????????????????????
        $outputPort->prefectureList = $this->createPrefectureList();

        // ???????????????
        $outputPort->businessTypeList = $this->createBusinessTypeList();

        // ?????????????????????ID?????????????????????
        try {
            $company = $this->companyRepository->findOneByCriteria(
                CriteriaFactory::getInstance()->create(GeneralCriteria::class, GeneralExpressionBuilder::class,
                    [
                        "id" => $inputPort->companyId
                    ]
                )
            );
        }catch (ObjectNotFoundException $e){
            throw new FatalBusinessException("data_not_found");
        }

        // ??????ID
        $outputPort->companyId = $company->getId();
        // ?????????
        $outputPort->name = $company->getName();
        // ?????????????????????
        $outputPort->nameKana = $company->getNameKana();
        // ????????????
        $outputPort->zip = $company->getZipCode();
        $prefecture = $company->getPrefecture();
        if (isset($prefecture)) {
            // ????????????
            $outputPort->prefectures = $prefecture->getId();
        }
        // ????????????
        $outputPort->city = $company->getCity();
        // ????????????????????????
        $outputPort->room = $company->getBlockNumber();
        // ??????
        $industryCondition = [];
        foreach ($company->getBusinessTypes() as $buisinessType) {
            $industryCondition[] = $buisinessType->getId();
        }
        $outputPort->industryCondition = $industryCondition;
        // ????????????
        $outputPort->descriptionOfBusiness = $company->getDescriptionOfBusiness();
        // ??????
        $outputPort->establishmentDate = $company->getEstablishmentDate();
        // ?????????
        $outputPort->capital = $company->getCapital();
        // ?????????
        $outputPort->payrollNumber = $company->getPayrollNumber();
        // ?????????
        $outputPort->sales = $company->getSales();
        // ?????????
        $outputPort->representativePerson = $company->getRepresentativePerson();
        // ????????????
        $outputPort->exectiveOfficers = $company->getExectiveOfficers();
        // ?????????
        $outputPort->establishment = $company->getEstablishment();
        // ????????????
        $outputPort->affiliatedCompany = $company->getAffiliatedCompany();
        // ???????????????
        $outputPort->qualification = $company->getQualification();
        // ??????????????????URL
        $outputPort->homePageUrl = $company->getHomePageUrl();
        // ????????????????????????
        $outputPort->recruitmentUrl = $company->getRecruitmentUrl();
        // ???????????????
        $outputPort->mainClient = $company->getMainClient();
        // ????????????
        $outputPort->uploadedLogo = $this->createFileData($company->getCompanyLogoImage());
        // ????????????
        $outputPort->picName = $company->getPicName();
        // ?????????????????????
        $outputPort->picPhoneNumber = $company->getPicPhoneNumber();
        // ???????????????????????????
        $outputPort->picEmergencyPhoneNumber = $company->getPicEmergencyPhoneNumber();
        // ??????????????????????????????
        $outputPort->picMailAddress = $company->getPicMailAddress();
        // ????????????
        $companyImages = [];
        foreach ($company->getCompanyImages() as $companyImage) {
            $companyImages[] = $this->createFileData($companyImage);
        }
        $outputPort->companyImages = $companyImages;
        // ???????????????
        $outputPort->introductorySentence = $company->getIntroductorySentence();
        // PR??????
        $outputPort->prVideo = $this->createFileData($company->getCompanyPrVideo());
        // 5?????????
        $outputPort->video5s = $this->createFileData($company->getShortLengthVideoFiveSeconds());
        // 5??????????????????????????????
        $outputPort->video5sThumb = $this->createFileData($company->getShortLengthVideoThumbnailFiveSeconds());
        // 10?????????
        $outputPort->video10s = $this->createFileData($company->getShortLengthVideoTenSeconds());
        // 10??????????????????????????????
        $outputPort->video10sThumb = $this->createFileData($company->getShortLengthVideoThumbnailTenSeconds());
        // 15?????????
        $outputPort->video15s = $this->createFileData($company->getShortLengthVideoFifteenSeconds());
        // 15??????????????????????????????
        $outputPort->video15sThumb = $this->createFileData($company->getShortLengthVideoThumbnailFifteenSeconds());
        // ???????????????
        $features = [];
        foreach ($company->getFeatures() as $companyIntroduction) {
            $features[] = $this->createFileData($companyIntroduction);
        }
        $outputPort->features = $features;
        $hashTag = $company->getHashtag();
        if (isset($hashTag)) {
            // ??????????????????
            $outputPort->hashtag = $hashTag->getName();
            // ???????????????????????????
            $outputPort->hashTagColor = $hashTag->getColor();
        }
        $recruitmentTags = $company->getRecruitmentTags();
        if (isset($recruitmentTags)) {
            foreach ($recruitmentTags as $recruitmentTag) {
                $tagName = $recruitmentTag->getName();
                switch ($tagName) {
                    case Tag::RECRUIT_TAG_LIST[Tag::THIS_YEAR]:
                        // ???????????????????????????
                        $outputPort->recruitmentTargetYear = true;
                        break;
                    case Tag::RECRUIT_TAG_LIST[Tag::NEXT_YEAR]:
                        // ???????????????????????????
                        $outputPort->recruitmentTargetThisYear = true;
                        break;
                    case Tag::RECRUIT_TAG_LIST[Tag::INTERN]:
                        // ???????????????
                        $outputPort->recruitmentTargetIntern = true;
                        break;
                }
            }
        }
        // ?????????????????????
        $outputPort->accountList = $this->createAccountList($company);

        // ????????????
        $outputPort->managementMemo = $company->getManagementMemo();

        // ???????????????
        $outputPort->status = $company->getStatus();

        // ????????????
        $outputPort->jobApplicationAvailableNumber = $company->getJobApplicationAvailableNumber();

        //????????????
        Log::infoOut();
    }

    /**
     * ????????????
     *
     * @param CompanyEditUpdateInputPort $inputPort
     * @param CompanyEditUpdateOutputPort $outputPort
     * @throws BusinessException
     */
    public function update(CompanyEditUpdateInputPort $inputPort, CompanyEditUpdateOutputPort $outputPort): void
    {
        //????????????
        Log::infoIn();

        // ?????????????????????ID?????????????????????
        $company = $this->companyRepository->findOneByCriteria(
            CriteriaFactory::getInstance()->create(GeneralCriteria::class, GeneralExpressionBuilder::class,
                [
                    "id" => $inputPort->companyId
                ]
            )
        );

        /** @var CompanyUploadedFile[] $newFiles */
        $newFiles = [];
        /** @var CompanyUploadedFile[] $deleteFiles */
        $deleteFiles = [];

        // ?????????????????????????????????????????????
        $prefectureRepository = $this->prefectureRepository;
        $businessTypeRepository = $this->businessTypeRepository;
        if(!$inputPort->companyImageNames) {
            $inputPort->companyImageNames = [];
        }
        Data::mappingToObject($inputPort, $company, [
            // ????????????
            "zip" => function ($value, $inputPort, $toObject) {
                /** @var Company $toObject */
                $toObject->setZipCode($value);
            },
            // ????????????
            "prefectures" => function ($value, $inputPort, $toObject) use ($prefectureRepository) {
                try {
                    $prefecture = $prefectureRepository->findOneByCriteria(
                        CriteriaFactory::getInstance()->create(PrefectureSearchCriteria::class, GeneralExpressionBuilder::class, ["id" => $value]));
                    /** @var Company $toObject */
                    $toObject->setPrefecture($prefecture);
                } catch (ObjectNotFoundException $e) {
                    throw new FatalBusinessException("select_target_not_found");
                }
            },
            // ????????????????????????
            "room" => function ($value, $inputPort, $toObject) {
                /** @var Company $toObject */
                $toObject->setBlockNumber($value);
            },
            // ??????
            "industryCondition" => function ($value, $inputPort, $toObject) use ($businessTypeRepository) {
                try {
                    $businessTypes = $businessTypeRepository->findByCriteria(
                        CriteriaFactory::getInstance()->create(BusinessTypeSearchCriteria::class, GeneralExpressionBuilder::class, ["id" => $value]));
                    /** @var Company $toObject */
                    $toObject->setBusinessTypes($businessTypes);
                } catch (ObjectNotFoundException $e) {
                    throw new FatalBusinessException("select_target_not_found");
                }
            },
            // ????????????
            "uploadedLogoName" => function ($value, $inputPort, $toObject) use (&$newFiles, &$deleteFiles) {
                /** @var string $value */
                /** @var CompanyBasicInformationEditStoreInputPort $inputPort */
                /** @var Company $toObject */
                $realPath = STORAGE_PUBLIC_DIR_PATH . DS . $inputPort->uploadedLogoPath;
                $newFile = false;
                $existFile = $toObject->getCompanyLogoImage();
                if (isset($existFile)) {
                    if (is_null($value)) {
                        $deleteFiles[] = $existFile;
                    } else {
                        if ($realPath != $existFile->getRealFilePath()) {
                            $deleteFiles[] = $existFile;
                            $newFile = true;
                        }
                    }
                } else {
                    if (isset($value)) {
                        $newFile = true;
                    }
                }

                if ($newFile && file_exists($realPath)) {
                    $physicalFileName = str_replace(STORAGE_PUBLIC_TEMP_DIR_PATH . DS, "", $realPath);
                    $uploadedFile = new CompanyUploadedFile();
                    $uploadedFile->setCompany($toObject);
                    $uploadedFile->setFileName($value);
                    $uploadedFile->setFilePath("company/" . $toObject->getId() . "/" . $physicalFileName);
                    $uploadedFile->setPhysicalFileName($physicalFileName);
                    $toObject->setCompanyLogoImage($uploadedFile);
                    $newFiles[$realPath] = $uploadedFile;
                }
            },
            // ????????????
            "companyImageNames" => function ($value, $inputPort, $toObject) use (&$newFiles, &$deleteFiles) {
                /** @var string $value */
                /** @var CompanyBasicInformationEditStoreInputPort $inputPort */
                /** @var Company $toObject */
                $existFiles = [];
                $companyImages = $toObject->getCompanyImages();
                foreach ($companyImages as $companyImage) {
                    $existFiles[$companyImage->getRealFilePath()] = $companyImage;
                }

                $names = $inputPort->companyImageNames;
                $paths = $inputPort->companyImagePaths;
                $checked = $inputPort->displayImage;
                $newCompanyImages = [];
                foreach ($names as $index => $name) {
                    if (isset($paths[$index])) {
                        $path = STORAGE_PUBLIC_DIR_PATH . DS . $paths[$index];
                        if (isset($existFiles[$path])) {
                            $existFiles[$path]->setSortNumber($index + 1);
                            $existFiles[$path]->setViewSelected($checked === strval($index));
                            unset($existFiles[$path]);
                        } else {
                            if (file_exists($path)) {
                                $physicalFileName = str_replace(STORAGE_PUBLIC_TEMP_DIR_PATH . DS, "", $path);
                                $uploadedFile = new CompanyUploadedFile();
                                $uploadedFile->setCompany($toObject);
                                $uploadedFile->setFileName($name);
                                $uploadedFile->setFilePath("company/" . $toObject->getId() . "/" . $physicalFileName);
                                $uploadedFile->setPhysicalFileName($physicalFileName);
                                $uploadedFile->setSortNumber($index + 1);
                                $uploadedFile->setViewSelected($checked === strval($index));
                                $newCompanyImages[] = $uploadedFile;
                                $newFiles[$path] = $uploadedFile;
                            }
                        }
                    }
                }
                $toObject->setCompanyImages($newCompanyImages);
                foreach ($existFiles as $existFile) {
                    $deleteFiles[] = $existFile;
                }
            },
            // PR??????
            "prVideoName" => function ($value, $inputPort, $toObject) use (&$newFiles, &$deleteFiles) {
                /** @var string $value */
                /** @var CompanyBasicInformationEditStoreInputPort $inputPort */
                /** @var Company $toObject */
                $realPath = STORAGE_PUBLIC_DIR_PATH . DS . $inputPort->prVideoPath;

                $newFile = false;
                $existFile = $toObject->getCompanyPrVideo();
                if (isset($existFile)) {
                    if (is_null($value)) {
                        $deleteFiles[] = $existFile;
                    } else {
                        if ($realPath != $existFile->getRealFilePath()) {
                            $deleteFiles[] = $existFile;
                            $newFile = true;
                        }
                    }
                } else {
                    if (isset($value)) {
                        $newFile = true;
                    }
                }

                if ($newFile && file_exists($realPath)) {
                    $physicalFileName = str_replace(STORAGE_PUBLIC_TEMP_DIR_PATH . DS, "", $realPath);
                    $uploadedFile = new CompanyUploadedFile();
                    $uploadedFile->setCompany($toObject);
                    $uploadedFile->setFileName($value);
                    $uploadedFile->setFilePath("company/" . $toObject->getId() . "/" . $physicalFileName);
                    $uploadedFile->setPhysicalFileName($physicalFileName);
                    $toObject->setCompanyPrVideo($uploadedFile);
                    $newFiles[$realPath] = $uploadedFile;
                }
            },
            // 5?????????
            "video5sName" => function ($value, $inputPort, $toObject) use (&$newFiles, &$deleteFiles) {
                /** @var string $value */
                /** @var CompanyBasicInformationEditStoreInputPort $inputPort */
                /** @var Company $toObject */
                $realPath = STORAGE_PUBLIC_DIR_PATH . DS . $inputPort->video5sPath;
                $video5sTitle = $inputPort->video5sTitle;

                $newFile = false;
                $existFile = $toObject->getShortLengthVideoFiveSeconds();
                if (isset($existFile)) {
                    $existTitle = $toObject->getShortLengthVideoFiveSeconds()->getTitle();

                    if (is_null($value)) {
                        $deleteFiles[] = $existFile;
                    } else {
                        if ($realPath != $existFile->getRealFilePath()) {
                            $deleteFiles[] = $existFile;
                            $newFile = true;
                        } else {
                            if ($realPath === $existFile->getRealFilePath() && $video5sTitle !== $existTitle) {
                                $uploadedFile = $this->companyUploadedFileRepository->findOneByCriteria(
                                    CriteriaFactory::getInstance()->create(GeneralCriteria::class, GeneralExpressionBuilder::class,
                                        [
                                            "company.id" => $inputPort->companyId,
                                            "contentType" => CompanyUploadedFile::FILE_TYPE_PR_SHORT_LENGTH_MOVIE_FIVE_SECONDS,
                                            "fileType" => CompanyUploadedFile::MOVIE_CONTENT,
                                        ]
                                    )
                                );
                                $uploadedFile->setTitle($video5sTitle);
                                $this->companyUploadedFileRepository->saveOrUpdate($uploadedFile, true);
                            }
                        }
                    }
                } else {
                    if (isset($value)) {
                        $newFile = true;
                    }
                }

                if ($newFile && file_exists($realPath)) {
                    $physicalFileName = str_replace(STORAGE_PUBLIC_TEMP_DIR_PATH . DS, "", $realPath);
                    $uploadedFile = new CompanyUploadedFile();
                    $uploadedFile->setCompany($toObject);
                    $uploadedFile->setFileName($value);
                    $uploadedFile->setFilePath("company/" . $toObject->getId() . "/" . $physicalFileName);
                    $uploadedFile->setPhysicalFileName($physicalFileName);
                    if (isset($video5sTitle)) {
                        $uploadedFile->setTitle($video5sTitle);
                    }
                    $toObject->setShortLengthVideoFiveSeconds($uploadedFile);
                    $newFiles[$realPath] = $uploadedFile;
                }
            },
            // 5??????????????????????????????
            "video5sThumbName" => function ($value, $inputPort, $toObject) use (&$newFiles, &$deleteFiles) {
                /** @var string $value */
                /** @var CompanyBasicInformationEditStoreInputPort $inputPort */
                /** @var Company $toObject */
                $realPath = STORAGE_PUBLIC_DIR_PATH . DS . $inputPort->video5sThumbPath;

                $newFile = false;
                $existFile = $toObject->getShortLengthVideoThumbnailFiveSeconds();
                if (isset($existFile)) {
                    if (is_null($value)) {
                        $deleteFiles[] = $existFile;
                    } else {
                        if ($realPath != $existFile->getRealFilePath()) {
                            $deleteFiles[] = $existFile;
                            $newFile = true;
                        }
                    }
                } else {
                    if (isset($value)) {
                        $newFile = true;
                    }
                }

                if ($newFile && file_exists($realPath)) {
                    $physicalFileName = str_replace(STORAGE_PUBLIC_TEMP_DIR_PATH . DS, "", $realPath);
                    $uploadedFile = new CompanyUploadedFile();
                    $uploadedFile->setCompany($toObject);
                    $uploadedFile->setFileName($value);
                    $uploadedFile->setFilePath("company/" . $toObject->getId() . "/" . $physicalFileName);
                    $uploadedFile->setPhysicalFileName($physicalFileName);
                    $toObject->setShortLengthVideoThumbnailFiveSeconds($uploadedFile);
                    $newFiles[$realPath] = $uploadedFile;
                }
            },
            // 10?????????
            "video10sName" => function ($value, $inputPort, $toObject) use (&$newFiles, &$deleteFiles) {
                /** @var string $value */
                /** @var CompanyBasicInformationEditStoreInputPort $inputPort */
                /** @var Company $toObject */
                $realPath = STORAGE_PUBLIC_DIR_PATH . DS . $inputPort->video10sPath;
                $video10sTitle = $inputPort->video10sTitle;

                $newFile = false;
                $existFile = $toObject->getShortLengthVideoTenSeconds();
                if (isset($existFile)) {
                    $existTitle = $toObject->getShortLengthVideoTenSeconds()->getTitle();

                    if (is_null($value)) {
                        $deleteFiles[] = $existFile;
                    } else {
                        if ($realPath != $existFile->getRealFilePath()) {
                            $deleteFiles[] = $existFile;
                            $newFile = true;
                        } else {
                            if ($realPath === $existFile->getRealFilePath() && $video10sTitle !== $existTitle) {
                                $uploadedFile = $this->companyUploadedFileRepository->findOneByCriteria(
                                    CriteriaFactory::getInstance()->create(GeneralCriteria::class, GeneralExpressionBuilder::class,
                                        [
                                            "company.id" => $inputPort->companyId,
                                            "contentType" => CompanyUploadedFile::FILE_TYPE_PR_SHORT_LENGTH_MOVIE_TEN_SECONDS,
                                            "fileType" => CompanyUploadedFile::MOVIE_CONTENT,
                                        ]
                                    )
                                );
                                $uploadedFile->setTitle($video10sTitle);
                                $this->companyUploadedFileRepository->saveOrUpdate($uploadedFile, true);
                            }
                        }
                    }
                } else {
                    if (isset($value)) {
                        $newFile = true;
                    }
                }

                if ($newFile && file_exists($realPath)) {
                    $physicalFileName = str_replace(STORAGE_PUBLIC_TEMP_DIR_PATH . DS, "", $realPath);
                    $uploadedFile = new CompanyUploadedFile();
                    $uploadedFile->setCompany($toObject);
                    $uploadedFile->setFileName($value);
                    $uploadedFile->setFilePath("company/" . $toObject->getId() . "/" . $physicalFileName);
                    $uploadedFile->setPhysicalFileName($physicalFileName);
                    if (isset($video10sTitle)) {
                        $uploadedFile->setTitle($video10sTitle);
                    }
                    $toObject->setShortLengthVideoTenSeconds($uploadedFile);
                    $newFiles[$realPath] = $uploadedFile;
                }
            },
            // 10??????????????????????????????
            "video10sThumbName" => function ($value, $inputPort, $toObject) use (&$newFiles, &$deleteFiles) {
                /** @var string $value */
                /** @var CompanyBasicInformationEditStoreInputPort $inputPort */
                /** @var Company $toObject */
                $realPath = STORAGE_PUBLIC_DIR_PATH . DS . $inputPort->video10sThumbPath;

                $newFile = false;
                $existFile = $toObject->getShortLengthVideoThumbnailTenSeconds();
                if (isset($existFile)) {
                    if (is_null($value)) {
                        $deleteFiles[] = $existFile;
                    } else {
                        if ($realPath != $existFile->getRealFilePath()) {
                            $deleteFiles[] = $existFile;
                            $newFile = true;
                        }
                    }
                } else {
                    if (isset($value)) {
                        $newFile = true;
                    }
                }

                if ($newFile && file_exists($realPath)) {
                    $physicalFileName = str_replace(STORAGE_PUBLIC_TEMP_DIR_PATH . DS, "", $realPath);
                    $uploadedFile = new CompanyUploadedFile();
                    $uploadedFile->setCompany($toObject);
                    $uploadedFile->setFileName($value);
                    $uploadedFile->setFilePath("company/" . $toObject->getId() . "/" . $physicalFileName);
                    $uploadedFile->setPhysicalFileName($physicalFileName);
                    $toObject->setShortLengthVideoThumbnailTenSeconds($uploadedFile);
                    $newFiles[$realPath] = $uploadedFile;
                }
            },
            // 15?????????
            "video15sName" => function ($value, $inputPort, $toObject) use (&$newFiles, &$deleteFiles) {
                /** @var string $value */
                /** @var CompanyBasicInformationEditStoreInputPort $inputPort */
                /** @var Company $toObject */
                $realPath = STORAGE_PUBLIC_DIR_PATH . DS . $inputPort->video15sPath;
                $video15sTitle = $inputPort->video15sTitle;

                $newFile = false;
                $existFile = $toObject->getShortLengthVideoFifteenSeconds();
                if (isset($existFile)) {
                    $existTitle = $toObject->getShortLengthVideoFifteenSeconds()->getTitle();

                    if (is_null($value)) {
                        $deleteFiles[] = $existFile;
                    } else {
                        if ($realPath != $existFile->getRealFilePath()) {
                            $deleteFiles[] = $existFile;
                            $newFile = true;
                        } else {
                            if ($realPath === $existFile->getRealFilePath() && $video15sTitle !== $existTitle) {
                                $uploadedFile = $this->companyUploadedFileRepository->findOneByCriteria(
                                    CriteriaFactory::getInstance()->create(GeneralCriteria::class, GeneralExpressionBuilder::class,
                                        [
                                            "company.id" => $inputPort->companyId,
                                            "contentType" => CompanyUploadedFile::FILE_TYPE_PR_SHORT_LENGTH_MOVIE_FIFTEEN_SECONDS,
                                            "fileType" => CompanyUploadedFile::MOVIE_CONTENT,
                                        ]
                                    )
                                );
                                $uploadedFile->setTitle($video15sTitle);
                                $this->companyUploadedFileRepository->saveOrUpdate($uploadedFile, true);
                            }
                        }
                    }
                } else {
                    if (isset($value)) {
                        $newFile = true;
                    }
                }

                if ($newFile && file_exists($realPath)) {
                    $physicalFileName = str_replace(STORAGE_PUBLIC_TEMP_DIR_PATH . DS, "", $realPath);
                    $uploadedFile = new CompanyUploadedFile();
                    $uploadedFile->setCompany($toObject);
                    $uploadedFile->setFileName($value);
                    $uploadedFile->setFilePath("company/" . $toObject->getId() . "/" . $physicalFileName);
                    $uploadedFile->setPhysicalFileName($physicalFileName);
                    if (isset($video15sTitle)) {
                        $uploadedFile->setTitle($video15sTitle);
                    }
                    $toObject->setShortLengthVideoFifteenSeconds($uploadedFile);
                    $newFiles[$realPath] = $uploadedFile;
                }
            },
            // 15??????????????????????????????
            "video15sThumbName" => function ($value, $inputPort, $toObject) use (&$newFiles, &$deleteFiles) {
                /** @var string $value */
                /** @var CompanyBasicInformationEditStoreInputPort $inputPort */
                /** @var Company $toObject */
                $realPath = STORAGE_PUBLIC_DIR_PATH . DS . $inputPort->video15sThumbPath;

                $newFile = false;
                $existFile = $toObject->getShortLengthVideoThumbnailFifteenSeconds();
                if (isset($existFile)) {
                    if (is_null($value)) {
                        $deleteFiles[] = $existFile;
                    } else {
                        if ($realPath != $existFile->getRealFilePath()) {
                            $deleteFiles[] = $existFile;
                            $newFile = true;
                        }
                    }
                } else {
                    if (isset($value)) {
                        $newFile = true;
                    }
                }

                if ($newFile && file_exists($realPath)) {
                    $physicalFileName = str_replace(STORAGE_PUBLIC_TEMP_DIR_PATH . DS, "", $realPath);
                    $uploadedFile = new CompanyUploadedFile();
                    $uploadedFile->setCompany($toObject);
                    $uploadedFile->setFileName($value);
                    $uploadedFile->setFilePath("company/" . $toObject->getId() . "/" . $physicalFileName);
                    $uploadedFile->setPhysicalFileName($physicalFileName);
                    $toObject->setShortLengthVideoThumbnailFifteenSeconds($uploadedFile);
                    $newFiles[$realPath] = $uploadedFile;
                }
            },
            // ???????????????
            "featureNames" => function ($value, $inputPort, $toObject) use (&$newFiles, &$deleteFiles) {
                /** @var string $value */
                /** @var CompanyBasicInformationEditStoreInputPort $inputPort */
                /** @var Company $toObject */
                $existFiles = [];
                $companyIntroductions = $toObject->getCompanyUploadedFiles();
                foreach ($companyIntroductions as $companyIntroduction) {
                    $contentType = $companyIntroduction->getContentType();
                    if ($contentType === CompanyUploadedFile::FILE_TYPE_INTRODUCTION) {
                        $existFiles[$companyIntroduction->getRealFilePath()] = $companyIntroduction;
                    }
                }

                $names = $inputPort->featureNames;
                $paths = $inputPort->featurePaths;
                $titles = $inputPort->featureTitles;
                $descriptions = $inputPort->featureDescriptions;
                $newCompanyIntroductions = [];
                foreach ($names as $index => $name) {
                    if (isset($paths[$index])) {
                        $path = STORAGE_PUBLIC_DIR_PATH . DS . $paths[$index];
                        if (isset($existFiles[$path])) {
                            $existFiles[$path]->setSortNumber($index + 1);
                            if (isset($titles) && isset($titles[$index])) {
                                $existFiles[$path]->setTitle($titles[$index]);
                            }
                            if (isset($descriptions) && isset($descriptions[$index])) {
                                $existFiles[$path]->setDescription($descriptions[$index]);
                            }
                            unset($existFiles[$path]);
                        } else {
                            if (file_exists($path)) {
                                $physicalFileName = str_replace(STORAGE_PUBLIC_TEMP_DIR_PATH . DS, "", $path);
                                $uploadedFile = new CompanyUploadedFile();
                                $uploadedFile->setCompany($toObject);
                                $uploadedFile->setFileName($name);
                                $uploadedFile->setFilePath("company/" . $toObject->getId() . "/" . $physicalFileName);
                                $uploadedFile->setPhysicalFileName($physicalFileName);
                                $uploadedFile->setSortNumber($index + 1);
                                if (isset($titles) && isset($titles[$index])) {
                                    $uploadedFile->setTitle($titles[$index]);
                                }
                                if (isset($descriptions) && isset($descriptions[$index])) {
                                    $uploadedFile->setDescription($descriptions[$index]);
                                }
                                $newCompanyIntroductions[] = $uploadedFile;
                                $newFiles[$path] = $uploadedFile;
                            }
                        }
                    }
                }
                $toObject->setFeatures($newCompanyIntroductions);
                foreach ($existFiles as $existFile) {
                    $deleteFiles[] = $existFile;
                }
            },
            // ??????????????????
            "hashtag" => function ($value, $inputPort, $toObject) use ($businessTypeRepository) {
                /** @var Company $toObject */
                $hashTag = $toObject->getHashTag();
                if (is_null($hashTag)) {
                    $hashTag = new Tag();
                    $hashTag->setFixingFlag(Tag::HASH_TAG);
                }
                $hashTag->setName($value);
                $hashTag->setColor($inputPort->hashTagColor);
                $toObject->setHashTag($hashTag);
            },
        ]);

        // ?????????????????????????????????????????????????????????????????????
        if (is_null($inputPort->featureNames)) {
            $companyIntroductions = $company->getFeatures();
            foreach ($companyIntroductions as $companyIntroduction) {
                $deleteFiles[] = $companyIntroduction;
            }
        }

        // ????????????
        $recruitmentTags = [];
        $existTags = [];
        $existRecruitmentTags = $company->getRecruitmentTags();
        foreach ($existRecruitmentTags as $existRecruitmentTag) {
            $existTags[$existRecruitmentTag->getName()] = $existRecruitmentTag;
        }
        $recruitmentTargetYear = $inputPort->recruitmentTargetYear;
        if ($recruitmentTargetYear === '1') {
            if (isset($existTags[Tag::RECRUIT_TAG_LIST[Tag::THIS_YEAR]])) {
                $recruitmentTags[] = $existTags[Tag::RECRUIT_TAG_LIST[Tag::THIS_YEAR]];
                unset($existTags[Tag::RECRUIT_TAG_LIST[Tag::THIS_YEAR]]);
            } else {
                $recruitmentTags[] = $this->createRecruitmentTags(Tag::THIS_YEAR, $company);
            }
        }
        $recruitmentTargetThisYear = $inputPort->recruitmentTargetThisYear;
        if ($recruitmentTargetThisYear === '1') {
            if (isset($existTags[Tag::RECRUIT_TAG_LIST[Tag::NEXT_YEAR]])) {
                $recruitmentTags[] = $existTags[Tag::RECRUIT_TAG_LIST[Tag::NEXT_YEAR]];
                unset($existTags[Tag::RECRUIT_TAG_LIST[Tag::NEXT_YEAR]]);
            } else {
                $recruitmentTags[] = $this->createRecruitmentTags(Tag::NEXT_YEAR, $company);
            }
        }
        $recruitmentTargetIntern = $inputPort->recruitmentTargetIntern;
        if ($recruitmentTargetIntern === '1') {
            if (isset($existTags[Tag::RECRUIT_TAG_LIST[Tag::INTERN]])) {
                $recruitmentTags[] = $existTags[Tag::RECRUIT_TAG_LIST[Tag::INTERN]];
                unset($existTags[Tag::RECRUIT_TAG_LIST[Tag::INTERN]]);
            } else {
                $recruitmentTags[] = $this->createRecruitmentTags(Tag::INTERN, $company);
            }
        }
        $company->setRecruitmentTags($recruitmentTags);

        // ????????????
        $this->companyRepository->saveOrUpdate($company, true);

        // ????????????
        $this->tagRepository->delete($existTags);

        // ????????????????????????????????????
        $this->companyUploadedFileRepository->delete($deleteFiles);

        foreach ($newFiles as $path => $file) {
            File::createDir($file->getRealFileDir());
            File::rename($path, $file->getRealFilePath());
        }

        foreach ($deleteFiles as $file) {
            File::remove($file->getRealFilePath());
        }

        // ?????????????????????
        $companyAccounts = $company->getCompanyAccounts();
        foreach ($companyAccounts as $companyAccount) {
            $userAccount = $companyAccount->getUserAccount();
            $beforeMailAddress = $userAccount->getMailAddress();
            Data::mappingToObject($inputPort,$userAccount);
            Data::mappingToObject($inputPort,$companyAccount);
            $companyAccount->setRepresentativeSetting(10);
            $userAccount->setCompanyAccount($companyAccount);
            $companyAccount->setUserAccount($userAccount);
            $companyAccount->setCompany($company);
        }

        // ???????????????????????????????????????
        $this->checkDuplicateMailAddress($beforeMailAddress, $inputPort->mailAddress, $company->getId());

        $this->companyAccountRepository->saveOrUpdate($companyAccount, true);

        // ??????ID
        $outputPort->companyId = $company->getId();

        //????????????
        Log::infoOut();
    }

    /**
     * ??????????????????
     *
     * @param int $type
     * @param Company $company
     * @return Tag
     */
    private function createRecruitmentTags(int $type, Company $company): Tag
    {
        $recruitmentTag = new Tag();
        $recruitmentTag->setCompany($company);
        $recruitmentTag->setFixingFlag(Tag::RECRUIT_TAG);
        $recruitmentTag->setName(Tag::RECRUIT_TAG_LIST[$type]);
        return $recruitmentTag;
    }

    /**
     * ?????????????????????????????????????????????
     *
     * @param CompanyUploadedFile|null $uploadedFile
     * @return array
     */
    private function createFileData(?CompanyUploadedFile $uploadedFile): array
    {
        $result = [];
        if (isset($uploadedFile)) {
            $result = [
                "name" => $uploadedFile->getFileName(),
                "url" => $uploadedFile->getFilePathForClientShow(),
                "path" => $uploadedFile->getFilePath(),
                "checked" => $uploadedFile->getViewSelected(),
                "title" => $uploadedFile->getTitle(),
                "description" => $uploadedFile->getDescription(),
                "type" => $uploadedFile->getFileType(),
            ];
        }
        return $result;
    }

    /**
     * ??????????????????????????????
     *
     * @param Company $company
     * @return array
     */
    private function createAccountList(Company $company): array
    {
        $result = [];
        $companyAccounts = $company->getCompanyAccounts();
        foreach ($companyAccounts as $companyAccount) {
            $userAccount = $companyAccount->getUserAccount();

            $lastLoginDatetime = $userAccount->getLastLoginDateTime();
            if (!empty($lastLoginDatetime)) {
                $lastLoginDatetime = date("Y/m/d H:i", strtotime($lastLoginDatetime));
                $lastLoginDatetime = $lastLoginDatetime . ' ??????????????????';
            } else {
                $lastLoginDatetime = '???????????????';
            }

            $result[] = [
                'firstName' => $companyAccount->getFirstName(),
                'lastName' => $companyAccount->getLastName(),
                'firstNameKana' => $companyAccount->getFirstNameKana(),
                'lastNameKana' => $companyAccount->getLastNameKana(),
                'mailaddress' => $userAccount->getMailAddress(),
                'password' => $userAccount->getPassword(),
                'lastLoginDatetime' => $lastLoginDatetime
            ];
        }
        return $result;
    }

    /**
     * ???????????????????????????????????????????????????
     *
     * @param string $beforeMailAddress
     * @param string $mailAddress
     * @param int $userAccountId
     * @throws BusinessException
     */
    private function checkDuplicateMailAddress(string $beforeMailAddress, string $mailAddress, int $userAccountId)
    {
        $userAccountSameMailAddress = $this->userAccountRepository->findByCriteria(
            CriteriaFactory::getInstance()->create(GeneralCriteria::class, GeneralExpressionBuilder::class,
                [
                    "mailAddress" => $mailAddress
                ]
            )
        );
        if (count($userAccountSameMailAddress) > 0) {
            foreach ($userAccountSameMailAddress as $userAccount) {
                if (($userAccount->getCompanyAccount() !== null && $userAccount->getId() !== $userAccountId && $userAccount->getCompanyAccount()->getDeletedAt() === null) && $mailAddress !== $beforeMailAddress)
                {
                    // ????????????????????????????????????????????????????????????????????????????????????
                    throw new BusinessException('duplication.mail_address');
                }
            }
        }
    }
}
