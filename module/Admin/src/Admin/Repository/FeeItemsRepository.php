<?php 
namespace Admin\Repository;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Query;
use Admin\Entity\FeeItems;



class FeeItemsRepository extends EntityRepository
{	

    public function getTotal($section)
    {    $dql = "SELECT SUM(i.items) as total FROM Admin\Entity\FeeItems i  WHERE i.feeSection=?1";
         $query = $this->_em->createQuery($dql)->setParameter('1', $section); 
         $total = $query->getsingleScalarResult();
         return $total;
    }

   
}