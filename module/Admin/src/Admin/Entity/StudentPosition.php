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
*@ORM\Table(name="student_position")
* @ORM\Entity
*/
class StudentPosition
{
	/**
		* @var integer
		*@ORM\Column(name="id", type="integer", nullable=false)
		*@ORM\Id
		*@ORM\GeneratedValue(strategy="IDENTITY")
		*/
	protected $id;

	 /**
     *@var integer $student
     * @ORM\ManyToOne(targetEntity="Admin\Entity\Student")
     *@ORM\JoinColumn(name="student_id", referencedColumnName="id", onDelete="CASCADE")
     */
    protected $student;

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
    * @return StudentPosition
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
     * Set student
    *
    * @param Student $student
    * @return StudentPosition
    */
    public function setStudent(Student $student)
    {
        $this->student = $student;

        return $this;
    }

    /**
    *@return Student
    **/
    public function getStudent()
    {
        return $this->student;
    }


    /**
     * Set position
    *
    * @param Position $position
    * @return StudentPosition
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
     * Set section
    *
    * @param Section $section
    * @return StudentPosition
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
     * Convert the object to an array.
     *
     * @return array
     */
    public function getArrayCopy() 
    {
        return get_object_vars($this);
    }
}