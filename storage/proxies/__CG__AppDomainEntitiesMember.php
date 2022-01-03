<?php

namespace DoctrineProxies\__CG__\App\Domain\Entities;

/**
 * DO NOT EDIT THIS FILE - IT WAS CREATED BY DOCTRINE'S PROXY GENERATOR
 */
class Member extends \App\Domain\Entities\Member implements \Doctrine\ORM\Proxy\Proxy
{
    /**
     * @var \Closure the callback responsible for loading properties in the proxy object. This callback is called with
     *      three parameters, being respectively the proxy object to be initialized, the method that triggered the
     *      initialization process and an array of ordered parameters that were passed to that method.
     *
     * @see \Doctrine\Common\Persistence\Proxy::__setInitializer
     */
    public $__initializer__;

    /**
     * @var \Closure the callback responsible of loading properties that need to be copied in the cloned object
     *
     * @see \Doctrine\Common\Persistence\Proxy::__setCloner
     */
    public $__cloner__;

    /**
     * @var boolean flag indicating if this object was already initialized
     *
     * @see \Doctrine\Common\Persistence\Proxy::__isInitialized
     */
    public $__isInitialized__ = false;

    /**
     * @var array properties to be lazy loaded, with keys being the property
     *            names and values being their default values
     *
     * @see \Doctrine\Common\Persistence\Proxy::__getLazyProperties
     */
    public static $lazyPropertiesDefaults = [];



    /**
     * @param \Closure $initializer
     * @param \Closure $cloner
     */
    public function __construct($initializer = null, $cloner = null)
    {

        $this->__initializer__ = $initializer;
        $this->__cloner__      = $cloner;
    }







