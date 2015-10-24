<?php
/**
 * Cloud Base Educational Management System
 *
 * @author Isaac Bitrus 
 * @copyright Copyright (c) 2015 Edusoft (http://www.edusoft.com.ng)
 */
 
namespace Admin\Entity;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;


/**
*@ORM\Table(name="student")
*@ORM\Entity
*/
class Student
{
	/**
		* @var integer
		*@ORM\Column(name="id", type="integer", nullable=false)
		*@ORM\Id
		*@ORM\GeneratedValue(strategy="IDENTITY")
		*/
	protected $id;

           /**
     * @ORM\ManyToOne(targetEntity="\EduUser\Entity\User")
     * @ORM\JoinColumn(name="user", referencedColumnName="id",  onDelete="SET NULL")
     */
    protected $user;

	 /**
     * @ORM\ManyToOne(targetEntity="Admin\Entity\Person", inversedBy="student", cascade={"persist"})
     */
    protected $person;

      /**
     * @ORM\OneToMany(targetEntity="Admin\Entity\Result", mappedBy="student", cascade={"persist"})
     */
    protected $result;

    /**
     * @ORM\ManyToOne(targetEntity="Admin\Entity\FeeStudentTotal")
     * @ORM\JoinColumn(name="total", referencedColumnName="id",  onDelete="SET NULL")
     */
    protected $studentTotal;

        /**
     * @ORM\ManyToOne(targetEntity="Admin\Entity\Rating")
     * @ORM\JoinColumn(name="rating", referencedColumnName="id",  onDelete="SET NULL")
     */
    protected $rating;



    /**
    *@var integer $section
    *@ORM\ManyToOne(targetEntity="Section",)
    **/
    protected $section;


    /**
    *@var integer $class
    *@ORM\ManyToOne(targetEntity="Classes", )
    **/
    protected $class;

    /**
    *@var integer $currentclass
    *@ORM\ManyToOne(targetEntity="Classes", )
    **/
    protected $currentclass;

    /**
    *@var string $admDate
    *@ORM\Column(name="admission_date", type="string", nullable=False)
    **/
    protected $admDate;


    /**
    *@var string $admNo
    *@ORM\Column(name="admission_no", type="string", nullable=true)
    **/
    protected $admNo;

    /**
    *@var string $status
    *@ORM\Column(name="status", type="string", nullable=true)
    **/
    protected $status;


     /**
    *@var integer $year
    *@ORM\ManyToOne(targetEntity="Year",)
    **/
    protected $year;

    /**
    *@var integer $term
    *@ORM\ManyToOne(targetEntity="Term",)
    **/
    protected $term;

    /**
     * @var string
     *
     * @ORM\Column(name="image", type="string",  nullable=true)
     */
    protected $image;

      public function __construct()
    {    $this->result = new ArrayCollection();
        $this->theDate = new \DateTime();
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
     * Set studentTotal
    *
    * @param FeeStudentTotal $studentTotal
    * @return Student
    */
    public function setStudentTotal(FeeStudentTotal $studentTotal=null)
    {
        $this->studentTotal = $studentTotal;

        return $this;
    }

    /**
    *@return FeeStudentTotal
    **/
    public function getStudentTotal()
    {
        return $this->studentTotal;
    }


     /**
     * Set rating
    *
    * @param Rating $rating
    * @return Student
    */
    public function setRating(Rating $rating=null)
    {
        $this->rating = $rating;

        return $this;
    }

    /**
    *@return Rating
    **/
    public function getRating()
    {
        return $this->rating;
    }

     /**
    *@return Collection
    **/
    public function getResult()
    {
        return $this->result;
    }

   
    /**
     * Set section
    *
    * @param Section $section
    * @return Student
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
     * Set Session
    *
    * @param Session $session
    * @return Student
    */
    public function setSession(Session $session)
    {
        $this->session = $session;

        return $this;
    }

    /**
    *@return Session
    **/
    public function getSession()
    {
        return $this->session;
    }


    /**
     * Set person
    *
    * @param Person $person
    * @return Student
    */
    public function setPerson(Person $person)
    {
        $this->person = $person;

        return $this;
    }

    /**
    *@return Person
    **/
    public function getPerson()
    {
        return $this->person;
    }


  
     /**
     * Set class
    *
    * @param Classes $class
    * @return Student
    */
    public function setClass(Classes $class)
    {
        $this->class = $class;

        return $this;
    }

    /**
    *@return Classes
    **/
    public function getClass()
    {
        return $this->class;
    }

     /**
     * Set currentclass
    *
    * @param Classes $currentclass
    * @return Student
    */
    public function setCurrentclass(Classes $currentclass=null)
    {
        $this->currentclass = $currentclass;

        return $this;
    }

    /**
    *@return Classes
    **/
    public function getCurrentclass()
    {
        return $this->currentclass;
    }


    /**
     * Set year
    *
    * @param Year $year
    * @return Student
    */
    public function setYear(Year $year)
    {
        $this->year = $year;

        return $this;
    }

    /**
    *@return Year
    **/
    public function getYear()
    {
        return $this->year;
    }

    /**
     * Set term
    *
    * @param Term $term
    * @return Student
    */
    public function setTerm(Term $term)
    {
        $this->term = $term;

        return $this;
    }

    /**
    *@return Term
    **/
    public function getTerm()
    {
        return $this->term;
    }

        /**
     * Set admNo
     *
     * @param string $admNo
     * @return Student
     */
    public function setAdmNo($admNo)
    {
        $this->admNo = $admNo;

        return $this;
    }

    /**
     * Get admNo
     *
     * @return string 
     */
    public function getAdmNo()
    {
        return $this->admNo;
    }

       /**
     * Set status
     *
     * @param string $status
     * @return Student
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get status
     *
     * @return string 
     */
    public function getStatus()
    {
        return $this->status;
    }

      /**
     *@param  $admDate
    *@return Student
    **/
    public function SetAdmDate($admDate)
    {
         $this->admDate = $admDate;
         return $this;
    }

     /**
     * Get admDate
     * @param String $admDate
     * @return String
     */
    public function getAdmDate()
    {
       //  $startDate = $this->startDate->format('d/m/Y');
       // return $startDate;
        return $this->admDate;
    }

    /**
     * Set image
     *
     * @param string $image
     * @return Student
     */
    public function setImage($image)
    {
        
          if (is_array($image) && isset($image['name'])) {
                    $image = $image['name'];
                }
                if (empty($image)) {
                    $image='avatar.png';
                }

                $this->image = $image;
                return $this;
    }

    /**
     * Get image
     *
     * @return string 
     */
    public function getImage()
    {
        return $this->image;
    }

           /**
     * Set user
    *
    * @param \EduUser\Entity\User $user
    * @return \EduUser\Entity\User
    */
    public function setUser(\EduUser\Entity\User $user=null)
    {
        $this->user = $user;

        return $this;
    }

    /**
    *@return User
    **/
    public function getUser()
    {
        return $this->user;
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