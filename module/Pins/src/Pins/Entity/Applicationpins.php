<?php

namespace Pins\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ApplicationCards
 *
 * @ORM\Table(name="applicationpins")
 * @ORM\Entity
 */
class Applicationpins
{   public $quantity;
    public $units;
    
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
     * @ORM\Column(name="serial", type="string", length=64, nullable=false)
     */
    protected $serial;

    /**
     * @var string
     *
     * @ORM\Column(name="pin", type="string", length=64, nullable=false)
     */
    protected $pin;

     /**
     * @var integer
     *
     * @ORM\Column(name="status", type="integer", length=11, nullable=false)
     */
    private $status;

   
    /**
    *@var integer $person
    *@ORM\ManyToOne(targetEntity="Admin\Entity\Person")
    *@ORM\JoinColumn(name="person", referencedColumnName="id")
    **/
    private $person;

        /**
    *@var integer $session
    *@ORM\ManyToOne(targetEntity="Admin\Entity\Session")
    *@ORM\JoinColumn(name="session", referencedColumnName="id")
    **/
    private $session;

     /**
    *@var integer $section
    *@ORM\ManyToOne(targetEntity="Admin\Entity\Section", fetch="EAGER")
    **/
    private $section;

    /**
     * @var date
     *
     * @ORM\Column(name="create_at", type="date", length=45, nullable=true)
     */
    private $created_at;

     /**
     * @var date
     *
     * @ORM\Column(name="activated_at", type="date", length=45, nullable=true)
     */
    private $activated_at;

     /**
     * @var integer
     *
     * @ORM\Column(name="published", type="integer", length=11, nullable=false)
     */
    private $published;

     /**
     * @var integer
     *
     * @ORM\Column(name="applicant_id", type="string", length=255, nullable=true)
     */
    private $applicant_id;

   
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
     * Set serial
     *
     * @param string $serial
     * @return Applicationpins
     */
    public function setSerial($serial)
    {
        $this->serial = $serial;

        return $this;
    }

    /**
     * Get serial
     *
     * @return string 
     */
    public function getSerial()
    {
        return $this->serial;
    }
 /**
     * Set pin
     *
     * @param string $pin
     * @return Applicationpins
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
     * Set status
     *
     * @param string $status
     * @return Applicationpins
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get status
     *
     * @return string 
     */
    public function getStatus()
    {
        return $this->status;
    }

      /**
     * Set person
     *
     * @param Person $person
     * @return Applicationpins
     */
    public function setPerson(Admin\Entity\Person $person = null)
    {
        $this->person = $person;

        return $this;
    }

    /**
     * Get person
     *
     * @return Person
     */
    public function getPerson()
    {
        return $this->person;
    }

    /**
     * Set section
     *
     * @param Section $section
     * @return Applicationpins
     */
    public function setSection(Section $section = null)
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
     * Set session
     *
     * @param Session $session
     * @return Applicationpins
     */
    public function setSession(Admin\Entity\Session $session = null)
    {
        $this->session = $session;

        return $this;
    }

    /**
     * Get Session
     *
     * @return Session
     */
    public function getSession()
    {
        return $this->session;
    }

  /**
     * Set created_at
     *
     * @param string $created_at
     * @return Applicationpins
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
     * @return Applicationpins
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

      /**
     * Set published
     *
     * @param int $published
     * @return Applicationpins
     */
    public function setPublished($published)
    {
        $this->published = $published;

        return $this;
    }

    /**
     * Get published
     *
     * @return int 
     */
    public function getPublished()
    {
        return $this->published;
    }

      /**
     * Set applicant_id
     *
     * @param string $applicant_id
     * @return Applicationpins
     */
    public function setApplicantId($applicant_id)
    {
        $this->applicant_id = $applicant_id;

        return $this;
    }

    /**
     * Get applicant_id
     *
     * @return string 
     */
    public function getApplicantId()
    {
        return $this->applicant_id;
    }

  
}
