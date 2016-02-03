<?php
/**
 * Cloud Based School Management System
 *
 * @author Isaac Bitrus 
 * @copyright Copyright (c) 2013 Isaac Bitrus (http://www.edusoft.com.ng)
 */

namespace Admin\Service;

use Doctrine\ORM\EntityManager;
use Admin\Repository\ClassesRepositoryInterface;
use Admin\Entity\Classes;

interface ClassesServiceInterface
{
    /**
     * Method used to obtain classes repository.
     *
     * @return ClassesRepositoryInterface
     */
    public function getClassesRepository();

    /**
     * Method used to persist new classes in database
     *
     * @param Classes $classes
     * @return boolean
     */
    public function addClasses(Classes $classes);

    /**
     * Method used to check if class exist in database
     *
     */
    public function checkClass($data);

     /**
     * Method used to delete classes in database
     *
     * @param Classes $classes
     * @return boolean
     */
    public function deleteClasses(Classes $classes);




    /**
     * Method used to obtain EntityManager.
     *
     * @return EntityManager - entity manager object
     */
    public function getEntityManager();

    /**
     * Method used to inject EntityManager.
     *
     * @param EntityManager $entityManager
     * @return void
     */
    public function setEntityManager(EntityManager $entityManager);
}
