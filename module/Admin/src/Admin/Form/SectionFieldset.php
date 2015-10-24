<?php
namespace Admin\Form;

use Admin\Entity\Section;
use Doctrine\Common\Persistence\ObjectManager;
use DoctrineModule\Form\Element\ObjectMultiCheckbox;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject as DoctrineHydrator;
use Zend\Form\Fieldset;
use Zend\InputFilter\InputFilterProviderInterface;
use Admin;

class SectionFieldset extends Fieldset 
{
    public function __construct(ObjectManager $objectManager)
    {
        parent::__construct('section');
        $this->setHydrator(new DoctrineHydrator($objectManager,'Admin\Entity\Section'))
             ->setObject(new Section());

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
                'placeholder' =>'Enter section name',
                'class' =>'form-control',
                'id' =>'name'
            ),
            'options' => array(
                'label' => 'Name',
            ),
            'label_attributes' => array(
                'class' => 'input', 
                ),
        ));

        $this->add(array(
            'name' => 'shortname',
            'attributes' => array(
                'type'  => 'text',
                'placeholder' =>'Short name',
                'class' =>'form-control',
            ),
            'options' => array(
                'label' => 'shortname',
            ),
            'label_attributes' => array(
                'class' => 'input', 
                ),
        ));
        //$objectManager->getRepository('OmniBlog\Form\CategoryPostAssociation')->findBy(array('post_id' => $this->po))
        //$this->getEntityManager()->find('OmniBlog\Entity\Post', $id);
        //DoctrineModule\Form\Element\ObjectMultiCheckbox $xmy = new \DoctrineModule\Form\Element\ObjectMultiCheckbox();

        //$subjectFieldset = new SubjectFieldset($objectManager);
      //  $this->add(array(
       //     'type'    => 'DoctrineModule\Form\Element\ObjectMultiCheckbox',
      //      'name' => 'subjects',
    	///	'options' => array(
			///	'label' => 'Select Subjects',
    		   // 'object_manager' => $objectManager,
    		 // 'should_create_template' => true,
        //		'target_class'   => 'Admin\Entity\Subject',
    ///		    'property'       => 'name',
	//			'target_element' => $subjectFieldset,
    //		  ),
      //  ));


         $subjectFieldset = new SubjectFieldset($objectManager);
        $this->add(array(
            'type'    => 'DoctrineModule\Form\Element\ObjectMultiCheckbox',
            'name' => 'subject',
            'options' => array(
                'label' => 'Select Subjects',
                'object_manager' => $objectManager,
                'should_create_template' => true,
                'target_class'   => 'Admin\Entity\Subject',
                'property'       => 'code',
                'target_element' => $subjectFieldset,
                  ),
            'label_attributes' => array(
                'class' => 'checkbox', 
                ),
        ));
      }
   

}