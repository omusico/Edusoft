<?php
namespace Admin\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

use Admin\Entity\Year; 
use Admin\Form\YearForm;       
use Admin\Form\YearFilter;

use Admin\Entity\Term; 
use Admin\Form\TermForm;       
use Admin\Form\TermFilter;

use Admin\Entity\Session; 
use Admin\Form\SessionForm;       
use Admin\Form\SessionFilter;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject as DoctrineHydrator;

use DoctrineORMModule\Stdlib\Hydrator\DoctrineEntity;

 
class YearController extends AbstractActionController
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
       
         //list of sessions
          
           $entityManager = $this->getEntityManager();
           $formterm = new TermForm($entityManager);
           $formacademicsession = new SessionForm($entityManager);
           $form = new YearForm();


                     
           // return $this->redirect()->toRoute('admin/default', array('controller'=>'session', 'action'=>'index'));
         

         $em = $this->getEntityManager();
          $terms=$em->getRepository('Admin\Entity\Term')->findAll();
          $years=$em->getRepository('Admin\Entity\Year')->findAll();
         // $academicsession=$em->getRepository('Admin\Entity\Academicsession')->findAll();
     
    

       
           return new ViewModel(array (
            'years' => $years,
            'terms'=>$terms,
            //'academicsession' => $academicsession,
            'form' =>$form,
            'formterm'=>$formterm,
            //'formacademicsession' =>$formacademicsession,
            ));

      }

    public function addyearAction()
    {


    $entityManager = $this->getEntityManager();
     $form = new YearForm();
     $form->setHydrator (new DoctrineEntity($entityManager,'Admin\Entity\Year'));
     $year = new year();

     $form->bind($year);      
      
        $request = $this->getRequest();
         if ($request->isPost()) {
            $form->setInputFilter(new YearFilter($this->getServiceLocator()));
            $form->setData($request->getPost());

            if ($form->isValid()) {
                $entityManager->persist($year);
                $entityManager->flush();

                // Redirect to list of albums
                return $this->redirect()->toRoute('year', array('controller'=>'year', 'action'=>'index'));
            }
        }
        return new ViewModel(
            array('form' => $form)
        );
        
    }

    public function addtermAction()
    { 
      $objectManager = $this->getEntityManager();
        
        $formterm = new TermForm($objectManager);
        $term = new Term();
        $formterm->bind($term);
        
        $request = $this->getRequest();
        if ($request->isPost()) {
          $formterm->setInputFilter(new TermFilter($this->getServiceLocator()));
         $formterm->setData($request->getPost());
        
         if ($formterm->isValid()) {
            $objectManager->persist($term);
            $objectManager->flush();
            //
            return $this->redirect()->toRoute('year', array('controller' => 'year', 'action' => 'index'));
         }
        }
        return new ViewModel(
            array('formterm' => $formterm)
        );
        
    }

     public function deletetermAction()
   {$id = $this->params()->fromRoute('id');
    if (!$id) return $this->redirect()->toRoute('year', array('controller' => 'year', 'action' => 'index'));
    
    $entityManager = $this->getEntityManager();
    
        try {
      $repository = $entityManager->getRepository('Admin\Entity\Term');
      $term = $repository->find($id);
      $entityManager->remove($term);
      $entityManager->flush();
      $this->flashMessenger()->addSuccessMessage('Term Delete Successfully!');
    //   $this->flashMessenger()->addSuccessMessage('Post Saved');
        }
        catch (\Exception $ex) {
      $this->redirect()->toRoute('year', array('controller' => 'year', 'action' => 'index'));  
        }
    
    return $this->redirect()->toRoute('year', array('controller' => 'year', 'action' => 'index')); 
   }

       public function deleteAction()
   {$id = $this->params()->fromRoute('id');
    if (!$id) return $this->redirect()->toRoute('year', array('controller' => 'year', 'action' => 'index'));
    
    $entityManager = $this->getEntityManager();
    
        try {
      $repository = $entityManager->getRepository('Admin\Entity\Year');
      $year = $repository->find($id);
      $entityManager->remove($year);
      $entityManager->flush();
      $this->flashMessenger()->addSuccessMessage('Year Delete Successfully!');
    //   $this->flashMessenger()->addSuccessMessage('Post Saved');
        }
        catch (\Exception $ex) {
      $this->redirect()->toRoute('year', array('controller' => 'year', 'action' => 'index'));  
        }
    
    return $this->redirect()->toRoute('year', array('controller' => 'year', 'action' => 'index')); 
   }

     public function edityearAction()
    { 

       $entityManager = $this->getEntityManager();
       $viewmodel = new ViewModel();
        $id = (int) $this->params()->fromRoute('id', 0);
        if (!$id) {
            return $this->redirect()->toRoute('year', array('controller'=>'year','action' => 'index'));
        }

        $year = $entityManager->find('Admin\Entity\Year', $id);
        if (!$year) {
             return $this->redirect()->toRoute('year', array('controller'=>'year', 'action'=>'index')); 
           
        }
         $form = new YearForm($entityManager);
         $form->bind($year);

        

        $request = $this->getRequest();
         //disable layout if request by Ajax
        $viewmodel->setTerminal($request->isXmlHttpRequest());
        
        $is_xmlhttprequest = 1;
        if ( ! $request->isXmlHttpRequest()){
            //if NOT using Ajax
            $is_xmlhttprequest = 0;

        if ($request->isPost()) {
           // $formacademicsession->setInputFilter(new SessionFilter($this->getServiceLocator()));
            $form->setData($request->getPost());

           if ($form->isValid()) {
              
              //  $entityManager->persist($academicsession);
                $entityManager->flush();

                // Redirect to list of albums
                return $this->redirect()->toRoute('year', array('controller'=>'year', 'action'=>'index')); 
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


    public function edittermAction()
    { 
        $entityManager = $this->getEntityManager();
       $viewmodel = new ViewModel();
          $id = (int)$this->getEvent()->getRouteMatch()->getParam('id');
        if (!$id) {
          return $this->redirect()->toRoute('year', array('controller' => 'year', 'action' => 'index'));
        }

        $term = $entityManager->find('Admin\Entity\Term', $id);
        if (!$term) {
             return $this->redirect()->toRoute('year', array('controller'=>'year', 'action'=>'index')); 
           
        }



        $formterm = new TermForm($entityManager);
        $formterm->bind($term);

        $request = $this->getRequest();
         //disable layout if request by Ajax
        $viewmodel->setTerminal($request->isXmlHttpRequest());
        
        $is_xmlhttprequest = 1;
        if ( ! $request->isXmlHttpRequest()){
            //if NOT using Ajax
            $is_xmlhttprequest = 0;

        if ($request->isPost()) {
           // $formacademicsession->setInputFilter(new SessionFilter($this->getServiceLocator()));
            $formterm->setData($request->getPost());

           if ($formterm->isValid()) {
              
              //  $entityManager->persist($academicsession);
                $entityManager->flush();

                // Redirect to list of albums
                return $this->redirect()->toRoute('year', array('controller'=>'year', 'action'=>'index')); 
           }
        }

       } 
          $viewmodel->setVariables(array(
                    'formterm' => $formterm,
                    'id' =>$id,
                    'is_xmlhttprequest' => $is_xmlhttprequest //need for check this form is in modal dialog or not in view
        ));
        
        return $viewmodel;
    }
   
}