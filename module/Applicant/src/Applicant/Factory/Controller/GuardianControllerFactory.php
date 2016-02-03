<?php
/**
 * Edusoft Cloud Base School Management System
 *
 * @author Isaac Bitrus 
 * @copyright Copyright (c) 2015 Edusoft (http://www.edusoft.com.ng)
 */

namespace Applicant\Factory\Controller;

use Applicant\Controller\GuardianController;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

/**
 * Class GuardianControllerFactory - factory used to create GuardianController.
 *
 * @package Applicant\Factory\Controller
 */
class GuardianControllerFactory implements FactoryInterface
{
    /**
     * Factory method.
     *
     * @param ServiceLocatorInterface $serviceLocator
     * @return GuardianController
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $ctr = new GuardianController();
        $ctr->setEntityManager($serviceLocator->getServiceLocator()->get('Doctrine\ORM\EntityManager'));
        $ctr->setGuardianService($serviceLocator->getServiceLocator()->get('GuardianService'));
        return $ctr;


    }
}
