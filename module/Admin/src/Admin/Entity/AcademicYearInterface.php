<?php
/**
 * Cloud Base School Management System
 *
 * @author Isaac Bitrus 
 * @copyright Copyright (c) 2015 Edusoft (http://www.edusoft.com.ng)
 */

namespace Admin\Entity;


interface AcademicYearInterface
{
  
/**
    * Get id
    *
    * @return integer
    */
    public function getId();

     /**
     * Set id.
     *
     * @param int $id
     * @return AcademicYearInterface
     */
    public function setId($id);

    /**
    * Set year
    *
    * @param Year $year
    * @return AcademicYearInterface
    */
    public function setYear(Year $year);

      /**
    *@return Year
    **/
    public function getYear();
 
    /**
    * Set term
    *
    * @param Term $term
    * @return AcademicYearInterface
    */
    public function setTerm(Term $term);

    /**
    *@return Term
    **/
    public function getTerm();

     /**
     *@param string $startDate
    *@return AcademicYearInterface
    **/
    public function SetStartDate($startDate);

     /**
     * Get startDate
     * @param string $format
     * @return string
     */
    public function getStartDate();
     
    /**
     *@param string $endDate
    *@return AcademicYearInterface
    **/
    public function SetEndDate($endDate);

    /**
     * Get endDate
     * @param string $format
     * @return string
     */
    public function getEndDate();
}

