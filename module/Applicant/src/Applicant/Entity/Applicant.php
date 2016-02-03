<?php
/**
 * Cloud Base School Management System
 *
 * @author Isaac Bitrus 
 * @copyright Copyright (c) 2015 Edusoft (http://www.edusoft.com.ng)
 */

namespace Applicant\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="Applicant\Repository\ApplicantRepository")
 * @ORM\Table(name="applicant")
 */
class Applicant implements ApplicantInterface
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
     * @ORM\Column(name="applicant_Id", type="string", length=45, nullable=false)
     */
    protected $applicantId;

    /**
     * @var string
     *
     * @ORM\Column(name="status", type="string", length=45, nullable=false)
     */
    protected $status;


    /**
     * @ORM\ManyToOne(targetEntity="\EduUser\Entity\User")
     * @ORM\JoinColumn(name="user", referencedColumnName="id",  onDelete="SET NULL")
     */
    protected $user;

    /**
     * @ORM\ManyToOne(targetEntity="Applicant\Entity\Person", inversedBy="applicant", cascade={"persist"})
     */
    protected $person;



    /**
    *@var integer $secondChoice
    *@ORM\ManyToOne(targetEntity="\Admin\Entity\Classes")
    *@ORM\JoinColumn(name="class", referencedColumnName="id")
    **/
    protected $class;

     
     /**
    *@var integer $programme
    *@ORM\ManyToOne(targetEntity="\Admin\Entity\Section")
    *@ORM\JoinColumn(name="section", referencedColumnName="id")
    **/
    protected $section;

     /**
    *@var integer $academicYear
    *@ORM\ManyToOne(targetEntity="\Admin\Entity\AcademicYear")
    *@ORM\JoinColumn(name="academic_year", referencedColumnName="id")
    **/
    protected $academicYear;

     /**
    *@var integer $courseGiven
    *@ORM\ManyToOne(targetEntity="\Admin\Entity\Classes")
    *@ORM\JoinColumn(name="class_admitted", referencedColumnName="id")
    **/
    protected $classAdmitted;

     

    /**
     * Set id.
     *
     * @param int $id
     * @return PersonInterface
     */
    public function setId($id)
    {
        $this->id = (int) $id;
        return $this;
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
     * Set applicantId
     *
     * @param string $applicantId
     * @return ApplicantInterface
     */
    public function setApplicantId($applicantId)
    {
        $this->applicantId = $applicantId;

        return $this;
    }

    /**
     * Get applicantId
     *
     * @return string 
     */
    public function getApplicantId()
    {
        return $this->applicantId;
    }


     /**
     * Set status
     *
     * @param string $status
     * @return ApplicantInterface
     */
    public function setStatus($status)
    {
        $this->status = $status;

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
     * Set person 
     *
     * @param \Applicant\Entity\Person $person
     * @return ApplicantInterface
     */
    public function setPerson(\Applicant\Entity\Person $person)
    {
        $this->person = $person;

        return $this;
    }

    /**
     * Get person
     *
     * @return \Applicant\Entity\Person
     */
    public function getPerson()
    {
        return $this->person;
    }


    /**
     * Set class 
     *
     * @param \Admin\Entity\Department $class
     * @return ApplicantInterface
     */
    public function setClass(\Admin\Entity\Classes $class)
    {
        $this->class = $class;

        return $this;
    }

    /**
     * Get class
     *
     * @return \Admin\Entity\Classes
     */
    public function getClasses()
    {
        return $this->class;
    }




    /**
     * Set section
     *
     * @param \Admin\Entity\Section $section
     * @return ApplicantInterface
     */
    public function setSection(\Admin\Entity\Section $section=null)
    {
        $this->section = $section;

        return $this;
    }

    /**
     * Get section
     *
     * @return \Admin\Entity\Section 
     */
    public function getSection()
    {
        return $this->section;
    }


    /**
     * Set academicYear
     *
     * @param \Admin\Entity\AcademicYear $academicYear
     * @return ApplicantInterface
     */
    public function setAcademicYear(\Admin\Entity\AcademicYear $academicYear=null)
    {
        $this->academicYear = $academicYear;

        return $this;
    }

    /**
     * Get academicYear
     *
     * @return \Admin\Entity\AcademicYear 
     */
    public function getAcademicYear()
    {
        return $this->academicYear;
    }


    /**
    * Set classAdmitted
    *
    * @param \Admin\Entity\Classes $classAdmitted
    * @return ApplicantInterface
    */
    public function setClassAdmitted(\Admin\Entity\Classes $classAdmitted=null)
    {
        $this->classAdmitted = $classAdmitted;

        return $this;
    }

    /**
    *@return classAdmitted
    **/
    public function getClassAdmitted()
    {
        return $this->classAdmitted;
    }
    
    /**
    * Set user
    *
    * @param \EduUser\Entity\User $user
    * @return ApplicantInterface
    */
    public function setUser(\EduUser\Entity\User $user=null)
    {
        $this->user = $user;

        return $this;
    }

    /**
    *@return User
    **/
    public function getUser()
    {
        return $this->user;
    }

    

   
}
