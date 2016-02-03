<?php
/**
 * Cloud Base Educational Management System
 *
 * @author Isaac Bitrus 
 * @copyright Copyright (c) 2015 Edusoft (http://www.edusoft.com.ng)
 */

namespace Admin\Entity;
use Doctrine\ORM\Mapping as ORM;
//use Admin\Model\SemesterInterface;
/**
* @ORM\Entity(repositoryClass="Admin\Repository\TermRepository")
*@ORM\Entity
*/
class Term implements TermInterface
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
     * @return TermInterface
     */
    public function setId($id)
    {
        $this->id = (int) $id;
        return $this;
    }


    /**
     * Set name
     *
     * @param string $name
     * @return TermInterface
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
     * Convert the object to an array.
     *
     * @return array
     */
    public function getArrayCopy() 
    {
        return get_object_vars($this);
    }


   
}