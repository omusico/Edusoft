<?php
/**
 * ERP System
 *
 * @author Isaac Bitrus 
 * @copyright Copyright (c) 2013 Isaac Bitrus (http://www.edusoft.com.ng)
 */

namespace Admin\Factory\Controller;

use Admin\Controller\SubjectController;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

/**
 * Class SubjectFactory - factory used to create SubjectController.
 *
 * @package Admin\Factory\Controller
 */
class SubjectControllerFactory implements FactoryInterface
{
    /**
     * Factory method.
     *
     * @param ServiceLocatorInterface $serviceLocator
     * @return SubjectController
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $ctr = new SubjectController();
        $ctr->setEntityManager($serviceLocator->getServiceLocator()->get('Doctrine\ORM\EntityManager'));
        $ctr->setSubjectService($serviceLocator->getServiceLocator()->get('SubjectService'));
        return $ctr;


    }
}
