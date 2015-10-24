<?php
/**
 * Edusoft (http://www.edusoft.com.ng/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2014 Mibs Technologies Inc. (http://www.Mibstechnologies.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Admin\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

//use Zfcuser\Entity\User;
use Admin\Entity\Student;
use Admin\Entity\Session;
use Admin\Entity\StudentHistory;
use EduUser\Entity\User;
//use Admin\Entity\Person;
use Zend\Validator\File\Size;
use Zend\View\Model\JsonModel;
use Admin\Form\StudentForm;
use Zend\Crypt\Password\Bcrypt;

use Doctrine\ORM\Query\Expr;

class StudentController extends AbstractActionController
{
       /**
        */
       public function dashboardAction(){
        return new viewmodel();
       }
    public function indexAction()
    {
        /* @var $entityManager \Doctrine\ORM\EntityManager */
        $entityManager =$this->getServiceLocator()->get('doctrine.entitymanager.orm_default');
        //$personRepo = $entityManager->getRepository('ZfcDatagridExamples\Entity\Person');
        
        $dql = "SELECT s, p, g, c, d FROM Admin\Entity\Student s JOIN s.person p JOIN p.guardian g JOIN s.currentclass c JOIN s.section d ORDER BY s.class DESC ";
        $query = $entityManager->createQuery($dql); 
        $students = $query->getScalarResult();
       // var_dump($bugs);
        // Test if the SqLite is ready...
      /*   $dql = "SELECT a FROM Admin\Entity\Lga a WHERE a.state IN (:ids)";
        $query = $entityManager->createQuery($dql)
            ->setParameter(':ids', $ids);
        $results = $query->getResult(\Doctrine\ORM\AbstractQuery::HYDRATE_ARRAY);
        
        $qb = $entityManager->createQueryBuilder();
        $qb->select('p');
        $qb->from('Admin\Entity\Person', 'p');
        */
        return new ViewModel(array('students'=>$students));
       
    }
        

    public function addAction()
    { $entityManager = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');
                  
        	
           $form = new StudentForm($entityManager);
           $person = new Student(); 
           $studentHistory = new StudentHistory($entityManager);
           $form->bind($person); 
        	 $request = $this->getRequest();
        	  
            if ($request->isPost()) {
             
                      
           $dataForm = array_merge_recursive(
                $request->getPost()->toArray(),
                $request->getFiles()->toArray()
            );

            //set data post and file ...
            $form->get('student')->get('status')->setValue('Active'); 
           // var_dump($form);   
            $form->setData($dataForm);

             //var_dump($form);
            if ($form->isValid()) {
                  $pre=$form->getData('student');
                  $pern=$form->getData('student')->getPerson();
             //var_dump($pern);die;
                  $person->setStatus('Active');
                  $person->setCurrentclass($pre->getClass());
                  $studentHistory->setStudent($pre);
                  $studentHistory->setYear($pre->getYear());
                  $studentHistory->setClass($pre->getClass());
                 // $person->setStatus(1);
                  //get role id and store in user table
                  $role=$entityManager->getRepository('EduUser\Entity\Role')->findOneBy(array('roleId'=>'student'));
                  $user= new User();
                  $user->setUsername($pre->getAdmNo());
                  $user->setDisplayName($pern->getFname());
                  $user->setEmail($pre->getAdmNo().'@brainfield.com');
                  $user->setPassword($this->getPassword());
                  $user->addRole($role);
                  $user->setState(1);
                  
                  $entityManager->persist($user);
                   $entityManager->flush();
                   $person->setUser($user);
                  
                  $entityManager->persist($person);
                  $entityManager->persist($studentHistory);
        
                  $entityManager->flush();
                  return $this->redirect()->toRoute('student', array('controller' => 'student', 'action' => 'index'));
                }
            }
            

        	return new ViewModel(array( 'form' => $form));
      }

      public function getPassword(){

        $newPass = 'edusoft321';

        $bcrypt = new Bcrypt;
        $bcrypt->setCost(14);

        $pass = $bcrypt->create($newPass);
       return $pass;
      }

          public function editttAction()
    { $entityManager = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');

                 
           $form = new StudentForm($entityManager);
           $person = new Student(); 
                 $form->bind($person); 
           $request = $this->getRequest();
            
            if ($request->isPost()) {
            
                      
           $dataForm = array_merge_recursive(
                $request->getPost()->toArray(),
                $request->getFiles()->toArray()
            );
             $form->setValidationGroup(array(
                   'student'=>array('year','term','section','admNo','admDate'),
                   
              ));
            //set data post and file ...    
            $form->setData($dataForm);

             
            if ($form->isValid()) {
                //var_dump($form->getData());
                
                  $entityManager->persist($person);
                
                  $entityManager->flush();
                  return $this->redirect()->toRoute('student', array('controller' => 'student', 'action' => 'index'));
                }
            }
            

          return new ViewModel(array( 'form' => $form, ));
      }



     public function editAction()
    {  $entityManager= $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');
       $viewmodel = new ViewModel();
        $id = (int) $this->params()->fromRoute('id', 0);
        if (!$id) {
            return $this->redirect()->toRoute('student', array('controller'=>'student','action' => 'add'));
        }

        $student = $entityManager->find('Admin\Entity\Student', $id);
        if (!$student) {
             return $this->redirect()->toRoute('student', array('controller'=>'student', 'action'=>'index')); 
           
        }

        $form = new StudentForm($entityManager);
        
        
       // $form->setHydrator (new DoctrineEntity($entityManager,'Admin\Entity\Subject'));
        $form->bind($student);
        
        $form->get('submit')->setAttribute('value', 'Edit');

        $request = $this->getRequest();
        if ($request->isPost()) {
           $dataForm = array_merge_recursive(
                $request->getPost()->toArray(),
                $request->getFiles()->toArray()
            );
         $form->setData($dataForm);
           
         if ($form->isValid()) {
            $pre=$form->getData('student');
            $student->setCurrentclass($pre->getClass());
            $entityManager->persist($student);
            $entityManager->flush();
            //

                // Redirect to list of albums
                return $this->redirect()->toRoute('student', array('controller'=>'student', 'action'=>'index')); 
           }

            
}
      
          $viewmodel->setVariables(array(
                    'form' => $form,
                    'id' =>$id,
                    
        ));
        
        return $viewmodel;
    }
      	
    
   

    public function lgaAction()
    {   $entityManager = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');
        
        $ids = $_POST['state'];
       // $statename=$entityManager->getRepository('Admin\Entity\State')->findOneBy(array('name' => $state));
        //$jh=$state->getName();
        


        $dql = "SELECT a FROM Admin\Entity\Lga a WHERE a.state IN (:ids)";
        $query = $entityManager->createQuery($dql)
            ->setParameter(':ids', $ids);
        $results = $query->getResult(\Doctrine\ORM\AbstractQuery::HYDRATE_ARRAY);       
    
         
         return new JsonModel($results);
    }

     public function grideAction()
    {
        /* @var $entityManager \Doctrine\ORM\EntityManager */
        $entityManager =$this->getServiceLocator()->get('doctrine.entitymanager.orm_default');
        //$personRepo = $entityManager->getRepository('ZfcDatagridExamples\Entity\Person');
        
        $dql = "SELECT s, p, g, c FROM Admin\Entity\Student s JOIN s.person p JOIN p.guardian g JOIN s.class c ORDER BY s.class DESC ";
        $query = $entityManager->createQuery($dql); 
        $bugs = $query->getResult(\Doctrine\ORM\AbstractQuery::HYDRATE_ARRAY);
       // var_dump($bugs);
        // Test if the SqLite is ready...
      /*   $dql = "SELECT a FROM Admin\Entity\Lga a WHERE a.state IN (:ids)";
        $query = $entityManager->createQuery($dql)
            ->setParameter(':ids', $ids);
        $results = $query->getResult(\Doctrine\ORM\AbstractQuery::HYDRATE_ARRAY);
        
        $qb = $entityManager->createQueryBuilder();
        $qb->select('p');
        $qb->from('Admin\Entity\Person', 'p');
        */
         return new JsonModel($bugs);
       
    }

    public function viewfullAction()
    {   $entityManager = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');
    
        $id = (int) $this->params()->fromRoute('id', 0);
       // var_dump($id)
        if (!$id) {
            return $this->redirect()->toRoute('student', array('controller'=>'student','action' => 'index'));
        }

        $student = $entityManager->getRepository('Admin\Entity\StudentHistory')->findOneBy(array('student' => $id));
        if (!$student) {
             return $this->redirect()->toRoute('student', array('controller'=>'student', 'action'=>'index')); 
           
        }
        return new ViewModel( array('student'=>$student));
    }

    public function deleteAction()
   {$id = $this->params()->fromRoute('id');
    if (!$id) return $this->redirect()->toRoute('student', array('controller' => 'student', 'action' => 'index'));
    
    $entityManager =$this->getServiceLocator()->get('doctrine.entitymanager.orm_default');
    
        try {
      $studentre = $entityManager->getRepository('Admin\Entity\Student');
      $student = $studentre->find($id);
      $pid=$student->getPerson();
      $personre = $entityManager->getRepository('Admin\Entity\Person');
      $person = $personre->find($pid);
      $entityManager->remove($student);
      $entityManager->remove($person);
      $entityManager->flush();
      $this->flashMessenger()->addSuccessMessage('Student Delete Successfully!');
    //   $this->flashMessenger()->addSuccessMessage('Post Saved');
        }
        catch (\Exception $ex) {
      $this->redirect()->toRoute('student', array('controller' => 'student', 'action' => 'index'));  
        }
    
    return $this->redirect()->toRoute('student', array('controller' => 'student', 'action' => 'index')); 
   }

}
