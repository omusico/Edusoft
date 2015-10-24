<?php
/**
 * ZF-Hipsters Bootstrap Flash Messenger (https://github.com/zf-hipsters)
 *
 * @link      https://github.com/zf-hipsters/bootstrap-flash-messenger for the canonical source repository
 * @copyright Copyright (c) 2013 ZF-Hipsters
 * @license   http://www.apache.org/licenses/LICENSE-2.0 Apache Licence, Version 2.0
 */

namespace Applicant\View\Helper;

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