    /**
     * 
     * @return array
     */
    public function __sleep()
    {
        if ($this->__isInitialized__) {
            return ['__isInitialized__', '' . "\0" . 'App\\Domain\\Entities\\Member' . "\0" . 'userAccount', '' . "\0" . 'App\\Domain\\Entities\\Member' . "\0" . 'status', '' . "\0" . 'App\\Domain\\Entities\\Member' . "\0" . 'lastName', '' . "\0" . 'App\\Domain\\Entities\\Member' . "\0" . 'firstName', '' . "\0" . 'App\\Domain\\Entities\\Member' . "\0" . 'lastNameKana', '' . "\0" . 'App\\Domain\\Entities\\Member' . "\0" . 'firstNameKana', '' . "\0" . 'App\\Domain\\Entities\\Member' . "\0" . 'englishName', '' . "\0" . 'App\\Domain\\Entities\\Member' . "\0" . 'birthday', '' . "\0" . 'App\\Domain\\Entities\\Member' . "\0" . 'zipCode', '' . "\0" . 'App\\Domain\\Entities\\Member' . "\0" . 'country', '' . "\0" . 'App\\Domain\\Entities\\Member' . "\0" . 'prefecture', '' . "\0" . 'App\\Domain\\Entities\\Member' . "\0" . 'city', '' . "\0" . 'App\\Domain\\Entities\\Member' . "\0" . 'blockNumber', '' . "\0" . 'App\\Domain\\Entities\\Member' . "\0" . 'phoneNumber', '' . "\0" . 'App\\Domain\\Entities\\Member' . "\0" . 'hashTag', '' . "\0" . 'App\\Domain\\Entities\\Member' . "\0" . 'introduction', '' . "\0" . 'App\\Domain\\Entities\\Member' . "\0" . 'affiliationExperience', '' . "\0" . 'App\\Domain\\Entities\\Member' . "\0" . 'instagramFollowerNumber', '' . "\0" . 'App\\Domain\\Entities\\Member' . "\0" . 'internNeeded', '' . "\0" . 'App\\Domain\\Entities\\Member' . "\0" . 'recruitInfoNeeded', '' . "\0" . 'App\\Domain\\Entities\\Member' . "\0" . 'managementMemo', '' . "\0" . 'App\\Domain\\Entities\\Member' . "\0" . 'uploadedFiles', '' . "\0" . 'App\\Domain\\Entities\\Member' . "\0" . 'aspirationJobTypes', '' . "\0" . 'App\\Domain\\Entities\\Member' . "\0" . 'aspirationPrefectures', '' . "\0" . 'App\\Domain\\Entities\\Member' . "\0" . 'aspirationBusinessTypes', '' . "\0" . 'App\\Domain\\Entities\\Member' . "\0" . 'aspirationSelfIntroductions', '' . "\0" . 'App\\Domain\\Entities\\Member' . "\0" . 'careers', '' . "\0" . 'App\\Domain\\Entities\\Member' . "\0" . 'oldSchool', '' . "\0" . 'App\\Domain\\Entities\\Member' . "\0" . 'languageAndCertification', '' . "\0" . 'App\\Domain\\Entities\\Member' . "\0" . 'likeMembers', '' . "\0" . 'App\\Domain\\Entities\\Member' . "\0" . 'createdAt', '' . "\0" . 'App\\Domain\\Entities\\Member' . "\0" . 'createdBy', '' . "\0" . 'App\\Domain\\Entities\\Member' . "\0" . 'updatedAt', '' . "\0" . 'App\\Domain\\Entities\\Member' . "\0" . 'updatedBy', '' . "\0" . 'App\\Domain\\Entities\\Member' . "\0" . 'deletedAt', '' . "\0" . 'App\\Domain\\Entities\\Member' . "\0" . 'id'];
        }

        return ['__isInitialized__', '' . "\0" . 'App\\Domain\\Entities\\Member' . "\0" . 'userAccount', '' . "\0" . 'App\\Domain\\Entities\\Member' . "\0" . 'status', '' . "\0" . 'App\\Domain\\Entities\\Member' . "\0" . 'lastName', '' . "\0" . 'App\\Domain\\Entities\\Member' . "\0" . 'firstName', '' . "\0" . 'App\\Domain\\Entities\\Member' . "\0" . 'lastNameKana', '' . "\0" . 'App\\Domain\\Entities\\Member' . "\0" . 'firstNameKana', '' . "\0" . 'App\\Domain\\Entities\\Member' . "\0" . 'englishName', '' . "\0" . 'App\\Domain\\Entities\\Member' . "\0" . 'birthday', '' . "\0" . 'App\\Domain\\Entities\\Member' . "\0" . 'zipCode', '' . "\0" . 'App\\Domain\\Entities\\Member' . "\0" . 'country', '' . "\0" . 'App\\Domain\\Entities\\Member' . "\0" . 'prefecture', '' . "\0" . 'App\\Domain\\Entities\\Member' . "\0" . 'city', '' . "\0" . 'App\\Domain\\Entities\\Member' . "\0" . 'blockNumber', '' . "\0" . 'App\\Domain\\Entities\\Member' . "\0" . 'phoneNumber', '' . "\0" . 'App\\Domain\\Entities\\Member' . "\0" . 'hashTag', '' . "\0" . 'App\\Domain\\Entities\\Member' . "\0" . 'introduction', '' . "\0" . 'App\\Domain\\Entities\\Member' . "\0" . 'affiliationExperience', '' . "\0" . 'App\\Domain\\Entities\\Member' . "\0" . 'instagramFollowerNumber', '' . "\0" . 'App\\Domain\\Entities\\Member' . "\0" . 'internNeeded', '' . "\0" . 'App\\Domain\\Entities\\Member' . "\0" . 'recruitInfoNeeded', '' . "\0" . 'App\\Domain\\Entities\\Member' . "\0" . 'managementMemo', '' . "\0" . 'App\\Domain\\Entities\\Member' . "\0" . 'uploadedFiles', '' . "\0" . 'App\\Domain\\Entities\\Member' . "\0" . 'aspirationJobTypes', '' . "\0" . 'App\\Domain\\Entities\\Member' . "\0" . 'aspirationPrefectures', '' . "\0" . 'App\\Domain\\Entities\\Member' . "\0" . 'aspirationBusinessTypes', '' . "\0" . 'App\\Domain\\Entities\\Member' . "\0" . 'aspirationSelfIntroductions', '' . "\0" . 'App\\Domain\\Entities\\Member' . "\0" . 'careers', '' . "\0" . 'App\\Domain\\Entities\\Member' . "\0" . 'oldSchool', '' . "\0" . 'App\\Domain\\Entities\\Member' . "\0" . 'languageAndCertification', '' . "\0" . 'App\\Domain\\Entities\\Member' . "\0" . 'likeMembers', '' . "\0" . 'App\\Domain\\Entities\\Member' . "\0" . 'createdAt', '' . "\0" . 'App\\Domain\\Entities\\Member' . "\0" . 'createdBy', '' . "\0" . 'App\\Domain\\Entities\\Member' . "\0" . 'updatedAt', '' . "\0" . 'App\\Domain\\Entities\\Member' . "\0" . 'updatedBy', '' . "\0" . 'App\\Domain\\Entities\\Member' . "\0" . 'deletedAt', '' . "\0" . 'App\\Domain\\Entities\\Member' . "\0" . 'id'];
    }

