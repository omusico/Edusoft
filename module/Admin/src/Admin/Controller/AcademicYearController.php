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
use Admin\Entity\AcademicYearInterface;
use Admin\Form\AcademicYearForm;
use Admin\Service\AcademicYearServiceInterface;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class AcademicYearController extends AbstractActionController
{
      /**
     * @var EntityManager
     */
    private $entityManager;

    /**
     *
     * @var AcademicYearServiceInterface
     */
    private $academicyearService;


    public function indexAction()
    {
        $viewModel = new ViewModel();
        $academicyears = $this->getAcademicYearService()->getAcademicYearRepository()->findAll();

       
        $viewModel->setVariables(array(
            'academicyears' => $academicyears,
        ));
        return $viewModel;
    }

    public function addAction()
    {   $viewModel = new ViewModel();
        $form = new AcademicYearForm($this->getEntityManager());

        $request = $this->getRequest();
        if ($request->isPost()) {
            $form->setData($request->getPost());

            if ($form->isValid()) {
                /* @var $year Year */
                $academicyear = $form->getData();

                if ($this->getAcademicYearService()->addAcademicYear($academicyear)) {
                    $this->FlashMessenger()->addSuccessMessage('New academic-year has been successfully added', 'Edusoft');
                } else {
                    $this->FlashMessenger()->addErrorMessage('Error occurred while adding new academic-year', 'Edusoft');
                }

                // Redirect to list of companies
                return $this->redirect()->toRoute('academic-year', array('controller'=>'academicyear', 'action'=>'index'));
            }
        }

        $viewModel->setVariables(array(
            'form' => $form,
        ));

        return $viewModel;
    }

        /**
     * Handles academic-year editing
     *
     * @return ViewModel
     */
    public function editAction()
    {   $viewModel = new ViewModel();
        $id = (int) $this->params()->fromRoute('id', 0);

        if (!$id) {
            return $this->redirect()->toRoute('academic-year', array('controller'=>'academicyear','action' => 'add'));
        }

        $academicyear = $this->getAcademicYearService()->getAcademicYearRepository()->find($id);

        if (!$academicyear) {
            return $this->redirect()->toRoute('academic-year', array('controller'=>'academicyear','action' => 'add'));
        }

        $form = new AcademicYearForm($this->getEntityManager());
        /* @var $form YearForm */
        $form->bind($academicyear);

        $request = $this->getRequest();
        if ($request->isPost()) {
            $form->setData($request->getPost());

            if ($form->isValid()) {
                $academicyear = $form->getData();

                if ($this->getAcademicYearService()->addAcademicYear($academicyear)) {
                    $this->FlashMessenger()->addSuccessMessage('Academic-Year have been successfully updated');
                } else {
                    $this->FlashMessenger()->addErrorMessage('Error occurred while updating year');
                }

                // Redirect to list of products
                 return $this->redirect()->toRoute('academic-year', array('controller'=>'academicyear', 'action'=>'index')); 
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
            return $this->redirect()->toRoute('academic-year', array('controller' => 'academicyear', 'action' => 'index'));
        }


        $academicyear = $this->getAcademicYearService()->getAcademicYearRepository()->find($id);

        if ($academicyear) {
            if ($this->getAcademicYearService()->deleteAcademicYear($academicyear)) {
                $this->FlashMessenger()->addSuccessMessage('Academic-Year have been successfully deleted');
            } else {
                $this->FlashMessenger()->addErrorMessage('Error occurred while deleting year');
            }

            // Redirect to list of years
             return $this->redirect()->toRoute('academic-year', array('controller'=>'academicyear', 'action'=>'index')); 
        }
        else
        {
            $this->FlashMessenger()->addErrorMessage('Academic-Year not found in the database');
            // Redirect to list of years
             return $this->redirect()->toRoute('academic-year', array('controller'=>'academicyear', 'action'=>'index')); 
        }
        

    }

      public function openAction()
    {  
        $id = $this->params()->fromRoute('id');
        if (!$id) {
            return $this->redirect()->toRoute('academic-year', array('controller' => 'academicyear', 'action' => 'index'));
        }


        $academicyear = $this->getAcademicYearService()->getAcademicYearRepository()->find($id);

        if ($academicyear) {
            if ($this->getAcademicYearService()->open($academicyear)) {
                $this->FlashMessenger()->addSuccessMessage('Academic-Year have been successfully opened');
            } else {
                $this->FlashMessenger()->addErrorMessage('Error occurred while opening year');
            }

            // Redirect to list of years
             return $this->redirect()->toRoute('academic-year', array('controller'=>'academicyear', 'action'=>'index')); 
        }
        else
        {
            $this->FlashMessenger()->addErrorMessage('Academic-Year not found in the database');
            // Redirect to list of years
             return $this->redirect()->toRoute('academic-year', array('controller'=>'academicyear', 'action'=>'index')); 
        }
        

    }

     public function closeAction()
    {  
        $id = $this->params()->fromRoute('id');
        if (!$id) {
            return $this->redirect()->toRoute('academic-year', array('controller' => 'academicyear', 'action' => 'index'));
        }


        $academicyear = $this->getAcademicYearService()->getAcademicYearRepository()->find($id);

        if ($academicyear) {
            if ($this->getAcademicYearService()->close($academicyear)) {
                $this->FlashMessenger()->addSuccessMessage('Academic-Year have been successfully closed');
            } else {
                $this->FlashMessenger()->addErrorMessage('Error occurred while closing year');
            }

            // Redirect to list of years
             return $this->redirect()->toRoute('academic-year', array('controller'=>'academicyear', 'action'=>'index')); 
        }
        else
        {
            $this->FlashMessenger()->addErrorMessage('Academic-Year not found in the database');
            // Redirect to list of years
             return $this->redirect()->toRoute('academic-year', array('controller'=>'academicyear', 'action'=>'index')); 
        }
        

    }



   

    /**
     * Method used to inject year service.
     *
     * @param AcademicYearServiceInterface $service
     */
    public function setAcademicYearService(AcademicYearServiceInterface $service)
    {
        $this->academicyearService = $service;
    }

        /**
     * Method used to obtain year service.
     *
     * @return academicyearService
     */
    public function getAcademicYearService()
    {
        return $this->academicyearService;
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
