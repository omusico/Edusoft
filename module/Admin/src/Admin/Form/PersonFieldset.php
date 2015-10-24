<?php 
namespace Admin\Form;

use Admin\Entity\Person;
use Admin\Form\GuardianFieldset;
use Admin\Form\StudentFieldset;
use Zend\Form\Fieldset;
use Zend\InputFilter\InputFilterProviderInterface;
use Doctrine\Common\Persistence\ObjectManager;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject as DoctrineHydrator;


class PersonFieldset extends Fieldset
{
    public function __construct(ObjectManager $objectManager)
    {
        parent::__construct('person');
         $this->setAttribute('method', 'post');
        $this->setHydrator(new DoctrineHydrator($objectManager))
             ->setObject(new Person());
   

        $this->add(array(
            'type' => 'Zend\Form\Element\Hidden',
            'name' => 'id'
        ));

        $this->add(array(
            'name' => 'fname',
            'attributes' => array(
                'type'  => 'text',
                'placeholder' =>'First Name',
                'class' =>'form-control',
                'id'=>'fname',
                'required' => true,
            ),
            'options' => array(
                'label' => 'name',
            ),
            'label_attributes' => array(
                'class' => 'input', 
                ),
        ));

        $this->add(array(
            'name' => 'lname',
            'attributes' => array(
                'type'  => 'text',
                'placeholder' =>'Last Name',
                'class' =>'form-control',
               'id'=>'lname',
               'required' => true,
            ),
            'options' => array(
                'label' => 'Last Name',
            ),
            'label_attributes' => array(
                'class' => 'input', 
                ),
        ));


        $this->add(array(
            'name' => 'mname',
            'attributes' => array(
                'type'  => 'text',
                'placeholder' =>'Middle Name',
                'class' =>'form-control',
                'id'=>'mname',
            ),
            'options' => array(
                'label' => 'Middle Name',
            ),
            'label_attributes' => array(
                'class' => 'input', 
                ),
        ));

        $this->add(array(
            'name' => 'dob',
            'attributes' => array(
                'type'  => 'Zend\Form\Element\Text',
                'placeholder' =>'Date of Birth',
                'class' => 'datepicker', 
                'id' =>'dob',
                'format' =>'d/m/Y',
                'required' => true,
                'data-dateformat'=>"dd/mm/yy"
            ),
            'options' => array(
                'label' => 'Date of birth',
            ),
            'label_attributes' => array(

                ),
        ));

         $this->add(array(
            'name' => 'religion',
            'type' => 'Zend\Form\Element\Select',
            'options' => array(
                'label' => 'religion',
                'empty_option' => 'Select Your Religion',
                'value_options' => array(
                    'Christianity' => 'Christianity',
                    'Islam' => 'Islam',
                    'Traditional' => 'Traditional',
                    'Others' => 'Others',
                ),
            ),
            'attributes' => array(
                'required' => true,
                'class' =>'select2',
                 'id'=>'religion'
                
            )
        ));

        $this->add(array(
            'name' => 'mobile',
            'attributes' => array(
                'type' => 'Zend\Form\Element\Text',
                'placeholder' =>'Enter your mobile',
                'class' =>'',
                'id'=>'mobile',
                'data-mask'=>"+234 (803) 247-8284",
                'data-mask-placeholder'=> "X"
            ),
            'options' => array(
                'label' => 'Mobile Number',
            ),
            'label_attributes' => array(
                'class' => 'input', 
                ),
        ));

         $this->add(array(
            'name' => 'nokRel',
            'attributes' => array(
                'type'  => 'text',
                'placeholder' =>'Next-Of-Kin Relationship',
                'class' =>'form-control',
                'id'=>'nokRel',
                'required' => true,
            ),
            'options' => array(
                'label' => 'Next-Of-Kin Relationship',
            ),
            'label_attributes' => array(
                'class' => 'input', 
                ),
        ));

        $this->add(array(
            'name' => 'nokName',
            'attributes' => array(
                'type'  => 'text',
                'placeholder' =>'Full Name of Next-Of-Kin',
                'class' =>'form-control',
                'id'=>'nokName',
                'required' => true,
            ),
            'options' => array(
                'label' => 'Name of Next-Of-Kin',
            ),
            'label_attributes' => array(
                'class' => 'input', 
                ),
        ));

        $this->add(array(
            'name' => 'nokMobile',
            'attributes' => array(
                'type'  => 'text',
                'placeholder' =>'Next-Of-Kin Mobile ',
                'class' =>'form-control',
                'id'=>'nokMobile',
                'required' => true,                             
            ),
            
            'options' => array(
                'label' => 'Mobile of Next-Of-Kin',
            ),
            'label_attributes' => array(
                'class' => 'input', 
                ),
        ));

         $this->add(array(
            'name' => 'sex',
            'type' => 'Zend\Form\Element\Select',
            'options' => array(
                'label' => 'Sex',
                'empty_option' => 'Select your gender',
                'value_options' => array(
                    'Male' => 'Male',
                    'Female' => 'Female',
                ),
            ),
            'attributes' => array(
                'required' => true,
                'class' =>'select2',
                
            )
            

        ));

        $this->add(array(
            'name' => 'country',
            'type' => 'DoctrineModule\Form\Element\ObjectSelect',
            'options' => array(
                'label' => 'Country',
                'object_manager' => $objectManager,
                'target_class' => 'Admin\Entity\Country',
                'property' => 'name',
                'empty_option'   => 'Choose your country',
            ),
            'attributes' => array(
                'required' => true,
                'class' =>'select2',

            )
        ));

        $this->add(array(
            'name' => 'state',
            'type' => 'DoctrineModule\Form\Element\ObjectSelect',
            'options' => array(
                'label' => 'State',
                'object_manager' => $objectManager,
                'target_class' => 'Admin\Entity\State',
                'property' => 'name',
                'empty_option'   => 'Choose your state',
                'option_attributes' => array(
                    'data-id' => function (\Admin\Entity\State $entity) {
                        return $entity->getId();
                    }
               ),
            ),
            'attributes' => array(
                'required' => true,
                'class' =>'select2',
                'id' =>'state'
                
            )
        ));

      
         $this->add(
                array(
                    'type' => 'DoctrineModule\Form\Element\ObjectSelect',
                    'name' => 'lga',
                    'options' => array(
                        'object_manager'     => $objectManager,
                        'target_class'       => 'Admin\Entity\Lga',
                        'property'           => 'name',
                        'empty_option'   => 'Choose your L.G.A',
                        'option_attributes' => array(
                            'data-id' => function (\Admin\Entity\Lga $entity) {
                                return $entity->getState()->getId();
                            }
                        ),
                    ),
                     'attributes' => array(
                        'required' => true,
                        'class'=>'select2',
                        'id' =>'lga'
               
                )
         ));

        $this->add(array(
            'name' => 'address',
            'attributes' => array(
                'type'  => 'Zend\Form\Element\Textarea',
                'placeholder' =>'Address',
                'class' =>'form-control',
                'required' => true,
            ),
            'options' => array(
                'label' => 'Address',
            ),
            'label_attributes' => array(
                'class' => 'input', 
                ),
        ));



        $GuardianFieldset = new GuardianFieldset($objectManager);
        $this->add($GuardianFieldset);


 



        
  }

 
}