<?php 
namespace Admin\Form;

use Admin\Entity\FormMaster;
use Zend\Form\Fieldset;
use Zend\InputFilter\InputFilterProviderInterface;
use Doctrine\Common\Persistence\ObjectManager;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject as DoctrineHydrator;


class FormMasterFieldset extends Fieldset
{       protected $objectManager;

    public function __construct(ObjectManager $objectManager)
    { 
        parent::__construct('formmaster');
         $this->objectManager = $objectManager;


        $this->setHydrator(new DoctrineHydrator($objectManager))
             ->setObject(new FormMaster());

        $this->add(array(
            'type' => 'Zend\Form\Element\Hidden',
            'name' => 'id'
        ));

      

        $this->add(
    array(
        'type' => 'DoctrineModule\Form\Element\ObjectSelect',
        'name' => 'year',
        'options' => array(
            'object_manager' => $objectManager,
            'target_class'   => 'Admin\Entity\Year',
            'property'       => 'name',
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

         $this->add(array(
            'name' => 'staff',
            'type' => 'DoctrineModule\Form\Element\ObjectSelect',
            'options' => array(
                'label' => 'Session',
                'object_manager' => $objectManager,
                'target_class' => 'Admin\Entity\Staff',
                'property' => 'fname',
                'empty_option'   => 'Select a teacher',
            ),
            'attributes' => array(
                'required' => true,
                'class'=>'select2',
            )
        ));


         $this->add(array(
            'name' => 'class',
            'type' => 'DoctrineModule\Form\Element\ObjectSelect',
            'options' => array(
                'label' => 'Class',
                'object_manager' => $objectManager,
                'target_class' => 'Admin\Entity\Classes',
                'property' => 'name',
                'empty_option'   => 'Select a class',
               
            ),
            'attributes' => array(
                'required' => true,
                'class'=>'select2',
            )
        ));

}
   
}