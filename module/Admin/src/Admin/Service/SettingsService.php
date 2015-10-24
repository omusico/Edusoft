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
class SettingsService 
{
    /**
     * @var EntityManager
     */
    private $entityManager;

  
   
    public function getCurrentSession()
    {     
        return $session =$this->getEntityManager()->getRepository('Admin\Entity\Session')->findOneBy(array(),array('id'=>'DESC'));
    }

      public function getCurrentYear()
    {
       return $this->getCurrentSession()->getYear(); 
    }

      public function getCurrentTerm()
    {
        return $this->getCurrentSession()->getTerm();  
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
