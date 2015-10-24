<?php 
namespace Admin\Repository;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Query;
use Admin\Entity\FeePayments;



class FeePaymentsRepository extends EntityRepository
{	

    public function getTotal($section)
    {    $dql = "SELECT SUM(i.amount) as total FROM Admin\Entity\FeePayments i  WHERE i.feeStudent=?1";
         $query = $this->_em->createQuery($dql)->setParameter('1', $section); 
         $total = $query->getsingleScalarResult();
         return $total;
    }

   
}