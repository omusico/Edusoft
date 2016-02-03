<?php
/**
 * Cloud Base School Management System
 *
 * @author Isaac Bitrus 
 * @copyright Copyright (c) 2015 Edusoft (http://www.edusoft.com.ng)
 */

namespace Applicant\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="Applicant\Repository\InstitutionsAttendedRepository")
 * @ORM\Table(name="institutions_attended")
 */
class InstitutionsAttended implements InstitutionsAttendedInterface
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
     * @ORM\Column(name="name", type="string", length=45, nullable=false)
     */
    protected $name;

     /**
     * @var string
     *
     * @ORM\Column(name="location", type="string", length=45, nullable=false)
     */
    protected $location;

     /**
     * @var string
     *
     * @ORM\Column(name="from", type="string", length=45, nullable=false)
     */
    protected $from;

     /**
     * @var string
     *
     * @ORM\Column(name="to", type="string", length=45, nullable=false)
     */
    protected $to;

     

     /**
    *@var integer $person
    *@ORM\ManyToOne(targetEntity="\Applicant\Entity\Person")
    *@ORM\JoinColumn(name="person", referencedColumnName="id")
    **/
    protected $person;

     

    /**
     * Set id.
     *
     * @param int $id
     * @return InstitutionsAttendedInterface
     */
    public function setId($id)
    {
        $this->id = (int) $id;
        return $this;
    }

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
     * @return InstitutionsAttendedInterface
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
     * Set location
     *
     * @param string $location
     * @return InstitutionsAttendedInterface
     */
    public function setLocation($location)
    {
        $this->location = $location;

        return $this;
    }

    /**
     * Get location
     *
     * @return string 
     */
    public function getLocation()
    {
        return $this->location;
    }


     /**
     * Set from
     *
     * @param string $from
     * @return InstitutionsAttendedInterface
     */
    public function setFrom($from)
    {
        $this->from = $from;

        return $this;
    }

    /**
     * Get from
     *
     * @return string 
     */
    public function getFrom()
    {
        return $this->from;
    }



    /**
     * Set to
     *
     * @param string $to
     * @return InstitutionsAttendedInterface
     */
    public function setTo($to)
    {
        $this->to = $to;

        return $this;
    }

    /**
     * Get to
     *
     * @return string 
     */
    public function getTo()
    {
        return $this->to;
    }
 

    /**
     * Set person 
     *
     * @param \Applicant\Entity\Person $person
     * @return InstitutionsAttendedInterface
     */
    public function setPerson(\Applicant\Entity\Person $person)
    {
        $this->person = $person;

        return $this;
    }

    /**
     * Get person
     *
     * @return \Applicant\Entity\Person
     */
    public function getPerson()
    {
        return $this->person;
    }


   

    

   
}
