<?php 
namespace Admin\Form;

use Admin\Entity\TErm;
use Zend\Form\Form;
use Zend\InputFilter\InputFilterProviderInterface;
use Doctrine\Common\Persistence\ObjectManager;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject as DoctrineHydrator;


class TermForm extends Form implements InputFilterProviderInterface
{  protected $objectManager;
    public function __construct(ObjectManager $objectManager)
    {
        parent::__construct('term');
         $this->setAttribute('method', 'post');
        $this->setHydrator(new DoctrineHydrator($objectManager))
             ->setObject(new Term());
             $this->objectManager=$objectManager;
   

        $this->add(array(
            'type' => 'Zend\Form\Element\Hidden',
            'name' => 'id'
        ));

       
         $this->add(array(
            'name' => 'name',
            'attributes' => array(
                'type'  => 'text',
                'placeholder' =>'Enter Term Name',
                'class' =>'form-control',
                'id'=>'name',
                'required' => true,
            ),

        ));


        $this->add(array(
            'name' => 'submit',
            'attributes' => array(
                'type'  => 'submit',
                'value' => 'Add Term',
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
                            'object_repository' =>$this->objectManager->getRepository('Admin\Entity\Term'),
                            'fields' => 'name',
                            'messages' => array(
                            'objectFound' => 'This term already exists !'
                            ),
                        )
                    )
                )
            ),
        );

    }
       
  }


 