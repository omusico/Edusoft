<?php
/**
 * Cloud Base School Management System
 *
 * @author Isaac Bitrus 
 * @copyright Copyright (c) 2015 Edusoft (http://www.edusoft.com.ng)
 */


namespace Applicant\Controller;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Query;
use Applicant\Entity\ApplicantInterface;
use Applicant\Form\ApplicantForm;
use Applicant\Service\ApplicantServiceInterface;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class ApplicantController extends AbstractActionController
{
      /**
     * @var EntityManager
     */
    private $entityManager;

    /**
     *
     * @var SchoolServiceInterface
     */
    private $schoolService;


    public function dashboardAction()
    {   //check to see if the login applicant has completed his/her profile
        if(!$this->getApplicantService()->checkProfile()){
          $this->FlashMessenger()->addSuccessMessage('Please complete your profile information', 'Edusoft');
          return $this->redirect()->toRoute('applicant', array('controller'=>'applicant', 'action'=>'add'));
        }
        
        $viewModel = new ViewModel();
        $applicants = $this->getApplicantService()->getApplicantRepository()->findAll();

       
        $viewModel->setVariables(array(
            'applicants' => $applicants,
        ));
        return $viewModel;
    }

    //list of current academic-year applicant
     public function indexAction()
    {  
        $viewModel = new ViewModel();
        $applicants = $this->getApplicantService()->getApplicantRepository()->findAll();

       
        $viewModel->setVariables(array(
            'applicants' => $applicants,
        ));
        return $viewModel;
    }

    public function addAction()
    {   $viewModel = new ViewModel();
      $entityManager = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');
        $form = new ApplicantForm($entityManager);

        $request = $this->getRequest();
        if ($request->isPost()) {
            $dataForm = array_merge_recursive(
                $request->getPost()->toArray(),
                $request->getFiles()->toArray()
            );
            $form->setData($dataForm);

            if ($form->isValid()) {
                /* @var $applicant School */
                $applicant = $form->getData();

                if ($this->getApplicantService()->addApplicant($applicant)) {
                    $this->FlashMessenger()->addSuccessMessage('Profile Information has been successfully added', 'Edusoft');
                } else {
                    $this->FlashMessenger()->addErrorMessage('Error occurred while adding profile information', 'Edusoft');
                }

                // Redirect to list of applicants
                return $this->redirect()->toRoute('applicant', array('controller'=>'applicant', 'action'=>'index'));
            }
        }

        $viewModel->setVariables(array(
            'form' => $form,
        ));

        return $viewModel;
    }

        /**
     * Handles school editing
     *
     * @return ViewModel
     */
    public function editAction()
    {   $viewModel = new ViewModel();
        $id = (int) $this->params()->fromRoute('id', 0);

        if (!$id) {
            return $this->redirect()->toRoute('school', array('controller'=>'school','action' => 'add'));
        }

        $school = $this->getSchoolService()->getSchoolRepository()->find($id);

        if (!$school) {
            return $this->redirect()->toRoute('school', array('controller'=>'school','action' => 'add'));
        }

        $form = new SchoolForm($this->getEntityManager());
        /* @var $form DepartmentForm */
        $form->bind($school);

        $request = $this->getRequest();
        if ($request->isPost()) {
            $form->setData($request->getPost());

            if ($form->isValid()) {
                $school = $form->getData();

                if ($this->getSchoolService()->addSchool($school)) {
                    $this->FlashMessenger()->addSuccessMessage('School have been successfully updated');
                } else {
                    $this->FlashMessenger()->addErrorMessage('Error occurred while updating school');
                }

                // Redirect to list of schools
                 return $this->redirect()->toRoute('school', array('controller'=>'school', 'action'=>'index')); 
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
            return $this->redirect()->toRoute('school', array('controller' => 'school', 'action' => 'index'));
        }


        $school = $this->getSchoolService()->getSchoolRepository()->find($id);

        if ($school) {
            if ($this->getSchoolService()->deleteSchool($school)) {
                $this->FlashMessenger()->addSuccessMessage('School have been successfully deleted');
            } else {
                $this->FlashMessenger()->addErrorMessage('Error occurred while deleting school');
            }

            // Redirect to list of schools
             return $this->redirect()->toRoute('school', array('controller'=>'school', 'action'=>'index')); 
        }
        else
        {
            $this->FlashMessenger()->addErrorMessage('School not found in the database');
            // Redirect to list of schools
             return $this->redirect()->toRoute('school', array('controller'=>'school', 'action'=>'index')); 
        }
        

    }



   

    /**
     * Method used to inject school service.
     *
     * @param SchoolServiceInterface $service
     */
    public function setSchoolService(SchoolServiceInterface $service)
    {
        $this->schoolService = $service;
    }

        /**
     * Method used to obtain school service.
     *
     * @return SchoolService
     */
    public function getSchoolService()
    {
        return $this->schoolService;
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
