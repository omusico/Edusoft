<?php

namespace Admin\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * FeeSetup
 *
 * @ORM\Table(name="fee_setup")
 * @ORM\Entity
 */
class FeeSetup
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
     * @ORM\Column(name="name", type="string", nullable=true)
     */
    protected $description;

     /**
    *@var integer $section
    *@ORM\ManyToOne(targetEntity="Section")
    *@ORM\JoinColumn(name="section_id", referencedColumnName="id")
    **/
    protected $section;


   
    

   
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
     * @param string $description
     * @return FeeSetup
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
  
}
