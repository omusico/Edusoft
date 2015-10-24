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


use Admin\Entity\CaSetup; 
use Admin\Entity\CaFormat;       
use Admin\Entity\CaSystem;

use Admin\Form\CaSetupForm; 
use Admin\Form\CaFormatForm;        

use DoctrineORMModule\Stdlib\Hydrator\DoctrineEntity;

use Zend\View\Model\JsonModel;



class AssessmentController extends AbstractActionController
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
           $form = new CaFormatForm($em);
           

          //List of Gradesetups   
          $formats=$em->getRepository('Admin\Entity\CaFormat')->findAll();
         
  

           //Return Variables to view model   
           return new ViewModel(array (
            'formats' => $formats,
            'form' =>$form,
            ));

      }


      

     

   

        public function addformatAction()
    {  $entityManager = $this->getEntityManager();
       $viewmodel = new ViewModel();
       
        $caFormat = new CaFormat();
        $form = new CaFormatForm($entityManager);
        $form->bind($caFormat);

        $request = $this->getRequest();
      

        if ($request->isPost()) {
           
            $form->setData($request->getPost());
            $form->setValidationGroup(array(
                    'caformat'=>array(
                      'name',
                      'description'
                      )
                   ));

           if ($form->isValid()) {
               $this->flashMessenger()->addSuccessMessage('Assessment format entered successfully!');
                
               $entityManager->persist($caFormat);
                $entityManager->flush();

                return $this->redirect()->toRoute('assessment', array('controller'=>'assessment', 'action'=>'index')); 
           }
        }

      
          $viewmodel->setVariables(array(
                    'form' => $form,
                   ));
        
        return $viewmodel;
    }


     public function editformatAction()
        {  $entityManager = $this->getEntityManager();
           $viewmodel = new ViewModel();
            $id = (int) $this->params()->fromRoute('id', 0);
            if (!$id) {
                return $this->redirect()->toRoute('assessment', array('controller'=>'assessment','action' => 'index'));
            }

            $caformat = $entityManager->find('Admin\Entity\CaFormat', $id);
            if (!$caformat) {
                 return $this->redirect()->toRoute('assessment', array('controller'=>'assessment', 'action'=>'index')); 
               
            }

            $form = new CaFormatForm($entityManager);
            //$formfeesetup->setHydrator (new DateHydrator($entityManager,'Admin\Entity\FeeSetup'));
            $form->bind($caformat);
            $form->get('submit')->setAttribute('value', 'Edit');

            $request = $this->getRequest();          
           

            if ($request->isPost()) {
               // $formsession->setInputFilter(new SessionFilter($this->getServiceLocator()));
                $form->setData($request->getPost());
                $form->setValidationGroup(array(
                    'caformat'=>array(
                      'description',
                     )
                   ));

              if ($form->isValid()) {
                  
                  //  $entityManager->persist($academicsession);
                    $entityManager->flush();

                    // Redirect to list of albums
                    return $this->redirect()->toRoute('assessment', array('controller'=>'assessment', 'action'=>'index')); 
               }
            }

            
              $viewmodel->setVariables(array(
                        'form' => $form,
                        'id' =>$id,
                       
            ));
            
            return $viewmodel;
       }


        public function addassessmentAction()
    {  $entityManager = $this->getEntityManager();
       $viewmodel = new ViewModel();
        $id = (int) $this->params()->fromRoute('id', 0);
        if (!$id) {
            return $this->redirect()->toRoute('assessment', array('controller'=>'assessment','action' => 'index'));
        }

        $caformat = $entityManager->find('Admin\Entity\CaFormat', $id);
        if (!$caformat) {
             return $this->redirect()->toRoute('assessment', array('controller'=>'assessment', 'action'=>'index')); 
           
        }
        /*
        $form = new CaFormatForm($entityManager);
        $form->bind($caformat);
       
        */
     // $assessments = $entityManager->getRepository('Admin\Entity\CaSystem')->findBy(array('caFormat'=>$id));
     // var_dump($assessments);die;
     // $request = $this->getRequest();
        if ($this->getRequest()->isPost()) {

            $assessName = $_POST['assessName'];
            $shortName = $_POST['shortName'];
            $percentage = $_POST['percentage'];

            foreach( $assessName as $key => $n ) {
                      $CaSystem = new CaSystem();
                      $CaSystem->setassessName($n);
                      $CaSystem->setshortName($shortName[$key]);
                      $CaSystem->setpercentage($percentage[$key]);
                      $CaSystem->setcaFormat($caformat);
                      $entityManager->persist($CaSystem);
                      $entityManager->flush();
                     }
          
                // Redirect to list of albums
                return $this->redirect()->toRoute('assessment', array('controller'=>'assessment', 'action'=>'index')); 
        }

      
          $viewmodel->setVariables(array(
                    'id' =>$id));
        
        return $viewmodel;
    }

    public function editassessmentAction()
    {  $entityManager = $this->getEntityManager();
       $viewmodel = new ViewModel();
        $id = (int) $this->params()->fromRoute('id', 0);
        if (!$id) {
            return $this->redirect()->toRoute('assessment', array('controller'=>'assessment','action' => 'index'));
        }

        $caformat = $entityManager->find('Admin\Entity\CaFormat', $id);
        if (!$caformat) {
             return $this->redirect()->toRoute('assessment', array('controller'=>'assessment', 'action'=>'index')); 
           
        }
        /*
        $form = new CaFormatForm($entityManager);
        $form->bind($caformat);
       
        */
      $assessments = $entityManager->getRepository('Admin\Entity\CaSystem')->findBy(array('caFormat'=>$id));
     // var_dump($assessments);die;
     // $request = $this->getRequest();
        if ($this->getRequest()->isPost()) {
              $del = $entityManager->getRepository('Admin\Entity\CaSystem')->findBy(array('caFormat'=>$id));
              // var_dump($del);die;for
               foreach ($del as $de) {
                $entityManager->remove($de);
               }
               
            $assessName = $_POST['assessName'];
            $shortName = $_POST['shortName'];
            $percentage = $_POST['percentage'];
           // $id = $_POST['id'];

            foreach( $assessName as $key => $n ) {
           
               //$entityManager->flush();

                      $ass = new CaSystem();
                      $ass->setassessName($n);
                      $ass->setshortName($shortName[$key]);
                      $ass->setpercentage($percentage[$key]);
                      $ass->setcaFormat($caformat);
                      $entityManager->persist($ass);
                      $entityManager->flush();

                  
                     }
          
                // Redirect to list of albums
                return $this->redirect()->toRoute('assessment', array('controller'=>'assessment', 'action'=>'index')); 
        }

      
          $viewmodel->setVariables(array(
                    'id' =>$id,'assessments'=>$assessments));
        
        return $viewmodel;
    }


       public function caAction()
      {
         $em = $this->getEntityManager();
         //get the section id from the link of section name in index set as id
          $id = $this->params()->fromRoute('id'); 
         
         $assess=$em->getRepository('Admin\Entity\CaSystem')->findBy(array('caFormat' =>$id));
          //Return Variables to view model   
           return new ViewModel(array (
            'id'=>$id,
            'assess'=>$assess
            ));
        
      }




              public function deleteformatAction()
     {   $id = $this->params()->fromRoute('id');
        if (!$id) return $this->redirect()->toRoute('assessment', array('controller' => 'assessment', 'action' => 'index'));
        
        $entityManager = $this->getEntityManager();
     
            try {
               //$setupre = $entityManager->getRepository('Admin\Entity\FeeSetup');
                $setup = $entityManager->getRepository('Admin\Entity\CaFormat')->findOneBy(array('id' => $id));
                $entityManager->remove($setup);
                $entityManager->flush();
                $this->flashMessenger()->addSuccessMessage('Assessment format Deleted Successfully!');
              //   $this->flashMessenger()->addSuccessMessage('Post Saved');
                
                }
              catch (\Exception $ex) {
            $this->redirect()->toRoute('assessment', array('controller' => 'assessment', 'action' => 'index'));  
              }
               return $this->redirect()->toRoute('assessment', array('controller' => 'assessment', 'action' => 'index')); 
       }


  

       
}