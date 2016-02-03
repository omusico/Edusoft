<?php 
namespace Admin\Form;

use Admin\Entity\Section;
use Zend\Form\Form;
use Zend\InputFilter\InputFilterProviderInterface;
use Doctrine\Common\Persistence\ObjectManager;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject as DoctrineHydrator;


class SectionForm extends Form implements InputFilterProviderInterface
{  protected $objectManager;
    public function __construct(ObjectManager $objectManager)
    {
        parent::__construct('section');
         $this->setAttribute('method', 'post');
        $this->setHydrator(new DoctrineHydrator($objectManager))
             ->setObject(new School());
             $this->objectManager=$objectManager;
   

        $this->add(array(
            'type' => 'Zend\Form\Element\Hidden',
            'name' => 'id'
        ));

       
         $this->add(array(
            'name' => 'name',
            'attributes' => array(
                'type'  => 'text',
                'placeholder' =>'Enter Section Name',
                'class' =>'form-control',
                'id'=>'name',
                'required' => true,
            ),

        ));


        $this->add(array(
            'name' => 'submit',
            'attributes' => array(
                'type'  => 'submit',
                'value' => 'Add Section',
                'class' => 'btn btn-primary',
            ),
        )); 

     
   }
         public function getInputFilterSpecification()
        {
            return array(
            'name' => array(
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


 