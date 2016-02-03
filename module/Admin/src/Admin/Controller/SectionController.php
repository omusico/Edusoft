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
use Admin\Entity\SectionInterface;
use Admin\Form\SectionForm;
use Admin\Service\SectionServiceInterface;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class SectionController extends AbstractActionController
{
      /**
     * @var EntityManager
     */
    private $entityManager;

    /**
     *
     * @var SectionServiceInterface
     */
    private $sectionService;


    public function indexAction()
    {
        $viewModel = new ViewModel();
        $sections = $this->getSectionService()->getSectionRepository()->findAll();

       
        $viewModel->setVariables(array(
            'sections' => $sections,
        ));
        return $viewModel;
    }

    public function addAction()
    {   $viewModel = new ViewModel();
        $form = new SectionForm($this->getEntityManager());

        $request = $this->getRequest();
        if ($request->isPost()) {
            $form->setData($request->getPost());

            if ($form->isValid()) {
                /* @var $sections Section */
                $section = $form->getData();

                if ($this->getSectionService()->addSection($section)) {
                    $this->FlashMessenger()->addSuccessMessage('New section has been successfully added', 'Edusoft');
                } else {
                    $this->FlashMessenger()->addErrorMessage('Error occurred while adding new section', 'Edusoft');
                }

                // Redirect to list of sections
                return $this->redirect()->toRoute('section', array('controller'=>'section', 'action'=>'index'));
            }
        }

        $viewModel->setVariables(array(
            'form' => $form,
        ));

        return $viewModel;
    }

        /**
     * Handles section editing
     *
     * @return ViewModel
     */
    public function editAction()
    {   $viewModel = new ViewModel();
        $id = (int) $this->params()->fromRoute('id', 0);

        if (!$id) {
            return $this->redirect()->toRoute('section', array('controller'=>'section','action' => 'add'));
        }

        $section = $this->getSectionService()->getSectionRepository()->find($id);

        if (!$section) {
            return $this->redirect()->toRoute('section', array('controller'=>'section','action' => 'add'));
        }

        $form = new SectionForm($this->getEntityManager());
        /* @var $form section  */
        $form->bind($section);

        $request = $this->getRequest();
        if ($request->isPost()) {
            $form->setData($request->getPost());

            if ($form->isValid()) {
                $section = $form->getData();

                if ($this->getSectionService()->addSection($section)) {
                    $this->FlashMessenger()->addSuccessMessage('Section have been successfully updated');
                } else {
                    $this->FlashMessenger()->addErrorMessage('Error occurred while updating section');
                }

                // Redirect to list of section
                 return $this->redirect()->toRoute('section', array('controller'=>'section', 'action'=>'index')); 
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
            return $this->redirect()->toRoute('section', array('controller' => 'section', 'action' => 'index'));
        }


        $section = $this->getSectionService()->getSectionRepository()->find($id);

        if ($section) {
            if ($this->getSectionService()->deleteSection($section)) {
                $this->FlashMessenger()->addSuccessMessage('Section have been successfully deleted');
            } else {
                $this->FlashMessenger()->addErrorMessage('Error occurred while deleting section');
            }

            // Redirect to list of section
             return $this->redirect()->toRoute('section', array('controller'=>'section', 'action'=>'index')); 
        }
        else
        {
            $this->FlashMessenger()->addErrorMessage('Section not found in the database');
            // Redirect to list of section
             return $this->redirect()->toRoute('section', array('controller'=>'section', 'action'=>'index')); 
        }
        

    }



   

    /**
     * Method used to inject Section service.
     *
     * @param SectionServiceInterface $service
     */
    public function setSectionService(SectionServiceInterface $service)
    {
        $this->sectionService = $service;
    }

        /**
     * Method used to obtain section service.
     *
     * @return SectionService
     */
    public function getSectionService()
    {
        return $this->sectionService;
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
