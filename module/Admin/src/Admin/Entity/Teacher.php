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
*@ORM\Table(name="teacher")
*@ORM\Entity
*/
class Teacher
{
	/**
		* @var integer
		*@ORM\Column(name="id", type="integer", nullable=false)
		*@ORM\Id
		*@ORM\GeneratedValue(strategy="IDENTITY")
		*/
	protected $id;


    /**
    *@var integer $session
    *@ORM\ManyToOne(targetEntity="Session", fetch="EAGER")
    **/
    protected $session;


    /**
    *@var integer $initial
    *@ORM\ManyToOne(targetEntity="Classes", fetch="EAGER")
    **/
    protected $class;

    /**
    *@var integer $subject
    *@ORM\ManyToOne(targetEntity="Subject", fetch="EAGER")
    **/
    protected $subject;

      /**
    *@var integer $staff
    *@ORM\ManyToOne(targetEntity="Staff", fetch="EAGER")
    **/
    protected $staff;

    
 
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
    *@return Session
    **/
    public function getSession()
    {
        return $this->session;
    }


    /**
     * Set Class
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
    *@return Classes
    **/
    public function getClass()
    {
        return $this->class;
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
    *@return Subject
    **/
    public function getSubject()
    {
        return $this->subject;
    }


      /**
     * Set staff
    *
    * @param Staff $staff
    * @return Staff
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
     * Convert the object to an array.
     *
     * @return array
     */
    public function getArrayCopy() 
    {
        return get_object_vars($this);
    }
}