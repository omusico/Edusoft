<?php
/**
 * Cloud Base School Management System
 *
 * @author Isaac Bitrus 
 * @copyright Copyright (c) 2015 Edusoft (http://www.edusoft.com.ng)
 */

namespace Admin\Entity;


interface ClassesInterface
{
  /**
    * Get id
    *
    * @return integer
    */
    public function getId();
    
     /**
     * Set id.
     *
     * @param int $id
     * @return ClassesInterface
     */
    public function setId($id);
    
     /**
     * Set name
     *
     * @param string $name
     * @return name
     */
    public function setName($name);

    /**
     * Get name
     *
     * @return string 
     */
    public function getName();
   
    /**
     * Set section
    *
    * @param string $session
    * @return ClassesInterface
    */
    public function setSection($section);

    /**
    *@return Section
    **/
    public function getSection();

    /**
     * Set Initial
    *
    * @param integer $initial
    * @return ClassesInterface
    */
    public function setInitial($initial);

    /**
    *@return Integer
    **/
    public function getInitial();


    /**
     * Set section
    *
    * @param string $arm
    * @return ClassesInterface
    */
    public function setArm($arm);

    /**
    *@return string
    **/
    public function getArm();



}

