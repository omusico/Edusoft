<?php
/**
 * Edusoft Cloud Based School Management System
 *
 * @author Isaac Bitrus 
 * @copyright Copyright (c) 2013 Isaac Bitrus (http://www.edusoft.com.ng)
 */


namespace Admin\View\Helper;

use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

use Zend\View\Helper\AbstractHelper;



class CurrentAcademicYearHelper extends AbstractHelper implements ServiceLocatorAwareInterface
{	use \Zend\ServiceManager\ServiceLocatorAwareTrait;
	    /**
     *
     * @var \Zend\ServiceManager\ServiceManager
     */
    private $sm;


    public function __construct(\Zend\ServiceManager\ServiceManager $sm) {
        $this->sm = $sm;
    }

    public function getSm() {
        return $this->sm;
    }


		

    public function __invoke()
    { //$config = $this->getServiceLocator()->getServiceLocator()->get('Config');
       $entityManager= $this->getSm()->get('doctrine.entitymanager.orm_default');
       return $sessions =$entityManager->getRepository('Admin\Entity\AcademicYear')->findOneBy(array(),array('id'=>'DESC'));
    
    }

       
}
