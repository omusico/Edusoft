<?php
/**
 * Edusoft Cloud Base School Management System
 *
 * @author Isaac Bitrus 
 * @copyright Copyright (c) 2015 Edusoft (http://www.edusoft.com.ng)
 */

namespace Applicant\Repository;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Query;
use Applicant\Entity\Person;

/**
 * Class PersonRepository - person repository. Provides additional database query methods.
 *
 * @package Applicant\Repository
 */
class PersonRepository extends EntityRepository
  implements PersonRepositoryInterface
{
   
  
}
