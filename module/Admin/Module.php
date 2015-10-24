<?php

namespace Admin;

use Zend\ModuleManager\ModuleManager;
use Zend\Mvc\MvcEvent;

class Module
{     public function onBootstrap(MvcEvent $e)
    {
    $sharedEvents        = $e->getApplication()->getEventManager()->getSharedManager();
        $sharedEvents->attach('Zend\Mvc\Controller\AbstractActionController','dispatch', 
             function($e) {
                $result = $e->getResult();
                if ($result instanceof \Zend\View\Model\ViewModel) {
                    $result->setTerminal($e->getRequest()->isXmlHttpRequest());
                   //if you want no matter request is, the layout is disabled, you can
                   //set true : $result->setTerminal(true);
                }
        });
    }



    public function getViewHelperConfig() {
        return array(
            'factories' => array(
                'myHelper' => function($sm){
                    return new \Admin\View\Helper\CurrentSessionHelper($sm->getServiceLocator());
                },
                'picHelper' => function($sm){
                    return new \Admin\View\Helper\PicHelper($sm->getServiceLocator()->get('picService'));
                },

            ),
           'invokables' => array(
                'formCollection' => 'Admin\Form\View\Helper\FieldCollection',
                'fieldRow' => 'Admin\Form\View\Helper\FieldRow',
                 'formelementerrors' => 'Application\Helper\FormElementErrors',
            ),
            );
    }

   

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
}