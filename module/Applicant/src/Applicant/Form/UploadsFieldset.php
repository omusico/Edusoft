<?php 
namespace Applicant\Form;

use Applicant\Entity\Upload;
use Zend\Form\Fieldset;
use Zend\InputFilter\InputFilterProviderInterface;
use Doctrine\Common\Persistence\ObjectManager;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject as DoctrineHydrator;


class UploadFieldset extends Fieldset implements InputFilterProviderInterface
{
    public function __construct(ObjectManager $objectManager)
    {
        parent::__construct('upload');
        $this->setAttribute('enctype', 'multipart/form-data');
        $this->setAttribute('method', 'post');
        $this->setHydrator(new DoctrineHydrator($objectManager))
             ->setObject(new Upload());
   

        $this->add(array(
            'type' => 'Zend\Form\Element\Hidden',
            'name' => 'id'
        ));

        $this->add(array(
            'name' => 'name',
            'attributes' => array(
                'type'  => 'text',
                'placeholder' =>'File Name',
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
            'name' => 'upload',
            'attributes' => array(
                'type'  => 'Zend\Form\Element\File',
                'placeholder' =>'Upload',
                'onchange' =>'showimagepreview(this)',
                'required' => false,                
            ),
            'options' => array(
                'label' => 'image',
            ),
            'label_attributes' => array(
                'class' => 'input', 
                ),
        ));




      
  }

   public function getInputFilterSpecification()
        {
            return array(
            'upload' => array(
                    'required' => false,
                    'filters'  => array(
                        array(
                            'name' => 'FileRenameUpload',
                            'options'=>array(
                                'target'               => $this_dir,
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