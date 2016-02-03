<?php
/**
 * Edusoft Cloud Base School Management System
 *
 * @author Isaac Bitrus 
 * @copyright Copyright (c) 2015 Edusoft (http://www.edusoft.com.ng)
 */

namespace Admin\Entity;
use Doctrine\ORM\Mapping as ORM;

/**
*@ORM\Entity(repositoryClass="Admin\Repository\SubjectRepository")
*/
class Subject implements SubjectInterface
{
	/**
		* @var integer
		*@ORM\Column(name="id", type="integer", nullable=false)
		*@ORM\Id
		*@ORM\GeneratedValue(strategy="IDENTITY")
		*/
	protected $id;

	/**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=100, nullable=false)
     */
   protected $name;

   /**
     * @var string
     *
     * @ORM\Column(name="short_name", type="string", length=100, nullable=true)
     */
   protected $shortName;

   /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=100, nullable=true)
     */
   protected $description;



    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

        /**
     * Set id.
     *
     * @param int $id
     * @return SubjectInterface
     */
    public function setId($id)
    {
        $this->id = (int) $id;
        return $this;
    }


    /**
     * Set sessionName
     *
     * @param string $name
     * @return SubjectInterface
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get sessionName
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }


     /**
     * Set shortName
     *
     * @param string $shortName
     * @return SubjectInterface
     */
    public function setShortName($shortName)
    {
        $this->shortName = $shortName;

        return $this;
    }

    /**
     * Get shortName
     *
     * @return string 
     */
    public function getShortName()
    {
        return $this->shortName;
    }


    /**
     * Set description
     *
     * @param string $description
     * @return SubjectInterface
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string 
     */
    public function getDescription()
    {
        return $this->description;
    }



/**
     * Convert the object to an array.
     *
     * @return array
     */
    public function getArrayCopy() 
    {
        return get_object_vars($this);
    }


   
}