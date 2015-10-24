<?php

namespace Admin\Entity;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Staff
 *
 * @ORM\Table(name="staff")
 * @ORM\Entity
 */
class Staff
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
     * @ORM\ManyToOne(targetEntity="\EduUser\Entity\User")
     * @ORM\JoinColumn(name="user", referencedColumnName="id",  onDelete="SET NULL")
     */
    protected $user;

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
     * @ORM\Column(name="mobile1", type="string", nullable=true)
     */
   protected $mobile1;

       /**
     * @var string
     *
     * @ORM\Column(name="mobile2", type="string", nullable=true)
     */
   protected $mobile2;

    /**
     * @var string
     *
     * @ORM\Column(name="residential_address", type="string", length=250, nullable=false)
     */
    protected $raddress;
    /**
     * @var string
     *
     * @ORM\Column(name="religion", type="string", length=250, nullable=false)
     */
    protected $religion;

    /**
     * @var \Date
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
     * @var integer
     *
     * @ORM\Column(name="nok_mobile", type="integer", nullable=true)
     */
    protected $nokMobile;

    /**
     * @var string
     *
     * @ORM\Column(name="image", type="string",  nullable=true)
     */
    protected $image;

        /**
     * @var string
     *
     * @ORM\Column(name="email", type="string",  nullable=true)
     */
    protected $email;

        /**
     * @var string
     *
     * @ORM\Column(name="facebook", type="string",  nullable=true)
     */
    protected $facebook;

        /**
     * @var string
     *
     * @ORM\Column(name="twitter", type="string",  nullable=true)
     */
    protected $twitter;

        /**
     * @var string
     *
     * @ORM\Column(name="permanent_address", type="string",  nullable=true)
     */
    protected $paddress;

        /**
    *@var integer $year
    *@ORM\ManyToOne(targetEntity="Year", cascade={"persist"})
    **/
    protected $year;

     /**
    *@var integer $level
    *@ORM\ManyToOne(targetEntity="Level", cascade={"persist"})
    **/
    protected $level;

          /**
    *@var integer $step
    *@ORM\ManyToOne(targetEntity="Step", cascade={"persist"})
    **/
    protected $step;

      /**
    *@var string 
     * @ORM\Column(name="staff_no", type="string",  nullable=false)
    **/
    protected $staffno;
  
    
      /**
    *@var string 
     * @ORM\Column(name="employment_date", type="string", nullable=true)
    **/
    protected $employdate;

     /**
    *@var integer $stafftype
    *@ORM\ManyToOne(targetEntity="StaffType", cascade={"persist"})
    **/
    protected $stafftype;

      /**
     * @var string
     *
     * @ORM\Column(name="qualification", type="string",  nullable=true)
     */
    protected $qualification;

   

      /**
    *@var integer $clevel
    *@ORM\ManyToOne(targetEntity="Level", cascade={"persist"})
    **/
    protected $clevel;

          /**
    *@var integer $cstep
    *@ORM\ManyToOne(targetEntity="Step", cascade={"persist"})
    **/
    protected $cstep;

    /**
    *@var string $status
    *@ORM\Column(name="status", type="string", nullable=true)
    **/
    protected $status;

  

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
     * Set user
    *
    * @param \EduUser\Entity\User $user
    * @return \EduUser\Entity\User
    */
    public function setUser(\EduUser\Entity\User $user=null)
    {
        $this->user = $user;

        return $this;
    }

    /**
    *@return User
    **/
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set fname
     *
     * @param string $fname
     * @return Staff
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
     * @return Staff
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
    *@return Staff
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
     * Set facebook
     *
     * @param string $facebook
     * @return Staff
     */
    public function setFacebook($facebook)
    {
        $this->facebook = $facebook;

        return $this;
    }

    /**
     * Get facebook
     *
     * @return string 
     */
    public function getFacebook()
    {
        return $this->facebook;
    }

      /**
     * Set twitter
     *
     * @param string $twitter
     * @return Staff
     */
    public function setTwitter($twitter)
    {
        $this->twitter = $twitter;

        return $this;
    }

    /**
     * Get twitter
     *
     * @return string 
     */
    public function getTwitter()
    {
        return $this->twitter;
    }


      /**
     * Set email
     *
     * @param string $email
     * @return Staff
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
     * Set lname
     *
     * @param string $lname
     * @return Staff
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
     * @return Staff
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
     * @return Staff
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
     * @param string $mobile1
     * @return Staff
     */
    public function setMobile1($mobile1)
    {
        $this->mobile1 = $mobile1;

        return $this;
    }

    /**
     * Get mobile
     *
     * @return string 
     */
    public function getMobile1()
    {
        return $this->mobile1;
    }

      /**
     * Set mobile
     *
     * @param string $mobile2
     * @return Staff
     */
    public function setMobile2($mobile2)
    {
        $this->mobile2 = $mobile2;

        return $this;
    }

    /**
     * Get mobile2
     *
     * @return string 
     */
    public function getMobile2()
    {
        return $this->mobile2;
    }

    /**
     * Set raddress
     *
     * @param string $raddress
     * @return Staff
     */
    public function setRaddress($raddress)
    {
        $this->raddress = $raddress;

        return $this;
    }

    /**
     * Get raddress
     *
     * @return string 
     */
    public function getRaddress()
    {
        return $this->raddress;
    }

    /**
     * Set paddress
     *
     * @param string $paddress
     * @return Staff
     */
    public function setPaddress($paddress)
    {
        $this->paddress = $paddress;

        return $this;
    }

    /**
     * Get paddress
     *
     * @return string 
     */
    public function getPaddress()
    {
        return $this->paddress;
    }
        /**
     * Set country
     *
     * @param Country $country
     * @return Staff
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
     * @return Staff
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
     * @return Staff
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
     * @return Staff
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
     * @return Staff
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
     * @param integer $nokMobile
     * @return Staff
     */
    public function setNokMobile($nokMobile)
    {
        $this->nokMobile = $nokMobile;

        return $this;
    }

    /**
     * Get nokMobile
     *
     * @return integer 
     */
    public function getNokMobile()
    {
        return $this->nokMobile;
    }

    /**
     * Set Session
    *
    * @param Year $year
    * @return Staff
    */
    public function setYear(Year $year)
    {
        $this->year = $year;

        return $this;
    }

    /**
    *@return Year
    **/
    public function getYear()
    {
        return $this->year;
    }


    /**
     * Set staff
    *
    * @param Staff $staff
    * @return Staff
    */
    public function setStaff(Staff $staff)
    {
        $this->staff = $staff;

        return $this;
    }

    /**
    *@return Staff
    **/
    public function getStaff()
    {
        return $this->staff;
    }


   
     /**
     * Set class
    *
    * @param StaffType $stafftype
    * @return Staff
    */
    public function setStaffType(StaffType $stafftype = null)
    {
        $this->stafftype = $stafftype;

        return $this;
    }

    /**
    *@return StaffType
    **/
    public function getStaffType()
    {
        return $this->stafftype;
    }


     /**
     * Set level
    *
    * @param Level $level
    * @return Staff
    */
    public function setLevel(Level $level)
    {
        $this->level = $level;

        return $this;
    }

    /**
    *@return Level
    **/
    public function getLevel()
    {
        return $this->level;
    }

     /**
     * Set step
    *
    * @param Step $step
    * @return Staff
    */
    public function setStep(Step $step)
    {
        $this->step = $step;

        return $this;
    }

    /**
    *@return Step
    **/
    public function getStep()
    {
        return $this->step;
    }

      /**
     * Set qualification
     *
     * @param string $qualification
     * @return Staff
     */
    public function setQualification($qualification)
    {
                $this->qualification = $qualification;
                return $this;
    }

    /**
     * Get qualification
     *
     * @return string 
     */
    public function getQualification()
    {
        return $this->qualification;
    }

     /**
     * Set staffno
    *
    * @param string $staffno
    * @return Staff
    */
    public function setStaffNo($staffno)
    {
        $this->staffno = $staffno;

        return $this;
    }

    /**
    *@return string
    **/
    public function getStaffNo()
    {
        return $this->staffno;
    }



     /**
     * Set class
    *
    * @param string $status
    * @return StaffAdmin
    */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
    *@return string
    **/
    public function getStatus()
    {
        return $this->status;
    }


        /**
     * Set employdate
    *
    * @param String $employdate
    * @return Staff
    */
    public function setEmployDate($employdate)
    {
        $this->employdate = $employdate;

        return $this;
    }

    /**
    *@return string
    **/
    public function getEmployDate()
    {
        return $this->employdate;
    }


     /**
     * Set level
    *
    * @param Level $clevel
    * @return Staff
    */
    public function setClevel(Level $clevel=null)
    {
        $this->clevel = $clevel;

        return $this;
    }

    /**
    *@return Level
    **/
    public function getClevel()
    {
        return $this->clevel;
    }

     /**
     * Set step
    *
    * @param Step $cstep
    * @return Staff
    */
    public function setCstep(Step $cstep=null)
    {
        $this->cstep = $cstep;

        return $this;
    }

    /**
    *@return Step
    **/
    public function getCstep()
    {
        return $this->cstep;
    }


    /**
     * Set image
     *
     * @param string $image
     * @return Staff
     */
    public function setImage($image)
    {
        
                if (is_array($image) && isset($image['name'])) {
                    $image = $image['name'];
                }

                $this->image = $image;
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
