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

//use Zfcuser\Entity\User;
use EduUser\Entity\User;
use Admin\Entity\Staff;
use Admin\Entity\Session;
use Admin\Entity\StaffAdmin;
use Admin\Entity\StaffHistory;
//use Admin\Entity\Person;
use Zend\Validator\File\Size;
use Zend\View\Model\JsonModel;
use Admin\Form\StaffForm;
use Admin\Form\StaffupdateForm;
use Zend\Crypt\Password\Bcrypt;

use Doctrine\ORM\Query\Expr;

class StaffController extends AbstractActionController
{
     public function dashboardAction(){
        return new viewmodel();
       }
    public function indexAction()
    {
        /* @var $entityManager \Doctrine\ORM\EntityManager */
        $entityManager =$this->getServiceLocator()->get('doctrine.entitymanager.orm_default');
        //$personRepo = $entityManager->getRepository('ZfcDatagridExamples\Entity\Person');
        
        $dql = "SELECT s, l, y, t FROM Admin\Entity\Staff s   LEFT JOIN s.clevel l LEFT JOIN s.year y LEFT JOIN s.stafftype t ";
        $query = $entityManager->createQuery($dql); 
        $staffs = $query->getScalarResult();
       // var_dump($bugs);
        // Test if the SqLite is ready...
      /*   $dql = "SELECT a FROM Admin\Entity\Lga a WHERE a.state IN (:ids)";
        $query = $entityManager->createQuery($dql)
            ->setParameter(':ids', $ids);
        $results = $query->getResult(\Doctrine\ORM\AbstractQuery::HYDRATE_ARRAY);
        
        $qb = $entityManager->createQueryBuilder();
        $qb->select('p');
        $qb->from('Admin\Entity\Person', 'p');
        */
        return new ViewModel(array('staffs'=>$staffs));
       
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

                          //get role id and store in user table
                  $role=$entityManager->getRepository('EduUser\Entity\Role')->findOneBy(array('roleId'=>'parent'));
                  $user= new User();
                  $user->setUsername($pre->getStaffNo());
                  $user->setDisplayName($pre->getFname().' '.$pre->getLname().' '.$pre->getMname());
                  $user->setEmail($pre->getStaffNo().'@brainfield.com');
                  $user->setPassword($this->getPassword());
                  $user->addRole($role);
                  $user->setState(1);
                  
                   $entityManager->persist($user);
                   $entityManager->flush();
                   $staff->setUser($user);
                  
                 
                  
                  $entityManager->persist($staff);
                  $entityManager->persist($staffHistory);
        
                  $entityManager->flush();
                  return $this->redirect()->toRoute('staff', array('controller' => 'staff', 'action' => 'index'));
                }
            }
            

          return new ViewModel(array( 'form' => $form));
      }
            public function getPassword(){

        $newPass = 'edusoft321';

        $bcrypt = new Bcrypt;
        $bcrypt->setCost(14);

        $pass = $bcrypt->create($newPass);
       return $pass;
      }

          public function smsAction()
    {  return new ViewModel(array( 'form' => $form));
          
      }



     public function editAction()
    {  $entityManager= $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');
       $viewmodel = new ViewModel();
        $id = (int) $this->params()->fromRoute('id', 0);
        if (!$id) {
            return $this->redirect()->toRoute('staff', array('controller'=>'staff','action' => 'add'));
        }

        $staff= $entityManager->find('Admin\Entity\Staff', $id);
        if (!$staff) {
             return $this->redirect()->toRoute('staff', array('controller'=>'staff', 'action'=>'index')); 
           
        }

        $form = new StaffupdateForm($entityManager);
        
        
       // $form->setHydrator (new DoctrineEntity($entityManager,'Admin\Entity\Subject'));
        $form->bind($staff);
        //ar_dump($form);
        
        $form->get('submit')->setAttribute('value', 'Edit');

        $request = $this->getRequest();
        if ($request->isPost()) {
           $dataForm = array_merge_recursive(
                $request->getPost()->toArray(),
                $request->getFiles()->toArray()
            );
         $form->setData($dataForm);
           
         if ($form->isValid()) {
            $pre=$form->getData('staff');
                 $staff->setClevel($pre->getLevel());
                  $staff->setCstep($pre->getStep());
                 
 
                $qb =$entityManager->createQueryBuilder();
                $q = $qb->update('Admin\Entity\StaffHistory', 's')
                        ->set('s.step', '?1')
                        ->set('s.year', '?2')
                        ->set('s.level', '?3')
                        ->where('s.staff = ?4')
                        ->setParameter(1, $pre->getStep())
                        ->setParameter(2, $pre->getYear())
                        ->setParameter(3, $pre->getLevel())
                        ->setParameter(4, $id)
                        ->getQuery();
                $p = $q->execute();



            $entityManager->persist($staff);
            $entityManager->flush();
            //

                // Redirect to list of albums
                return $this->redirect()->toRoute('staff', array('controller'=>'staff', 'action'=>'index')); 
           }

            
}
      
          $viewmodel->setVariables(array(
                    'form' => $form,
                    'id' =>$id,
                    
        ));
        
        return $viewmodel;
    }
        
    
   

    public function lgaAction()
    {   $entityManager = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');
        
        $ids = $_POST['state'];
       // $statename=$entityManager->getRepository('Admin\Entity\State')->findOneBy(array('name' => $state));
        //$jh=$state->getName();
        


        $dql = "SELECT a FROM Admin\Entity\Lga a WHERE a.state IN (:ids)";
        $query = $entityManager->createQuery($dql)
            ->setParameter(':ids', $ids);
        $results = $query->getResult(\Doctrine\ORM\AbstractQuery::HYDRATE_ARRAY);       
    
         
         return new JsonModel($results);
    }

  

    public function viewfullAction()
    {   $entityManager = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');
    
        $id = (int) $this->params()->fromRoute('id', 0);
       // var_dump($id)
        if (!$id) {
            return $this->redirect()->toRoute('staff', array('controller'=>'staff','action' => 'index'));
        }

        $staff = $entityManager->getRepository('Admin\Entity\Staff')->findOneBy(array('id' => $id));
        if (!$staff) {
             return $this->redirect()->toRoute('staff', array('controller'=>'staff', 'action'=>'index')); 
           
        }
        return new ViewModel( array('staff'=>$staff));
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
      $this->redirect()->toRoute('staff', array('controller' => 'staff', 'action' => 'index'));  
        }
    
    return $this->redirect()->toRoute('staff', array('controller' => 'staff', 'action' => 'index')); 
   }

   public function generatepdfAction()
   {  $entityManager = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');
    
        $id = (int) $this->params()->fromRoute('id', 0);
       // var_dump($id)
        if (!$id) {
            return $this->redirect()->toRoute('staff', array('controller'=>'staff','action' => 'index'));
        }

        $staff = $entityManager->getRepository('Admin\Entity\Staff')->findOneBy(array('id' => $id));
        if (!$staff) {
             return $this->redirect()->toRoute('staff', array('controller'=>'staff', 'action'=>'index')); 
           
        }
         $viewRenderer = $this->serviceLocator->get('view_manager')->getRenderer();
           $view = new ViewModel(array('staff'=>$staff));
          $view->setTemplate('Admin/Staff/viewfull'); 
          // path to phtml file under view folder
          $view->setTerminal(true);



        $htmlOutput = $viewRenderer->render($view);

        $output = $this->serviceLocator->get('mvlabssnappy.pdf.service')->getOutputFromHtml($htmlOutput);

        $response = $this->getResponse();
        $headers  = $response->getHeaders();
        $headers->addHeaderLine('Content-Type', 'application/pdf');
        $headers->addHeaderLine('Content-Disposition', "attachment; filename=\"export-" . $now->format('d-m-Y H:i:s') . ".pdf\"");

        $response->setContent($output);

        return $response;
   }

}
