<?php
/**
 * Cloud Base Educational Management System
 *
 * @author Isaac Bitrus 
 * @copyright Copyright (c) 2015 Edusoft (http://www.edusoft.com.ng)
 */

namespace Admin\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;


use Admin\Entity\Attendance;
use Admin\Entity\TraitName; 
use Admin\Form\ResultForm;       

use DoctrineORMModule\Stdlib\Hydrator\DoctrineEntity;
use Zend\View\Model\JsonModel;
use Doctrine\ORM\Query\Expr;



class AttendanceController extends AbstractActionController
{
  /**
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



    public function indexAction()
  {   
   if ($this->getRequest()->isPost()) {
            
            $id = $this->getEntityManager()->getRepository('Admin\Entity\Classes')->findOneBy(array('name' => $this->params()->fromPost('classx')));
            $class=$id->getId();
            $section = $this->params()->fromPost('sectionx');
            $date = $this->params()->fromPost('date');
           // var_dump($date->format('Y-m-d'));die;
            }
            else { $class='';
                  $section='';
                  $date='';
              
            }

        $sefssion=$this->getEntityManager()->getRepository('Admin\Entity\Session')->findOneBy(array(), array('id' => 'DESC'));
        $session=$sefssion->getId();

        $dql = "SELECT a,s,se,p,c FROM Admin\Entity\Attendance a LEFT JOIN a.student s LEFT JOIN s.person p LEFT JOIN a.section se LEFT JOIN a.class c Where a.class=?1 ORDER BY a.date DESC ";
        $query = $this->getEntityManager()->createQuery($dql)->setParameters(array('1'=>$class)); 
        $attends = $query->getScalarResult();
  
        $dql = "SELECT s FROM Admin\Entity\Classes s ORDER BY s.id DESC ";
        $query = $this->getEntityManager()->createQuery($dql); 
        $classes = $query->getArrayResult();


        $dql = "SELECT s FROM Admin\Entity\Section s ORDER BY s.id DESC ";
        $query = $this->getEntityManager()->createQuery($dql); 
        $sections = $query->getArrayResult();

    return new ViewModel(array('classes'=>$classes,'sections'=>$sections,'attends'=>$attends));
  }

	public function rollcallAction()

	{	        

	 if ($this->getRequest()->isPost()) {
            
            $id = $this->getEntityManager()->getRepository('Admin\Entity\Classes')->findOneBy(array('name' => $this->params()->fromPost('classx')));
            $class=$id->getId();
            $section = $this->params()->fromPost('sectionx');
            }
            else { $class='';
            	    $section='';
            	
            }

        $sefssion=$this->getEntityManager()->getRepository('Admin\Entity\Session')->findOneBy(array(), array('id' => 'DESC'));
        $session=$sefssion->getId();

        $dql = "SELECT s,se,p,c FROM Admin\Entity\Student s LEFT JOIN s.person p LEFT JOIN s.section se LEFT JOIN s.currentclass c  Where s.currentclass=?1 ORDER BY s.id DESC ";
        $query = $this->getEntityManager()->createQuery($dql)->setParameters(array('1'=>$class)); 
        $attends = $query->getScalarResult();
       

        $dql = "SELECT s FROM Admin\Entity\Session s WHERE s.id=?1 ";
        $query = $this->getEntityManager()->createQuery($dql)->setParameters(array('1'=>$section, )); 
        $sects = $query->getArrayResult();


        $dql = "SELECT s FROM Admin\Entity\Classes s ORDER BY s.id DESC ";
        $query = $this->getEntityManager()->createQuery($dql); 
        $classes = $query->getArrayResult();


        $dql = "SELECT s FROM Admin\Entity\Section s ORDER BY s.id DESC ";
        $query = $this->getEntityManager()->createQuery($dql); 
        $sections = $query->getArrayResult();

		return new ViewModel(array('classes'=>$classes,'sects'=>$sects,'sections'=>$sections,'attends'=>$attends));
	}
 


 public function processAction()
	{  $sefssion=$this->getEntityManager()->getRepository('Admin\Entity\Session')->findOneBy(array(), array('id' => 'DESC'));
     $session=$sefssion->getId();

  

		$post =$this->getRequest()->getPost()->toArray();
		$id = $_POST['id'];
    $class = $_POST['class'];
    $section = $_POST['section'];
		$status = $_POST['status'];
		$reason = $_POST['reason'];
    
    //$total=$ftest+$stest+$exam;
		//var_dump($name);die;
    foreach( $id as $key => $n ) {
      $studens=$this->getEntityManager()->getRepository('Admin\Entity\Student')->findOneBy(array('id'=>$n));
      $secid=$this->getEntityManager()->getRepository('Admin\Entity\Section')->findOneBy(array('id'=>$section[$key]));
      $clasid=$this->getEntityManager()->getRepository('Admin\Entity\Classes')->findOneBy(array('id'=>$class[$key]));
      
      $attends=$this->getEntityManager()->getRepository('Admin\Entity\Attendance')->findOneBy(array('student'=>$n,'session'=>$session,'class'=>$class[$key],'section'=>$section[$key]));

    
     
         if(isset($attends))
            {
              $attends->setStudent($studens);
              $attends->setSection($secid);
              $attends->setDate(new \DateTime("now"));
              $attends->setClass($clasid);
              $attends->setStatus($status[$key]);
              $attends->setReason($reason[$key]);
              $this->getEntityManager()->persist($attends);
            }
            else{
                $attends= new Attendance();
                $attends->setSession($sefssion);
                $attends->setDate(new \DateTime("now"));
                $attends->setStudent($studens);
                $attends->setSection($secid);
                $attends->setClass($clasid);
                $attends->setStatus($status[$key]);
                $attends->setReason($reason[$key]);
                $this->getEntityManager()->persist($attends);

               }
      }
      
     $this->getEntityManager()->flush();
     return $this->redirect()->toRoute('attendance', array('controller'=>'attendance', 'action'=>'rollcall'));

	}
 


 


  public function classAction()
    {   $entityManager = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');
        
        $ids = $_POST['state'];
       // $statename=$entityManager->getRepository('Admin\Entity\State')->findOneBy(array('name' => $state));
        //$jh=$state->getName();
        


        $dql = "SELECT a FROM Admin\Entity\Classes a WHERE a.section IN (:ids)";
        $query = $entityManager->createQuery($dql)
            ->setParameter(':ids', $ids);
        $results = $query->getResult(\Doctrine\ORM\AbstractQuery::HYDRATE_ARRAY);       
    
         //var_dump($results);die;
         return new JsonModel($results);
    }

      public function studentAction()
    {   $entityManager = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');
        
        $state = $_POST['state'];
        $ids=$entityManager->getRepository('Admin\Entity\Classes')->findOneBy(array('name' => $state));
        $jh=$ids->getId();
        


        $dql = "SELECT a FROM Admin\Entity\Student a WHERE a.currentclass IN (:ids)";
        $query = $entityManager->createQuery($dql)
            ->setParameter(':ids', $jh);
        $results = $query->getResult(\Doctrine\ORM\AbstractQuery::HYDRATE_ARRAY);       
    
         //var_dump($results);die;
         return new JsonModel($results);
    }

    public function subjectAction()
    {   $entityManager = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');
        
        $ids = $_POST['state'];
       // $statename=$entityManager->getRepository('Admin\Entity\State')->findOneBy(array('name' => $state));
        //$jh=$state->getName();
        


        $dql = "SELECT a,s FROM Admin\Entity\SubjectSectionAssociation a LEFT JOIN a.subject s WHERE a.section IN (:ids)";
        $query = $entityManager->createQuery($dql)
            ->setParameter(':ids', $ids);
        $results = $query->getArrayResult(); 
        $sss=$results->getSubject();
      // var_dump($sss);die;
       
         return new JsonModel($results);
    }

 

       
}