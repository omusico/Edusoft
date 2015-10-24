<?php 
namespace Admin\Form;

use Admin\Entity\StaffClub;
use Zend\Form\Fieldset;
use Zend\InputFilter\InputFilterProviderInterface;
use Doctrine\Common\Persistence\ObjectManager;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject as DoctrineHydrator;


class StaffClubFieldset extends Fieldset
{
    public function __construct(ObjectManager $objectManager)
    {
        parent::__construct('staffclub');
         $this->setAttribute('method', 'post');
        $this->setHydrator(new DoctrineHydrator($objectManager))
             ->setObject(new StaffClub());
   

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
            'name' => 'staff',
            'type' => 'Zend\Form\Element\Hidden',          
        ));

              
        $this->add(array(
            'name' => 'club',
            'type' => 'DoctrineModule\Form\Element\ObjectSelect',
            'options' => array(
                'label' => 'House',
                'object_manager' => $objectManager,
                'target_class' => 'Admin\Entity\Club',
                'property' => 'name',
                'empty_option'   => 'Choose A Club',
            ),
            'attributes' => array(
                'class'=>'select2',
            )
        ));


       
        }

             
  }


 