<?php
/**
 * Cloud Base School Management System
 *
 * @author Isaac Bitrus 
 * @copyright Copyright (c) 2015 Edusoft (http://www.edusoft.com.ng)
 */

namespace Admin\Entity;


use Doctrine\ORM\Mapping as ORM;
//use Admin\Model\AcademicYearInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

/**
 * @ORM\Entity(repositoryClass="Admin\Repository\AcademicYearRepository")
 * @ORM\Table(name="academic_year")
 */
class AcademicYear implements AcademicYearInterface
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    protected $id;

    /**
    *@var integer $year
    *@ORM\ManyToOne(targetEntity="Admin\Entity\Year")
    *@ORM\JoinColumn(name="year", referencedColumnName="id")
    **/
    protected $year;

    /**
    *@var integer $term
    *@ORM\ManyToOne(targetEntity="Admin\Entity\Term", )
    *@ORM\JoinColumn(name="term", referencedColumnName="id")
    **/
    protected $term;


    /**
     * @ORM\Column(name="start_date", type="string", nullable=false)
     * 
     * @var \Date
     */
    protected $startDate;

    /**
     * @ORM\Column(name="end_date", type="string", nullable=false)
     * 
     * @var \Date
     */
    protected $endDate;

        /**
     * @var int
     *
     * @ORM\Column(name="status", type="integer", length=10, nullable=false)
     */
   protected $status;



/**
    * Get id
    *
    * @return integer
    */
    public function getId()
    {
        return $this->id;
    }

            /**
     * Set id.
     *
     * @param int $id
     * @return AcademicYearInterface
     */
    public function setId($id)
    {
        $this->id = (int) $id;
        return $this;
    }

    /**
    * Set year
    *
    * @param Year $year
    * @return AcademicYearInterface
    */
    public function setYear(Year $year)
    {
        $this->year = $year;

        return $this;
    }
      /**
    *@return Year
    **/
    public function getYear()
    {
        return $this->year;
    }

 
    /**
    * Set term
    *
    * @param Term $term
    * @return AcademicYearInterface
    */
    public function setTerm(Term $term)
    {
        $this->term = $term;

        return $this;
    }

    /**
    *@return Term
    **/
    public function getTerm()
    {
        return $this->term;
    }

     /**
     *@param string $startDate
    *@return AcademicYearInterface
    **/
    public function SetStartDate($startDate)
    {
         $this->startDate = $startDate;
         return $this;
    }

     /**
     * Get startDate
     * @param string $format
     * @return string
     */
    public function getStartDate()
    {
       //  $startDate = $this->startDate->format('d/m/Y');
       // return $startDate;
        return $this->startDate;
    }

     
    /**
     *@param string $endDate
    *@return AcademicYearInterface
    **/
    public function SetEndDate($endDate)
    {
         $this->endDate = $endDate;
         return $this;
    }

    /**
     * Get endDate
     * @param string $format
     * @return string
     */
    public function getEndDate()
    {   
       // $endDate = $this->endDate->format('d/m/Y');
        //return $endDate;

        return $this->endDate;
       //  
      
    }

    /**
    * Get status
    *
    * @return integer
    */
    public function getStatus()
    {   
        return $this->status;
    }

            /**
     * Set status.
     *
     * @param int $status
     * @return AcademicYearInterface
     */
    public function setStatus($status)
    {
        $this->status = (int) $status;
        return $this;
    }

    /**
     * Convert the object to an array.
     *
     * @return array
     */
    public function getArrayCopy() 
    {   
       return get_object_vars($this);
    }

}
