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
*@ORM\Table(name="student_history")
* @ORM\Entity(repositoryClass="Admin\Repository\StudentHistoryRepository")
*/
class StudentHistory
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
    *@var integer $year
    *@ORM\ManyToOne(targetEntity="Year", cascade={"persist"})
    **/
    private $year;

    
    /**
    *@var integer $class
    *@ORM\ManyToOne(targetEntity="Classes", cascade={"persist"})
    **/
    private $class;


  
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
    * @return StudentHistory
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
    * @return StudentHistory
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
     * Set class
    *
    * @param Classes $class
    * @return StudentHistory
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