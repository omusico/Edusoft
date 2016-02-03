<?php
/**
 * ERP System
 *
 * @author Isaac Bitrus 
 * @copyright Copyright (c) 2013 Isaac Bitrus (http://www.edusoft.com.ng)
 */

namespace Admin\Service;

use Doctrine\ORM\EntityManager;
use Admin\Repository\SubjectRepositoryInterface;
use Admin\Entity\Subject;

interface SubjectServiceInterface
{
    /**
     * Method used to obtain subject repository.
     *
     * @return SubjectRepositoryInterface
     */
    public function getSubjectRepository();

    /**
     * Method used to persist new subject in database
     *
     * @param Subject $subject
     * @return boolean
     */
    public function addSubject(Subject $subject);

     /**
     * Method used to delete subject in database
     *
     * @param Subject $subject
     * @return boolean
     */
    public function deleteSubject(Subject $subject);




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
