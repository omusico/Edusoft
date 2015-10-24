<?php

namespace Admin\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Attendance
 *
 * @ORM\Table(name="attendance")
 * @ORM\Entity
 */
class Attendance
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
     * @var string
     *
     * @ORM\Column(name="status", type="string", nullable=true)
     */
    protected $status;

          /**
     * @var string
     *
     * @ORM\Column(name="reason", type="string", nullable=true)
     */
    protected $reason;

          /**
     * @var string
     *
     * @ORM\Column(name="date", type="datetime", nullable=true)
     */
    protected $date;

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
     * Set status
     *
     * @param string $status
     * @return Attendance
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get reason
     *
     * @return string 
     */
    public function getReason()
    {
        return $this->reason;
    }

     /**
     * Set reason
     *
     * @param string $reason
     * @return Attendance
     */
    public function setReason($reason)
    {
        $this->reason = $reason;

        return $this;
    }

    /**
     * Get status
     *
     * @return string 
     */
    public function getStatus()
    {
        return $this->status;
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

    public function setDate(\DateTime $date = null){
        
        if ($date==null){
            $date = new \DateTime("now");
        }
        $this->date = $date;
        return $this;
    }
    
    
    public function getDate(){
                
        if (!isset($this->date)){
            $this->setDate();
        }
        return $this->date->format('Y-m-d H:i');
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

      /**
     * Set section
     *
     * @param Section $section
     * @return Section
     */
    public function setSection(Section $section)
    {
        $this->section = $section;

        return $this;
    }

    /**
     * Get section
     *
     * @return Section 
     */
    public function getSection()
    {
        return $this->section;
    }


  
}
