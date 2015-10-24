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
class AdminDashboardService 
{
    /**
     * @var EntityManager
     */
    private $entityManager;

       /**
     * @var SettingsService
     */
    private $settingsService;

  
   
    public function getStudent()
    {
        $entityManager= $this->getEntityManager();       
        $dql = "SELECT count(s.id) as total FROM Admin\Entity\Student s WHERE s.status=?1";
        $query = $entityManager->createQuery($dql)->setParameter(1,'Active');  
        return $status = $query->getsingleScalarResult(); 
    }

      public function getStaff()
    {
        $entityManager= $this->getEntityManager();    
        $dql = "SELECT count(s.id) as total FROM Admin\Entity\Staff s WHERE s.status=?1";
        $query = $entityManager->createQuery($dql)->setParameter(1,'Active');  
        return $status = $query->getsingleScalarResult();  
    }

      public function getMaleStudent()
    {
        $entityManager= $this->getEntityManager();     
        $dql = "SELECT s,count(s.id) as total,p FROM Admin\Entity\Student s LEFT JOIN s.person p WHERE s.status=?1 and p.sex=?2";
        $query = $entityManager->createQuery($dql)->setParameters(array(1=>'Active',2=>'Male'));  
        return $status = $query->getScalarResult(); 
    }

          public function getFemaleStudent()
    {
        $entityManager= $this->getEntityManager();
        $dql = "SELECT s,count(s.id) as total,p FROM Admin\Entity\Student s LEFT JOIN s.person p WHERE s.status=?1 and p.sex=?2";
        $query = $entityManager->createQuery($dql)->setParameters(array(1=>'Active',2=>'Female'));  
        return $status = $query->getScalarResult(); 
    }

       public function getTotalClass()
    {
        $entityManager= $this->getEntityManager();     
        $dql = "SELECT count(s.id) as total FROM Admin\Entity\Classes s";
        $query = $entityManager->createQuery($dql);  
        return $status = $query->getsingleScalarResult(); 
    }

          public function getTotalSection()
    {
        $entityManager= $this->getEntityManager();     
        $dql = "SELECT count(s.id) as total FROM Admin\Entity\Section s";
        $query = $entityManager->createQuery($dql);  
        return $status = $query->getsingleScalarResult(); 
    }

          public function getTotalSubject()
    {
        $entityManager= $this->getEntityManager();     
        $dql = "SELECT count(s.id) as total FROM Admin\Entity\Subject s ";
        $query = $entityManager->createQuery($dql);  
        return $status = $query->getsingleScalarResult(); 
    }
              public function getTotalParents()
    {
        $entityManager= $this->getEntityManager();     
        $dql = "SELECT count(g.id) as total FROM Admin\Entity\Student s LEFT JOIN s.person p LEFT JOIN p.guardian g ";
        $query = $entityManager->createQuery($dql);  
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


       /**
     * Method used to obtain SettingsService.
     *
     * @return SettingsService - entity manager object
     */
    public function getSettingsService()
    {
        return $this->settingsService;
    }

    /**
     * Method used to inject SettingsService.
     *
     * @param SettingsService $settingsService
     */
    public function setSettingsService(SettingsService $settingsService)
    {
        $this->settingsService = $settingsService;
    }

   
}
