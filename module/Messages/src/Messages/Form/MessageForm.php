<?php 
namespace Messages\Form;


use Zend\Form\Form;
use Zend\InputFilter\InputFilterProviderInterface;
use Doctrine\Common\Persistence\ObjectManager;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject as DoctrineHydrator;
use Doctrine\Common\Collections\Criteria;


class MessageForm extends Form
{       protected $objectManager;

    public function __construct(ObjectManager $objectManager)
    { 
        parent::__construct('message');
         $this->objectManager = $objectManager;


      $this->add(array(
        'type' => 'text',
            'name' => 'subject',
            'attributes' => array(
                'placeholder' =>'Enter Subject',
                'class' =>'form-control',
            ),
          
        ));

            $this->add(array(
        'type' => 'textarea',
            'name' => 'message',
            'attributes' => array(
                'placeholder' =>'Message',
                'class' =>'form-control',
                'id'=>'emailbody',
            ),
          
        ));


    $this->add(
    array(
        'type' => 'DoctrineModule\Form\Element\ObjectSelect',
        'name' => 'to',
        'options' => array(
            'object_manager' => $objectManager,
            'multiple' => true,
            'target_class'   => 'EduUser\Entity\User',
             'label_generator' => function($targetEntity) {
                return $targetEntity->getDisplayName() . ' - ' . $targetEntity->getEmail();
            },
            'is_method'      => true,
            'find_method'    => array(
                'name'   => 'matching',
                'params' => array(
                    'criteria' => Criteria::create()->where(
                        Criteria::expr()->eq('state', 1)
                ),),
            ),
        ),
        'attributes' => array(
                'required' => true,
                'class'=>'select2',
                        'multiple' => true,
            )
    )
 );


            $this->add(array(
            'name' => 'submit',
            'attributes' => array(
                'type'  => 'submit',
                'value' => 'Send',
                'id' => 'Send',
                'class' => 'btn btn-primary',
               
            ),
        ));




}
   
}