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

use Admin\Entity\Section; 
use Admin\Form\SectionForm; 
use Admin\Form\SectionaddForm;
use Admin\Form\UpdateForm;       
use Admin\Form\SectionFilter;

use Admin\Entity\Classes; 
use Admin\Form\ClassesForm;       
use Admin\Form\ClassesFilter;

use DoctrineORMModule\Stdlib\Hydrator\DoctrineEntity;




class SectionController extends AbstractActionController 
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
         // Section Forms
           $form = new SectionForm($em);       

          //List of Section
          $sections=$em->getRepository('Admin\Entity\Section')->findAll();
           
           //Return Variables to view model   
           return new ViewModel(array (
            'sections'=>$sections,
            'form'=>$form
            ));

      }

    public function addAction()
    {
     $entityManager = $this->getEntityManager();
     $form = new SectionaddForm($entityManager);
     $form->setHydrator (new DoctrineEntity($entityManager,'Admin\Entity\Section'));
     $section = new Section();

     $form->bind($section);      
      $request = $this->getRequest();

        $request = $this->getRequest();
         if ($request->isPost()) {
            $form->setInputFilter(new SectionFilter($this->getServiceLocator()));
            $form->setData($request->getPost());

            if ($form->isValid()) {
              $entityManager->persist($section);
              $entityManager->flush();

                // Redirect to List of section
                return $this->redirect()->toRoute('section', array('controller'=>'section', 'action'=>'index'));
            }
        }
         return new ViewModel(array(
                    'form' => $form
                   // 'id' =>$id,
                   // 'is_xmlhttprequest' => $is_xmlhttprequest //need for check this form is in modal dialog or not in view
        ));
        
        return $viewmodel;
        
    }

     public function editAction()
    {
       $entityManager = $this->getEntityManager();
       $viewmodel = new ViewModel();
        $id = (int) $this->params()->fromRoute('id', 0);
        if (!$id) {
            return $this->redirect()->toRoute('section', array('controller'=>'section','action' => 'index'));
        }

        $section = $entityManager->find('Admin\Entity\Section', $id);
        if (!$section) {
             return $this->redirect()->toRoute('section', array('controller'=>'section', 'action'=>'index')); 
           
        }

        $form = new SectionaddForm($entityManager);
        $form->setHydrator (new DoctrineEntity($entityManager,'Admin\Entity\Section'));
        $form->bind($section);
        $form->get('submit')->setAttribute('value', 'Edit');

        $request = $this->getRequest();
         //disable layout if request by Ajax
        $viewmodel->setTerminal($request->isXmlHttpRequest());
        
        $is_xmlhttprequest = 1;
        if ( ! $request->isXmlHttpRequest()){
            //if NOT using Ajax
            $is_xmlhttprequest = 0;

        if ($request->isPost()) {
           // $formsection->setInputFilter(new ClassesFilter($this->getServiceLocator()));
            $form->setData($request->getPost());

           if ($form->isValid()) {
              
               $entityManager->persist($section);
                $entityManager->flush();

                // Redirect to list of albums
                return $this->redirect()->toRoute('section', array('controller'=>'section', 'action'=>'index')); 
           }
        }

       } 
          $viewmodel->setVariables(array(
                    'form' => $form,
                    'id' =>$id,
                    'is_xmlhttprequest' => $is_xmlhttprequest //need for check this form is in modal dialog or not in view
        ));
        
        return $viewmodel;
        
    }

    

     public function deleteAction()
    {   $id = $this->params()->fromRoute('id');
        if (!$id) return $this->redirect()->toRoute('admin/default', array('controller' => 'section', 'action' => 'index'));
        
            try {
          $section =$this->getEntityManager()->find('Admin\Entity\Section', $id);;
          $this->getEntityManager()->remove($section);
          $this->getEntityManager()->flush();
          $this->flashMessenger()->addSuccessMessage('Section Deleted Successfully!');
        //   $this->flashMessenger()->addSuccessMessage('Post Saved');
            }
            catch (\Exception $ex) {
          $this->redirect()->toRoute('section', array('controller' => 'section', 'action' => 'index'));  
            }
    
         return $this->redirect()->toRoute('section', array('controller' => 'section', 'action' => 'index')); 
   }

    

   public function editsectionAction()
    {  $id = (int)$this->getEvent()->getRouteMatch()->getParam('id');
        if (!$id) {
          return $this->redirect()->toRoute('section', array('controller' => 'section', 'action' => 'addsection'));
        }
        
        // Get your ObjectManager
        $objectManager = $this->getEntityManager();
        
        // Create the form and inject the ObjectManager
        $form = new UpdateForm($objectManager);
        
        //Get Entity by ID & bind to the form
        $section = $objectManager->find('Admin\Entity\Section', $id);
        $form->bind($section);
        

        //Manage Associations here because couldn't find a way in fieldsets
        //Get Element 'categories'
        $element = $form->getBaseFieldset()->get('subject'); //Object of: DoctrineModule\\Form\\Element\\ObjectMultiCheckbox
        
        //Setup intial Associated_Categories
        $entity_links = $objectManager->getRepository('Admin\Entity\SubjectSectionAssociation')->findBy(array('section' => $section));
        $startingIDs = array();
        foreach($entity_links as $link){
            $subId = $link->getSubject()->getId();
            array_push($startingIDs, $subId);
        }
        $element->setValue($startingIDs);
        
        //Submit Button Pressed
        $request = $this->getRequest();
        if ($request->isPost()) {
          $form->setData($request->getPost());
            
          if ($form->isValid()) {
              //random test: $form->bindOnValidate();
              
              //TODO: finish managing assocaitions
              $eValue = $element->getValue();

              $removeList = array_diff($startingIDs, $eValue);
              $addList = array_diff($eValue, $startingIDs);
              
              foreach($removeList as $removeId){
                  foreach($entity_links as $link){
                    $sub = $link->getSubject();
                    if($sub->getId() == $removeId){
                        $section->removeSubjectSectionAssociations($link);
                        $objectManager->remove($link);
                    }
                  }
                  
                  
              }
              foreach($addList as $addId){
                    $subject = $objectManager->find('Admin\Entity\Subject', $addId);
                  $section->addSubject($subject);
              }
              
            // Save the changes
            $objectManager->flush();
            return $this->redirect()->toRoute('section',
                array('controller' => 'section')
            );
          }
        }
        
        return array(
            'id' => $id,
            'form' => $form);

       } 
       


   public function addblessAction() {
        
     // Get your ObjectManager
        $objectManager = $this->getEntityManager();
        
        //Create the form and inject the ObjectManager
        //Bind the entity to the form
        $form = new UpdateForm($objectManager);
        $section = new Section();
        $form->bind($section);
        
        $request = $this->getRequest();
        if ($request->isPost()) {
          $form->setData($request->getPost());
        
          if ($form->isValid()) {
              /*
              * Get IDs from form element
              * Get categories from the IDss
              * add entities to $post's categories list
              */
              $element = $form->getBaseFieldset()->get('subject'); //Object of: DoctrineModule\\Form\\Element\\ObjectMultiCheckbox
              $values = $element->getValue();
              
                foreach($values as $subID){
                  $results = $objectManager->getRepository('Admin\Entity\Subject')->findBy(array('id' => $subID));
                  $subEntity = array_pop($results);                 
                  $link = $section->addSubject($subEntity);
                  //Entity/Post 's association table cascades persists and removes so don't need to persist($link), but would be done here
              }
              
            $objectManager->persist($section);
            $objectManager->flush();

            return $this->redirect()->toRoute('section', array('controller'=>'section', 'action'=>'index'));
          }
        }
        return array('form' => $form);
  } 
}