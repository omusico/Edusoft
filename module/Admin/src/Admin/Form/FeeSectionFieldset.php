<?php 
namespace Admin\Form;

use Admin\Entity\FeeSection;
use Zend\Form\Fieldset;
use Zend\InputFilter\InputFilterProviderInterface;
use Doctrine\Common\Persistence\ObjectManager;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject as DoctrineHydrator;


class FeeSectionFieldset extends Fieldset 
{  protected $objectManager;
    public function __construct(ObjectManager $objectManager)
    {
        parent::__construct('feesection');
        $this->setHydrator(new DoctrineHydrator($objectManager))
             ->setObject(new FeeSection());
             $this->objectManager=$objectManager;
   

        $this->add(array(
            'type' => 'Zend\Form\Element\Hidden',
            'name' => 'id'
        ));

     



      $this->add(    array(
        'type' => 'DoctrineModule\Form\Element\ObjectSelect',
        'name' => 'year',
        'options' => array(
            'object_manager' => $objectManager,
            'target_class'   => 'Admin\Entity\Year',
            'property'       => 'name',
            'empty_option'   => 'Select a year',
            'is_method'      => true,
            'find_method'    => array(
                'name'   => 'findBy',
                'params' => array(
                    'criteria' => array(),

                    // Use key 'orderBy' if using ORM
                    'orderBy'  => array('id' => 'DESC'),
                ),
            ),
        ),
        'attributes' => array(
                'required' => false,
                'class'=>'select2',
            )
    )
);


 


            $itemsFieldset = new FeeItemsFieldset($objectManager);
                $this->add(array(
                    'type'    => 'Zend\Form\Element\Collection',
                    'name'    => 'items',
                    'options' => array(
                          'should_create_template' => true,
                'allow_add' => true,
                'allow_remove' => true,
                        'target_element' => $itemsFieldset
                    )
                ));






        }
   
 
       
  }


 