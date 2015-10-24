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
*@ORM\Table(name="class")
*@ORM\Entity
*/
class Classes
{
	/**
		* @var integer
		*@ORM\Column(name="id", type="integer", nullable=false)
		*@ORM\Id
		*@ORM\GeneratedValue(strategy="IDENTITY")
		*/
	private $id;

	/**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=100, nullable=false)
     */
    private $name;


    /**
    *@var integer $section
    *@ORM\ManyToOne(targetEntity="Section", fetch="EAGER")
    **/
    private $section;


    /**
    *@var integer $initial
    *@ORM\ManyToOne(targetEntity="Initial", fetch="EAGER")
    **/
    private $initial;

    /**
    *@var integer $arm
    *@ORM\ManyToOne(targetEntity="Arms", fetch="EAGER")
    **/
    private $arm;

    
     /**
     * Set name
     *
     * @param string $name
     * @return name
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
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }
    /**
     * Set section
    *
    * @param Section $session
    * @return Class
    */
    public function setSection(Section $section)
    {
        $this->section = $section;

        return $this;
    }

    /**
    *@return Section
    **/
    public function getSection()
    {
        return $this->section;
    }


    /**
     * Set Initial
    *
    * @param Initial $initial
    * @return Classes
    */
    public function setInitial(Initial $initial)
    {
        $this->initial = $initial;

        return $this;
    }

    /**
    *@return Initial
    **/
    public function getInitial()
    {
        return $this->initial;
    }


    /**
     * Set section
    *
    * @param Arm $arm
    * @return Classes
    */
    public function setArm(Arms $arm)
    {
        $this->arm = $arm;

        return $this;
    }

    /**
    *@return Arms
    **/
    public function getArm()
    {
        return $this->arm;
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