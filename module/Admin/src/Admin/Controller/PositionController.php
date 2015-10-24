<?php
namespace Admin\Controller;


use DoctrineModule\Stdlib\Hydrator\DoctrineObject as DoctrineHydrator;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

use Admin\Entity\StudentPosition;
use Admin\Entity\StaffPosition;
use Admin\Entity\Position;  
use Admin\Form\StudentPositionForm; 
use Admin\Form\StaffPositionForm; 
use Admin\Form\PositionForm; 


use Admin\Service\SettingsService;   

use DoctrineORMModule\Stdlib\Hydrator\DoctrineEntity;
use Doctrine\ORM\EntityManager;

class PositionController extends AbstractActionController
{ 
   /**
     *
     * @var SettingsService
     */
    private $settingsService;

    /**
     * @var EntityManager
     */
    private $entityManager;


   public function indexAction()
   {  
      $positions=$this->getEntityManager()->getRepository('Admin\Entity\Position')->findAll();
       
        return new ViewModel (array('positions' =>$positions));
    }
    public function studentAction()
   {  $year=$this->getSettingsService()->getCurrentYear()->getId();
     $entityManager=$this->getEntityManager();
       $dql = "SELECT s,st,p,c,y,po,sec FROM Admin\Entity\StudentPosition s LEFT JOIN s.year y LEFT JOIN s.position po LEFT JOIN s.student st LEFT JOIN st.person p LEFT JOIN st.currentclass c LEFT JOIN s.section sec  WHERE y.id=?1";
        $query = $entityManager->createQuery($dql)->setParameter(1,$year); 
        $students = $query->getScalarResult();
      //  var_dump($students);die;
        return new ViewModel (array('students' =>$students));
    }

     public function staffAction()
     {  
      $year=$this->getSettingsService()->getCurrentYear()->getId();
     $entityManager=$this->getEntityManager();
       $dql = "SELECT s,st,y,po,sec FROM Admin\Entity\StaffPosition s LEFT JOIN s.year y LEFT JOIN s.position po LEFT JOIN s.staff st  LEFT JOIN s.section sec WHERE y.id=?1";
        $query = $entityManager->createQuery($dql)->setParameter(1,$year); 
        $staffs = $query->getScalarResult();
        return new ViewModel (array('staffs' =>$staffs));
    }
       public function addAction() 
   {
        $objectManager = $this->getEntityManager();
        
        $form = new PositionForm($objectManager);
        $Position = new Position();
        $form->bind($Position);
        
        $request = $this->getRequest();
        
        if ($request->isPost()) {
            $data = $request->getPost(); 
            $form->setData($data);
        
         if ($form->isValid()) {
              $this->flashMessenger()->addSuccessMessage('Position added successfully!');
              $objectManager->persist($Position);
              $objectManager->flush();
              return $this->redirect()->toRoute('position', array('controller' => 'position', 'action' => 'index'));
                }
            }
        return new ViewModel(array('form' => $form));
    }
     
        public function editAction()
    { $entityManager = $this->getEntityManager();
       $viewmodel = new ViewModel();
        $id = (int) $this->params()->fromRoute('id', 0);
        if (!$id) {
            return $this->redirect()->toRoute('position', array('controller'=>'position','action' => 'index'));
        }

        $position = $entityManager->find('Admin\Entity\Position', $id);
        if (!$position) {
             return $this->redirect()->toRoute('position', array('controller'=>'position', 'action'=>'index')); 
        }
        $form = new PositionForm($entityManager);
        $form->bind($position);
        $form->get('submit')->setAttribute('value', 'Edit');

        $request = $this->getRequest();
        if ($request->isPost()) {
            $form->setData($request->getPost());
           if ($form->isValid()) {
               $entityManager->persist($position);
               $entityManager->flush();
              $this->flashMessenger()->addSuccessMessage('Position edited Successfully!');
               return $this->redirect()->toRoute('position', array('controller'=>'position', 'action'=>'index')); 
           }
        }
          $viewmodel->setVariables(array('form' => $form,'id' =>$id, ));
          return $viewmodel;
      }

