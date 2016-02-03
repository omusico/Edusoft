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
*@ORM\Entity(repositoryClass="Admin\Repository\YearRepository")
*/
class Year implements YearInterface
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
     * @return YearInterface
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
     * @return YearInterface
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
     * Convert the object to an array.
     *
     * @return array
     */
    public function getArrayCopy() 
    {
        return get_object_vars($this);
    }


   
}