<?php
/**
 * Cloud Base School Management System
 *
 * @author Isaac Bitrus 
 * @copyright Copyright (c) 2015 Edusoft (http://www.edusoft.com.ng)
 */

namespace Admin\Repository;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Query;
use Admin\Entity\Year;

/**
 * Class YearRepository - orders repository. Provides additional database query methods.
 *
 * @package Admin\Repository
 */
class YearRepository extends EntityRepository
  implements YearRepositoryInterface
{	public function years(){

    $em = $this ->getServiceLocator()
                ->get('Doctrine\ORM\EntityManager');

        $results= $em->createQuery('select a,  from Admin\Entity\Year a')->getArrayResult();
        return $results
   }

  
}
