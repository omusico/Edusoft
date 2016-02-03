<?php

/**
  * Edusoft Cloud Base School Management System
 *
 * @author Isaac Bitrus 
 * @copyright Copyright (c) 2016 Isaac Bitrus (http://www.edusoft.com.ng)
 */

namespace Admin\Entity;

interface CountryInterface
{
    /**
     * Set id.
     *
     * @param int $id
     * @return CountryInterface
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
     * @return CountryInterface
     */
    public function setName($name);

    /**
     * Get name
     *
     * @return string 
     */
    public function getName();

    /**
     * Set code
     *
     * @param string $code
     * @return CountryInterface
     */
    public function setCode($code);

    /**
     * Get code
     *
     * @return string 
     */
    public function getCode();

  

   
}
