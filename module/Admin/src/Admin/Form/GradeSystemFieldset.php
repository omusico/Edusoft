<?php 
namespace Admin\Form;

use Admin\Entity\GradeFormat;
use Zend\Form\Fieldset;
use Zend\InputFilter\InputFilterProviderInterface;
use Doctrine\Common\Persistence\ObjectManager;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject as DoctrineHydrator;


class GradeSystemFieldset extends Fieldset 
{  protected $objectManager;
    public function __construct(ObjectManager $objectManager)
    {
        parent::__construct('gradesystem');
        $this->setHydrator(new DoctrineHydrator($objectManager))
             ->setObject(new GradeFormat());
             $this->objectManager=$objectManager;
            
             $this->add(array(
            'name' => 'name',
            'attributes' => array(
                'type'  => 'text',
                'placeholder' =>'Enter a name',
                'class' =>'form-control',
                'id'=>'name',
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
            'name' => 'description',
            'attributes' => array(
                'type'  => 'text',
                'placeholder' =>'Write a description',
                'class' =>'form-control',
                'id'=>'description',
                'required' => false,
            ),
            'options' => array(
                'label' => 'name',
            ),
            'label_attributes' => array(
                'class' => 'input', 
                ),
        ));

 


            $gradesFieldset = new GradesFieldset($objectManager);
                $this->add(array(
                'type'    => 'Zend\Form\Element\Collection',
                'name'    => 'gradeSystems',
                 'options' => array(
                'should_create_template' => true,
                'allow_add' => true,
                'allow_remove' => true,
                        'target_element' => $gradesFieldset
                    )
                ));




        }
   
 
       
  }


 