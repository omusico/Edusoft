<?php

namespace Admin\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CaSystem
 *
 * @ORM\Table(name="ca_system")
 * @ORM\Entity
 */
class CaSystem
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
     * @var string
     *
     * @ORM\Column(name="assessment_name", type="string", nullable=false)
     */
    protected $assessName;

       /**
     * @var string
     *
     * @ORM\Column(name="short_name", type="string", nullable=false)
     */
    protected $shortName;



      /**
     * @var integer
     *
     * @ORM\Column(name="percentage", type="integer", nullable=false)
     */
    protected $percentage;



    /**
     * @ORM\ManyToOne(targetEntity="Admin\Entity\CaFormat", inversedBy="caSystems" )
      *@ORM\JoinColumn(name="caSystem_id", referencedColumnName="id", onDelete="CASCADE")
     */
    protected $caFormat;


   
    

   
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
     * Set assessName
     *
     * @param string $assessName
     * @return CaSystem
     */
    public function setAssessName($assessName)
    {
        $this->assessName = $assessName;

        return $this;
    }

    /**
     * Get assessName
     *
     * @return string 
     */
    public function getAssessName()
    {
        return $this->assessName;
    }

      /**
     * Set shortName
     *
     * @param string $shortName
     * @return CaSystem
     */
    public function setShortName($shortName)
    {
        $this->shortName = $shortName;

        return $this;
    }

    /**
     * Get shortName
     *
     * @return string 
     */
    public function getShortName()
    {
        return $this->shortName;
    }


     /**
     * Set percentage
     *
     * @param integer $percentage
     * @return CaSystem
     */
    public function setPercentage($percentage)
    {
        $this->percentage = $percentage;

        return $this;
    }

    /**
     * Get percentage
     *
     * @return integer 
     */
    public function getPercentage()
    {
        return $this->percentage;
    }

   


     /**
     * Set caFormat
     *
     * @param CaFormat $caFormat
     * @return CaFormat
     */
    public function setCaFormat(CaFormat $caFormat = null)
    {
        $this->caFormat = $caFormat;

        return $this;
    }

    /**
     * Get caFormat
     *
     * @return CaFormat 
     */
    public function getCaFormat()
    {
        return $this->caFormat;
    }
  
}
