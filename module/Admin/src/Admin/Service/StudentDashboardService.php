<?php
/**
 * ERP System
 *
 * @author Isaac Bitrus 
 * @copyright Copyright (c) 2013 Isaac Bitrus (http://www.edusoft.com.ng)
 */

namespace Admin\Service;

use Doctrine\ORM\EntityManager;


/**
 * Class AdminDashboardService - service used to perform basic logic operations for dashboard.
 *
 * @package Admin\Service
 */
class StudentDashboardService 
{
    /**
     * @var EntityManager
     */
    private $entityManager;

  
   
    public function getClassNo($class)
    {
        $entityManager= $this->getEntityManager();       
        $dql = "SELECT count(s.currentclass) as no FROM Admin\Entity\Student s WHERE s.currentclass=?1";
        $query = $entityManager->createQuery($dql)->setParameter(1,$class);  
        return $status = $query->getsingleScalarResult(); 
    }

     public function getStudenthfTotal()
    {   $session =2;
        $class=5;
        $entityManager= $this->getEntityManager();       
        $dql = "SELECT s.student, sum(s.total) as total FROM Admin\Entity\Result s WHERE s.session=?1 and s.class=?2 groupBy s.student";
        $query = $entityManager->createQuery($dql)->setParameters(array('2'=>$class,)); 
        $result = $query->getScalarResult(); 

$queryAvgScore = $queryScore->createQueryBuilder('g')
->select("sum(g.total) as score_total")
->where('g.class = :idPlayer')
->where('g.session = :idPlayer')
->groupBy('g.student')
->setParameter('idPlayer', $id)
->getQuery();

        
    }


         public function getMaxTotal($session,$class,$student)
    {    
        $entityManager= $this->getEntityManager();       
        $dql = "SELECT sum(s.subtotal) as total FROM Admin\Entity\Result s WHERE s.session=?1 and s.class=?2  and s.student=?4";
         $query = $entityManager->createQuery($dql)->setParameters(array('1'=>$session,'2'=>$class, '4'=>$student,));  
      return $stotal = $query->getsingleScalarResult(); 
        
    }

         public function getStudentTotal($session,$class,$student)
    {   
        $entityManager= $this->getEntityManager();       
        $dql = "SELECT sum(s.total) as total FROM Admin\Entity\Result s WHERE s.session=?1 and s.class=?2  and s.student=?4";
         $query = $entityManager->createQuery($dql)->setParameters(array('1'=>$session,'2'=>$class, '4'=>$student,));  
         return $stotal = $query->getsingleScalarResult();      
       
    }

         public function getClassAverage()
    {   $stotal =$this->getStudentTotal();
        $ctotal=$this->getMaxTotal();
        
        $total= $stotal/$ctotal * 100;

        
    }

         public function getHighestScore($session,$class)
    {   $entityManager= $this->getEntityManager();       
        $dql = "SELECT s, sum(s.total) as total,i FROM Admin\Entity\Result s LEFT JOIN s.student i WHERE s.session=?1 and s.class=?2 group By i.id order by total DESC";
        $query = $entityManager->createQuery($dql)->setParameters(array('1'=>$session,'2'=>$class,))->setMaxResults(1);  
        $total = $query->getScalarResult(); 
        foreach ($total as $score) {
           return $score['total'];
        }
    }

        public function getLowestScore($session,$class)
    {   $entityManager= $this->getEntityManager();       
        $dql = "SELECT s, sum(s.total) as total,i FROM Admin\Entity\Result s LEFT JOIN s.student i WHERE s.session=?1 and s.class=?2 group By i.id order by total ASC";
        $query = $entityManager->createQuery($dql)->setParameters(array('1'=>$session,'2'=>$class,))->setMaxResults(1);  
        $total = $query->getScalarResult();  
        foreach ($total as $score) {
           return $score['total'];
        }   
    }


//         $queryAvgScore = $queryScore->createQueryBuilder('g')
//->select("avg(g.score) as score_avg, count(g.score) as score_count")
//->where('g.idPlayer = :idPlayer')
//->groupBy('g.idPlayer')
//->setParameter('idPlayer', $id)
//->getQuery();  


 


    /**
     * Method used to obtain EntityManager.
     *
     * @return EntityManager - entity manager object
     */
    public function getEntityManager()
    {
        return $this->entityManager;
    }

    /**
     * Method used to inject EntityManager.
     *
     * @param EntityManager $entityManager
     */
    public function setEntityManager(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }

   
}
