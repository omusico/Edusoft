<?php

namespace Transport\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

use Transport\Entity\Route;
use Transport\Entity\Vehicle; 
use Transport\Entity\AllotTransport; 
use Transport\Entity\SessionRoute; 

use Transport\Form\RouteForm;
use Transport\Form\VehicleForm; 
use Transport\Form\AllotTransportForm;        

use DoctrineORMModule\Stdlib\Hydrator\DoctrineEntity;
use Zend\View\Model\JsonModel;
use Doctrine\ORM\Query\Expr;

class TransportController extends AbstractActionController
{ 
	protected $em;

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
	
	public function routeAction()
	{	$form = new RouteForm($this->getEntityManager());
		$dql = "SELECT r FROM \Transport\Entity\Route r ORDER BY r.id DESC ";
        $query = $this->getEntityManager()->createQuery($dql); 
        $routes = $query->getScalarResult();
		return new ViewModel(array('routes'=>$routes,'form'=>$form));
	}

		public function vehicleAction()
	{	$form = new VehicleForm($this->getEntityManager());
		$dql = "SELECT v FROM Transport\Entity\Vehicle v ORDER BY v.id DESC ";
        $query = $this->getEntityManager()->createQuery($dql); 
        $vehicles = $query->getScalarResult();
		return new ViewModel(array('vehicles'=>$vehicles,'form'=>$form));
	}

		public function allottransportAction()
	{	
		$dql = "SELECT a FROM Transport\Entity\AllotTransport a ORDER BY a.id DESC ";
        $query = $this->getEntityManager()->createQuery($dql); 
        $allot = $query->getScalarResult();
		return new ViewModel(array('allot'=>$allot));
	}
	

	public function addrouteAction()
	{
		 $objectManager = $this->getEntityManager();
        
        $form = new RouteForm($objectManager);
        $route = new Route();
        $form->bind($route);
        
        $request = $this->getRequest();
        if ($request->isPost()) {
         
          $data = $request->getPost();
          
         $routei=$this->getEntityManager()->getRepository('Transport\Entity\Route')->findOneBy(array('name'=>$data['name']));
        
         ($form->setData($request->getPost()));
        
         if ($form->isValid()) {
                         if(isset($routei)){
                    $this->flashMessenger()->addErrorMessage('This Route Already Exist!');
                      // Redirect to List of section
                      return $this->redirect()->toRoute('transport', array('controller'=>'transport', 'action'=>'route'));                     
                  }
                  else {
                        
                         $this->flashMessenger()->addSuccessMessage('Route added successfully!');
                          $objectManager->persist($route);
                           $objectManager->flush();
                           //
                           return $this->redirect()->toRoute('transport', array('controller' => 'transport', 'action' => 'route'));
                  }
         }
        }
        return new ViewModel(
            array('form' => $form)
        );
	}

	 public function editrouteAction()
    { $entityManager =  $this->getEntityManager();

            $id = (int) $this->params()->fromRoute('id', 0);
            if (!$id) {
                return $this->redirect()->toRoute('transport', array('controller'=>'transport','action' => 'route'));
            }
            $guardian= $entityManager->find('Transport\Entity\Route', $id);
            if (!$guardian) {
                 return $this->redirect()->toRoute('guardian', array('controller'=>'guardian', 'action'=>'route'));     
            }  
           $form = new RouteForm($entityManager);
           $form->bind($guardian); 
           $form->get('submit')->setAttribute('value', 'Edit');
           $request = $this->getRequest();
            
            if ($request->isPost()) {
            //set data post and file ...    
            $form->setData($request->getPost()); 
            if ($form->isValid()) {
               //var_dump($form->getData());
                  $entityManager->persist($guardian);
                  $entityManager->flush();
                  return $this->redirect()->toRoute('transport', array('controller' => 'transport', 'action' => 'route'));
                }
            }
            
          return new ViewModel(array( 'form' => $form, 'id'=>$id ));
      }


