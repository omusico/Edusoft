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

interface SectionServiceInterface
{
    /**
     * Method used to obtain section repository.
     *
     * @return SectionRepositoryInterface
     */
    public function getSectionRepository();

    /**
     * Method used to persist new section in database
     *
     * @param Section $section
     * @return boolean
     */
    public function addSection(Section $section);

     /**
     * Method used to delete section in database
     *
     * @param Section $section
     * @return boolean
     */
    public function deleteSection(Section $section);




    /**
     * Method used to obtain EntityManager.
     *
     * @return EntityManager - entity manager object
     */
    public function getEntityManager();

    /**
     * Method used to inject EntityManager.
     *
     * @param EntityManager $entityManager
     * @return void
     */
    public function setEntityManager(EntityManager $entityManager);
}
