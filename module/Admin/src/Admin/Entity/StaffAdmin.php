<?php
/**
 * Cloud Base Educational Management System
 *
 * @author Isaac Bitrus 
 * @copyright Copyright (c) 2015 Edusoft (http://www.edusoft.com.ng)
 */
 
namespace Admin\Entity;
use Doctrine\ORM\Mapping as ORM;
/**
*@ORM\Table(name="staff_admin")
* @ORM\Entity
*/
class StaffAdmin
{
	/**
		* @var integer
		*@ORM\Column(name="id", type="integer", nullable=false)
		*@ORM\Id
		*@ORM\GeneratedValue(strategy="IDENTITY")
		*/
	protected $id;

	 /**
     *@var integer $staff
     * @ORM\ManyToOne(targetEntity="Admin\Entity\Staff", inversedBy="staffadmin", cascade={"persist"})
     *@ORM\JoinColumn(name="staff_id", referencedColumnName="id", onDelete="CASCADE")
     */
    protected $staff;

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
    *@var string $staffno
     * @ORM\Column(name="staff_no", type="string", length=45, nullable=false)
    **/
    protected $staffno;
  
    
      /**
    *@var string $staffno
     * @ORM\Column(name="employment_date", type="string", nullable=true)
    **/
    protected $employdate;

      /**
     * @var string
     *
     * @ORM\Column(name="qualification", type="string",  nullable=true)
     */
    protected $qualification;

    /**
    *@var integer $stafftype
    *@ORM\ManyToOne(targetEntity="StaffType", cascade={"persist"})
    **/
    protected $stafftype;

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
     * Set Session
    *
    * @param Year $year
    * @return StaffAdmin
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
    * @return StaffAdmin
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
    * @return StaffAdmin
    */
    public function setStaffType(StaffType $stafftype)
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
    * @return StaffAdmin
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
    * @return StaffAdmin
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
     * @return StaffAdmin
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
     * Set class
    *
    * @param string $staffno
    * @return StaffAdmin
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
     * Set class
    *
    * @param String $employdate
    * @return StaffAdmin
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
    * @return StaffAdmin
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
    * @return StaffAdmin
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
     * Convert the object to an array.
     *
     * @return array
     */
    public function getArrayCopy() 
    {
        return get_object_vars($this);
    }
}