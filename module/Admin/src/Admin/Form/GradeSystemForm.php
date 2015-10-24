<?php
namespace Admin\Form;

use Doctrine\Common\Persistence\ObjectManager;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject as DoctrineHydrator;
use Zend\Form\Form;

class GradeSystemForm extends Form
{
    public function __construct(ObjectManager $objectManager)
    {
        parent::__construct('gradesystem');
        $this->setAttribute('method', 'post');
         $this->setHydrator(new DoctrineHydrator($objectManager, 'Admin\Entity\GradeFormat'));

        // Add the user fieldset, and set it as the base fieldset
        $GradeSystemFieldset = new GradeSystemFieldset($objectManager);
        $GradeSystemFieldset->setUseAsBaseFieldset(true);
        $this->add($GradeSystemFieldset);


 $this->add(array(
            'name' => 'submit',
            'attributes' => array(
                'type'  => 'submit',
                'value' => 'Add',
                'class' => 'btn btn-primary',
            ),
        )); 

        // … add CSRF and submit elements …

        // Optionally set your validation group here
    }
}