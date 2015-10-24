<?php
namespace Admin\Data;

use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Admin\Entity\Student;
use Admin\Entity\Person;
use Admin\Entity\Guardian;

class DoctrineQuery implements ServiceLocatorAwareInterface
{

    private $serviceLocator;

    /**
     * Set service locator
     *
     * @param ServiceLocatorInterface $serviceLocator            
     */
    public function setServiceLocator(ServiceLocatorInterface $serviceLocator)
    {
        $this->serviceLocator = $serviceLocator;
    }

    /**
     * Get service locator
     *
     * @return ServiceLocatorInterface
     */
    public function getServiceLocator()
    {
        return $this->serviceLocator;
    }

     /**
     * @var Doctrine\ORM\EntityManager
     */
    protected $entityManager;
    
    public function setEntityManager(EntityManager $em)
    {
      $this->$entityManager = $em;
    }
    
    public function getEntityManager()
    {
      if (null === $this->entityManager) {
        $this->entityManager = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');
      }
      return $this->entityManager;
    }

    /**
     *
     * @return QueryBuilder
     */
    public function getPersons()
    {
        
        /* @var $entityManager \Doctrine\ORM\EntityManager */
        $entityManager =$this->getServiceLocator()->get('doctrine.entitymanager.orm_default');
        //$personRepo = $entityManager->getRepository('ZfcDatagridExamples\Entity\Person');
        
        $dql = "SELECT s, p, g, c, d FROM Admin\Entity\Student s JOIN s.person p JOIN p.guardian g JOIN s.class c JOIN s.section d ORDER BY s.class DESC ";
        $query = $entityManager->createQuery($dql); 
        $bugs = $query->getScalarResult();
       // var_dump($bugs);
        // Test if the SqLite is ready...
      /*   $dql = "SELECT a FROM Admin\Entity\Lga a WHERE a.state IN (:ids)";
        $query = $entityManager->createQuery($dql)
            ->setParameter(':ids', $ids);
        $results = $query->getResult(\Doctrine\ORM\AbstractQuery::HYDRATE_ARRAY);
        
        $qb = $entityManager->createQueryBuilder();
        $qb->select('p');
        $qb->from('Admin\Entity\Person', 'p');
        */
        return $bugs;
    }
}
