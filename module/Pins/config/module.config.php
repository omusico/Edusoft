<?php
namespace Pins;
 

return array(
    'controllers' => array(
        'invokables' => array(
            'Pins\Controller\Applicationpins' => 'Pins\Controller\ApplicationpinsController',
            'Pins\Controller\Tuitionpins' => 'Pins\Controller\TuitionpinsController',
            'Pins\Controller\Resultpins' => 'Pins\Controller\ResultpinsController',
     
            
        ),
    ),
    'router' => array(
        'routes' => array(
            'applicationpins' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/applicationpins[/:action][/:id]',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Pins\Controller',
                        'controller' => 'Applicationpins',
                        'action' => 'dashboard',
                    ),
                ),
                'may_terminate' => true,
            ),
             'tuitionpins' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/tuitionpins[/:action][/:id]',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Pins\Controller',
                        'controller' => 'Tuitionpins',
                        'action' => 'dashboard',
                    ),
                ),
                'may_terminate' => true,
            ),
             'resultpins' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/resultpins[/:action][/:id]',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Pins\Controller',
                        'controller' => 'Resultpins',
                        'action' => 'dashboard',
                    ),
                ),
                'may_terminate' => true,
            ),
            
        ),
    ),
    'view_manager' => array(
        'template_map' =>array(
            'adminlayout/layout'=>__DIR__. '/../view/layout/applicantlayout.phtml',
            ),
        'template_path_stack' => array(
            'pins' => __DIR__ . '/../view'
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