<?php
/**
 * ERP System
 *
 * @author Isaac Bitrus 
 * @copyright Copyright (c) 2013 Isaac Bitrus (http://www.edusoft.com.ng)
 */

namespace Messages\Service;

use Doctrine\ORM\EntityManager;
use Zend\Authentication\AuthenticationService;


/**
 * Class PicService - service used to perform basic logic operations on companies.
 *
 * @package Admin\Service
 */
class MessageService 
{
    /**
     * @var EntityManager
     */
    private $entityManager;

    /**
     * @var AuthenticationService
     */
    protected $authService;

   
    public function getMsgCount()
    {
        $entityManager= $this->getEntityManager();
        $auth = $this->getAuthService();
        if ($auth->hasIdentity()) {
            $id=$auth->getIdentity()->getId();
            
        $dql = "SELECT count(s.id) FROM Messages\Entity\Receivers s WHERE s.to=?1 and s.unread=?2";
        $query = $entityManager->createQuery($dql)->setParameter(1=>$id,2=>0);  
        var_dump($query);die;
        return $status = $query->getsingleScalarResult();  
                      
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

        /**
     * Get authService.
     *
     * @return AuthenticationService
     */
    public function getAuthService()
    {
        return $this->authService;
    }

    /**
     * Set authService.
     *
     * @param AuthenticationService $authService
     */
    public function setAuthService(AuthenticationService $authService)
    {
        $this->authService = $authService;
    }
}
