<?php 
namespace Admin\Form;

use Admin\Entity\GradeSystem;
use Zend\Form\Fieldset;
use Zend\InputFilter\InputFilterProviderInterface;
use Doctrine\Common\Persistence\ObjectManager;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject as DoctrineHydrator;


class GradesFieldset extends Fieldset 
{
    public function __construct(ObjectManager $objectManager)
    {
        parent::__construct('grades');

        $this->setHydrator(new DoctrineHydrator($objectManager))
             ->setObject(new GradeSystem());

          $this->add(array(
            'name'=>'id',
            'attributes'=>array(
                'type'=>'hidden',)
            ,
            ));

        $this->add(array(
            'name' => 'grade',
            'attributes' => array(
                'type'  => 'text',
                'placeholder' =>'Enter an grade',
                'class' =>'form-input',

            ),
           
            'label_attributes' => array(
                'class' => 'input', 
                ),
           
        ));

        $this->add(array(
            'name' => 'startRange',
            'attributes' => array(
                'type'  => 'number',
                'placeholder' =>'Enter an amount',
                'class' =>'form-input',

            ),
           'label_attributes' => array(
                'class' => 'input', 
                ),
        ));

         $this->add(array(
            'name' => 'endRange',
            'attributes' => array(
                'type'  => 'number',
                'placeholder' =>'Enter an amount',
                'class' =>'form-input',

            ),
           'label_attributes' => array(
                'class' => 'input', 
                ),
        ));
         $this->add(array(
                'name' => 'description',
                'attributes' => array(
                    'type'  => 'text',
                    'placeholder' =>'Enter a remark',
                    'class' =>'form-input',

                ),
               'label_attributes' => array(
                    'class' => 'input', 
                    ),
            ));


             $this->add(array(
                    'name' => 'add',
                    'attributes' => array(
                        'type'  => 'button',
                        'value' => 'Add',
                        'class' => 'btn btn-xs btn-primary',
                        'onclick'=>'return add_field()',
                    ),
                ));

             $this->add(array(
                    'name' => 'remove',
                    'attributes' => array(
                        'type'  => 'button',
                        'value' => 'Remove',
                        'class' => 'btn btn-xs btn-danger',
                        'onclick'=>'return remove_field(this)',
                    ),
                ));

        
        
    }



   
}