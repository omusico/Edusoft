<?php 
namespace Admin\Form;

use Admin\Entity\FeePayments;
use Zend\Form\Fieldset;
use Zend\InputFilter\InputFilterProviderInterface;
use Doctrine\Common\Persistence\ObjectManager;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject as DoctrineHydrator;


class FeePaymentsFieldset extends Fieldset 
{
    public function __construct(ObjectManager $objectManager)
    {
        parent::__construct('feepayments');

        $this->setHydrator(new DoctrineHydrator($objectManager))
             ->setObject(new FeePayments());

          $this->add(array(
            'name'=>'id',
            'attributes'=>array(
                'type'=>'hidden',)
            ,
            ));

        $this->add(array(
            'name' => 'receipt',
            'attributes' => array(
                'type'  => 'text',
                'placeholder' =>'Enter Teller No.',
                'class' =>'form-input',

            ),
           
            'label_attributes' => array(
                'class' => 'input', 
                ),
           
        ));

        $this->add(array(
            'name' => 'dop',
            'attributes' => array(
                'type'  => 'text',
                'placeholder' =>'Enter Date Of  Payment.',
                'class' =>'form-input datepicker',

            ),
           
            'label_attributes' => array(
                'class' => 'input', 
                ),
           
        ));

          $this->add(array(
            'name' => 'method',
            'type' => 'Zend\Form\Element\Select',
            'options' => array(
                'label' => 'religion',
                'empty_option' => 'Method of Payment',
                'value_options' => array(
                    'Bank Deposit' => 'Bank Deposit',
                    'Cash' => 'Cash',
                ),
            ),
            'attributes' => array(
                'required' => false,
                'class' =>'select2',
                 'id'=>''
                
            )
        ));

        $this->add(array(
            'name' => 'amount',
            'attributes' => array(
                'type'  => 'text',
                'placeholder' =>'Enter an amount',
                'class' =>'form-input',

            ),
           'label_attributes' => array(
                'class' => 'input', 
                ),
        ));

       
        
    }



   
}