    /**
     * 
     */
    public function __wakeup()
    {
        if ( ! $this->__isInitialized__) {
            $this->__initializer__ = function (Member $proxy) {
                $proxy->__setInitializer(null);
                $proxy->__setCloner(null);

                $existingProperties = get_object_vars($proxy);

                foreach ($proxy->__getLazyProperties() as $property => $defaultValue) {
                    if ( ! array_key_exists($property, $existingProperties)) {
                        $proxy->$property = $defaultValue;
                    }
                }
            };

        }
    }

    /**
     * 
     */
    public function __clone()
    {
        $this->__cloner__ && $this->__cloner__->__invoke($this, '__clone', []);
    }

    /**
     * Forces initialization of the proxy
     */
    public function __load()
    {
        $this->__initializer__ && $this->__initializer__->__invoke($this, '__load', []);
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific loading logic
     */
    public function __isInitialized()
    {
        return $this->__isInitialized__;
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific loading logic
     */
    public function __setInitialized($initialized)
    {
        $this->__isInitialized__ = $initialized;
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific loading logic
     */
    public function __setInitializer(\Closure $initializer = null)
    {
        $this->__initializer__ = $initializer;
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific loading logic
     */
    public function __getInitializer()
    {
        return $this->__initializer__;
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific loading logic
     */
    public function __setCloner(\Closure $cloner = null)
    {
        $this->__cloner__ = $cloner;
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific cloning logic
     */
    public function __getCloner()
    {
        return $this->__cloner__;
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific loading logic
     * @static
     */
    public function __getLazyProperties()
    {
        return self::$lazyPropertiesDefaults;
    }

    
    /**
     * {@inheritDoc}
     */
    public function getAddressString(): string
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getAddressString', []);

        return parent::getAddressString();
    }

    /**
     * {@inheritDoc}
     */
    public function getAge(): int
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getAge', []);

        return parent::getAge();
    }

    /**
     * {@inheritDoc}
     */
    public function getIdPhotoFilePathForFrontShow(): ?string
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getIdPhotoFilePathForFrontShow', []);

        return parent::getIdPhotoFilePathForFrontShow();
    }

    /**
     * {@inheritDoc}
     */
    public function getPrivatePhotoFilePathForFrontShow(): ?string
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getPrivatePhotoFilePathForFrontShow', []);

        return parent::getPrivatePhotoFilePathForFrontShow();
    }

    /**
     * {@inheritDoc}
     */
    public function getIdPhotoFilePathForClientShow(): ?string
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getIdPhotoFilePathForClientShow', []);

        return parent::getIdPhotoFilePathForClientShow();
    }

    /**
     * {@inheritDoc}
     */
    public function getPrivatePhotoFilePathForClientShow(): ?string
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getPrivatePhotoFilePathForClientShow', []);

        return parent::getPrivatePhotoFilePathForClientShow();
    }

    /**
     * {@inheritDoc}
     */
    public function getUserAccount(): ?\App\Domain\Entities\UserAccount
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getUserAccount', []);

        return parent::getUserAccount();
    }

