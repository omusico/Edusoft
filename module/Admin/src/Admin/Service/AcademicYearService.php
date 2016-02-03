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
use Admin\Entity\AcademicYear;

/**
 * Class AcademicYearService - service used to perform basic logic operations on year.
 *
 * @package Admin\Service
 */
class AcademicYearService implements AcademicYearServiceInterface
{
    /**
     * @var EntityManager
     */
    private $entityManager;


    /**
     * Method used to obtain orders repository.
     *
     * @return AcademicYearRepositoryInterface
     */
    public function getAcademicYearRepository()
    {
        return $this->getEntityManager()->getRepository('Admin\Entity\AcademicYear');
    }

    /**
     * Method used to persist new academicyear in database
     *
     * @param AcademicYear $academicyear
     * @return boolean
     */
    public function addAcademicYear(AcademicYear $academicyear)
    {
        $this->getEntityManager()->beginTransaction();
        try {
            $this->setstatus($academicyear);
            $this->getEntityManager()->persist($academicyear);
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
     * Method used to  set academicyear in status
     *
     */
    public function setstatus($academicyear)
    {  // $this->clearstatus();
        $status=$this->getAcademicYearRepository()->findOneBy(array('status'=>1));
        if($status){
            $status->setStatus(0);
            $this->getEntityManager()->persist($status);
            $this->getEntityManager()->flush();
        }
        return $academicyear->setStatus(1);     
    }



    /**
     * Method used to  open academic-year
     *
     */
    public function open($academicyear)
    {
        $status=$this->getAcademicYearRepository()->findOneBy(array('id'=>$academicyear));
        if($status){
            $status->setStatus(1);
            $this->getEntityManager()->persist($status);
            $this->getEntityManager()->flush();
        }
        return true;     
    }

    /**
     * Method used to  close academic-year
     *
     */
    public function close($academicyear)
    {
        $status=$this->getAcademicYearRepository()->findOneBy(array('id'=>$academicyear));
        if($status){
            $status->setStatus(0);
            $this->getEntityManager()->persist($status);
            $this->getEntityManager()->flush();
        }
        return true;     
    }



        /**
     * Method used to persist delete year in database
     *
     * @param AcademicYear $academicyear
     * @return boolean
     */
    public function deleteAcademicYear(AcademicYear $academicyear)
    {
        $this->getEntityManager()->beginTransaction();
        try {
            $this->getEntityManager()->remove($academicyear);
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
