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
*@ORM\Table(name="staff_club")
*@ORM\Entity
*/
class StaffClub
{
	/**
		* @var integer
		*@ORM\Column(name="id", type="integer", nullable=false)
		*@ORM\Id
		*@ORM\GeneratedValue(strategy="IDENTITY")
		*/
	private $id;

	 /** 
     *@var integer $staff
     * @ORM\ManyToOne(targetEntity="Admin\Entity\Staff")
      *@ORM\JoinColumn(name="staff_id", referencedColumnName="id", onDelete="CASCADE")
     */
    protected $staff;

  
    /**
    *@var integer $club
    *@ORM\ManyToOne(targetEntity="Club", fetch="EAGER")
    **/
    protected $club;

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
    * @return StaffClub
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
     * Set club
    *
    * @param Club $club
    * @return StafftClub
    */
    public function setClub(Club $club = null)
    {
        $this->club = $club;

        return $this;
    }

    /**
    *@return Club
    **/
    public function getClub()
    {
        return $this->club;
    }



    /**
     * Set year
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
     * Convert the object to an array.
     *
     * @return array
     */
    public function getArrayCopy() 
    {
        return get_object_vars($this);
    }
}