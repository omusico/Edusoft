<?php
namespace Admin;

return array(
     'controllers' => array(
        'factories' => array(
            'Admin\Controller\Year' => 'Admin\Factory\Controller\YearControllerFactory',
            'Admin\Controller\AcademicYear' => 'Admin\Factory\Controller\AcademicYearControllerFactory',
            'Admin\Controller\Term' => 'Admin\Factory\Controller\SemesterControllerFactory',
            'Admin\Controller\Section' => 'Admin\Factory\Controller\SectionControllerFactory',
            'Admin\Controller\Subject' => 'Admin\Factory\Controller\SubjectControllerFactory',

        ),
        'invokables' => array(      
        ),
    ),
    'service_manager' => array(
        'factories' => array(
            'YearService' => 'Admin\Factory\Service\YearServiceFactory',
            'AcademicYearService' => 'Admin\Factory\Service\AcademicYearServiceFactory',
            'TermService' => 'Admin\Factory\Service\TermServiceFactory',
            'SectionService' => 'Admin\Factory\Service\SectionServiceFactory',
            'SubjectService' => 'Admin\Factory\Service\SubjectServiceFactory',
        )
    ),
 'router' => array(
        'routes' => array(
            'year' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/year[/:action][/:id]',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Admin\Controller',
                        'controller' => 'year',
                        'action' => 'index',
                    ),
                ),
                'may_terminate' => true,
            ),
            'term' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/term[/:action][/:id]',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Admin\Controller',
                        'controller' => 'Term',
                        'action' => 'index',
                    ),
                ),
                'may_terminate' => true,
            ),
           'academic-year' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/academic-year[/:action][/:id]',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Admin\Controller',
                        'controller' => 'AcademicYear',
                        'action' => 'index',
                    ),
                ),
                'may_terminate' => true,
            ),
           'section' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/school[/:action][/:id]',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Admin\Controller',
                        'controller' => 'section',
                        'action' => 'index',
                    ),
                ),
                'may_terminate' => true,
            ),
           'subject' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/subject[/:action][/:id]',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Admin\Controller',
                        'controller' => 'Subject',
                        'action' => 'index',
                    ),
                ),
                'may_terminate' => true,
            ),
        ),
     ),

      'view_manager' => array(
        'template_map' =>array(
            'adminlayout/layout'=>__DIR__. '/../view/layout/layout.phtml',
            'applicantlayout/layout'=>__DIR__. '/../view/layout/applicantlayout.phtml',
            ),
        'template_path_stack' => array(
            'admin' => __DIR__ . '/../view'
        ),
        'strategies' => array(
            'ViewJsonStrategy',
        ),

        
        'display_exceptions' => true,
    ),
    'view_helpers' => array(
        'invokables' => array(
            'NotificationsHelper' => 'Admin\View\Helper\NotificationsHelper',
        )
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