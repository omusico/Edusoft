<?php
namespace Admin\Form;

use Doctrine\Common\Persistence\ObjectManager;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject as DoctrineHydrator;
use Zend\Form\Form;

class TraitNameForm extends Form
{
    public function __construct(ObjectManager $objectManager)
    {
        parent::__construct('traitname');
        $this->setAttribute('method', 'post');
         $this->setHydrator(new DoctrineHydrator($objectManager, 'Admin\Entity\TraitName'));

        // Add the user fieldset, and set it as the base fieldset
        $CaFormatFieldset = new TraitNameFieldset($objectManager);
        $CaFormatFieldset->setUseAsBaseFieldset(true);
        $this->add($CaFormatFieldset);


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