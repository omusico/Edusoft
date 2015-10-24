<?php

namespace Admin\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * GradeSystem
 *
 * @ORM\Table(name="grade_system")
 * @ORM\Entity
 */
class GradeSystem
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
     * @ORM\Column(name="grade", type="string", nullable=false)
     */
    protected $grade;


      /**
     * @var integer
     *
     * @ORM\Column(name="start_range", type="integer", nullable=false)
     */
    protected $startRange;


      /**
     * @var integer
     *
     * @ORM\Column(name="end_range", type="integer", nullable=false)
     */
    protected $endRange;

      /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", nullable=false)
     */
    protected $description;

    /**
     * @ORM\ManyToOne(targetEntity="Admin\Entity\GradeFormat", inversedBy="gradeSystems" )
      *@ORM\JoinColumn(name="gradeFormat_id", referencedColumnName="id", onDelete="CASCADE")
     */
    protected $gradeFormat;


   
    

   
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
     * Set grade
     *
     * @param string $grade
     * @return GradeSystem
     */
    public function setGrade($grade)
    {
        $this->grade = $grade;

        return $this;
    }

    /**
     * Get grade
     *
     * @return string 
     */
    public function getGrade()
    {
        return $this->grade;
    }


     /**
     * Set startRange
     *
     * @param integer $startRange
     * @return GradeSystem
     */
    public function setStartRange($startRange)
    {
        $this->startRange = $startRange;

        return $this;
    }

    /**
     * Get startRange
     *
     * @return integer 
     */
    public function getStartRange()
    {
        return $this->startRange;
    }


     /**
     * Set endRange
     *
     * @param integer $endRange
     * @return GradeSystem
     */
    public function setEndRange($endRange)
    {
        $this->endRange = $endRange;

        return $this;
    }

    /**
     * Get endRange
     *
     * @return integer 
     */
    public function getEndRange()
    {
        return $this->endRange;
    }
    /**
     * Set description
     *
     * @param string $description
     * @return GradeSystem
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
     * Set gradeFormat
     *
     * @param GradeFormat $gradeFormat
     * @return GradeFormat
     */
    public function setGradeFormat(GradeFormat $gradeFormat = null)
    {
        $this->gradeFormat = $gradeFormat;

        return $this;
    }

    /**
     * Get gradeFormat
     *
     * @return GradeFormat 
     */
    public function getGradeFormat()
    {
        return $this->gradeFormat;
    }
  
}
