<?php 
namespace Admin\Form;

use Admin\Entity\Subject;
use Zend\Form\Fieldset;
use Zend\InputFilter\InputFilterProviderInterface;
use Doctrine\Common\Persistence\ObjectManager;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject as DoctrineHydrator;


class SubjectFieldset extends Fieldset implements InputFilterProviderInterface
{       protected $objectManager;

    public function __construct(ObjectManager $objectManager)
    { 
        parent::__construct('subject');
         $this->objectManager = $objectManager;


        $this->setHydrator(new DoctrineHydrator($objectManager))
             ->setObject(new Subject());

        $this->add(array(
            'type' => 'Zend\Form\Element\Hidden',
            'name' => 'id'
        ));

        $this->add(array(
            'name' => 'name',
            'attributes' => array(
                'type'  => 'text',
                'placeholder' =>'Enter subject name',
                'class' =>'form-control',
            ),
            'options' => array(
                'label' => 'name',
            ),
            'label_attributes' => array(
                'class' => 'input', 
                ),
        ));

        $this->add(array(
            'name' => 'code',
            'attributes' => array(
                'type'  => 'text',
                'placeholder' =>'Enter subject code',
                'class' =>'form-control',
            ),
            'options' => array(
                'label' => 'Code',
            ),
            'label_attributes' => array(
                'class' => 'input', 
                ),
        ));

        $this->add(array(
            'name' => 'description',
            'attributes' => array(
                'type'  => 'Zend\Form\Element\Textarea',
                'placeholder' =>'Enter subject code',
                'class' =>'form-control',
            ),
            'options' => array(
                'label' => 'description',
            ),
            'label_attributes' => array(
                'class' => 'input', 
                ),
        ));

        $this->add(array(
            'name' => 'category',
            'type' => 'DoctrineModule\Form\Element\ObjectSelect',
            'options' => array(
                'label' => 'Category',
                'object_manager' => $objectManager,
                'target_class' => 'Admin\Entity\SubjectCategory',
                'property' => 'name',
                'empty_option'   => 'please choose category',
            ),
            'attributes' => array(
                'class'=>'select2',
                'required' => false,
            )
        ));

        
    }


     public function getInputFilterSpecification()
        {
            return array(
                    'category' => array(
                    'required' => false,
                   
               
            ),
            
            'name' => array(
                'validators' => array(
                    array(
                        'name' => 'DoctrineModule\Validator\NoObjectExists',
                        'options' => array(
                            'object_repository' => $this->objectManager->getRepository('Admin\Entity\Subject'),
                            'fields' => 'name',
                            'messages' => array(
                            'objectFound' => 'A subject with this name already exist!'
                            ),
                        )
                    )
                )
            ),
        );

        }

   
}