<?php 
namespace Admin\Repository;
use Doctrine\ORM\EntityRepository;
use DoctrineORMModule\Stdlib\Hydrator\DoctrineEntity;
use Admin\Entity\StudentHistory as STUDENTHISTORY;
use Admin\Entity\Session as Session;
use Doctrine\ORM\Mapping as ORM;


/**
 * @ORM\Entity(repositoryClass="Admin\Repository\StudentHistoryRepository")
 */
 
class StudentHistoryRepository extends EntityRepository
{	protected $em;
   
    public function getEntityManager()
    {
        if (null === $this->em) {
            $this->em = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');
        }
        return $this->em;
    }

    public function getState()
    {
        $querybuilder = $this->createQueryBuilder('s');
        return $querybuilder->select('s')
                    ->groupBy('s.name')
                    ->getQuery()->getResult();

       $session=$entitymanager->getRepository('Admin\Entity\State')->findOneBy(array('id' =>'DESC'));
      $student=$entitymanager->getRepository('Admin\Entity\StudentHistory')->findOneBy(array('student' =>$student,));
    }

    public function getYear($number = 1) 
    	{ $dql = "SELECT s.year FROM Session s ORDER BY s.id DESC";
		return $this->getEntityManager()->createQuery($dql)->setMaxResults($number)->getResult();
		}


	public function getCurrentClass($id, $number=1) 
	{ $dql = "SELECT s.class FROM STUDENTHISTORY s  WHERE s.student=?1 AND s.year=?2";
	return $this->getEntityManager()->createQuery($dql)->setParameter(1, $Id)->setParameter(2, $this->getYear())->setMaxResults($number)->getResult();
	}
}