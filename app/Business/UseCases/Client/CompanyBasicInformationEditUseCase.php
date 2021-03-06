<?php

namespace App\Business\UseCases\Client;

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
use App\Business\Interfaces\Interactors\Client\CompanyBasicInformationEdit\CompanyBasicInformationEditInitializeInteractor;
use App\Business\Interfaces\Interactors\Client\CompanyBasicInformationEdit\CompanyBasicInformationEditInitializeInputPort;
use App\Business\Interfaces\Interactors\Client\CompanyBasicInformationEdit\CompanyBasicInformationEditInitializeOutputPort;
use App\Business\Interfaces\Interactors\Client\CompanyBasicInformationEdit\CompanyBasicInformationEditPreviewInputPort;
use App\Business\Interfaces\Interactors\Client\CompanyBasicInformationEdit\CompanyBasicInformationEditPreviewInteractor;
use App\Business\Interfaces\Interactors\Client\CompanyBasicInformationEdit\CompanyBasicInformationEditPreviewOutputPort;
use App\Business\Interfaces\Interactors\Client\CompanyBasicInformationEdit\CompanyBasicInformationEditStoreInputPort;
use App\Business\Interfaces\Interactors\Client\CompanyBasicInformationEdit\CompanyBasicInformationEditStoreInteractor;
use App\Business\Interfaces\Interactors\Client\CompanyBasicInformationEdit\CompanyBasicInformationEditStoreOutputPort;
use App\Business\Services\ListCreateTrait;
use App\Business\Services\UseLoggedInCompanyAccountTrait;
use App\Domain\Entities\Company;
use App\Domain\Entities\CompanyAccount;
use App\Domain\Entities\JobApplication;
use App\Domain\Entities\Tag;
use App\Domain\Entities\CompanyUploadedFile;
use App\Utilities\Log;
use ReLab\Commons\Exceptions\FatalBusinessException;
use ReLab\Commons\Exceptions\ObjectNotFoundException;
use ReLab\Commons\Utilities\File;
use ReLab\Commons\Wrappers\CriteriaFactory;
use ReLab\Commons\Wrappers\Data;

/**
 * Class CompanyBasicInformationEditUseCase
 *
 * @package App\Business\UseCases\Client
 */
class CompanyBasicInformationEditUseCase implements CompanyBasicInformationEditInitializeInteractor, CompanyBasicInformationEditStoreInteractor, CompanyBasicInformationEditPreviewInteractor
{
    use  UseLoggedInCompanyAccountTrait, ListCreateTrait;

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
     * CompanyRecruitingCreateUseCase constructor.
     *
     * @param PrefectureRepository $prefectureRepository
     * @param BusinessTypeRepository $businessTypeRepository
     * @param CompanyRepository $companyRepository
     * @param CompanyAccountRepository $companyAccountRepository
     * @param CompanyUploadedFileRepository $companyUploadedFileRepository
     * @param TagRepository $tagRepository
     * @param JobApplicationRepository $jobApplicationRepository
     */
    public function __construct(
        PrefectureRepository $prefectureRepository,
        BusinessTypeRepository $businessTypeRepository,
        CompanyRepository $companyRepository,
        CompanyAccountRepository $companyAccountRepository,
        CompanyUploadedFileRepository $companyUploadedFileRepository,
        TagRepository $tagRepository,
        JobApplicationRepository $jobApplicationRepository
    ) {
        $this->prefectureRepository = $prefectureRepository;
        $this->businessTypeRepository = $businessTypeRepository;
        $this->companyRepository = $companyRepository;
        $this->companyAccountRepository = $companyAccountRepository;
        $this->companyUploadedFileRepository = $companyUploadedFileRepository;
        $this->tagRepository = $tagRepository;
        $this->jobApplicationRepository = $jobApplicationRepository;
    }

    /**
     * ???????????????
     *
     * @param CompanyBasicInformationEditInitializeInputPort $inputPort
     * @param CompanyBasicInformationEditInitializeOutputPort $outputPort
     */
    public function initialize(CompanyBasicInformationEditInitializeInputPort $inputPort, CompanyBasicInformationEditInitializeOutputPort $outputPort): void
    {
        //????????????
        Log::infoIn();

        // ?????????????????????
        $outputPort->prefectureList = $this->createPrefectureList();

        // ???????????????
        $outputPort->businessTypeList = $this->createBusinessTypeList();

        // ???????????????????????????????????????ID?????????????????????
        $inputPort->loggedInCompanyAccountId;
        $companyAccount = $this->getLoggedInCompanyAccount($inputPort);
        $company = $companyAccount->getCompany();

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

        //????????????
        Log::infoOut();
    }

