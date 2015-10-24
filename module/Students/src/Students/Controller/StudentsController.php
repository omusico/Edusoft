<?php

namespace Students\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject as DoctrineHydrator;
use Zend\InputFilter\InputFilter;
use Zend\Crypt\Password\Bcrypt;
use Zend\View\Model\JsonModel;
use Zend\Form\Form;

use Admin\Form\StudentForm;
use Admin\Entity\Student;

class StudentsController extends AbstractActionController
{ 
	protected $em;
	public function dashboardAction()
	{
		return new ViewModel();
	}
    public function eventsAction()
  {
    return new ViewModel();
  }

     public function teachersAction()
  {    $id = $this->zfcUserAuthentication()->getIdentity()->getId();   
        $sid=$this->getOM()->getRepository('Admin\Entity\Student')->findOneBy(array('user' => $id));
        $class=$sid->getCurrentclass()->getId();

        $session=$this->getOM()->getRepository('Admin\Entity\Session')->findOneBy(array(),array('id'=>'DESC'));
        $sein=$session->getId();

        $dql = "SELECT t,s,sb,c,se,y,te FROM Admin\Entity\Teacher t LEFT JOIN t.staff s LEFT JOIN t.subject sb LEFT JOIN t.class c LEFT JOIN t.session se LEFT JOIN se.year y  LEFT JOIN se.term te  WHERE t.class=?1 and t.session=?2 ORDER BY se.id DESC";
        $query = $this->getOM()->createQuery($dql)->setParameters(array(1=>$class,2=>$sein)); 
        $teachers = $query->getScalarResult();

  

    return new ViewModel(array('teachers'=>$teachers,));
          
}
   public function profileAction()
    {   
		    $id = $this->zfcUserAuthentication()->getIdentity()->getId();   
        $sid=$this->getOM()->getRepository('Admin\Entity\Student')->findOneBy(array('user' => $id));

        $student = $this->getOM()->getRepository('Admin\Entity\StudentHistory')->findOneBy(array('student' => $sid));
        if (!$student) {
             return $this->redirect()->toRoute('student', array('controller'=>'student', 'action'=>'view')); 
        }
        return new ViewModel( array('student'=>$student));
    }

    public function attendanceAction()
  {   
   if ($this->getRequest()->isPost()) {
            $session = $this->params()->fromPost('session');
            $login = $this->zfcUserAuthentication()->getIdentity()->getId();        
            $sid=$this->getOM()->getRepository('Admin\Entity\Student')->findOneBy(array('user' => $login));
            $id=$sid->getId();
          
            }
            else {
                  $session='';
                  $id='';
            }


        $dql = "SELECT a,s,se,p,c,y,t FROM Admin\Entity\Attendance a LEFT JOIN a.student s LEFT JOIN s.person p LEFT JOIN a.session se LEFT JOIN se.year y LEFT JOIN se.term t LEFT JOIN a.class c Where s.id=?1 and se.id=?2 ORDER BY a.date DESC ";
        $query = $this->getOM()->createQuery($dql)->setParameters(array(1=>$id, 2=>$session)); 
        $attends = $query->getScalarResult();
        
        $sessions=$this->getServiceLocator()->get('Admin\Service\SettingsService')->getCurrentSession(); 

        return new ViewModel(array('sessions'=>$sessions,'attends'=>$attends));
  }

      public function transportationAction()
  {     $login = $this->zfcUserAuthentication()->getIdentity()->getId();        
        $sid=$this->getOM()->getRepository('Admin\Entity\Student')->findOneBy(array('user' => $login));
        $id=$sid->getId();

        $dql = "SELECT s,st,se,y,t,sr,r,v,d FROM Transport\Entity\AllotTransport s LEFT JOIN s.student st LEFT JOIN s.session se LEFT JOIN se.year y LEFT JOIN se.term t LEFT JOIN s.route sr LEFT JOIN sr.route r LEFT JOIN sr.driver d LEFT JOIN sr.vehicle v WHERE st.id=?1 ORDER BY se.id DESC ";
        $query = $this->getOM()->createQuery($dql)->setParameters(array(1=>$id));
        $allots = $query->getScalarResult();
       // var_dump($sessionroutes);die;

    return new ViewModel(array('allots'=>$allots));
  }

         public function feeAction()
       { 
        $login = $this->zfcUserAuthentication()->getIdentity()->getId();        
        $sid=$this->getOM()->getRepository('Admin\Entity\Student')->findOneBy(array('user' => $login));
        $id=$sid->getId();
        $dql = "SELECT s,fst,fs,sec,se,y,t FROM Admin\Entity\Student s LEFT JOIN s.studentTotal fst LEFT JOIN fst.feeStudent fs   LEFT JOIN s.section sec LEFT JOIN fst.session se LEFT JOIN se.year y LEFT JOIN se.term t  WHERE s.id=?3";
        $query = $this->getOM()->createQuery($dql)->setParameters(array(3=>$id)); 
        $feetotals = $query->getScalarResult();
        return new ViewModel(array('feetotals' => $feetotals));
       }

