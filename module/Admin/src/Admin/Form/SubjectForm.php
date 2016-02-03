<?php 
namespace Admin\Form;

use Admin\Entity\Subject;
use Zend\Form\Form;
use Zend\InputFilter\InputFilterProviderInterface;
use Doctrine\Common\Persistence\ObjectManager;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject as DoctrineHydrator;


class SubjectForm extends Form implements InputFilterProviderInterface
{  protected $objectManager;
    public function __construct(ObjectManager $objectManager)
    {
        parent::__construct('subject');
         $this->setAttribute('method', 'post');
        $this->setHydrator(new DoctrineHydrator($objectManager))
             ->setObject(new Subject());
             $this->objectManager=$objectManager;
   

        $this->add(array(
            'type' => 'Zend\Form\Element\Hidden',
            'name' => 'id'
        ));

       
         $this->add(array(
            'name' => 'name',
            'attributes' => array(
                'type'  => 'text',
                'placeholder' =>'Enter Subject Name',
                'class' =>'form-control',
                'id'=>'name',
                'required' => true,
            ),

        ));

          $this->add(array(
            'name' => 'shortName',
            'attributes' => array(
                'type'  => 'text',
                'placeholder' =>'Enter Subject ShortName',
                'class' =>'form-control',
                'id'=>'name',
                'required' => true,
            ),

        ));

        $this->add(array(
            'name' => 'description',
            'attributes' => array(
                'type'  => 'text',
                'placeholder' =>'Enter Subject Description',
                'class' =>'form-control',
                'id'=>'name'
            ),

        ));



        $this->add(array(
            'name' => 'submit',
            'attributes' => array(
                'type'  => 'submit',
                'value' => 'Add Subject',
                'class' => 'btn btn-primary',
            ),
        )); 

     
   }
         public function getInputFilterSpecification()
        {
            return array(
            'name' => array(
                'filters'  => array(
                    array('name' => 'StripTags'),
                    array('name' => 'StringTrim'),
                ),
                'validators' => array(
                    array(
                        'name' => 'DoctrineModule\Validator\NoObjectExists',
                        'options' => array(
                            'object_repository' =>$this->objectManager->getRepository('Admin\Entity\Subject'),
                            'fields' => 'name',
                            'messages' => array(
                            'objectFound' => 'This subject already exists !'
                            ),
                        )
                    )
                )
            ),
            'shortName' => array(
                'filters'  => array(
                    array('name' => 'StripTags'),
                    array('name' => 'StringTrim'),
                ),
            ),
            'description' => array(
                'filters'  => array(
                    array('name' => 'StripTags'),
                    array('name' => 'StringTrim'),
                ),
            ),
        );

    }
       
  }

    


 