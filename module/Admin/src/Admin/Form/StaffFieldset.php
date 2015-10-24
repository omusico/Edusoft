<?php 
namespace Admin\Form;

use Admin\Entity\Staff;
use Zend\Form\Fieldset;
use Zend\InputFilter\InputFilterProviderInterface;
use Doctrine\Common\Persistence\ObjectManager;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject as DoctrineHydrator;


class StaffFieldset extends Fieldset implements InputFilterProviderInterface
{  protected $objectManager;
    public function __construct(ObjectManager $objectManager)
    {
        parent::__construct('staff');
        $this->objectManager = $objectManager;
        $this->setAttribute('enctype','multipart/form-data');
         $this->setAttribute('method', 'post');
         $this->setHydrator(new DoctrineHydrator($objectManager))
             ->setObject(new Staff());
   

        $this->add(array(
            'type' => 'Zend\Form\Element\Hidden',
            'name' => 'id'
        ));

        $this->add(array(
            'name' => 'fname',
            'attributes' => array(
                'type'  => 'text',
                'placeholder' =>'First Name',
                'class' =>'form-control',
                'id'=>'fname',
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
            'name' => 'lname',
            'attributes' => array(
                'type'  => 'text',
                'placeholder' =>'Last Name',
                'class' =>'form-control',
               'id'=>'lname',
               'required' => true,
            ),
            'options' => array(
                'label' => 'Last Name',
            ),
            'label_attributes' => array(
                'class' => 'input', 
                ),
        ));


        $this->add(array(
            'name' => 'mname',
            'attributes' => array(
                'type'  => 'text',
                'placeholder' =>'Middle Name',
                'class' =>'form-control',
                'id'=>'mname',
            ),
            'options' => array(
                'label' => 'Middle Name',
            ),
            'label_attributes' => array(
                'class' => 'input', 
                ),
        ));

        $this->add(array(
            'name' => 'dob',
            'attributes' => array(
                'type'  => 'Zend\Form\Element\Text',
                'placeholder' =>'Date of Birth',
                'class' => 'datepicker', 
                'id' =>'dob',
                'format' =>'d/m/Y',
                'required' => true,
            ),
            'options' => array(
                'label' => 'Date of birth',
            ),
            'label_attributes' => array(

                ),
        ));

                $this->add(array(
            'name' => 'twitter',
            'attributes' => array(
                'type'  => 'Zend\Form\Element\Text',
                'placeholder' =>'Twitter account', 
                'id' =>'twitter',
                'required' => false,
            ),
            'options' => array(
                'label' => 'Date of birth',
            ),
            'label_attributes' => array(

                ),
        ));

                $this->add(array(
            'name' => 'facebook',
            'attributes' => array(
                'type'  => 'Zend\Form\Element\Text',
                'placeholder' =>'Facebook account',
                'id' =>'facebook',
                'required' => false,
            ),
            'options' => array(
                'label' => 'Date of birth',
            ),
            'label_attributes' => array(

                ),
        ));

                $this->add(array(
            'name' => 'email',
            'attributes' => array(
                'type'  => 'Zend\Form\Element\Text',
                'placeholder' =>'Enter email address',
                'class' => 'email', 
                'id' =>'email',
                'required' => false,
            ),
            'options' => array(
                'label' => 'Date of birth',
            ),
            'label_attributes' => array(

                ),
        ));

         $this->add(array(
            'name' => 'religion',
            'type' => 'Zend\Form\Element\Select',
            'options' => array(
                'label' => 'religion',
                'empty_option' => 'Select Your Religion',
                'value_options' => array(
                    'Christianity' => 'Christianity',
                    'Islam' => 'Islam',
                    'Traditional' => 'Traditional',
                    'Others' => 'Others',
                ),
            ),
            'attributes' => array(
                'required' => true,
                'class' =>'select2',
                 'id'=>'religion'
                
            )
        ));

        $this->add(array(
            'name' => 'mobile1',
            'attributes' => array(
                'type'  => 'text',
                'data-mask'=>'+234 (803) 333-3333',
                'placeholder' =>'Enter  mobile 1',
                'class' =>'form-control',
                'id'=>'mobile'
            ),
            'options' => array(
                'label' => 'Mobile Number',
            ),
            'label_attributes' => array(
                'class' => 'input', 
                ),
        ));

          $this->add(array(
            'name' => 'mobile2',
            'attributes' => array(
                'type'  => 'text',
                'data-mask'=>'+234 (803) 333-3333',
                'placeholder' =>'Enter mobile 2',
                'class' =>'form-control',
                'id'=>'mobile'
            ),
            'options' => array(
                'label' => 'Mobile Number',
            ),
            'label_attributes' => array(
                'class' => 'input', 
                ),
        ));

                    $this->add(array(
            'name' => 'staffno',
            'attributes' => array(
                'type'  => 'text',
                'placeholder' =>'Staff Number',
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
            'name' => 'employdate',
            'attributes' => array(
                'type'  => 'Zend\Form\Element\Text',
                'placeholder' =>'Date of appointment',
                'class' => 'datepicker', 
                'id' =>'employdate',
                'format'=>'d/m/Y'
            ),
            'options' => array(
                'label' => 'Last Name',
            ),
            'label_attributes' => array(
                'class' => 'hasDatepicker', 
                ),
        ));

         $this->add(array(
            'name' => 'nokRel',
            'attributes' => array(
                'type'  => 'text',
                'placeholder' =>'Next-Of-Kin Relationship',
                'class' =>'form-control',
                'id'=>'nokRel',
                'required' => false,
            ),
            'options' => array(
                'label' => 'Next-Of-Kin Relationship',
            ),
            'label_attributes' => array(
                'class' => 'input', 
                ),
        ));

        $this->add(array(
            'name' => 'nokName',
            'attributes' => array(
                'type'  => 'text',
                'placeholder' =>'Full Name of Next-Of-Kin',
                'class' =>'form-control',
                'id'=>'nokName',
                'required' => true,
            ),
            'options' => array(
                'label' => 'Name of Next-Of-Kin',
            ),
            'label_attributes' => array(
                'class' => 'input', 
                ),
        ));

        $this->add(array(
            'name' => 'nokMobile',
            'attributes' => array(
                'type'  => 'text',
                'placeholder' =>'Next-Of-Kin Mobile ',
                'class' =>'form-control',
                'id'=>'nokMobile',
                'required' => false,                             
            ),
            
            'options' => array(
                'label' => 'Mobile of Next-Of-Kin',
            ),
            'label_attributes' => array(
                'class' => 'input', 
                ),
        ));

         $this->add(array(
            'name' => 'sex',
            'type' => 'Zend\Form\Element\Select',
            'options' => array(
                'label' => 'Sex',
                'empty_option' => 'Select your gender',
                'value_options' => array(
                    'Male' => 'Male',
                    'Female' => 'Female',
                ),
            ),
            'attributes' => array(
                'required' => true,
                'class' =>'select2',
                
            )
            

        ));

        $this->add(array(
            'name' => 'country',
            'type' => 'DoctrineModule\Form\Element\ObjectSelect',
            'options' => array(
                'label' => 'Country',
                'object_manager' => $objectManager,
                'target_class' => 'Admin\Entity\Country',
                'property' => 'name',
                'empty_option'   => 'Choose your country',
            ),
            'attributes' => array(
                'required' => true,
                'class' =>'select2',

            )
        ));

        $this->add(array(
            'name' => 'state',
            'type' => 'DoctrineModule\Form\Element\ObjectSelect',
            'options' => array(
                'label' => 'State',
                'object_manager' => $objectManager,
                'target_class' => 'Admin\Entity\State',
                'property' => 'name',
                'empty_option'   => 'Choose your state',
            ),
            'attributes' => array(
                'required' => true,
                'class' =>'select2',
                'id' =>'state'
                
            )
        ));

      
         $this->add(
                array(
                    'type' => 'DoctrineModule\Form\Element\ObjectSelect',
                    'name' => 'lga',
                    'options' => array(
                        'object_manager'     => $objectManager,
                        'target_class'       => 'Admin\Entity\Lga',
                        'property'           => 'name',
                        'empty_option'   => 'Choose your L.G.A',
                    ),
                     'attributes' => array(
                        'required' => true,
                        'class'=>'select2',
                        'id' =>'lga'
               
                )
         ));

        $this->add(array(
            'name' => 'raddress',
            'attributes' => array(
                'type'  => 'Zend\Form\Element\Textarea',
                'placeholder' =>'Residential Address',
                'class' =>'form-control',
                'required' => true,
            ),
            'options' => array(
                'label' => 'Address',
            ),
            'label_attributes' => array(
                'class' => 'input', 
                ),
        ));

         $this->add(array(
            'name' => 'paddress',
            'attributes' => array(
                'type'  => 'Zend\Form\Element\Textarea',
                'placeholder' =>'Permanent Address',
                'class' =>'form-control',
                'required' => true,
            ),
            'options' => array(
                'label' => 'Address',
            ),
            'label_attributes' => array(
                'class' => 'input', 
                ),
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
            'name' => 'qualification',
            'type' => 'Zend\Form\Element\Select',
            'options' => array(
                'label' => 'Highest Qualification',
                'empty_option' => 'Select highest qualification',
                'value_options' => array(
                    'FSLC' => 'FSLC',
                    'SSCE' => 'SSCE',
                    'ND' => 'ND',
                    'HND' => 'HND',
                    'BSC' => 'BSC',
                ),
            ),
            'attributes' => array(
                'required' => true,
                'class' =>'select2',
                 'id'=>'qualification'
                
            )
        ));

        

        $this->add(array(
            'name' => 'level',
            'type' => 'DoctrineModule\Form\Element\ObjectSelect',
            'options' => array(
                'label' => 'Level',
                'object_manager' => $objectManager,
                'target_class' => 'Admin\Entity\Level',
                'property' => 'name',
                'empty_option'   => 'Choose a level',
            ),
            'attributes' => array(
                'required' => true,
                'class' =>'select2',

            )
        ));

        $this->add(array(
                    'name' => 'stafftype',
                    'type' => 'DoctrineModule\Form\Element\ObjectSelect',
                    'options' => array(
                        'label' => 'stafftype',
                        'object_manager'  => $objectManager,
                        'target_class'  => 'Admin\Entity\StaffType',
                        'property'  => 'name',
                        'empty_option'   => 'Choose a staff type',
                    ),
                     'attributes' => array(
                        'required' => false,
                        'class'=>'select2',
                        'id'=>'stafftype'
               
                )
         ));

        $this->add(array(
            'name' => 'step',
            'type' => 'DoctrineModule\Form\Element\ObjectSelect',
            'options' => array(
                'label' => 'State',
                'object_manager' => $objectManager,
                'target_class' => 'Admin\Entity\Step',
                'property' => 'name',
                'empty_option'   => 'Select step',
            ),
            'attributes' => array(
                'required' => true,
                'class' =>'select2',
                'id' =>'state'
                
            )
        ));

         $this->add(array(
            'name' => 'year',
            'type' => 'DoctrineModule\Form\Element\ObjectSelect',
            'options' => array(
                'label' => 'State',
                'object_manager' => $objectManager,
                'target_class' => 'Admin\Entity\Year',
                'property' => 'name',
                'empty_option'   => 'Select Year',
            ),
            'attributes' => array(
                'required' => true,
                'class' =>'select2',
                'id' =>'state'
                
            )
        ));

      
         



       
       
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
                                'target'               => './public/data/uploads/staffs',
                                'overwrite' =>true,
                               // 'randomize'            => true,
                                'use_upload_extension' => true,
                                'use_upload_name'  =>true,
                            ),
                        ),
                    ),
            ),
            'staffno' => array(
                'required' => false,
                'validators' => array(
                    array(
                        'name' => 'DoctrineModule\Validator\NoObjectExists',
                        'options' => array(
                            'object_repository' =>$this->objectManager->getRepository('Admin\Entity\Staff'),
                            'fields' => 'staffno',
                            'messages' => array(
                            'objectFound' => 'A staff with this number already exists !'
                            ),
                        )
                    )
                )
            ),
        );

        }
 
}