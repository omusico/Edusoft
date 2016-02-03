<?php

/**
  * Edusoft Cloud Base School Management System
 *
 * @author Isaac Bitrus 
 * @copyright Copyright (c) 2016 Isaac Bitrus (http://www.edusoft.com.ng)
 */

namespace Applicant\Entity;

interface ApplicantInterface
{
     /**
     * Set id.
     *
     * @param int $id
     * @return PersonInterface
     */
    public function setId($id);

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId();

    /**
     * Set applicantId
     *
     * @param string $applicantId
     * @return ApplicantInterface
     */
    public function setApplicantId($applicantId);

    /**
     * Get applicantId
     *
     * @return string 
     */
    public function getApplicantId();


     /**
     * Set status
     *
     * @param string $status
     * @return ApplicantInterface
     */
    public function setStatus($status);

    /**
     * Get status
     *
     * @return string 
     */
    public function getStatus();



    /**
     * Set person 
     *
     * @param \Applicant\Entity\Person $person
     * @return ApplicantInterface
     */
    public function setPerson(\Applicant\Entity\Person $person);

    /**
     * Get person
     *
     * @return \Applicant\Entity\Person
     */
    public function getPerson();


    /**
     * Set class 
     *
     * @param \Admin\Entity\Department $class
     * @return ApplicantInterface
     */
    public function setClass(\Admin\Entity\Classes $class);

    /**
     * Get class
     *
     * @return \Admin\Entity\Classes
     */
    public function getClasses();




    /**
     * Set section
     *
     * @param \Admin\Entity\Section $section
     * @return ApplicantInterface
     */
    public function setSection(\Admin\Entity\Section $section=null);

    /**
     * Get section
     *
     * @return \Admin\Entity\Section 
     */
    public function getSection();


    /**
     * Set academicYear
     *
     * @param \Admin\Entity\AcademicYear $academicYear
     * @return ApplicantInterface
     */
    public function setAcademicYear(\Admin\Entity\AcademicYear $academicYear=null);

    /**
     * Get academicYear
     *
     * @return \Admin\Entity\AcademicYear 
     */
    public function getAcademicYear();


    /**
    * Set classAdmitted
    *
    * @param \Admin\Entity\Classes $classAdmitted
    * @return ApplicantInterface
    */
    public function setClassAdmitted(\Admin\Entity\Classes $classAdmitted=null);

    /**
    *@return classAdmitted
    **/
    public function getClassAdmitted();
    
    /**
    * Set user
    *
    * @param \EduUser\Entity\User $user
    * @return ApplicantInterface
    */
    public function setUser(\EduUser\Entity\User $user=null);

    /**
    *@return User
    **/
    public function getUser();


    
   
}
