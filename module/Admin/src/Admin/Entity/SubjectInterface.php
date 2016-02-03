<?php

/**
  * Edusoft Cloud Base School Management System
 *
 * @author Isaac Bitrus 
 * @copyright Copyright (c) 2016 Isaac Bitrus (http://www.edusoft.com.ng)
 */

namespace Admin\Entity;

interface SubjectInterface
{
    /**
     * Get id.
     *
     * @return int
     */
    public function getId();

    /**
     * Set id.
     *
     * @param int $id
     * @return SubjectInterface
     */
    public function setId($id);

    /**
     * Get name.
     *
     * @return string
     */
    public function getName();

    /**
     * Set name.
     *
     * @param string $name
     * @return SubjectInterface
     */
    public function setName($name);

     /**
     * Set shortName
     *
     * @param string $shortName
     * @return SubjectInterface
     */
    public function setShortName($shortName);

    /**
     * Get shortName
     *
     * @return string 
     */
    public function getShortName();


    /**
     * Set description
     *
     * @param string $description
     * @return SubjectInterface
     */
    public function setDescription($description);

    /**
     * Get description
     *
     * @return string 
     */
    public function getDescription();

   
}
