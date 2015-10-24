<?php

namespace Messages;
use Zend\ModuleManager\ModuleManager;

class Module
{   
	
    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }

    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
    }
        public function getViewHelperConfig()
    {
        return array(
              'factories' => array(
                'MessageHelper' => function($sm){
                    return new \Messages\View\Helper\MessageHelper($sm->getServiceLocator()->get('MessageService'));
                },

            ),
            'invokables' => array(
                'privateSmartTime'=>'Messages\View\Helper\SmartTime',
            )
        );
    }
}