    /**
     * {@inheritDoc}
     */
    public function setUserAccount(?\App\Domain\Entities\UserAccount $userAccount): void
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setUserAccount', [$userAccount]);

        parent::setUserAccount($userAccount);
    }

    /**
     * {@inheritDoc}
     */
    public function getStatus(): ?int
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getStatus', []);

        return parent::getStatus();
    }

    /**
     * {@inheritDoc}
     */
    public function setStatus(?int $status): void
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setStatus', [$status]);

        parent::setStatus($status);
    }

    /**
     * {@inheritDoc}
     */
    public function getLastName(): ?string
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getLastName', []);

        return parent::getLastName();
    }

    /**
     * {@inheritDoc}
     */
    public function setLastName(?string $lastName): void
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setLastName', [$lastName]);

        parent::setLastName($lastName);
    }

    /**
     * {@inheritDoc}
     */
    public function getFirstName(): ?string
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getFirstName', []);

        return parent::getFirstName();
    }

    /**
     * {@inheritDoc}
     */
    public function setFirstName(?string $firstName): void
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setFirstName', [$firstName]);

        parent::setFirstName($firstName);
    }

    /**
     * {@inheritDoc}
     */
    public function getLastNameKana(): ?string
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getLastNameKana', []);

        return parent::getLastNameKana();
    }

    /**
     * {@inheritDoc}
     */
    public function setLastNameKana(?string $lastNameKana): void
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setLastNameKana', [$lastNameKana]);

        parent::setLastNameKana($lastNameKana);
    }

    /**
     * {@inheritDoc}
     */
    public function getFirstNameKana(): ?string
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getFirstNameKana', []);

        return parent::getFirstNameKana();
    }

    /**
     * {@inheritDoc}
     */
    public function setFirstNameKana(?string $firstNameKana): void
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setFirstNameKana', [$firstNameKana]);

        parent::setFirstNameKana($firstNameKana);
    }

    /**
     * {@inheritDoc}
     */
    public function getEnglishName(): ?string
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getEnglishName', []);

        return parent::getEnglishName();
    }

    /**
     * {@inheritDoc}
     */
    public function setEnglishName(?string $englishName): void
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setEnglishName', [$englishName]);

        parent::setEnglishName($englishName);
    }

    /**
     * {@inheritDoc}
     */
    public function getBirthday(): ?\Carbon\Carbon
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getBirthday', []);

        return parent::getBirthday();
    }

    /**
     * {@inheritDoc}
     */
    public function setBirthday(?\Carbon\Carbon $birthday): void
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setBirthday', [$birthday]);

        parent::setBirthday($birthday);
    }

    /**
     * {@inheritDoc}
     */
    public function getZipCode(): ?string
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getZipCode', []);

        return parent::getZipCode();
    }

    /**
     * {@inheritDoc}
     */
    public function setZipCode(?string $zipCode): void
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setZipCode', [$zipCode]);

        parent::setZipCode($zipCode);
    }

    /**
     * {@inheritDoc}
     */
    public function getCountry(): ?int
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getCountry', []);

        return parent::getCountry();
    }

    /**
     * {@inheritDoc}
     */
    public function setCountry(?int $country): void
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setCountry', [$country]);

        parent::setCountry($country);
    }

    /**
     * {@inheritDoc}
     */
    public function getPrefecture(): ?\App\Domain\Entities\Prefecture
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getPrefecture', []);

        return parent::getPrefecture();
    }

    /**
     * {@inheritDoc}
     */
    public function setPrefecture(?\App\Domain\Entities\Prefecture $prefecture): void
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setPrefecture', [$prefecture]);

        parent::setPrefecture($prefecture);
    }

    /**
     * {@inheritDoc}
     */
    public function getCity(): ?string
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getCity', []);

        return parent::getCity();
    }

    /**
     * {@inheritDoc}
     */
    public function setCity(?string $city): void
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setCity', [$city]);

        parent::setCity($city);
    }

    /**
     * {@inheritDoc}
     */
    public function getBlockNumber(): ?string
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getBlockNumber', []);

        return parent::getBlockNumber();
    }

    /**
     * {@inheritDoc}
     */
    public function setBlockNumber(?string $blockNumber): void
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setBlockNumber', [$blockNumber]);

        parent::setBlockNumber($blockNumber);
    }

    /**
     * {@inheritDoc}
     */
    public function getPhoneNumber(): ?string
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getPhoneNumber', []);

        return parent::getPhoneNumber();
    }

    /**
     * {@inheritDoc}
     */
    public function setPhoneNumber(?string $phoneNumber): void
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setPhoneNumber', [$phoneNumber]);

        parent::setPhoneNumber($phoneNumber);
    }

    /**
     * {@inheritDoc}
     */
    public function getHashTag(): ?\App\Domain\Entities\Tag
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getHashTag', []);

        return parent::getHashTag();
    }

    /**
     * {@inheritDoc}
     */
    public function setHashTag(?\App\Domain\Entities\Tag $hashTag): void
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setHashTag', [$hashTag]);

        parent::setHashTag($hashTag);
    }

    /**
     * {@inheritDoc}
     */
    public function getIntroduction(): ?string
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getIntroduction', []);

        return parent::getIntroduction();
    }

    /**
     * {@inheritDoc}
     */
    public function setIntroduction(?string $introduction): void
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setIntroduction', [$introduction]);

        parent::setIntroduction($introduction);
    }

    /**
     * {@inheritDoc}
     */
    public function getAffiliationExperience(): ?bool
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getAffiliationExperience', []);

        return parent::getAffiliationExperience();
    }

    /**
     * {@inheritDoc}
     */
    public function setAffiliationExperience(?bool $affiliationExperience): void
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setAffiliationExperience', [$affiliationExperience]);

        parent::setAffiliationExperience($affiliationExperience);
    }

    /**
     * {@inheritDoc}
     */
    public function getInstagramFollowerNumber(): ?int
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getInstagramFollowerNumber', []);

        return parent::getInstagramFollowerNumber();
    }

    /**
     * {@inheritDoc}
     */
    public function setInstagramFollowerNumber(?int $instagramFollowerNumber): void
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setInstagramFollowerNumber', [$instagramFollowerNumber]);

        parent::setInstagramFollowerNumber($instagramFollowerNumber);
    }

    /**
     * {@inheritDoc}
     */
    public function getInternNeeded(): ?bool
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getInternNeeded', []);

        return parent::getInternNeeded();
    }

    /**
     * {@inheritDoc}
     */
    public function setInternNeeded(?bool $internNeeded): void
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setInternNeeded', [$internNeeded]);

        parent::setInternNeeded($internNeeded);
    }

    /**
     * {@inheritDoc}
     */
    public function getRecruitInfoNeeded(): ?bool
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getRecruitInfoNeeded', []);

        return parent::getRecruitInfoNeeded();
    }

    /**
     * {@inheritDoc}
     */
    public function setRecruitInfoNeeded(?bool $recruitInfoNeeded): void
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setRecruitInfoNeeded', [$recruitInfoNeeded]);

        parent::setRecruitInfoNeeded($recruitInfoNeeded);
    }

    /**
     * {@inheritDoc}
     */
    public function getManagementMemo(): ?string
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getManagementMemo', []);

        return parent::getManagementMemo();
    }

    /**
     * {@inheritDoc}
     */
    public function setManagementMemo(?string $managementMemo): void
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setManagementMemo', [$managementMemo]);

        parent::setManagementMemo($managementMemo);
    }

    /**
     * {@inheritDoc}
     */
    public function getUploadedFiles()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getUploadedFiles', []);

        return parent::getUploadedFiles();
    }

    /**
     * {@inheritDoc}
     */
    public function getPrivateImage(): ?\App\Domain\Entities\UploadedFile
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getPrivateImage', []);

        return parent::getPrivateImage();
    }

    /**
     * {@inheritDoc}
     */
    public function setPrivateImage(?\App\Domain\Entities\UploadedFile $privateImage): void
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setPrivateImage', [$privateImage]);

        parent::setPrivateImage($privateImage);
    }

    /**
     * {@inheritDoc}
     */
    public function getIdentificationImage(): ?\App\Domain\Entities\UploadedFile
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getIdentificationImage', []);

        return parent::getIdentificationImage();
    }

    /**
     * {@inheritDoc}
     */
    public function setIdentificationImage(?\App\Domain\Entities\UploadedFile $identificationImage): void
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setIdentificationImage', [$identificationImage]);

        parent::setIdentificationImage($identificationImage);
    }

    /**
     * {@inheritDoc}
     */
    public function getPrVideos()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getPrVideos', []);

        return parent::getPrVideos();
    }

    /**
     * {@inheritDoc}
     */
    public function setPrVideos($prVideos): void
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setPrVideos', [$prVideos]);

        parent::setPrVideos($prVideos);
    }

    /**
     * {@inheritDoc}
     */
    public function getAspirationJobTypes()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getAspirationJobTypes', []);

        return parent::getAspirationJobTypes();
    }

    /**
     * {@inheritDoc}
     */
    public function setAspirationJobTypes($aspirationJobTypes): void
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setAspirationJobTypes', [$aspirationJobTypes]);

        parent::setAspirationJobTypes($aspirationJobTypes);
    }

    /**
     * {@inheritDoc}
     */
    public function getAspirationPrefectures()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getAspirationPrefectures', []);

        return parent::getAspirationPrefectures();
    }

    /**
     * {@inheritDoc}
     */
    public function setAspirationPrefectures($aspirationPrefectures): void
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setAspirationPrefectures', [$aspirationPrefectures]);

        parent::setAspirationPrefectures($aspirationPrefectures);
    }

    /**
     * {@inheritDoc}
     */
    public function getAspirationBusinessTypes()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getAspirationBusinessTypes', []);

        return parent::getAspirationBusinessTypes();
    }

    /**
     * {@inheritDoc}
     */
    public function setAspirationBusinessTypes($aspirationBusinessTypes): void
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setAspirationBusinessTypes', [$aspirationBusinessTypes]);

        parent::setAspirationBusinessTypes($aspirationBusinessTypes);
    }

    /**
     * {@inheritDoc}
     */
    public function getAspirationSelfIntroductions()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getAspirationSelfIntroductions', []);

        return parent::getAspirationSelfIntroductions();
    }

    /**
     * {@inheritDoc}
     */
    public function setAspirationSelfIntroductions($aspirationSelfIntroductions): void
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setAspirationSelfIntroductions', [$aspirationSelfIntroductions]);

        parent::setAspirationSelfIntroductions($aspirationSelfIntroductions);
    }

    /**
     * {@inheritDoc}
     */
    public function getCareers()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getCareers', []);

        return parent::getCareers();
    }

    /**
     * {@inheritDoc}
     */
    public function setCareers($careers): void
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setCareers', [$careers]);

        parent::setCareers($careers);
    }

    /**
     * {@inheritDoc}
     */
    public function getOldSchool(): ?\App\Domain\Entities\School
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getOldSchool', []);

        return parent::getOldSchool();
    }

    /**
     * {@inheritDoc}
     */
    public function setOldSchool(?\App\Domain\Entities\School $oldSchool): void
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setOldSchool', [$oldSchool]);

        parent::setOldSchool($oldSchool);
    }

    /**
     * {@inheritDoc}
     */
    public function getLanguageAndCertification(): ?\App\Domain\Entities\LanguageAndCertification
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getLanguageAndCertification', []);

        return parent::getLanguageAndCertification();
    }

    /**
     * {@inheritDoc}
     */
    public function setLanguageAndCertification(?\App\Domain\Entities\LanguageAndCertification $languageAndCertification): void
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setLanguageAndCertification', [$languageAndCertification]);

        parent::setLanguageAndCertification($languageAndCertification);
    }

    /**
     * {@inheritDoc}
     */
    public function getLikeMembers()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getLikeMembers', []);

        return parent::getLikeMembers();
    }

    /**
     * {@inheritDoc}
     */
    public function setLikeMembers(?array $likeMembers): void
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setLikeMembers', [$likeMembers]);

        parent::setLikeMembers($likeMembers);
    }

    /**
     * {@inheritDoc}
     */
    public function setId(?int $id): void
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setId', [$id]);

        parent::setId($id);
    }

    /**
     * {@inheritDoc}
     */
    public function getCreatedAt(): ?\Carbon\Carbon
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getCreatedAt', []);

        return parent::getCreatedAt();
    }

    /**
     * {@inheritDoc}
     */
    public function setCreatedAt(?\Carbon\Carbon $createdAt): void
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setCreatedAt', [$createdAt]);

        parent::setCreatedAt($createdAt);
    }

    /**
     * {@inheritDoc}
     */
    public function getCreatedBy(): ?int
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getCreatedBy', []);

        return parent::getCreatedBy();
    }

    /**
     * {@inheritDoc}
     */
    public function setCreatedBy(?int $createdBy): void
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setCreatedBy', [$createdBy]);

        parent::setCreatedBy($createdBy);
    }

    /**
     * {@inheritDoc}
     */
    public function getUpdatedAt(): ?\Carbon\Carbon
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getUpdatedAt', []);

        return parent::getUpdatedAt();
    }

    /**
     * {@inheritDoc}
     */
    public function setUpdatedAt(?\Carbon\Carbon $updatedAt): void
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setUpdatedAt', [$updatedAt]);

        parent::setUpdatedAt($updatedAt);
    }

    /**
     * {@inheritDoc}
     */
    public function getUpdatedBy(): ?int
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getUpdatedBy', []);

        return parent::getUpdatedBy();
    }

    /**
     * {@inheritDoc}
     */
    public function setUpdatedBy(?int $updatedBy): void
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setUpdatedBy', [$updatedBy]);

        parent::setUpdatedBy($updatedBy);
    }

    /**
     * {@inheritDoc}
     */
    public function getDeletedAt(): ?\Carbon\Carbon
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getDeletedAt', []);

        return parent::getDeletedAt();
    }

    /**
     * {@inheritDoc}
     */
    public function setDeletedAt(?\Carbon\Carbon $deletedAt): void
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setDeletedAt', [$deletedAt]);

        parent::setDeletedAt($deletedAt);
    }

    /**
     * {@inheritDoc}
     */
    public function restore(): void
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'restore', []);

        parent::restore();
    }

    /**
     * {@inheritDoc}
     */
    public function isDeleted(): bool
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'isDeleted', []);

        return parent::isDeleted();
    }

    /**
     * {@inheritDoc}
     */
    public function getId(): ?int
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getId', []);

        return parent::getId();
    }

    /**
     * {@inheritDoc}
     */
    public function doPrePersist()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'doPrePersist', []);

        return parent::doPrePersist();
    }

    /**
     * {@inheritDoc}
     */
    public function doPreUpdate()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'doPreUpdate', []);

        return parent::doPreUpdate();
    }

}
