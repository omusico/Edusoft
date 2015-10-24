<?php
namespace Admin\Form;

use Doctrine\Common\Persistence\ObjectManager;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject as DoctrineHydrator;
use Zend\Form\Form;

class UpdateForm extends Form
{
    public function __construct(ObjectManager $objectManager){
        parent::__construct('section');
       
       
        // The form will hydrate an object of type "Post"
        $this->setHydrator(new DoctrineHydrator($objectManager, 'Admin\Entity\Section'));
        
        // Add the user fieldset, and set it as the base fieldset
        $sectionFieldset = new SectionFieldset($objectManager);
        $sectionFieldset->setUseAsBaseFieldset(true);
        $this->add($sectionFieldset);
        
        // … add CSRF and submit elements …
        
        // Optionally set your validation group here        
        
       
         $this->add(array(
            'name' => 'submit',
            'attributes' => array(
                'type'  => 'submit',
                'value' => 'Update Section',
                'class' => 'btn btn-primary',
            ),
        ));
    }
}