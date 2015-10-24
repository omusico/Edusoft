<?php
namespace Transport\Form;
use DoctrineModule\Persistence\ObjectManagerAwareInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Zend\InputFilter\InputFilterProviderInterface;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject as DoctrineHydrator;
use Zend\Form\Form;

class VehicleForm extends Form implements InputFilterProviderInterface
{   protected $objectManager;
    public function __construct(ObjectManager $objectManager)
    {   $this->setObjectManager($objectManager);

        parent::__construct('vehicle');
        $this->setAttribute('method', 'post');
         $this->setAttribute('enctype','multipart/form-data');
         $this->setHydrator(new DoctrineHydrator($objectManager, 'Transport\Entity\Vehicle'));
        
       

        $this->add(array(
        'name' => 'name',
        'attributes' => array(
            'type'  => 'text',
            'placeholder' =>'Enter route name',
            'class' =>'form-control',
            'id'=>'name',
            'required' => true,
        ),
        ));

         $this->add(array(
        'name' => 'code',
        'attributes' => array(
            'type'  => 'text',
            'placeholder' =>'Enter vehicle code',
            'class' =>'form-control',
            'id'=>'code',
        ),
        ));

         $this->add(array(
        'name' => 'color',
        'attributes' => array(
            'type'  => 'text',
            'placeholder' =>'Enter vehicle color',
            'class' =>'form-control',
            'id'=>'color',
        ),
        ));

        $this->add(array(
        'name' => 'seats',
        'attributes' => array(
            'type'  => 'text',
            'placeholder' =>'Enter number of seats',
            'class' =>'form-control',
            'id'=>'seats',
        ),
        ));


         $this->add(array(
        'name' => 'type',
        'type' => 'Zend\Form\Element\Select',
        'options' => array(
            'label' => 'type',
            'empty_option' => 'Select vehicle type',
            'value_options' => array(
                'bus' => 'bus',
                'car' => 'car',
                'Others' => 'Others',
            ),
        ),
        'attributes' => array(
            'class' =>'select2',
             'id'=>'type'
            
        )
        ));


        $this->add(array(
            'name' => 'image',
            'attributes' => array(
                'type'  => 'Zend\Form\Element\File',
                'placeholder' =>'Image',
                'onchange' =>'showimagepreview(this)',
                'required' => false,
          
                
            ),
        ));

            
        $this->add(array(
            'name' => 'submit',
            'attributes' => array(
                'type'  => 'submit',
                'value' => 'Add route',
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
                'image' => array(
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