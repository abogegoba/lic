<?php

namespace DoctrineProxies\__CG__\App\Domain\Entities;

/**
 * DO NOT EDIT THIS FILE - IT WAS CREATED BY DOCTRINE'S PROXY GENERATOR
 */
class CompanyUploadedFile extends \App\Domain\Entities\CompanyUploadedFile implements \Doctrine\ORM\Proxy\Proxy
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
            return ['__isInitialized__'];
        }

        return ['__isInitialized__'];
    }

    /**
     * 
     */
    public function __wakeup()
    {
        if ( ! $this->__isInitialized__) {
            $this->__initializer__ = function (CompanyUploadedFile $proxy) {
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
    public function getRealFilePath(): string
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getRealFilePath', []);

        return parent::getRealFilePath();
    }

    /**
     * {@inheritDoc}
     */
    public function getRealFileDir(): string
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getRealFileDir', []);

        return parent::getRealFileDir();
    }

    /**
     * {@inheritDoc}
     */
    public function getFilePathForFrontShow(): ?string
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getFilePathForFrontShow', []);

        return parent::getFilePathForFrontShow();
    }

    /**
     * {@inheritDoc}
     */
    public function getFilePathForClientShow(): ?string
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getFilePathForClientShow', []);

        return parent::getFilePathForClientShow();
    }

    /**
     * {@inheritDoc}
     */
    public function getFileType(): ?int
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getFileType', []);

        return parent::getFileType();
    }

    /**
     * {@inheritDoc}
     */
    public function setFileType(?int $fileType): void
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setFileType', [$fileType]);

        parent::setFileType($fileType);
    }

    /**
     * {@inheritDoc}
     */
    public function getFilePath(): ?string
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getFilePath', []);

        return parent::getFilePath();
    }

    /**
     * {@inheritDoc}
     */
    public function setFilePath(?string $filePath): void
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setFilePath', [$filePath]);

        parent::setFilePath($filePath);
    }

    /**
     * {@inheritDoc}
     */
    public function getFileName(): ?string
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getFileName', []);

        return parent::getFileName();
    }

    /**
     * {@inheritDoc}
     */
    public function setFileName(?string $fileName): void
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setFileName', [$fileName]);

        parent::setFileName($fileName);
    }

    /**
     * {@inheritDoc}
     */
    public function getPhysicalFileName(): ?string
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getPhysicalFileName', []);

        return parent::getPhysicalFileName();
    }

    /**
     * {@inheritDoc}
     */
    public function setPhysicalFileName(?string $physicalFileName): void
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setPhysicalFileName', [$physicalFileName]);

        parent::setPhysicalFileName($physicalFileName);
    }

    /**
     * {@inheritDoc}
     */
    public function getContentType(): ?int
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getContentType', []);

        return parent::getContentType();
    }

    /**
     * {@inheritDoc}
     */
    public function setContentType(?int $contentType): void
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setContentType', [$contentType]);

        parent::setContentType($contentType);
    }

    /**
     * {@inheritDoc}
     */
    public function getSortNumber(): ?int
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getSortNumber', []);

        return parent::getSortNumber();
    }

    /**
     * {@inheritDoc}
     */
    public function setSortNumber(?int $sortNumber): void
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setSortNumber', [$sortNumber]);

        parent::setSortNumber($sortNumber);
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
    public function getDescription(): ?string
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getDescription', []);

        return parent::getDescription();
    }

    /**
     * {@inheritDoc}
     */
    public function setDescription(?string $description): void
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setDescription', [$description]);

        parent::setDescription($description);
    }

    /**
     * {@inheritDoc}
     */
    public function getMember(): ?\App\Domain\Entities\Member
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getMember', []);

        return parent::getMember();
    }

    /**
     * {@inheritDoc}
     */
    public function setMember(?\App\Domain\Entities\Member $member): void
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setMember', [$member]);

        parent::setMember($member);
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
    public function setCompany(?\App\Domain\Entities\Company $company): void
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setCompany', [$company]);

        parent::setCompany($company);
    }

    /**
     * {@inheritDoc}
     */
    public function getViewSelected(): ?bool
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getViewSelected', []);

        return parent::getViewSelected();
    }

    /**
     * {@inheritDoc}
     */
    public function setViewSelected(?bool $viewSelected): void
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setViewSelected', [$viewSelected]);

        parent::setViewSelected($viewSelected);
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