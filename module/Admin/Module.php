<?php


namespace Admin;

use Zend\Mvc\MvcEvent;
use Zend\ModuleManager\ModuleManager;
 
class Module 
{   public function init(ModuleManager $mm)
    {
        $mm->getEventManager()->getSharedManager()->attach(__NAMESPACE__,
        'dispatch', function($e) {
            $e->getTarget()->layout('adminlayout/layout');
        });
    }
   
     public function onBootstrap(MvcEvent $e)
    {   $em = $e->getApplication()->getEventManager();
        $sharedEvents  = $em->getSharedManager();
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
                'CurrentAcademicYearHelper' => function($sm){
                    return new \Admin\View\Helper\CurrentAcademicYearHelper($sm->getServiceLocator());
                },

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
