<?php
/**
 * ERP System
 *
 * @author Isaac Bitrus 
 * @copyright Copyright (c) 2013 Isaac Bitrus (http://www.edusoft.com.ng)
 */

namespace Admin\Factory\Controller;

use Admin\Controller\TermController;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

/**
 * Class TermFactory - factory used to create TermController.
 *
 * @package Admin\Factory\Controller
 */
class TermControllerFactory implements FactoryInterface
{
    /**
     * Factory method.
     *
     * @param ServiceLocatorInterface $serviceLocator
     * @return TermController
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $ctr = new TermController();
        $ctr->setEntityManager($serviceLocator->getServiceLocator()->get('Doctrine\ORM\EntityManager'));
        $ctr->setTermService($serviceLocator->getServiceLocator()->get('TermService'));
        return $ctr;


    }
}
