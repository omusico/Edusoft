<?php 
namespace Admin\Form;


use Zend\Form\Form;
use Zend\InputFilter\InputFilterProviderInterface;
use Doctrine\Common\Persistence\ObjectManager;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject as DoctrineHydrator;
use Doctrine\Common\Collections\Criteria;
use Admin\Entity\StudentPosition;


class StudentPositionForm extends Form
{       protected $objectManager;

    public function __construct(ObjectManager $objectManager)
    {         
        parent::__construct('studentposition');
         $this->objectManager = $objectManager;
        $this->setAttribute('method', 'post');
        $this->setAttribute('class', 'smart-form');
        $this->setHydrator(new DoctrineHydrator($objectManager, 'Admin\Entity\StudentPosition'));

       

         $this->add(array(
            'name' => 'student',
            'type' => 'DoctrineModule\Form\Element\ObjectSelect',
            'options' => array(
                'label' => 'section',
                'empty_option' => 'Select student',
                'object_manager' => $objectManager,
                'target_class' => 'Admin\Entity\Student',
                'label_generator' => function($targetEntity) {
                return $targetEntity->getPerson()->getFname() . ' - ' . $targetEntity->getPerson()->getLname();
            },
            ),
            'attributes' => array(
                'required' => true,
                'class' =>'select2'
            )
        ));
         
    $this->add(array(
            'name' => 'year',
            'attributes' => array(
                'type'  => 'text',
                'value' => '',
            ),
        ));


            $this->add(array(
            'name' => 'section',
            'type' => 'DoctrineModule\Form\Element\ObjectSelect',
            'options' => array(
                'label' => 'Session',
                'object_manager' => $objectManager,
                'target_class' => 'Admin\Entity\Section',
                'property' => 'name',
                'empty_option'   => 'Select Section',
            ),
            'attributes' => array(
                'required' => true,
                'class'=>'select2',
            )
        ));



   
         $this->add(array(
            'name' => 'position',
            'type' => 'DoctrineModule\Form\Element\ObjectSelect',
            'options' => array(
                'label' => 'position',
                'object_manager' => $objectManager,
                'target_class' => 'Admin\Entity\Position',
                'property' => 'name',
                'empty_option'   => 'Select a position',
                'is_method'      => true,
                'find_method'    => array(
                    'name'   => 'matching',
                    'params' => array(
                        'criteria' => Criteria::create()->where(
                            Criteria::expr()->neq('category','Staff')
                    )

                    ),
                )
            ),
            'attributes' => array(
                'required' => true,
                'class'=>'select2',
            )
        ));

            $this->add(array(
            'name' => 'submit',
            'attributes' => array(
                'type'  => 'submit',
                'value' => 'Save Post',
                'class' => 'btn btn-primary',
            ),
        ));


}
   
}