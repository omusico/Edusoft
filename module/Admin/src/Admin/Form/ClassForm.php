<?php
namespace Admin\Form;
use DoctrineModule\Persistence\ObjectManagerAwareInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Zend\Form\Form;

class AcademicsessionForm extends Form implements ObjectManagerAwareInterface
{ protected $objectManager;
    public function __construct(ObjectManager $objectManager)
    {   $this->setObjectManager($objectManager);

        parent::__construct('classes');
        $this->setAttribute('method', 'post');
        $this->setAttribute('role', 'form-horizontal');
        $this->setAttribute('class', 'form-inline');

       

         $this->add(array(
            'name' => 'section',
            'type' => 'DoctrineModule\Form\Element\ObjectSelect',
            'options' => array(
                'label' => 'section',
                'object_manager' => $this->getObjectManager(),
                'target_class' => 'Admin\Entity\Section',
                'property' => 'name'
            ),
            'attributes' => array(
                'required' => true
            )
        ));

       
            
        $this->add(array(
            'name' => 'submit',
            'attributes' => array(
                'type'  => 'submit',
                'value' => 'New class',
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
}