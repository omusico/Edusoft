<?php

namespace Admin\Entity;


use Doctrine\ORM\Mapping as ORM;
// added by Stoyan
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

use Zend\Form\Annotation;

/**
 *@ORM\Entity
 * @ORM\Entity(repositoryClass="Admin\Repository\SessionRepository")
 * @ORM\Table(name="settings")
 * @Annotation\Name("settings")
 * @Annotation\Hydrator("Zend\Stdlib\Hydrator\ClassMethods")
 */
class Settings
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
    *@var integer $session
    *@ORM\ManyToOne(targetEntity="Admin\Entity\Session")
    *@ORM\JoinColumn(name="session", referencedColumnName="id")
    **/
    protected $session;

    /**
    *@var integer $section
    *@ORM\ManyToOne(targetEntity="Admin\Entity\Section", )
    *@ORM\JoinColumn(name="section", referencedColumnName="id")
    **/
    protected $section;


    /**
    *@var integer $grade
    *@ORM\ManyToOne(targetEntity="Admin\Entity\GradeFormat", )
    *@ORM\JoinColumn(name="grade", referencedColumnName="id")
    **/
    protected $grade;


    /**
    *@var integer $assessment
    *@ORM\ManyToOne(targetEntity="Admin\Entity\CaFormat", )
    *@ORM\JoinColumn(name="assessment", referencedColumnName="id")
    **/
    protected $assessment;


    /**
    *@var integer $trait
    *@ORM\ManyToOne(targetEntity="Admin\Entity\TraitFormat", )
    *@ORM\JoinColumn(name="term", referencedColumnName="id")
    **/
    protected $trait;





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
    * Set session
    *
    * @param Session $session
    * @return Settings
    */
    public function setSession(Session $session)
    {
        $this->session = $session;

        return $this;
    }
      /**
    *@return session
    **/
    public function getSession()
    {
        return $this->session;
    }

 
    /**
    * Set section
    *
    * @param Section $section
    * @return Settings
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
    * Set grade
    *
    * @param GradeFormat $grade
    * @return Settings
    */
    public function setGrade(GradeFormat $grade)
    {
        $this->grade = $grade;

        return $this;
    }

    /**
    *@return GradeFormat
    **/
    public function getGrade()
    {
        return $this->grade;
    }

        /**
    * Set assessment
    *
    * @param CaFormat $assessment
    * @return Settings
    */
    public function setAssessment(CaFormat $assessment)
    {
        $this->assessment = $assessment;

        return $this;
    }

    /**
    *@return CaFormat
    **/
    public function getAssessment()
    {
        return $this->assessment;
    }

          /**
    * Set trait
    *
    * @param TraitFormat $trait
    * @return Settings
    */
    public function setTrait(TraitFormat $trait)
    {
        $this->trait = $trait;

        return $this;
    }

    /**
    *@return TraitFormat
    **/
    public function getTrait()
    {
        return $this->trait;
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