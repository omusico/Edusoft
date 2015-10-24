<?php
namespace Admin\Form;

use Doctrine\Common\Persistence\ObjectManager;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject as DoctrineHydrator;
use Zend\InputFilter;
use Zend\Form\Form;


class StaffupdateForm extends Form
{
    public function __construct(ObjectManager $objectManager){
        parent::__construct('staff-form');
        $this->setAttribute('class', 'smart-form');
        $this->setAttribute('enctype','multipart/form-data');
       
        // The form will hydrate an object of type "subject"
        $this->setHydrator(new DoctrineHydrator($objectManager, 'Admin\Entity\Staff'));
        
        // Add the user fieldset, and set it as the base fieldset
        $staffFieldset = new StaffFieldset($objectManager);
        $staffFieldset->setUseAsBaseFieldset(true);
        $this->add($staffFieldset);
        
        // … add CSRF and submit elements …
        
        // Optionally set your validation group here


      


            
        $this->add(array(
            'name' => 'submit',
            'attributes' => array(
                'type'  => 'submit',
                'value' => 'Save Details',
                'class' => 'btn btn-primary',
            ),
        )); 

       
    }
  
}