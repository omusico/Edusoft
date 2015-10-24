<?php

namespace Admin\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Attendance
 *
 * @ORM\Table(name="aggregate")
 * @ORM\Entity
 */
class Aggregate
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
     * @var integer
     *
     * @ORM\Column(name="status", type="integer", nullable=true)
     */
    protected $total;

          /**
     * @var float
     *
     * @ORM\Column(name="reason", type="float", nullable=true)
     */
    protected $average;


     /**
    *@var integer $session
    *@ORM\ManyToOne(targetEntity="Session")
    *@ORM\JoinColumn(name="session_id", referencedColumnName="id")
    **/
    protected $session;


     /**
    *@var integer $class
    *@ORM\ManyToOne(targetEntity="Classes")
    *@ORM\JoinColumn(name="class_id", referencedColumnName="id")
    **/
    protected $class;

         /**
    *@var integer $section
    *@ORM\ManyToOne(targetEntity="Section")
    *@ORM\JoinColumn(name="section_id", referencedColumnName="id")
    **/
    protected $section;

       /**
    *@var integer $student
    *@ORM\ManyToOne(targetEntity="Student")
    *@ORM\JoinColumn(name="student_id", referencedColumnName="id")
    **/
    protected $student;


   
    

   
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
     * Set total
     *
     * @param integer $total
     * @return Aggregate
     */
    public function setTotal($total)
    {
        $this->total = $total;

        return $this;
    }

    /**
     * Get total
     *
     * @return integer 
     */
    public function getTotal()
    {
        return $this->total;
    }

     /**
     * Set average
     *
     * @param float $average
     * @return Aggregate
     */
    public function setAverage($average)
    {
        $this->average = $average;

        return $this;
    }

    /**
     * Get average
     *
     * @return float 
     */
    public function getAverage()
    {
        return $this->average;
    }

    

    /**
     * Set session
     *
     * @param Session $session
     * @return Session
     */
    public function setSession(Session $session)
    {
        $this->session = $session;

        return $this;
    }

    /**
     * Get session
     *
     * @return Session 
     */
    public function getSession()
    {
        return $this->session;
    }



     /**
     * Set class
     *
     * @param Classes $class
     * @return Classes
     */
    public function setClass(Classes $class)
    {
        $this->class = $class;

        return $this;
    }

    /**
     * Get class
     *
     * @return Classes 
     */
    public function getClass()
    {
        return $this->class;
    }

   

      /**
     * Set student
     *
     * @param Student $student
     * @return Student
     */
    public function setStudent(Student $student)
    {
        $this->student = $student;

        return $this;
    }

    /**
     * Get student
     *
     * @return Student 
     */
    public function getStudent()
    {
        return $this->student;
    }

    
  
}
