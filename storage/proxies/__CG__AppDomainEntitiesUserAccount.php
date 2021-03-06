<?php

namespace DoctrineProxies\__CG__\App\Domain\Entities;

/**
 * DO NOT EDIT THIS FILE - IT WAS CREATED BY DOCTRINE'S PROXY GENERATOR
 */
class UserAccount extends \App\Domain\Entities\UserAccount implements \Doctrine\ORM\Proxy\Proxy
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
            return ['__isInitialized__', '' . "\0" . 'App\\Domain\\Entities\\UserAccount' . "\0" . 'mailAddress', '' . "\0" . 'App\\Domain\\Entities\\UserAccount' . "\0" . 'password', '' . "\0" . 'App\\Domain\\Entities\\UserAccount' . "\0" . 'companyAccount', '' . "\0" . 'App\\Domain\\Entities\\UserAccount' . "\0" . 'member', '' . "\0" . 'App\\Domain\\Entities\\UserAccount' . "\0" . 'operatingCompanyAccount', '' . "\0" . 'App\\Domain\\Entities\\UserAccount' . "\0" . 'lastLoginDateTime', '' . "\0" . 'App\\Domain\\Entities\\UserAccount' . "\0" . 'interviewAppointments', '' . "\0" . 'App\\Domain\\Entities\\UserAccount' . "\0" . 'videoCallHistories', '' . "\0" . 'App\\Domain\\Entities\\UserAccount' . "\0" . 'sendingMessages', '' . "\0" . 'App\\Domain\\Entities\\UserAccount' . "\0" . 'receivingMessages', '' . "\0" . 'App\\Domain\\Entities\\UserAccount' . "\0" . 'companyInterviewAppointments', '' . "\0" . 'App\\Domain\\Entities\\UserAccount' . "\0" . 'memberInterviewAppointments', '' . "\0" . 'App\\Domain\\Entities\\UserAccount' . "\0" . 'companyVideoCallHistories', '' . "\0" . 'App\\Domain\\Entities\\UserAccount' . "\0" . 'memberVideoCallHistories', '' . "\0" . 'App\\Domain\\Entities\\UserAccount' . "\0" . 'createdAt', '' . "\0" . 'App\\Domain\\Entities\\UserAccount' . "\0" . 'createdBy', '' . "\0" . 'App\\Domain\\Entities\\UserAccount' . "\0" . 'updatedAt', '' . "\0" . 'App\\Domain\\Entities\\UserAccount' . "\0" . 'updatedBy', '' . "\0" . 'App\\Domain\\Entities\\UserAccount' . "\0" . 'deletedAt', '' . "\0" . 'App\\Domain\\Entities\\UserAccount' . "\0" . 'id'];
        }

        return ['__isInitialized__', '' . "\0" . 'App\\Domain\\Entities\\UserAccount' . "\0" . 'mailAddress', '' . "\0" . 'App\\Domain\\Entities\\UserAccount' . "\0" . 'password', '' . "\0" . 'App\\Domain\\Entities\\UserAccount' . "\0" . 'companyAccount', '' . "\0" . 'App\\Domain\\Entities\\UserAccount' . "\0" . 'member', '' . "\0" . 'App\\Domain\\Entities\\UserAccount' . "\0" . 'operatingCompanyAccount', '' . "\0" . 'App\\Domain\\Entities\\UserAccount' . "\0" . 'lastLoginDateTime', '' . "\0" . 'App\\Domain\\Entities\\UserAccount' . "\0" . 'interviewAppointments', '' . "\0" . 'App\\Domain\\Entities\\UserAccount' . "\0" . 'videoCallHistories', '' . "\0" . 'App\\Domain\\Entities\\UserAccount' . "\0" . 'sendingMessages', '' . "\0" . 'App\\Domain\\Entities\\UserAccount' . "\0" . 'receivingMessages', '' . "\0" . 'App\\Domain\\Entities\\UserAccount' . "\0" . 'companyInterviewAppointments', '' . "\0" . 'App\\Domain\\Entities\\UserAccount' . "\0" . 'memberInterviewAppointments', '' . "\0" . 'App\\Domain\\Entities\\UserAccount' . "\0" . 'companyVideoCallHistories', '' . "\0" . 'App\\Domain\\Entities\\UserAccount' . "\0" . 'memberVideoCallHistories', '' . "\0" . 'App\\Domain\\Entities\\UserAccount' . "\0" . 'createdAt', '' . "\0" . 'App\\Domain\\Entities\\UserAccount' . "\0" . 'createdBy', '' . "\0" . 'App\\Domain\\Entities\\UserAccount' . "\0" . 'updatedAt', '' . "\0" . 'App\\Domain\\Entities\\UserAccount' . "\0" . 'updatedBy', '' . "\0" . 'App\\Domain\\Entities\\UserAccount' . "\0" . 'deletedAt', '' . "\0" . 'App\\Domain\\Entities\\UserAccount' . "\0" . 'id'];
    }

    /**
     * 
     */
    public function __wakeup()
    {
        if ( ! $this->__isInitialized__) {
            $this->__initializer__ = function (UserAccount $proxy) {
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
    public function isMember(): bool
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'isMember', []);

        return parent::isMember();
    }

    /**
     * {@inheritDoc}
     */
    public function isCompanyAccount(): bool
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'isCompanyAccount', []);

        return parent::isCompanyAccount();
    }

    /**
     * {@inheritDoc}
     */
    public function renewLastLoginDateTime(): void
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'renewLastLoginDateTime', []);

        parent::renewLastLoginDateTime();
    }

    /**
     * {@inheritDoc}
     */
    public function getMailAddress(): ?string
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getMailAddress', []);

        return parent::getMailAddress();
    }

    /**
     * {@inheritDoc}
     */
    public function setMailAddress(?string $mailAddress): void
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setMailAddress', [$mailAddress]);

        parent::setMailAddress($mailAddress);
    }

    /**
     * {@inheritDoc}
     */
    public function getPassword(): ?string
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getPassword', []);

        return parent::getPassword();
    }

    /**
     * {@inheritDoc}
     */
    public function setPassword(?string $password): void
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setPassword', [$password]);

        parent::setPassword($password);
    }

    /**
     * {@inheritDoc}
     */
    public function getCompanyAccount(): ?\App\Domain\Entities\CompanyAccount
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getCompanyAccount', []);

        return parent::getCompanyAccount();
    }

    /**
     * {@inheritDoc}
     */
    public function setCompanyAccount(?\App\Domain\Entities\CompanyAccount $companyAccount): void
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setCompanyAccount', [$companyAccount]);

        parent::setCompanyAccount($companyAccount);
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
    public function getOperatingCompanyAccount(): ?\App\Domain\Entities\OperatingCompanyAccount
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getOperatingCompanyAccount', []);

        return parent::getOperatingCompanyAccount();
    }

    /**
     * {@inheritDoc}
     */
    public function setOperatingCompanyAccount(?\App\Domain\Entities\OperatingCompanyAccount $operatingCompanyAccount): void
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setOperatingCompanyAccount', [$operatingCompanyAccount]);

        parent::setOperatingCompanyAccount($operatingCompanyAccount);
    }

    /**
     * {@inheritDoc}
     */
    public function getLastLoginDateTime(): ?\Carbon\Carbon
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getLastLoginDateTime', []);

        return parent::getLastLoginDateTime();
    }

    /**
     * {@inheritDoc}
     */
    public function setLastLoginDateTime(?\Carbon\Carbon $lastLoginDateTime): void
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setLastLoginDateTime', [$lastLoginDateTime]);

        parent::setLastLoginDateTime($lastLoginDateTime);
    }

    /**
     * {@inheritDoc}
     */
    public function getSendingMessages()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getSendingMessages', []);

        return parent::getSendingMessages();
    }

    /**
     * {@inheritDoc}
     */
    public function setSendingMessages($sendingMessages): void
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setSendingMessages', [$sendingMessages]);

        parent::setSendingMessages($sendingMessages);
    }

    /**
     * {@inheritDoc}
     */
    public function getReceivingMessages()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getReceivingMessages', []);

        return parent::getReceivingMessages();
    }

    /**
     * {@inheritDoc}
     */
    public function setReceivingMessages($receivingMessages): void
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setReceivingMessages', [$receivingMessages]);

        parent::setReceivingMessages($receivingMessages);
    }

    /**
     * {@inheritDoc}
     */
    public function getCompanyInterviewAppointments()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getCompanyInterviewAppointments', []);

        return parent::getCompanyInterviewAppointments();
    }

    /**
     * {@inheritDoc}
     */
    public function setCompanyInterviewAppointments($companyInterviewAppointments): void
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setCompanyInterviewAppointments', [$companyInterviewAppointments]);

        parent::setCompanyInterviewAppointments($companyInterviewAppointments);
    }

    /**
     * {@inheritDoc}
     */
    public function getMemberInterviewAppointments()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getMemberInterviewAppointments', []);

        return parent::getMemberInterviewAppointments();
    }

    /**
     * {@inheritDoc}
     */
    public function setMemberInterviewAppointments($memberInterviewAppointments): void
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setMemberInterviewAppointments', [$memberInterviewAppointments]);

        parent::setMemberInterviewAppointments($memberInterviewAppointments);
    }

    /**
     * {@inheritDoc}
     */
    public function getCompanyVideoCallHistories()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getCompanyVideoCallHistories', []);

        return parent::getCompanyVideoCallHistories();
    }

    /**
     * {@inheritDoc}
     */
    public function setCompanyVideoCallHistories($companyVideoCallHistories): void
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setCompanyVideoCallHistories', [$companyVideoCallHistories]);

        parent::setCompanyVideoCallHistories($companyVideoCallHistories);
    }

    /**
     * {@inheritDoc}
     */
    public function getMemberVideoCallHistories()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getMemberVideoCallHistories', []);

        return parent::getMemberVideoCallHistories();
    }

    /**
     * {@inheritDoc}
     */
    public function setMemberVideoCallHistories($memberVideoCallHistories): void
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setMemberVideoCallHistories', [$memberVideoCallHistories]);

        parent::setMemberVideoCallHistories($memberVideoCallHistories);
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

    /**
     * {@inheritDoc}
     */
    public function encrypt($data, $password)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'encrypt', [$data, $password]);

        return parent::encrypt($data, $password);
    }

    /**
     * {@inheritDoc}
     */
    public function decrypt($edata, $password)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'decrypt', [$edata, $password]);

        return parent::decrypt($edata, $password);
    }

}
