<?php
/**
 * ERP System
 *
 * @author Isaac Bitrus <evolic_at_interia_dot_pl>
 * @copyright Copyright (c) 2013 Isaac Bitrus (http://www.edusoft.com.ng)
 */

namespace Messages\Factory\Service;

use Messages\Service\MessageService;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

/**
 * Class PicServiceFactory - factory used to create PicService.
 *
 * @package Messages\Factory\Service
 */
class MessageServiceFactory implements FactoryInterface
{
    /**
     * Factory method.
     *
     * @param ServiceLocatorInterface $serviceLocator
     * @return mixed
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $service = new MessageService();
        $service->setEntityManager($serviceLocator->get('Doctrine\ORM\EntityManager'));
        $service->setAuthService($serviceLocator->get('zfcuser_auth_service'));

        return $service;
    }
}
