<?php 
namespace Applicant\Form;

use Applicant\Entity\InstitutionsAttended;
use Zend\Form\Fieldset;
use Zend\InputFilter\InputFilterProviderInterface;
use Doctrine\Common\Persistence\ObjectManager;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject as DoctrineHydrator;


class InstitutionsAttendedFieldset extends Fieldset implements InputFilterProviderInterface
{
    public function __construct(ObjectManager $objectManager)
    {
        parent::__construct('institutions_attended');

        $this->setHydrator(new DoctrineHydrator($objectManager))
             ->setObject(new InstitutionsAttended());

        $this->add(array(
            'type' => 'Zend\Form\Element\Hidden',
            'name' => 'id'
        ));    

       $this->add(array(
            'name' => 'name',
            'attributes' => array(
                'type'  => 'text',
                'placeholder' =>'Institution Name',
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
            'name' => 'location',
            'attributes' => array(
                'type'  => 'text',
                'placeholder' =>'Location',
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
            'location' => array(
                'filters'  => array(
                    array('name' => 'StripTags'),
                    array('name' => 'StringTrim'),
                ),
        
            ),
                    
        );

    }

}