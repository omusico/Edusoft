<?php
/**
 * ERP System
 *
 * @author Isaac Bitrus 
 * @copyright Copyright (c) 2013 Isaac Bitrus (http://www.edusoft.com.ng)
 */

namespace Admin\Service;

use Doctrine\ORM\EntityManager;
use Admin\Repository\YearRepositoryInterface;
use Admin\Entity\Year;

interface YearServiceInterface
{
    /**
     * Method used to obtain year repository.
     *
     * @return YearRepositoryInterface
     */
    public function getYearRepository();

    /**
     * Method used to persist new year in database
     *
     * @param Year $year
     * @return boolean
     */
    public function addYear(Year $year);

     /**
     * Method used to delete semester in database
     *
     * @param Year $year
     * @return boolean
     */
    public function deleteYear(Year $year);




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
