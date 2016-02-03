<?php
/**
 * ERP System
 *
 * @author Isaac Bitrus 
 * @copyright Copyright (c) 2013 Isaac Bitrus (http://www.edusoft.com.ng)
 */


namespace Admin\Service;

use Doctrine\ORM\EntityManager;
use Admin\Repository\ClassesRepositoryInterface;
use Admin\Entity\Classes;

/**
 * Class ClassesService - service used to perform basic logic operations on year.
 *
 * @package Admin\Service
 */
class ClassesService implements ClassesServiceInterface
{
    /**
     * @var EntityManager
     */
    private $entityManager;


    /**
     * Method used to obtain orders repository.
     *
     * @return ClassesRepositoryInterface
     */
    public function getClassesRepository()
    {
        return $this->getEntityManager()->getRepository('Admin\Entity\Classes');
    }

    /**
     * Method used to persist new year in database
     *
     * @param Classes $classes
     * @return boolean
     */
    public function addClasses(Classes $classes)
    {
        $this->getEntityManager()->beginTransaction();
        try {
            $this->getEntityManager()->persist($classes);
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
     * Method used to check if class exist in database
     *
     */
    public function checkClass($data)
    {  // $this->clearstatus();
        $class=$this->getClassesRepository()->findOneBy(array('section'=>$data['section'],'initial'=>$data['initial'],'arm'=>$data['arm']));
        return $class;     
    }



        /**
     * Method used to persist delete classes in database
     *
     * @param Classes $classes
     * @return boolean
     */
    public function deleteClasses(Classes $classes)
    {
        $this->getEntityManager()->beginTransaction();
        try {
            $this->getEntityManager()->remove($classes);
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
