<?php

namespace Admin\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * FeeItems
 *
 * @ORM\Table(name="fee_items")
 * @ORM\Entity(repositoryClass="Admin\Repository\FeeItemsRepository")
 */
class FeeItems
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
     * @ORM\Column(name="amount", type="integer", nullable=true)
     */
    protected $amount;

     /**
     * @var string
     *
     * @ORM\Column(name="items", type="string", nullable=true)
     */
    protected $items;


 /**
     * @ORM\ManyToOne(targetEntity="Admin\Entity\FeeSection", inversedBy="items" )
      *@ORM\JoinColumn(name="feeSection_id", referencedColumnName="id", onDelete="CASCADE")
     */
    protected $feeSection;
   
    

   
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
     * @return FeeItems
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
     * Set items
     *
     * @param string $items
     * @return FeeItems
     */
    public function setItems($items)
    {
        $this->items = $items;

        return $this;
    }

    /**
     * Get items
     *
     * @return string 
     */
    public function getItems()
    {
        return $this->items;
    }


        /**
     * Allow null to remove association
     *
     * @param FeeSection $feeSection
     */
    public function setFeeSection(FeeSection $feeSection = null)
    {
        $this->feeSection = $feeSection;
    }

    /**
     * @return FeeSection
     */
    public function getFeeSection()
    {
        return $this->feeSection;
    }

    


 
  
}
