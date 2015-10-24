<?php

namespace Admin\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * FeeTotal
 *
 * @ORM\Table(name="fee_section")
 * @ORM\Entity
 */
class FeeSection
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
    *@var integer $section
    *@ORM\ManyToOne(targetEntity="Section")
    *@ORM\JoinColumn(name="section_id", referencedColumnName="id")
    **/
    protected $section;

      /**
    *@var integer $year
    *@ORM\ManyToOne(targetEntity="Year")
    *@ORM\JoinColumn(name="year_id", referencedColumnName="id")
    **/
    protected $year;

     /**
     * @ORM\OneToMany(targetEntity="Admin\Entity\FeeItems", mappedBy="feeSection", cascade={"persist"})
     */
    protected $items;

   
   /**
     * Never forget to initialize all your collections !
     */
    public function __construct()
    {
        $this->items = new ArrayCollection();
    }

    /**
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    public function getTotal()
    {
        $total = 0;
        foreach ($this->items as $item) {
            $total += $item->getAmount();
        }
        return $total;
    }

    /**
     * @param Collection $items
     */
    public function addItems(Collection $items)
    {
        foreach ($items as $item) {
            $item->setFeeSection($this);
            $this->items->add($item);
        }
    }

    /**
     * @param Collection $items
     */
    public function removeItems(Collection $items)
    {
        foreach ($items as $item) {
            $item->setFeeSection(null);
            $this->items->removeElement($item);
        }
    }

    /**
     * @return Collection
     */
    public function getItems()
    {
        return $this->items;
    }

     

    /**
     * Set section
     *
     * @param Section $section
     * @return Section
     */
    public function setSection(Section $section)
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
    public function setYear(Year $year)
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
  
}
