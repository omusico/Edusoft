<?php
namespace Admin\Form;


use Zend\Form\Form;
use Admin\Entity\Term;
use Doctrine\Common\Persistence\ObjectManager;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject as DoctrineHydrator;

class TermForm extends Form
{
     public function __construct(ObjectManager $objectManager)
    {
        parent::__construct('term');

        $this->setHydrator(new DoctrineHydrator($objectManager,'Admin\Entity\Term'))
             ->setObject(new Term());

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
                'placeholder' =>'Term name',
                'class' =>'form-control',

            ),
            'options' => array(
                'label' => 'Term Name',
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