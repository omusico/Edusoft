<?php
namespace Admin\Form;
use DoctrineModule\Persistence\ObjectManagerAwareInterface;
use Doctrine\Common\Persistence\ObjectManager;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject as DoctrineHydrator;
use Zend\InputFilter\InputFilterProviderInterface;
use Zend\Form\Form;
use Admin\Entity\School;

class SchoolForm extends Form implements ObjectManagerAwareInterface,InputFilterProviderInterface
{   protected $objectManager;
    
    public function __construct(ObjectManager $objectManager)
    {   $this->setObjectManager($objectManager);

        parent::__construct('school');
        $this->setAttribute('method', 'post');
        $this->setAttribute('class', '');
        $this->setHydrator(new DoctrineHydrator($objectManager, 'Admin\Entity\School'));


        $this->add(array(
            'name' => 'name',
            'attributes' => array(
                'type'  => 'text',
                'placeholder' =>'Enter school name',
                'class' =>'form-control',
                'id'=>'name',
                'required' => true,
            ),
          
        ));

         $this->add(array(
            'name' => 'type',
            'attributes' => array(
                'type'  => 'text',
                'placeholder' =>'Enter school type',
                'class' =>'form-control',
                'id'=>'type',
                'required' => false,
            ),
           
        ));

          $this->add(array(
            'name' => 'motto',
            'attributes' => array(
                'type'  => 'text',
                'placeholder' =>'Enter school motto',
                'class' =>'form-control',
                'id'=>'name',
                'required' => false,
            ),
           
        ));

           $this->add(array(
            'name' => 'establish',
            'attributes' => array(
                'type'  => 'text',
                'placeholder' =>'Enter date of establishment',
                'class' =>'form-control',
                'id'=>'establish',
                'required' => false,
            ),
        ));

        $this->add(array(
            'name' => 'email',
            'attributes' => array(
                'type'  => 'text',
                'placeholder' =>'Enter school email address',
                'class' =>'form-control',
                'id'=>'email',
                'required' => false,
            ),
          
        ));

        $this->add(array(
            'name' => 'website',
            'attributes' => array(
                'type'  => 'text',
                'placeholder' =>'Enter school website address',
                'class' =>'form-control',
                'id'=>'website',
                'required' => false,
            ),
          
        ));

        $this->add(array(
            'name' => 'address',
            'attributes' => array(
                'type'  => 'text',
                'placeholder' =>'Enter school address',
                'class' =>'form-control',
                'id'=>'address',
                'required' => false,
            ),
          
        ));

        $this->add(array(
            'name' => 'mobile',
            'attributes' => array(
                'type'  => 'text',
                'placeholder' =>'Enter school phone number',
                'class' =>'form-control',
                'id'=>'mobile',
                'required' => false,
            ),
          
        ));

        $this->add(array(
            'name' => 'jambCode',
            'attributes' => array(
                'type'  => 'text',
                'placeholder' =>'Jamb school center code',
                'class' =>'form-control',
                'id'=>'jamb',
                'required' => false,
            ),
          
        ));
        $this->add(array(
            'name' => 'waecCode',
            'attributes' => array(
                'type'  => 'text',
                'placeholder' =>'Waec school center code',
                'class' =>'form-control',
                'id'=>'waec',
                'required' => false,
            ),
          
        ));
        $this->add(array(
            'name' => 'necoCode',
            'attributes' => array(
                'type'  => 'text',
                'placeholder' =>'Neco school center code',
                'class' =>'form-control',
                'id'=>'neco',
                'required' => false,
            ),
          
        ));
        $this->add(array(
            'name' => 'nabtedCode',
            'attributes' => array(
                'type'  => 'text',
                'placeholder' =>'Nabted school center code',
                'class' =>'form-control',
                'id'=>'nabted',
                'required' => false,
            ),
          
        ));
        $this->add(array(
            'name' => 'logo',
            'attributes' => array(
                'type'  => 'file',
                'placeholder' =>'upload school logo',
                'onchange' =>'showimagepreview(this)',
                'id'=>'sslogo',
                'required' => false,
            ),
          
        ));

        $this->add(array(
            'name' => 'signature',
            'attributes' => array(
                'type'  => 'file',
                'placeholder' =>'Upload principal signature',
                'onchange' =>'showpreview(this)',
                'id'=>'sign',
                'required' => false,
            ),
          
        ));
     

       
            
        $this->add(array(
            'name' => 'submit',
            'attributes' => array(
                'type'  => 'submit',
                'value' => 'Save school info',
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
                'logo' => array(
                    'required' => false,
                    'filters'  => array(
                        array(
                            'name' => 'FileRenameUpload',
                            'options'=>array(
                                'target'               => './public/data/uploads/settings',
                                'overwrite' =>true,
                               // 'randomize'            => true,
                                'use_upload_extension' => true,
                                'use_upload_name'  =>true,
                            ),
                        ),
                    ),
            ),
            'signature' => array(
                'required' => false,
                'filters'  => array(
                    array(
                        'name' => 'FileRenameUpload',
                        'options'=>array(
                            'target'               => './public/data/uploads/settings',
                            'overwrite' =>true,
                           // 'randomize'            => true,
                            'use_upload_extension' => true,
                            'use_upload_name'  =>true,
                        ),
                    ),
                ),
            ),
        );

        }

    

      
}