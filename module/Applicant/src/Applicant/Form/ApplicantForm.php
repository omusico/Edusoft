<?php
namespace Applicant\Form;

use Doctrine\Common\Persistence\ObjectManager;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject as DoctrineHydrator;
use Zend\InputFilter;
use Zend\Form\Form;

class ApplicantForm extends Form
{
    public function __construct(ObjectManager $objectManager){
        parent::__construct('applicant-form');
        $this->setAttribute('class', 'smart-form');
        $this->setAttribute('enctype','multipart/form-data');
       
        // The form will hydrate an object of type "subject"
        $this->setHydrator(new DoctrineHydrator($objectManager, 'Applicant\Entity\Applicant'));
        
        // Add the user fieldset, and set it as the base fieldset
        $PersonFieldset = new PersonFieldset($objectManager);
        $PersonFieldset->setUseAsBaseFieldset(true);
        $this->add($PersonFieldset);
        
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