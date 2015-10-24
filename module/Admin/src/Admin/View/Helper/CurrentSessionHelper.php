<?php
/**
 * ZF-Hipsters Bootstrap Flash Messenger (https://github.com/zf-hipsters)
 *
 * @link      https://github.com/zf-hipsters/bootstrap-flash-messenger for the canonical source repository
 * @copyright Copyright (c) 2013 ZF-Hipsters
 * @license   http://www.apache.org/licenses/LICENSE-2.0 Apache Licence, Version 2.0
 */

namespace Admin\View\Helper;

use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

use Zend\View\Helper\AbstractHelper;



class CurrentSessionHelper extends AbstractHelper implements ServiceLocatorAwareInterface
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
       $sessions=$entityManager->createQuery("SELECT s, y, t FROM Admin\Entity\Session s JOIN s.year y JOIN s.term t ORDER BY s.id DESC")
                    ->setMaxResults(1)
                    ->getArrayResult();
       return $sessions;
    }

         public function getYear($number=1)
    {
         $entityManager =$this->getServiceLocator()->get('doctrine.entitymanager.orm_default');
         $query = $entityManager->createQuery("SELECT y.name FROM Admin\Entity\Session s LEFT JOIN s.year y WHERE s.year =y.id ORDER BY s.id DESC")->setMaxResults(1)->getResult();
         $year=$query[0]['name'];
         return $year;
    }

     public function getTerm($number=1)
    {  $entityManager =$this->getServiceLocator()->get('doctrine.entitymanager.orm_default');
         $query = $entityManager->createQuery("SELECT t.name FROM Admin\Entity\Session s LEFT JOIN s.term t WHERE s.term =t.id ORDER BY s.id DESC")->setMaxResults(1)->getResult();
         $term=$query[0]['name'];
         return $term;
       }
}
