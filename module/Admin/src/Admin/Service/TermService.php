<?php
/**
 * ERP System
 *
 * @author Isaac Bitrus 
 * @copyright Copyright (c) 2013 Isaac Bitrus (http://www.edusoft.com.ng)
 */


namespace Admin\Service;

use Doctrine\ORM\EntityManager;
use Admin\Repository\TermRepositoryInterface;
use Admin\Entity\Term;

/**
 * Class TermService - service used to perform basic logic operations on term.
 *
 * @package Admin\Service
 */
class TermService implements SemesterServiceInterface
{
    /**
     * @var EntityManager
     */
    private $entityManager;


    /**
     * Method used to obtain orders repository.
     *
     * @return TermRepositoryInterface
     */
    public function getTermRepository()
    {
        return $this->getEntityManager()->getRepository('Admin\Entity\Term');
    }

    /**
     * Method used to persist new term in database
     *
     * @param Term $term
     * @return boolean
     */
    public function addTerm(Term $term)
    {
        $this->getEntityManager()->beginTransaction();
        try {
            $this->getEntityManager()->persist($term);
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
     * Method used to persist delete term in database
     *
     * @param Term $term
     * @return boolean
     */
    public function deleteSemester(Term $term)
    {
        $this->getEntityManager()->beginTransaction();
        try {
            $this->getEntityManager()->remove($term);
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
