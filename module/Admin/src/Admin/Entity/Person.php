<?php

namespace Admin\Entity;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

use Doctrine\ORM\Mapping as ORM;

/**
 * Person
 *
 * @ORM\Table(name="person")
 * @ORM\Entity
 */
class Person
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
    protected $fname;

    /**
     * @var string
     *
     * @ORM\Column(name="lname", type="string", length=45, nullable=false)
     */
    protected $lname;

    /**
     * @var string
     *
     * @ORM\Column(name="mname", type="string", length=45, nullable=true)
     */
    protected $mname;

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
     * @ORM\Column(name="address", type="string", length=250, nullable=false)
     */
    protected $address;
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
    *@ORM\ManyToOne(targetEntity="Country")
    *@ORM\JoinColumn(name="country", referencedColumnName="id")
    **/
    protected $country;

    /**
    *@var integer $state
    *@ORM\ManyToOne(targetEntity="State")
    *@ORM\JoinColumn(name="state", referencedColumnName="id")
    **/
    protected $state;

     /**
    *@var integer $lga
    *@ORM\ManyToOne(targetEntity="Lga")
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
     * @ORM\ManyToOne(targetEntity="Admin\Entity\Guardian", inversedBy="person", cascade={"persist"})
     */
    protected $guardian;

    /**
     * @ORM\OneToMany(targetEntity="Admin\Entity\Student", mappedBy="person", cascade={"persist"})
     */
    protected $student;

     public function __construct() {
        $this->student = new ArrayCollection();
    }

     /**
     * @return Collection
     */
    public function getStudent()
    {
        return $this->student;
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
     * Set fname
     *
     * @param string $fname
     * @return Person
     */
    public function setFname($fname)
    {
        $this->fname = $fname;

        return $this;
    }

    /**
     * Get fname
     *
     * @return string 
     */
    public function getFname()
    {
        return $this->fname;
    }

     /**
     * Set religion
     *
     * @param string $religion
     * @return Person
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
    *@return Person
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
     * Set lname
     *
     * @param string $lname
     * @return Person
     */
    public function setLname($lname)
    {
        $this->lname = $lname;

        return $this;
    }

    /**
     * Get lname
     *
     * @return string 
     */
    public function getLname()
    {
        return $this->lname;
    }

    /**
     * Set mname
     *
     * @param string $mname
     * @return Person
     */
    public function setMname($mname)
    {
        $this->mname = $mname;

        return $this;
    }

    /**
     * Get mname
     *
     * @return string 
     */
    public function getMname()
    {
        return $this->mname;
    }

    /**
     * Set sex
     *
     * @param string $sex
     * @return Person
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
     * @return Person
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
     * Set address
     *
     * @param string $address
     * @return Person
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
     * Set country
     *
     * @param Country $country
     * @return Person
     */
    public function setCountry(Country $country)
    {
        $this->country = $country;

        return $this;
    }

    /**
     * Get country
     *
     * @return Country
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * Set state
     *
     * @param State $state
     * @return Person
     */
    public function setState(State $state)
    {
        $this->state = $state;

        return $this;
    }

    /**
     * Get state
     *
     * @return State
     */
    public function getState()
    {
        return $this->state;
    }

    /**
     * Set lga
     *
     * @param Lga $lga
     * @return Person
     */
    public function setLga(Lga $lga)
    {
        $this->lga = $lga;

        return $this;
    }

    /**
     * Get lgaCode
     *
     * @return Lga 
     */
    public function getLga()
    {
        return $this->lga;
    }

    /**
     * Set nokRel
     *
     * @param string $nokRel
     * @return Person
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
     * @return Person
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
     * @return Person
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

    

   
}
