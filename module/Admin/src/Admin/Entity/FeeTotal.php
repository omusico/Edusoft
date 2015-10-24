<?php

namespace Admin\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * FeeTotal
 *
 * @ORM\Table(name="fee_total")
 * @ORM\Entity
 */
class FeeTotal
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
     * @var integer
     *
     * @ORM\Column(name="name", type="integer", nullable=true)
     */
    protected $amount;

     /**
    *@var integer $section
    *@ORM\ManyToOne(targetEntity="Section")
    *@ORM\JoinColumn(name="section_id", referencedColumnName="id")
    **/
    protected $section;


     /**
    *@var integer $feeSection
    *@ORM\ManyToOne(targetEntity="FeeSection")
    *@ORM\JoinColumn(name="FeeSection_id", referencedColumnName="id", onDelete="CASCADE")
    **/
    protected $feeSection;

      /**
    *@var integer $year
    *@ORM\ManyToOne(targetEntity="Year")
    *@ORM\JoinColumn(name="year_id", referencedColumnName="id")
    **/
    protected $year;

   
    

   
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
     * Set amount
     *
     * @param integer $amount
     * @return FeeTotal
     */
    public function setAmount($amount)
    {
        $this->amount = $amount;

        return $this;
    }

    /**
     * Get amount
     *
     * @return integer 
     */
    public function getAmount()
    {
        return $this->amount;
    }

    

    /**
     * Set section
     *
     * @param Section $section
     * @return Section
     */
    public function setSection(Section $section=null)
    {
        $this->section = $section;

        return $this;
    }

    /**
     * Get section
     *
     * @return Section 
     */
    public function getSection()
    {
        return $this->section;
    }



     /**
     * Set year
     *
     * @param Year $year
     * @return Year
     */
    public function setYear(Year $year=null)
    {
        $this->year = $year;

        return $this;
    }

    /**
     * Get year
     *
     * @return Year 
     */
    public function getYear()
    {
        return $this->year;
    }


    /**
     * Set feeSection
     *
     * @param FeeSection $feeSection
     * @return FeeSection
     */
    public function setFeeSection(FeeSection $feeSection=null)
    {
        $this->feeSection = $feeSection;

        return $this;
    }

    /**
     * Get feeSection
     *
     * @return FeeSection 
     */
    public function getFeeSection()
    {
        return $this->feeSection;
    }
  
}
