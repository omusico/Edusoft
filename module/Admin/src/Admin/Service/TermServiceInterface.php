<?php
/**
 * ERP System
 *
 * @author Isaac Bitrus 
 * @copyright Copyright (c) 2013 Isaac Bitrus (http://www.edusoft.com.ng)
 */

namespace Admin\Service;

use Doctrine\ORM\EntityManager;
use Admin\Repository\TermRepositoryInterface;
use Admin\Entity\Term;

interface TermServiceInterface
{
    /**
     * Method used to obtain year repository.
     *
     * @return TermRepositoryInterface
     */
    public function getTermRepository();

    /**
     * Method used to persist new year in database
     *
     * @param Term $term
     * @return boolean
     */
    public function addTerm(Term $term);

        /**
     * Method used to delete term in database
     *
     * @param Term $term
     * @return boolean
     */
    public function deleteTerm(Term $term);



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
