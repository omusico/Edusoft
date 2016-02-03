<?php

/**
  * Edusoft Cloud Base School Management System
 *
 * @author Isaac Bitrus 
 * @copyright Copyright (c) 2016 Isaac Bitrus (http://www.edusoft.com.ng)
 */

namespace Applicant\Entity;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

interface PersonInterface
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
     * Allow null to remove association
     *
     * @param Guardian $guardian
     */
    public function setGuardian(Guardian $guardian = null);


    /**
     * @return Guardian
     */
    public function getGuardian();



    /**
     * Set firstName
     *
     * @param string $firstName
     * @return PersonInterface
     */
    public function setFirstName($firstName);


    /**
     * Get firstName
     *
     * @return string 
     */
    public function getFirstName();


     /**
     * Set religion
     *
     * @param string $religion
     * @return PersonInterface
     */
    public function setReligion($religion);


    /**
     * Get religion
     *
     * @return string 
     */
    public function getReligion();


    /**
     *@param string $dob
    *@return PersonInterface
    **/
    public function SetDob($dob);

     /**
     * Get dob
     * @param string $dob
     * @return string
     */
    public function getDob();


    /**
     * Set lastName
     *
     * @param string $lastName
     * @return PersonInterface
     */
    public function setLastName($lastName);


    /**
     * Get lastName
     *
     * @return string 
     */
    public function getLastName();


    /**
     * Set middleName
     *
     * @param string $middleName
     * @return PersonInterface
     */
    public function setMiddleName($middleName);


    /**
     * Get middleName
     *
     * @return string 
     */
    public function getMiddleName();


    /**
     * Set sex
     *
     * @param string $sex
     * @return PersonInterface
     */
    public function setSex($sex);


    /**
     * Get sex
     *
     * @return string 
     */
    public function getSex();


    /**
     * Set mobile
     *
     * @param string $mobile
     * @return PersonInterface
     */
    public function setMobile($mobile);


    /**
     * Get mobile
     *
     * @return string 
     */
    public function getMobile();


    /**
     * Set residentialAddress
     *
     * @param string $residentialAddress
     * @return PersonInterface
     */
    public function setResidentialAddress($residentialAddress);


    /**
     * Get residentialAddress
     *
     * @return string 
     */
    public function getResidentialAddress();


    /**
     * Set permanentAddress
     *
     * @param string $permanentAddress
     * @return PersonInterface
     */
    public function setPermanentAddress($permanentAddress);


    /**
     * Get permanentAddress
     *
     * @return string 
     */
    public function getPermanentAddress();


    /**
     * Set country
     *
     * @param \Admin\Entity\Country $country
     * @return PersonInterface
     */
    public function setCountry(\Admin\Entity\Country $country);



    /**
     * Get country
     *
     * @return \Admin\Entity\Country
     */
    public function getCountry();


    /**
     * Set state
     *
     * @param \Admin\Entity\State $state
     * @return PersonInterface
     */
    public function setState(\Admin\Entity\State $state);


    /**
     * Get state
     *
     * @return \Admin\Entity\State
     */
    public function getState();


    /**
     * Set lga
     *
     * @param \Admin\Entity\Lga $lga
     * @return PersonInterface
     */
    public function setLga(\Admin\Entity\Lga $lga);


    /**
     * Get lgaCode
     *
     * @return \Admin\Entity\Lga 
     */
    public function getLga();


    /**
     * Set nokRel
     *
     * @param string $nokRel
     * @return PersonInterface
     */
    public function setNokRel($nokRel);


    /**
     * Get nokRel
     *
     * @return string 
     */
    public function getNokRel();


    /**
     * Set nokName
     *
     * @param string $nokName
     * @return PersonInterface
     */
    public function setNokName($nokName);


    /**
     * Get nokName
     *
     * @return string 
     */
    public function getNokName();


    /**
     * Set nokMobile
     *
     * @param string $nokMobile
     * @return PersonInterface
     */
    public function setNokMobile($nokMobile);


    /**
     * Get nokMobile
     *
     * @return string 
     */
    public function getNokMobile();



     /**
     * Set image
     *
     * @param string $image
     * @return PersonInterface
     */
    public function setImage($image);

    /**
     * Get image
     *
     * @return string 
     */
    public function getImage();



   
}
