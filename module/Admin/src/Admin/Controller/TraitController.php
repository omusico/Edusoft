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


use Admin\Entity\TraitSetup; 
use Admin\Entity\TraitFormat;       
use Admin\Entity\TraitSystem;
use Admin\Entity\TraitName;
use Admin\Entity\Traits;

use Admin\Form\TraitSetupForm; 
use Admin\Form\TraitFormatForm;
use Admin\Form\TraitNameForm;        

use DoctrineORMModule\Stdlib\Hydrator\DoctrineEntity;

use Zend\View\Model\JsonModel;



class TraitController extends AbstractActionController
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
         $form = new TraitFormatForm($em);
          //find all the totals of a given section
         $formats=$em->getRepository('Admin\Entity\TraitFormat')->findAll();
          //Return Variables to view model   
           return new ViewModel(array (
            'formats'=>$formats,
            'form'=>$form
            ));

      }


         public function traitsAction()
      {
         $em = $this->getEntityManager();
         //get the section id from the link of section name in index set as id
          $id = $this->params()->fromRoute('id'); 
         
         $traits=$em->getRepository('Admin\Entity\TraitName')->findBy(array('traitFormat' =>$id));
          //Return Variables to view model   
           return new ViewModel(array (
            'id'=>$id,
            'traits'=>$traits
            ));
        
      }


         public function itemsAction()
      {
         $em = $this->getEntityManager();
         //get the section id from the link of section name in index set as id
          $id = $this->params()->fromRoute('id'); 
         
         $items=$em->getRepository('Admin\Entity\Traits')->findBy(array('traitName' =>$id));
          //Return Variables to view model   
           return new ViewModel(array (
            'id'=>$id,
            'items'=>$items
            ));
        
      }


        public function addformatAction()
    {    
       $entityManager = $this->getEntityManager();
       
       $form = new TraitFormatForm($entityManager);    
       $traitformat = new TraitFormat();

       $form->bind($traitformat);      
        $request = $this->getRequest();

         if ($request->isPost()) {
            $data = $request->getPost();
                    
              $form->setData($request->getPost());            

            if ($form->isValid()) {
                
                      $this->flashMessenger()->addSuccessMessage('Trait format entered successfully!');
                      $entityManager->persist($traitformat);
                      $entityManager->flush();
                        // Redirect to List of section
                return $this->redirect()->toRoute('trait', array('controller'=>'trait', 'action'=>'index'));
                
              }
          }
            return new ViewModel(array ('form' =>$form));
      }



      public function editformatAction()
        {  $entityManager = $this->getEntityManager();
           $viewmodel = new ViewModel();
            $id = (int) $this->params()->fromRoute('id', 0);
            if (!$id) {
                return $this->redirect()->toRoute('trait', array('controller'=>'trait','action' => 'index'));
            }

            $traitformat = $entityManager->find('Admin\Entity\TraitFormat', $id);
            if (!$traitformat) {
                 return $this->redirect()->toRoute('trait', array('controller'=>'trait', 'action'=>'index')); 
               
            }

            $form = new TraitFormatForm($entityManager);
            //$formfeesetup->setHydrator (new DateHydrator($entityManager,'Admin\Entity\FeeSetup'));
            $form->bind($traitformat);
            $form->get('submit')->setAttribute('value', 'Edit');

            $request = $this->getRequest();
        

            if ($request->isPost()) {
               // $formsession->setInputFilter(new SessionFilter($this->getServiceLocator()));
                $form->setData($request->getPost());
                $form->setValidationGroup(array('description'));
               if ($form->isValid()) {
                  
                    $entityManager->persist($traitformat);
                    $entityManager->flush();

                    // Redirect to list of albums
                    return $this->redirect()->toRoute('trait', array('controller'=>'trait', 'action'=>'index')); 
               }
            }

              $viewmodel->setVariables(array(
                        'form' => $form,
                        'id' =>$id,
                     
            ));
            
            return $viewmodel;
       }


           public function addtraitAction()
    {  $entityManager = $this->getEntityManager();
       $viewmodel = new ViewModel();
        $id = (int) $this->params()->fromRoute('id', 0);
        if (!$id) {
            return $this->redirect()->toRoute('trait', array('controller'=>'trait','action' => 'index'));
        }

         $traitformat = $entityManager->find('Admin\Entity\TraitFormat', $id);
        $traitname = new TraitName();
        $form = new TraitNameForm($entityManager);
        $form->bind($traitname);

        $request = $this->getRequest();
      

        if ($request->isPost()) {
           
            $form->setData($request->getPost());
            $form->setValidationGroup(array(
                    'traitname'=>array(
                      'name',
                      'description'
                      )
                   ));

           if ($form->isValid()) {
               $this->flashMessenger()->addSuccessMessage('Trait entered successfully!');
                $traitname->setTraitFormat($traitformat);
              
               $entityManager->persist($traitname);
                $entityManager->flush();

                return $this->redirect()->toRoute('trait', array('controller'=>'trait', 'action'=>'index')); 
           }
        }

      
          $viewmodel->setVariables(array(
                    'form' => $form,
                    'id' =>$id,));
        
        return $viewmodel;
    }

          public function edittraitAction()
    {  $entityManager = $this->getEntityManager();
       $viewmodel = new ViewModel();
        $id = (int) $this->params()->fromRoute('id', 0);
        if (!$id) {
            return $this->redirect()->toRoute('trait', array('controller'=>'trait','action' => 'index'));
        }

         $trait = $entityManager->find('Admin\Entity\TraitName', $id);
        
        $form = new TraitNameForm($entityManager);
        $form->bind($trait);

        $request = $this->getRequest();
      

        if ($request->isPost()) {
           
            $form->setData($request->getPost());
            $form->setValidationGroup(array(
                    'traitname'=>array(
                      'description'
                      )
                   ));

           if ($form->isValid()) {
               $this->flashMessenger()->addSuccessMessage('Trait updated successfully!');
                             
               $entityManager->persist($trait);
                $entityManager->flush();

                return $this->redirect()->toRoute('trait', array('controller'=>'trait', 'action'=>'index')); 
           }
        }

      
          $viewmodel->setVariables(array(
                    'form' => $form,
                    'id' =>$id,));
        
        return $viewmodel;
    }

    public function additemsAction()
    {  $entityManager = $this->getEntityManager();
       $viewmodel = new ViewModel();
        $id = (int) $this->params()->fromRoute('id', 0);
        if (!$id) {
            return $this->redirect()->toRoute('trait', array('controller'=>'trait','action' => 'index'));
        }

        $traitname = $entityManager->find('Admin\Entity\TraitName', $id);
        if (!$traitname) {
             return $this->redirect()->toRoute('trait', array('controller'=>'trait', 'action'=>'index')); 
           
        }
        /*
        $form = new TraitNameForm($entityManager);
        $form->bind($traitname);
        */

      // $request = $this->getRequest();
      
        if ($this->getRequest()->isPost()) {
            $name= $_POST['name'];
            $remark= $_POST['remark'];
            
            foreach( $name as $key => $n ) {
                      $trait = new Traits();
                      $trait->setName($n);
                      $trait->setRemark($remark[$key]);
                      $trait->setTraitName($traitname);
                      $entityManager->persist($trait);
                      $entityManager->flush();
                     }
                // Redirect to list of albums
                return $this->redirect()->toRoute('trait', array('controller'=>'trait', 'action'=>'index')); 
          
        }

          $viewmodel->setVariables(array(
                      'id' =>$id,));
        
        return $viewmodel;
      }

      public function edititemsAction()
    {  $entityManager = $this->getEntityManager();
       $viewmodel = new ViewModel();
        $id = (int) $this->params()->fromRoute('id', 0);
        if (!$id) {
            return $this->redirect()->toRoute('trait', array('controller'=>'trait','action' => 'index'));
        }

        $traitname = $entityManager->find('Admin\Entity\TraitName', $id);
        if (!$traitname) {
             return $this->redirect()->toRoute('trait', array('controller'=>'trait', 'action'=>'index')); 
           
        }
        /*
        $form = new TraitNameForm($entityManager);
        $form->bind($traitname);
        */

      $traits = $entityManager->getRepository('Admin\Entity\Traits')->findBy(array('traitName'=>$id));
      
        if ($this->getRequest()->isPost()) {
               foreach ($traits as $de) {
                $entityManager->remove($de);
               }

            $name= $_POST['name'];
            $remark= $_POST['remark'];
            
            foreach( $name as $key => $n ) {
                      $trait = new Traits();
                      $trait->setName($n);
                      $trait->setRemark($remark[$key]);
                      $trait->setTraitName($traitname);
                      $entityManager->persist($trait);
                      $entityManager->flush();
                     }
                // Redirect to list of albums
                return $this->redirect()->toRoute('trait', array('controller'=>'trait', 'action'=>'index')); 
          
        }

          $viewmodel->setVariables(array(
                      'id' =>$id,'traits'=>$traits));
        
        return $viewmodel;
      }


              public function deleteformatAction()
     {   $id = $this->params()->fromRoute('id');
        if (!$id) return $this->redirect()->toRoute('trait', array('controller' => 'trait', 'action' => 'index'));
        
        $entityManager = $this->getEntityManager();
     
            try {
               //$setupre = $entityManager->getRepository('Admin\Entity\FeeSetup');
                $setup = $entityManager->getRepository('Admin\Entity\TraitFormat')->findOneBy(array('id' => $id));
                $entityManager->remove($setup);
                $entityManager->flush();
                $this->flashMessenger()->addSuccessMessage('Trait Format Deleted Successfully!');
              //   $this->flashMessenger()->addSuccessMessage('Post Saved');
                
                }
              catch (\Exception $ex) {
            $this->redirect()->toRoute('trait', array('controller' => 'trait', 'action' => 'index'));  
              }
               return $this->redirect()->toRoute('trait', array('controller' => 'trait', 'action' => 'index')); 
       }




          public function deletetraitAction()
     {   $id = $this->params()->fromRoute('id');
        if (!$id) return $this->redirect()->toRoute('trait', array('controller' => 'trait', 'action' => 'index'));
        
        $entityManager = $this->getEntityManager();
     
            try {
               //$setupre = $entityManager->getRepository('Admin\Entity\FeeSetup');
                $setup = $entityManager->getRepository('Admin\Entity\TraitName')->findOneBy(array('id' => $id));
                $entityManager->remove($setup);
                $entityManager->flush();
                $this->flashMessenger()->addSuccessMessage('Traits Deleted Successfully!');
              //   $this->flashMessenger()->addSuccessMessage('Post Saved');
                
                }
              catch (\Exception $ex) {
            $this->redirect()->toRoute('trait', array('controller' => 'trait', 'action' => 'index'));  
              }
               return $this->redirect()->toRoute('trait', array('controller' => 'trait', 'action' => 'index')); 
       }


  

       
}