<?php 
namespace Applicant\Form;

use Applicant\Entity\OtherExaminations;
use Zend\Form\Fieldset;
use Zend\InputFilter\InputFilterProviderInterface;
use Doctrine\Common\Persistence\ObjectManager;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject as DoctrineHydrator;


class OtherExaminationsFieldset extends Fieldset implements InputFilterProviderInterface
{
    public function __construct(ObjectManager $objectManager)
    {
        parent::__construct('other_examinations');

        $this->setHydrator(new DoctrineHydrator($objectManager))
             ->setObject(new OtherExaminations());

        $this->add(array(
            'type' => 'Zend\Form\Element\Hidden',
            'name' => 'id'
        ));    

       $this->add(array(
            'name' => 'examName',
            'attributes' => array(
                'type'  => 'text',
                'placeholder' =>'Name Of Examining Body',
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
            'name' => 'examNo',
            'attributes' => array(
                'type'  => 'text',
                'placeholder' =>'Exam No',
                'class' =>'form-control',
            ),
            'options' => array(
                'label' => 'Exam No',
            ),
            'label_attributes' => array(
                'class' => 'input', 
                ),
        ));

        $this->add(array(
            'name' => 'examCenter',
            'attributes' => array(
                'type'  => 'text',
                'placeholder' =>'Exam Center',
                'class' =>'form-control',
            ),
            'options' => array(
                'label' => 'Exam No',
            ),
            'label_attributes' => array(
                'class' => 'input', 
                ),
        ));


       $this->add(array(
            'name' => 'year',
            'attributes' => array(
                'type'  => 'Zend\Form\Element\Text',
                'placeholder' =>'Year',
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
            'examName' => array(
                'filters'  => array(
                    array('name' => 'StripTags'),
                    array('name' => 'StringTrim'),
                ),
            ),
            'examNo' => array(
                'filters'  => array(
                    array('name' => 'StripTags'),
                    array('name' => 'StringTrim'),
                ),
        
            ),
            'examCenter' => array(
                'filters'  => array(
                    array('name' => 'StripTags'),
                    array('name' => 'StringTrim'),
                ),
        
            ),
                    
        );

    }

}