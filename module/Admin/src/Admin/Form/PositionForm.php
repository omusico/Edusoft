<?php
namespace Admin\Form;
use DoctrineModule\Persistence\ObjectManagerAwareInterface;
use Doctrine\Common\Persistence\ObjectManager;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject as DoctrineHydrator;
use Zend\InputFilter\InputFilterProviderInterface;
use Zend\Form\Form;
use Admin\Entity\Position;

class PositionForm extends Form implements ObjectManagerAwareInterface, InputFilterProviderInterface
{   protected $objectManager;
    
    public function __construct(ObjectManager $objectManager)
    {   $this->setObjectManager($objectManager);

        parent::__construct('position');
        $this->setAttribute('method', 'post');
        $this->setAttribute('class', 'smart-form');
        $this->setHydrator(new DoctrineHydrator($objectManager, 'Admin\Entity\Position'));


        $this->add(array(
            'name' => 'description',
            'attributes' => array(
                'type'  => 'text',
                'placeholder' =>'Write a description',
                'class' =>'form-control',
                'id'=>'fname',
                'required' => false,
            ),
        ));

        $this->add(array(
            'name' => 'name',
            'attributes' => array(
                'type'  => 'text',
                'placeholder' =>'Enter a name',
                'class' =>'form-control',
                'id'=>'fname',
                'required' => true,
            ),
        ));

          $this->add(array(
            'name' => 'category',
            'type' => 'Zend\Form\Element\Select',
            'options' => array(
                'label' => 'category',
                'empty_option' => 'Select category',
                'value_options' => array(
                    'Staff' => 'Staff',
                    'Student' => 'Student',
                ),
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
                'value' => 'Save Position',
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
            'name' => array(
                'required' => true,
                'validators' => array(
                    array(
                        'name' => 'DoctrineModule\Validator\NoObjectExists',
                        'options' => array(
                            'object_repository' =>$this->objectManager->getRepository('Admin\Entity\Position'),
                            'fields' => 'name',
                            'messages' => array(
                            'objectFound' => 'This position  already exists !'
                            ),
                        )
                    )
                )
            ),
        );

        }
}