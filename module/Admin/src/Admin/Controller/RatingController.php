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


use Admin\Entity\Result;
use Admin\Entity\TraitName; 
use Admin\Entity\Rating;       

use DoctrineORMModule\Stdlib\Hydrator\DoctrineEntity;
use Zend\View\Model\JsonModel;
use Doctrine\ORM\Query\Expr;



class RatingController extends AbstractActionController
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
 $dql = "SELECT s,p,r,c FROM Admin\Entity\Student s  LEFT JOIN s.currentclass c  LEFT JOIN s.person p  LEFT JOIN s.rating r with r.session=?1";
                  $query = $this->getEntityManager()->createQuery($dql)->setParameter(1, $session); 
                  $students = $query->getScalarResult();
                  //SELECT u FROM User u JOIN Blacklist b WITH u.email = b.email

         // var_dump($students);die;

                      $view = new ViewModel();
                        
                        $view->setVariables(array('students'=>$students));
               
                        return $view;
       }

   

 public function ratingAction()
 {  $sefssion=$this->getEntityManager()->getRepository('Admin\Entity\Session')->findOneBy(array(), array('id' => 'DESC'));
     $session=$sefssion->getId();
    $id = (int) $this->params()->fromRoute('id', 0);
   $student=$this->getEntityManager()->getRepository('Admin\Entity\Student')->findOneBy(array('id' => $id));
   $section=$student->getSection()->getId();
   //var_dump($section);die;

     //query to get the ratings row that total falls within startrange and endrange 
   $query = $this->getEntityManager()->createQuery('SELECT s,t FROM Admin\Entity\Settings s LEFT JOIN s.trait t WHERE s.session=:session and s.section=:section'); 
   $query->setParameters(array('session'=>$session,'section'=>$section)); 
   $settings = $query->getScalarResult();
   foreach ($settings as $setting) {
     $idx=$setting['t_id'];
   }
   $skill=$this->getEntityManager()->getRepository('Admin\Entity\TraitName')->findOneBy(array('traitFormat'=>$idx, 'name'=>'Psychomotor skill'));
   $sid=$skill->getId();
   $query = $this->getEntityManager()->createQuery('SELECT r FROM Admin\Entity\Traits r  WHERE r.traitName=:session'); 
   $query->setParameters(array('session'=>$sid,)); 
   $ratings = $query->getScalarResult();

   return new ViewModel(array('ratings'=>$ratings, 'id'=>$id));
 }

  public function rateAction()
  {  $sefssion=$this->getEntityManager()->getRepository('Admin\Entity\Session')->findOneBy(array(), array('id' => 'DESC'));
     $session=$sefssion->getId();

    $student = $_POST['student'];
    $rate = $_POST['rate'];
    $traits = $_POST['traits'];
       //$total=$ftest+$stest+$exam;
    //var_dump($name);die;
    foreach( $rate as $key => $n ) {
      $studentobject=$this->getEntityManager()->getRepository('Admin\Entity\Student')->findOneBy(array('id'=>$student));
      $traitobject=$this->getEntityManager()->getRepository('Admin\Entity\Traits')->findOneBy(array('id'=>$traits[$key]));
      $rating=$this->getEntityManager()->getRepository('Admin\Entity\Rating')->findOneBy(array('student'=>$student,'session'=>$session,'traits'=>$traits[$key]));

  
         if(isset($rating))
            {
              $rating->setRate($n);
              $this->getEntityManager()->persist($rating);
              $studentobject->setRating($rating);
              $this->getEntityManager()->persist($studentobject);
            }
            else{
                $rating= new Rating();
                $rating->setRate($n);
                $rating->setTraits($traitobject);
                $rating->setStudent($studentobject);
                $rating->setSession($sefssion);

                $this->getEntityManager()->persist($rating);
                $studentobject->setRating($rating);
                $this->getEntityManager()->persist($studentobject);

               }
      }
      
     $this->getEntityManager()->flush();
     return $this->redirect()->toRoute('rating', array('controller'=>'rating', 'action'=>'index'));


    return new ViewModel();
  }



       
}