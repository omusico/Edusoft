<?php
namespace Admin\Form;

use Zend\Form\Form;

class YearForm extends Form
{
    public function __construct($name = null)
    {
        parent::__construct('Year');
        

        $this->add(array(
            'name'=>'id',
            'attributes'=>array(
                'type'=>'hidden',)
            ,
            ));

        $this->add(array(
            'name' => 'name',
            'attributes' => array(
                'type'  => 'text',
                'placeholder' =>'Enter year name',
                'class' =>'form-control',
            ),
            'options' => array(
                'label' => 'Year Name',
            ),
            'label_attributes' => array(
                'class' => 'input', 
                ),
        ));         
        
        
            
        $this->add(array(
            'name' => 'submit',
            'attributes' => array(
                'type'  => 'submit',
                'value' => 'Add',
                'class' => 'btn btn-primary',
            ),
        )); 
    }
}