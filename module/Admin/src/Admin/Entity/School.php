<?php

namespace Admin\Entity;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * School
 *
 * @ORM\Table(name="school")
 * @ORM\Entity
 */
class School
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    protected $id;

     /**
     * @var integer
     *
     * @ORM\Column(name="name", type="string", length=45, nullable=true)
     */
    protected $name;

    /**
     * @var string
     *
     * @ORM\Column(name="type", type="string", length=45, nullable=true)
     */
    protected $type;

    /**
     * @var string
     *
     * @ORM\Column(name="motto", type="string", length=45, nullable=true)
     */
    protected $motto;

    /**
     * @var string
     *
     * @ORM\Column(name="establish_date", type="string", length=45, nullable=true)
     */
    protected $establish;

    /**
     * @var string
     *
     * @ORM\Column(name="address", type="string", length=45, nullable=true)
     */
    protected $address;

    /**
     * @var string
     *
     * @ORM\Column(name="mobile", type="string", length=45, nullable=true)
     */
    protected $mobile;
    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=45, nullable=true)
     */
    protected $email;

    /**
     * @var string
     *
     * @ORM\Column(name="website", type="string", length=45, nullable=true)
     */
    protected $website;

    /**
     * @var string
     *
     * @ORM\Column(name="jamb_code", type="string", length=45, nullable=true)
     */
    protected $jambCode;

    /**
     * @var string
     *
     * @ORM\Column(name="waec_code", type="string", length=45, nullable=true)
     */
    protected $waecCode;

    /**
     * @var string
     *
     * @ORM\Column(name="nabted_code", type="string", length=45, nullable=true)
     */
    protected $nabtedCode;

    /**
     * @var string
     *
     * @ORM\Column(name="neco_code", type="string", length=45, nullable=true)
     */
    protected $necoCode;

    /**
     * @var string
     *
     * @ORM\Column(name="school_logo", type="string", length=45, nullable=true)
     */
    protected $logo;

    /**
     * @var string
     *
     * @ORM\Column(name="principal_signature", type="string", length=45, nullable=true)
     */
    protected $signature;


  

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }


    /**
     * Set name
     *
     * @param string $name
     * @return School
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }


      /**
     * Set type
     *
     * @param string $type
     * @return School
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return string 
     */
    public function getType()
    {
        return $this->type;
    }

       /**
     * Set mobile
     *
     * @param string $mobile
     * @return School
     */
    public function setMobile($mobile)
    {
        $this->mobile = $mobile;

        return $this;
    }

    /**
     * Get mobile
     *
     * @return string 
     */
    public function getMobile()
    {
        return $this->mobile;
    }

       /**
     * Set motto
     *
     * @param string $motto
     * @return School
     */
    public function setMotto($motto)
    {
        $this->motto = $motto;

        return $this;
    }

    /**
     * Get motto
     *
     * @return string 
     */
    public function getMotto()
    {
        return $this->motto;
    }

       /**
     * Set address
     *
     * @param string $address
     * @return School
     */
    public function setAddress($address)
    {
        $this->address = $address;

        return $this;
    }

    /**
     * Get address
     *
     * @return string 
     */
    public function getAddress()
    {
        return $this->address;
    }

       /**
     * Set establish
     *
     * @param string $establish
     * @return School
     */
    public function setEstablish($establish)
    {
        $this->establish = $establish;

        return $this;
    }

    /**
     * Get establish
     *
     * @return string 
     */
    public function getEstablish()
    {
        return $this->establish;
    }
       /**
     * Set email
     *
     * @param string $email
     * @return School
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string 
     */
    public function getEmail()
    {
        return $this->email;
    }


           /**
     * Set website
     *
     * @param string $website
     * @return School
     */
    public function setWebsite($website)
    {
        $this->website = $website;

        return $this;
    }

    /**
     * Get website
     *
     * @return string 
     */
    public function getWebsite()
    {
        return $this->website;
    }

       /**
     * Set waecCode
     *
     * @param string $waecCode
     * @return School
     */
    public function setWaecCode($waecCode)
    {
        $this->waecCode = $waecCode;

        return $this;
    }

    /**
     * Get waecCode
     *
     * @return string 
     */
    public function getWaecCode()
    {
        return $this->waecCode;
    }

       /**
     * Set jambCode
     *
     * @param string $jambCode
     * @return School
     */
    public function setJambCode($jambCode)
    {
        $this->jambCode = $jambCode;

        return $this;
    }

    /**
     * Get jambCode
     *
     * @return string 
     */
    public function getJambCode()
    {
        return $this->jambCode;
    }

       /**
     * Set necoCode
     *
     * @param string $necoCode
     * @return School
     */
    public function setNecoCode($necoCode)
    {
        $this->necoCode = $necoCode;

        return $this;
    }

    /**
     * Get necoCode
     *
     * @return string 
     */
    public function getNecoCode()
    {
        return $this->necoCode;
    }

       /**
     * Set nabtedCode
     *
     * @param string $nabtedCode
     * @return School
     */
    public function setNabtedCode($nabtedCode)
    {
        $this->nabtedCode = $nabtedCode;

        return $this;
    }

    /**
     * Get nabtedCode
     *
     * @return string 
     */
    public function getNabtedCode()
    {
        return $this->nabtedCode;
    }







    /**
     * Set logo
     *
     * @param string $logo
     * @return School
     */
    public function setLogo($logo)
    {
        
                if (is_array($logo) && isset($logo['name'])) {
                    $logo = $logo['name'];
                }

                $this->logo = $logo;
    }

    /**
     * Get logo
     *
     * @return string 
     */
    public function getLogo()
    {
        return $this->logo;
    }


       /**
     * Set signature
     *
     * @param string $signature
     * @return School
     */
    public function setSignature($signature)
    {
        
                if (is_array($signature) && isset($signature['name'])) {
                    $signature = $signature['name'];
                }

                $this->signature = $signature;
    }

    /**
     * Get signature
     *
     * @return string 
     */
    public function getSignature()
    {
        return $this->signature;
    }

    /**
     * Convert the object to an array.
     *
     * @return array
     */
    public function getArrayCopy() 
    {
        return get_object_vars($this);
    }
   
}
