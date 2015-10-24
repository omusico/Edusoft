<?php

namespace Teachers\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject as DoctrineHydrator;
use Zend\InputFilter\InputFilter;
use Zend\Crypt\Password\Bcrypt;
use Zend\View\Model\JsonModel;
use Zend\Form\Form;

use Admin\Form\StaffForm;
use Admin\Entity\Staff;

class TeachersController extends AbstractActionController
{ 
	protected $em;
	public function dashboardAction()
	{
		return new ViewModel();
	}
   public function profileAction()
    {   
		 $id = $this->zfcUserAuthentication()->getIdentity()->getId();
                 
        $staff=$this->getOM()->getRepository('Admin\Entity\Staff')->findOneBy(array('user' => $id));
        if (!$staff) {
             return $this->redirect()->toRoute('teachers', array('controller'=>'teachers', 'action'=>'dashboard')); 
        }
        return new ViewModel( array('staff'=>$staff));
    }

        public function postsAction()
        {  
            $sid = $this->zfcUserAuthentication()->getIdentity()->getId();
            $studen=$this->getOM()->getRepository('Admin\Entity\Staff')->findOneBy(array('user' => $sid));
            $id=$studen->getId();
          $positions=$this->getOM()->getRepository('Admin\Entity\StudentPosition')->findBy(array('staff' => $id));
          return new ViewModel(array('positions'=>$positions));
        }

         

	public function editAction()
	{	  $entityManager=$this->getOM();
		 $viewmodel = new ViewModel();

        $ud = $this->zfcUserAuthentication()->getIdentity()->getId();
        $staff=$this->getOM()->getRepository('Admin\Entity\Staff')->findOneBy(array('user' => $ud));
        $id=$staff->getId();
        if (!$id) {
            return $this->redirect()->toRoute('teachers', array('controller'=>'teachers','action' => 'dashboard'));
        }

        $image=$staff->getImage();


        $form = new StaffForm($entityManager);
        $form->bind($staff);
        
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
                             'staff' => array(
                                 'fname',
                                 'lname',
                                 'mname',
                                 'mobile1',
                                 'mobile2',
                                 'twitter',
                                 'facebook',
                                 'paddress',
                                 'raddress',
                                 'country',
                                 'email',
                                 'state',
                                 'lga',
                                 'image',
                                 'dob',
                                 'sex',
                                 'religion',
                                 'nokName',
                                 'nokRel',
                                 'nokMobile',
                         ),
                     )); 


         if ($form->isValid()) {
            $data=$form->getData('staff')->getImage();
            if(!$data){
                $staff->setImage($image);
            }
            $entityManager->persist($staff);
            $entityManager->flush();
                // Redirect to list of albums
                return $this->redirect()->toRoute('teachers', array('controller'=>'students', 'action'=>'dashboard')); 
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
                return $this->redirect()->toRoute('teachers', array('controller'=>'teachers', 'action'=>'dashboard'));
                   // return false;
                }
                else{
                $user->setPassword($this->encriptPassword($data['password']));
                $this->getOM()->persist($user);
                $this->getOM()->flush();
                $this->flashMessenger()->addSuccessMessage('Password changed');
               return $this->redirect()->toRoute('teachers', array('controller'=>'teachers', 'action'=>'dashboard'));}
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

        public function inputAction()

    {           

     if ($this->getRequest()->isPost()) {
              $sid = $this->zfcUserAuthentication()->getIdentity()->getId();
            $studen=$this->getOM()->getRepository('Admin\Entity\Staff')->findOneBy(array('user' => $sid));
            $id=$studen->getId();

             $xsession=$this->getOM()->getRepository('Admin\Entity\Session')->findOneBy(array(), array('id' => 'DESC'));
            $year=$sefssion->getYear()->getId();

            $formaster=$this->getOM()->getRepository('Admin\Entity\FormMaster')->findOneBy(array('staff' =>$id,'year'=>$year));
            $class=$formaster->getClass()->getId();
            $section = $formaster->getClass()->getSection()->getId();
            $subject = $this->params()->fromPost('subjectx');
            }
            else{$class='';
                $subject='';
                $section='';

            }
         $sefssion=$this->getOM()->getRepository('Admin\Entity\Session')->findOneBy(array(), array('id' => 'DESC'));
         $session=$sefssion->getId();

         $dql = "SELECT s,r,p,c FROM Admin\Entity\Student s LEFT JOIN s.person p LEFT JOIN s.section sec LEFT JOIN s.currentclass c LEFT JOIN s.result r with r.subject=?1 and  r.session=?2 and r.student=s.id Where s.currentclass=?3 ORDER BY s.id DESC ";
        $query = $this->getEntityManager()->createQuery($dql)->setParameters(array('2'=>$session, '1'=>$subject,'3'=>$class)); 
        $sessions = $query->getScalarResult();

             $dql = "SELECT s FROM Admin\Entity\Section s WHERE s.id=?1 ";
        $query = $this->getEntityManager()->createQuery($dql)->setParameters(array('1'=>$section, )); 
        $sects = $query->getArrayResult();
       

        $dql = "SELECT s FROM Admin\Entity\Subject s WHERE s.id=?1 ";
        $query = $this->getEntityManager()->createQuery($dql)->setParameters(array('1'=>$subject, )); 
        $subs = $query->getArrayResult();


        $dql = "SELECT s FROM Admin\Entity\Subject s ORDER BY s.id DESC ";
        $query = $this->getEntityManager()->createQuery($dql); 
        $subjects = $query->getArrayResult();

        return new ViewModel(array('sessions'=>$sessions,'subjects'=>$subjects,'sects'=>$sects,'subs'=>$subs));
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
   $query = $this->getEntityManager()->createQuery('SELECT s,g,i FROM Admin\Entity\Settings s LEFT JOIN s.grade g LEFT JOIN g.gradeSystems i with :groupId BETWEEN  i.startRange and i.endRange WHERE s.session=:session and s.section=:section'); 
   $query->setParameters(array('groupId'=>$total,'session'=>$session,'section'=>$sectionx)); 
   $settings = $query->getScalarResult();
    foreach ($settings as $setting) {
      $grad=$setting['i_id'];
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
                $newresult->setGrade($grade);
                $this->getEntityManager()->persist($newresult);

               }
      }
      
     $this->getEntityManager()->flush();
    $this->flashMessenger()->addSuccessMessage('Grade Input Added Successfully');
     return $this->redirect()->toRoute('teachers', array('controller'=>'teachers', 'action'=>'input'));


        return new ViewModel();
    }
}
