<?php
/**
  * Cloud Base School Management System
 *
 * @author Isaac Bitrus 
 * @copyright Copyright (c) 2016 Isaac Bitrus (http://www.edusoft.com.ng)
 */

namespace Applicant\Factory\Service;

use Applicant\Service\ApplicantService;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

/**
 * Class ApplicantServiceFactory - factory used to create ApplicantService.
 *
 * @package Admin\Factory\Service
 */
class ApplicantServiceFactory implements FactoryInterface
{
    /**
     * Factory method.
     *
     * @param ServiceLocatorInterface $serviceLocator
     * @return mixed
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $service = new ApplicantService();
        $service->setEntityManager($serviceLocator->get('Doctrine\ORM\EntityManager'));
        $service->setAuthService($serviceLocator->get('zfcuser_auth_service'));

        return $service;
    }
}
