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


use Admin\Entity\Classes; 
use Admin\Form\ClassesForm;       
use Admin\Form\ClassesFilter;

use DoctrineORMModule\Stdlib\Hydrator\DoctrineEntity;
use ZfcDatagrid\Column;
use Zend\View\Model\JsonModel;



class ClassController extends AbstractActionController
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
           $form = new ClassesForm($em);
           

          //List of Classes 
          $classes=$em->getRepository('Admin\Entity\Classes')->findAll();
         
           //Return Variables to view model   
           return new ViewModel(array (
            'classes' => $classes,
            'form' =>$form
            ));

      }

  public function addAction()
    {    
     $entityManager = $this->getEntityManager();
     $form = new ClassesForm($entityManager);
     $form->setHydrator (new DoctrineEntity($entityManager,'Admin\Entity\Classes'));
    
     $classes = new Classes();

     $form->bind($classes);      
      $request = $this->getRequest();

         if ($request->isPost()) {
             
              $data = $request->getPost();

             // var_dump($data);die;
                //  $initial = $data['initial'];
                 // $arm = $data['arm'];
                 // $section = $data['section'];


              $class=$this->getEntityManager()->getRepository('Admin\Entity\Classes')->findOneBy(array('initial'=>$data['initial'], 'arm'=>$data['arm'], 'section'=>$data['section']));
             // $initial=$this->getEntityManager()->getRepository('Admin\Entity\Initial')->findOneBy(array('id'=>$data['initial']));
              $initial = $entityManager->find('Admin\Entity\Initial', $data['initial']);
              $arm = $entityManager->find('Admin\Entity\Arms', $data['arm']);
               $section = $entityManager->find('Admin\Entity\Section', $data['section']);
              

              $iname=$initial->getName();
              $cname=$arm->getName();
              $sname=$section->getShortname();
             // $formclasses->setInputFilter(new ClassesFilter($this->getServiceLocator()));
              $form->setData($request->getPost());            

            if ($form->isValid()) {
                
                  if(isset($class)){
                    $this->flashMessenger()->addErrorMessage('This class already exist!');
                      // Redirect to List of section
                      return $this->redirect()->toRoute('classes', array('controller'=>'class', 'action'=>'index'));                     
                  }
                  else {
                      $classname=$sname.' '.$iname.$cname;
                      $classes->setName($classname);
                      $this->flashMessenger()->addSuccessMessage('Class added successfully!');
                      $entityManager->persist($classes);
                      $entityManager->flush();
                        // Redirect to List of section
                              return $this->redirect()->toRoute('classes', array('controller'=>'class', 'action'=>'index'));
                      
                  }
            }
        }
          return new ViewModel(array (
            'form' =>$form,
            ));
    }

   public function deleteAction()
    {   $id = $this->params()->fromRoute('id');
        if (!$id) return $this->redirect()->toRoute('admin/default', array('controller' => 'section', 'action' => 'index'));
        
        $entityManager = $this->getEntityManager();
            try {
          $repository = $entityManager->getRepository('Admin\Entity\Classes');
          $classes = $repository->find($id);
          $entityManager->remove($classes);
          $entityManager->flush();
          $this->flashMessenger()->addSuccessMessage('Class Delete Successfully!');
        //   $this->flashMessenger()->addSuccessMessage('Post Saved');
            }
            catch (\Exception $ex) {
          $this->redirect()->toRoute('classes', array('controller' => 'class', 'action' => 'index'));  
            }
    
         return $this->redirect()->toRoute('classes', array('controller' => 'class', 'action' => 'index')); 
   }


       public function formAction()
    {   $view = new ViewModel();
      $currentyear = $this->getEntityManager()->getRepository('Admin\Entity\Session')->findOneBy(array(), array('id' => 'DESC'));
        $y1 = $currentyear->getYear()->getId();

        $dql = "SELECT s FROM Admin\Entity\Year s ORDER BY s.id DESC ";
        $query = $this->getEntityManager()->createQuery($dql); 
        $sessions = $query->getArrayResult();

        $dql = "SELECT s FROM Admin\Entity\Classes s ORDER BY s.id DESC ";
        $query = $this->getEntityManager()->createQuery($dql); 
        $sections = $query->getArrayResult();

            
          $yr='';
           if ($this->getRequest()->isPost()) {
            $yr = $this->params()->fromPost('sec');
            
            $qb=$this->getClassf($yr);

              }else{
           $qb=$this->getClassp($y1);
         }

         $view = new ViewModel();
    
    $view->setVariables(array('qb'=>$qb, 'sessions'=>$sessions, 'sessions'=>$sessions));
    
   
  
    return $view;

        //return new ViewModel( array('qb'=>$qb, 'sessions'=>$sessions, ));
    }

   
   public function getClassf($yr)
    {   $qb = $this->getEntityManager()->createQueryBuilder();
        $qb->select('s,c,y,st')
            ->from('Admin\Entity\FormMaster', 's')
            ->join('s.class', 'c')
            ->leftjoin('s.year', 'y')
            ->join('s.staff', 'st');
            $qb->where( 'y.id = :y1' );

            $qb->setParameters(array(
            'y1' => $yr,
            
        ));
      
      
       $query = $qb->getQuery();

        return $query->getArrayResult();
    }
    public function getClassp($yr)
    {   $qb = $this->getEntityManager()->createQueryBuilder();
          $qb->select('s,c,y,st')
            ->from('Admin\Entity\FormMaster', 's')
            ->join('s.class', 'c')
            ->leftjoin('s.year', 'y')
            ->join('s.staff', 'st');
            $qb->where( 'y.id = :y1' );


            $qb->setParameters(array(
            'y1' => $yr,
            
        ));
      
      
       $query = $qb->getQuery();

        return $query->getArrayResult();
    }

       public function studentAction()
    { 

           if ($this->getRequest()->isPost()) {
            $yr = $this->params()->fromPost('year');
            $cl = $this->params()->fromPost('class');
            }
         
//var_dump($this->getRequest()->isPost());

        $dql = "SELECT s FROM Admin\Entity\Year s ORDER BY s.id DESC ";
        $query = $this->getEntityManager()->createQuery($dql); 
        $sessions = $query->getArrayResult();

        $dql = "SELECT s FROM Admin\Entity\Classes s ORDER BY s.id DESC ";
        $query = $this->getEntityManager()->createQuery($dql); 
        $sections = $query->getArrayResult();

        $qb = $this->getEntityManager()->createQueryBuilder();
        $qb->select('st, s, p')
            ->from('Admin\Entity\StudentHistory', 'st')
            ->join('st.student', 's')
            ->join('s.person', 'p');
            $qb->where( 'st.year = :y1' )
            ->andWhere('st.class = :c1');
            $qb->setParameters(array('y1'=>$yr, 'c1'=>$cl));

             $students=$qb->getQuery()->getScalarResult();


          $sb = $this->getEntityManager()->createQueryBuilder();
           $sb->select('ms, ts,c,y')
            ->from('Admin\Entity\FormMaster', 'ms')
            ->join('ms.staff', 'ts')
            ->join('ms.year', 'y')
            ->join('ms.class', 'c');
            $sb->where( 'ms.year = :y1' )
            ->andWhere('ms.class = :c1');
            $sb->setParameters(array('y1'=>$yr, 'c1'=>$cl));

             $staffs=$sb->getQuery()->getScalarResult();
         //  var_dump($students);
            
     //$master = $this->getEntityManager()->getRepository('Admin\Entity\FormMaster')->findOneBy(array('year'=>$yr,'class'=>$cl,));

         //var_dump($staffs);




            

           //var_dump($students);
  $view = new ViewModel();
    
    $view->setVariables(array('staffs'=>$staffs,'sessions'=>$sessions, 'sections'=>$sections,'students'=>$students,));
    
   
  
    return $view;
    }

      public function csearchAction()
    {
        $dql = "SELECT s FROM Admin\Entity\Year s ORDER BY s.id DESC ";
        $query = $this->getEntityManager()->createQuery($dql); 
        $sessions = $query->getArrayResult();

        $dql = "SELECT s FROM Admin\Entity\Classes s ORDER BY s.id DESC ";
        $query = $this->getEntityManager()->createQuery($dql); 
        $sections = $query->getArrayResult();
      return new ViewModel(array('sessions'=>$sessions, 'sections'=>$sections,));
    }

      public function SessionAction()
    {
        
     $dql = "SELECT a FROM Admin\Entity\Session a ORDER BY a.id DESC";
            $query = $this->getEntityManager()->createQuery($dql)
                ->setParameter(':ids', $ids);
            $results = $query->getResult(\Doctrine\ORM\AbstractQuery::HYDRATE_ARRAY);       
        
             
             return new JsonModel($results);
    }

 

       
}