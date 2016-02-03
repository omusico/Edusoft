<?php
/**
 * Cloud Base School Management System
 *
 * @author Isaac Bitrus 
 * @copyright Copyright (c) 2015 Edusoft (http://www.edusoft.com.ng)
 */
 
namespace Admin\Form;

use Admin\Entity\Classes;
use Zend\Form\Form;
use Doctrine\Common\Persistence\ObjectManager;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject as DoctrineHydrator;

class ClassesForm extends Form
{   protected $objectManager;

    public function __construct(ObjectManager $objectManager)
    {
         parent::__construct('classes');
         $this->setAttribute('method', 'post');
         $this->setHydrator(new DoctrineHydrator($objectManager))
             ->setObject(new Classes());
             $this->objectManager=$objectManager;
   
       

         $this->add(array(
            'name' => 'section',
            'type' => 'DoctrineModule\Form\Element\ObjectSelect',
            'options' => array(
                'label' => 'section',
                'empty_option' => 'Select Section',
                'object_manager' => $objectManager,
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
            'type' => 'Zend\Form\Element\Select',
            'options' => array(
                'label' => 'religion',
                'empty_option' => 'Select Initial',
                'value_options' => array(
                    '1' => '1',
                    '2' => '2',
                    '3' => '3',
                    '4' => '4',
                    '5' => '5',
                    '6' => '6',
                ),
            ),
            'attributes' => array(
                'required' => true,
                'class' =>'select2',
                 'id'=>'classes'     
            )
        ));

        $this->add(array(
            'name' => 'arm',
            'type' => 'Zend\Form\Element\Select',
            'options' => array(
                'label' => 'religion',
                'empty_option' => 'Select Arm',
                'value_options' => array(
                    'A' => 'A',
                    'B' => 'B',
                    'C' => 'C',
                    'D' => 'D',
                    'E' => 'E',
                    'F' => 'F',
                    'G' => 'G',
                    'H' => 'H',
                ),
            ),
            'attributes' => array(
                'required' => true,
                'class' =>'select2',
                 'id'=>'classes'     
            )
        ));

              
        $this->add(array(
            'name' => 'submit',
            'attributes' => array(
                'type'  => 'submit',
                'value' => 'Add class',
                'class' => 'btn btn-primary',
            ),
        )); 
    }
   
}