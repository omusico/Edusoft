<?php

namespace Transport\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Route
 *
 * @ORM\Table(name="route")
 * @ORM\Entity
 */
class Route
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")s
     */
    protected $id;

      /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", nullable=true)
     */
    protected $name;

          /**
     * @var string
     *
     * @ORM\Column(name="stops", type="string", nullable=true)
     */
    protected $stops;

     

   
     

   
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
     * @return Route
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
     * Set stops
     *
     * @param string $stops
     * @return Route
     */
    public function setStops($stops)
    {
        $this->stops = $stops;

        return $this;
    }

    /**
     * Get stops
     *
     * @return string 
     */
    public function getStops()
    {
        return $this->stops;
    }

    

   

  
}
