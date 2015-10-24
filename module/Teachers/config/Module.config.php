<?php
// http://stackoverflow.com/questions/13007477/doctrine-2-and-zf2-integration
namespace Teachers; // SUPER important for Doctrine othervise can not find the Entities

return array(
    'controllers' => array(
        'invokables' => array(
            'Teachers\Controller\Teachers' => 'Teachers\Controller\TeachersController',
                
        ),
    ),  
   'router' => array(
        'routes' => array(
            'teachers' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/teachers[/:action][/:id]',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Teachers\Controller',
                        'controller' => 'Teachers',
                        'action' => 'dashboard',
                    ),
                ),
                'may_terminate' => true,
            ),
        ),
    ),
       'view_manager' => array(
        'template_map' =>array(
              'teachers/layout'=>__DIR__. '/../view/layout/layout.phtml',
            ),
        'template_path_stack' => array(
            'teachers' => __DIR__ . '/../view'
        ),
        'strategies' => array(
            'ViewJsonStrategy',
        ),

        
        'display_exceptions' => true,
    ),
);