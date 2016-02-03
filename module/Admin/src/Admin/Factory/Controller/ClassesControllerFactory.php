<?php
/**
 * ERP System
 *
 * @author Isaac Bitrus 
 * @copyright Copyright (c) 2013 Isaac Bitrus (http://www.edusoft.com.ng)
 */

namespace Admin\Factory\Controller;

use Admin\Controller\ClassesController;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

/**
 * Class ClassesControllerFactory - factory used to create ClassesController.
 *
 * @package Admin\Factory\Controller
 */
class ClassesControllerFactory implements FactoryInterface
{
    /**
     * Factory method.
     *
     * @param ServiceLocatorInterface $serviceLocator
     * @return ClassesController
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $ctr = new ClassesController();
        $ctr->setEntityManager($serviceLocator->getServiceLocator()->get('Doctrine\ORM\EntityManager'));
        $ctr->setClassesService($serviceLocator->getServiceLocator()->get('ClassesService'));
        return $ctr;


    }
}
