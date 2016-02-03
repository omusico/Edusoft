<?php
/**
 * ERP System
 *
 * @author Isaac Bitrus 
 * @copyright Copyright (c) 2013 Isaac Bitrus (http://www.edusoft.com.ng)
 */

namespace Admin\Service;

use Doctrine\ORM\EntityManager;
use Admin\Repository\AcademicYearRepositoryInterface;
use Admin\Entity\AcademicYear;

interface AcademicYearServiceInterface
{
    /**
     * Method used to obtain year repository.
     *
     * @return AcademicYearRepositoryInterface
     */
    public function getAcademicYearRepository();

    /**
     * Method used to persist new year in database
     *
     * @param AcademicYear $academicyear
     * @return boolean
     */
    public function addAcademicYear(AcademicYear $academicyear);

    /**
     * Method used to  set academicyear in status
     *
     */
    public function setstatus($academicyear);

    /**
     * Method used to  open academic-year
     *
     */
    public function open($academicyear);

    /**
     * Method used to  close academic-year
     *
     */
    public function close($academicyear);



    /**
     * Method used to delete academicyear in database
     *
     * @param AcademicYear $academicyear
     * @return boolean
     */
    public function deleteAcademicYear(AcademicYear $academicyear);


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
