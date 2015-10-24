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
*@ORM\Table(name="staff_history")
* @ORM\Entity
*/
class StaffHistory
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
     * @ORM\ManyToOne(targetEntity="Admin\Entity\Staff")
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
    * @return StaffHistory
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
    * @return StaffHistory
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
     * Set level
    *
    * @param Level $level
    * @return StaffHistory
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
    * @return StaffHistory
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
     * Convert the object to an array.
     *
     * @return array
     */
    public function getArrayCopy() 
    {
        return get_object_vars($this);
    }
}