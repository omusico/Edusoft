<?php
namespace Admin\Form;

use Admin\Entity\AcademicYear;
use Zend\Form\Form;
use Zend\InputFilter\InputFilterProviderInterface;
use Doctrine\Common\Persistence\ObjectManager;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject as DoctrineHydrator;

class AcademicYearForm extends Form
{   protected $objectManager;

    public function __construct(ObjectManager $objectManager)
    {
         parent::__construct('academic-year');
         $this->setAttribute('method', 'post');
         $this->setHydrator(new DoctrineHydrator($objectManager))
             ->setObject(new AcademicYear());
             $this->objectManager=$objectManager;
   
       
        $this->add(array(
            'name' => 'year',
            'type' => 'DoctrineModule\Form\Element\ObjectSelect',
            'options' => array(
                'label' => 'year',
                'object_manager' => $objectManager,
                'target_class' => 'Admin\Entity\Year',
                'property' => 'name',
                'empty_option'   => 'please select year',
            ),
            'attributes' => array(
                'required' => true,
                'id' => 'year',
                 'class'=>'select2',
            )
        ));

         $this->add(array(
            'name' => 'semester',
            'type' => 'DoctrineModule\Form\Element\ObjectSelect',
            'options' => array(
                'label' => 'semester',
                'object_manager' => $objectManager,
                'target_class' => 'Admin\Entity\Semester',
                'property' => 'name',
                'empty_option'   => 'please choose semester',
            ),
            'attributes' => array(
                'required' => true,
                'id' => 'semester',
                'class'=>'select2'
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