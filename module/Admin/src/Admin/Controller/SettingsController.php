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


use Admin\Entity\Settings; 
use Admin\Entity\School;       
use Admin\Entity\GradeSystem;

use Admin\Form\SchoolForm; 
use Admin\Form\GradeFormatForm; 
use Admin\Form\GradeSystemForm;        

use DoctrineORMModule\Stdlib\Hydrator\DoctrineEntity;

use Zend\View\Model\JsonModel;



class SettingsController extends AbstractActionController
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
	{	    $sefssion=$this->getEntityManager()->getRepository('Admin\Entity\Session')->findOneBy(array(), array('id' => 'DESC'));
      $session=$sefssion->getId();

     

        $dql = "SELECT s,se,y,t,sec,g,a,tr FROM Admin\Entity\Settings s LEFT JOIN s.session se LEFT JOIN se.year y LEFT JOIN se.term t LEFT JOIN s.section sec LEFT JOIN s.grade g LEFT JOIN s.assessment a LEFT JOIN s.trait tr WHERE se.id=?1 ORDER BY s.id ASC ";
        $query = $this->getEntityManager()->createQuery($dql)->setParameters(array('1'=>$session));
        $settings = $query->getScalarResult();
       // var_dump($settings);die;

        $dql = "SELECT s FROM Admin\Entity\Section s ORDER BY s.id ASC ";
        $query = $this->getEntityManager()->createQuery($dql); 
        $sections = $query->getArrayResult();

          $dql = "SELECT s FROM Admin\Entity\GradeFormat s ORDER BY s.id ASC ";
        $query = $this->getEntityManager()->createQuery($dql); 
        $grades = $query->getArrayResult();

         $dql = "SELECT s FROM Admin\Entity\CaFormat s ORDER BY s.id ASc ";
        $query = $this->getEntityManager()->createQuery($dql); 
        $assessments = $query->getArrayResult();

         $dql = "SELECT s FROM Admin\Entity\TraitFormat s ORDER BY s.id ASC ";
        $query = $this->getEntityManager()->createQuery($dql); 
        $traits = $query->getArrayResult();



		return new ViewModel(array('sections'=>$sections,'grades'=>$grades,'assessments'=>$assessments,'traits'=>$traits,'settings'=>$settings));
	}
	


  public function addinfoAction()
  {
      $entityManager = $this->getEntityManager();
       $form = new SchoolForm($entityManager);    
       $school =  $entityManager->getRepository('Admin\Entity\School')->findOneBy(array(),array('id'=>'DESC'));
        if(!$school){
          $school=new School();
        }   
       $form->bind($school);      
        $request = $this->getRequest();
         if ($request->isPost()) {
            $data = $request->getPost();        
              $form->setData($request->getPost());            
            if ($form->isValid()) {
                      $this->flashMessenger()->addSuccessMessage('School Info Saved Successfully!');
                      $entityManager->persist($school);
                      $entityManager->flush();
                        // Redirect to List of section
                return $this->redirect()->toRoute('settings', array('controller'=>'settings', 'action'=>'school'));
              }
          }
            return new ViewModel(array ('form' =>$form,));
  }


	 public function settingsAction()
	{  $sefssion=$this->getEntityManager()->getRepository('Admin\Entity\Session')->findOneBy(array(), array('id' => 'DESC'));
     $session=$sefssion->getId();

  

		$post =$this->getRequest()->getPost()->toArray();
		$section = $_POST['section'];
    	$assessment = $_POST['assessment'];
    	$grade = $_POST['grade'];
		$trait = $_POST['trait'];
		
		//var_dump($name);die;
    foreach( $section as $key => $n ) {
      $sectid=$this->getEntityManager()->getRepository('Admin\Entity\Section')->findOneBy(array('id'=>$n));
      $assid=$this->getEntityManager()->getRepository('Admin\Entity\CaFormat')->findOneBy(array('id'=>$assessment[$key]));
        $gradeid=$this->getEntityManager()->getRepository('Admin\Entity\GradeFormat')->findOneBy(array('id'=>$grade[$key]));
        $traitid=$this->getEntityManager()->getRepository('Admin\Entity\TraitFormat')->findOneBy(array('id'=>$trait[$key]));
         $settings=$this->getEntityManager()->getRepository('Admin\Entity\Settings')->findOneBy(array('section'=>$n,'session'=>$session,'grade'=>$grade[$key],'assessment'=>$assessment[$key],'trait'=>$trait[$key]));
         if(isset($settings))
            { $settings->setSection($sectid);
              $settings->setSession($sefssion);
              $settings->setTrait($traitid);
              $settings->setGrade($gradeid);
              $settings->setAssessment($assid);
              $this->getEntityManager()->persist($settings);
            }
            else{
                $setting= new Settings();
                $setting->setSection($sectid);
                $setting->setSession($sefssion);
                $setting->setTrait($traitid);
              	$setting->setGrade($gradeid);
              	$setting->setAssessment($assid);
              	$this->getEntityManager()->persist($setting);

               }
      }
      
     $this->getEntityManager()->flush();
     return $this->redirect()->toRoute('settings', array('controller'=>'settings', 'action'=>'index'));


		return new ViewModel();
	}
}