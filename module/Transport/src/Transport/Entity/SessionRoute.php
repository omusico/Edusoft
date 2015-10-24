<?php

namespace Transport\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * SessionRoute
 *
 * @ORM\Table(name="session_route")
 * @ORM\Entity
 */
class SessionRoute
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
    *@var integer $driver
    *@ORM\ManyToOne(targetEntity="\Admin\Entity\Staff")
    *@ORM\JoinColumn(name="driver", referencedColumnName="id")
    **/
    protected $driver;


       /**
    *@var integer $route
    *@ORM\ManyToOne(targetEntity="Route")
    *@ORM\JoinColumn(name="route", referencedColumnName="id")
    **/
    protected $route;


       /**
    *@var integer $vehicle
    *@ORM\ManyToOne(targetEntity="Vehicle")
    *@ORM\JoinColumn(name="vehicle", referencedColumnName="id")
    **/
    protected $vehicle;


   
    

   
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
     * @return SessionRoute
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
     * Set driver
     *
     * @param \Admin\Entity\Staff $driver
     * @return \Admin\Entity\Staff 
     */
    public function setDriver(\Admin\Entity\Staff $driver)
    {
        $this->driver = $driver;

        return $this;
    }

    /**
     * Get driver
     *
     * @return \Admin\Entity\Staff 
     */
    public function getDriver()
    {
        return $this->driver;
    }

      /**
     * Set route
     *
     * @param Route $route
     * @return Route
     */
    public function setRoute(Route $route)
    {
        $this->route = $route;

        return $this;
    }

    /**
     * Get route
     *
     * @return Route 
     */
    public function getRoute()
    {
        return $this->route;
    }


        /**
     * Set vehicle
     *
     * @param Vehicle $vehicle
     * @return Vehicle
     */
    public function setVehicle(Vehicle $vehicle)
    {
        $this->vehicle = $vehicle;

        return $this;
    }

    /**
     * Get vehicle
     *
     * @return Vehicle 
     */
    public function getVehicle()
    {
        return $this->vehicle;
    }


  
}
