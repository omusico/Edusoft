<?php
namespace Admin\Form;

use Doctrine\Common\Persistence\ObjectManager;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject as DoctrineHydrator;
use Zend\InputFilter;
use Zend\Form\Form;

class WardForm extends Form
{
    public function __construct(ObjectManager $objectManager){
        parent::__construct('ward-form');
        $this->setAttribute('class', 'smart-form');
        $this->setAttribute('enctype','multipart/form-data');
       
        // The form will hydrate an object of type "subject"
        $this->setHydrator(new DoctrineHydrator($objectManager, 'Admin\Entity\Student'));
        
        // Add the user fieldset, and set it as the base fieldset
        $StudentFieldset = new WardFieldset($objectManager);
        $StudentFieldset->setUseAsBaseFieldset(true);
        // $StudentFieldset->remove('guardian');
        $this->add($StudentFieldset);

        //$guardianFieldset->remove('guardian');
        //$personFieldset = new PersonFieldset($objectManager);
        //$personFieldset->remove('guardian');

       // $this->add($userFieldset);
        
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