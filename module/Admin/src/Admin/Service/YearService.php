<?php
/**
 * ERP System
 *
 * @author Isaac Bitrus 
 * @copyright Copyright (c) 2013 Isaac Bitrus (http://www.edusoft.com.ng)
 */


namespace Admin\Service;

use Doctrine\ORM\EntityManager;
use Admin\Repository\YearRepositoryInterface;
use Admin\Entity\Year;

/**
 * Class YearService - service used to perform basic logic operations on year.
 *
 * @package Admin\Service
 */
class YearService implements YearServiceInterface
{
    /**
     * @var EntityManager
     */
    private $entityManager;


    /**
     * Method used to obtain orders repository.
     *
     * @return YearRepositoryInterface
     */
    public function getYearRepository()
    {
        return $this->getEntityManager()->getRepository('Admin\Entity\Year');
    }

    /**
     * Method used to persist new year in database
     *
     * @param Year $year
     * @return boolean
     */
    public function addYear(Year $year)
    {
        $this->getEntityManager()->beginTransaction();
        try {
            $this->getEntityManager()->persist($year);
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
     * Method used to persist delete year in database
     *
     * @param Year $year
     * @return boolean
     */
    public function deleteYear(Year $year)
    {
        $this->getEntityManager()->beginTransaction();
        try {
            $this->getEntityManager()->remove($year);
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
