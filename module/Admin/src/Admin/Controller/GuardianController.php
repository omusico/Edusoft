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

use Zfcuser\Entity\User;
use Admin\Entity\Guardian;
use Admin\Entity\Session;
use Admin\Entity\Student;
use Admin\Entity\StudentHistory;
use Admin\Entity\Person;
//use Admin\Entity\Person;
use Zend\Validator\File\Size;
use Zend\View\Model\JsonModel;
use Admin\Form\GuardianForm;
use Admin\Form\StaffupdateForm;
use Admin\Form\WardForm;

use ZfcDatagrid\Column;
use ZfcDatagrid\Column\Formatter;
use ZfcDatagrid\Column\Type;
use ZfcDatagrid\Column\Style;
use ZfcDatagrid\Filter;
use Doctrine\ORM\Query\Expr;

class GuardianController extends AbstractActionController
{   
  public function dashboardAction(){
        return new viewmodel();
       }

    public function indexAction()
    {
        /* @var $entityManager \Doctrine\ORM\EntityManager */
        $entityManager =$this->getServiceLocator()->get('doctrine.entitymanager.orm_default');
        //$personRepo = $entityManager->getRepository('ZfcDatagridExamples\Entity\Person');
        
        $dql = "SELECT g FROM Admin\Entity\Guardian g ";
        $query = $entityManager->createQuery($dql); 
        $guardians = $query->getScalarResult();
     
        return new ViewModel(array('guardians'=>$guardians));
       
    }
            

    public function addAction()
    { $entityManager = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');
                  
          
           $form = new StaffForm($entityManager);
          $staffHistory = new staffHistory();
           $staff = new Staff();  
           $form->bind($staff); 
           $request = $this->getRequest();
            
            if ($request->isPost()) {
             
                      
           $dataForm = array_merge_recursive(
                $request->getPost()->toArray(),
                $request->getFiles()->toArray()
            );

               
            $form->setData($dataForm);

             //var_dump($form);
            if ($form->isValid()) {
                  $pre=$form->getData('staff');
            //var_dump($pre);
                  $staff->setStatus('Active');
                  $staff->setClevel($pre->getLevel());
                  $staff->setCstep($pre->getStep());
                 
                  $staffHistory->setStaff($pre);
                  $staffHistory->setYear($pre->getYear());
                  $staffHistory->setLevel($pre->getLevel());
                  $staffHistory->setStep($pre->getStep());
                  
                  $entityManager->persist($staff);
                  $entityManager->persist($staffHistory);
        
                  $entityManager->flush();
                  return $this->redirect()->toRoute('staff', array('controller' => 'staff', 'action' => 'view'));
                }
            }
            

          return new ViewModel(array( 'form' => $form));
      }
      public function addwardAction()
    { $entityManager = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');
           $id = (int) $this->params()->fromRoute('id', 0);
            if (!$id) {
                return $this->redirect()->toRoute('guardian', array('controller'=>'guardian','action' => 'view'));
            }

            $guardian= $entityManager->find('Admin\Entity\Guardian', $id);
            //var_dump($guardian);
            if (!$guardian) {
                 return $this->redirect()->toRoute('guardian', array('controller'=>'guardian', 'action'=>'view')); 
               
            }

           $form = new WardForm($entityManager);
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
            //$form->get('student')->get('status')->setValue('Active'); 
          /// var_dump($form);   
            $form->setData($dataForm);

            //var_dump($form);
            if ($form->isValid()) {
                  $pre=$form->getData('student');
            // var_dump($pre);
                  $person->setStatus('Active');
                  $person->getPerson()->setGuardian($guardian);
                  $person->setCurrentclass($pre->getClass());
                  $studentHistory->setStudent($pre);
                  $studentHistory->setYear($pre->getYear());
                  $studentHistory->setClass($pre->getClass());
                 // $person->setStatus(1);
                 
                  $entityManager->persist($person);
                  $entityManager->persist($studentHistory);
        
                  $entityManager->flush();
                  return $this->redirect()->toRoute('guardian', array('controller' => 'guardian', 'action' => 'view'));
                }
            }
            

