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


use Admin\Entity\SubjectCategory; 
use Admin\Form\SubjectCategoryForm;       
use Admin\Form\SubjectCategoryFilter;

use DoctrineORMModule\Stdlib\Hydrator\DoctrineEntity;
use ZfcDatagrid\Column;



class SubjectCategoryController extends AbstractActionController
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
           $form = new SubjectCategoryForm($em);
           

          //List of Classes 
          $subcats=$em->getRepository('Admin\Entity\SubjectCategory')->findAll();
         
           //Return Variables to view model   
           return new ViewModel(array (
            'subcats' => $subcats,
            'form' =>$form
            ));

      }

  public function addAction()
    {    
     $entityManager = $this->getEntityManager();
     $form = new SubjectCategoryForm($entityManager);
     $form->setHydrator (new DoctrineEntity($entityManager,'Admin\Entity\SubjectCategory'));
    
     $subcat = new SubjectCategory();

     $form->bind($subcat);      
      $request = $this->getRequest();

         if ($request->isPost()) {
             
              $data = $request->getPost();
           
             // $formclasses->setInputFilter(new ClassesFilter($this->getServiceLocator()));
              $form->setData($request->getPost());            

            if ($form->isValid()) {
                
                                 
                       $this->flashMessenger()->addSuccessMessage('Category added successfully!');
                      $entityManager->persist($subcat);
                      $entityManager->flush();
                        // Redirect to List of section
                              return $this->redirect()->toRoute('subjectcategory', array('controller'=>'SubjectCategory', 'action'=>'index'));
            }
        }
          return new ViewModel(array (
            'form' =>$form,
            ));
    }

   public function deleteAction()
    {   $id = $this->params()->fromRoute('id');
        if (!$id) return $this->redirect()->toRoute('SubjectCategory', array('controller' => 'SubjectCategory', 'action' => 'index'));
        
        $entityManager = $this->getEntityManager();
            try {
          $repository = $entityManager->getRepository('Admin\Entity\SubjectCategory');
          $subcat = $repository->find($id);
          $entityManager->remove($subcat);
          $entityManager->flush();
          $this->flashMessenger()->addSuccessMessage('Category Delete Successfully!');
        //   $this->flashMessenger()->addSuccessMessage('Post Saved');
            }
            catch (\Exception $ex) {
          $this->redirect()->toRoute('subjectcategory', array('controller' => 'SubjectCategory', 'action' => 'index'));  
            }
    
         return $this->redirect()->toRoute('subjectcategory', array('controller' => 'SubjectCategory', 'action' => 'index')); 
   }
}