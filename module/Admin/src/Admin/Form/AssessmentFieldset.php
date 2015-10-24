<?php 
namespace Admin\Form;

use Admin\Entity\CaSystem;
use Zend\Form\Fieldset;
use Zend\InputFilter\InputFilterProviderInterface;
use Doctrine\Common\Persistence\ObjectManager;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject as DoctrineHydrator;


class AssessmentFieldset extends Fieldset 
{
    public function __construct(ObjectManager $objectManager)
    {
        parent::__construct('assessment');

        $this->setHydrator(new DoctrineHydrator($objectManager))
             ->setObject(new CaSystem());

          $this->add(array(
            'name'=>'id',
            'attributes'=>array(
                'type'=>'hidden',)
            ,
            ));

        $this->add(array(
            'name' => 'assessName',
            'attributes' => array(
                'type'  => 'text',
                'placeholder' =>'Enter assessment name',
                'class' =>'formcollect',

            ),
           
            'label_attributes' => array(
                'class' => 'input', 
                ),
           
        ));

        $this->add(array(
            'name' => 'shortName',
            'attributes' => array(
                'type'  => 'text',
                'placeholder' =>'Enter short name',
                'class' =>'formcollect',

            ),
           'label_attributes' => array(
                'class' => 'input', 
                ),
        ));

         $this->add(array(
            'name' => 'percentage',
            'attributes' => array(
                'type'  => 'number',
                'placeholder' =>'Enter total mark',
                'class' =>'formcollect',

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