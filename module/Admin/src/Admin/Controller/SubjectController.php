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

use Admin\Entity\Subject; 
use Admin\Form\SubjectForm; 
use Admin\Form\SubjectupdateForm;       
use Admin\Entity\Teacher;

use DoctrineORMModule\Stdlib\Hydrator\DoctrineEntity;
use Admin\Hydrator\DateHydrator;
use Zend\View\Model\JsonModel;

class SubjectController extends AbstractActionController
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
           $form = new SubjectForm($entityManager);
          // $academicsessions = $entityManager->getRepository('Admin\Entity\Academicsession')->findBy(array(), array('session' => 'ASC'));
      $subjects=$entityManager->getRepository('Admin\Entity\Subject')->findAll();
       
        return new ViewModel(array(
            'subjects' => $subjects,
            'form' =>$form,
        ));
    }
     //  return new ViewModel(array (
       //     'academicsessions' => $academicsessions,
         //   'formacademicsession' =>$formacademicsession,
           // ));

      

   public function addAction() {
        $objectManager = $this->getEntityManager();
        
        $form = new SubjectForm($objectManager);
        $subject = new \Admin\Entity\Subject();
        $form->bind($subject);
        
        $request = $this->getRequest();
        if ($request->isPost()) {
         $form->setData($request->getPost());
        
         if ($form->isValid()) {
            $objectManager->persist($subject);
            $objectManager->flush();
            //
            return $this->redirect()->toRoute('subject', array('controller' => 'subject', 'action' => 'index'));
         }
        }
        return new ViewModel(
            array('form' => $form)
        );
    }

   public function deleteAction()
   {$id = $this->params()->fromRoute('id');
    if (!$id) return $this->redirect()->toRoute('subject', array('controller' => 'subject', 'action' => 'index'));
    
    $entityManager = $this->getEntityManager();
    
        try {
      $repository = $entityManager->getRepository('Admin\Entity\Subject');
      $subject = $repository->find($id);
      $entityManager->remove($subject);
      $entityManager->flush();
      $this->flashMessenger()->addSuccessMessage('Subject Deleted Successfully!');
    //   $this->flashMessenger()->addSuccessMessage('Post Saved');
        }
        catch (\Exception $ex) {
      $this->redirect()->toRoute('subject', array('controller' => 'subject', 'action' => 'index'));  
        }
    
    return $this->redirect()->toRoute('subject', array('controller' => 'subject', 'action' => 'index')); 
   }

     public function editAction()
    {  $entityManager = $this->getEntityManager();
       $viewmodel = new ViewModel();
        $id = (int) $this->params()->fromRoute('id', 0);
        if (!$id) {
            return $this->redirect()->toRoute('subject', array('controller'=>'subject','action' => 'index'));
        }

        $subject = $entityManager->find('Admin\Entity\Subject', $id);
        if (!$subject) {
             return $this->redirect()->toRoute('subject', array('controller'=>'subject', 'action'=>'index')); 
           
        }

        $form = new SubjectupdateForm($entityManager);
        
        
       // $form->setHydrator (new DoctrineEntity($entityManager,'Admin\Entity\Subject'));
        $form->bind($subject);
        $form->get('submit')->setAttribute('value', 'Edit');

        $request = $this->getRequest();
        if ($request->isPost()) {
         // $form->setValidationGroup('category');
         $form->setData($request->getPost());
        
         if ($form->isValid()) {
            $entityManager->persist($subject);
            $entityManager->flush();
            //
    

                // Redirect to list of albums
                return $this->redirect()->toRoute('subject', array('controller'=>'subject', 'action'=>'index')); 
           }
        }

      
          $viewmodel->setVariables(array(
                    'form' => $form,
                    'id' =>$id,
                    
        ));
        
        return $viewmodel;
    }

    public function addteacherAction()
    {


        // var_dump($subs);die;

        $dql = "SELECT s FROM Admin\Entity\Staff s ORDER BY s.id DESC ";
        $query = $this->getEntityManager()->createQuery($dql); 
        $teachers = $query->getArrayResult();
        //var_dump($teachers);die;

        $dql = "SELECT s FROM Admin\Entity\Subject s ORDER BY s.id DESC ";
        $query = $this->getEntityManager()->createQuery($dql); 
        $subjects = $query->getArrayResult();

        $dql = "SELECT s FROM Admin\Entity\Section s ORDER BY s.id DESC ";
        $query = $this->getEntityManager()->createQuery($dql); 
        $sections = $query->getArrayResult();

         $dql = "SELECT c, s FROM Admin\Entity\Classes c LEFT JOIN c.section s ORDER BY s.id ASC ";
        $query = $this->getEntityManager()->createQuery($dql); 
        $classs = $query->getScalarResult();
       // var_dump($classs);die;

        return new viewmodel(array('classs'=>$classs,'sections'=>$sections, 'subjects'=>$subjects,'teachers'=>$teachers));



    }

       public function processAction()
  {  $sefssion=$this->getEntityManager()->getRepository('Admin\Entity\Session')->findOneBy(array(), array('id' => 'DESC'));
     $session=$sefssion->getId();

  //var_dump(expression)

    //$post =$this->getRequest()->getPost()->toArray();
    $teacher = $_POST['teacher'];
    $subject = $_POST['subject'];
    $class = $_POST['class'];
    
    
    //var_dump($teacher);die;
    foreach( $teacher as $key => $n ) {
      $staff=$this->getEntityManager()->getRepository('Admin\Entity\Staff')->findOneBy(array('id'=>$n));
      $sub=$this->getEntityManager()->getRepository('Admin\Entity\Subject')->findOneBy(array('id'=>$subject[$key]));
      $cla=$this->getEntityManager()->getRepository('Admin\Entity\Classes')->findOneBy(array('id'=>$class[$key]));
    
      $teacher=$this->getEntityManager()->getRepository('Admin\Entity\Teacher')->findOneBy(array('staff'=>$n,'session'=>$session,'subject'=>$subject[$key],'class'=>$class[$key]));
         if(isset($teacher))
            { $teacher->setStaff($staff);
              $teacher->setSession($sefssion);
              $teacher->setSubject($sub);
              $teacher->setClass($cla);
              $this->getEntityManager()->persist($teacher);
            }
            else{
                $teacher= new Teacher();
                $teacher->setStaff($staff);
                $teacher->setSession($sefssion);
                $teacher->setSubject($sub);
                $teacher->setClass($cla);
                $this->getEntityManager()->persist($teacher);
               }
      }
      
     $this->getEntityManager()->flush();
     return $this->redirect()->toRoute('subject', array('controller'=>'subject', 'action'=>'teachers'));


    return new ViewModel();
  }

     public function teachersAction()
  {    

        $dql = "SELECT t,s,sb,c,se,y,te FROM Admin\Entity\Teacher t LEFT JOIN t.staff s LEFT JOIN t.subject sb LEFT JOIN t.class c LEFT JOIN t.session se LEFT JOIN se.year y  LEFT JOIN se.term te ORDER BY se.id DESC";
        $query = $this->getEntityManager()->createQuery($dql); 
        $teachers = $query->getScalarResult();

  

    return new ViewModel(array('teachers'=>$teachers,));
  }
        
}