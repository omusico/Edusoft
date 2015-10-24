<?php
/**
 * ZF-Hipsters Bootstrap Flash Messenger (https://github.com/zf-hipsters)
 *
 * @link      https://github.com/zf-hipsters/bootstrap-flash-messenger for the canonical source repository
 * @copyright Copyright (c) 2013 ZF-Hipsters
 * @license   http://www.apache.org/licenses/LICENSE-2.0 Apache Licence, Version 2.0
 */

namespace Messages\View\Helper;

use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Messages\Service\MessageService;

use Zend\View\Helper\AbstractHelper;



class MessageHelper extends AbstractHelper
{	
        /**
     * @var MessageService
     */
    protected $MessageService;



    public function __construct(MessageService $MessageService) {
        $this->MessageService = $MessageService;
       
    }

    public function getMessageService() {
        return $this->MessageService;
    }


		

    public function __invoke()
    { return $this->getMessageService()->getMsgCount();
    }

}
