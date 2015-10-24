<?php
/**
 * ZF-Hipsters Bootstrap Flash Messenger (https://github.com/zf-hipsters)
 *
 * @link      https://github.com/zf-hipsters/bootstrap-flash-messenger for the canonical source repository
 * @copyright Copyright (c) 2013 ZF-Hipsters
 * @license   http://www.apache.org/licenses/LICENSE-2.0 Apache Licence, Version 2.0
 */

namespace Admin\View\Helper;

use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Admin\Service\PicService;

use Zend\View\Helper\AbstractHelper;



class PicHelper extends AbstractHelper
{	
        /**
     * @var PicService
     */
    protected $picService;



    public function __construct(PicService $picService) {
        $this->picService = $picService;
       
    }

    public function getPicService() {
        return $this->picService;
    }


		

    public function __invoke()
    { return $this->getPicService()->getPic();
    }

}
