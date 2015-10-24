<?php

namespace Pins\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ResultPins
 *
 * @ORM\Table(name="resultpins")
 * @ORM\Entity
 */
class Resultpins
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
     * @ORM\Column(name="pin", type="string", length=64, nullable=false)
     */
    protected $pin;
   
    /**
    *@var integer $student
    *@ORM\ManyToOne(targetEntity="\Admin\Entity\Student")
    *@ORM\JoinColumn(name="student", referencedColumnName="id")
    **/
    protected $student;

        /**
    *@var integer $session
    *@ORM\ManyToOne(targetEntity="\Admin\Entity\Session")
    *@ORM\JoinColumn(name="session", referencedColumnName="id")
    **/
    protected $session;

     /**
    *@var integer $section
    *@ORM\ManyToOne(targetEntity="\Admin\Entity\Section", fetch="EAGER")
    **/
    protected $section;

    /**
     * @var date
     *
     * @ORM\Column(name="create_at", type="date", length=45, nullable=true)
     */
    protected $created_at;

     /**
     * @var date
     *
     * @ORM\Column(name="activated_at", type="date", length=45, nullable=true)
     */
    protected $activated_at;



    

   
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
     * Set pin
     *
     * @param string $pin
     * @return Resultpins
     */
    public function setPin($pin)
    {
        $this->pin = $pin;

        return $this;
    }

    /**
     * Get pin
     *
     * @return string 
     */
    public function getPin()
    {
        return $this->pin;
    }

   
      /**
     * Set student
     *
     * @param \Admin\Entity\Student $student
     * @return Resultpins
     */
    public function setStudent(\Admin\Entity\Student $student = null)
    {
        $this->student = $student;

        return $this;
    }

    /**
     * Get student
     *
     * @return \Admin\Entity\Student
     */
    public function getStudent()
    {
        return $this->student;
    }

    /**
     * Set section
     *
     * @param \Admin\Entity\Section $section
     * @return Resultpins
     */
    public function setSection(\Admin\Entity\Section $section = null)
    {
        $this->section = $section;

        return $this;
    }

    /**
     * Get section
     *
     * @return \Admin\Entity\Section 
     */
    public function getSection()
    {
        return $this->section;
    }

    /**
     * Set session
     *
     * @param \Admin\Entity\Session $session
     * @return Resultpins
     */
    public function setSession(\Admin\Entity\Session $session = null)
    {
        $this->session = $session;

        return $this;
    }

    /**
     * Get Session
     *
     * @return \Admin\Entity\Session
     */
    public function getSession()
    {
        return $this->session;
    }

  /**
     * Set created_at
     *
     * @param string $created_at
     * @return Resultpins
     */
    public function setCreatedAt($created_at)
    {
        $this->created_at = $created_at;

        return $this;
    }

    /**
     * Get pin
     *
     * @return string 
     */
    public function getCreatedAt()
    {
        return $this->created_at;
    }

      /**
     * Set activated_at
     *
     * @param string $activated_at
     * @return Resultpins
     */
    public function setActivatedAt($activated_at)
    {
        $this->activated_at = $activated_at;

        return $this;
    }

    /**
     * Get pin
     *
     * @return string 
     */
    public function getActivatedAt()
    {
        return $this->activated_at;
    }

        
  
}
