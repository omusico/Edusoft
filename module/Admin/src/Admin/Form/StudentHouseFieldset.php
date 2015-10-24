<?php 
namespace Admin\Form;

use Admin\Entity\StudentHouse;
use Zend\Form\Fieldset;
use Zend\InputFilter\InputFilterProviderInterface;
use Doctrine\Common\Persistence\ObjectManager;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject as DoctrineHydrator;


class StudentHouseFieldset extends Fieldset
{
    public function __construct(ObjectManager $objectManager)
    {
        parent::__construct('studenthouse');
         $this->setAttribute('method', 'post');
        $this->setHydrator(new DoctrineHydrator($objectManager))
             ->setObject(new StudentHouse());
   

        $this->add(array(
            'type' => 'Zend\Form\Element\Hidden',
            'name' => 'id'
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
            'name' => 'student',
            'type' => 'Zend\Form\Element\Hidden',          
        ));

              

         $this->add(array(
            'name' => 'house',
            'type' => 'DoctrineModule\Form\Element\ObjectSelect',
            'options' => array(
                'label' => 'House',
                'object_manager' => $objectManager,
                'target_class' => 'Admin\Entity\House',
                'property' => 'name',
                'empty_option'   => 'Choose A House',
            ),
            'attributes' => array(
                'class'=>'select2',
            )
        ));

       
        }

             
  }


 