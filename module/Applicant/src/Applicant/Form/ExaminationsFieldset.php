<?php 
namespace Applicant\Form;

use Applicant\Entity\Examinations;
use Zend\Form\Fieldset;
use Zend\InputFilter\InputFilterProviderInterface;
use Doctrine\Common\Persistence\ObjectManager;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject as DoctrineHydrator;


class ExaminationsFieldset extends Fieldset implements InputFilterProviderInterface
{
    public function __construct(ObjectManager $objectManager)
    {
        parent::__construct('examinations');

        $this->setHydrator(new DoctrineHydrator($objectManager))
             ->setObject(new Examinations());

        $this->add(array(
            'type' => 'Zend\Form\Element\Hidden',
            'name' => 'id'
        )); 

        $this->add(array(
            'name' => 'exam',
            'type' => 'Zend\Form\Element\Select',
            'options' => array(
                'label' => 'grade',
                'empty_option' => 'Select Grade',
                'value_options' => array(
                    'WAEC (SSCE)' => 'WAEC (SSCE)',
                    'NECO (SSCE)' => 'NECO (SSCE)',
                    'NABTED' => 'NABTED',
                    'GCE (O/L) WAEC' => 'GCE (O/L) WAEC',
                ),
            ),
            'attributes' => array(
                'required' => true,
                'class' =>'select2',
                 'id'=>'exam'
                
            )
        ));   

       $this->add(array(
            'name' => 'grade',
            'type' => 'Zend\Form\Element\Select',
            'options' => array(
                'label' => 'grade',
                'empty_option' => 'Select Grade',
                'value_options' => array(
                    'A1' => 'A1',
                    'B2' => 'B2',
                    'B3' => 'B3',
                    'C4' => 'C4',
                    'C5' => 'C5',
                    'C6' => 'C6',
                    'D7' => 'D7',
                    'E8' => 'E8',
                    'F9' => 'F9',
                ),
            ),
            'attributes' => array(
                'required' => true,
                'class' =>'select2',
                 'id'=>'grade'
                
            )
        ));

        $this->add(array(
            'name' => 'examCenter',
            'attributes' => array(
                'type'  => 'text',
                'placeholder' =>'Exam Center',
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
            'name' => 'candidateNo',
            'attributes' => array(
                'type'  => 'text',
                'placeholder' =>'Candidate\'s No',
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
            'name' => 'date',
            'attributes' => array(
                'type'  => 'Zend\Form\Element\Text',
                'placeholder' =>'Date',
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
            'examCenter' => array(
                'filters'  => array(
                    array('name' => 'StripTags'),
                    array('name' => 'StringTrim'),
                ),
            ),
            'candidateNo' => array(
                'filters'  => array(
                    array('name' => 'StripTags'),
                    array('name' => 'StringTrim'),
                ),
        
            ),
                    
        );

    }

}