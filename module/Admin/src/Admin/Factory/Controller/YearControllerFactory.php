<?php
/**
 * ERP System
 *
 * @author Isaac Bitrus 
 * @copyright Copyright (c) 2013 Isaac Bitrus (http://www.edusoft.com.ng)
 */

namespace Admin\Factory\Controller;

use Admin\Controller\YearController;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

/**
 * Class YearFactory - factory used to create YearController.
 *
 * @package Admin\Factory\Controller
 */
class YearControllerFactory implements FactoryInterface
{
    /**
     * Factory method.
     *
     * @param ServiceLocatorInterface $serviceLocator
     * @return YearController
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $ctr = new YearController();
        $ctr->setEntityManager($serviceLocator->getServiceLocator()->get('Doctrine\ORM\EntityManager'));
        $ctr->setYearService($serviceLocator->getServiceLocator()->get('YearService'));
        return $ctr;


    }
}
