<?php
// http://stackoverflow.com/questions/13007477/doctrine-2-and-zf2-integration
namespace Students; // SUPER important for Doctrine othervise can not find the Entities

return array(
	'controllers' => array(
        'invokables' => array(
            'Students\Controller\Students' => 'Students\Controller\StudentsController',
       			
        ),
    ),	
   'router' => array(
        'routes' => array(
            'students' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/students[/:action][/:id]',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Students\Controller',
                        'controller' => 'Students',
                        'action' => 'dashboard',
                    ),
                ),
                'may_terminate' => true,
            ),
        ),
    ),
       'view_manager' => array(
        'template_map' =>array(
              'Students/layout'=>__DIR__. '/../view/layout/layout.phtml',
            ),
        'template_path_stack' => array(
            'students' => __DIR__ . '/../view'
        ),
        'strategies' => array(
            'ViewJsonStrategy',
        ),

        
        'display_exceptions' => true,
    ),
);