        public function transactionAction()
       { 
          $id = $this->params()->fromRoute('id');
          $dql = "SELECT s,p FROM Admin\Entity\FeeStudent  s LEFT JOIN s.payments p WHERE s.id=?3";
          $query = $this->getOM()->createQuery($dql)->setParameters(array(3=>$id));; 
          $transactions = $query->getScalarResult();
       
         $total=$this->getOM()->getRepository('Admin\Entity\FeeStudentTotal')->findOneBy(array('feeStudent' =>$id));
          return new ViewModel(array('transactions' => $transactions, 'total'=>$total));
       }
   


         public function resultAction()
      {    
      	if ($this->getRequest()->isPost()) {
                       $pin = $this->params()->fromPost('pin');	
                 //get student
                $id = $this->zfcUserAuthentication()->getIdentity()->getId();
            		$studen=$this->getOM()->getRepository('Admin\Entity\Student')->findOneBy(array('user' => $id));
            		$session=$this->getServiceLocator()->get('Admin\Service\SettingsService')->getCurrentSession()->getId();	
                }
                else{
                  $session='';
                  $studen='';

                }
           
        //gets all session of current student in the resultpin
        $results=$this->getOM()->getRepository('Pins\Entity\Resultpins')->findOneBy(array('pin'=>$pin,'session'=>$session));

        if(isset($results)){
            if(null!==$results->getStudent()){
             $this->flashMessenger()->addErrorMessage('This pin number has been used by another user');
             return $this->redirect()->toRoute('students', array('controller'=>'students', 'action'=>'pin'));
            }
          //attach the student id to the pin number and stamp the date
        	$results->setStudent($studen);
          $results->setActivatedAt(new \DateTime("now"));
        	$this->getOM()->persist($results);
        	$this->getOM()->flush();
        }
        else{
        	$this->flashMessenger()->addErrorMessage('This pin number could not be verify');
        	return $this->redirect()->toRoute('students', array('controller'=>'students', 'action'=>'pin'));
        	}
        //get student result grading information
        $dql = "SELECT s,b,g FROM Admin\Entity\Result s LEFT JOIN s.subject b LEFT JOIN s.grade g WHERE s.session=?1 and  s.student=?2  ";
        $query = $this->getOM()->createQuery($dql)->setParameters(array('1'=>$session,'2'=>$studen->getId())); 
        $results = $query->getScalarResult();

        //get student information
        $dql = "SELECT s,st,p,c,sc,y,t FROM Admin\Entity\Result s LEFT JOIN s.class c LEFT JOIN s.student st LEFT JOIN st.person p LEFT JOIN s.session sc LEFT JOIN sc.year y LEFT JOIN sc.term t WHERE s.session=?1 and s.student=?3  ";
        $query = $this->getOM()->createQuery($dql)->setParameters(array('1'=>$session,'3'=>$studen->getId()))->setMaxResults(1); 
        $students = $query->getScalarResult();

        //get student rating information
        $dql = "SELECT r,p FROM Admin\Entity\Rating r LEFT JOIN r.traits p  WHERE r.session=?1 and r.student=?2  ";
        $query = $this->getOM()->createQuery($dql)->setParameters(array('1'=>$session,'2'=>$studen->getId())); 
        $rates = $query->getScalarResult();
        //var_dump($students);die;
        if($students) {
          foreach ($students as $student) {
            $class=$student['c_id'];
          }



        $StudentTotal = $this->getServiceLocator()->get('Admin\Service\StudentDashboardService')->getStudentTotal($session,$class,$studen->getId());
        $MaxScore= $this->getServiceLocator()->get('Admin\Service\StudentDashboardService')->getMaxTotal($session,$class,$studen->getId());
        $HighestScore= $this->getServiceLocator()->get('Admin\Service\StudentDashboardService')->getHighestScore($session,$class);
        $LowestScore= $this->getServiceLocator()->get('Admin\Service\StudentDashboardService')->getLowestScore($session,$class);
        $StudentAverage=$StudentTotal/$MaxScore * 100;
        $HighestAverage=$HighestScore/$MaxScore * 100;
        $LowestAverage=$LowestScore/$MaxScore * 100;
        $ClassNo = $this->getServiceLocator()->get('Admin\Service\StudentDashboardService')->getClassNo($class);
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
         return new ViewModel(array('ClassNo'=>$ClassNo,'students'=>$students,'results'=>$results,'rates'=>$rates,'StudentTotal'=>$StudentTotal,'MaxScore'=>$MaxScore,'HighestScore'=>$HighestScore,'LowestScore'=>$LowestScore,'StudentAverage'=>$StudentAverage,'HighestAverage'=>$HighestAverage,'LowestAverage'=>$LowestAverage));
  
        }

        public function pinAction()
        {
        	return new ViewModel();
        }

          public function progressAction()
        {  
            $sid = $this->zfcUserAuthentication()->getIdentity()->getId();
            $studen=$this->getOM()->getRepository('Admin\Entity\Student')->findOneBy(array('user' => $sid));
            $id=$studen->getId();
          $progresses=$this->getOM()->getRepository('Admin\Entity\StudentHistory')->findBy(array('student' => $id));
          return new ViewModel(array('progresses'=>$progresses));
        }



       public function preresultAction()
  {    
  	if ($this->getRequest()->isPost()) {
        
            $session = $this->params()->fromPost('sessionx');	
            }
            else{
              $session='';
              $studen='';

            }
          $id = $this->zfcUserAuthentication()->getIdentity()->getId();       
          $sid=$this->getOM()->getRepository('Admin\Entity\Student')->findOneBy(array('user' => $id));
          $studen=$sid->getId();

        //gets all session of current student in the resultpin
        $results=$this->getOM()->getRepository('Pins\Entity\Resultpins')->findBy(array('student'=>$studen), array('id' => 'DESC'));
        //forget about the pins and serial numbers we only need the session
        if($results){
        	 $sessions=$results;
        }
        else{$sessions='';}
       

        $dql = "SELECT s,b,g FROM Admin\Entity\Result s LEFT JOIN s.subject b LEFT JOIN s.grade g WHERE s.session=?1 and  s.student=?2  ";
        $query = $this->getOM()->createQuery($dql)->setParameters(array('1'=>$session,'2'=>$studen)); 
        $results = $query->getScalarResult();

        $dql = "SELECT s,st,p,c,sc,y,t FROM Admin\Entity\Result s LEFT JOIN s.class c LEFT JOIN s.student st LEFT JOIN st.person p LEFT JOIN s.session sc LEFT JOIN sc.year y LEFT JOIN sc.term t WHERE s.session=?1 and s.student=?3  ";
        $query = $this->getOM()->createQuery($dql)->setParameters(array('1'=>$session,'3'=>$studen))->setMaxResults(1); 
        $students = $query->getScalarResult();
      //  var_dump($students);die;

        $dql = "SELECT r,p FROM Admin\Entity\Rating r LEFT JOIN r.traits p  WHERE r.session=?1 and r.student=?2  ";
        $query = $this->getOM()->createQuery($dql)->setParameters(array('1'=>$session,'2'=>$studen)); 
        $rates = $query->getScalarResult();

        if($students) {
          foreach ($students as $student) {
            $class=$student['c_id'];
              //var_dump($class);die;
          }

        $StudentTotal=$this->getServiceLocator()->get('Admin\Service\StudentDashboardService')->getStudentTotal($session,$class,$studen);
        $MaxScore=$this->getServiceLocator()->get('Admin\Service\StudentDashboardService')->getMaxTotal($session,$class,$studen);
        $HighestScore=$this->getServiceLocator()->get('Admin\Service\StudentDashboardService')->getHighestScore($session,$class);
        $LowestScore=$this->getServiceLocator()->get('Admin\Service\StudentDashboardService')->getLowestScore($session,$class);
        $ClassNo=$this->getServiceLocator()->get('Admin\Service\StudentDashboardService')->getClassNo($class);
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




    return new ViewModel(array('ClassNo'=>$ClassNo,'students'=>$students,'results'=>$results,'sessions'=>$sessions,'rates'=>$rates,'StudentTotal'=>$StudentTotal,'MaxScore'=>$MaxScore,'HighestScore'=>$HighestScore,'LowestScore'=>$LowestScore,'StudentAverage'=>$StudentAverage,'HighestAverage'=>$HighestAverage,'LowestAverage'=>$LowestAverage));
  
  }

	public function editAction()
	{	  $entityManager=$this->getOM();
		 $viewmodel = new ViewModel();

        $ud = $this->zfcUserAuthentication()->getIdentity()->getId();
        $iud=$this->getOM()->getRepository('Admin\Entity\Student')->findOneBy(array('user' => $ud));
        $id=$iud->getId();
        if (!$id) {
            return $this->redirect()->toRoute('students', array('controller'=>'students','action' => 'dashboard'));
        }

        $student = $entityManager->find('Admin\Entity\Student', $id);
        $image=$student->getImage();

        if (!$student) {
             return $this->redirect()->toRoute('students', array('controller'=>'students', 'action'=>'dashboard')); 
        }

        $form = new StudentForm($entityManager);
        $form->bind($student);
        
        $form->get('submit')->setAttribute('value', 'Edit');

        $request = $this->getRequest();
        if ($request->isPost()) {
           $dataForm = array_merge_recursive(
                $request->getPost()->toArray(),
                $request->getFiles()->toArray()
            );
         $form->setData($dataForm);
            //exclude section and year from being validated
                $form->setValidationGroup(array(
                         'student' => array(
                         	'image',
                             'person' => array(
                                 'fname',
                                 'lname',
                                 'mname',
                                 'mobile',
                                 'address',
                                 'country',
                                 'state',
                                 'lga',
                                 'dob',
                                 'sex',
                                 'religion',
                                 'nokName',
                                 'nokRel',
                                 'nokMobile',
                             ),
                         ),
                     )); 

         if ($form->isValid()) {
           
            $pre=$form->getData('student');
            $data=$pre->getImage();
            if(!$data){
                $student->setImage($image);
            }

            $student->setCurrentclass($pre->getClass());
            $entityManager->persist($student);
            $entityManager->flush();
                // Redirect to list of albums
                return $this->redirect()->toRoute('students', array('controller'=>'students', 'action'=>'dashboard')); 
           	}  
		}
      
          $viewmodel->setVariables(array(
                    'form' => $form,
                    'id' =>$id,
                    'image'=>$image
                    
        ));
        
        return $viewmodel;
	}

	    /**
     * ORM object manager
     * @return \Doctrine\ORM\EntityManager
     */
    protected function getOM() {
        return $this
                        ->getServiceLocator()
                        ->get('Doctrine\ORM\EntityManager');
    }

	    protected function getPasswordForm() {
        $translator = $this->getServiceLocator()->get('translator');
        $form = new Form('password');
        $form ->setAttribute('class', 'smart-form client')
                ->add(array(
                    'name' => 'oldPassword',
                    'type' => 'password',
                    'attributes' => array(
                        'class' => 'form-control input-sm',
                        'placeholder' => 'Enter old password',
                    )
                ))
                ->add(array(
                    'name' => 'password',
                    'type' => 'password',
                    'attributes' => array(
                        'class' => 'form-control input-sm',
                        'placeholder' => 'Enter new password'
                    )
                ))
                ->add(array(
                    'name' => 'password_confirm',
                    'type' => 'password',
                    'attributes' => array(
                        'class' => 'form-control input-sm',
                        'placeholder' => 'Enter confirm password'
                    )
                ))
                ->add(array(
                    'name' => 'save',
                    'type' => 'submit',
                    'attributes' => array(
                        'value' => 'Save',
                        'class' => 'btn btn-sm btn-success'
                    )
        ));

        $filter = new InputFilter();
        $filter
                ->add(array(
                    'name' => 'password',
                    'required' => true
                ))
                ->add(array(
                    'name' => 'oldPassword',
                    'required' => true
                ))
                ->add(array(
                    'name' => 'password_confirm',
                    'required' => false,
                    'validators' => array(
                        array(
                            'name' => 'Identical',
                            'options' => array(
                                'token' => 'password',
                            )
                        )
                    )
                        )
                )
        ;
        $form->setInputFilter($filter);

        return $form;
    }
    
    public function passwordAction(){
        if (!$this->zfcUserAuthentication()->hasIdentity()) {
            $this->flashMessenger()->addWarningMessage($translator->translate('User not logged in'));
            $this->redirect()->toRoute('home');
            return true;
        }
        $form = $this->getPasswordForm();
        if ($this->getRequest()->isPost()) {
            $form->setData($this->getRequest()->getPost());
            if ($form->isValid()) {
                $data = $form->getData();
                $user = $this->zfcUserAuthentication()->getIdentity();
                $bcrypt = new Bcrypt;
                $bcrypt->setCost(14);
                if (!$bcrypt->verify($data['oldPassword'], $user->getPassword())) {
                    $this->flashMessenger()->addErrorMessage('Old password don\'t match');
                   return $this->redirect()->toRoute('students', array('controller'=>'students', 'action'=>'password'));
                   // return false;
                }
                else{
                $user->setPassword($this->encriptPassword($data['password']));
                $this->getOM()->persist($user);
                $this->getOM()->flush();
                $this->flashMessenger()->addSuccessMessage('Password changed');
               return $this->redirect()->toRoute('students', array('controller'=>'students', 'action'=>'password'));}
            }
        }
        $form->prepare();
        return new ViewModel(array(
            'form' => $form
        ));
    }

        public function encriptPassword($newPass) {
        $bcrypt = new Bcrypt;
        $bcrypt->setCost(14);
        $pass = $bcrypt->create($newPass);
        return $pass;
    }
}
