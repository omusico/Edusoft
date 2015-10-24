<?php 
namespace Admin\Form;

use Admin\Entity\FeeStudent;
use Zend\Form\Fieldset;
use Zend\InputFilter\InputFilterProviderInterface;
use Doctrine\Common\Persistence\ObjectManager;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject as DoctrineHydrator;


class FeeStudentFieldset extends Fieldset 
{  protected $objectManager;
    public function __construct(ObjectManager $objectManager)
    {
        parent::__construct('feestudent');
        $this->setHydrator(new DoctrineHydrator($objectManager))
             ->setObject(new FeeStudent());
             $this->objectManager=$objectManager;
   

        $this->add(array(
            'type' => 'Zend\Form\Element\Hidden',
            'name' => 'id'
        ));


         

            $FeePaymentsFieldset = new FeePaymentsFieldset($objectManager);
            $this->add($FeePaymentsFieldset);


        }
    
  }


 