<?php

namespace Admin\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Salary
 *
 * @ORM\Table(name="salary")
 * @ORM\Entity
 */
class Salary
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
     * @ORM\Column(name="name", type="integer", nullable=false)
     */
    protected $amount;

     /**
    *@var integer $level
    *@ORM\ManyToOne(targetEntity="Level")
    *@ORM\JoinColumn(name="level_id", referencedColumnName="id")
    **/
    private $level;

      /**
    *@var integer $step
    *@ORM\ManyToOne(targetEntity="Step")
    *@ORM\JoinColumn(name="step_id", referencedColumnName="id")
    **/
    private $step;

   
    

   
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
     * @return Salary
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
     * Set step
     *
     * @param Step $step
     * @return Step
     */
    public function setStep(Step $step)
    {
        $this->step = $step;

        return $this;
    }

    /**
     * Get step
     *
     * @return Step 
     */
    public function getStep()
    {
        return $this->step;
    }



     /**
     * Set level
     *
     * @param Level $level
     * @return Level
     */
    public function setLevel(Level $level)
    {
        $this->level = $level;

        return $this;
    }

    /**
     * Get level
     *
     * @return Level 
     */
    public function getLevel()
    {
        return $this->level;
    }
  
}
