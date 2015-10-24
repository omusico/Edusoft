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

use Zend\View\Helper\AbstractHelper;



class CurrentSessionHelper extends AbstractHelper 
{
    public function __invoke()
    {
       $entityManager= $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');
       $session=$entityManager->createQuery("SELECT s FROM Session s ORDER BY s.id DESC")
       						  ->setMaxResult(1)
       						  ->getResult();
       return $session;
    }
}
