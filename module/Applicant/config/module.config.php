<?php
// http://stackoverflow.com/questions/13007477/doctrine-2-and-zf2-integration
namespace Applicant; // SUPER important for Doctrine othervise can not find the Entities

return array(
	'controllers' => array(
        'invokables' => array(
            'Applicant\Controller\Applicant' => 'Applicant\Controller\ApplicantController',
       			
        ),
    ),	
   'router' => array(
        'routes' => array(
            'applicant' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/applicant[/:action][/:id]',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Applicant\Controller',
                        'controller' => 'Applicant',
                        'action' => 'dashboard',
                    ),
                ),
                'may_terminate' => true,
            ),
        ),
    ),
       'view_manager' => array(
        'template_path_stack' => array(
            'applicant' => __DIR__ . '/../view'
        ),
        'strategies' => array(
            'ViewJsonStrategy',
        ),

        
        'display_exceptions' => true,
    ),
);