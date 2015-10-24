<?php

namespace Admin\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Result
 *
 * @ORM\Table(name="result")
 * @ORM\Entity
 */
class Result
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
     * @ORM\Column(name="first_test", type="integer", nullable=true)
     */
    protected $firstTest;

     /**
     * @var integer
     *
     * @ORM\Column(name="second_test", type="integer", nullable=true)
     */
    protected $secondTest;

     /**
     * @var integer
     *
     * @ORM\Column(name="exam", type="integer", nullable=true)
     */
    protected $exam;

     /**
     * @var integer
     *
     * @ORM\Column(name="total", type="integer", nullable=true)
     */
    protected $total;

         /**
     * @var integer
     *
     * @ORM\Column(name="subtotal", type="integer", nullable=true)
     */
    protected $subtotal;

     /**
     * @var integer
     *
     * @ORM\Column(name="status", type="integer", nullable=true)
     */
    protected $status;

        /**
    *@var integer $GradeSystem
    *@ORM\ManyToOne(targetEntity="GradeSystem")
    *@ORM\JoinColumn(name="gradesystem_id", referencedColumnName="id")
    **/
    protected $grade;

     /**
    *@var integer $Session
    *@ORM\ManyToOne(targetEntity="Session")
    *@ORM\JoinColumn(name="session_id", referencedColumnName="id")
    **/
    protected $session;

         /**
    *@var integer $Classes
    *@ORM\ManyToOne(targetEntity="Classes")
    *@ORM\JoinColumn(name="class_id", referencedColumnName="id")
    **/
    protected $class;

      /**
    *@var integer $student
    *@ORM\ManyToOne(targetEntity="Student", inversedBy="result")
    *@ORM\JoinColumn(name="student_id", referencedColumnName="id", onDelete="CASCADE")
    **/
    protected $student;

        /**
    *@var integer $subject
    *@ORM\ManyToOne(targetEntity="Subject")
    *@ORM\JoinColumn(name="subject_id", referencedColumnName="id")
    **/
    protected $subject;



   

   
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
     * Set firstTest
     *
     * @param integer $firstTest
     * @return Result
     */
    public function setFirstTest($firstTest)
    {
        $this->firstTest = $firstTest;

        return $this;
    }

    /**
     * Get firstTest
     *
     * @return integer 
     */
    public function getFirstTest()
    {
        return $this->firstTest;
    }

    /**
     * Set secondTest
     *
     * @param integer $secondTest
     * @return Result
     */
    public function setSecondTest($secondTest)
    {
        $this->secondTest = $secondTest;

        return $this;
    }

    /**
     * Get secondTest
     *
     * @return integer 
     */
    public function getSecondTest()
    {
        return $this->secondTest;
    }

        /**
     * Set status
     *
     * @param integer $status
     * @return Result
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get status
     *
     * @return integer 
     */
    public function getStatus()
    {
        return $this->status;
    }



         /**
     * Set total
     *
     * @param integer $total
     * @return Result
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
     * Set subtotal
     *
     * @param integer $subtotal
     * @return Result
     */
    public function setSubTotal($subtotal)
    {
        $this->subtotal = $subtotal;

        return $this;
    }

    /**
     * Get subtotal
     *
     * @return integer 
     */
    public function getSubTotal()
    {
        return $this->subtotal;
    }

 


     /**
     * Set exam
     *
     * @param integer $exam
     * @return Result
     */
    public function setExam($exam)
    {
        $this->exam = $exam;

        return $this;
    }

    /**
     * Get exam
     *
     * @return integer 
     */
    public function getExam()
    {
        return $this->exam;
    }


         /**
     * Set grade
     *
     * @param GradeSystem $grade
     * @return GradeSystem
     */
    public function setGrade(GradeSystem $grade = null)
    {
        $this->grade = $grade;

        return $this;
    }

    /**
     * Get grade
     *
     * @return GradeSystem 
     */
    public function getGrade()
    {
        return $this->grade;
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
     * Set student
     *
     * @param Student $student
     * @return Session
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

      /**
     * Set subject
     *
     * @param Subject $subject
     * @return Subject
     */
    public function setSubject(Subject $subject)
    {
        $this->subject = $subject;

        return $this;
    }

    /**
     * Get subject
     *
     * @return Subject 
     */
    public function getSubject()
    {
        return $this->subject;
    }
  
}
