<?php
/**
 * Cloud Base Educational Management System
 *
 * @author Isaac Bitrus 
 * @copyright Copyright (c) 2015 Edusoft (http://www.edusoft.com.ng)
 */

namespace Admin\Controller;

use Zend\View\Model\JsonModel;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class AdminController extends AbstractActionController
{      
    public function dashboardAction()
    {	 $entityManager=$this->getServiceLocator()->get('Doctrine\ORM\EntityManager');
        //$roles = $this->serviceLocator->get('BjyAuthorize\Provider\Identity\ProviderInterface')->getIdentityRoles();

        $studenttotal=$this->getServiceLocator()->get('Admin\Service\AdminDashboardService')->getStudent();
        $staff=$this->getServiceLocator()->get('Admin\Service\AdminDashboardService')->getStaff();
        $studentmale=$this->getServiceLocator()->get('Admin\Service\AdminDashboardService')->getMaleStudent();
        $studentfemale=$this->getServiceLocator()->get('Admin\Service\AdminDashboardService')->getFemaleStudent();
        $totalclass=$this->getServiceLocator()->get('Admin\Service\AdminDashboardService')->getTotalClass();
        $totalsection=$this->getServiceLocator()->get('Admin\Service\AdminDashboardService')->getTotalSection();
        $totalsubject=$this->getServiceLocator()->get('Admin\Service\AdminDashboardService')->getTotalSubject();
        $totalparents=$this->getServiceLocator()->get('Admin\Service\AdminDashboardService')->getTotalParents();
        if(!$studenttotal){
            $studenttotal='No students';
        } if(!$staff){
            $staff='No Staffs';
        }
         if(!$studentmale){
            $studentmale='No Students';
        }
         if(!$studentfemale){
            $studentfemale='No students';
        }
         if(!$totalclass){
            $studenttotal='No Classes';
        }
         if(!$totalsection){
            $totalsection='No Sections';
        }
          if(!$totalsubject){
            $totalsubject='No Subjects';
        }
         if(!$totalparents){
            $totalparents='No Parents';
        }
        

        return new ViewModel(array('staff'=>$staff,'studenttotal'=>$studenttotal,'studentmale'=>$studentmale,'studentfemale'=>$studentfemale,'totalclass'=>$totalclass,'totalsection'=>$totalsection,'totalparents'=>$totalparents,'totalsubject'=>$totalsubject));
    }
}
