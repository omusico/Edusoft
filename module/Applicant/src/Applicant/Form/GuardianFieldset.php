<?php 
namespace Applicant\Form;

use Applicant\Entity\Guardian;
use Zend\Form\Fieldset;
use Zend\InputFilter\InputFilterProviderInterface;
use Doctrine\Common\Persistence\ObjectManager;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject as DoctrineHydrator;


class GuardianFieldset extends Fieldset implements InputFilterProviderInterface
{
    public function __construct(ObjectManager $objectManager)
    {
        parent::__construct('guardian');

        $this->setHydrator(new DoctrineHydrator($objectManager))
             ->setObject(new Guardian());

        $this->add(array(
            'type' => 'Zend\Form\Element\Hidden',
            'name' => 'id'
        ));

         $this->add(array(
                'name' => 'gender',
                'type' => 'Zend\Form\Element\Select',
                'options' => array(
                    'label' => 'gender',
                    'empty_option' => 'Select your gender',
                    'value_options' => array(
                        'Mr' => 'Mr.',
                        'Mrs' => 'Mrs.',
                    ),
                ),
                'attributes' => array(
                    'required' => true,
                    'class' =>'',
                    
                ) 

            ));

       $this->add(array(
            'name' => 'firstName',
            'attributes' => array(
                'type'  => 'text',
                'placeholder' =>'First Name',
                'class' =>'form-control',
            ),
            'options' => array(
                'label' => 'name',
            ),
            'label_attributes' => array(
                'class' => 'input', 
                ),
        ));

        $this->add(array(
            'name' => 'lastName',
            'attributes' => array(
                'type'  => 'text',
                'placeholder' =>'Last Name',
                'class' =>'form-control',
            ),
            'options' => array(
                'label' => 'Last Name',
            ),
            'label_attributes' => array(
                'class' => 'input', 
                ),
        ));


        $this->add(array(
            'name' => 'middleName',
            'attributes' => array(
                'type'  => 'text',
                'placeholder' =>'Middle Name',
                'class' =>'form-control',
            ),
            'options' => array(
                'label' => 'Middle Name',
            ),
            'label_attributes' => array(
                'class' => 'input', 
                ),
        ));

        $this->add(array(
            'name' => 'email',
            'attributes' => array(
                'type'  => 'text',
                'placeholder' =>'Email Address',
                'class' =>'form-control',
            ),
            'options' => array(
                'label' => 'Last Name',
            ),
            'label_attributes' => array(
                'class' => 'input', 
                ),
        ));

         $this->add(array(
            'name' => 'occupation',
            'attributes' => array(
                'type'  => 'text',
                'placeholder' =>'occupation',
                'class' =>'form-control',
            ),
            'options' => array(
                'label' => 'Last Name',
            ),
            'label_attributes' => array(
                'class' => 'input', 
                ),
        ));

        $this->add(array(
            'name' => 'mobile1',
            'attributes' => array(
                'type'  => 'text',
                'data-mask' =>'+234 (803) 333-3333',
                'placeholder' =>'Enter mobile 1',
                'class' =>'form-control',
            ),
            'options' => array(
                'label' => 'Mobile Number',
            ),
            'label_attributes' => array(
                'class' => 'input', 
                ),
        ));

         $this->add(array(
            'name' => 'mobile2',
            'attributes' => array(
                'type'  => 'text',
                'data-mask' =>'+234 (803) 333-3333',
                'placeholder' =>'Enter mobile 2',
                'class' =>'form-control',
            ),
            'options' => array(
                'label' => 'Mobile Number',
            ),
            'label_attributes' => array(
                'class' => 'input', 
                ),
        )); 
   
    }

    public function getInputFilterSpecification()
        {
            return array(
            'lastName' => array(
                'filters'  => array(
                    array('name' => 'StripTags'),
                    array('name' => 'StringTrim'),
                ),
            ),
            'lastName' => array(
                'filters'  => array(
                    array('name' => 'StripTags'),
                    array('name' => 'StringTrim'),
                ),
        
            ),
            'MiddleName' => array(
                'filters'  => array(
                    array('name' => 'StripTags'),
                    array('name' => 'StringTrim'),
                ),
            ),
            'occupation' => array(
                'filters'  => array(
                    array('name' => 'StripTags'),
                    array('name' => 'StringTrim'),
                ),
        
            ),
            'gender' => array(
                'filters'  => array(
                    array('name' => 'StripTags'),
                    array('name' => 'StringTrim'),
                ),
            ),
            'email' => array(
                'filters'  => array(
                    array('name' => 'StripTags'),
                    array('name' => 'StringTrim'),
                ),
            ),
             'mobile1' => array(
                'filters'  => array(
                    array('name' => 'StripTags'),
                    array('name' => 'StringTrim'),
                ),
            ),
            'mobile2' => array(
                'filters'  => array(
                    array('name' => 'StripTags'),
                    array('name' => 'StringTrim'),
                ),
            ),
        
        );

    }

}