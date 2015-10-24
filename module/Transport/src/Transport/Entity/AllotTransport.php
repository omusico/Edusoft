<?php

namespace Transport\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * AllotTransport
 *
 * @ORM\Table(name="allot_tp")
 * @ORM\Entity
 */
class AllotTransport
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
     * @ORM\Column(name="fare", type="string", nullable=true)
     */
    protected $fare;

 
     /**
    *@var integer $session
    *@ORM\ManyToOne(targetEntity="\Admin\Entity\Session")
    *@ORM\JoinColumn(name="session_id", referencedColumnName="id")
    **/
    protected $session;


       /**
    *@var integer $student
    *@ORM\ManyToOne(targetEntity="\Admin\Entity\Student")
    *@ORM\JoinColumn(name="student_id", referencedColumnName="id")
    **/
    protected $student;


    /**
    *@var integer $route
    *@ORM\ManyToOne(targetEntity="SessionRoute")
    *@ORM\JoinColumn(name="route", referencedColumnName="id")
    **/
    protected $route;



   
    

   
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
     * Set fare
     *
     * @param string $fare
     * @return AllotTransport
     */
    public function setFare($fare)
    {
        $this->fare = $fare;

        return $this;
    }

   

    /**
     * Get fare
     *
     * @return string 
     */
    public function getFare()
    {
        return $this->fare;
    }

    

    /**
     * Set session
     *
     * @param \Admin\Entity\Session $session
     * @return \Admin\Entity\Session
     */
    public function setSession(\Admin\Entity\Session $session)
    {
        $this->session = $session;

        return $this;
    }

    /**
     * Get session
     *
     * @return \Admin\Entity\Session 
     */
    public function getSession()
    {
        return $this->session;
    }



      /**
     * Set student
     *
     * @param \Admin\Entity\Student $driver
     * @return  \Admin\Entity\Student
     */
    public function setStudent(\Admin\Entity\Student $student)
    {
        $this->student = $student;

        return $this;
    }

    /**
     * Get student
     *
     * @return  \Admin\Entity\Student
     */
    public function getStudent()
    {
        return $this->student;
    }

      /**
     * Set route
     *
     * @param SessionRoute $route
     * @return SessionRoute
     */
    public function setRoute(SessionRoute $route)
    {
        $this->route = $route;

        return $this;
    }

    /**
     * Get route
     *
     * @return SessionRoute 
     */
    public function getRoute()
    {
        return $this->route;
    }


  


  
}
