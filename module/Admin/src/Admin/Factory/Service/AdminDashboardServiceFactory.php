<?php
/**
 * ERP System
 *
 * @author Isaac Bitrus 
 * @copyright Copyright (c) 2013 Isaac Bitrus (http://www.edusoft.com.ng)
 */

namespace Admin\Factory\Service;

use Admin\Service\AdminDashboardService;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

/**
 * Class AdminDashboardServiceFactory - factory used to create PicService.
 *
 * @package Admin\Factory\Service
 */
class AdminDashboardServiceFactory implements FactoryInterface
{
    /**
     * Factory method.
     *
     * @param ServiceLocatorInterface $serviceLocator
     * @return mixed
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $service = new AdminDashboardService();
        $service->setEntityManager($serviceLocator->get('Doctrine\ORM\EntityManager'));
         $service->setSettingsService($serviceLocator->get('Admin\Service\SettingsService'));

        return $service;
    }
}
