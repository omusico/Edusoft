<?php
namespace Admin\Form;
use Admin\Entity\Salary;
use Doctrine\ORM\EntityManager;
use Doctrine\Common\Persistence\ObjectManager;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject as DoctrineHydrator;
use Zend\Form\Form;

class SalaryForm extends Form
{
    public function __construct(ObjectManager $objectManager, $name = null)
    {
        parent::__construct('salary');
        $this->setAttribute('method', 'post');
        $this->setAttribute('id', 'salary');
        $this->setAttribute('class', 'smart-form');
        $this->setHydrator(new DoctrineHydrator($objectManager))
             ->setObject(new Salary());

        $this->add(array(
            'type' => 'Zend\Form\Element\Hidden',
            'name' => 'id',
          
        ));

       
        $this->add(array(
            'name' => 'level',
            'type' => 'DoctrineModule\Form\Element\ObjectSelect',
            'options' => array(
                'label' => 'Session',
                'object_manager' => $objectManager,
                'target_class' => 'Admin\Entity\Level',
                'property' => 'name',
                'empty_option'   => 'Select Level',
            ),
            'attributes' => array(
                'required' => true,
                'id' => 'level',
                'class'=>'select2',
            )
        ));

         $this->add(array(
            'name' => 'step',
            'type' => 'DoctrineModule\Form\Element\ObjectSelect',
            'options' => array(
                'label' => 'Session',
                'object_manager' => $objectManager,
                'target_class' => 'Admin\Entity\Step',
                'property' => 'name',
                'empty_option'   => 'please choose step',
            ),
            'attributes' => array(
                'required' => true,
                'id' => 'step',
                'class'=>'select2',
            )
        ));

       $this->add(array(
            'name' => 'amount',
            'attributes' => array(
                'type'  => 'Zend\Form\Element\Text',
                'placeholder' =>'Enter Amount',
                'class' => '', 
                'id' => 'amount',
                
            ),
            'options' => array(
                'label' => 'Last Name',
            ),
            'label_attributes' => array(
                'class' => 'hasDatepicker', 
                ),
        ));

        $this->add(array(
            'name' => 'submit',
            'attributes' => array(
                'type'  => 'submit',
                'value' => 'Save Details',
                'class' => 'btn btn-primary',
            ),
        )); 


    }
}