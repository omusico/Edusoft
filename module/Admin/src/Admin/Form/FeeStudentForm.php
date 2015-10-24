<?php
namespace Admin\Form;

use Doctrine\Common\Persistence\ObjectManager;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject as DoctrineHydrator;
use Zend\Form\Form;

class FeeStudentForm extends Form
{
    public function __construct(ObjectManager $objectManager)
    {
        parent::__construct('feestudent');
        $this->setAttribute('method', 'post');
         $this->setHydrator(new DoctrineHydrator($objectManager, 'Admin\Entity\FeeStudent'));

        // Add the user fieldset, and set it as the base fieldset
        $feeStudentFieldset = new FeeStudentFieldset($objectManager);
        $feeStudentFieldset->setUseAsBaseFieldset(true);
        $this->add($feeStudentFieldset);


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