<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class IndexController extends AbstractActionController
{      public function indexAction()
    {    $entityManager=$this->getServiceLocator()->get('Doctrine\ORM\EntityManager');
$roles = $this->serviceLocator->get('BjyAuthorize\Provider\Identity\ProviderInterface')->getIdentityRoles();
foreach ($roles as $role) {
    $role=$role->getRoleId();
    }
        
        //var_dump($role);die;
             switch ($role){

             case "admin": 
                  return $this->redirect()->toRoute('admin',array('controller'=>'admin', 'action'=>'dashboard')); 
                    break;
             case "student":              
                 return  $this->redirect()->toRoute('admin',array('controller'=>'admin', 'action'=>'dashboard'));
                   break;
            case "staff":              
                 return  $this->redirect()->toRoute('teachers',array('controller'=>'teachers', 'action'=>'dashboard'));
                   break;
            default:
                return $this->redirect()->toRoute('fee');
                break;
        }

        return new ViewModel();

    }
    
}
