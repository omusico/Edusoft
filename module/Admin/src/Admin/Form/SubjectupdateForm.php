<?php
namespace Admin\Form;

use Doctrine\Common\Persistence\ObjectManager;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject as DoctrineHydrator;
use Zend\Form\Form;
use Zend\InputFilter\InputFilterProviderInterface;

class SubjectupdateForm extends Form
{   protected $objectManager;
    public function __construct(ObjectManager $objectManager){
        parent::__construct('subject-form');
        $this->objectManager = $objectManager;
       
        // The form will hydrate an object of type "subject"
        $this->setHydrator(new DoctrineHydrator($objectManager, 'Admin\Entity\Subject'));
        
        // Add the user fieldset, and set it as the base fieldset
        $subjectFieldset = new SubjectFieldset($objectManager);
        $subjectFieldset->setUseAsBaseFieldset(true);
        $this->add($subjectFieldset);
        
        // … add CSRF and submit elements …
        
        // Optionally set your validation group here

            
        $this->add(array(
            'name' => 'submit',
            'attributes' => array(
                'type'  => 'submit',
                'value' => 'Add Subject',
                'class' => 'btn btn-primary',
            ),
        )); 


        $this->setValidationGroup(array( 
           
            'subject' => array(
             'category', 
                ),
            ));
    }

     

}