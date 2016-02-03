<?php
/**
 * ERP System
 *
 * @author Isaac Bitrus 
 * @copyright Copyright (c) 2013 Isaac Bitrus (http://www.edusoft.com.ng)
 */


namespace Admin\Service;

use Doctrine\ORM\EntityManager;
use Admin\Repository\SectionRepositoryInterface;
use Admin\Entity\Section;

/**
 * Class SectionService - service used to perform basic logic operations on year.
 *
 * @package Admin\Service
 */
class SectionService implements SchoolServiceInterface
{
    /**
     * @var EntityManager
     */
    private $entityManager;


    /**
     * Method used to obtain Section repository.
     *
     * @return SectionRepositoryInterface
     */
    public function getSectionRepository()
    {
        return $this->getEntityManager()->getRepository('Admin\Entity\Section');
    }

    /**
     * Method used to persist new section in database
     *
     * @param Section $section
     * @return boolean
     */
    public function addSection(Section $section)
    {
        $this->getEntityManager()->beginTransaction();
        try {
            $this->getEntityManager()->persist($section);
            // commit transaction
            $this->getEntityManager()->flush();
            $this->getEntityManager()->commit();

            return true;
        } catch (\Exception $e) {
            $this->getEntityManager()->rollback();
            $this->getEntityManager()->close();

            return false;
        }
    }



        /**
     * Method used to persist delete section in database
     *
     * @param Section $section
     * @return boolean
     */
    public function deleteSection(Section $section)
    {
        $this->getEntityManager()->beginTransaction();
        try {
            $this->getEntityManager()->remove($section);
            // commit transaction
            $this->getEntityManager()->flush();
            $this->getEntityManager()->commit();

            return true;
        } catch (\Exception $e) {
            $this->getEntityManager()->rollback();
            $this->getEntityManager()->close();

            return false;
        }
    }


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
