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
*@ORM\Table(name="staff_position")
* @ORM\Entity
*/
class StaffPosition
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
    *@var integer $section
    *@ORM\ManyToOne(targetEntity="Section", cascade={"persist"})
    **/
    protected $section;

        /**
    *@var integer $position
    *@ORM\ManyToOne(targetEntity="Position", cascade={"persist"})
    **/
    protected $position;



  
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
    * @return StaffPosition
    */
    public function setYear(Year $year)
    {
        $this->year = $year;

        return $this;
    }

         /**
     * Set section
    *
    * @param Section $section
    * @return StaffPosition
    */
    public function setSection(Section $section)
    {
        $this->section = $section;

        return $this;
    }

    /**
    *@return Section
    **/
    public function getSection()
    {
        return $this->section;
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
    * @return StaffPosition
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
     * Set position
    *
    * @param Position $position
    * @return StaffPosition
    */
    public function setPosition(Position $position)
    {
        $this->position = $position;

        return $this;
    }

    /**
    *@return Position
    **/
    public function getPosition()
    {
        return $this->position;
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