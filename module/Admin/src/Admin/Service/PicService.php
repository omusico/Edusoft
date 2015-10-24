<?php
/**
 * ERP System
 *
 * @author Isaac Bitrus 
 * @copyright Copyright (c) 2013 Isaac Bitrus (http://www.edusoft.com.ng)
 */

namespace Admin\Service;

use Doctrine\ORM\EntityManager;
use Zend\Authentication\AuthenticationService;


/**
 * Class PicService - service used to perform basic logic operations on companies.
 *
 * @package Admin\Service
 */
class PicService 
{
    /**
     * @var EntityManager
     */
    private $entityManager;

    /**
     * @var AuthenticationService
     */
    protected $authService;

   
    public function getPic()
    {
        $entityManager= $this->getEntityManager();
        $auth = $this->getAuthService();
        if ($auth->hasIdentity()) {
            $id=$auth->getIdentity()->getId();
            $roles=$auth->getIdentity()->getRoles();
                foreach ($roles as $role) {
                    $role=$role->getRoleId();
                }
                 switch ($role){

                 case "admin": 
                     return $image = ''; 
                                       
                        break;
                 case "student":              
                    $dql = "SELECT s.image FROM Admin\Entity\Student s WHERE s.user=?1";
                    $query = $entityManager->createQuery($dql)->setParameter(1,$id); 
                    return $image = $query->getsingleScalarResult(); 
                       break;
                case "staff":              
                    $dql = "SELECT s.image FROM Admin\Entity\Staff s WHERE s.user=?1";
                    $query = $entityManager->createQuery($dql)->setParameter(1,$id); 
                    return $image = $query->getsingleScalarResult(); 
                       break;
                default:
                    return $image='avatar.png';
                    break;
             }  
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
