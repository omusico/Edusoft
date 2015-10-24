<?php 
namespace Admin\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Applicant
 *
 * @ORM\Table(name="guardian")
 * @ORM\Entity
 */
class Guardian
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
       *@var integer $user
     * @ORM\ManyToOne(targetEntity="\EduUser\Entity\User")
     * @ORM\JoinColumn(name="user", referencedColumnName="id",  onDelete="SET NULL")
     */
    protected $user;

    /**
     * @var string
     *
     * @ORM\Column(name="fname", type="string", length=45, nullable=false)
     */
    protected $fname;

    /**
     * @var string
     *
     * @ORM\Column(name="lname", type="string", length=45, nullable=false)
     */
    protected $lname;

    /**
     * @var string
     *
     * @ORM\Column(name="mname", type="string", length=45, nullable=true)
     */
    protected $mname;

    /**
     * @var string
     *
     * @ORM\Column(name="gender", type="string", length=75, nullable=false)
     */
    protected $gender;


    /**
     * @var string
     *
     * @ORM\Column(name="mobile1", type="string", length=45, nullable=false)
     */
    protected $mobile1;

      /**
     * @var string
     *
     * @ORM\Column(name="mobile2", type="string", length=45, nullable=false)
     */
    protected $mobile2;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=45, nullable=false)
     */
    protected $email;

    /**
     * @var string
     *
     * @ORM\Column(name="occupation", type="string", length=45, nullable=false)
     */
    protected $occupation;

    

    /**
     * @ORM\OneToMany(targetEntity="Admin\Entity\Person", mappedBy="guardian",)
     */
    protected $person;


    /**
     * Never forget to initialize all your collections !
     */
    public function __construct()
    {
        $this->persons = new ArrayCollection();
    }

    /**
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param Collection $person
     */
    public function addPerson(Collection $person)
    {
        foreach ($person as $person) {
            $person->setGuardian($this);
            $this->person->add($person);
        }
    }

    /**
     * @param Collection $person
     */
    public function removePerson(Collection $person)
    {
        foreach ($person as $person) {
            $person->setGuardian(null);
            $this->person->removeElement($person);
        }
    }

    /**
     * @return Collection
     */
    public function getPerson()
    {
        return $this->person;
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
     * Set fname
     *
     * @param string $fname
     * @return Guardian
     */
    public function setFname($fname)
    {
        $this->fname = $fname;

        return $this;
    }

    /**
     * Get fname
     *
     * @return string 
     */
    public function getFname()
    {
        return $this->fname;
    }


    /**
     * Set lname
     *
     * @param string $lname
     * @return Guardian
     */
    public function setLname($lname)
    {
        $this->lname = $lname;

        return $this;
    }

    /**
     * Get lname
     *
     * @return string 
     */
    public function getLname()
    {
        return $this->lname;
    }

    /**
     * Set mname
     *
     * @param string $mname
     * @return Guardian
     */
    public function setMname($mname)
    {
        $this->mname = $mname;

        return $this;
    }

    /**
     * Get mname
     *
     * @return string 
     */
    public function getMname()
    {
        return $this->mname;
    }


    /**
     * Set mobile
     *
     * @param string $mobile1
     * @return Guardian
     */
    public function setMobile1($mobile1)
    {
        $this->mobile1 = $mobile1;

        return $this;
    }

    /**
     * Get mobile
     *
     * @return string 
     */
    public function getMobile1()
    {
        return $this->mobile1;
    }

     /**
     * Set mobile
     *
     * @param string $mobile2
     * @return Guardian
     */
    public function setMobile2($mobile2)
    {
        $this->mobile2 = $mobile2;

        return $this;
    }

    /**
     * Get mobile
     *
     * @return string 
     */
    public function getMobile2()
    {
        return $this->mobile2;
    }


    /**
     * Set occupation
     *
     * @param string $occupation
     * @return Guardian
     */
    public function setOccupation($occupation)
    {
        $this->occupation = $occupation;

        return $this;
    }

    /**
     * Get occupation
     *
     * @return string 
     */
    public function getOccupation()
    {
        return $this->occupation;
    }

    



    /**
     * Set gender
     *
     * @param string $gender
     * @return Guardian
     */
    public function setGender($gender)
    {
        $this->gender = $gender;

        return $this;
    }

    /**
     * Get gender
     *
     * @return string 
     */
    public function getGender()
    {
        return $this->gender;
    }


    /**
     * Set email
     *
     * @param string $email
     * @return Guardian
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string 
     */
    public function getEmail()
    {
        return $this->email;
    }






}