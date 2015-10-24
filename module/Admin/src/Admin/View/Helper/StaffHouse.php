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
*@ORM\Table(name="staff_house")
*@ORM\Entity
*/
class StaffHouse
{
	/**
		* @var integer
		*@ORM\Column(name="id", type="integer", nullable=false)
		*@ORM\Id
		*@ORM\GeneratedValue(strategy="IDENTITY")
		*/
	protected $id;

	 /**
     * @ORM\ManyToOne(targetEntity="Admin\Entity\Staff", cascade={"persist"})
     */
    protected $staff;


     /**
    *@var integer $house
     *@ORM\ManyToOne(targetEntity="House",  fetch="EAGER")
    **/
    protected $house;


     /**
    *@var integer $year
    *@ORM\ManyToOne(targetEntity="Year",)
    **/
    protected $year;

  

      public function __construct()
    {
        $this->theDate = new \DateTime();
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
     * Set student
    *
    * @param Staff $staff
    * @return StaffHouse
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
        return $this->Staff;
    }


     /**
     * Set house
    *
    * @param House $house
    * @return StudentHouse
    */
    public function setHouse(House $house = null)
    {
        $this->house = $house;

        return $this;
    }

    /**
    *@return House
    **/
    public function getHouse()
    {
        return $this->house;
    }

   


    /**
     * Set year
    *
    * @param Year $year
    * @return StaffHouse
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
     * Convert the object to an array.
     *
     * @return array
     */
    public function getArrayCopy() 
    {
        return get_object_vars($this);
    }
}