<?php
/**
  * Cloud Base School Management System
 *
 * @author Isaac Bitrus 
 * @copyright Copyright (c) 2016 Isaac Bitrus (http://www.edusoft.com.ng)
 */

namespace Admin\Factory\Service;

use Admin\Service\YearService;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

/**
 * Class YearServiceFactory - factory used to create YearService.
 *
 * @package Admin\Factory\Service
 */
class YearServiceFactory implements FactoryInterface
{
    /**
     * Factory method.
     *
     * @param ServiceLocatorInterface $serviceLocator
     * @return mixed
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $service = new YearService();
        $service->setEntityManager($serviceLocator->get('Doctrine\ORM\EntityManager'));

        return $service;
    }
}
