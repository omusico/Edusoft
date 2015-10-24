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


use Admin\Entity\FeeSetup; 
use Admin\Entity\FeeSection;       
use Admin\Entity\FeeTotal;
use Admin\Entity\FeeItems;

use Admin\Form\FeeSetupForm; 
use Admin\Form\FeeSectionForm;        
use Admin\Form\FeeTotalForm;

use DoctrineORMModule\Stdlib\Hydrator\DoctrineEntity;
use ZfcDatagrid\Column;
use Zend\View\Model\JsonModel;



class FeeController extends AbstractActionController
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
   //get the section id from the link of section name in index set as id
          $section = $this->params()->fromRoute('id'); 
          $year = $this->params()->fromRoute('year');     
         // var_dump($section);
          $em = $this->getEntityManager();
         //Classes  Forms
           $form = new FeeSetUpForm($em);
           

          //List of feesetups and feetotals in the table displayed  
          $feesetups=$em->getRepository('Admin\Entity\FeeSetup')->findAll();
          $feetotals=$em->getRepository('Admin\Entity\FeeTotal')->findBy(array('section' =>$section));
         



           //Return Variables to view model   
           return new ViewModel(array (
            'feesetups' => $feesetups,
            'form' =>$form,
            'feetotals'=>$feetotals
            ));

      }
      public function totalAction()
      {
         $em = $this->getEntityManager();
         //get the section id from the link of section name in index set as id
          $id = $this->params()->fromRoute('id'); 
          
          //find all the totals of a given section
         $feetotals=$em->getRepository('Admin\Entity\FeeTotal')->findBy(array('section' =>$id));
          //Return Variables to view model   
           return new ViewModel(array (
            'id'=>$id,
            'feetotals'=>$feetotals
            ));
        
      }

       public function feeitemsAction()
      {
         $em = $this->getEntityManager();
         //get the section id from the link of section name in index set as id
          $id = $this->params()->fromRoute('id'); 
            //find  the totals of a given section
           $feetotal=$em->getRepository('Admin\Entity\FeeTotal')->findOneBy(array('feeSection' =>$id));
          //find all the items of a given feesection{section+year}
         $feeitems=$em->getRepository('Admin\Entity\FeeItems')->findBy(array('feeSection' =>$id));
          //Return Variables to view model   
           return new ViewModel(array (
            'id'=>$id,
            'feeitems'=>$feeitems,
            'feetotal'=>$feetotal,
            ));
        
      }

  public function feesetupAction()
    {    
     $entityManager = $this->getEntityManager();
     $form = new FeeSetUpForm($entityManager);
     $form->setHydrator (new DoctrineEntity($entityManager,'Admin\Entity\FeeSetUp'));
    
     $feesetup = new FeeSetUp();

     $form->bind($feesetup);      
      $request = $this->getRequest();

         if ($request->isPost()) {
            $data = $request->getPost();
                    //  var_dump($data);die;
              $form->setData($request->getPost());            

            if ($form->isValid()) {
                
                      $this->flashMessenger()->addSuccessMessage('Section Fee set successfully!');
                      $entityManager->persist($feesetup);
                      $entityManager->flush();
                        // Redirect to List of section
                return $this->redirect()->toRoute('fee', array('controller'=>'fee', 'action'=>'index'));
                
              }
          }
            return new ViewModel(array ('form' =>$form));
      }


           public function feesectionAction()
        {    //grab the id which is a section passed from index
          $entityManager = $this->getEntityManager();
          $id = $this->params()->fromRoute('id',0);
      //  var_dump($id);
            $section=$entityManager->find('Admin\Entity\Section',$id);
            // var_dump($section);die;
             $form = new FeeSectionForm($entityManager);
            
             $feesection = new FeeSection();
             $feestotal = new FeeTotal();

             $form->bind($feesection);      
              $request = $this->getRequest();

                 if ($request->isPost()) {

                      $data = $request->getPost();
                    // var_dump($data);die;
                      //get year value from the submited form
                   $yearval= $data['feesection']['year'];
                      //check to see if the section and year already exist.
                   $feeValid=$this->getEntityManager()->getRepository('Admin\Entity\FeeSection')->findOneBy(array('section'=>$section, 'year'=>$yearval));
            ///var_dump($feeValid);die;

                      $form->setData($request->getPost());            

                    if ($form->isValid()) {
                      //if it exist throw an error message and redirect to index of fee
                       if(isset($feeValid)){
                            $this->flashMessenger()->addErrorMessage("This year's fee already exist for this session!");
                              // Redirect to List of section
                              return $this->redirect()->toRoute('fee', array('controller'=>'fee', 'action'=>'index'));                     
                          }
                          else {
                                //do hydration
                              $this->flashMessenger()->addSuccessMessage('Section Fee items set successfully!');
                              //set section for feesection
                              $feesection->setSection($section);
                              
                              $entityManager->persist($feesection);
                             // var_dump($feesection);die;
                              //get the total fee from the feesection 
                              $total=$entityManager->getRepository('Admin\Entity\FeeItems')->getTotal($feesection->getId());
                             //set the feetotal entity with info from feesection
                              $feestotal->setFeeSection($feesection);
                              $feestotal->setYear($feesection->getYear());
                              $feestotal->setSection($feesection->getSection());
                              $feestotal->setAmount($feesection->getTotal());
                              //persits and walahhh!
                              $entityManager->persist($feestotal);
                              $entityManager->flush();
                                // Redirect to feesetup index
                            return $this->redirect()->toRoute('fee', array('controller'=>'fee', 'action'=>'index'));
                          }
                        
                      }
                  } //give em the form and section as id
                    return new ViewModel(array ('form' =>$form, 'id'=>$id));
          }

             public function settingAction()
        {   $entityManager = $this->getEntityManager();
            $id = $this->params()->fromRoute('id',0);
            $section=$entityManager->find('Admin\Entity\Section',$id);
            $yr=$this->getServiceLocator()->get('Admin\Service\SettingsService')->getCurrentYear(); 
  $year=$entityManager->getRepository('Admin\Entity\Year')->findOneBy(array('id'=>$yr->getId()));

            //var_dump($yr);die;
            $items = $_POST['item'];
            $amount = $_POST['amount'];

            $feeValid=$this->getEntityManager()->getRepository('Admin\Entity\FeeSection')->findOneBy(array('section'=>$section, 'year'=>$year->getId()));

            if(isset($feeValid)){
                            $this->flashMessenger()->addErrorMessage("This year's fee already exist for this session!");
                              // Redirect to List of section
                              return $this->redirect()->toRoute('fee', array('controller'=>'fee', 'action'=>'index'));                     
                          }
                          else{
                 $this->flashMessenger()->addSuccessMessage('Section Fee items set successfully!');
                 $feesection= new feeSection();
                 $feesection->setSection($section);
                 $feesection->setYear($year);
                 $entityManager->persist($feesection);
                  
         // var_dump($feesection);die;
          foreach( $items as $key => $n ) {
                      $feeitems= new FeeItems();
                      $feeitems->setItems($n);
                      $feeitems->setAmount($amount[$key]);
                      $feeitems->setFeeSection($feesection);
                      $entityManager->persist($feeitems);
                      $entityManager->flush();
                     }
             $itemsx=$entityManager->getRepository('Admin\Entity\FeeItems')->findBy(array('feeSection'=>$feesection->getId()));
                 //set the feetotal entity with info from feesection
                  $feestotal = new FeeTotal();
                  $feestotal->setFeeSection($feeitems->getFeeSection());
                  $feestotal->setYear($feeitems->getFeeSection()->getYear());
                  $feestotal->setSection($feeitems->getFeeSection()->getSection());
                  $feestotal->setAmount($this->getTotal($itemsx));
                  //persits and walahhh!
                  $entityManager->persist($feestotal);
            
            $entityManager->flush();
            // Redirect to feesetup index
             return $this->redirect()->toRoute('fee', array('controller'=>'fee', 'action'=>'index'));
          
           }
         return new ViewModel(array ('id'=>$id));
        }

 public function getTotal($feeitems)
                  {  //var_dump($feeitems);die;
                      $total = 0;
                      foreach ($feeitems as $item) {
                          $total += $item->getAmount();
                      }
                      return $total;
                  }

                     
                      public function editfeesectionAction()
                {    //grab the id which is a section passed from index
                        $entityManager = $this->getEntityManager();
                        
                         $id = (int) $this->params()->fromRoute('id', 0);
                          if (!$id) {
                              return $this->redirect()->toRoute('fee', array('controller'=>'fee','action' => 'index'));
                          }

                          $feesection = $entityManager->find('Admin\Entity\FeeSection', $id);
                          $section=$feesection->getSection();
                          $year=$feesection->getYear();
                          if (!$feesection) {
                               return $this->redirect()->toRoute('fee', array('controller'=>'fee', 'action'=>'index')); 
                             
                          }


                           $form = new FeeSectionForm($entityManager);
                           $form->bind($feesection); 
                           
                                                           
                            $request = $this->getRequest();

                               if ($request->isPost()) {
                                  $form->setData($request->getPost()); 
                               /** //exclude section and year from being validated
                                $form->setValidationGroup(array(
                                         'feesection' => array(
                                             'feeitems' => array(
                                                 'items',
                                                 'amount'
                                             ),
                                         ),
                                     ));
                                             
                                  */
                                  if ($form->isValid()) {
                                   
                                              //do hydration
                                            $this->flashMessenger()->addSuccessMessage('Section Fee items set successfully!');
                                             //$feesection->setSection($section);
                                           //   $feesection->setSection($year);
                                            $entityManager->persist($feesection);
                                            //get the total fee from the feesection 
                                       $total=$entityManager->getRepository('Admin\Entity\FeeItems')->getTotal($feesection->getId());
                                    $feetotal =$entityManager->getRepository('Admin\Entity\FeeTotal')->findOneBy(array('feeSection' =>$id));
                                           //set the feetotal entity with info from feesection
                                            //$feestotal->setFeeSection($feesection);
                                           // $feestotal->setYear($feesection->getYear());
                                           // $feestotal->setSection($feesection->getSection());
                                            $feetotal->setAmount($feesection->getTotal());
                                            //persits and walahhh!
                                            $entityManager->persist($feetotal);
                                            $entityManager->flush();
                                              // Redirect to feesetup index
                                          return $this->redirect()->toRoute('fee', array('controller'=>'fee', 'action'=>'index'));
                                        
                                      
                                    }
                                } //give em the form and section as id
                                  return new ViewModel(array ('form' =>$form, 'id'=>$id));
                        }

      public function editfeesetupAction()
    {  $entityManager = $this->getEntityManager();
       $viewmodel = new ViewModel();
        $id = (int) $this->params()->fromRoute('id', 0);
        if (!$id) {
            return $this->redirect()->toRoute('fee', array('controller'=>'fee','action' => 'index'));
        }

        $feesetup = $entityManager->find('Admin\Entity\FeeSetup', $id);
        if (!$feesetup) {
             return $this->redirect()->toRoute('fee', array('controller'=>'fee', 'action'=>'index')); 
           
        }

        $formfeesetup = new FeeSetupForm($entityManager);
        //$formfeesetup->setHydrator (new DateHydrator($entityManager,'Admin\Entity\FeeSetup'));
        $formfeesetup->bind($feesetup);
        $formfeesetup->get('submit')->setAttribute('value', 'Edit');

        $request = $this->getRequest();
         //disable layout if request by Ajax
        $viewmodel->setTerminal($request->isXmlHttpRequest());
        
        $is_xmlhttprequest = 1;
        if ( ! $request->isXmlHttpRequest()){
            //if NOT using Ajax
            $is_xmlhttprequest = 0;

        if ($request->isPost()) {
           // $formsession->setInputFilter(new SessionFilter($this->getServiceLocator()));
            $formfeesetup->setData($request->getPost());
            $formfeesetup->setValidationGroup(array('description'));
           if ($formfeesetup->isValid()) {
              
              //  $entityManager->persist($academicsession);
                $entityManager->flush();

                // Redirect to list of albums
                return $this->redirect()->toRoute('fee', array('controller'=>'fee', 'action'=>'index')); 
           }
        }

       } 
          $viewmodel->setVariables(array(
                    'formfeesetup' => $formfeesetup,
                    'id' =>$id,
                    'is_xmlhttprequest' => $is_xmlhttprequest //need for check this form is in modal dialog or not in view
        ));
        
        return $viewmodel;
    }





   public function deleteAction()
    {   $id = $this->params()->fromRoute('id');
        if (!$id) return $this->redirect()->toRoute('fee', array('controller' => 'fee', 'action' => 'index'));
        
        $entityManager = $this->getEntityManager();
          
         
      try {
         //$setupre = $entityManager->getRepository('Admin\Entity\FeeSetup');
          $setup = $entityManager->getRepository('Admin\Entity\FeeSetup')->findOneBy(array('section' => $id));
          $feesection =$entityManager->getRepository('Admin\Entity\FeeSection')->findOneBy(array('section' => $id));
          $feeitems =$entityManager->getRepository('Admin\Entity\FeeItems')->findBy(array('feeSection' => $feesection->getId()));
          $feetotal =$entityManager->getRepository('Admin\Entity\FeeTotal')->findOneBy(array('feeSection' =>$feesection->getId()));

          $entityManager->remove($feetotal);
          $entityManager->remove($feeitems);
          $entityManager->remove($setup);
          $entityManager->remove($feesection);
          $entityManager->flush();
          $this->flashMessenger()->addSuccessMessage('Section Fee setup Delete Successfully!');
        //   $this->flashMessenger()->addSuccessMessage('Post Saved');
          
          }
        catch (\Exception $ex) {
      $this->redirect()->toRoute('fee', array('controller' => 'fee', 'action' => 'view'));  
        }
         return $this->redirect()->toRoute('fee', array('controller' => 'fee', 'action' => 'index')); 
   }


    public function deletefeesectionAction()
    {   $id = $this->params()->fromRoute('id');
        if (!$id) return $this->redirect()->toRoute('fee', array('controller' => 'fee', 'action' => 'index'));
        
        $entityManager = $this->getEntityManager();
          
         
      try {
        
          $feesection =$entityManager->getRepository('Admin\Entity\FeeSection')->findOneBy(array('id' => $id));
          $entityManager->remove($feesection);
         // $entityManager->remove($feeitems);
          
          $entityManager->flush();
          $this->flashMessenger()->addSuccessMessage('Section Fee setup Deleted Successfully!');
        //   $this->flashMessenger()->addSuccessMessage('Post Saved');
          
          }
        catch (\Exception $ex) {
      $this->redirect()->toRoute('fee', array('controller' => 'fee', 'action' => 'view'));  
        }
         return $this->redirect()->toRoute('fee', array('controller' => 'fee', 'action' => 'index')); 
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

 

       
}