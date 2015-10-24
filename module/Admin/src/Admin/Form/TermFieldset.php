<?php 
namespace Admin\Form;

use Admin\Entity\Term;
use Zend\Form\Fieldset;
use Zend\InputFilter\InputFilterProviderInterface;
use Doctrine\Common\Persistence\ObjectManager;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject as DoctrineHydrator;


class TermFieldset extends Fieldset 
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
            'name' => 'termName',
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
        
    }

   
}