<?php
namespace Pins\Form;

use Doctrine\Common\Persistence\ObjectManager;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject as DoctrineHydrator;
use Zend\InputFilter;
use Zend\Form\Form;

class ApplicationPinsForm extends Form
{
    public function __construct(ObjectManager $objectManager){
        parent::__construct('ApplicationPinsForm');
       
   
       
        // The form will hydrate an object of type "subject"
        $this->setHydrator(new DoctrineHydrator($objectManager, 'Pins\Entity\ApplicationPins'));
        
   $this->add(array(
            'type' => 'Zend\Form\Element\Hidden',
            'name' => 'id'
        ));

        $this->add(array(
            'name' => 'quantity',
            'attributes' => array(
                'placeholder' =>'Enter Quantity',
                'class' =>'form-control',
            ),
            'options' => array(
                'label' => 'quantity',
            ),
            'label_attributes' => array(
                'class' => 'input', 
                ),
        ));


        $this->add(array(
            'name' => 'section',
            'type' => 'DoctrineModule\Form\Element\ObjectSelect',
            'options' => array(
                'label' => 'section',
                'object_manager' => $objectManager,
                'target_class' => 'Admin\Entity\Section',
                'property' => 'name',
                'empty_option'   => 'Select a section',
            ),
            'attributes' => array(
                'required' => true,
                'class' =>'form-control'
            )
        ));
      


            
        $this->add(array(
            'name' => 'submit',
            'attributes' => array(
                'type'  => 'submit',
                'value' => 'Generate pins',
                'class' => 'btn btn-primary',
            ),
        )); 
    }
  
}