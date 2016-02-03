<?php
/**
 * ERP System
 *
 * @author Isaac Bitrus 
 * @copyright Copyright (c) 2013 Isaac Bitrus (http://www.edusoft.com.ng)
 */

namespace Admin\Factory\Controller;

use Admin\Controller\SectionController;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

/**
 * Class SectionFactory - factory used to create SectionController.
 *
 * @package Admin\Factory\Controller
 */
class SectionControllerFactory implements FactoryInterface
{
    /**
     * Factory method.
     *
     * @param ServiceLocatorInterface $serviceLocator
     * @return SectionController
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $ctr = new SchoolController();
        $ctr->setEntityManager($serviceLocator->getServiceLocator()->get('Doctrine\ORM\EntityManager'));
        $ctr->setSectionService($serviceLocator->getServiceLocator()->get('SectionService'));
        return $ctr;


    }
}
