<?php

/**
  * Edusoft Cloud Base School Management System
 *
 * @author Isaac Bitrus 
 * @copyright Copyright (c) 2016 Isaac Bitrus (http://www.edusoft.com.ng)
 */

namespace Admin\Entity;

interface LgaInterface
{
    /**
     * Set id.
     *
     * @param int $id
     * @return LgaInterface
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
     * @return LgaInterface
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
     * @return LgaInterface
     */
    public function setCode($code);

    /**
     * Get code
     *
     * @return string 
     */
    public function getCode();

    /**
     * Set state
     *
     * @param State $state
     * @return LgaInterface
     */
    public function setState(State $state);

    /**
     * Get state
     *
     * @return State 
     */
    public function getState();

  

   
}
