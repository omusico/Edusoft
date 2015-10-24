<?php
namespace Transport\Form;
use DoctrineModule\Persistence\ObjectManagerAwareInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Zend\InputFilter\InputFilterProviderInterface;
use Zend\Form\Form;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject as DoctrineHydrator;
use Doctrine\Common\Collections\Criteria;

class AllotTransportForm extends Form
{   protected $objectManager;
    public function __construct(ObjectManager $objectManager)
    {  // $this->setObjectManager($objectManager);
        $this->objectManager=$objectManager;

        parent::__construct('allot-transport');
        $this->setAttribute('method', 'post');
         $this->setHydrator(new DoctrineHydrator($objectManager, 'Transport\Entity\AllotTransport'));
        
       $session=$objectManager->getRepository('Admin\Entity\Session')->findOneBy(array(),array('id'=>'DESC'));

        $this->add(array(
        'name' => 'fare',
        'attributes' => array(
            'type'  => 'text',
            'placeholder' =>'Enter paid fare',
            'class' =>'form-control',
            'id'=>'name'
        ),
        ));

        $this->add(
        array(
        'type' => 'DoctrineModule\Form\Element\ObjectSelect',
        'name' => 'route',
        'options' => array(
            'object_manager' => $objectManager,
            'target_class'   => 'Transport\Entity\SessionRoute',
             'label_generator' => function($targetEntity) {
                return $targetEntity->getRoute()->getName();
            },
            'empty_option'   => 'Select route',
            'is_method'      => true,
            'find_method'    => array(
                'name'   => 'matching',
                'params' => array(
                    'criteria' => Criteria::create()->where(
                        Criteria::expr()->eq('session', $session)
                ),),
            ),
        ),
        'attributes' => array(
                'required' => true,
                'class'=>'select2',
            )
    )
 );

     

 $this->add(
        array(
        'type' => 'DoctrineModule\Form\Element\ObjectSelect',
        'name' => 'student',
        'options' => array(
            'object_manager' => $objectManager,
            'target_class'   => 'Admin\Entity\Student',
             'label_generator' => function($targetEntity) {
                return $targetEntity->getPerson()->getFname().'-'.$targetEntity->getPerson()->getLname();
            },
            'empty_option'   => 'Select student',
            'is_method'      => true,
            'find_method'    => array(
                'name'   => 'matching',
                'params' => array(
                    'criteria' => Criteria::create()->where(
                        Criteria::expr()->eq('status','Active')
                ),),
            ),
        ),
        'attributes' => array(
                'required' => true,
                'class'=>'select2',
            )
    )
 );

            
        $this->add(array(
            'name' => 'submit',
            'attributes' => array(
                'type'  => 'submit',
                'value' => 'Allot tp',
                'class' => 'btn btn-primary',
            ),
        )); 
    }

  

}