<?php

namespace Admin\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Traits
 *
 * @ORM\Table(name="traits")
 * @ORM\Entity
 */
class Traits
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
     * @ORM\Column(name="remark", type="string", nullable=true)
     */
    protected $remark;


    /**
     * @ORM\ManyToOne(targetEntity="Admin\Entity\TraitName", inversedBy="traits" )
      *@ORM\JoinColumn(name="caSystem_id", referencedColumnName="id", onDelete="CASCADE")
     */
    protected $traitName;


   
    

   
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
     * Set name
     *
     * @param string $name
     * @return Traits
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
     * Set remark
     *
     * @param string $remark
     * @return Traits
     */
    public function setRemark($remark)
    {
        $this->remark = $remark;

        return $this;
    }

    /**
     * Get remark
     *
     * @return string 
     */
    public function getRemark()
    {
        return $this->remark;
    }


  

     /**
     * Set traitName
     *
     * @param TraitName $traitName
     * @return TraitName
     */
    public function setTraitName(TraitName $traitName = null)
    {
        $this->traitName = $traitName;

        return $this;
    }

    /**
     * Get traitName
     *
     * @return TraitName 
     */
    public function getTraitName()
    {
        return $this->traitName;
    }
  
}