         public function deleterouteAction()
		   {$id = $this->params()->fromRoute('id');
		    if (!$id) return $this->redirect()->toRoute('transport', array('controller' => 'transport', 'action' => 'route'));
		    $entityManager = $this->getEntityManager();
		        try {
		      $repository = $entityManager->getRepository('Transport\Entity\Route');
		      $session = $repository->find($id);
		      $entityManager->remove($session);
		      $entityManager->flush();
		      $this->flashMessenger()->addSuccessMessage('Route Deleted Successfully!');
		    //   $this->flashMessenger()->addSuccessMessage('Post Saved');
		        }
		        catch (\Exception $ex) {
		      $this->redirect()->toRoute('transport', array('controller' => 'transport', 'action' => 'route'));  
		        }
		    return $this->redirect()->toRoute('transport', array('controller' => 'transport', 'action' => 'route')); 
		   }



	public function addvehicleAction()
	{
		 $objectManager = $this->getEntityManager();
        
        $form = new VehicleForm($objectManager);
        $vehicle = new Vehicle();
        $form->bind($vehicle);
        
        $request = $this->getRequest();
        if ($request->isPost()) {
         
                        
           $dataForm = array_merge_recursive(
                $request->getPost()->toArray(),
                $request->getFiles()->toArray()
            );

            //var_dump($dataForm['name']);die;   
            
         $route=$this->getEntityManager()->getRepository('Transport\Entity\Vehicle')->findOneBy(array('name'=>$dataForm['name']));
        
         $form->setData($dataForm);
         //$form->setData(array('image' => $image));
        // var_dump($form);die;
        
         if ($form->isValid()) {
                         if(isset($route)){
                    $this->flashMessenger()->addErrorMessage('This Vehicle Already Exist!');
                      // Redirect to List of section
                      return $this->redirect()->toRoute('transport', array('controller'=>'transport', 'action'=>'vehicle'));                     
                  }
                  else {
                        
                         $this->flashMessenger()->addSuccessMessage('Vehicle added successfully!');
                          $objectManager->persist($vehicle);
                           $objectManager->flush();
                           //
                           return $this->redirect()->toRoute('transport', array('controller' => 'transport', 'action' => 'vehicle'));
                  }
         }
        }
        return new ViewModel(
            array('form' => $form)
        );
	}

	 public function editvehicleAction()
    { $entityManager =  $this->getEntityManager();

            $id = (int) $this->params()->fromRoute('id', 0);
            if (!$id) {
                return $this->redirect()->toRoute('transport', array('controller'=>'transport','action' => 'vehicle'));
            }
            $guardian= $entityManager->find('Transport\Entity\Vehicle', $id);
            if (!$guardian) {
                 return $this->redirect()->toRoute('transport', array('controller'=>'transport', 'action'=>'vehicle'));     
            }  
           $form = new VehicleForm($entityManager);
           $form->bind($guardian); 
           $form->get('submit')->setAttribute('value', 'Edit');
           $request = $this->getRequest();
            
            if ($request->isPost()) {
                          
           $dataForm = array_merge_recursive(
                $request->getPost()->toArray(),
                $request->getFiles()->toArray()
            );

           // var_dump($form);   
            $form->setData($dataForm);
            if ($form->isValid()) {
               //var_dump($form->getData());
                  $entityManager->persist($guardian);
                  $entityManager->flush();
                  return $this->redirect()->toRoute('transport', array('controller' => 'transport', 'action' => 'vehicle'));
                }
            }
            
          return new ViewModel(array( 'form' => $form, 'id'=>$id ));
      }


         public function deletevehicleAction()
		   {$id = $this->params()->fromRoute('id');
		    if (!$id) return $this->redirect()->toRoute('transport', array('controller' => 'transport', 'action' => 'vehicle'));
		    $entityManager = $this->getEntityManager();
		        try {
		      $repository = $entityManager->getRepository('Transport\Entity\Vehicle');
		      $session = $repository->find($id);
		      $entityManager->remove($session);
		      $entityManager->flush();
		      $this->flashMessenger()->addSuccessMessage('Vehicle Deleted Successfully!');
		    //   $this->flashMessenger()->addSuccessMessage('Post Saved');
		        }
		        catch (\Exception $ex) {
		      $this->redirect()->toRoute('transport', array('controller' => 'transport', 'action' => 'vehicle'));  
		        }
		    return $this->redirect()->toRoute('transport', array('controller' => 'transport', 'action' => 'vehicle')); 
		   }


