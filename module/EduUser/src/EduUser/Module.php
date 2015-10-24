<?php
namespace EduUser;


use Zend\Mvc\MvcEvent;
use EduUser\Listener\EduUserListener;
use Zend\ModuleManager\ModuleManager;
 
class Module {
    public function onBootstrap(MvcEvent $mvcEvent)
    {
        $em = $mvcEvent->getApplication()->getEventManager();
        $em->attach(new EduUserListener());
    } 
   
    public function getConfig()
    {
        return include __DIR__ . '/../../config/module.config.php';
    }
 
    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/../../src/' . __NAMESPACE__,
                ),
            ),
        );
    }
 public function getServiceConfig() {
        return array(
            'factories' => array(
                'zfcusercrud_options' => function ($sm) {
            $config = $sm->get('Config');
            return $config['zfcusercrud'];
        }
            )
        );
    }
}