<?php
namespace Admin\Form;

use Zend\InputFilter\Factory as InputFactory;
use Zend\InputFilter\InputFilter;

class TermFilter extends InputFilter
{
	public function __construct($sm)
	{
		// self::__construct(); // parnt::__construct(); - trows and error
		$this->add(array(
            'name'     => 'name',
            'required' => true,
            'filters'  => array(
                array('name' => 'StripTags'),
                array('name' => 'StringTrim'),
            ),
            'validators' => array(
                array(
                    'name'    => 'StringLength',
                    'options' => array(
                        'encoding' => 'UTF-8',
                        'min'      => 1,
                        'max'      => 100,
                    ),
                ),
                array(
                    'name'		=> 'DoctrineModule\Validator\NoObjectExists',
                    'options' => array(
                        'object_repository' => $sm->get('doctrine.entitymanager.orm_default')->getRepository('Admin\Entity\Term'),
                        'fields'            => 'name'
                    ),
                ),
            ),
        ));	
	}
}