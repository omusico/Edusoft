<?php 
namespace Admin\Form;

use Admin\Entity\CaFormat;
use Zend\Form\Fieldset;
use Zend\InputFilter\InputFilterProviderInterface;
use Doctrine\Common\Persistence\ObjectManager;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject as DoctrineHydrator;


class CaFormatFieldset extends Fieldset 
{  protected $objectManager;
    public function __construct(ObjectManager $objectManager)
    {
        parent::__construct('caformat');
        $this->setHydrator(new DoctrineHydrator($objectManager))
             ->setObject(new CaFormat());
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

 


            $assessmentFieldset = new AssessmentFieldset($objectManager);
                $this->add(array(
                'type'    => 'Zend\Form\Element\Collection',
                'name'    => 'caSystems',
                 'options' => array(
                'should_create_template' => true,
                'allow_add' => true,
                'allow_remove' => true,
                        'target_element' => $assessmentFieldset
                    )
                ));




        }
   
 
       
  }


 