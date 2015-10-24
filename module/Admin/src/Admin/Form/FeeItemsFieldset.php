<?php 
namespace Admin\Form;

use Admin\Entity\FeeItems;
use Zend\Form\Fieldset;
use Zend\InputFilter\InputFilterProviderInterface;
use Doctrine\Common\Persistence\ObjectManager;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject as DoctrineHydrator;


class FeeItemsFieldset extends Fieldset 
{
    public function __construct(ObjectManager $objectManager)
    {
        parent::__construct('feeitems');

        $this->setHydrator(new DoctrineHydrator($objectManager))
             ->setObject(new FeeItems());

          $this->add(array(
            'name'=>'id',
            'attributes'=>array(
                'type'=>'hidden',)
            ,
            ));

        $this->add(array(
            'name' => 'items',
            'attributes' => array(
                'type'  => 'text',
                'placeholder' =>'Enter an item',
                'class' =>'form-input',

            ),
           
            'label_attributes' => array(
                'class' => 'input', 
                ),
           
        ));

        $this->add(array(
            'name' => 'amount',
            'attributes' => array(
                'type'  => 'text',
                'placeholder' =>'Enter an amount',
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
                        'value' => 'Add',
                        'class' => 'btn btn-xs btn-danger',
                        'onclick'=>'return remove_field(this)',
                    ),
                ));

        
        
    }



   
}