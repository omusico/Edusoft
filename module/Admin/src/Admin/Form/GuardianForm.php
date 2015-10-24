<?php
namespace Admin\Form;

use Doctrine\Common\Persistence\ObjectManager;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject as DoctrineHydrator;
use Zend\InputFilter;
use Zend\Form\Form;

class GuardianForm extends Form
{
    public function __construct(ObjectManager $objectManager){
        parent::__construct('guardian');
        $this->setAttribute('class', 'smart-form');
        // The form will hydrate an object of type "subject"
        $this->setHydrator(new DoctrineHydrator($objectManager, 'Admin\Entity\Guardian'));
        
        // Add the user fieldset, and set it as the base fieldset
        $guardianFieldset = new GuardianFieldset($objectManager);
        $guardianFieldset->setUseAsBaseFieldset(true);
        $this->add($guardianFieldset);
        
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