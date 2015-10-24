<?php
/**
 * Cloud Base Educational Management System
 *
 * @author Isaac Bitrus 
 * @copyright Copyright (c) 2015 Edusoft (http://www.edusoft.com.ng)
 */

namespace Admin\Controller;
use DoctrineORMModule\Paginator\Adapter\DoctrinePaginator;
use Doctrine\ORM\Tools\Pagination\Paginator as ORMPaginator;
use Zend\Paginator\Paginator;
use Zend\Form\Form;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject as DoctrineHydrator;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

use Admin\Entity\Session; 
use Admin\Form\SessionForm;       
use Admin\Form\SessionFilter;

use DoctrineORMModule\Stdlib\Hydrator\DoctrineEntity;
use Admin\Hydrator\DateHydrator;
use Zend\View\Model\JsonModel;

class SessionController extends AbstractActionController
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
           $formsession = new SessionForm($entityManager);
           $sessions = $entityManager->getRepository('Admin\Entity\Session')->findBy(array(), array('id' => 'DESC'));
     
      
               return new ViewModel (array(
            'sessions' => $sessions,
             'formsession' =>$formsession,
        ));
    }
     //  return new ViewModel(array (
       //     'academicsessions' => $academicsessions,
         //   'formacademicsession' =>$formacademicsession,
           // ));

      

  public function addAction()
    { 
          $entityManager = $this->getEntityManager();
           $formsession = new SessionForm($entityManager);
           $formsession->setHydrator (new DateHydrator($entityManager,'Admin\Entity\Session', false));
           $session = new Session();

           $formsession->bind($session);      
            

              $request = $this->getRequest();
               if ($request->isPost()) {
                  $data = $request->getPost();
                  $y1=$data['year'];
                  $t1=$data['term'];

                  $ytx = $entityManager->getRepository('Admin\Entity\Session')->findOneBy(array('year' => $y1, 'term' => $t1));


                  $formsession->setInputFilter(new SessionFilter($this->getServiceLocator()));
                  $formsession->setData($request->getPost());

                  if ($formsession->isValid()) {
                   // var_dump($formsession);
                    if(isset($ytx)) {
                      $this->flashMessenger()->addErrorMessage('Academic Session Already Exist!');
                        
                          // Redirect to List of section
                      return $this->redirect()->toRoute('academic', array('controller'=>'session', 'action'=>'index'));
                       }
                      else {
                          $entityManager->persist($session);
                         $entityManager->flush();
                          $this->flashMessenger()->addSuccessMessage('Academic Session Added!');
                         return $this->redirect()->toRoute('academic', array('controller'=>'session', 'action'=>'index'));
                      }
                     
                  }
              }
          return new ViewModel(array (
            'formsession' =>$formsession,
            ));
    }

   public function deleteAction()
   {$id = $this->params()->fromRoute('id');
    if (!$id) return $this->redirect()->toRoute('academic', array('controller' => 'session', 'action' => 'index'));
    
    $entityManager = $this->getEntityManager();
    
        try {
      $repository = $entityManager->getRepository('Admin\Entity\Session');
      $session = $repository->find($id);
      $entityManager->remove($session);
      $entityManager->flush();
      $this->flashMessenger()->addSuccessMessage('Academic Session Delete Successfully!');
    //   $this->flashMessenger()->addSuccessMessage('Post Saved');
        }
        catch (\Exception $ex) {
      $this->redirect()->toRoute('academic', array('controller' => 'session', 'action' => 'index'));  
        }
    
    return $this->redirect()->toRoute('academic', array('controller' => 'session', 'action' => 'index')); 
   }

     public function editAction()
    {  $entityManager = $this->getEntityManager();
       $viewmodel = new ViewModel();
        $id = (int) $this->params()->fromRoute('id', 0);
        if (!$id) {
            return $this->redirect()->toRoute('academic', array('controller'=>'session','action' => 'index'));
        }

        $session = $entityManager->find('Admin\Entity\Session', $id);
        if (!$session) {
             return $this->redirect()->toRoute('academic', array('controller'=>'session', 'action'=>'index')); 
           
        }

        $formsession = new SessionForm($entityManager);
        $formsession->setHydrator (new DateHydrator($entityManager,'Admin\Entity\Session'));
        $formsession->bind($session);
        $formsession->get('submit')->setAttribute('value', 'Edit');

        $request = $this->getRequest();
         //disable layout if request by Ajax
        $viewmodel->setTerminal($request->isXmlHttpRequest());
        
        $is_xmlhttprequest = 1;
        if ( ! $request->isXmlHttpRequest()){
            //if NOT using Ajax
            $is_xmlhttprequest = 0;

        if ($request->isPost()) {
           // $formsession->setInputFilter(new SessionFilter($this->getServiceLocator()));
            $formsession->setData($request->getPost());

           if ($formsession->isValid()) {
              
              //  $entityManager->persist($academicsession);
                $entityManager->flush();

                // Redirect to list of albums
                return $this->redirect()->toRoute('academic', array('controller'=>'session', 'action'=>'index')); 
           }
        }

       } 
          $viewmodel->setVariables(array(
                    'formsession' => $formsession,
                    'id' =>$id,
                    'is_xmlhttprequest' => $is_xmlhttprequest //need for check this form is in modal dialog or not in view
        ));
        
        return $viewmodel;
    }

        
}