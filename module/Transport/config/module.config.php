<?php
// http://stackoverflow.com/questions/13007477/doctrine-2-and-zf2-integration
namespace Transport; // SUPER important for Doctrine othervise can not find the Entities

return array(
	'controllers' => array(
        'invokables' => array(
            'Transport\Controller\Transport' => 'Transport\Controller\TransportController',
      
          			
        ),
    ),	
 'router' => array(
        'routes' => array(
            'transport' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/transport[/:action][/:id]',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Transport\Controller',
                        'controller' => 'Transport',
                        'action' => 'route',
                    ),
                ),
                'may_terminate' => true,
            ),
         ),
      ),
    'view_manager' => array(
    	'template_map' => array(
            'students/layout' => __DIR__ . '/../view/layout/studentlayout.phtml',
            
          ),
        'template_path_stack' => array(
            'transport' => __DIR__ . '/../view'
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