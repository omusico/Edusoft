<?php
namespace Admin\Form;
use Doctrine\ORM\EntityManager;
use Zend\Form\Form;

class SessionForm extends Form
{
    public function __construct(EntityManager $em, $name = null)
    {
        parent::__construct('session');
        $this->setAttribute('method', 'post');
        $this->setAttribute('id', 'session');
        $this->setAttribute('class', 'smart-form');

       
        $this->add(array(
            'name' => 'year',
            'type' => 'DoctrineModule\Form\Element\ObjectSelect',
            'options' => array(
                'label' => 'Session',
                'object_manager' => $em,
                'target_class' => 'Admin\Entity\Year',
                'property' => 'name',
                'empty_option'   => 'please select year',
            ),
            'attributes' => array(
                'required' => true,
                'id' => 'year'
            )
        ));

         $this->add(array(
            'name' => 'term',
            'type' => 'DoctrineModule\Form\Element\ObjectSelect',
            'options' => array(
                'label' => 'Session',
                'object_manager' => $em,
                'target_class' => 'Admin\Entity\Term',
                'property' => 'name',
                'empty_option'   => 'please choose term',
            ),
            'attributes' => array(
                'required' => true,
                'id' => 'term'
            )
        ));
 
      //  $this->get('startDate')->setFormat('d/m/y');
               $this->add(array(
            'name' => 'startDate',
            'attributes' => array(
                'type'  => 'Zend\Form\Element\Text',
                'placeholder' =>'End Date',
                'class' => 'datepicker', 
                'id' =>'startdate',
                'format' =>'d/m/Y',
                'required' => true,
                'data-dateformat'=>"dd/mm/yy"
            ),
        
        ));

         $this->add(array(
            'name' => 'endDate',
            'attributes' => array(
                'type'  => 'Zend\Form\Element\Text',
                'placeholder' =>'End Date',
                'class' => 'datepicker', 
                'id' =>'enddate',
                'format' =>'d/m/Y',
                'required' => true,
                'data-dateformat'=>"dd/mm/yy"
            ),
          
        ));

     
       //  $this->get('endDate')->setFormat('d/m/y');
      		
        $this->add(array(
            'name' => 'submit',
            'attributes' => array(
                'type'  => 'submit',
                'value' => 'Add',
                'class' => 'btn btn-primary',
            ),
        )); 
    }
}