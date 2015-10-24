<?php
namespace Admin\Controller;
use DoctrineORMModule\Paginator\Adapter\DoctrinePaginator;
use Doctrine\ORM\Tools\Pagination\Paginator as ORMPaginator;
use Zend\Paginator\Paginator;
use Zend\Form\Form;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject as DoctrineHydrator;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\ServiceManager\ServiceManager;

use Admin\Entity\Session; 
use Admin\Form\FormMasterForm; 
use Admin\Form\FormMaster;       
//use Admin\Form\SubjectFilter;

use DoctrineORMModule\Stdlib\Hydrator\DoctrineEntity;
use Admin\Hydrator\DateHydrator;

class FormmasterController extends AbstractActionController
{ protected $sm;
  protected $em;
   
    public function getEntityManager()
    {
        if (null === $this->em) {
            $this->em = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');
        }
        return $this->em;
    }

   public function indexAction()
   {  
       
           $entityManager =$this->getEntityManager();
           $form = new FormMasterForm($entityManager);
          // $academicsessions = $entityManager->getRepository('Admin\Entity\Academicsession')->findBy(array(), array('session' => 'ASC'));
      $query = $this
                ->getEntityManager()
                ->getRepository('Admin\Entity\FormMaster')
                ->createQueryBuilder('a');
        $masters = new Paginator(
                new DoctrinePaginator(new ORMPaginator($query))
        );
        $masters
                ->setCurrentPageNumber($this->params()->fromQuery('page', 1))
                ->setItemCountPerPage(5);
       
        return new ViewModel(array(
            'masters' => $masters,
            'form' =>$form,
        ));
    }

      

   public function addAction() {
        $objectManager = $this->getEntityManager();
        
        $form = new FormMasterForm($objectManager);
        $master = new \Admin\Entity\FormMaster();
        $form->bind($master);
        
        $request = $this->getRequest();
        if ($request->isPost()) {
         
          $data = $request->getPost();
          
        
         $sal=$this->getEntityManager()->getRepository('Admin\Entity\FormMaster')->findOneBy(array('year'=>$data['formmaster']['year'], 'class'=>$data['formmaster']['class']));
        
         ($form->setData($request->getPost()));
        
         if ($form->isValid()) {
                         if(isset($sal)){
                    $this->flashMessenger()->addErrorMessage('Form-Master for this class already exist!');
                      // Redirect to List of section
                      return $this->redirect()->toRoute('formmaster', array('controller'=>'formmaster', 'action'=>'index'));                     
                  }
                  else {
                        
                         $this->flashMessenger()->addSuccessMessage('Form-Master added successfully!');
                          $objectManager->persist($master);
                           $objectManager->flush();
                           //
                           return $this->redirect()->toRoute('formmaster', array('controller' => 'formmaster', 'action' => 'index'));
                  }
         }
        }
        return new ViewModel(
            array('form' => $form)
        );
    }

   public function deleteAction()
   {$id = $this->params()->fromRoute('id');
    if (!$id) return $this->redirect()->toRoute('formmaster', array('controller' => 'formmaster', 'action' => 'index'));
    
    $entityManager = $this->getEntityManager();
    
        try {
      $repository = $entityManager->getRepository('Admin\Entity\FormMaster');
      $master = $repository->find($id);
      $entityManager->remove($master);
      $entityManager->flush();
      $this->flashMessenger()->addSuccessMessage('FormMaster Deleted Successfully!');
    //   $this->flashMessenger()->addSuccessMessage('Post Saved');
        }
        catch (\Exception $ex) {
      $this->redirect()->toRoute('formmaster', array('controller' => 'formmaster', 'action' => 'index'));  
        }
    
    return $this->redirect()->toRoute('formmaster', array('controller' => 'formmaster', 'action' => 'index')); 
   }

     public function editAction()
    {  $entityManager = $this->getEntityManager();
       $viewmodel = new ViewModel();
        $id = (int) $this->params()->fromRoute('id', 0);
        if (!$id) {
            return $this->redirect()->toRoute('formmaster', array('controller'=>'formmaster','action' => 'index'));
        }

        $master = $entityManager->find('Admin\Entity\FormMaster', $id);
        if (!$master) {
             return $this->redirect()->toRoute('formmaster', array('controller'=>'formmaster', 'action'=>'index')); 
           
        }

        $form = new FormMasterForm($entityManager);
        
        
       // $form->setHydrator (new DoctrineEntity($entityManager,'Admin\Entity\Subject'));
        $form->bind($master);
        $form->get('submit')->setAttribute('value', 'Edit');

        $request = $this->getRequest();
        if ($request->isPost()) {
         // $form->setValidationGroup('category');
         $form->setData($request->getPost());
        
         if ($form->isValid()) {
            $entityManager->persist($master);
            $entityManager->flush();
            //
    

                // Redirect to list of albums
                return $this->redirect()->toRoute('formmaster', array('controller'=>'formmaster', 'action'=>'index')); 
           }
        }

      
          $viewmodel->setVariables(array(
                    'form' => $form,
                    'id' =>$id,
                    
        ));
        
        return $viewmodel;
    }

        
}