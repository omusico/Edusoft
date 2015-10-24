<?php
namespace Admin\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="Subject")
 */
class Subject
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

 
    /**
     * @ORM\Column(type="string")
     */
    protected $name;

     /**
     * @ORM\Column(type="string")
     */
    protected $code;

     /**
     * @ORM\Column(type="string", nullable=true)
     */
    protected $description;

     /**
    *@var integer $category
    *@ORM\ManyToOne(targetEntity="Admin\Entity\SubjectCategory")
    *@ORM\JoinColumn(name="category", referencedColumnName="id")
    **/
    private $category;

     /**
     * @ORM\OneToMany(targetEntity="SubjectSectionAssociation", mappedBy="subject",  cascade={"persist", "remove"})
     */
    protected $subject_section_associations;
    
    
    protected $inputFilter;
    
    
    public function __construct() {
        //$this->posts = new \Doctrine\Common\Collections\ArrayCollection();
        $this->subject_section_associations = new \Doctrine\Common\Collections\ArrayCollection();
    }


    /**
     * Get the id
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }


    /**
     * @param string $code
     */
    public function setCode($code)
    {
        $this->code = $code;
    }

    /**
     * @return string
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * @param string $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
    * Set category
    *
    * @param SubjectCategory $category
    * @return Subject
    */
    public function setCategory(SubjectCategory $category = null)
    {
        $this->category = $category;

        return $this;
    }

    /**
    *@return SubjectCategory
    **/
    public function getCategory()
    {
        return $this->category;
    }


     /**
     * Add subject_section_associations
     *
     * @param \Admin\Entity\SubjectSectionAssociation $subjectSectionAssociations
     * @return Subject
     */
    public function addSubjectSectionAssociations(\Admin\Entity\SubjectSectionAssociation $link){
        $this->subject_section_associations->add($link);
    
        return $this;
    }
    
    /**
     * Remove subject_section_associations
     *
     * @param \Admin\Entity\SubjectSectionAssociation $subjectSectionAssociations
     */
    public function removeSubjectSectionAssociations(\Admin\Entity\SubjectSectionAssociation $link){
        $this->subject_section_associations->removeElement($link);
    }
    
    /**
     * Get subject_section_associations
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getSubjectSectionAssociations()
    {
        return $this->subject_section_associations;
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