		   	 public function processAction()
	{  $sefssion=$this->getEntityManager()->getRepository('Admin\Entity\Session')->findOneBy(array(), array('id' => 'DESC'));
     	$session=$sefssion->getId();

  

		$post =$this->getRequest()->getPost()->toArray();
		$vehicle = $_POST['vehicle'];
    	$route = $_POST['route'];
    	$driver = $_POST['driver'];
		$fare = $_POST['fare'];
		
		//var_dump($post);die;
    foreach( $route as $key => $n ) {
      $routeid=$this->getEntityManager()->getRepository('Transport\Entity\Route')->findOneBy(array('id'=>$n));
      $vehicleid=$this->getEntityManager()->getRepository('Transport\Entity\Vehicle')->findOneBy(array('id'=>$vehicle[$key]));
       $driverid=$this->getEntityManager()->getRepository('Admin\Entity\Staff')->findOneBy(array('id'=>$driver[$key]));
        
         $settings=$this->getEntityManager()->getRepository('Transport\Entity\SessionRoute')->findOneBy(array('route'=>$n,'session'=>$session,'vehicle'=>$vehicle[$key],'driver'=>$driver[$key]));
         if(isset($settings))
            { $settings->setRoute($routeid);
              $settings->setVehicle($vehicleid);
              $settings->setDriver($driverid);
              $settings->setFare($fare[$key]);
              $this->getEntityManager()->persist($settings);
            }
            else{
	          $settings= new SessionRoute();
	          $settings->setRoute($routeid);
	          $settings->setVehicle($vehicleid);
              $settings->setDriver($driverid);
              $settings->setFare($fare[$key]);
              $settings->setSession($sefssion);
              $this->getEntityManager()->persist($settings);
               }
      }
      
     $this->getEntityManager()->flush();
     return $this->redirect()->toRoute('transport', array('controller'=>'transport', 'action'=>'settings'));


		return new ViewModel();
	}


public function settingsAction()
{
		$sefssion=$this->getEntityManager()->getRepository('Admin\Entity\Session')->findOneBy(array(), array('id' => 'DESC'));
     	$session=$sefssion->getId();

	    $dql = "SELECT s FROM Transport\Entity\Route s ORDER BY s.id ASC ";
        $query = $this->getEntityManager()->createQuery($dql); 
        $routes = $query->getArrayResult();

        $dql = "SELECT s FROM Transport\Entity\Vehicle s ORDER BY s.id ASC ";
        $query = $this->getEntityManager()->createQuery($dql); 
        $vehicles = $query->getArrayResult();

        $dql = "SELECT d,t FROM Admin\Entity\Staff d LEFT JOIN d.stafftype t WHERE t.name=?1 ORDER BY d.id ASc ";
        $query = $this->getEntityManager()->createQuery($dql)->setParameters(array('1'=>'Driver'));
        $drivers = $query->getScalarResult();

        $dql = "SELECT s,se,y,t,r,v,d FROM Transport\Entity\SessionRoute s LEFT JOIN s.session se LEFT JOIN se.year y LEFT JOIN se.term t LEFT JOIN s.route r LEFT JOIN s.vehicle v LEFT JOIN s.driver d WHERE se.id=?1 ORDER BY s.id ASC ";
        $query = $this->getEntityManager()->createQuery($dql)->setParameters(array('1'=>$session));
        $sessionroutes = $query->getScalarResult();
       // var_dump($sessionroutes);die;

		return new ViewModel(array('sessionroutes'=>$sessionroutes,'drivers'=>$drivers,'routes'=>$routes,'vehicles'=>$vehicles,));
}

public function allotAction()
{
	$sefssion=$this->getEntityManager()->getRepository('Admin\Entity\Session')->findOneBy(array(), array('id' => 'DESC'));
     $session=$sefssion->getId();
	$objectManager = $this->getEntityManager();
        
        $form = new AllotTransportForm($objectManager);
        $tp = new AllotTransport();
        $form->bind($tp);
        
        $request = $this->getRequest();
        if ($request->isPost()) {
         
          $data = $request->getPost();
         
          //var_dump($data['student']);die;
          
         $route=$this->getEntityManager()->getRepository('Transport\Entity\AllotTransport')->findOneBy(array('student'=>$data['student'],'session'=>$session));
        
         $form->setData($request->getPost());
         //$form->setData(array('image' => $image));
        // var_dump($form);die;
        
         if ($form->isValid()) {
                         if(isset($route)){
                    $this->flashMessenger()->addErrorMessage('This student has been Alloted!');
                      // Redirect to List of section
                      return $this->redirect()->toRoute('transport', array('controller'=>'transport', 'action'=>'allotview'));                     
                  }
                  else {
                        
                         $this->flashMessenger()->addSuccessMessage('Student alloted successfully!');
                         $tp->setSession($sefssion);
                          $objectManager->persist($tp);
                           $objectManager->flush();
                           //
                           return $this->redirect()->toRoute('transport', array('controller' => 'transport', 'action' => 'allotview'));
                  }
         }
        }
        return new ViewModel(array('form' => $form));

}


