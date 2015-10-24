<?php

namespace Admin\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Lga
 *
 * @ORM\Table(name="lga")
 * @ORM\Entity
 */
class Lga
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
     * @ORM\Column(name="name", type="string", length=64, nullable=false)
     */
    protected $name;

    /**
     * @var string
     *
     * @ORM\Column(name="code", type="string", length=24, nullable=false)
     */
    protected $code;

      /**
    *@var integer $state
    *@ORM\ManyToOne(targetEntity="State")
    *@ORM\JoinColumn(name="state_id", referencedColumnName="id")
    **/
    private $state;

   
    

   
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
     * @return Lga
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
     * Set code
     *
     * @param string $code
     * @return Lga
     */
    public function setCode($code)
    {
        $this->code = $code;

        return $this;
    }

    /**
     * Get code
     *
     * @return string 
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * Set state
     *
     * @param State $state
     * @return Applicant
     */
    public function setState(State $state)
    {
        $this->state = $state;

        return $this;
    }

    /**
     * Get state
     *
     * @return State 
     */
    public function getState()
    {
        return $this->state;
    }
  
}
