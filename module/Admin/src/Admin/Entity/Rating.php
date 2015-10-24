<?php

namespace Admin\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Rating
 *
 * @ORM\Table(name="rating")
 * @ORM\Entity
 */
class Rating
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
     * @ORM\Column(name="rate", type="string", nullable=false)
     */
    protected $rate;

     /**
    *@var integer $Traits
    *@ORM\ManyToOne(targetEntity="Traits")
    *@ORM\JoinColumn(name="trait_id", referencedColumnName="id")
    **/
    protected $traits;

     /**
    *@var integer $Student
    *@ORM\ManyToOne(targetEntity="Student")
    *@ORM\JoinColumn(name="student", referencedColumnName="id")
    **/
    protected $student;

         /**
    *@var integer $Session
    *@ORM\ManyToOne(targetEntity="Session")
    *@ORM\JoinColumn(name="session", referencedColumnName="id")
    **/
    protected $session;


   
    

   
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
     * Set rate
     *
     * @param string $rate
     * @return Rating
     */
    public function setRate($rate)
    {
        $this->rate = $rate;

        return $this;
    }

    /**
     * Get rate
     *
     * @return string 
     */
    public function getRate()
    {
        return $this->rate;
    }

    


     /**
     * Set trait
     *
     * @param Traits $traits
     * @return Traits
     */
    public function setTraits(Traits $traits)
    {
        $this->traits = $traits;

        return $this;
    }

    /**
     * Get traits
     *
     * @return Traits 
     */
    public function getTraits()
    {
        return $this->traits;
    }


      /**
     * Set student
     *
     * @param Student $student
     * @return Student
     */
    public function setStudent(Student $student)
    {
        $this->student = $student;

        return $this;
    }

    /**
     * Get student
     *
     * @return Student 
     */
    public function getStudent()
    {
        return $this->student;
    }

      /**
     * Set session
     *
     * @param Session $session
     * @return Session
     */
    public function setSession(Session $session)
    {
        $this->session = $session;

        return $this;
    }

    /**
     * Get session
     *
     * @return Session 
     */
    public function getSession()
    {
        return $this->session;
    }
  
}
