<?php 
namespace Admin\Form;

use Admin\Entity\Student;
use Admin\Form\PersonFieldset;
use Zend\Form\Fieldset;
use Zend\InputFilter\InputFilterProviderInterface;
use Doctrine\Common\Persistence\ObjectManager;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject as DoctrineHydrator;


class StudentFieldset extends Fieldset implements InputFilterProviderInterface
{  protected $objectManager;
    public function __construct(ObjectManager $objectManager)
    {
        parent::__construct('student');
         $this->setAttribute('enctype', 'multipart/form-data');
         $this->setAttribute('method', 'post');
        $this->setHydrator(new DoctrineHydrator($objectManager))
             ->setObject(new Student());
             $this->objectManager=$objectManager;
   

        $this->add(array(
            'type' => 'Zend\Form\Element\Hidden',
            'name' => 'id'
        ));

        $this->add(array(
            'type' => 'Zend\Form\Element\Hidden',
            'name' => 'status'
        ));

           $this->add(array(
            'name' => 'image',
            'attributes' => array(
                'type'  => 'Zend\Form\Element\File',
                'placeholder' =>'Photo',
                'onchange' =>'showimagepreview(this)',
                'required' => false,
          
                
            ),
            'options' => array(
                'label' => 'Address',
            ),
            'label_attributes' => array(
                'class' => 'input', 
                ),
        ));

     

        $this->add(array(
            'name' => 'admNo',
            'attributes' => array(
                'type'  => 'text',
                'placeholder' =>'Admission Number',
                'class' =>'form-control',
                'required' => false,
            ),
            'options' => array(
                'label' => 'AdmNo',
            ),
            'label_attributes' => array(
                'class' => 'input', 
                ),
        ));



        $this->add(array(
            'name' => 'admDate',
            'attributes' => array(
                'type'  => 'Zend\Form\Element\Text',
                'placeholder' =>'Date Admitted',
                'class' => 'datepicker', 
                'id' =>'admDate',
                'data-dateformat'=>'dd/mm/yy'
            ),
            'options' => array(
                'label' => 'Last Name',
            ),
            'label_attributes' => array(
                'class' => 'hasDatepicker', 
                ),
        ));


        $this->add(array(
            'name' => 'year',
            'type' => 'DoctrineModule\Form\Element\ObjectSelect',
            'options' => array(
                'label' => 'Session',
                'object_manager' => $objectManager,
                'target_class' => 'Admin\Entity\Year',
                'property' => 'name',
                'empty_option'   => 'Year Started',
            ),
            'attributes' => array(
                'required' => true,
                'class'=>'select2',
            )
        ));

         $this->add(array(
            'name' => 'term',
            'type' => 'DoctrineModule\Form\Element\ObjectSelect',
            'options' => array(
                'label' => 'Session',
                'object_manager' => $objectManager,
                'target_class' => 'Admin\Entity\Term',
                'property' => 'name',
                'empty_option'   => 'Term Started',
            ),
            'attributes' => array(
                'required' => true,
                'class'=>'select2',
            )
        ));

        $this->add(array(
            'name' => 'section',
            'type' => 'DoctrineModule\Form\Element\ObjectSelect',
            'options' => array(
                'label' => 'State',
                'object_manager' => $objectManager,
                'target_class' => 'Admin\Entity\Section',
                'property' => 'name',
                'empty_option'   => 'Section Started',
            ),
            'attributes' => array(
                'required' => true,
                'id'=>'section',
                'class'=>'select2',
            )
        ));

         $this->add(array(
            'name' => 'class',
            'type' => 'DoctrineModule\Form\Element\ObjectSelect',
            'options' => array(
                'label' => 'Class',
                'object_manager' => $objectManager,
                'target_class' => 'Admin\Entity\Classes',
                'property' => 'name',
               
            ),
            'attributes' => array(
                'required' => true,
                'class'=>'select2',
            )
        ));


        
        $personFieldset = new PersonFieldset($objectManager);
        $this->add($personFieldset);
        }
   
         public function getInputFilterSpecification()
        {
            return array(
                'image' => array(
                    'required' => false,
                    'filters'  => array(
                        array(
                            'name' => 'FileRenameUpload',
                            'options'=>array(
                                'target'               => './public/data/uploads/students',
                                'overwrite' =>true,
                               // 'randomize'            => true,
                                'use_upload_extension' => true,
                                'use_upload_name'  =>true,
                            ),
                        ),
                    ),
            ),
            'admNo' => array(
                'validators' => array(
                    array(
                        'name' => 'DoctrineModule\Validator\NoObjectExists',
                        'options' => array(
                            'object_repository' =>$this->objectManager->getRepository('Admin\Entity\Student'),
                            'fields' => 'admNo',
                            'messages' => array(
                            'objectFound' => 'A student with this Admission already exists !'
                            ),
                        )
                    )
                )
            ),
        );

        }
       
  }


 