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

/**
 * Class SubjectService - service used to perform basic logic operations on subject.
 *
 * @package Admin\Service
 */
class SubjectService implements SubjectServiceInterface
{
    /**
     * @var EntityManager
     */
    private $entityManager;


    /**
     * Method used to obtain Department repository.
     *
     * @return SubjectRepositoryInterface
     */
    public function getSubjectRepository()
    {
        return $this->getEntityManager()->getRepository('Admin\Entity\Subject');
    }

    /**
     * Method used to persist new subject in database
     *
     * @param Subject $subject
     * @return boolean
     */
    public function addSubject(Subject $subject)
    {
        $this->getEntityManager()->beginTransaction();
        try {
            $this->getEntityManager()->persist($subject);
            // commit transaction
            $this->getEntityManager()->flush();
            $this->getEntityManager()->commit();

            return true;
        } catch (\Exception $e) {
            $this->getEntityManager()->rollback();
            $this->getEntityManager()->close();

            return false;
        }
    }



        /**
     * Method used to persist delete subject in database
     *
     * @param Subject $subject
     * @return boolean
     */
    public function deleteSubject(Subject $subject)
    {
        $this->getEntityManager()->beginTransaction();
        try {
            $this->getEntityManager()->remove($subject);
            // commit transaction
            $this->getEntityManager()->flush();
            $this->getEntityManager()->commit();

            return true;
        } catch (\Exception $e) {
            $this->getEntityManager()->rollback();
            $this->getEntityManager()->close();

            return false;
        }
    }


    /**
     * Method used to obtain EntityManager.
     *
     * @return EntityManager - entity manager object
     */
    public function getEntityManager()
    {
        return $this->entityManager;
    }

    /**
     * Method used to inject EntityManager.
     *
     * @param EntityManager $entityManager
     */
    public function setEntityManager(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }
}
