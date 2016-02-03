<?php
/**
 * Edusoft Cloud Base School Management System
 *
 * @author Isaac Bitrus 
 * @copyright Copyright (c) 2015 Edusoft (http://www.edusoft.com.ng)
 */

namespace Applicant\Factory\Controller;

use Applicant\Controller\ApplicantController;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

/**
 * Class ApplicantControllerFactory - factory used to create ApplicantController.
 *
 * @package Applicant\Factory\Controller
 */
class ApplicantControllerFactory implements FactoryInterface
{
    /**
     * Factory method.
     *
     * @param ServiceLocatorInterface $serviceLocator
     * @return ApplicantController
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $ctr = new ApplicantController();
        $ctr->setEntityManager($serviceLocator->getServiceLocator()->get('Doctrine\ORM\EntityManager'));
        $ctr->setApplicantService($serviceLocator->getServiceLocator()->get('ApplicantService'));
        return $ctr;


    }
}
