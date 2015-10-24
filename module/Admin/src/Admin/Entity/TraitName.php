<?php

namespace Admin\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * TraitName
 *
 * @ORM\Table(name="trait_name")
 * @ORM\Entity
 */
class TraitName
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
     * @ORM\ManyToOne(targetEntity="Admin\Entity\TraitFormat" )
      *@ORM\JoinColumn(name="traitformat_id", referencedColumnName="id", onDelete="CASCADE")
     */
    protected $traitFormat;

        /**
     * @ORM\OneToMany(targetEntity="Admin\Entity\Traits", mappedBy="traitName", cascade={"persist"})
     */
    protected $traits;

   
   /**
     * Never forget to initialize all your collections !
     */
    public function __construct()
    {
        $this->traits = new ArrayCollection();
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
     * @param Collection $traits
     */
    public function addTraits(Collection $traits)
    {
        foreach ($traits as $trait) {
            $trait->setTraitName($this);
            $this->traits->add($trait);
        }
    }

    /**
     * @param Collection $traits
     */
    public function removeTraits(Collection $traits)
    {
        foreach ($traits as $trait) {
            $trait->setTraitName(null);
            $this->traits->removeElement($trait);
        }
    }

    /**
     * @return Collection
     */
    public function getTraits()
    {
        return $this->traits;
    }




       /**
     * Set name
     *
     * @param string $name
     * @return TraitName
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
     * @return TraitName
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

    


     /**
     * Set traitFormat
     *
     * @param TraitFormat $traitFormat
     * @return TraitFormat
     */
    public function setTraitFormat(TraitFormat $traitFormat)
    {
        $this->traitFormat = $traitFormat;

        return $this;
    }

    /**
     * Get traitFormat
     *
     * @return TraitFormat 
     */
    public function getTraitFormat()
    {
        return $this->traitFormat;
    }
  
}
