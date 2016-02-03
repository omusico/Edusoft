<?php
/**
 * Cloud Base School Management System
 *
 * @author Isaac Bitrus 
 * @copyright Copyright (c) 2015 Edusoft (http://www.edusoft.com.ng)
 */
 
namespace Admin\Entity;
use Doctrine\ORM\Mapping as ORM;
/**
*@ORM\Table(name="class")
* @ORM\Entity(repositoryClass="Admin\Repository\ClassesRepository")
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
   * @ORM\Column(name="name", type="integer", length=100, nullable=false)
    **/
    private $initial;

    /**
    *@var integer $arm
   * @ORM\Column(name="arm", type="string", length=100, nullable=false)
    **/
    private $arm;


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
     * Set id.
     *
     * @param int $id
     * @return ClassesInterface
     */
    public function setId($id)
    {
        $this->id =(int) $id;

        return $this;
    }
    
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
     * Set section
    *
    * @param string $session
    * @return ClassesInterface
    */
    public function setSection($section)
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
    * @param integer $initial
    * @return ClassesInterface
    */
    public function setInitial($initial)
    {
        $this->initial = $initial;

        return $this;
    }

    /**
    *@return Integer
    **/
    public function getInitial()
    {

        return $this->initial;
    }


    /**
     * Set section
    *
    * @param string $arm
    * @return ClassesInterface
    */
    public function setArm($arm)
    {
        $this->arm = $arm;

        return $this;
    }

    /**
    *@return string
    **/
    public function getArm()
    {
       return $this->arm;
    }
   

    



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