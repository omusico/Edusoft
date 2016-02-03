<?php

/**
  * Edusoft Cloud Base School Management System
 *
 * @author Isaac Bitrus 
 * @copyright Copyright (c) 2016 Isaac Bitrus (http://www.edusoft.com.ng)
 */

namespace Applicant\Entity;

interface GuardianInterface
{
    

     /**
     * Set id.
     *
     * @param int $id
     * @return GuardianInterface
     */
    public function setId($id);
    
    /**
     * @return integer
     */
    public function getId();


    /**
     * Set firstName
     *
     * @param string firstName
     * @return GuardianInterface
     */
    public function setFirstName($firstName);


    /**
     * Get firstName
     *
     * @return string 
     */
    public function getFirstName();


    /**
     * Set lastName
     *
     * @param string $lastName
     * @return GuardianInterface
     */
    public function setLastName($lastName);


    /**
     * Get lastName
     *
     * @return string 
     */
    public function getLastName();


    /**
     * Set $middleName
     *
     * @param string $middleName
     * @return GuardianInterface
     */
    public function setMiddleName($middleName);


    /**
     * Get $middleName
     *
     * @return string 
     */
    public function getMiddleName();


    /**
     * Set mobile
     *
     * @param string $mobile1
     * @return GuardianInterface
     */
    public function setMobile1($mobile1);


    /**
     * Get mobile
     *
     * @return string 
     */
    public function getMobile1();


     /**
     * Set mobile
     *
     * @param string $mobile2
     * @return GuardianInterface
     */
    public function setMobile2($mobile2);


    /**
     * Get mobile
     *
     * @return string 
     */
    public function getMobile2();


    /**
     * Set occupation
     *
     * @param string $occupation
     * @return GuardianInterface
     */
    public function setOccupation($occupation);


    /**
     * Get occupation
     *
     * @return string 
     */
    public function getOccupation();

    

    /**
     * Set gender
     *
     * @param string $gender
     * @return GuardianInterface
     */
    public function setGender($gender);


    /**
     * Get gender
     *
     * @return string 
     */
    public function getGender();


    /**
     * Set email
     *
     * @param string $email
     * @return GuardianInterface
     */
    public function setEmail($email);


    /**
     * Get email
     *
     * @return string 
     */
    public function getEmail();


   
}
