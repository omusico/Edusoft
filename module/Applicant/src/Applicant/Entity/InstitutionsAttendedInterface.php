<?php

/**
  * Edusoft Cloud Base School Management System
 *
 * @author Isaac Bitrus 
 * @copyright Copyright (c) 2016 Isaac Bitrus (http://www.edusoft.com.ng)
 */

namespace Applicant\Entity;

interface InstitutionsAttendedInterface
{
    
   /**
     * Set id.
     *
     * @param int $id
     * @return InstitutionsAttendedInterface
     */
    public function setId($id);


    /**
     * Get id
     *
     * @return integer 
     */
    public function getId();


    /**
     * Set name
     *
     * @param string $name
     * @return InstitutionsAttendedInterface
     */
    public function setName($name);

    /**
     * Get name
     *
     * @return string 
     */
    public function getName();


     /**
     * Set location
     *
     * @param string $location
     * @return InstitutionsAttendedInterface
     */
    public function setLocation($location);


    /**
     * Get location
     *
     * @return string 
     */
    public function getLocation();


     /**
     * Set from
     *
     * @param string $from
     * @return InstitutionsAttendedInterface
     */
    public function setFrom($from);

    /**
     * Get from
     *
     * @return string 
     */
    public function getFrom();



    /**
     * Set to
     *
     * @param string $to
     * @return InstitutionsAttendedInterface
     */
    public function setTo($to);


    /**
     * Get to
     *
     * @return string 
     */
    public function getTo();
 

    /**
     * Set person 
     *
     * @param \Applicant\Entity\Person $person
     * @return InstitutionsAttendedInterface
     */
    public function setPerson(\Applicant\Entity\Person $person);

    /**
     * Get person
     *
     * @return \Applicant\Entity\Person
     */
    public function getPerson();

    
}
