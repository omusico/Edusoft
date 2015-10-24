<?php
namespace Admin;
 

return array(
      'controllers' => array(
        'invokables' => array(
            'Admin\Controller\Session' => 'Admin\Controller\SessionController',
            'Admin\Controller\Section' => 'Admin\Controller\SectionController',
            'Admin\Controller\Year' => 'Admin\Controller\YearController',
            'Admin\Controller\Subject' => 'Admin\Controller\SubjectController',
            'Admin\Controller\Class' => 'Admin\Controller\ClassController', 
            'Admin\Controller\SubjectCategory' => 'Admin\Controller\SubjectCategoryController', 
            'Admin\Controller\Student' => 'Admin\Controller\StudentController',
            'Admin\Controller\Staff' => 'Admin\Controller\StaffController',
            'Admin\Controller\Salary' => 'Admin\Controller\SalaryController',
            'Admin\Controller\Guardian' => 'Admin\Controller\GuardianController',
            'Admin\Controller\Formmaster' => 'Admin\Controller\FormmasterController',
            'Admin\Controller\Fee' => 'Admin\Controller\FeeController',
            'Admin\Controller\Feecollection' => 'Admin\Controller\FeecollectionController',
            'Admin\Controller\Result' => 'Admin\Controller\ResultController',
            'Admin\Controller\Grade' => 'Admin\Controller\GradeController',
            'Admin\Controller\Trait' => 'Admin\Controller\TraitController',
            'Admin\Controller\Assessment' => 'Admin\Controller\AssessmentController',
            'Admin\Controller\Settings' => 'Admin\Controller\SettingsController',
            'Admin\Controller\Rating' => 'Admin\Controller\RatingController',
            'Admin\Controller\Attendance' => 'Admin\Controller\AttendanceController', 
              'Admin\Controller\Admin' => 'Admin\Controller\AdminController', 
                      
            
        ),
        'factories'=> array(
            'Admin\Controller\Section' => 'Admin\Factory\SectionControllerFactory', 
            'Admin\Controller\Position' => 'Admin\Factory\Controller\PositionControllerFactory' 
            ),
    ),
    'router' => array(
        'routes' => array(
            'academic' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/academic[/:action][/:id]',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Admin\Controller',
                        'controller' => 'Session',
                        'action' => 'index',
                    ),
                ),
                'may_terminate' => true,
            ),
            'position' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/position[/:action][/:id]',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Admin\Controller',
                        'controller' => 'Position',
                        'action' => 'index',
                    ),
                ),
                'may_terminate' => true,
            ),
             'admin' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/admin[/:action][/:id]',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Admin\Controller',
                        'controller' => 'Admin',
                        'action' => 'dashboard',
                    ),
                ),
                'may_terminate' => true,
            ),
             'year' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/year[/:action][/:id]',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Admin\Controller',
                        'controller' => 'Year',
                        'action' => 'index',
                    ),
                ),
                'may_terminate' => true,
            ),
          'result' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/result[/:action][/:id]',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Admin\Controller',
                        'controller' => 'Result',
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
            'section' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/section[/:action][/:id]',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Admin\Controller',
                        'controller' => 'Section',
                        'action' => 'index',
                    ),
                ),
                'may_terminate' => true,
            ),

            'classes' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/classes[/:action][/:id]',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Admin\Controller',
                        'controller' => 'Class',
                        'action' => 'index',
                    ),
                ),
                'may_terminate' => true,
            ),

            'subjectcategory' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/subjectcategory[/:action][/:id]',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Admin\Controller',
                        'controller' => 'SubjectCategory',
                        'action' => 'index',
                    ),
                ),
                'may_terminate' => true,
            ),

          'student' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/student[/:action][/:id]',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Admin\Controller',
                        'controller' => 'Student',
                        'action' => 'index',
                    ),
                ),
                'may_terminate' => true,
            ),


          'staff' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/staff[/:action][/:id]',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Admin\Controller',
                        'controller' => 'Staff',
                        'action' => 'index',
                    ),
                ),
                'may_terminate' => true,
            ),


          'salary' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/salary[/:action][/:id]',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Admin\Controller',
                        'controller' => 'Salary',
                        'action' => 'index',
                    ),
                ),
                'may_terminate' => true,
            ),


          'guardian' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/guardian[/:action][/:id]',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Admin\Controller',
                        'controller' => 'Guardian',
                        'action' => 'index',
                    ),
                ),
                'may_terminate' => true,
            ),

          'club' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/club[/:action][/:id]',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Admin\Controller',
                        'controller' => 'Club',
                        'action' => 'index',
                    ),
                ),
                'may_terminate' => true,
            ),
         'fee' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/fee[/:action][/:id]',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Admin\Controller',
                        'controller' => 'Fee',
                        'action' => 'index',
                    ),
                ),
                'may_terminate' => true,
            ),
          'formmaster' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/formmaster[/:action][/:id]',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Admin\Controller',
                        'controller' => 'Formmaster',
                        'action' => 'index',
                    ),
                ),
                'may_terminate' => true,
            ),
            'collection' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/collection[/:action][/:id]',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Admin\Controller',
                        'controller' => 'Feecollection',
                        'action' => 'index',
                    ),
                ),
                'may_terminate' => true,
            ),
             'grade' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/grade[/:action][/:id]',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Admin\Controller',
                        'controller' => 'Grade',
                        'action' => 'index',
                    ),
                ),
                'may_terminate' => true,
            ),
            'trait' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/trait[/:action][/:id]',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Admin\Controller',
                        'controller' => 'Trait',
                        'action' => 'index',
                    ),
                ),
                'may_terminate' => true,
            ),
         'settings' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/settings[/:action][/:id]',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Admin\Controller',
                        'controller' => 'Settings',
                        'action' => 'index',
                    ),
                ),
                'may_terminate' => true,
            ),
             'assessment' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/assessment[/:action][/:id]',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Admin\Controller',
                        'controller' => 'Assessment',
                        'action' => 'index',
                    ),
                ),
                'may_terminate' => true,
            ),
            'rating' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/rating[/:action][/:id]',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Admin\Controller',
                        'controller' => 'Rating',
                        'action' => 'index',
                    ),
                ),
                'may_terminate' => true,
            ),
            'attendance' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/attendance[/:action][/:id]',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Admin\Controller',
                        'controller' => 'Attendance',
                        'action' => 'index',
                    ),
                ),
                'may_terminate' => true,
            ),
        ),
    ),
    'service_manager'=>array(
        'invokables'=>array(
        ),
        'factories' => array(
            'picService' => 'Admin\Factory\Service\PicServiceFactory',
            'Admin\Service\SettingsService'=>'Admin\Factory\Service\SettingsServiceFactory',
            'Admin\Service\AdminDashboardService'=>'Admin\Factory\Service\AdminDashboardServiceFactory',
             'Admin\Service\StudentDashboardService'=>'Admin\Factory\Service\StudentDashboardServiceFactory',
            'Admin\Service\ParentsDashboardService'=>'Admin\Factory\Service\ParentsDashboardServiceFactory',
            'Admin\Service\StaffDashboardService'=>'Admin\Factory\Service\StaffDashboardServiceFactory',
         ),
    ),
    'view_manager' => array(
        'template_map' =>array(
            'adminlayout/layout'=>__DIR__. '/../view/layout/Adminlayout.phtml',
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
            'CurrentSessionHelper'=> 'Admin\View\Helper\CurrentSessionHelper',
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