          public function deleteAction()
   {$id = $this->params()->fromRoute('id');
    if (!$id) return $this->redirect()->toRoute('position', array('controller' => 'position', 'action' => 'index'));
    
    $entityManager = $this->getEntityManager();
    
        try {
      $repository = $entityManager->getRepository('Admin\Entity\Position');
      $position = $repository->find($id);
      $entityManager->remove($position);
      $entityManager->flush();
      $this->flashMessenger()->addSuccessMessage('Position deleted Successfully!');
    //   $this->flashMessenger()->addSuccessMessage('Post Saved');
        }
        catch (\Exception $ex) {
      $this->redirect()->toRoute('position', array('controller' => 'position', 'action' => 'index'));  
        }
    
    return $this->redirect()->toRoute('position', array('controller' => 'position', 'action' => 'index')); 
   }

   public function addstudentAction() 
   {
        $objectManager = $this->getEntityManager();

         //get current year id
            $year=$this->getSettingsService()->getCurrentYear();
        
        $form = new StudentPositionForm($objectManager);

        //$form->get('year')->setAttribute('value', $year);
        $StudentPosition = new StudentPosition();
        $form->bind($StudentPosition);
        
        $request = $this->getRequest();
        
        if ($request->isPost()) {
            $data = $request->getPost();
           
            //check if the position is vacant or not for the current year
             $student=$this->getEntityManager()->getRepository('Admin\Entity\StudentPosition')->findOneBy(array('year'=>$year->getId(),'section'=>$data['section'], 'student'=>$data['student'],'position'=>$data['position']));
            
         $form->setData($data);
        // var_dump($form);die;
        
         if ($form->isValid()) {
               if(isset($student)){
                    $this->flashMessenger()->addErrorMessage('This position has been allocated for this year!');
                      // Redirect to List of section
                      return $this->redirect()->toRoute('position', array('controller'=>'position', 'action'=>'student'));                     
                  }
                  else {
                        $StudentPosition->setYear($year);
                         $this->flashMessenger()->addSuccessMessage('Position allocated successfully!');
                          $objectManager->persist($StudentPosition);
                           $objectManager->flush();
                           //
                           return $this->redirect()->toRoute('position', array('controller' => 'position', 'action' => 'student'));
                  }

            }
        }
        return new ViewModel(array('form' => $form));
    }

      public function addstaffAction() 
   {
        $objectManager = $this->getEntityManager();
        
        $form = new StaffPositionForm($objectManager);
        $staffPosition = new StaffPosition();
        $form->bind($staffPosition);
        
        $request = $this->getRequest();
        
        if ($request->isPost()) {
            $data = $request->getPost();
            //get current year id
            $year=$this->getSettingsService()->getCurrentYear();
            //check if the position is vacant or not for the current year
             $staff=$this->getEntityManager()->getRepository('Admin\Entity\StaffPosition')->findOneBy(array('year'=>$year, 'section'=>$data['section'], 'staff'=>$data['staff'],'position'=>$data['position']));
            
         $form->setData($data);
         //$form->get('year')->setAttribute('value', $year);
        
         if ($form->isValid()) {
               if(isset($staff)){
                    $this->flashMessenger()->addErrorMessage('This position has been allocated for this year!');
                      // Redirect to List of section
                      return $this->redirect()->toRoute('position', array('controller'=>'position', 'action'=>'staff'));                     
                  }
                  else {
                        
                         $this->flashMessenger()->addSuccessMessage('Position allocated successfully!');
                         $staffPosition->setYear($year);
                          $objectManager->persist($staffPosition);
                           $objectManager->flush();
                           //
                           return $this->redirect()->toRoute('position', array('controller' => 'position', 'action' => 'staff'));
                  }

            }
        }
        return new ViewModel(array('form' => $form));
    }

   public function deletestudentAction()
   {$id = $this->params()->fromRoute('id');
    if (!$id) return $this->redirect()->toRoute('position', array('controller' => 'position', 'action' => 'student'));
    
    $entityManager = $this->getEntityManager();
    
        try {
      $repository = $entityManager->getRepository('Admin\Entity\StudentPosition');
      $salary = $repository->find($id);
      $entityManager->remove($salary);
      $entityManager->flush();
      $this->flashMessenger()->addSuccessMessage('Student remove from post Successfully!');
    //   $this->flashMessenger()->addSuccessMessage('Post Saved');
        }
        catch (\Exception $ex) {
      $this->redirect()->toRoute('position', array('controller' => 'position', 'action' => 'student'));  
        }
    
    return $this->redirect()->toRoute('position', array('controller' => 'position', 'action' => 'student')); 
   }

