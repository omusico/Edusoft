<?php
/**
 * Cloud Base Educational Management System
 *
 * @author Isaac Bitrus 
 * @copyright Copyright (c) 2015 Edusoft (http://www.edusoft.com.ng)
 */
 
namespace Admin\Form;
use DoctrineModule\Persistence\ObjectManagerAwareInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Zend\Form\Form;

class ClassesForm extends Form implements ObjectManagerAwareInterface
{ protected $objectManager;
    public function __construct(ObjectManager $objectManager)
    {   $this->setObjectManager($objectManager);

        parent::__construct('classes');
        $this->setAttribute('method', 'post');
       

         $this->add(array(
            'name' => 'section',
            'type' => 'DoctrineModule\Form\Element\ObjectSelect',
            'options' => array(
                'label' => 'section',
                'empty_option' => 'Select Section',
                'object_manager' => $this->getObjectManager(),
                'target_class' => 'Admin\Entity\Section',
                'property' => 'name'
            ),
            'attributes' => array(
                'required' => true,
                'class' =>'select2'
            )
        ));


        $this->add(array(
            'name' => 'initial',
            'type' => 'DoctrineModule\Form\Element\ObjectSelect',
            'options' => array(
                'label' => 'initial',
                'empty_option' => 'Select Initial',
                'object_manager' => $this->getObjectManager(),
                'target_class' => 'Admin\Entity\Initial',
                'property' => 'name'
            ),
            'attributes' => array(
                'required' => true,
                'class' =>'select2'
            )
        ));

        $this->add(array(
            'name' => 'arm',
            'type' => 'DoctrineModule\Form\Element\ObjectSelect',
            'options' => array(
                'label' => 'arm',
                'empty_option' => 'Select Arm',
                'object_manager' => $this->getObjectManager(),
                'target_class' => 'Admin\Entity\Arms',
                'property' => 'name'
            ),
            'attributes' => array(
                'required' => true,
                'class' =>'select2'
            )
        ));

       
            
        $this->add(array(
            'name' => 'submit',
            'attributes' => array(
                'type'  => 'submit',
                'value' => 'New class',
                'class' => 'btn btn-primary',
            ),
        )); 
    }
    public function setObjectManager(ObjectManager $objectManager)
    {
        $this->objectManager = $objectManager;

        return $this;
    }

    public function getObjectManager()
    {
        return $this->objectManager;
    }
}