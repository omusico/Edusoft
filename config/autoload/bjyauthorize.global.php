<?php

return array(
	'bjyauthorize' => array(
		// set the 'guest' role as default (must be defined in a role provider)
		'default_role' => 'guest',


        

        /* Currently, only controller and route guards exist
         *
         * Consider enabling either the controller or the route guard depending on your needs.
         */
        'guards' => array(
    	/* If this guard is specified here (i.e. it is enabled), it will block
    	 * access to all controllers and actions unless they are specified here.
         * You may omit the 'action' index to allow access to the entire controller
         */
    		'BjyAuthorize\Guard\Controller' => array(
    			//array('controller' => 'Application\Controller\Index', 'action' => 'index', 'roles' => array('guest', 'user')),
    			// You can also specify an array of actions or an array of controllers (or both)
    			// allow "guest" and "admin" to access actions "list" and "manage" on these "index",
    			// "static" and "console" controllers
    // 			array(
    // 				'controller' => array('index', 'static', 'console'),
    // 				'action' => array('list', 'manage'),
    // 				'roles' => array('guest', 'admin')
    // 			),
    // 			array(
    // 				'controller' => array('search', 'administration'),
    // 				'roles' => array('staffer', 'admin')
    // 			),
    // 			array('controller' => 'zfcuser', 'roles' => array()),
    			// Below is the default index action used by the ZendSkeletonApplication
    			//array('controller' => 'Application\Controller\Index', 'roles' => array('guest', 'user')),
    		    array('controller' => 'Application\Controller\Index', 'roles' => array('student','admin')),
     		    array(
     		    		'controller' => 'zfcuser\Controller\User',
     		    		'action' => array('login', 'logout', 'register', 'index'),
     		    		'roles' => array('guest')),
    		    array('controller' => 'zfcuser', 'roles' => array()),
    		   
    		    array(
    		        'controller' => array('Admin\Controller\Session', 'Admin\Controller\Section', 'Admin\Controller\Position', 'Admin\Controller\Year','Admin\Controller\Subject','Admin\Controller\Class','Admin\Controller\SubjectCategory','Admin\Controller\Student','Admin\Controller\Staff','Admin\Controller\Guardian','Admin\Controller\Formmaster','Admin\Controller\Fee','Admin\Controller\Feecollection','Admin\Controller\Result','Admin\Controller\Grade','Admin\Controller\Trait','Admin\Controller\Assessment','Admin\Controller\Settings','Admin\Controller\Rating','Admin\Controller\Attendance','Admin\Controller\Admin','Messages\Controller\Messages','Transport\Controller\Transport','Pins\Controller\Resultpins','EduUser\Controller\Crud'),
    		        'roles' => array('admin')
    		    ),

           
            		    //Category's Index() is the Blog's homepage, TODO: Maybe! Change it around so theres a default home?
    		),//Controller Guard
    		

    
    		/* If this guard is specified here (i.e. it is enabled), it will block
    		 * access to all routes unless they are specified here.
            */
//     		('BjyAuthorize\Guard\Route' => array(
//     			array('route' => 'zfcuser', 'roles' => array('user', 'guest')),
//     		    array('route' => 'zfcuser/zfcchild', 'roles' => array('user', 'guest')),
//     		    array('route' => 'omni-blog', 'roles' => array('user', 'guest')),
//     		    array('route' => 'omni-blog/blogchild', 'roles' => array('user', 'guest')),
//     			array('route' => 'home', 'roles' => array('guest', 'user')),
//     		),//Route Guard
            
        ),//gaurds
    ),//bjyauthorize
);