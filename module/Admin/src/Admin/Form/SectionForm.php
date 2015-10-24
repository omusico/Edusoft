<?php
namespace Admin\Form;
use Doctrine\Common\Persistence\ObjectManager;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject as DoctrineHydrator;
use Zend\Form\Form;

class SectionForm extends Form
{
     public function __construct(ObjectManager $objectManager){
        parent::__construct('section');
        $this->setAttribute('method', 'post');
        

        $this->add(array(
            'name'=>'id',
            'attributes'=>array(
                'type'=>'hidden',)
            ,
            ));

        $this->add(array(
            'name' => 'name',
            'attributes' => array(
                'type'  => 'text',
                'placeholder' =>'Enter section name',
                'class' =>'form-control',
            ),
            'options' => array(
                'label' => 'Name',
            ),
            'label_attributes' => array(
                'class' => 'input', 
                ),
        ));

         $this->add(array(
            'name' => 'shortname',
            'attributes' => array(
                'type'  => 'text',
                'placeholder' =>'Enter short name',
                'class' =>'form-control',
            ),
            'options' => array(
                'label' => 'shortname',
            ),
            'label_attributes' => array(
                'class' => 'input', 
                ),
        ));


        $subjectFieldset = new SubjectFieldset($objectManager);
        $this->add(array(
            'type'    => 'DoctrineModule\Form\Element\ObjectMultiCheckbox',
            'name' => 'subject',
            'options' => array(
                'label' => 'Select Subjects',
                'object_manager' => $objectManager,
                'should_create_template' => true,
                'target_class'   => 'Admin\Entity\Subject',
                'property'       => 'name',
                'target_element' => $subjectFieldset,
              ),
        ));
      
        
        
            
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