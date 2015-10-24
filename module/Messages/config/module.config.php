<?php
// http://stackoverflow.com/questions/13007477/doctrine-2-and-zf2-integration
namespace Messages; // SUPER important for Doctrine othervise can not find the Entities

return array(
	'controllers' => array(
        'invokables' => array(
            'Messages\Controller\Messages' => 'Messages\Controller\MessagesController',
            'Messages\Controller\Studentspm' => 'Messages\Controller\StudentspmController',
            'Messages\Controller\Staffspm' => 'Messages\Controller\StaffspmController',
            'Messages\Controller\Guardianspm' => 'Messages\Controller\GuardianspmController',
       			
        ),
    ),	
   'router' => array(
        'routes' => array(
            'messages' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/messages[/:action][/:id]',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Messages\Controller',
                        'controller' => 'Messages',
                        'action' => 'inbox',
                    ),
                ),
                'may_terminate' => true,
            ),
           'studentspm' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/studentspm[/:action][/:id]',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Messages\Controller',
                        'controller' => 'Studentspm',
                        'action' => 'inbox',
                    ),
                ),
                'may_terminate' => true,
            ),
            'staffspm' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/staffspm[/:action][/:id]',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Messages\Controller',
                        'controller' => 'Staffspm',
                        'action' => 'inbox',
                    ),
                ),
                'may_terminate' => true,
            ),
             'guardianspm' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/guardianspm[/:action][/:id]',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Messages\Controller',
                        'controller' => 'Guardianspm',
                        'action' => 'inbox',
                    ),
                ),
                'may_terminate' => true,
            ),
        ),
    ),
       'view_manager' => array(
       
        'template_path_stack' => array(
            'messages' => __DIR__ . '/../view'
        ),
        'strategies' => array(
            'ViewJsonStrategy',
        ),

        
        'display_exceptions' => true,
    ),

         // Doctrine config
    'doctrine' => array(
        'driver' => array(
            __NAMESPACE__ . '_driver' => array(
                'class' => 'Doctrine\ORM\Mapping\Driver\AnnotationDriver',
                'cache' => 'array',
                'paths' => array(__DIR__ . '/../src/' . __NAMESPACE__ . '/Entity')
            ),
            'orm_default' => array(
                'drivers' => array(
                    __NAMESPACE__ . '\Entity' => __NAMESPACE__ . '_driver'
                )
            )
        )
    )
);