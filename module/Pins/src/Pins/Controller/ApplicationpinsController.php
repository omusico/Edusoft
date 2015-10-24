<?php
/**
 * Edusoft (http://www.edusoft.com.ng/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2014 Mibs Technologies Inc. (http://www.Mibstechnologies.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Pins\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

use DoctrineORMModule\Stdlib\Hydrator\DoctrineEntity;

use Pins\Entity\Applicationpins;


class ApplicationpinsController extends AbstractActionController
		{			/**
		     * @var Doctrine\ORM\EntityManager
		     */
		    protected $entityManager;
		    
		    public function setEntityManager(EntityManager $em)
		    {
		      $this->$entityManager = $em;
		    }
		    
		    public function getEntityManager()
		    {
		      if (null === $this->entityManager) {
		        $this->entityManager = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');
		      }
		      return $this->entityManager;
		    }

	public function dashboardAction()
	{
		$entityManager=$this->getEntityManager();
		$sefssion=$this->getEntityManager()->getRepository('Admin\Entity\Session')->findOneBy(array(), array('id' => 'DESC'));
	    $session=$sefssion->getId();


 		$dql = "SELECT r,sec,se,y,t FROM Admin\Entity\Resultpins r LEFT JOIN r.section sec  LEFT JOIN r.session se LEFT JOIN se.year y LEFT JOIN se.term t where se.id=?1";
        $query = $this->getEntityManager()->createQuery($dql)->setParameters(array('1'=>$session)); 
        $pins = $query->getScalarResult();

        $dql = "SELECT s FROM Admin\Entity\Section s ORDER BY s.id DESC ";
        $query = $this->getEntityManager()->createQuery($dql); 
        $sections = $query->getArrayResult();

        return new ViewModel(array('pins'=>$pins,'sections'=>$sections));
	}
		 
    public function createAction()
    {
    	$entityManager=$this->getEntityManager();
    	$session=$this->getEntityManager()->getRepository('Admin\Entity\Session')->findOneBy(array(), array('id' => 'DESC'));
       
    	
    	$pins=new Resultpins();

    	  if ($this->getRequest()->isPost()) {
            $quantity = $this->params()->fromPost('quantity');
            
             $section=$this->getEntityManager()->getRepository('Admin\Entity\Section')->findOneBy(array('id' => $this->params()->fromPost('section')));
	
			for($i=0; $i<$quantity; $i++) {							   
			$random = substr(number_format(time() * rand(), 0, "", ""),0,12);					
			$see = substr(number_format(time() * rand(), 0, "", ""),0,12);
			$pins->setSerial($see);
			$pins->setPin($random);
			$pins->setCreatedAt(date('d/m/Y'));
			$pins->setSession($session);
			$pins->setSection($section);
			$entityManager->persist($pins);
			  }
			
			$this->flashMessenger()->addSuccessMessage($quantity. 'Pins Created Successfully!');				
            $entityManager->flush();
				
			 }
		
			 return $this->redirect()->toRoute('resultpins', array('controller'=>'resultpins', 'action'=>'dashboard'));
		}

        return new ViewModel(array());
    }

}
