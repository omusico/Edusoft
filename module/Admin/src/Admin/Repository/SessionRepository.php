<?php
/**
 * ERP System
 *
 * @author Tomasz Kuter <evolic_at_interia_dot_pl>
 * @copyright Copyright (c) 2013 Tomasz Kuter (http://www.tomaszkuter.com)
 */

namespace Admin\Repository;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Query;
use EvlErp\Entity\Session;


/**
 * Class SessionRepository - orders repository. Provides additional database query methods.
 *
 * @package Admin\Repository
 */
class SessionRepository extends EntityRepository
  
{
    /**
     * Method used to obtain available Session from the database
     *
     * @param array $criteria - additional criteria
     * @param int $hydrate - result hydration mode
     * @return array - available companies
     */
    public function getCompanies()
    {
       
       $sessions= $this->_em->createQuery("SELECT s, y, t FROM Admin\Entity\Session s JOIN s.year y JOIN s.term t ORDER BY s.id DESC")
                    ->setMaxResults(1)
                    ->getArrayResult();
       return $sessions;
    }

         public function getYear($number=1)
    {
        
         $query = $this->_em->createQuery("SELECT y.name FROM Admin\Entity\Session s LEFT JOIN s.year y WHERE s.year =y.id ORDER BY s.id DESC")->setMaxResults(1)->getResult();
         $year=$query[0]['name'];
         return $year;
    }

     public function getTerm($number=1)
    {  
         $query = $this->_em->createQuery("SELECT t.name FROM Admin\Entity\Session s LEFT JOIN s.term t WHERE s.term =t.id ORDER BY s.id DESC")->setMaxResults(1)->getResult();
         $term=$query[0]['name'];
         return $term;
       }





}