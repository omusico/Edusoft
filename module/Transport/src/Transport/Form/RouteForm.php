<?php
namespace Transport\Form;
use DoctrineModule\Persistence\ObjectManagerAwareInterface;
use Doctrine\Common\Persistence\ObjectManager;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject as DoctrineHydrator;
use Zend\Form\Form;

class RouteForm extends Form implements ObjectManagerAwareInterface
{   protected $objectManager;
    public function __construct(ObjectManager $objectManager)
    {   $this->setObjectManager($objectManager);

        parent::__construct('route');
        $this->setAttribute('method', 'post');
         $this->setHydrator(new DoctrineHydrator($objectManager, 'Transport\Entity\Route'));
        
       

        $this->add(array(
        'name' => 'name',
        'attributes' => array(
            'type'  => 'text',
            'placeholder' =>'Enter route name',
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
        'name' => 'stops',
        'attributes' => array(
            'type'  => 'text',
            'placeholder' =>'Enter number of stops',
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
            'name' => 'submit',
            'attributes' => array(
                'type'  => 'submit',
                'value' => 'Add route',
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