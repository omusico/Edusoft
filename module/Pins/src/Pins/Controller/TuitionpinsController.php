<?php
/**
 * Edusoft (http://www.edusoft.com.ng/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2014 Mibs Technologies Inc. (http://www.Mibstechnologies.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Pins\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

use Pins\Entity\Tuitionpins;
use Pins\Form\TuitionpinsForm;

class TuitionpinsController extends AbstractActionController
{
    public function indexAction()
    {
        return new ViewModel();
    }

    public function createAction()
    {

    	$pins=new Tuitionpins();
    	$form=new TuitionpinsForm()
    	$form->setHydrator (new DoctrineEntity($entityManager,'Pins\Entity\Tuitionpins'));
		$session = $entityManager->getRepository('Admin\Entity\Session')->find(array('status'=>1));

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);
		 $form->bind($person); 
        	 $request = $this->getRequest();
		if($request->isPost())
		{	
			$form->setData($request->getPost());
			$pins = array();
			//$model->attributes=$_POST['Pins'];
			$prefix = time();
			for($i=0; $i<$form->quantity; $i++){
				$pin = new Pins;
										

				$random = substr(number_format(time() * rand(), 0, "", ""),0,12);
				array_push($pins, $random);
				//$program_name=Programs::model()->findbyPk($model->program_id);//	
				//$coding = $program_name->program_code;//name of section/id
				if($i<10)
					$pins->setSerial($prefix.'00'.$i+1);
				if($i >9 && $i <100)
					$pins->setSerial($prefix.'0'.$i+1);
				if($i > 99)
					$pins->setSerial($prefix.$i+1);
				$pins->setPin($random);
				$pins->setCreatedAt(date('Y-m-d'));
				$pins->setApplicantId('MIBS/'.$pins->getSerial());
				$pins->setSession($session);
				if($form->isValid()){
					//$form->getData();
					$quantity=$form->get('quantity');
					$this->flashMessenger()->addMessage($quantity);
                  $entityManager->persist($pins);
                  $entityManager->flush();
				}
				else{
					$i = $i-1;
					
				}
			}

				$this->redirect(array('preview', 'qty'=>$model->quantity, 'units'=>$model->units));
				 return $this->redirect()->toRoute('tuitionpins', array('controller'=>'tuitionpins', 'action'=>'view'))
		}



        return new ViewModel(array( 'form' => $form));
    }

    public function viewAction()
	{
		$quantity = null;
		$flashMessenger = $this->flashMessenger();
		if ($flashMessenger->hasMessages()) {
			foreach($flashMessenger->getMessages() as $key => $value) {
				$quantity .=  $value;
			}
		}
		return new ViewModel(array('quantity' => $quantity));
	}
}
