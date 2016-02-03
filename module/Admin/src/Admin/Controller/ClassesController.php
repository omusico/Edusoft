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
use Admin\Entity\ClassesInterface;
use Admin\Form\ClassesForm;
use Admin\Service\ClassesServiceInterface;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class ClassesController extends AbstractActionController
{
      /**
     * @var EntityManager
     */
    private $entityManager;

    /**
     *
     * @var ClassesServiceInterface
     */
    private $classesService;


    public function indexAction()
    {
        $viewModel = new ViewModel();
        $classes = $this->getClassesService()->getClassesRepository()->findAll();

       
        $viewModel->setVariables(array(
            'classes' => $classes,
        ));
        return $viewModel;
    }

    public function addAction()
    {   $viewModel = new ViewModel();
        $form = new ClassesForm($this->getEntityManager());

        $request = $this->getRequest();
        if ($request->isPost()) {
            $form->setData($request->getPost());

            if ($form->isValid()) {
                /* @var $lcass classes */
                $classes = $form->getData();

                 if ($this->getClassesService()->checkClass($classes)) {
                    $this->FlashMessenger()->addErrorMessage('This class already exist', 'Edusoft');
                }

                if ($this->getClassesService()->addClassesYear($classes)) {
                    $this->FlashMessenger()->addSuccessMessage('New class has been successfully added', 'Edusoft');
                } else {
                    $this->FlashMessenger()->addErrorMessage('Error occurred while adding new class', 'Edusoft');
                }

                // Redirect to list of classes
                return $this->redirect()->toRoute('classes', array('controller'=>'classes', 'action'=>'index'));
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
            return $this->redirect()->toRoute('classes', array('controller'=>'classes','action' => 'add'));
        }

        $class = $this->getClassesService()->getClassesRepository()->find($id);

        if (!$class) {
            return $this->redirect()->toRoute('classes', array('controller'=>'classes','action' => 'add'));
        }

        $form = new ClassesForm($this->getEntityManager());
        /* @var $form YearForm */
        $form->bind($class);

        $request = $this->getRequest();
        if ($request->isPost()) {
            $form->setData($request->getPost());

            if ($form->isValid()) {
                $class = $form->getData();

                if ($this->getClassesService()->addClassesYear($class)) {
                    $this->FlashMessenger()->addSuccessMessage('Class have been successfully updated');
                } else {
                    $this->FlashMessenger()->addErrorMessage('Error occurred while updating year');
                }

                // Redirect to list of products
                 return $this->redirect()->toRoute('classes', array('controller'=>'classes', 'action'=>'index')); 
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
            return $this->redirect()->toRoute('classes', array('controller' => 'classes', 'action' => 'index'));
        }


        $class = $this->getClassesrService()->getClassesRepository()->find($id);

        if ($class) {
            if ($this->getClassesService()->deleteClassesr($class)) {
                $this->FlashMessenger()->addSuccessMessage('Class have been successfully deleted');
            } else {
                $this->FlashMessenger()->addErrorMessage('Error occurred while deleting class');
            }

            // Redirect to list of classes
             return $this->redirect()->toRoute('classes', array('controller'=>'classes', 'action'=>'index')); 
        }
        else
        {
            $this->FlashMessenger()->addErrorMessage('Class not found in the database');
            // Redirect to list of classes
             return $this->redirect()->toRoute('classes', array('controller'=>'classes', 'action'=>'index')); 
        }
        

    }

      
        

    }



   

    /**
     * Method used to inject year service.
     *
     * @param ClassesServiceInterface $service
     */
    public function setClassesService(ClassesServiceInterface $service)
    {
        $this->classesService = $service;
    }

        /**
     * Method used to obtain classes service.
     *
     * @return classesService
     */
    public function getClassesService()
    {
        return $this->classesService;
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
