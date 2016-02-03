<?php
/**
  * Cloud Base School Management System
 *
 * @author Isaac Bitrus 
 * @copyright Copyright (c) 2016 Isaac Bitrus (http://www.edusoft.com.ng)
 */

namespace Applicant\Factory\Service;

use Applicant\Service\GuardianService;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

/**
 * Class GuardianServiceFactory - factory used to create GuardianService.
 *
 * @package Applicant\Factory\Service
 */
class GuardianServiceFactory implements FactoryInterface
{
    /**
     * Factory method.
     *
     * @param ServiceLocatorInterface $serviceLocator
     * @return mixed
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $service = new GuardianService();
        $service->setEntityManager($serviceLocator->get('Doctrine\ORM\EntityManager'));

        return $service;
    }
}
