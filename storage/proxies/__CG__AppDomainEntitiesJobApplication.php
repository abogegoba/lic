<?php

namespace DoctrineProxies\__CG__\App\Domain\Entities;

/**
 * DO NOT EDIT THIS FILE - IT WAS CREATED BY DOCTRINE'S PROXY GENERATOR
 */
class JobApplication extends \App\Domain\Entities\JobApplication implements \Doctrine\ORM\Proxy\Proxy
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
            return ['__isInitialized__', '' . "\0" . 'App\\Domain\\Entities\\JobApplication' . "\0" . 'title', '' . "\0" . 'App\\Domain\\Entities\\JobApplication' . "\0" . 'company', '' . "\0" . 'App\\Domain\\Entities\\JobApplication' . "\0" . 'status', '' . "\0" . 'App\\Domain\\Entities\\JobApplication' . "\0" . 'recruitmentJobType', '' . "\0" . 'App\\Domain\\Entities\\JobApplication' . "\0" . 'recruitmentJobTypeDescription', '' . "\0" . 'App\\Domain\\Entities\\JobApplication' . "\0" . 'jobDescription', '' . "\0" . 'App\\Domain\\Entities\\JobApplication' . "\0" . 'employmentType', '' . "\0" . 'App\\Domain\\Entities\\JobApplication' . "\0" . 'statue', '' . "\0" . 'App\\Domain\\Entities\\JobApplication' . "\0" . 'screeningMethod', '' . "\0" . 'App\\Domain\\Entities\\JobApplication' . "\0" . 'compensation', '' . "\0" . 'App\\Domain\\Entities\\JobApplication' . "\0" . 'bonus', '' . "\0" . 'App\\Domain\\Entities\\JobApplication' . "\0" . 'recruitmentWorkLocations', '' . "\0" . 'App\\Domain\\Entities\\JobApplication' . "\0" . 'dutyHours', '' . "\0" . 'App\\Domain\\Entities\\JobApplication' . "\0" . 'compensationPackage', '' . "\0" . 'App\\Domain\\Entities\\JobApplication' . "\0" . 'nonWorkDay', '' . "\0" . 'App\\Domain\\Entities\\JobApplication' . "\0" . 'recruitmentNumber', '' . "\0" . 'App\\Domain\\Entities\\JobApplication' . "\0" . 'managementMemo', '' . "\0" . 'App\\Domain\\Entities\\JobApplication' . "\0" . 'createdAt', '' . "\0" . 'App\\Domain\\Entities\\JobApplication' . "\0" . 'createdBy', '' . "\0" . 'App\\Domain\\Entities\\JobApplication' . "\0" . 'updatedAt', '' . "\0" . 'App\\Domain\\Entities\\JobApplication' . "\0" . 'updatedBy', '' . "\0" . 'App\\Domain\\Entities\\JobApplication' . "\0" . 'deletedAt', '' . "\0" . 'App\\Domain\\Entities\\JobApplication' . "\0" . 'id'];
        }

        return ['__isInitialized__', '' . "\0" . 'App\\Domain\\Entities\\JobApplication' . "\0" . 'title', '' . "\0" . 'App\\Domain\\Entities\\JobApplication' . "\0" . 'company', '' . "\0" . 'App\\Domain\\Entities\\JobApplication' . "\0" . 'status', '' . "\0" . 'App\\Domain\\Entities\\JobApplication' . "\0" . 'recruitmentJobType', '' . "\0" . 'App\\Domain\\Entities\\JobApplication' . "\0" . 'recruitmentJobTypeDescription', '' . "\0" . 'App\\Domain\\Entities\\JobApplication' . "\0" . 'jobDescription', '' . "\0" . 'App\\Domain\\Entities\\JobApplication' . "\0" . 'employmentType', '' . "\0" . 'App\\Domain\\Entities\\JobApplication' . "\0" . 'statue', '' . "\0" . 'App\\Domain\\Entities\\JobApplication' . "\0" . 'screeningMethod', '' . "\0" . 'App\\Domain\\Entities\\JobApplication' . "\0" . 'compensation', '' . "\0" . 'App\\Domain\\Entities\\JobApplication' . "\0" . 'bonus', '' . "\0" . 'App\\Domain\\Entities\\JobApplication' . "\0" . 'recruitmentWorkLocations', '' . "\0" . 'App\\Domain\\Entities\\JobApplication' . "\0" . 'dutyHours', '' . "\0" . 'App\\Domain\\Entities\\JobApplication' . "\0" . 'compensationPackage', '' . "\0" . 'App\\Domain\\Entities\\JobApplication' . "\0" . 'nonWorkDay', '' . "\0" . 'App\\Domain\\Entities\\JobApplication' . "\0" . 'recruitmentNumber', '' . "\0" . 'App\\Domain\\Entities\\JobApplication' . "\0" . 'managementMemo', '' . "\0" . 'App\\Domain\\Entities\\JobApplication' . "\0" . 'createdAt', '' . "\0" . 'App\\Domain\\Entities\\JobApplication' . "\0" . 'createdBy', '' . "\0" . 'App\\Domain\\Entities\\JobApplication' . "\0" . 'updatedAt', '' . "\0" . 'App\\Domain\\Entities\\JobApplication' . "\0" . 'updatedBy', '' . "\0" . 'App\\Domain\\Entities\\JobApplication' . "\0" . 'deletedAt', '' . "\0" . 'App\\Domain\\Entities\\JobApplication' . "\0" . 'id'];
    }

    /**
     * 
     */
    public function __wakeup()
    {
        if ( ! $this->__isInitialized__) {
            $this->__initializer__ = function (JobApplication $proxy) {
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
    public function getTitle(): ?string
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getTitle', []);

        return parent::getTitle();
    }

    /**
     * {@inheritDoc}
     */
    public function setTitle(?string $title): void
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setTitle', [$title]);

        parent::setTitle($title);
    }

    /**
     * {@inheritDoc}
     */
    public function getCompany(): ?\App\Domain\Entities\Company
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getCompany', []);

        return parent::getCompany();
    }

    /**
     * {@inheritDoc}
     */
    public function setCompany($company): void
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setCompany', [$company]);

        parent::setCompany($company);
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
    public function getRecruitmentJobType(): ?\App\Domain\Entities\JobType
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getRecruitmentJobType', []);

        return parent::getRecruitmentJobType();
    }

    /**
     * {@inheritDoc}
     */
    public function setRecruitmentJobType(?\App\Domain\Entities\JobType $recruitmentJobType): void
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setRecruitmentJobType', [$recruitmentJobType]);

        parent::setRecruitmentJobType($recruitmentJobType);
    }

    /**
     * {@inheritDoc}
     */
    public function getRecruitmentJobTypeDescription(): ?string
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getRecruitmentJobTypeDescription', []);

        return parent::getRecruitmentJobTypeDescription();
    }

    /**
     * {@inheritDoc}
     */
    public function setRecruitmentJobTypeDescription(?string $recruitmentJobTypeDescription): void
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setRecruitmentJobTypeDescription', [$recruitmentJobTypeDescription]);

        parent::setRecruitmentJobTypeDescription($recruitmentJobTypeDescription);
    }

    /**
     * {@inheritDoc}
     */
    public function getJobDescription(): ?string
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getJobDescription', []);

        return parent::getJobDescription();
    }

    /**
     * {@inheritDoc}
     */
    public function setJobDescription(?string $jobDescription): void
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setJobDescription', [$jobDescription]);

        parent::setJobDescription($jobDescription);
    }

    /**
     * {@inheritDoc}
     */
    public function getEmploymentType(): ?int
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getEmploymentType', []);

        return parent::getEmploymentType();
    }

    /**
     * {@inheritDoc}
     */
    public function setEmploymentType(?int $employmentType): void
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setEmploymentType', [$employmentType]);

        parent::setEmploymentType($employmentType);
    }

    /**
     * {@inheritDoc}
     */
    public function getStatue(): ?string
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getStatue', []);

        return parent::getStatue();
    }

    /**
     * {@inheritDoc}
     */
    public function setStatue(?string $statue): void
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setStatue', [$statue]);

        parent::setStatue($statue);
    }

    /**
     * {@inheritDoc}
     */
    public function getScreeningMethod(): ?string
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getScreeningMethod', []);

        return parent::getScreeningMethod();
    }

    /**
     * {@inheritDoc}
     */
    public function setScreeningMethod(?string $screeningMethod): void
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setScreeningMethod', [$screeningMethod]);

        parent::setScreeningMethod($screeningMethod);
    }

    /**
     * {@inheritDoc}
     */
    public function getCompensation(): ?string
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getCompensation', []);

        return parent::getCompensation();
    }

    /**
     * {@inheritDoc}
     */
    public function setCompensation(?string $compensation): void
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setCompensation', [$compensation]);

        parent::setCompensation($compensation);
    }

    /**
     * {@inheritDoc}
     */
    public function getBonus(): ?string
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getBonus', []);

        return parent::getBonus();
    }

    /**
     * {@inheritDoc}
     */
    public function setBonus(?string $bonus): void
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setBonus', [$bonus]);

        parent::setBonus($bonus);
    }

    /**
     * {@inheritDoc}
     */
    public function getRecruitmentWorkLocations()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getRecruitmentWorkLocations', []);

        return parent::getRecruitmentWorkLocations();
    }

    /**
     * {@inheritDoc}
     */
    public function setRecruitmentWorkLocations($recruitmentWorkLocations): void
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setRecruitmentWorkLocations', [$recruitmentWorkLocations]);

        parent::setRecruitmentWorkLocations($recruitmentWorkLocations);
    }

    /**
     * {@inheritDoc}
     */
    public function getDutyHours(): ?string
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getDutyHours', []);

        return parent::getDutyHours();
    }

    /**
     * {@inheritDoc}
     */
    public function setDutyHours(?string $dutyHours): void
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setDutyHours', [$dutyHours]);

        parent::setDutyHours($dutyHours);
    }

    /**
     * {@inheritDoc}
     */
    public function getCompensationPackage(): ?string
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getCompensationPackage', []);

        return parent::getCompensationPackage();
    }

    /**
     * {@inheritDoc}
     */
    public function setCompensationPackage(?string $compensationPackage): void
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setCompensationPackage', [$compensationPackage]);

        parent::setCompensationPackage($compensationPackage);
    }

    /**
     * {@inheritDoc}
     */
    public function getNonWorkDay(): ?string
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getNonWorkDay', []);

        return parent::getNonWorkDay();
    }

    /**
     * {@inheritDoc}
     */
    public function setNonWorkDay(?string $nonWorkDay): void
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setNonWorkDay', [$nonWorkDay]);

        parent::setNonWorkDay($nonWorkDay);
    }

    /**
     * {@inheritDoc}
     */
    public function getRecruitmentNumber(): ?string
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getRecruitmentNumber', []);

        return parent::getRecruitmentNumber();
    }

    /**
     * {@inheritDoc}
     */
    public function setRecruitmentNumber(?string $recruitmentNumber): void
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setRecruitmentNumber', [$recruitmentNumber]);

        parent::setRecruitmentNumber($recruitmentNumber);
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
