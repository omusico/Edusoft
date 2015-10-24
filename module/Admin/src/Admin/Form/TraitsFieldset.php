<?php 
namespace Admin\Form;

use Admin\Entity\Traits;
use Zend\Form\Fieldset;
use Zend\InputFilter\InputFilterProviderInterface;
use Doctrine\Common\Persistence\ObjectManager;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject as DoctrineHydrator;


class TraitsFieldset extends Fieldset 
{  protected $objectManager;
    public function __construct(ObjectManager $objectManager)
    {
        parent::__construct('traits');
        $this->setHydrator(new DoctrineHydrator($objectManager))
             ->setObject(new Traits());
             $this->objectManager=$objectManager;
            
             $this->add(array(
            'name' => 'name',
            'attributes' => array(
                'type'  => 'text',
                'placeholder' =>'Enter a name',
                'class' =>'form-input',
                'id'=>'name',
                'required' => true,
            ),
          
        ));


        $this->add(array(
            'name' => 'remark',
            'attributes' => array(
                'type'  => 'text',
                'placeholder' =>'Write a remark',
                'class' =>'form-input',
                'id'=>'description',
                'required' => false,
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


 