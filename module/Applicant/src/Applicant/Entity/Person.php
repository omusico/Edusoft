<?php
/**
 * Cloud Base School Management System
 *
 * @author Isaac Bitrus 
 * @copyright Copyright (c) 2015 Edusoft (http://www.edusoft.com.ng)
 */

namespace Applicant\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="Applicant\Repository\PersonRepository")
 * @ORM\Table(name="person")
 */
class Person implements PersonInterface
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
     * @var string
     *
     * @ORM\Column(name="fname", type="string", length=45, nullable=false)
     */
    protected $firstName;

    /**
     * @var string
     *
     * @ORM\Column(name="lname", type="string", length=45, nullable=false)
     */
    protected $lastName;

    /**
     * @var string
     *
     * @ORM\Column(name="mname", type="string", length=45, nullable=true)
     */
    protected $middleName;

    /**
     * @var string
     *
     * @ORM\Column(name="sex", type="string", length=6, nullable=false)
     */
    protected $sex;

    /**
     * @var string
     *
     * @ORM\Column(name="mobile", type="string", nullable=true)
     */
   protected $mobile;

    /**
     * @var string
     *
     * @ORM\Column(name="residential_address", type="string", length=250, nullable=false)
     */
    protected $residentialAddress;

        /**
     * @var string
     *
     * @ORM\Column(name="permanent_address", type="string", length=250, nullable=false)
     */
    protected $permanentAddress;

    /**
     * @var string
     *
     * @ORM\Column(name="religion", type="string", length=250, nullable=false)
     */
    protected $religion;

    /**
     * @var string
     *
     * @ORM\Column(name="dob", type="string", length=250, nullable=false)
     */
    protected $dob;

    /**
    *@var integer $country
    *@ORM\ManyToOne(targetEntity="\Admin\Entity\Country")
    *@ORM\JoinColumn(name="country", referencedColumnName="id")
    **/
    protected $country;

    /**
    *@var integer $state
    *@ORM\ManyToOne(targetEntity="\Admin\Entity\State")
    *@ORM\JoinColumn(name="state", referencedColumnName="id")
    **/
    protected $state;

     /**
    *@var integer $lga
    *@ORM\ManyToOne(targetEntity="\Admin\Entity\Lga")
    *@ORM\JoinColumn(name="lga", referencedColumnName="id")
    **/
    protected $lga;

    /**
     * @var string
     *
     * @ORM\Column(name="nok_rel", type="string", length=45, nullable=true)
     */
    protected $nokRel;

    /**
     * @var string
     *
     * @ORM\Column(name="nok_name", type="string", length=45, nullable=true)
     */
    protected $nokName;

    /**
     * @var string
     *
     * @ORM\Column(name="nok_mobile", type="string", nullable=true)
     */
    protected $nokMobile;  

    /**
     * @ORM\OneToOne(targetEntity="Guardian", inversedBy="person", cascade={"persist"})
     */
    protected $guardian;



     /**
     * @var string
     *
     * @ORM\Column(name="image", type="string",  nullable=true)
     */
    protected $image;

 

     public function __construct() {
        $this->guardian = new ArrayCollection();
    }

                /**
     * Set id.
     *
     * @param int $id
     * @return PersonInterface
     */
    public function setId($id)
    {
        $this->id = (int) $id;
        return $this;
    }

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
     * Allow null to remove association
     *
     * @param Guardian $guardian
     */
    public function setGuardian(Guardian $guardian = null)
    {
        $this->guardian = $guardian;
    }

    /**
     * @return Guardian
     */
    public function getGuardian()
    {
        return $this->guardian;
    }


    /**
     * Set firstName
     *
     * @param string $firstName
     * @return PersonInterface
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;

        return $this;
    }

    /**
     * Get firstName
     *
     * @return string 
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

     /**
     * Set religion
     *
     * @param string $religion
     * @return PersonInterface
     */
    public function setReligion($religion)
    {
        $this->religion = $religion;

        return $this;
    }

    /**
     * Get religion
     *
     * @return string 
     */
    public function getReligion()
    {
        return $this->religion;
    }

         /**
     *@param string $dob
    *@return PersonInterface
    **/
    public function SetDob($dob)
    {
         $this->dob = $dob;
         return $this;
    }

     /**
     * Get dob
     * @param string $dob
     * @return string
     */
    public function getDob()
    {
       //  $startDate = $this->startDate->format('d/m/Y');
       // return $startDate;
        return $this->dob;
    }


    /**
     * Set lastName
     *
     * @param string $lastName
     * @return PersonInterface
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;

        return $this;
    }

    /**
     * Get lastName
     *
     * @return string 
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * Set middleName
     *
     * @param string $middleName
     * @return PersonInterface
     */
    public function setMiddleName($middleName)
    {
        $this->middleName = $middleName;

        return $this;
    }

    /**
     * Get middleName
     *
     * @return string 
     */
    public function getMiddleName()
    {
        return $this->middleName;
    }

    /**
     * Set sex
     *
     * @param string $sex
     * @return PersonInterface
     */
    public function setSex($sex)
    {
        $this->sex = $sex;

        return $this;
    }

    /**
     * Get sex
     *
     * @return string 
     */
    public function getSex()
    {
        return $this->sex;
    }

    /**
     * Set mobile
     *
     * @param string $mobile
     * @return PersonInterface
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
     * Set residentialAddress
     *
     * @param string $residentialAddress
     * @return PersonInterface
     */
    public function setResidentialAddress($residentialAddress)
    {
        $this->residentialAddress = $residentialAddress;

        return $this;
    }

    /**
     * Get residentialAddress
     *
     * @return string 
     */
    public function getResidentialAddress()
    {
        return $this->residentialAddress;
    }

    /**
     * Set permanentAddress
     *
     * @param string $permanentAddress
     * @return PersonInterface
     */
    public function setPermanentAddress($permanentAddress)
    {
        $this->permanentAddress = $permanentAddress;

        return $this;
    }

    /**
     * Get permanentAddress
     *
     * @return string 
     */
    public function getPermanentAddress()
    {
        return $this->permanentAddress;
    }
        /**
     * Set country
     *
     * @param \Admin\Entity\Country $country
     * @return PersonInterface
     */
    public function setCountry(\Admin\Entity\Country $country)
    {
        $this->country = $country;

        return $this;
    }

    /**
     * Get country
     *
     * @return \Admin\Entity\Country
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * Set state
     *
     * @param \Admin\Entity\State $state
     * @return PersonInterface
     */
    public function setState(\Admin\Entity\State $state)
    {
        $this->state = $state;

        return $this;
    }

    /**
     * Get state
     *
     * @return \Admin\Entity\State
     */
    public function getState()
    {
        return $this->state;
    }

    /**
     * Set lga
     *
     * @param \Admin\Entity\Lga $lga
     * @return PersonInterface
     */
    public function setLga(\Admin\Entity\Lga $lga)
    {
        $this->lga = $lga;

        return $this;
    }

    /**
     * Get lgaCode
     *
     * @return \Admin\Entity\Lga 
     */
    public function getLga()
    {
        return $this->lga;
    }

    /**
     * Set nokRel
     *
     * @param string $nokRel
     * @return PersonInterface
     */
    public function setNokRel($nokRel)
    {
        $this->nokRel = $nokRel;

        return $this;
    }

    /**
     * Get nokRel
     *
     * @return string 
     */
    public function getNokRel()
    {
        return $this->nokRel;
    }

    /**
     * Set nokName
     *
     * @param string $nokName
     * @return PersonInterface
     */
    public function setNokName($nokName)
    {
        $this->nokName = $nokName;

        return $this;
    }

    /**
     * Get nokName
     *
     * @return string 
     */
    public function getNokName()
    {
        return $this->nokName;
    }

    /**
     * Set nokMobile
     *
     * @param string $nokMobile
     * @return PersonInterface
     */
    public function setNokMobile($nokMobile)
    {
        $this->nokMobile = $nokMobile;

        return $this;
    }

    /**
     * Get nokMobile
     *
     * @return string 
     */
    public function getNokMobile()
    {
        return $this->nokMobile;
    }


        /**
     * Set image
     *
     * @param string $image
     * @return PersonInterface
     */
    public function setImage($image)
    {
        
          if (is_array($image) && isset($image['name'])) {
                    $image = $image['name'];
                }
                if (empty($image)) {
                    $image='avatar.png';
                }

                $this->image = $image;
                return $this;
    }

    /**
     * Get image
     *
     * @return string 
     */
    public function getImage()
    {
        return $this->image;
    }

    

   
}
