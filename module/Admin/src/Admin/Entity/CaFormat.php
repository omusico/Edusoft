<?php

namespace Admin\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * CaFormat
 *
 * @ORM\Table(name="ca_format")
 * @ORM\Entity
 */
class CaFormat
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
     * @ORM\Column(name="name", type="string", nullable=false)
     */
    protected $name;

      /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", nullable=true)
     */
    protected $description;



        /**
     * @ORM\OneToMany(targetEntity="Admin\Entity\CaSystem", mappedBy="caFormat", cascade={"persist"})
     */
    protected $caSystems;

   
   /**
     * Never forget to initialize all your collections !
     */
    public function __construct()
    {
        $this->caSystems = new ArrayCollection();
    }

 
   
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
     * @param Collection $caSystems
     */
    public function addCaSystems(Collection $caSystems)
    {
        foreach ($caSystems as $caSystem) {
            $caSystem->setCaFormat($this);
            $this->caSystems->add($caSystem);
        }
    }

    /**
     * @param Collection $caSystems
     */
    public function removecaSystems(Collection $caSystems)
    {
        foreach ($caSystems as $caSystem) {
            $caSystem->setCaFormat(null);
            $this->caSystems->removeElement($caSystem);
        }
    }

    /**
     * @return Collection
     */
    public function getCaSystems()
    {
        return $this->caSystems;
    }




       /**
     * Set name
     *
     * @param string $name
     * @return CaFormat
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }
    /**
     * Set description
     *
     * @param string $description
     * @return CaFormat
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string 
     */
    public function getDescription()
    {
        return $this->description;
    }

    
  
}
