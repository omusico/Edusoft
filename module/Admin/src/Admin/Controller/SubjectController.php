<?php
/**
 * Cloud Base School Management System
 *
 * @author Isaac Bitrus 
 * @copyright Copyright (c) 2015 Edusoft (http://www.edusoft.com.ng)
 */


namespace Admin\Controller;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Query;
use Admin\Entity\SubjectInterface;
use Admin\Form\SubjectForm;
use Admin\Service\SubjectServiceInterface;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class SubjectController extends AbstractActionController
{
      /**
     * @var EntityManager
     */
    private $entityManager;

    /**
     *
     * @varSubjectServiceInterface
     */
    private $subjectService;


    public function indexAction()
    {
        $viewModel = new ViewModel();
        $subjects = $this->getSubjectService()->getSubjectRepository()->findAll();

       
        $viewModel->setVariables(array(
            'subjects' => $subjects,
        ));
        return $viewModel;
    }

    public function addAction()
    {   $viewModel = new ViewModel();
        $form = new SubjectForm($this->getEntityManager());

        $request = $this->getRequest();
        if ($request->isPost()) {
            $form->setData($request->getPost());

            if ($form->isValid()) {
                /* @var $subject School */
                $subject = $form->getData();

                if ($this->getSubjectService()->addSubject($subject)) {
                    $this->FlashMessenger()->addSuccessMessage('New subject has been successfully added', 'Edusoft');
                } else {
                    $this->FlashMessenger()->addErrorMessage('Error occurred while adding new subject', 'Edusoft');
                }

                // Redirect to list of subjects
                return $this->redirect()->toRoute('subject', array('controller'=>'subject', 'action'=>'index'));
            }
        }

        $viewModel->setVariables(array(
            'form' => $form,
        ));

        return $viewModel;
    }

        /**
     * Handles subject editing
     *
     * @return ViewModel
     */
    public function editAction()
    {   $viewModel = new ViewModel();
        $id = (int) $this->params()->fromRoute('id', 0);

        if (!$id) {
            return $this->redirect()->toRoute('subject', array('controller'=>'subject','action' => 'add'));
        }

        $subject = $this->getSubjectlService()->getSubjectRepository()->find($id);

        if (!$subject) {
            return $this->redirect()->toRoute('subject', array('controller'=>'subject','action' => 'add'));
        }

        $form = new SubjectForm($this->getEntityManager());
        /* @var $form SubjectForm */
        $form->bind($subject);

        $request = $this->getRequest();
        if ($request->isPost()) {
            $form->setData($request->getPost());

            if ($form->isValid()) {
                $subject = $form->getData();

                if ($this->getSubjectService()->addSubject($subject)) {
                    $this->FlashMessenger()->addSuccessMessage('Subject have been successfully updated');
                } else {
                    $this->FlashMessenger()->addErrorMessage('Error occurred while updating subject');
                }

                // Redirect to list of subjects
                 return $this->redirect()->toRoute('subject', array('controller'=>'subject', 'action'=>'index')); 
            }
        }

        $viewModel->setVariables(array(
            'form' => $form,
            'id' => $id,
        ));

        return $viewModel;
    }

        public function deleteAction()
    {  
        $id = $this->params()->fromRoute('id');
        if (!$id) {
            return $this->redirect()->toRoute('subject', array('controller' => 'subject', 'action' => 'index'));
        }


        $subject = $this->getSubjectService()->getSubjectRepository()->find($id);

        if ($subject) {
            if ($this->getSubjectService()->deleteSubject($subject)) {
                $this->FlashMessenger()->addSuccessMessage('Subject have been successfully deleted');
            } else {
                $this->FlashMessenger()->addErrorMessage('Error occurred while deleting subject');
            }

            // Redirect to list of subjects
             return $this->redirect()->toRoute('subject', array('controller'=>'subject', 'action'=>'index')); 
        }
        else
        {
            $this->FlashMessenger()->addErrorMessage('Subject not found in the database');
            // Redirect to list of subjects
             return $this->redirect()->toRoute('subject', array('controller'=>'subject', 'action'=>'index')); 
        }
        

    }



   

    /**
     * Method used to inject subject service.
     *
     * @param SubjectServiceInterface $service
     */
    public function setSubjectService(SubjectServiceInterface $service)
    {
        $this->subjectService = $service;
    }

        /**
     * Method used to obtain subject service.
     *
     * @return SubjectService
     */
    public function getSchoolService()
    {
        return $this->subjectService;
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
}
