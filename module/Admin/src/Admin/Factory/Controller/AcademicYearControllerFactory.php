<?php
/**
 * ERP System
 *
 * @author Isaac Bitrus 
 * @copyright Copyright (c) 2013 Isaac Bitrus (http://www.edusoft.com.ng)
 */

namespace Admin\Factory\Controller;

use Admin\Controller\AcademicYearController;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

/**
 * Class AcademicYearControllerFactory - factory used to create PositionController.
 *
 * @package Admin\Factory\Controller
 */
class AcademicYearControllerFactory implements FactoryInterface
{
    /**
     * Factory method.
     *
     * @param ServiceLocatorInterface $serviceLocator
     * @return AcademicYearController
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $ctr = new AcademicYearController();
        $ctr->setEntityManager($serviceLocator->getServiceLocator()->get('Doctrine\ORM\EntityManager'));
        $ctr->setAcademicYearService($serviceLocator->getServiceLocator()->get('AcademicYearService'));
        return $ctr;


    }
}
