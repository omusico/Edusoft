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


use Admin\Entity\GradeSetup; 
use Admin\Entity\GradeFormat;       
use Admin\Entity\GradeSystem;

use Admin\Form\GradeSetupForm; 
use Admin\Form\GradeFormatForm; 
use Admin\Form\GradeSystemForm;        

use DoctrineORMModule\Stdlib\Hydrator\DoctrineEntity;

use Zend\View\Model\JsonModel;



class GradeController extends AbstractActionController
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
          $em = $this->getEntityManager();
         //Classes  Forms
           $form = new GradeFormatForm($em);
           

          //List of Gradesetups   
          $formats=$em->getRepository('Admin\Entity\GradeFormat')->findAll();
         
  

           //Return Variables to view model   
           return new ViewModel(array (
            'formats' => $formats,
            'form' =>$form,
            ));

      }

         public function gradesAction()
      {
         $em = $this->getEntityManager();
         //get the section id from the link of section name in index set as id
          $id = $this->params()->fromRoute('id'); 
         
         $grades=$em->getRepository('Admin\Entity\GradeSystem')->findBy(array('gradeFormat' =>$id));
          //Return Variables to view model   
           return new ViewModel(array (
            'id'=>$id,
            'grades'=>$grades
            ));
        
      }




 

        public function gradeformatAction()
    {    
       $entityManager = $this->getEntityManager();
    
       $form = new GradeFormatForm($entityManager);    
       $gradeformat = new GradeFormat();

       $form->bind($gradeformat);      
        $request = $this->getRequest();

         if ($request->isPost()) {
            $data = $request->getPost();
                    
              $form->setData($request->getPost());            

            if ($form->isValid()) {
                
                      $this->flashMessenger()->addSuccessMessage('Grade format entered successfully!');
                      $entityManager->persist($gradeformat);
                      $entityManager->flush();
                        // Redirect to List of section
                return $this->redirect()->toRoute('grade', array('controller'=>'grade', 'action'=>'index'));
                
              }
          }
            return new ViewModel(array ('form' =>$form,));
      }




           public function addgradesAction()
    {  $entityManager = $this->getEntityManager();
       $viewmodel = new ViewModel();
        $id = (int) $this->params()->fromRoute('id', 0);
        if (!$id) {
            return $this->redirect()->toRoute('grade', array('controller'=>'grade','action' => 'index'));
        }

        $gradeformat = $entityManager->find('Admin\Entity\GradeFormat', $id);
        if (!$gradeformat) {
             return $this->redirect()->toRoute('grade', array('controller'=>'grade', 'action'=>'index')); 
           
        }

        $form = new GradeSystemForm($entityManager);
        $form->bind($gradeformat);

        $request = $this->getRequest();
      

        if ($request->isPost()) {
           // $formsession->setInputFilter(new SessionFilter($this->getServiceLocator()));
            $form->setData($request->getPost());
            $form->setValidationGroup(array(
                    'gradesystem'=>array(
                      'gradeSystems'=>array(
                        'grade',
                        'startRange',
                        'endRange',
                        'description'))
                   ));

           if ($form->isValid()) {
              
               $entityManager->persist($gradeformat);
                $entityManager->flush();

                // Redirect to list of albums
                return $this->redirect()->toRoute('grade', array('controller'=>'grade', 'action'=>'index')); 
           }
        }

      
          $viewmodel->setVariables(array(
                    'form' => $form,
                    'id' =>$id,));
        
        return $viewmodel;
    }


                

     
       public function editgradeformatAction()
        {  $entityManager = $this->getEntityManager();
           $viewmodel = new ViewModel();
            $id = (int) $this->params()->fromRoute('id', 0);
            if (!$id) {
                return $this->redirect()->toRoute('grade', array('controller'=>'grade','action' => 'index'));
            }

            $gradeformat = $entityManager->find('Admin\Entity\GradeFormat', $id);
            if (!$gradeformat) {
                 return $this->redirect()->toRoute('grade', array('controller'=>'grade', 'action'=>'index')); 
               
            }

            $formgradeformat = new GradeSystemForm($entityManager);
            //$formfeesetup->setHydrator (new DateHydrator($entityManager,'Admin\Entity\FeeSetup'));
            $formgradeformat->bind($gradeformat);
            $formgradeformat->get('submit')->setAttribute('value', 'Edit');

            $request = $this->getRequest();
             //disable layout if request by Ajax
            $viewmodel->setTerminal($request->isXmlHttpRequest());
            
            $is_xmlhttprequest = 1;
            if ( ! $request->isXmlHttpRequest()){
                //if NOT using Ajax
                $is_xmlhttprequest = 0;

            if ($request->isPost()) {
               // $formsession->setInputFilter(new SessionFilter($this->getServiceLocator()));
                $formgradeformat->setData($request->getPost());
                $formgradeformat->setValidationGroup(array(
                    'gradesystem'=>array(
                      'description',
                      'gradeSystems'=>array(
                        'grade',
                        'startRange',
                        'endRange',
                        'description'))
                   ));

              if ($formgradeformat->isValid()) {
                  
                  //  $entityManager->persist($academicsession);
                    $entityManager->flush();

                    // Redirect to list of albums
                    return $this->redirect()->toRoute('grade', array('controller'=>'grade', 'action'=>'index')); 
               }
            }

           } 
              $viewmodel->setVariables(array(
                        'formgradeformat' => $formgradeformat,
                        'id' =>$id,
                        'is_xmlhttprequest' => $is_xmlhttprequest //need for check this form is in modal dialog or not in view
            ));
            
            return $viewmodel;
       }


 

        public function deletegradeformatAction()
         {   $id = $this->params()->fromRoute('id');
            if (!$id) return $this->redirect()->toRoute('grade', array('controller' => 'grade', 'action' => 'index'));
            
            $entityManager = $this->getEntityManager();
         
                try {
                   //$setupre = $entityManager->getRepository('Admin\Entity\FeeSetup');
                    $setup = $entityManager->getRepository('Admin\Entity\GradeFormat')->findOneBy(array('id' => $id));
                    $entityManager->remove($setup);
                    $entityManager->flush();
                    $this->flashMessenger()->addSuccessMessage('Grade format Deleted Successfully!');
                  //   $this->flashMessenger()->addSuccessMessage('Post Saved');
                    
                    }
                  catch (\Exception $ex) {
                $this->redirect()->toRoute('grade', array('controller' => 'grade', 'action' => 'index'));  
                  }
                   return $this->redirect()->toRoute('grade', array('controller' => 'grade', 'action' => 'index')); 
           }


  

       
}