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
use Admin\Entity\Term;
use Admin\Form\TermForm;
use Admin\Service\TermService;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class TermController extends AbstractActionController
{
  

    /**
     *
     * @var TermService
     */
    private $termService;

        /**
     *
     * @var EntityManager
     */
    private $entityManager;


    public function indexAction()
    {   $viewModel = new ViewModel();
        $terms = $this->getTermService()->getTermRepository()->findAll();

       
        $viewModel->setVariables(array(
            'terms' => $terms,
        ));
        return $viewModel;
    }

    public function addAction()
    {   $viewModel = new ViewModel();
        $form = new TermForm($this->getEntityManager());

        $request = $this->getRequest();
        if ($request->isPost()) {
            $form->setData($request->getPost());

            if ($form->isValid()) {
                /* @var $term Term */
                $term = $form->getData();

                if ($this->getTermService()->addTerm($term)) {
                    $this->FlashMessenger()->addSuccessMessage('New term has been successfully added', 'Edusoft');
                } else {
                    $this->FlashMessenger()->addErrorMessage('Error occurred while adding new term', 'Edusoft');
                }

                // Redirect to list of companies
                return $this->redirect()->toRoute('term', array('controller'=>'term', 'action'=>'index'));
            }
        }

        $viewModel->setVariables(array(
            'form' => $form,
        ));

        return $viewModel;
    }

            /**
     * Handles terms editing
     *
     * @return ViewModel
     */
    public function editAction()
    {   $viewModel = new ViewModel();
        $id = (int) $this->params()->fromRoute('id', 0);

        if (!$id) {
            return $this->redirect()->toRoute('term', array('controller'=>'term','action' => 'add'));
        }

        $term = $this->getTermService()->getTermRepository()->find($id);

        if (!$term) {
            return $this->redirect()->toRoute('term', array('controller'=>'term','action' => 'add'));
        }

        $form = new TermForm($this->getEntityManager());
        /* @var $form TermForm */
        $form->bind($term);

        $request = $this->getRequest();
        if ($request->isPost()) {
            $form->setData($request->getPost());

            if ($form->isValid()) {
                $term = $form->getData();

                if ($this->getTermService()->addTerm($term)) {
                    $this->FlashMessenger()->addSuccessMessage('Term have been successfully updated');
                } else {
                    $this->FlashMessenger()->addErrorMessage('Error occurred while updating term');
                }

                // Redirect to list of term
                 return $this->redirect()->toRoute('term', array('controller'=>'term', 'action'=>'index')); 
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
            return $this->redirect()->toRoute('term', array('controller' => 'term', 'action' => 'index'));
        }


        $term = $this->getTermService()->geTermRepository()->find($id);

        if ($term) {
            if ($this->getTermService()->deleteTerm($term)) {
                $this->FlashMessenger()->addSuccessMessage('Term have been successfully deleted');
            } else {
                $this->FlashMessenger()->addErrorMessage('Error occurred while deleting term');
            }

            // Redirect to list of terms
             return $this->redirect()->toRoute('term', array('controller'=>'term', 'action'=>'index')); 
        }
        else
        {
            $this->FlashMessenger()->addErrorMessage('Semester not found in the database');
            // Redirect to list of semesters
             return $this->redirect()->toRoute('semester', array('controller'=>'semester', 'action'=>'index')); 
        }
        

    }


   

    /**
     * Method used to inject term service.
     *
     * @param TermService $service
     */
    public function setTermService(TermService $service)
    {
        $this->termService = $service;
    }

    /**
     * Method used to obtain term service.
     *
     * @return TermService
     */
    public function getTermService()
    {
        return $this->termService;
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
