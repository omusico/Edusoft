<?php

namespace Transport\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Vehicle
 *
 * @ORM\Table(name="vehicle")
 * @ORM\Entity
 */
class Vehicle
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
    protected $name;

          /**
     * @var string
     *
     * @ORM\Column(name="code", type="string", nullable=true)
     */
    protected $code;

          /**
     * @var string
     *
     * @ORM\Column(name="seats", type="string", nullable=true)
     */
    protected $seats;

           /**
     * @var string
     *
     * @ORM\Column(name="type", type="string", nullable=true)
     */
    protected $type;

            /**
     * @var string
     *
     * @ORM\Column(name="color", type="string", nullable=true)
     */
    protected $color;



            /**
     * @var string
     *
     * @ORM\Column(name="image", type="string", nullable=true)
     */
    protected $image;

   
     

   
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
     * @return Vehicle
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
     * @return Vehicle
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
     * Set seats
     *
     * @param string $seats
     * @return Vehicle
     */
    public function setSeats($seats)
    {
        $this->seats = $seats;

        return $this;
    }

    /**
     * Get seats
     *
     * @return string 
     */
    public function getSeats()
    {
        return $this->seats;
    }

         /**
     * Set type
     *
     * @param string $type
     * @return Vehicle
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return string 
     */
    public function getType()
    {
        return $this->type;
    }



         /**
     * Set image
     *
     * @param string $image
     * @return Vehicle
     */
    public function setImage($image)
    {
        if (is_array($image) && isset($image['name'])) {
                    $image = $image['name'];
                }
                else {
                    $image='bus.png';
                }

                $this->image = $image;
                return $this;
    }

    /**
     * Get image
     *
     * @return string 
     */
    public function getImage()
    {
        return $this->image;
    }


         /**
     * Set color
     *
     * @param string $color
     * @return Vehicle
     */
    public function setColor($color)
    {
        $this->color = $color;

        return $this;
    }

    /**
     * Get color
     *
     * @return string 
     */
    public function getColor()
    {
        return $this->color;
    }





  
}
