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


use Admin\Entity\Result;
use Admin\Entity\TraitName; 
use Admin\Entity\Aggregate;
use Admin\Form\ResultForm;       

use DoctrineORMModule\Stdlib\Hydrator\DoctrineEntity;
use Zend\View\Model\JsonModel;
use Doctrine\ORM\Query\Expr;



class ResultController extends AbstractActionController
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
	{  //$this->entityManager = $this->getServiceLocator()->get('Admin\Service\StudentDashboardService')->getHighestScore();
		return new ViewModel(array());
	}

    public function singleAction()
  {    if ($this->getRequest()->isPost()) {
            $id = $this->getEntityManager()->getRepository('Admin\Entity\Classes')->findOneBy(array('name' => $this->params()->fromPost('classx')));
            $class=$id->getId();
            $session = $this->params()->fromPost('sessionx');
            $stu = $this->getEntityManager()->getRepository('Admin\Entity\Student')->findOneBy(array('admNo' => $this->params()->fromPost('studentx')));
            $student=$stu->getId();
            }
            else{$class='';
              $section='';
              $session='';
              $student='';

            }
         //  var_dump($class);die;
        $sessions=$this->getEntityManager()->getRepository('Admin\Entity\Session')->findAll(array(), array('id' => 'DESC'));

        $dql = "SELECT s FROM Admin\Entity\Section s ORDER BY s.id DESC ";
        $query = $this->getEntityManager()->createQuery($dql); 
        $sections = $query->getArrayResult();

        $dql = "SELECT s,b,g FROM Admin\Entity\Result s LEFT JOIN s.subject b LEFT JOIN s.grade g WHERE s.session=?1 and  s.class=?2 and s.student=?3  ";
        $query = $this->getEntityManager()->createQuery($dql)->setParameters(array('2'=>$class, '1'=>$session,'3'=>$student)); 
        $results = $query->getScalarResult();

        $dql = "SELECT s,st,p,c,sc,y,t FROM Admin\Entity\Result s LEFT JOIN s.class c LEFT JOIN s.student st LEFT JOIN st.person p LEFT JOIN s.session sc LEFT JOIN sc.year y LEFT JOIN sc.term t WHERE s.session=?1 and  s.class=?2 and s.student=?3  ";
        $query = $this->getEntityManager()->createQuery($dql)->setParameters(array('2'=>$class, '1'=>$session,'3'=>$student))->setMaxResults(1); 
        $students = $query->getScalarResult();
        //var_dump($students);die;

        $dql = "SELECT r,p FROM Admin\Entity\Rating r LEFT JOIN r.traits p  WHERE r.session=?1 and r.student=?2  ";
        $query = $this->getEntityManager()->createQuery($dql)->setParameters(array('1'=>$session,'2'=>$student)); 
        $rates = $query->getScalarResult();

                if($students) {
            $StudentTotal=$this->entityManager = $this->getServiceLocator()->get('Admin\Service\StudentDashboardService')->getStudentTotal($session,$class,$student);
            $MaxScore=$this->entityManager = $this->getServiceLocator()->get('Admin\Service\StudentDashboardService')->getMaxTotal($session,$class,$student);
            $HighestScore=$this->entityManager = $this->getServiceLocator()->get('Admin\Service\StudentDashboardService')->getHighestScore($session,$class);
            $LowestScore=$this->entityManager = $this->getServiceLocator()->get('Admin\Service\StudentDashboardService')->getLowestScore($session,$class);
            $ClassNo=$this->entityManager = $this->getServiceLocator()->get('Admin\Service\StudentDashboardService')->getClassNo($class);
            $StudentAverage=$StudentTotal/$MaxScore * 100;
            $HighestAverage=$HighestScore/$MaxScore * 100;
            $LowestAverage=$LowestScore/$MaxScore * 100;
            }else{
                $StudentTotal='';
                $MaxScore='';
                $HighestScore='';
                $LowestScore='';
                $StudentAverage='';
                $HighestAverage='';
                $LowestAverage='';
                $ClassNo='';

            }



    return new ViewModel(array('ClassNo'=>$ClassNo,'students'=>$students,'results'=>$results,'sections'=>$sections,'sessions'=>$sessions,'rates'=>$rates,'StudentTotal'=>$StudentTotal,'MaxScore'=>$MaxScore,'HighestScore'=>$HighestScore,'LowestScore'=>$LowestScore,'StudentAverage'=>$StudentAverage,'HighestAverage'=>$HighestAverage,'LowestAverage'=>$LowestAverage));
  }

	public function inputAction()

	{	        

	 if ($this->getRequest()->isPost()) {
               $id = $this->getEntityManager()->getRepository('Admin\Entity\Classes')->findOneBy(array('name' => $this->params()->fromPost('classx')));
            $class=$id->getId();
            $section = $this->params()->fromPost('sectionx');
            $subject = $this->params()->fromPost('subjectx');
            }
            else{$class='';
            	$section='';
            	$subject='';

            }
         $sefssion=$this->getEntityManager()->getRepository('Admin\Entity\Session')->findOneBy(array(), array('id' => 'DESC'));
         $session=$sefssion->getId();

         $dql = "SELECT s,r,p,c FROM Admin\Entity\Student s LEFT JOIN s.person p LEFT JOIN s.section sec LEFT JOIN s.currentclass c LEFT JOIN s.result r with r.subject=?1 and  r.session=?2 and r.student=s.id Where s.currentclass=?3 ORDER BY s.id DESC ";
        $query = $this->getEntityManager()->createQuery($dql)->setParameters(array('2'=>$session, '1'=>$subject,'3'=>$class)); 
        $sessions = $query->getScalarResult();
       
		//var_dump($sessions);die;


  

          $dql = "SELECT s FROM Admin\Entity\Subject s WHERE s.id=?1 ";
        $query = $this->getEntityManager()->createQuery($dql)->setParameters(array('1'=>$subject, )); 
        $subs = $query->getArrayResult();


          $dql = "SELECT s FROM Admin\Entity\Section s WHERE s.id=?1 ";
        $query = $this->getEntityManager()->createQuery($dql)->setParameters(array('1'=>$section, )); 
        $sects = $query->getArrayResult();

        // var_dump($subs);die;

          $dql = "SELECT s FROM Admin\Entity\Classes s ORDER BY s.id DESC ";
        $query = $this->getEntityManager()->createQuery($dql); 
        $classes = $query->getArrayResult();

          $dql = "SELECT s FROM Admin\Entity\Subject s ORDER BY s.id DESC ";
        $query = $this->getEntityManager()->createQuery($dql); 
        $subjects = $query->getArrayResult();

         $dql = "SELECT s FROM Admin\Entity\Section s ORDER BY s.id DESC ";
        $query = $this->getEntityManager()->createQuery($dql); 
        $sections = $query->getArrayResult();

               

 
		return new ViewModel(array('sessions'=>$sessions,'subjects'=>$subjects,'classes'=>$classes,'sects'=>$sects,'sections'=>$sections,'subs'=>$subs));
	}
 


 public function gradesAction()
	{  $sefssion=$this->getEntityManager()->getRepository('Admin\Entity\Session')->findOneBy(array(), array('id' => 'DESC'));
     $session=$sefssion->getId();

  

		$post =$this->getRequest()->getPost()->toArray();
		$id = $_POST['id'];
    $subject = $_POST['subject'];
    $ftest = $_POST['ftest'];
		$stest = $_POST['stest'];
		$exam = $_POST['exam'];
    $section = $_POST['section'];
    $classx = $_POST['class'];
    //$total=$ftest+$stest+$exam;
		//var_dump($name);die;
    foreach( $id as $key => $n ) {
      $studens=$this->getEntityManager()->getRepository('Admin\Entity\Student')->findOneBy(array('id'=>$n));
      $subjj=$this->getEntityManager()->getRepository('Admin\Entity\Subject')->findOneBy(array('id'=>$subject[$key]));
      $class=$this->getEntityManager()->getRepository('Admin\Entity\Classes')->findOneBy(array('id'=>$classx[$key]));
       $result=$this->getEntityManager()->getRepository('Admin\Entity\Result')->findOneBy(array('student'=>$n,'session'=>$session,'subject'=>$subject[$key]));

   $total=$ftest[$key]+$stest[$key]+$exam[$key];
   $sectionx=$section[$key];
   //query to get the gradesystem row that total falls within startrange and endrange 
   $query = $this->getEntityManager()->createQuery('SELECT s,g,i,ass,ca FROM Admin\Entity\Settings s LEFT JOIN s.assessment ass LEFT JOIN ass.caSystems ca LEFT JOIN  s.grade g LEFT JOIN g.gradeSystems i with :groupId BETWEEN  i.startRange and i.endRange WHERE s.session=:session and s.section=:section'); 
   $query->setParameters(array('groupId'=>$total,'session'=>$session,'section'=>$sectionx)); 
   $settings = $query->getScalarResult();
    foreach ($settings as $setting) {
      $grad=$setting['i_id'];
      $subtotal=$setting['ca_percentage'];
    }
   //get the gradesystem object in order to store it
   $grade=$this->getEntityManager()->getRepository('Admin\Entity\GradeSystem')->findOneBy(array('id'=>$grad));
   

    
     
         if(isset($result))
            {
              $result->setFirstTest($ftest[$key]);
              $result->setSecondTest($stest[$key]);
              $result->setExam($exam[$key]);
              $result->setClass($class);
              $result->setTotal($total);
              $result->setSubTotal($subtotal);
              $result->setGrade($grade);
              $this->getEntityManager()->persist($result);
            }
            else{
                $newresult= new Result();
                $newresult->setStudent($studens);
                $newresult->setSession($sefssion);
                $newresult->setSubject($subjj);
                $newresult->setFirstTest($ftest[$key]);
                $newresult->setSecondTest($stest[$key]);
                $newresult->setExam($exam[$key]);
                $newresult->setClass($class);
                $newresult->setTotal($total);
                $newresult->setSubTotal($subtotal);
                $newresult->setGrade($grade);
                $this->getEntityManager()->persist($newresult);
               }
/*
            $aggregate=$this->getEntityManager()->getRepository('Admin\Entity\Aggregate')->findOneBy(array('student'=>$n,'class'=>$classx[$key],'session'=>$session,));
             if(isset($aggregate))
            {
              $aggregate->setFirstTest($ftest[$key]);
              $aggregate->setSecondTest($stest[$key]);
              $aggregate->setExam($exam[$key]);
              $aggregate->setClass($class);
              $aggregate->setTotal($total);
              $aggregate->setGrade($grade);
              $this->getEntityManager()->persist($aggregate);
            }
            else{
                $aggregate= new Aggregate();
                $aggregate->setStudent($studens);
                $aggregate->setSession($sefssion);
                $aggregate->setSectionubject($subjj);
                $aggregate->setFirstTest($ftest[$key]);
                $aggregate->setSecondTest($stest[$key]);
                $aggregate->setExam($exam[$key]);
                $aggregate->setClass($class);
                $aggregate->setTotal($total);
                $aggregate->setGrade($grade);
                $this->getEntityManager()->persist($aggregate);
               }
               */
      }
      
     $this->getEntityManager()->flush();
     return $this->redirect()->toRoute('result', array('controller'=>'result', 'action'=>'input'));


		return new ViewModel();
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
       var_dump($sss);die;
       
         return new JsonModel($results);
    }

 

       
}