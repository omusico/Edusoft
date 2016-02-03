<?php 
namespace Applicant\Form;

use Applicant\Entity\PreviousEmployments;
use Zend\Form\Fieldset;
use Zend\InputFilter\InputFilterProviderInterface;
use Doctrine\Common\Persistence\ObjectManager;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject as DoctrineHydrator;


class PreviousEmploymentsFieldset extends Fieldset implements InputFilterProviderInterface
{
    public function __construct(ObjectManager $objectManager)
    {
        parent::__construct('previous_employment');

        $this->setHydrator(new DoctrineHydrator($objectManager))
             ->setObject(new PreviousEmployments());

        $this->add(array(
            'type' => 'Zend\Form\Element\Hidden',
            'name' => 'id'
        ));    

       $this->add(array(
            'name' => 'name',
            'attributes' => array(
                'type'  => 'text',
                'placeholder' =>'Name Of Employer',
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
            'name' => 'position',
            'attributes' => array(
                'type'  => 'text',
                'placeholder' =>'Position',
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
            'name' => 'from',
            'attributes' => array(
                'type'  => 'Zend\Form\Element\Text',
                'placeholder' =>'Start Date',
                'class' => 'datepicker', 
                'id' =>'startdate',
                'format' =>'d/m/Y',
                'required' => true,
                'data-dateformat'=>"dd/mm/yy"
            ),
        
        ));

        $this->add(array(
            'name' => 'to',
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

       
   
    }

    public function getInputFilterSpecification()
        {
            return array(
            'name' => array(
                'filters'  => array(
                    array('name' => 'StripTags'),
                    array('name' => 'StringTrim'),
                ),
            ),
            'position' => array(
                'filters'  => array(
                    array('name' => 'StripTags'),
                    array('name' => 'StringTrim'),
                ),
        
            ),
                    
        );

    }

}