          return new ViewModel(array( 'form' => $form));
      }

          public function editAction()
    { $entityManager = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');

            $id = (int) $this->params()->fromRoute('id', 0);
            if (!$id) {
                return $this->redirect()->toRoute('guardian', array('controller'=>'guardian','action' => 'view'));
            }

            $guardian= $entityManager->find('Admin\Entity\Guardian', $id);
            if (!$guardian) {
                 return $this->redirect()->toRoute('guardian', array('controller'=>'guardian', 'action'=>'view')); 
               
            }
                 
           $form = new GuardianForm($entityManager);
           
           $form->bind($guardian); 
           $form->get('submit')->setAttribute('value', 'Edit');
           $request = $this->getRequest();
            
            if ($request->isPost()) {
            //set data post and file ...    
            $form->setData($request->getPost()); 
            if ($form->isValid()) {
               //var_dump($form->getData());
                  $entityManager->persist($guardian);
                  $entityManager->flush();
                  return $this->redirect()->toRoute('guardian', array('controller' => 'guardian', 'action' => 'view'));
                }
            }
            

          return new ViewModel(array( 'form' => $form, 'id'=>$id ));
      }



    
   

    public function wardsAction()
    {   $entityManager = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');
        $form = new WardForm($entityManager);
         $id = (int) $this->params()->fromRoute('id', 0);
            if (!$id) {
                return $this->redirect()->toRoute('guardian', array('controller'=>'guardian','action' => 'view'));
            }
           //  $dql = "SELECT s FROM Admin\Entity\Guardian s ";
           // $query = $entityManager->createQuery($dql); 
           // $bugs = $query->getScalarResult();
            
            $guardian= $entityManager->getRepository('Admin\Entity\Guardian')->findOneBy(array('id' => $id));
            $persons=$this->getPersonns($id);
            //var_dump($persons);
            if (!$persons) {
                 return $this->redirect()->toRoute('guardian', array('controller'=>'guardian', 'action'=>'view')); 
               
            }
            
              
        return new ViewModel( array('persons'=>$persons, 'form'=>$form, 'id'=>$id,'guardian'=>$guardian));
    }

    public function getPersonns($id)
    {  $entityManager = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');

      $qb = $entityManager->createQueryBuilder();
        $qb->select('s');
        $qb->from('Admin\Entity\Student', 's');
            $qb->leftJoin('s.person', 'p');
            $qb->where( 'p.guardian = :gid' );
            $qb->setParameters(array(
            'gid' => $id,
            
        ));
            
        $query = $qb->getQuery();
        return $query->getResult();
    }

    public function deleteAction()
   {$id = $this->params()->fromRoute('id');
    if (!$id) return $this->redirect()->toRoute('staff', array('controller' => 'staff', 'action' => 'add'));
    
    $entityManager =$this->getServiceLocator()->get('doctrine.entitymanager.orm_default');
    
        try {
      $staff = $entityManager->getRepository('Admin\Entity\Staff');
      $staff1 = $staff->find($id);
      $sid=$staff1->getId();
      $staffhis = $entityManager->getRepository('Admin\Entity\StaffHistory');
      $staffhistory = $staffhis->find($sid);
      $entityManager->remove($staff1);
      $entityManager->remove($staffhistory);
      $entityManager->flush();
      $this->flashMessenger()->addSuccessMessage('Student Delete Successfully!');
    //   $this->flashMessenger()->addSuccessMessage('Post Saved');
        }
        catch (\Exception $ex) {
      $this->redirect()->toRoute('staff', array('controller' => 'staff', 'action' => 'view'));  
        }
    
    return $this->redirect()->toRoute('staff', array('controller' => 'staff', 'action' => 'view')); 
   }

}
