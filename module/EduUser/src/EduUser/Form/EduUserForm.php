<?php 
namespace EduUser\Form;


use Zend\Form\Form;
use Zend\InputFilter\InputFilterProviderInterface;
use Doctrine\Common\Persistence\ObjectManager;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject as DoctrineHydrator;
use Doctrine\Common\Collections\Criteria;


class EduUserForm extends Form
{       protected $objectManager;

    public function __construct(ObjectManager $objectManager)
    { 
        parent::__construct('edu-user');
         $this->objectManager = $objectManager;


      

    $this->add(
    array(
        'type' => 'DoctrineModule\Form\Element\ObjectSelect',
        'name' => 'staff',
        'options' => array(
            'object_manager' => $objectManager,
            'target_class'   => 'Admin\Entity\Staff',
             'label_generator' => function($targetEntity) {
                return $targetEntity->getStaffNo() . ' - ' . $targetEntity->getLname();
            },
            'empty_option'   => 'Select a staff',
            'is_method'      => true,
            'find_method'    => array(
                'name'   => 'matching',
                'params' => array(
                    'criteria' => Criteria::create()->where(
                        Criteria::expr()->eq('user', NULL)
                ),),
            ),
        ),
        'attributes' => array(
                'required' => false,
                'class'=>'select2',
            )
    )
 );

  $this->add(
    array(
        'type' => 'DoctrineModule\Form\Element\ObjectSelect',
        'name' => 'student',
        'options' => array(
            'object_manager' => $objectManager,
            'target_class'   => 'Admin\Entity\Student',
             'label_generator' => function($targetEntity) {
                return $targetEntity->getAdmNo();
            },
            'empty_option'   => 'Select a student',
            'is_method'      => true,
            'find_method'    => array(
                'name'   => 'matching',
                'params' => array(
                    'criteria' => Criteria::create()->where(
                        Criteria::expr()->eq('user', NULL)
                ),),
            ),
        ),
        'attributes' => array(
                'required' => false,
                'class'=>'select2',
            )
    )
 );
                $this->add(
    array(
        'type' => 'DoctrineModule\Form\Element\ObjectSelect',
        'name' => 'guardian',
        'options' => array(
            'object_manager' => $objectManager,
            'target_class'   => 'Admin\Entity\Guardian',
             'label_generator' => function($targetEntity) {
                return $targetEntity->getFname() . ' - ' . $targetEntity->getLname();
            },
            'empty_option'   => 'Select a guardian',
            'is_method'      => true,
            'find_method'    => array(
                'name'   => 'matching',
                'params' => array(
                    'criteria' => Criteria::create()->where(
                        Criteria::expr()->eq('user', NULL)
                ),),
            ),
        ),
        'attributes' => array(
                'required' => false,
                'class'=>'select2',
            )
    )
);

         $this->add(array(
            'name' => 'role',
            'type' => 'DoctrineModule\Form\Element\ObjectSelect',
            'options' => array(
                'label' => 'Session',
                'object_manager' => $objectManager,
                'target_class' => 'EduUser\Entity\Role',
                'property' => 'roleId',
                'empty_option'   => 'Select a role',
                'is_method'      => true,
                'find_method'    => array(
                    'name'   => 'matching',
                    'params' => array(
                        'criteria' => Criteria::create()->where(
                            Criteria::expr()->neq('roleId','student')
                    )->andwhere(
                            Criteria::expr()->neq('roleId','parent')
                    )->andwhere(
                            Criteria::expr()->neq('roleId','applicant')
                    ),

                    ),
                )
            ),
            'attributes' => array(
                'required' => true,
                'class'=>'select2',
            )
        ));

            $this->add(array(
            'name' => 'submit',
            'attributes' => array(
                'type'  => 'submit',
                'value' => 'Create User',
                'class' => 'btn btn-primary',
            ),
        ));


}
   
}