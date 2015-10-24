<?php
/**
 * ERP System
 *
 * @author Isaac Bitrus 
 * @copyright Copyright (c) 2013 Isaac Bitrus (http://www.edusoft.com.ng)
 */

namespace Admin\Service;

use Doctrine\ORM\EntityManager;


/**
 * Class AdminDashboardService - service used to perform basic logic operations for dashboard.
 *
 * @package Admin\Service
 */
class ParentsDashboardService 
{
    /**
     * @var EntityManager
     */
    private $entityManager;

  
   
    public function getStudent()
    {
        $entityManager= $this->getEntityManager();       
        $dql = "SELECT count(s.id) FROM Admin\Entity\Student s WHERE s.status=?3";
        $query = $entityManager->createQuery($dql)->setParameter(1,'Active');  
        return $status = $query->getsingleScalarResult(); 
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