    public function deletestaffAction()
   {$id = $this->params()->fromRoute('id');
    if (!$id) return $this->redirect()->toRoute('position', array('controller' => 'position', 'action' => 'staff'));
    
    $entityManager = $this->getEntityManager();
    
        try {
      $repository = $entityManager->getRepository('Admin\Entity\StaffPosition');
      $salary = $repository->find($id);
      $entityManager->remove($salary);
      $entityManager->flush();
      $this->flashMessenger()->addSuccessMessage('Staff remove from post Successfully!');
    //   $this->flashMessenger()->addSuccessMessage('Post Saved');
        }
        catch (\Exception $ex) {
      $this->redirect()->toRoute('position', array('controller' => 'position', 'action' => 'staff'));  
        }
    
    return $this->redirect()->toRoute('position', array('controller' => 'position', 'action' => 'staff')); 
   }

     public function editstudentAction()
    { $entityManager = $this->getEntityManager();
       $viewmodel = new ViewModel();
        $id = (int) $this->params()->fromRoute('id', 0);
        if (!$id) {
            return $this->redirect()->toRoute('position', array('controller'=>'position','action' => 'student'));
        }

        $student = $entityManager->find('Admin\Entity\StudentPosition', $id);
        if (!$student) {
             return $this->redirect()->toRoute('position', array('controller'=>'position', 'action'=>'student')); 
        }

        $form = new StudentPositionForm($entityManager);
        $form->bind($student);
        $form->get('submit')->setAttribute('value', 'Edit');

        $request = $this->getRequest();
        if ($request->isPost()) {
            $form->setData($request->getPost());
           if ($form->isValid()) {
               $entityManager->persist($student);
               $entityManager->flush();
              $this->flashMessenger()->addSuccessMessage('Student post editted Successfully!');
               return $this->redirect()->toRoute('position', array('controller'=>'position', 'action'=>'student')); 
           }
        }
          $viewmodel->setVariables(array('form' => $form,'id' =>$id, ));
          return $viewmodel;
      }

        public function editstaffAction()

        { $entityManager = $this->getEntityManager();
           $viewmodel = new ViewModel();
            $id = (int) $this->params()->fromRoute('id', 0);
            if (!$id) {
                return $this->redirect()->toRoute('position', array('controller'=>'position','action' => 'staff'));
            }

            $staff = $entityManager->find('Admin\Entity\StaffPosition', $id);
            if (!$staff) {
                 return $this->redirect()->toRoute('position', array('controller'=>'position', 'action'=>'staff')); 
            }

            $form = new StaffPositionForm($entityManager);
            $form->bind($staff);
            $form->get('submit')->setAttribute('value', 'Edit');

            $request = $this->getRequest();
            if ($request->isPost()) {
                $form->setData($request->getPost());
               if ($form->isValid()) {
                   $entityManager->persist($staff);
                   $entityManager->flush();
                   $this->flashMessenger()->addSuccessMessage('Staff post editted Successfully!');
                   return $this->redirect()->toRoute('position', array('controller'=>'position', 'action'=>'staff')); 
               }
            }
              $viewmodel->setVariables(array('form' => $form,'id' =>$id, ));
              return $viewmodel;
          }


          /**
     * Method used to obtain EntityManager.
     *
     * @return EntityManager - entity manager object
     */
    public function getEntityManager()
    {
        return $this->entityManager;
    }

    /**
     * Method used to inject EntityManager.
     *
     * @param EntityManager $entityManager
     */
    public function setEntityManager(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }

        /**
     * Get settingsService.
     *
     * @return SettingsService
     */
    public function getSettingsService()
    {
        return $this->settingsService;
    }

    /**
     * Set settingsService.
     *
     * @param SettingsService $settingsService
     */
    public function setSettingsService(SettingsService $settingsService)
    {
        $this->settingsService = $settingsService;
    }
}
        
