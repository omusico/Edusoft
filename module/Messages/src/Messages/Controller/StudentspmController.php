<?php

namespace Messages\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject as DoctrineHydrator;
use Zend\InputFilter\InputFilter;
use Zend\Crypt\Password\Bcrypt;
use Zend\View\Model\JsonModel;
use Zend\Form\Form;

use Messages\Form\MessageForm;
use Messages\Entity\Messages;
use Messages\Entity\Receivers;

class StudentspmController extends AbstractActionController
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
	


    public function colleaguesAction()
  {  
        $entityManager = $this->getEntityManager();
        //get the current session
        $session=$this->getServiceLocator()->get('Admin\Service\SettingsService')->getCurrentSession()->getId(); 
         //get the current user id
        $from = $this->zfcUserAuthentication()->getIdentity(); 
        //get the current user class
        $class=$entityManager->getRepository('Admin\Entity\Student')->findOneby(array('user'=>$from->getId())); 
        $currentclass=$class->getCurrentClass()->getId();
        //get all the teachers in the user current class in current session
        $class=$entityManager->getRepository('Admin\Entity\Student')->findBy(array('class'=>$currentclass)); 
   
          
                
                 if ($this->getRequest()->isPost()) {
            //sender
            $from = $this->zfcUserAuthentication()->getIdentity();   
           //message entity
           $messages = new Messages();
            
            $tos = (array) $_POST['to'];
            $subject = $_POST['subject'];
            $message = $_POST['message'];
           // var_dump($tos);die;
            //persist to message
            $messages->setFrom($from);
            $messages->setSubject($subject);
            $messages->setMessage($message);
            $entityManager->persist($messages);
            $entityManager->flush();

            //persist to receiver
              $receiver=$entityManager->getRepository('EduUser\Entity\User')->findBy(array('id'=>$tos));
          /// var_dump($receiver);die;
                foreach ($receiver as $to) {
                  $this->sendMessage($messages, $to);
            }

          $this->flashMessenger()->addSuccessMessage('Message Sent Successfully!');
         return $this->redirect()->toRoute('studentspm', array('controller'=>'studentspm', 'action'=>'inbox'));
     
        }  
        return new ViewModel(array ('class' =>$class));
  }

 
    public function teachersAction()
  {  
        $entityManager = $this->getEntityManager();
        //get the current session
        $session=$this->getServiceLocator()->get('Admin\Service\SettingsService')->getCurrentSession()->getId(); 
         //get the current user id
        $from = $this->zfcUserAuthentication()->getIdentity(); 
        //get the current user class
        $class=$entityManager->getRepository('Admin\Entity\Student')->findOneby(array('user'=>$from->getId())); 
        $currentclass=$class->getCurrentClass()->getId();
        //get all the teachers in the user current class in current session
        $class=$entityManager->getRepository('Admin\Entity\Teacher')->findBy(array('session'=>$session,'class'=>$currentclass)); 
   
          
                
                 if ($this->getRequest()->isPost()) {
            //sender
            $from = $this->zfcUserAuthentication()->getIdentity();   
           //message entity
           $messages = new Messages();
            
            $tos = (array) $_POST['to'];
            $subject = $_POST['subject'];
            $message = $_POST['message'];
           // var_dump($tos);die;
            //persist to message
            $messages->setFrom($from);
            $messages->setSubject($subject);
            $messages->setMessage($message);
            $entityManager->persist($messages);
            $entityManager->flush();

            //persist to receiver
              $receiver=$entityManager->getRepository('EduUser\Entity\User')->findBy(array('id'=>$tos));
          /// var_dump($receiver);die;
                foreach ($receiver as $to) {
                  $this->sendMessage($messages, $to);
            }

          $this->flashMessenger()->addSuccessMessage('Message Sent Successfully!');
         return $this->redirect()->toRoute('studentspm', array('controller'=>'studentspm', 'action'=>'inbox'));
     
        }  
        return new ViewModel(array ('class' =>$class));
  }


  

  public function sendMessage($messages, $to){
   //  var_dump($to);die;
     $entityManager = $this->getEntityManager();
             $receivers = new Receivers();
              $receivers->setTo($to);
              $receivers->setMessages($messages);
              $receivers->setUnread(0);
              $receivers->setDeleted(0);
              $entityManager->persist($receivers);
              $entityManager->flush();
  }

   public function deleteAction()
  {   
      $data=(int)$_POST['state'];
      $id = $this->zfcUserAuthentication()->getIdentity()->getId();  
      $ice=$this->getEntityManager()->getRepository('Messages\Entity\Receivers')->findOneby(array('to'=>$id,'messages'=>$data));
      $ice->setDeleted(1);
      $this->getEntityManager()->persist($ice);
      $this->getEntityManager()->flush($ice);
      return $this->redirect()->toRoute('messages', array('controller'=>'messages', 'action'=>'inbox'));
   // return new ViewModel(array('lists'=>$lists));
  }

  public function openedAction()
  {   
      $data=(int)$_POST['state'];
      $id = $this->zfcUserAuthentication()->getIdentity()->getId();  
      $dql = "SELECT l,u,m FROM \Messages\Entity\Receivers l LEFT JOIN l.messages m LEFT JOIN m.from u WHERE l.to=?1 and l.messages=?2 ";
      $query = $this->getEntityManager()->createQuery($dql)->setParameters(array(1=>$id,2=>$data)); 
      $lists = $query->getScalarResult();
     // $ice=$this->getEntityManager()->getRepository('Messages\Entity\Receivers')->findOneby(array('to'=>$id,'messages'=>$data));
   // var_dump($lists);die;
    return new ViewModel(array('lists'=>$lists));
  }

  public function listAction()
  {   $id = $this->zfcUserAuthentication()->getIdentity()->getId();  
      $dql = "SELECT l,u,m FROM \Messages\Entity\Receivers l LEFT JOIN l.messages m LEFT JOIN m.from u WHERE l.to=?1 and l.deleted=?2 ORDER BY l.id DESC ";
      $query = $this->getEntityManager()->createQuery($dql)->setParameters(array(1=>$id,2=>0)); 
      $lists = $query->getScalarResult();
     // var_dump($lists);die;
    return new ViewModel(array('lists'=>$lists));
  }


  public function inboxAction()
  {   $id = $this->zfcUserAuthentication()->getIdentity()->getId();  
      $dql = "SELECT count(l.id) as inboxt FROM \Messages\Entity\Receivers l WHERE l.to=?1  ";
      $query = $this->getEntityManager()->createQuery($dql)->setParameters(array(1=>$id)); 
      $total = $query->getSingleScalarResult();

      $dql = "SELECT count(l.id) as inboxt FROM \Messages\Entity\Messages l WHERE l.from=?1  ";
      $query = $this->getEntityManager()->createQuery($dql)->setParameters(array(1=>$id)); 
      $sent = $query->getSingleScalarResult();
    return new ViewModel(array('total'=>$total,'sent'=>$sent));
  }

    public function sentAction()
  {   $id = $this->zfcUserAuthentication()->getIdentity()->getId();  
      $dql = "SELECT r,s FROM \Messages\Entity\Receivers r LEFT JOIN r.from s  WHERE s.id=?1 GROUP BY s.id ORDER BY s.id DESC ";
      $query = $this->getEntityManager()->createQuery($dql)->setParameters(array(1=>$id)); 
      $lists = $query->getScalarResult();
    return new ViewModel(array('lists'=>$lists));
  }
   

}
