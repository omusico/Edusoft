<?php
namespace EduUser;

return array(
     'controllers' => array(
        'invokables' => array(
            'EduUser\Controller\Crud' => 'EduUser\Controller\CrudController',
            'EduUser\Controller\Role' => 'EduUser\Controller\RoleController',     
        ),
    ),
 'router' => array(
        'routes' => array(
            'crud' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/users[/:action][/:id]',
                    'defaults' => array(
                        '__NAMESPACE__' => 'EduUser\Controller',
                        'controller' => 'Crud',
                        'action' => 'index',
                    ),
                ),
                'may_terminate' => true,
            ),
            'role' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/roles[/:action][/:id]',
                    'defaults' => array(
                        '__NAMESPACE__' => 'EduUser\Controller',
                        'controller' => 'Role',
                        'action' => 'index',
                    ),
                ),
                'may_terminate' => true,
            ),
        ),
     ),
    'doctrine' => array(
        'driver' => array(
            // overriding zfc-user-doctrine-orm's config
            'zfcuser_entity' => array(
                'class' => 'Doctrine\ORM\Mapping\Driver\AnnotationDriver',
                'paths' => __DIR__ . '/../src/EduUser/Entity',
            ),
 
            'orm_default' => array(
                'drivers' => array(
                    'EduUser\Entity' => 'zfcuser_entity',
                ),
            ),
        ),
    ),
 
    'zfcuser' => array(
        // telling ZfcUser to use our own class
        'user_entity_class'       => 'EduUser\Entity\User',
        // telling ZfcUserDoctrineORM to skip the entities it defines
        'enable_default_entities' => false,
        'new_user_default_role' => 'applicant',
    ),
 
    'bjyauthorize' => array(
        // Using the authentication identity provider, which basically reads the roles from the auth service's identity
        'identity_provider' => 'BjyAuthorize\Provider\Identity\AuthenticationIdentityProvider',
 
        'role_providers'        => array(
            // using an object repository (entity repository) to load all roles into our ACL
            'BjyAuthorize\Provider\Role\ObjectRepositoryProvider' => array(
                'object_manager'    => 'doctrine.entitymanager.orm_default',
                'role_entity_class' => 'EduUser\Entity\Role',
            ),
        ),
    ),

     'view_manager' => array(
        'template_map' =>array(
            'EduUser/layout'=>__DIR__. '/../view/layout/layout.phtml',
            ),
        'template_path_stack' => array(
             __DIR__ . '/../view'
        ),
        'strategies' => array(
            'ViewJsonStrategy',
        ),
        
        'display_exceptions' => true,
    ),
);