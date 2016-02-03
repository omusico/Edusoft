<?php
/**
  * Cloud Base School Management System
 *
 * @author Isaac Bitrus 
 * @copyright Copyright (c) 2016 Isaac Bitrus (http://www.edusoft.com.ng)
 */

namespace Admin\Factory\Service;

use Admin\Service\SectionService;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

/**
 * Class SectionServiceFactory - factory used to create SectionService.
 *
 * @package Admin\Factory\Service
 */
class SectionServiceFactory implements FactoryInterface
{
    /**
     * Factory method.
     *
     * @param ServiceLocatorInterface $serviceLocator
     * @return mixed
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $service = new SectionService();
        $service->setEntityManager($serviceLocator->get('Doctrine\ORM\EntityManager'));

        return $service;
    }
}
