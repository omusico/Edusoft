<?php

namespace Admin\Entity;


use Doctrine\ORM\Mapping as ORM;
// added by Stoyan
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

use Zend\Form\Annotation;

/**
 *@ORM\Entity
 * @ORM\Entity(repositoryClass="Admin\Repository\SessionRepository")
 * @ORM\Table(name="session")
 * @Annotation\Name("session")
 * @Annotation\Hydrator("Zend\Stdlib\Hydrator\ClassMethods")
 */
class Session
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
    * Get id
    *
    * @return integer
    */
    public function getId()
    {
        return $this->id;
    }

    /**
    * Set session
    *
    * @param Year $year
    * @return session
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
    * @return session
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
    *@return session
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
    *@return session
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

        return $this->startDate;
       //  
      
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
public function exchangeArray ($data = array()) 
    {
        //$this->id = $data['id'];
        $this->year = $data['year'];
        $this->term = $data['term'];
        $this->startDate = $data['startDate'];
        $this->endDate = $data['endDate'];
    }
}
