<?php
/**
 * Edusoft Cloud Based School Management System
 *
 * @author Isaac Bitrus 
 * @copyright Copyright (c) 2013 Isaac Bitrus (http://www.edusoft.com.ng)
 */

namespace Applicant\Service;

use Doctrine\ORM\EntityManager;
use Applicant\Repository\ApplicantRepositoryInterface;
use Applicant\Entity\Applicant;

interface ApplicantServiceInterface
{
    /**
     * Method used to obtain applicant repository.
     *
     * @return ApplicantRepositoryInterface
     */
    public function getApplicantRepository();

    /**
     * Method used to persist new year in database
     *
     * @param Applicant $applicant
     * @return boolean
     */
    public function addApplicant(Applicant $applicant);

    public function checkProfile();

    public function applicationId($year);

   
    /**
     * Method used to delete applicant in database
     *
     * @param Applicant $applicant
     * @return boolean
     */
    public function deleteApplicant(Applicant $applicant);


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

            /**
     * Get authService.
     *
     * @return AuthenticationService
     */
    public function getAuthService();

    /**
     * Set authService.
     *
     * @param AuthenticationService $authService
     */
    public function setAuthService(AuthenticationService $authService);
}
