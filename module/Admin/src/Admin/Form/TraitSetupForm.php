<?php
namespace Admin\Form;
use DoctrineModule\Persistence\ObjectManagerAwareInterface;
use Doctrine\Common\Persistence\ObjectManager;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject as DoctrineHydrator;
use Zend\InputFilter\InputFilterProviderInterface;
use Zend\Form\Form;
use Admin\Entity\TraitSetup;

class TraitSetupForm extends Form implements ObjectManagerAwareInterface, InputFilterProviderInterface
{   protected $objectManager;
    
    public function __construct(ObjectManager $objectManager)
    {   $this->setObjectManager($objectManager);

        parent::__construct('traitsetup');
        $this->setAttribute('method', 'post');
        $this->setAttribute('class', 'smart-form');
        $this->setHydrator(new DoctrineHydrator($objectManager, 'Admin\Entity\TraitSetup'));


        $this->add(array(
            'name' => 'description',
            'attributes' => array(
                'type'  => 'text',
                'placeholder' =>'Write a description',
                'class' =>'form-control',
                'id'=>'fname',
                'required' => false,
            ),
            'options' => array(
                'label' => 'name',
            ),
            'label_attributes' => array(
                'class' => 'input', 
                ),
        ));

          $this->add(array(
            'name' => 'section',
            'type' => 'DoctrineModule\Form\Element\ObjectSelect',
            'options' => array(
                'label' => 'Country',
                'object_manager' => $objectManager,
                'target_class' => 'Admin\Entity\Section',
                'property' => 'name',
                'empty_option'   => 'Select section',
            ),
            'attributes' => array(
                'required' => true,
                'class' =>'select2',

            )
        ));

         

       
            
        $this->add(array(
            'name' => 'submit',
            'attributes' => array(
                'type'  => 'submit',
                'value' => 'New section trait',
                'class' => 'btn btn-primary',
            ),
        )); 
    }

     public function setObjectManager(ObjectManager $objectManager)
    {
        $this->objectManager = $objectManager;

        return $this;
    }

    public function getObjectManager()
    {
        return $this->objectManager;
    }

     public function getInputFilterSpecification()
        {
            return array(
            'section' => array(
                'required' => false,
                'validators' => array(
                    array(
                        'name' => 'DoctrineModule\Validator\NoObjectExists',
                        'options' => array(
                            'object_repository' =>$this->objectManager->getRepository('Admin\Entity\TraitSetup'),
                            'fields' => 'section',
                            'messages' => array(
                            'objectFound' => 'This section trait setup already exists !'
                            ),
                        )
                    )
                )
            ),
        );

        }
}