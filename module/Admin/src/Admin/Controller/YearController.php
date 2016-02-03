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
use Admin\Entity\YearInterface;
use Admin\Form\YearForm;
use Admin\Service\YearServiceInterface;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class YearController extends AbstractActionController
{
      /**
     * @var EntityManager
     */
    private $entityManager;

    /**
     *
     * @var YearServiceInterface
     */
    private $yearService;


    public function indexAction()
    {
        $viewModel = new ViewModel();
        $years = $this->getYearService()->getYearRepository()->findAll();

       
        $viewModel->setVariables(array(
            'years' => $years,
        ));
        return $viewModel;
    }

    public function yearsAction() {
       $years = $this->getYearService()->getYearRepository()->years();

       
        return new JsonModel(array(
            'data' => $years)
        );
    }

    public function addAction()
    {   $viewModel = new ViewModel();
        $form = new YearForm($this->getEntityManager());

        $request = $this->getRequest();
        if ($request->isPost()) {
            $form->setData($request->getPost());

            if ($form->isValid()) {
                /* @var $year Year */
                $year = $form->getData();

                if ($this->getYearService()->addYear($year)) {
                    $this->FlashMessenger()->addSuccessMessage('New year has been successfully added', 'Edusoft');
                } else {
                    $this->FlashMessenger()->addErrorMessage('Error occurred while adding new year', 'Edusoft');
                }

                // Redirect to list of companies
                return $this->redirect()->toRoute('year', array('controller'=>'year', 'action'=>'index'));
            }
        }

        $viewModel->setVariables(array(
            'form' => $form,
        ));

        return $viewModel;
    }

        /**
     * Handles year editing
     *
     * @return ViewModel
     */
    public function editAction()
    {   $viewModel = new ViewModel();
        $id = (int) $this->params()->fromRoute('id', 0);

        if (!$id) {
            return $this->redirect()->toRoute('year', array('controller'=>'year','action' => 'add'));
        }

        $year = $this->getYearService()->getYearRepository()->find($id);

        if (!$year) {
            return $this->redirect()->toRoute('year', array('controller'=>'year','action' => 'add'));
        }

        $form = new YearForm($this->getEntityManager());
        /* @var $form YearForm */
        $form->bind($year);

        $request = $this->getRequest();
        if ($request->isPost()) {
            $form->setData($request->getPost());

            if ($form->isValid()) {
                $year = $form->getData();

                if ($this->getYearService()->addYear($year)) {
                    $this->FlashMessenger()->addSuccessMessage('Year have been successfully updated');
                } else {
                    $this->FlashMessenger()->addErrorMessage('Error occurred while updating year');
                }

                // Redirect to list of products
                 return $this->redirect()->toRoute('year', array('controller'=>'year', 'action'=>'index')); 
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
            return $this->redirect()->toRoute('year', array('controller' => 'year', 'action' => 'index'));
        }


        $year = $this->getYearService()->getYearRepository()->find($id);

        if ($year) {
            if ($this->getYearService()->deleteYear($year)) {
                $this->FlashMessenger()->addSuccessMessage('Year have been successfully deleted');
            } else {
                $this->FlashMessenger()->addErrorMessage('Error occurred while deleting year');
            }

            // Redirect to list of years
             return $this->redirect()->toRoute('year', array('controller'=>'year', 'action'=>'index')); 
        }
        else
        {
            $this->FlashMessenger()->addErrorMessage('Year not found in the database');
            // Redirect to list of years
             return $this->redirect()->toRoute('year', array('controller'=>'year', 'action'=>'index')); 
        }
        

    }



   

    /**
     * Method used to inject year service.
     *
     * @param YearServiceInterface $service
     */
    public function setYearService(YearServiceInterface $service)
    {
        $this->yearService = $service;
    }

        /**
     * Method used to obtain year service.
     *
     * @return SemesterService
     */
    public function getYearService()
    {
        return $this->yearService;
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
