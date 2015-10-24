<?php
namespace Admin\Controller;
use DoctrineORMModule\Paginator\Adapter\DoctrinePaginator;
use Doctrine\ORM\Tools\Pagination\Paginator as ORMPaginator;
use Zend\Paginator\Paginator;
use Zend\Form\Form;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject as DoctrineHydrator;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

use Admin\Entity\Salary; 
use Admin\Form\SalaryForm; 
//use Admin\Form\SubjectupdateForm;       
//use Admin\Form\SubjectFilter;

use DoctrineORMModule\Stdlib\Hydrator\DoctrineEntity;
use Admin\Hydrator\DateHydrator;

class SalaryController extends AbstractActionController
{ 
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
           $form = new SalaryForm($entityManager);
          // $academicsessions = $entityManager->getRepository('Admin\Entity\Academicsession')->findBy(array(), array('session' => 'ASC'));
      $query = $this
                ->getEntityManager()
                ->getRepository('Admin\Entity\Salary')
                ->createQueryBuilder('a');
        $salarys = new Paginator(
                new DoctrinePaginator(new ORMPaginator($query))
        );
        $salarys
                ->setCurrentPageNumber($this->params()->fromQuery('page', 1))
                ->setItemCountPerPage(5);
       
        return new ViewModel (array(
            'salarys' => $salarys,
            'form' =>$form,
        ));
    }
     

      

   public function addAction() {
        $objectManager = $this->getEntityManager();
        
        $form = new SalaryForm($objectManager);
        $salary = new \Admin\Entity\Salary();
        $form->bind($salary);
        
        $request = $this->getRequest();
        if ($request->isPost()) {

            $data = $request->getPost();

              $sal=$this->getEntityManager()->getRepository('Admin\Entity\Salary')->findOneBy(array('level'=>$data['level'], 'step'=>$data['step']));
            



         $form->setData($request->getPost());
        
         if ($form->isValid()) {


               if(isset($sal)){
                    $this->flashMessenger()->addErrorMessage('This salary defination already exist!');
                      // Redirect to List of section
                      return $this->redirect()->toRoute('salary', array('controller'=>'salary', 'action'=>'index'));                     
                  }
                  else {
                        
                         $this->flashMessenger()->addSuccessMessage('Salary defination added successfully!');
                          $objectManager->persist($salary);
                           $objectManager->flush();
                           //
                           return $this->redirect()->toRoute('salary', array('controller' => 'salary', 'action' => 'index'));
                  }

            }
        }
        return new ViewModel(
            array('form' => $form)
        );
    }

   public function deleteAction()
   {$id = $this->params()->fromRoute('id');
    if (!$id) return $this->redirect()->toRoute('salary', array('controller' => 'salary', 'action' => 'index'));
    
    $entityManager = $this->getEntityManager();
    
        try {
      $repository = $entityManager->getRepository('Admin\Entity\Salary');
      $salary = $repository->find($id);
      $entityManager->remove($salary);
      $entityManager->flush();
      $this->flashMessenger()->addSuccessMessage('Salary Defination Deleted Successfully!');
    //   $this->flashMessenger()->addSuccessMessage('Post Saved');
        }
        catch (\Exception $ex) {
      $this->redirect()->toRoute('salary', array('controller' => 'salary', 'action' => 'index'));  
        }
    
    return $this->redirect()->toRoute('salary', array('controller' => 'salary', 'action' => 'index')); 
   }

     public function editAction()
    { $entityManager = $this->getEntityManager();
       $viewmodel = new ViewModel();
        $id = (int) $this->params()->fromRoute('id', 0);
        if (!$id) {
            return $this->redirect()->toRoute('salary', array('controller'=>'salary','action' => 'index'));
        }

        $salary = $entityManager->find('Admin\Entity\Salary', $id);
        if (!$salary) {
             return $this->redirect()->toRoute('salary', array('controller'=>'salary', 'action'=>'index')); 
           
        }

        $form = new SalaryForm($entityManager);
        $form->bind($salary);
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
              
               $entityManager->persist($salary);
                $entityManager->flush();

                // Redirect to list of albums
                return $this->redirect()->toRoute('salary', array('controller'=>'salary', 'action'=>'index')); 
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
        
}