	 public function editallotAction()
    { $entityManager =  $this->getEntityManager();

            $id = (int) $this->params()->fromRoute('id', 0);
            if (!$id) {
                return $this->redirect()->toRoute('transport', array('controller'=>'transport','action' => 'allotview'));
            }
            $guardian= $entityManager->find('Transport\Entity\AllotTransport', $id);
            if (!$guardian) {
                 return $this->redirect()->toRoute('transport', array('controller'=>'transport', 'action'=>'allotview'));     
            }  
           $form = new AllotTransportForm($entityManager);
           $form->bind($guardian); 
           $form->get('submit')->setAttribute('value', 'Edit');
           $request = $this->getRequest();
            
            if ($request->isPost()) {
            //set data post and file ...    
            $form->setData($request->getPost()); 
            if ($form->isValid()) {
               //var_dump($form->getData());
                  $entityManager->persist($guardian);
                  $entityManager->flush();
                  return $this->redirect()->toRoute('transport', array('controller' => 'transport', 'action' => 'allotview'));
                }
            }
            
          return new ViewModel(array( 'form' => $form, 'id'=>$id ));
      }


         public function deleteallotAction()
		   {$id = $this->params()->fromRoute('id');
		    if (!$id) return $this->redirect()->toRoute('transport', array('controller' => 'transport', 'action' => 'allotview'));
		    $entityManager = $this->getEntityManager();
		        try {
		      $repository = $entityManager->getRepository('Transport\Entity\AllotTransport');
		      $session = $repository->find($id);
		      $entityManager->remove($session);
		      $entityManager->flush();
		      $this->flashMessenger()->addSuccessMessage('Alloted Student Deleted Successfully!');
		    //   $this->flashMessenger()->addSuccessMessage('Post Saved');
		        }
		        catch (\Exception $ex) {
		      $this->redirect()->toRoute('transport', array('controller' => 'transport', 'action' => 'allotview'));  
		        }
		    return $this->redirect()->toRoute('transport', array('controller' => 'transport', 'action' => 'allotview')); 
		   }


		   public function allotviewAction()
{
		$dql = "SELECT s,st,p,se,y,t,sr,r,v,d FROM Transport\Entity\AllotTransport s LEFT JOIN s.student st LEFT JOIN st.person p LEFT JOIN s.session se LEFT JOIN se.year y LEFT JOIN se.term t LEFT JOIN s.route sr LEFT JOIN sr.route r LEFT JOIN sr.driver d LEFT JOIN sr.vehicle v  ORDER BY se.id DESC ";
        $query = $this->getEntityManager()->createQuery($dql);
        $allots = $query->getScalarResult();
       // var_dump($sessionroutes);die;

		return new ViewModel(array('allots'=>$allots));
}

       public function fareviewAction()
  {    $id = (int) $this->params()->fromRoute('id', 0);
            if (!$id) {
                return $this->redirect()->toRoute('transport', array('controller'=>'transport','action' => 'allotview'));
            }
      $session=$this->getServiceLocator()->get('Admin\Service\SettingsService')->getCurrentSession()->getId();
      $student=$this->getEntityManager()->getRepository('Transport\Entity\AllotTransport')->findOneBy(array('student'=>$id,'session'=>$session));
      $route=$student->getRoute()->getId();
      $paid=$student->getFare();
     // var_dump($paid);die;
     
      $settings=$this->getEntityManager()->getRepository('Transport\Entity\SessionRoute')->findOneBy(array('route'=>$route,'session'=>$session));
     //var_dump($route);die;
      $fare=$settings->getFare(); 

    return new ViewModel(array('student'=>$student,'fare'=>$fare,'paid'=>$paid,'settings'=>$settings));
    }
	
}
