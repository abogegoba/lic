<?php

namespace DoctrineProxies\__CG__\App\Domain\Entities;

/**
 * DO NOT EDIT THIS FILE - IT WAS CREATED BY DOCTRINE'S PROXY GENERATOR
 */
class InterViewAppointment extends \App\Domain\Entities\InterViewAppointment implements \Doctrine\ORM\Proxy\Proxy
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
            return ['__isInitialized__', '' . "\0" . 'App\\Domain\\Entities\\InterViewAppointment' . "\0" . 'companyUserAccount', '' . "\0" . 'App\\Domain\\Entities\\InterViewAppointment' . "\0" . 'companyPeerId', '' . "\0" . 'App\\Domain\\Entities\\InterViewAppointment' . "\0" . 'memberUserAccount', '' . "\0" . 'App\\Domain\\Entities\\InterViewAppointment' . "\0" . 'memberPeerId', '' . "\0" . 'App\\Domain\\Entities\\InterViewAppointment' . "\0" . 'status', '' . "\0" . 'App\\Domain\\Entities\\InterViewAppointment' . "\0" . 'appointmentDatetime', '' . "\0" . 'App\\Domain\\Entities\\InterViewAppointment' . "\0" . 'content', '' . "\0" . 'App\\Domain\\Entities\\InterViewAppointment' . "\0" . 'cancelMessage', '' . "\0" . 'App\\Domain\\Entities\\InterViewAppointment' . "\0" . 'createdAt', '' . "\0" . 'App\\Domain\\Entities\\InterViewAppointment' . "\0" . 'createdBy', '' . "\0" . 'App\\Domain\\Entities\\InterViewAppointment' . "\0" . 'updatedAt', '' . "\0" . 'App\\Domain\\Entities\\InterViewAppointment' . "\0" . 'updatedBy', '' . "\0" . 'App\\Domain\\Entities\\InterViewAppointment' . "\0" . 'deletedAt', '' . "\0" . 'App\\Domain\\Entities\\InterViewAppointment' . "\0" . 'id'];
        }

        return ['__isInitialized__', '' . "\0" . 'App\\Domain\\Entities\\InterViewAppointment' . "\0" . 'companyUserAccount', '' . "\0" . 'App\\Domain\\Entities\\InterViewAppointment' . "\0" . 'companyPeerId', '' . "\0" . 'App\\Domain\\Entities\\InterViewAppointment' . "\0" . 'memberUserAccount', '' . "\0" . 'App\\Domain\\Entities\\InterViewAppointment' . "\0" . 'memberPeerId', '' . "\0" . 'App\\Domain\\Entities\\InterViewAppointment' . "\0" . 'status', '' . "\0" . 'App\\Domain\\Entities\\InterViewAppointment' . "\0" . 'appointmentDatetime', '' . "\0" . 'App\\Domain\\Entities\\InterViewAppointment' . "\0" . 'content', '' . "\0" . 'App\\Domain\\Entities\\InterViewAppointment' . "\0" . 'cancelMessage', '' . "\0" . 'App\\Domain\\Entities\\InterViewAppointment' . "\0" . 'createdAt', '' . "\0" . 'App\\Domain\\Entities\\InterViewAppointment' . "\0" . 'createdBy', '' . "\0" . 'App\\Domain\\Entities\\InterViewAppointment' . "\0" . 'updatedAt', '' . "\0" . 'App\\Domain\\Entities\\InterViewAppointment' . "\0" . 'updatedBy', '' . "\0" . 'App\\Domain\\Entities\\InterViewAppointment' . "\0" . 'deletedAt', '' . "\0" . 'App\\Domain\\Entities\\InterViewAppointment' . "\0" . 'id'];
    }

    /**
     * 
     */
    public function __wakeup()
    {
        if ( ! $this->__isInitialized__) {
            $this->__initializer__ = function (InterViewAppointment $proxy) {
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
    public function getCompanyUserAccount(): ?\App\Domain\Entities\UserAccount
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getCompanyUserAccount', []);

        return parent::getCompanyUserAccount();
    }

    /**
     * {@inheritDoc}
     */
    public function setCompanyUserAccount(?\App\Domain\Entities\UserAccount $companyUserAccount): void
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setCompanyUserAccount', [$companyUserAccount]);

        parent::setCompanyUserAccount($companyUserAccount);
    }

    /**
     * {@inheritDoc}
     */
    public function getCompanyPeerId(): ?string
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getCompanyPeerId', []);

        return parent::getCompanyPeerId();
    }

    /**
     * {@inheritDoc}
     */
    public function setCompanyPeerId(?string $companyPeerId): void
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setCompanyPeerId', [$companyPeerId]);

        parent::setCompanyPeerId($companyPeerId);
    }

    /**
     * {@inheritDoc}
     */
    public function getMemberUserAccount(): ?\App\Domain\Entities\UserAccount
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getMemberUserAccount', []);

        return parent::getMemberUserAccount();
    }

    /**
     * {@inheritDoc}
     */
    public function setMemberUserAccount(?\App\Domain\Entities\UserAccount $memberUserAccount): void
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setMemberUserAccount', [$memberUserAccount]);

        parent::setMemberUserAccount($memberUserAccount);
    }

    /**
     * {@inheritDoc}
     */
    public function getMemberPeerId(): ?string
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getMemberPeerId', []);

        return parent::getMemberPeerId();
    }

    /**
     * {@inheritDoc}
     */
    public function setMemberPeerId(?string $memberPeerId): void
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setMemberPeerId', [$memberPeerId]);

        parent::setMemberPeerId($memberPeerId);
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
    public function getAppointmentDatetime(): ?\Carbon\Carbon
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getAppointmentDatetime', []);

        return parent::getAppointmentDatetime();
    }

    /**
     * {@inheritDoc}
     */
    public function setAppointmentDatetime(?\Carbon\Carbon $appointmentDatetime): void
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setAppointmentDatetime', [$appointmentDatetime]);

        parent::setAppointmentDatetime($appointmentDatetime);
    }

    /**
     * {@inheritDoc}
     */
    public function getContent(): ?string
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getContent', []);

        return parent::getContent();
    }

    /**
     * {@inheritDoc}
     */
    public function setContent(?string $content): void
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setContent', [$content]);

        parent::setContent($content);
    }

    /**
     * {@inheritDoc}
     */
    public function getCancelMessage(): ?string
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getCancelMessage', []);

        return parent::getCancelMessage();
    }

    /**
     * {@inheritDoc}
     */
    public function setCancelMessage(?string $cancelMessage): void
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setCancelMessage', [$cancelMessage]);

        parent::setCancelMessage($cancelMessage);
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
