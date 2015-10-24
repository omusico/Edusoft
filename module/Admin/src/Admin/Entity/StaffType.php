<?php
/**
 * Cloud Base Educational Management System
 *
 * @author Isaac Bitrus 
 * @copyright Copyright (c) 2015 Edusoft (http://www.edusoft.com.ng)
 */
 
namespace Admin\Entity;
use Doctrine\ORM\Mapping as ORM;
/**
*@ORM\Table(name="staff_type")
* @ORM\Entity
*/
class StaffType
{
	/**
		* @var integer
		*@ORM\Column(name="id", type="integer", nullable=false)
		*@ORM\Id
		*@ORM\GeneratedValue(strategy="IDENTITY")
		*/
	protected $id;

	/**
    * @var string $category
    *@ORM\Column(name="category", type="string", nullable=false)
    */
    protected $category;

    /**
    * @var string $name
    *@ORM\Column(name="name", type="string", nullable=false)
    */
    protected $name;


  
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
     * Set Session
    *
    * @param string $category
    * @return StaffType
    */
    public function setCategory($category)
    {
        $this->category = $category;

        return $this;
    }

    /**
    *@return string
    **/
    public function getCategory()
    {
        return $this->category;
    }


    /**
     * Set staff
    *
    * @param string $name
    * @return StaffType
    */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
    *@return string
    **/
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