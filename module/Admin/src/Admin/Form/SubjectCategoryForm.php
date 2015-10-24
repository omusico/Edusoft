<?php
namespace Admin\Form;


use Zend\Form\Form;
use Admin\Entity\SubjectCategory;
use Doctrine\Common\Persistence\ObjectManager;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject as DoctrineHydrator;

class SubjectCategoryForm extends Form
{
     public function __construct(ObjectManager $objectManager)
    {
        parent::__construct('term');

        $this->setHydrator(new DoctrineHydrator($objectManager,'Admin\Entity\SubjectCategory'))
             ->setObject(new SubjectCategory());

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
                'placeholder' =>'Category name',
                'class' =>'form-control',

            ),
            'options' => array(
                'label' => 'Category Name',
            ),
            'label_attributes' => array(
                'class' => 'input', 
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
}