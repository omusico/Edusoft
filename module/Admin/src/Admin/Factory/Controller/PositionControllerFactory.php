<?php
/**
 * ERP System
 *
 * @author Isaac Bitrus 
 * @copyright Copyright (c) 2013 Isaac Bitrus (http://www.edusoft.com.ng)
 */

namespace Admin\Factory\Controller;

use Admin\Controller\PositionController;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

/**
 * Class PositionFactory - factory used to create PositionController.
 *
 * @package Admin\Factory\Controller
 */
class PositionControllerFactory implements FactoryInterface
{
    /**
     * Factory method.
     *
     * @param ServiceLocatorInterface $serviceLocator
     * @return PositionController
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $ctr = new PositionController();
        $ctr->setEntityManager($serviceLocator->getServiceLocator()->get('Doctrine\ORM\EntityManager'));
        $ctr->setSettingsService($serviceLocator->getServiceLocator()->get('Admin\Service\SettingsService'));
        return $ctr;


    }
}
