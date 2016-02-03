<?php
/**
 * Edusoft Cloud Based School Management System
 *
 * @author Isaac Bitrus 
 * @copyright Copyright (c) 2013 Isaac Bitrus (http://www.edusoft.com.ng)
 */

namespace Admin\View\Helper;

use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

use Zend\View\Helper\AbstractHelper;



class NotificationsHelper extends AbstractHelper 
{
    public function __invoke()
    {	  
        echo $this->view->FlashMessenger()->render('error', array('alert', 'alert-danger'));
        echo $this->view->FlashMessenger()->render('success', array('alert', 'alert-success'));
        echo $this->view->FlashMessenger()->render('default', array('alert', 'alert-info'));
        $this->view->FlashMessenger()->getPluginFlashMessenger()->clearCurrentMessagesFromNamespace('default');
        $this->view->FlashMessenger()->getPluginFlashMessenger()->clearCurrentMessagesFromNamespace('success');
        $this->view->FlashMessenger()->getPluginFlashMessenger()->clearCurrentMessagesFromNamespace('error');
    }
}