    /**
     * ??????????????????
     *
     * @param CompanyBasicInformationEditStoreInputPort $inputPort
     * @param CompanyBasicInformationEditStoreOutputPort $outputPort
     */
    public function store(CompanyBasicInformationEditStoreInputPort $inputPort, CompanyBasicInformationEditStoreOutputPort $outputPort): void
    {
        //????????????
        Log::infoIn();

        // ?????????????????????
        $outputPort->prefectureList = $this->createPrefectureList();

        // ???????????????
        $outputPort->businessTypeList = $this->createBusinessTypeList();

        // ???????????????????????????????????????ID?????????????????????
        $inputPort->loggedInCompanyAccountId;
        $companyAccount = $this->getLoggedInCompanyAccount($inputPort);
        $company = $companyAccount->getCompany();

        /** @var CompanyUploadedFile[] $newFiles */
        $newFiles = [];
        /** @var CompanyUploadedFile[] $deleteFiles */
        $deleteFiles = [];

        // ?????????????????????????????????????????????
        $prefectureRepository = $this->prefectureRepository;
        $businessTypeRepository = $this->businessTypeRepository;
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
                                $inputPort->loggedInCompanyAccountId;
                                $companyAccount = $this->getLoggedInCompanyAccount($inputPort);
                                $companyId = $companyAccount->getCompany()->getId();

                                $uploadedFile = $this->companyUploadedFileRepository->findOneByCriteria(
                                    CriteriaFactory::getInstance()->create(GeneralCriteria::class, GeneralExpressionBuilder::class,
                                        [
                                            "company.id" => $companyId,
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
                                $inputPort->loggedInCompanyAccountId;
                                $companyAccount = $this->getLoggedInCompanyAccount($inputPort);
                                $companyId = $companyAccount->getCompany()->getId();

                                $uploadedFile = $this->companyUploadedFileRepository->findOneByCriteria(
                                    CriteriaFactory::getInstance()->create(GeneralCriteria::class, GeneralExpressionBuilder::class,
                                        [
                                            "company.id" => $companyId,
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
                                $inputPort->loggedInCompanyAccountId;
                                $companyAccount = $this->getLoggedInCompanyAccount($inputPort);
                                $companyId = $companyAccount->getCompany()->getId();

                                $uploadedFile = $this->companyUploadedFileRepository->findOneByCriteria(
                                    CriteriaFactory::getInstance()->create(GeneralCriteria::class, GeneralExpressionBuilder::class,
                                        [
                                            "company.id" => $companyId,
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

        //????????????
        Log::infoOut();
    }

    /**
     * ????????????????????????
     *
     * @param CompanyBasicInformationEditPreviewInputPort $inputPort
     * @param CompanyBasicInformationEditPreviewOutputPort $outputPort
     */
    public function preview(CompanyBasicInformationEditPreviewInputPort $inputPort, CompanyBasicInformationEditPreviewOutputPort $outputPort): void
    {
        //????????????
        Log::infoIn();

        // ???????????????????????????????????????ID?????????????????????
        $inputPort->loggedInCompanyAccountId;
        $companyAccount = $this->getLoggedInCompanyAccount($inputPort);
        $company = $companyAccount->getCompany();

        // ?????????????????????????????????????????????ID??????
        $companyAccounts = $company->getCompanyAccounts();
        foreach ($companyAccounts as $companyAccount) {
            $representativeSetting = $companyAccount->getRepresentativeSetting();
            if ($representativeSetting === CompanyAccount::REPRESENTATIVE) {
                $companyUserAccountId = $companyAccount->getUserAccount()->getId();
            }
        }

        // ??????????????????
        $introductorySentence = $company->getIntroductorySentence();
        $outputPort->introductorySentence = $introductorySentence;

        // ??????????????????
        $companyLogoImage = $company->getCompanyLogoImage();
        if(!is_null($companyLogoImage)){
            $companyLogoFilePath = $companyLogoImage->getFilePathForFrontShow();
        }else{
            $companyLogoFilePath = asset('/img/common/no_image_logo.png');
        }

        $outputPort->companyLogoFilePath = $companyLogoFilePath;

        // ??????????????????
        $recruitTagList = [];
        $recruitmentTags = $company->getRecruitmentTags();
        foreach ($recruitmentTags as $recruitmentTag) {
            $recruitmentTagName = $recruitmentTag->getName();
            $recruitTagList[] = $recruitmentTagName;
        }
        $outputPort->recruitTagList = $recruitTagList;

        // ????????????????????????
        $hashTag = $company->getHashTag();
        $hashTagName = $hashTag->getName();
        $hashTagColor = Tag::TAG_COLLAR_CLASS_LIST[$hashTag->getColor()];
        $outputPort->hashTagName = $hashTagName;
        $outputPort->hashTagColor = $hashTagColor;

        // ??????PR???????????????
        $companyPrVideo = $company->getCompanyPrVideo();
        if (isset($companyPrVideo)) {
            $companyPrVideoFilePath = $companyPrVideo->getFilePathForFrontShow();
            $outputPort->companyPrVideoFilePath = $companyPrVideoFilePath;
        } else {
            // PR?????????????????????????????????????????????
            $companyImages = $company->getCompanyImages();
            $companyImageFilePathList = [];
            foreach ($companyImages as $companyImag) {
                $companyImageFilePath = $companyImag->getFilePathForFrontShow();
                $companyImageFilePathList[] = $companyImageFilePath;
            }
            $outputPort->companyImageFilePathList = $companyImageFilePathList;
        }

        $shortLengthVideos = [];
        $shortLengthVideoThumbnails = [];
        // ??????5???????????????
        $ShortLengthVideoFiveSeconds = $company->getShortLengthVideoFiveSeconds();
        if (isset($ShortLengthVideoFiveSeconds)) {
            $shortLengthVideoFiveSecondsFilePath = $ShortLengthVideoFiveSeconds->getFilePathForFrontShow();
            $shortLengthVideos['five'] = $shortLengthVideoFiveSecondsFilePath;

            // ??????5???????????????????????????
            $ShortLengthVideoFiveSecondsTitle = $ShortLengthVideoFiveSeconds->getTitle();
            if (isset($ShortLengthVideoFiveSecondsTitle)) {
                $shortLength5sVideoTitle = $ShortLengthVideoFiveSecondsTitle;
            } else {
                $shortLength5sVideoTitle = null;
            }
            $outputPort->shortLength5sVideoTitle = $shortLength5sVideoTitle;

            // ??????5??????????????????????????????
            $ShortLengthVideoThumbnailFiveSeconds = $company->getShortLengthVideoThumbnailFiveSeconds();
            if (isset($ShortLengthVideoThumbnailFiveSeconds)) {
                $shortLengthVideoThumbnailFiveSecondsFilePath = $ShortLengthVideoThumbnailFiveSeconds->getFilePathForFrontShow();
                $shortLength5sVideoThumbnail = $shortLengthVideoThumbnailFiveSecondsFilePath;
            } else {
                $shortLength5sVideoThumbnail = null;
            }
            $outputPort->shortLength5sVideoThumbnail = $shortLength5sVideoThumbnail;
        }

        // ??????10???????????????
        $ShortLengthVideoTenSeconds = $company->getShortLengthVideoTenSeconds();
        if (isset($ShortLengthVideoTenSeconds)) {
            $shortLengthVideoTenSecondsFilePath = $ShortLengthVideoTenSeconds->getFilePathForFrontShow();
            $shortLengthVideos['ten'] = $shortLengthVideoTenSecondsFilePath;

            // ??????10???????????????????????????
            $ShortLengthVideoTenSecondsTitle = $ShortLengthVideoTenSeconds->getTitle();
            if (isset($ShortLengthVideoTenSecondsTitle)) {
                $shortLength10sVideoTitle = $ShortLengthVideoTenSecondsTitle;
            } else {
                $shortLength10sVideoTitle = null;
            }
            $outputPort->shortLength10sVideoTitle = $shortLength10sVideoTitle;

            // ??????10??????????????????????????????
            $ShortLengthVideoThumbnailTenSeconds = $company->getShortLengthVideoThumbnailTenSeconds();
            if (isset($ShortLengthVideoThumbnailTenSeconds)) {
                $shortLengthVideoThumbnailTenSecondsFilePath = $ShortLengthVideoThumbnailTenSeconds->getFilePathForFrontShow();
                $shortLength10sVideoThumbnail = $shortLengthVideoThumbnailTenSecondsFilePath;
            } else {
                $shortLength10sVideoThumbnail = null;
            }
            $outputPort->shortLength10sVideoThumbnail = $shortLength10sVideoThumbnail;
        }

        // ??????15???????????????
        $ShortLengthVideoFifteenSeconds = $company->getShortLengthVideoFifteenSeconds();
        if (isset($ShortLengthVideoFifteenSeconds)) {
            $shortLengthVideoFifteenSecondsFilePath = $ShortLengthVideoFifteenSeconds->getFilePathForFrontShow();
            $shortLengthVideos['fifteen'] = $shortLengthVideoFifteenSecondsFilePath;

            // ??????15???????????????????????????
            $ShortLengthVideoFifteenSecondsTitle = $ShortLengthVideoFifteenSeconds->getTitle();
            if (isset($ShortLengthVideoFifteenSecondsTitle)) {
                $shortLength15sVideoTitle = $ShortLengthVideoFifteenSecondsTitle;
            } else {
                $shortLength15sVideoTitle = null;
            }
            $outputPort->shortLength15sVideoTitle = $shortLength15sVideoTitle;

            // ??????15??????????????????????????????
            $ShortLengthVideoThumbnailFifteenSeconds = $company->getShortLengthVideoThumbnailFifteenSeconds();
            if (isset($ShortLengthVideoThumbnailFifteenSeconds)) {
                $shortLengthVideoThumbnailFifteenSecondsFilePath = $ShortLengthVideoThumbnailFifteenSeconds->getFilePathForFrontShow();
                $shortLength15sVideoThumbnail = $shortLengthVideoThumbnailFifteenSecondsFilePath;
            } else {
                $shortLength15sVideoThumbnail = null;
            }
            $outputPort->shortLength15sVideoThumbnail = $shortLength15sVideoThumbnail;
        }

        $outputPort->shortLengthVideos = $shortLengthVideos;

        // ??????????????????
        $criteriaFactory = CriteriaFactory::getInstance();
        $jobApplications = $this->jobApplicationRepository->findByCriteria(
            $criteriaFactory->create(GeneralCriteria::class, GeneralExpressionBuilder::class,
                [
                    "company.id" => $company->getId()
                ]
            )
        );
        $displayJobApplications = [];
        foreach ($jobApplications as $jobApplication) {
            if ($jobApplication->getStatus() === JobApplication::STATUS_DISPLAY) {
                $displayJobApplications[] = $jobApplication;
            }
        }
        $outputPort->jobApplications = null;
        if (!empty($displayJobApplications)) {
            $outputPort->jobApplications = $displayJobApplications;
        }
        $outputPort->employmentTypeList = JobApplication::EMPLOYMENT_TYPE_LIST;

        // ?????????????????????
        $companyIntroductions = $company->getFeatures();
        $companyIntroductionList = [];
        foreach ($companyIntroductions as $companyIntroduction) {
            if (isset($companyIntroduction)) {
                $title = $companyIntroduction->getTitle();
                $description = $companyIntroduction->getDescription();
                $companyIntroductionFilePath = $companyIntroduction->getFilePathForFrontShow();
                $companyIntroductionList["title"] = $title;
                $companyIntroductionList["description"] = $description;
                $companyIntroductionList["filePath"] = $companyIntroductionFilePath;
                $companyIntroductionListsList[] = $companyIntroductionList;
            }
            $outputPort->companyIntroductionListsList = $companyIntroductionListsList;
        }

        // ??????????????????
        $outputPort->name = $company->getName();
        $outputPort->descriptionOfBusiness = $company->getDescriptionOfBusiness();
        $outputPort->establishmentDate = $company->getEstablishmentDate();
        $outputPort->capital = $company->getCapital();
        $outputPort->representativePerson = $company->getRepresentativePerson();
        $outputPort->exectiveOfficers = $company->getExectiveOfficers();
        $outputPort->establishment = $company->getEstablishment();
        $outputPort->affiliatedCompany = $company->getAffiliatedCompany();
        $outputPort->qualification = $company->getQualification();
        $outputPort->homePageUrl = $company->getHomePageUrl();
        $outputPort->recruitmentUrl = $company->getRecruitmentUrl();
        $outputPort->mainClient = $company->getMainClient();

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
                'name' => $companyAccount->getLastName() . '???' . $companyAccount->getFirstName(),
                'mailaddress' => $userAccount->getMailAddress(),
                'lastLoginDatetime' => $lastLoginDatetime
            ];

        }

        return $result;
    }
}
