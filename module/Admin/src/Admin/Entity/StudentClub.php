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
*@ORM\Table(name="student_club")
*@ORM\Entity
*/
class StudentClub
{
	/**
		* @var integer
		*@ORM\Column(name="id", type="integer", nullable=false)
		*@ORM\Id
		*@ORM\GeneratedValue(strategy="IDENTITY")
		*/
	private $id;

	 /**
     * @ORM\ManyToOne(targetEntity="Admin\Entity\Student")
      *@ORM\JoinColumn(name="student_id", referencedColumnName="id", onDelete="CASCADE")
     */
    protected $student;

  
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
    * @param Student $student
    * @return StudentClub
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
        return $this->Student;
    }

      /**
     * Set club
    *
    * @param Club $club
    * @return StudentClub
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
    * @return Student
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