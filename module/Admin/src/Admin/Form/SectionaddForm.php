<?php
namespace Admin\Form;
use Doctrine\Common\Persistence\ObjectManager;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject as DoctrineHydrator;
use Zend\Form\Form;
use Zend\InputFilter\InputFilterProviderInterface;
use Admin\Entity\Section;

class SectionaddForm extends Form implements InputFilterProviderInterface
{protected $objectManager;
    public function __construct(ObjectManager $objectManager)
    

    {   $this->setObjectManager($objectManager);

        parent::__construct('section');
        $this->setAttribute('method', 'post');
        $this->setHydrator(new DoctrineHydrator($objectManager))
             ->setObject(new Section());

        

        $this->add(array(
            'name'=>'id',
            'attributes'=>array(
                'type'=>'hidden',)
            ,
            ));

        $this->add(array(
            'name' => 'name',
            'attributes' => array(
                'type'  => 'text',
                'placeholder' =>'Enter section name',
                'class' =>'form-control',
            ),
            'options' => array(
                'label' => 'Name',
            ),
            'label_attributes' => array(
                'class' => 'input', 
                ),
        ));

         $this->add(array(
            'name' => 'shortname',
            'attributes' => array(
                'type'  => 'text',
                'placeholder' =>'Describe this section',
                'class' =>'form-control',
            ),
            'options' => array(
                'label' => 'Description',
            ),
            'label_attributes' => array(
                'class' => 'input', 
                ),
        ));


      
        
        
            
        $this->add(array(
            'name' => 'submit',
            'attributes' => array(
                'type'  => 'submit',
                'id' =>'submit',
                'value' => 'Add new section',
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
                            'object_repository' =>$this->objectManager->getRepository('Admin\Entity\Section'),
                            'fields' => 'name',
                            'messages' => array(
                            'objectFound' => 'This section already exists !'
                            ),
                        )
                    )
                )
            ),
        );

        }
}