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


use Admin\Entity\FeeStudent; 
use Admin\Entity\FeePayments;       
use Admin\Entity\FeeStudentTotal;

use Admin\Form\FeeStudentTotalForm; 
use Admin\Form\FeeStudentForm;
use Admin\Form\FeePaymentsForm;        


use DoctrineORMModule\Stdlib\Hydrator\DoctrineEntity;
use ZfcDatagrid\Column;
use Zend\View\Model\JsonModel;



class FeecollectionController extends AbstractActionController
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
         $sefssion=$this->getEntityManager()->getRepository('Admin\Entity\Session')->findOneBy(array(), array('id' => 'DESC'));
         $session=$sefssion->getId();


 $dql = "SELECT s,p, t, c FROM Admin\Entity\Student s LEFT JOIN s.currentclass c  LEFT JOIN s.person p LEFT JOIN s.studentTotal t with t.session=?1";
        $query = $this->getEntityManager()->createQuery($dql)->setParameter(1, $session); 
        $students = $query->getScalarResult();
        //SELECT u FROM User u JOIN Blacklist b WITH u.email = b.email

//var_dump($students);die;

            $view = new ViewModel();
              
              $view->setVariables(array('students'=>$students));
     
              return $view;
       }
       public function viewAction()
       { $sefssion=$this->getEntityManager()->getRepository('Admin\Entity\Session')->findOneBy(array(), array('id' => 'DESC'));
         $session=$sefssion->getId();
          $id = $this->params()->fromRoute('id');
        //  var_dump($id);die;
         // $student=$this->getEntityManager()->getRepository('Admin\Entity\FeeStudent')->findOneBy(array('student'=>$id, 'session'=>$session));
     
        // $feetotals =$this->getEntityManager()->getRepository('Admin\Entity\FeeStudentTotal')->findBy(array('FeeStudent' =>$student->getId()));


$dql = "SELECT s,fst,fs,sec,se,y,t FROM Admin\Entity\Student s LEFT JOIN s.studentTotal fst LEFT JOIN fst.feeStudent fs   LEFT JOIN s.section sec LEFT JOIN fst.session se LEFT JOIN se.year y LEFT JOIN se.term t  WHERE s.id=?3";
        $query = $this->getEntityManager()->createQuery($dql)->setParameters(array(3=>$id));; 
        $feetotals = $query->getScalarResult();
//var_dump($feetotals);die;
          // $studsection=$this->getEntityManager()->getRepository('Admin\Entity\Student')->findOneBy(array('id'=>$student->getId()));
          //  $section=$studsection->getSection();
            //var_dump($studfee);die;
          //get the Total of the student section
           // $feetotal =$this->getEntityManager()->getRepository('Admin\Entity\FeeTotal')->findOneBy(array('section' =>$section->getId(),'year'=>$year->getId()));
          //  $sectiontotal=$feetotal->getAmount();

          return new ViewModel(array('feetotals' => $feetotals));

       }

            public function transactionAction()
       { 
          $id = $this->params()->fromRoute('id');

        //  var_dump($id);die;
          $dql = "SELECT s,p FROM Admin\Entity\FeeStudent  s LEFT JOIN s.payments p WHERE s.id=?3";
          $query = $this->getEntityManager()->createQuery($dql)->setParameters(array(3=>$id));; 
          $transactions = $query->getScalarResult();

       
         $total=$this->getEntityManager()->getRepository('Admin\Entity\FeeStudentTotal')->findOneBy(array('feeStudent' =>$id));
        // var_dump($total);die;
          return new ViewModel(array('transactions' => $transactions, 'total'=>$total));
       }

            public function deleteAction()
      {   $id = $this->params()->fromRoute('id');
          if (!$id) return $this->redirect()->toRoute('collection', array('controller' => 'feecollection', 'action' => 'index'));
          
          $entityManager = $this->getEntityManager();

           
        try {
           //$setupre = $entityManager->getRepository('Admin\Entity\FeeSetup');
            $feestudent = $entityManager->getRepository('Admin\Entity\FeeStudent')->findOneBy(array('id' => $id));
            $entityManager->remove($feestudent);
            $entityManager->flush();
           
            $this->flashMessenger()->addSuccessMessage('Student Session Fee Deleted Successfully!');
          //   $this->flashMessenger()->addSuccessMessage('Post Saved');
            
            }
          catch (\Exception $ex) {
        $this->redirect()->toRoute('collection', array('controller' => 'feecollection', 'action' => 'index'));  
          }
           return $this->redirect()->toRoute('collection', array('controller' => 'feecollection', 'action' => 'index')); 
     }

        public function deletetransactionAction()
    {   $id = $this->params()->fromRoute('id');
        if (!$id) return $this->redirect()->toRoute('collection', array('controller' => 'feecollection', 'action' => 'index'));
        
        $entityManager = $this->getEntityManager();

         
      try {
         //$setupre = $entityManager->getRepository('Admin\Entity\FeeSetup');
          $feepayments = $entityManager->getRepository('Admin\Entity\FeePayments')->findOneBy(array('feeStudent' => $id));
          $entityManager->remove($feepayments);
          $entityManager->flush();
          //get the students new total
          $total=$this->getEntityManager()->getRepository('Admin\Entity\FeePayments')->getTotal($id);
          //var_dump($total);die;
          //get the student's total entity
          $feestotal=$this->getEntityManager()->getRepository('Admin\Entity\FeeStudentTotal')->findOneBy(array('feeStudent'=>$id));



          //All this code is just to get the total fee of the student section
            $feestudents=$this->getEntityManager()->getRepository('Admin\Entity\FeeStudent')->findOneBy(array('id'=>$id));
            $year=$feestudents->getSession()->getYear()->getId();

           $studsection=$feestudents->getStudent();
           $section=$studsection->getSection()->getId();
                    //var_dump($studfee);die;
                  //get the Total of the student section
           $feesectiontotal =$this->getEntityManager()->getRepository('Admin\Entity\FeeTotal')->findOneBy(array('section' =>$section,'year'=>$year));
           $sectiontotal=$feesectiontotal->getAmount();
           //it finally ends with the above code!!

            $feestatus='';
                       if ($total>=$sectiontotal) {
                            $feestatus='Paid';
                           } elseif ($total<$sectiontotal) {
                                    $feestatus='Owning';
                           }



          //update the entity with the new total
          $feestotal->setAmount($total);
          $feestotal->setFeeStatus($feestatus);
          $entityManager->persist($feestotal);
          $entityManager->flush();
          $this->flashMessenger()->addSuccessMessage('transactions Delete Successfully!');
        //   $this->flashMessenger()->addSuccessMessage('Post Saved');
          
          }
        catch (\Exception $ex) {
      $this->redirect()->toRoute('collection', array('controller' => 'feecollection', 'action' => 'index'));  
        }
         return $this->redirect()->toRoute('collection', array('controller' => 'feecollection', 'action' => 'index')); 
   }

              public function payAction()
        {    //grab the id which is a section passed from index
          $entityManager = $this->getEntityManager();
          $id = $this->params()->fromRoute('id');
          $student=$id;
             $form = new FeeStudentForm($entityManager);
             $feestudent = new FeeStudent();
              $feepayments= new FeePayments();
             $feestudenttotal = new FeeStudentTotal();
             $form->bind($feestudent); 
             //var_dump($form);

              $request = $this->getRequest();

                 if ($request->isPost()) {
                      $data = $request->getPost();
                     
                      //get year value from the submited form
                  // $student= $data['feestudent']['student'];
                   //get the current session
                   $session=$this->getEntityManager()->getRepository('Admin\Entity\Session')->findOneBy(array(), array('id' => 'DESC'));
                   $year=$session->getYear();
                  //check to see if the student and sesion already exist.
                   $studfee=$this->getEntityManager()->getRepository('Admin\Entity\FeeStudent')->findOneBy(array('student'=>$id, 'session'=>$session->getId()));
                   //get the section of student
                    $studsection=$this->getEntityManager()->getRepository('Admin\Entity\Student')->findOneBy(array('id'=>$id));
                    $section=$studsection->getSection();
                    //var_dump($studfee);die;
                  //get the Total of the student section
                    $feetotal =$this->getEntityManager()->getRepository('Admin\Entity\FeeTotal')->findOneBy(array('section' =>$section->getId(),'year'=>$year->getId()));
                    $sectiontotal=$feetotal->getAmount();
                    
                    
      
                    $form->setData($request->getPost());
                   //  var_dump($form->setData($request->getPost()));die;

                    if ($form->isValid()) {
                       // var_dump($form);die;
                              //if it exist throw an error message and redirect to index of fee
                       if(isset($studfee)){
                            $this->flashMessenger()->addSuccessMessage("Student Fee Entered Successfully!");
                              $studfeeid=$studfee->getId();
                              $fee_total=$entityManager->getRepository('Admin\Entity\FeePayments')->getTotal($studfeeid);
                              $feestoo=$this->getEntityManager()->getRepository('Admin\Entity\FeeStudentTotal')->findOneBy(array('feeStudent'=>$studfeeid));
                              try{

                              $feepayments->setFeeStudent($studfee);
                              $feepayments->setAmount($data['feestudent']['feepayments']['amount']);
                              $feepayments->setReceipt($data['feestudent']['feepayments']['receipt']);
                              $feepayments->setDop($data['feestudent']['feepayments']['dop']);
                              $feepayments->setMethod($data['feestudent']['feepayments']['method']);
                              $entityManager->persist($feepayments);
                              // $entityManager->flush();

                               $fees_total=$data['feestudent']['feepayments']['amount']+$fee_total;
                             //var_dump($fees_total);
                               $feestatus='';
                                     if ($fees_total>=$sectiontotal) {
                                          $feestatus='Paid';
                                         } elseif ($fees_total<$sectiontotal) {
                                                  $feestatus='Owning';
                                         }
                             //set the feetotal entity with info from feesection
                              
                              $feestoo->setAmount($fees_total);
                              $feestoo->setFeeStatus($feestatus);
                              // var_dump($feestoo);die;
                              //persits and walahhh!
                              $entityManager->persist($feestoo);
                              //map the total in the student entity
                              $studsection->setStudentTotal($feestoo);

                               //persits and walahhh!
                              $entityManager->persist($studsection);
                              $entityManager->flush();

                              return $this->redirect()->toRoute('collection', array('controller'=>'feecollection', 'action'=>'index'));  
                              }
                               catch (\Exception $ex) {
                              $this->redirect()->toRoute('collection', array('controller'=>'feecollection', 'action'=>'index'));  
                            }                     
                          }
                          else {
                            try{
                                //do hydration
                              $this->flashMessenger()->addSuccessMessage('Student Fee Entered Successfully!');
                              //set section for feesection
                              $feestudent->setStudent($studsection);
                              $feestudent->setSession($session);
                             // var_dump($feestudent);die;
                              $entityManager->persist($feestudent);
                              //get the total fee from the feesection 
                             

                                
                              //set feepayment
                              $feepayments->setFeeStudent($feestudent);
                              $feepayments->setAmount($data['feestudent']['feepayments']['amount']);
                              $feepayments->setReceipt($data['feestudent']['feepayments']['receipt']);
                              $feepayments->setDop($data['feestudent']['feepayments']['dop']);
                              $feepayments->setMethod($data['feestudent']['feepayments']['method']);
                              $entityManager->persist($feepayments);

                              // $total=$entityManager->getRepository('Admin\Entity\FeePayments')->getTotal($feestudent->getId());
                              $amount=$data['feestudent']['feepayments']['amount'];
                              $feestatus='';
                                     if ($amount>=$sectiontotal) {
                                          $feestatus='Paid';
                                         } elseif ($amount<$sectiontotal) {
                                                  $feestatus='Owning';
                                         }
                             //set the feetotal entity with info from feesection
                              $feestudenttotal->setFeeStudent($feestudent);
                              $feestudenttotal->setSession($session);
                              $feestudenttotal->setSectionFee($sectiontotal);
                              $feestudenttotal->setAmount($data['feestudent']['feepayments']['amount']);
                              $feestudenttotal->setFeeStatus($feestatus);

                              //persits and walahhh!
                              $entityManager->persist($feestudenttotal);
                              //map the total in the student entity
                              $studsection->setStudentTotal($feestudenttotal);

                               //persits and walahhh!
                              $entityManager->persist($studsection);
                              $entityManager->flush();
                                // Redirect to feesetup index
                            return $this->redirect()->toRoute('collection', array('controller'=>'feecollection', 'action'=>'index'));
                            }
                               catch (\Exception $ex) {
                          $this->redirect()->toRoute('collection', array('controller'=>'feecollection', 'action'=>'index'));  
                            }     
                              
                          }
                        }
                     
                  } //give em the form and section as id
                    return new ViewModel(array ('form' =>$form, 'id'=>$id));
          }




            public function edittransactionAction()
        {    //grab the id which is a section passed from index
          $entityManager = $this->getEntityManager();
          $id = $this->params()->fromRoute('id');
          $payments=$this->getEntityManager()->getRepository('Admin\Entity\FeePayments')->findOneBy(array('id'=>$id));
          $form = new FeePaymentsForm($entityManager);
          $form->bind($payments); 
            
              $request = $this->getRequest();

                 if ($request->isPost()) {
                      $data = $request->getPost();
  
                    $form->setData($request->getPost());
                   //  var_dump($form->setData($request->getPost()));die;

                    if ($form->isValid()) {
                      
                            try{
                                //do hydration
                              $this->flashMessenger()->addSuccessMessage('Student Fee Entered Successfully!');
                              $entityManager->persist($payments);
                              $entityManager->flush();


                              //All this code is just to get the total fee of the student section
                              $feestudent=$payments->getFeeStudent();
                              $year=$feestudent->getSession()->getYear()->getId();

                             $studsection=$feestudent->getStudent();
                             $section=$studsection->getSection()->getId();
                                      //var_dump($studfee);die;
                                    //get the Total of the student section
                             $feesectiontotal =$this->getEntityManager()->getRepository('Admin\Entity\FeeTotal')->findOneBy(array('section' =>$section,'year'=>$year));
                             $sectiontotal=$feesectiontotal->getAmount();
                             //it finally ends with the above code!!

                             
                              $total=$entityManager->getRepository('Admin\Entity\FeePayments')->getTotal($feestudent->getId());
                              
                              $feestatus='';
                                     if ($total>=$sectiontotal) {
                                          $feestatus='Paid';
                                         } elseif ($total<$sectiontotal) {
                                                  $feestatus='Owning';
                                         }
                              $feestudenttotal=$entityManager->getRepository('Admin\Entity\FeeStudentTotal')->findOneBy(array('feeStudent' =>$feestudent->getId()));
                             //set the feetotal entity with info from feesection
                              $feestudenttotal->setSectionFee($sectiontotal);
                              $feestudenttotal->setAmount($total);
                              $feestudenttotal->setFeeStatus($feestatus);

                              //persits and walahhh!
                              $entityManager->persist($feestudenttotal);
                              //map the total in the student entity
                              $entityManager->flush();
                                // Redirect to feesetup index
                            return $this->redirect()->toRoute('collection', array('controller'=>'feecollection', 'action'=>'index'));
                            }
                               catch (\Exception $ex) {
                          $this->redirect()->toRoute('collection', array('controller'=>'feecollection', 'action'=>'index'));  
                            }     
                              
                        }
                     
                  } //give em the form and section as id
                    return new ViewModel(array ('form' =>$form, 'id'=>$id));
          }


 









    /**
     * Method used to create products array that will be transformed into JSON DataTable format.
     *
     * @param  $list - product entities array
     * "
     * @return array
     */
    private function _createProductsArray($products, $locale)
    {
        // translator
        $translator = $this->getServiceLocator()->get('translator');

        $list = array();

        $i = 0;

        foreach ($products as $product) {
            /* @var $product Product */
            $idx = 0;

            $url = $this->url()->fromRoute(
                'erp/products/actions', array(
                    'locale' => $locale,
                    'action'=>'edit',
                    'id' => $product->getId(),
                )
            );
            $name  = $product->getName();
            $title = sprintf($translator->translate('Edit: %s'), $name);
            $link  = sprintf('<a href="%s" title="%s">%s</a>', $url, $title, $name);
            $updated_at = substr($product->getUpdatedAt(), 0, 16);

            $list[] = array(
                'DT_RowId' => 'row-' . $product->getId(),
                'DT_RowClass' => 'product-row',
                $idx++ => ++$i, // #
                $idx++ => $product->getId(), // product id
                $idx++ => $link, // product name
                $idx++ => $product->getCategory()->getName(), // product category name
                $idx++ => $product->getCode(), // product code
                $idx++ => number_format ($product->getPriceNetto(), 2, '.', ' ') . ' PLN', // price (netto)
                $idx++ => number_format ($product->getPriceBrutto(), 2, '.', ' ') . ' PLN', // price (brutto)
                $idx++ => $updated_at, // date of last modification
                $idx++ => '',
            );
        }

        return $list;
    }

       
}