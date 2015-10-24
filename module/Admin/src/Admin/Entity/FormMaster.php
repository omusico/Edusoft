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
*@ORM\Table(name="form_master")
* @ORM\Entity
*/
class FormMaster
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
    *@var integer $class
    *@ORM\ManyToOne(targetEntity="Classes", cascade={"persist"})
    **/
    protected $class;


  
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
    * @return FormMaster
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
    * @return FormMaster
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
    * @param Classes $class
    * @return FormMaster
    */
    public function setClass(Classes $class)
    {
        $this->class = $class;

        return $this;
    }

    /**
    *@return Classes
    **/
    public function getClass()
    {
        return $this->class;
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