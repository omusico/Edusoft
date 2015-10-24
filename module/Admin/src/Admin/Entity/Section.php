<?php
namespace Admin\Entity;

use Doctrine\ORM\Mapping as ORM;
use Zend\InputFilter\InputFilter;
use Zend\InputFilter\Factory as InputFactory;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;

/**
 *
 * @Orm\Entity
 * @ORM\Table(name="section")
 * @property string $name
 * @property string $shortname
 * @property int $id
 */
class Section  
{
    /**
    * @ORM\Column(name="id", type="integer")
    * @ORM\Id
    * @ORM\GeneratedValue(strategy="AUTO")
    */
    protected $id;

    /**
     * @ORM\Column(type="string", length=100, nullable=false)
     */
    protected $name;
    
    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    protected $shortname;
    
   

   
    /**
     * @ORM\OneToMany(targetEntity="Admin\Entity\SubjectSectionAssociation", mappedBy="section",  cascade={"persist", "remove"})
     */
    protected $subject_section_associations;
    
    protected $inputFilter;
    
    public function __construct() {
        //$this->categories = new \Doctrine\Common\Collections\ArrayCollection();
        $this->subject_section_associations = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
    /**
     * @return integer
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
     * @param string $shortname
     */
    public function setShortname($shortname)
    {
        $this->shortname = $shortname;
    }

      /**
     * @return string
     */
    public function getShortname()
    {
        return $this->shortname;
    }
    
    /**
     * Add subject_section_associations
     *
     * @param \Admin\Entity\SubjectSectionAssociation $subjectSectionAssociations
     * @return Section
     */
    public function addSubjectSectionAssociations(\Admin\Entity\SubjectSectionAssociation $link){
        //$this->category_post_associations[] = $categoryPostAssociations;
        $this->subject_section_associations->add($link);
        return $this;
    }
    
    /**
     * Remove subject_section_associations
     *
     * @param \Admin\Entity\SubjectSectionAssociation $subjectSectionAssociations
     * @return SubjectSectionAssociation
     */
    public function removeSubjectSectionAssociations(\Admin\Entity\SubjectSectionAssociation $link){
        $this->subject_section_associations->removeElement($link);
        return $link;
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
     * Returns the created $link
     */
    public function addSubject(Subject $subject){
        //$this->categories->add($category);
        //Create Association, add to entity's list
        //$this->category_post_associations
        $link = new SubjectSectionAssociation();
        $link->setSubject($subject);
        $link->setSection($this);
        $this->addSubjectSectionAssociations($link);
        return $link;
    }

    //Returns the removed $link
    /**
     * Throws \Exception("Not used");
     */
    public function removeSubject(Subject $subject){

        throw new \Exception("Not used");
        
//         $links = $this->getCategoryPostAssociations();
//      foreach($links as $l)
//      {
//          $cat = $l->getCategory();
//          if($cat->getId() == $category->getId()){
//              $link = $l;
//              break;
//          }
//      }
//      $this->category_post_associations->removeElement($link);
//      return $link;
    }
    
    
    //Returns the removed $link
    /**
     * Throws \Exception("Not used"); 
     */
    public function removeSubjectById($subId){

        throw new \Exception("Not used");
        
//      $links = $this->getCategoryPostAssociations();
//      foreach($links as $l)
//      {
//          $cat = $l->getCategory();
//          if($cat->getId() == $catId){
//              $link = $l;
//              break;
//          }
//      }
//      $this->category_post_associations->removeElement($link);
//      return $link;
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
public function exchangeArray ($data = array()) 
    {
        //$this->id = $data['id'];
        $this->name = $data['name'];
        $this->shortname = $data['shortname'];
        $this->subject = $data['subject'];
     }
    
}