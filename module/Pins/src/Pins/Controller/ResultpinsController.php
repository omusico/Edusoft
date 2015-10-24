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
use Zend\View\Model\JsonModel;

use Pins\Entity\Resultpins;

class ResultpinsController extends AbstractActionController
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


 		$dql = "SELECT r,sec,se,y,t,s FROM Pins\Entity\Resultpins r LEFT JOIN r.section sec LEFT JOIN r.student s LEFT JOIN r.session se LEFT JOIN se.year y LEFT JOIN se.term t where se.id=?1";
        $query = $this->getEntityManager()->createQuery($dql)->setParameters(array('1'=>$session)); 
        $pins = $query->getScalarResult();
        //var_dump($pins);die;
       
        return new ViewModel(array('pins'=>$pins));
	}
		 
    public function createAction()
    {
    	$entityManager=$this->getEntityManager();
    	$session=$this->getEntityManager()->getRepository('Admin\Entity\Session')->findOneBy(array(), array('id' => 'DESC'));
       
    	
    	$pins=new Resultpins();

    	  if ($this->getRequest()->isPost()) {
            $quantity =(int) $this->params()->fromPost('quantity');
            $section=$this->getEntityManager()->getRepository('Admin\Entity\Section')->findOneBy(array('id' => $this->params()->fromPost('section')));

			$this->flashMessenger()->addSuccessMessage($quantity. 'Pins Created Successfully!');		
           
			$this->bulkcreate($quantity,$section);	
			return $this->redirect()->toRoute('resultpins', array('controller'=>'resultpins', 'action'=>'dashboard'));
			 }
			$dql = "SELECT s FROM Admin\Entity\Section s ORDER BY s.id DESC ";
	        $query = $this->getEntityManager()->createQuery($dql); 
	        $sections = $query->getArrayResult();
		
			 
			  return new ViewModel(array('sections'=>$sections));
		}

		public function insert($section){
			$entityManager=$this->getEntityManager();
    		$session=$this->getEntityManager()->getRepository('Admin\Entity\Session')->findOneBy(array(), array('id' => 'DESC'));
			$pins =new Resultpins();	   
			$pins->setPin($this->pin());
			$pins->setCreatedAt(new \DateTime("now"));
			$pins->setSession($session);
			$pins->setSection($section);
			$entityManager->persist($pins);
			return true;
		}

		public function bulkcreate($quantity,$section){
			$entityManager=$this->getEntityManager();
			for($i=0; $i<$quantity; $i++){							   
			$this->insert($section);
			}
			 $entityManager->flush();
			}

		public function pin()
		{
			  static $max = 60466175; // ZZZZZZ in decimal
    return strtoupper(sprintf(
        "%05s-%05s-%05s-%05s-%05s",
        base_convert(mt_rand(0, $max), 10, 36),
        base_convert(mt_rand(0, $max), 10, 36),
        base_convert(mt_rand(0, $max), 10, 36),
        base_convert(mt_rand(0, $max), 10, 36),
        base_convert(mt_rand(0, $max), 10, 36)
    ));
		}

        
    
}
