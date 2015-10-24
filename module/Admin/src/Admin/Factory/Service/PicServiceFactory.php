<?php
/**
 * ERP System
 *
 * @author Isaac Bitrus <evolic_at_interia_dot_pl>
 * @copyright Copyright (c) 2013 Isaac Bitrus (http://www.edusoft.com.ng)
 */

namespace Admin\Factory\Service;

use Admin\Service\PicService;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

/**
 * Class PicServiceFactory - factory used to create PicService.
 *
 * @package Admin\Factory\Service
 */
class PicServiceFactory implements FactoryInterface
{
    /**
     * Factory method.
     *
     * @param ServiceLocatorInterface $serviceLocator
     * @return mixed
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $service = new PicService();
        $service->setEntityManager($serviceLocator->get('Doctrine\ORM\EntityManager'));
        $service->setAuthService($serviceLocator->get('zfcuser_auth_service'));

        return $service;
    }
}
