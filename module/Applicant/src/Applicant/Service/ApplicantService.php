<?php
/**
 * Edusoft Cloud Based SChool Management System
 *
 * @author Isaac Bitrus 
 * @copyright Copyright (c) 2013 Isaac Bitrus (http://www.edusoft.com.ng)
 */


namespace Applicant\Service;

use Doctrine\ORM\EntityManager;
use Applicant\Repository\ApplicantRepositoryInterface;
use Zend\Authentication\AuthenticationService;
use Applicant\Entity\Applicant;

/**
 * Class ApplicantService - service used to perform basic logic operations on Applicants.
 *
 * @package Applicant\Service
 */
class ApplicantService implements ApplicantServiceInterface
{
    /**
     * @var EntityManager
     */
    private $entityManager;

     /**
     * @var AuthenticationService
     */
    protected $authService;


    /**
     * Method used to obtain orders repository.
     *
     * @return ApplicantRepositoryInterface
     */
    public function getApplicantRepository()
    {
        return $this->getEntityManager()->getRepository('Applicant\Entity\Applicant');
    }

    /**
     * Method used to chcek applicant profile completion repository.
     *
     * @return ApplicantRepositoryInterface
     */
    public function checkProfile()
    {   
        $login = $this->getAuthService()->getIdentity()->getId();  
        return $this->getEntityManager()->getRepository('Applicant\Entity\Applicant')->findOneby(array('user'=>$login));
    }

     /**
     * Method used to generate application ID.
     */
    public function applicationId($year)
    {   $id='';
        $all_school = $this->getEntityManager()->getRepository('Applicant\Entity\Applicant')->findBy(array('academicYear'=>$year));
        $all_school2 = $this->getEntityManager()->getRepository('Applicant\Entity\Applicant')->findBy(array('academicYear'=>$year),array('applicantId'=>'DESC'));
            //$new_code = count($all_school)+1;
            
            $new_code = $all_school2->school_code +1;
            
                if(strlen($new_code) == 1)
                    $id = '000'.$new_code;
                if(strlen($new_code) == 2)
                    $id = '00'.$new_code;
                if(strlen($new_code) == 3)
                    $id = '0'.$new_code;
                if(strlen($new_code) == 4)
                    $id = $new_code ;
        return $id;
    }

    /**
     * Method used to persist new Applicant in database
     *
     * @param Applicant $applicant
     * @return boolean
     */
    public function addApplicant(Applicant $applicant)
    {
        $this->getEntityManager()->beginTransaction();
        try {

            $this->getEntityManager()->persist($applicant);
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
     * Method used to persist delete applicant in database
     *
     * @param Applicant $applicant
     * @return boolean
     */
    public function deleteApplicant(Applicant $applicant)
    {
        $this->getEntityManager()->beginTransaction();
        try {
            $this->getEntityManager()->remove($academicyear);
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

            /**
     * Get authService.
     *
     * @return AuthenticationService
     */
    public function getAuthService()
    {
        return $this->authService;
    }

    /**
     * Set authService.
     *
     * @param AuthenticationService $authService
     */
    public function setAuthService(AuthenticationService $authService)
    {
        $this->authService = $authService;
    }
}
