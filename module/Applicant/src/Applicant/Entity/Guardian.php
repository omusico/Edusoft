<?php 
namespace Applicant\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="Applicant\Repository\GuardianRepository")
 * @ORM\Table(name="guardian")
 */
class Guardian implements GuardianInterface
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
     * @ORM\Column(name="first_name", type="string", length=45, nullable=false)
     */
    protected $firstName;

    /**
     * @var string
     *
     * @ORM\Column(name="last_name", type="string", length=45, nullable=false)
     */
    protected $lastName;

    /**
     * @var string
     *
     * @ORM\Column(name="middle_name", type="string", length=45, nullable=true)
     */
    protected $middleName;

    /**
     * @var string
     *
     * @ORM\Column(name="gender", type="string", length=75, nullable=false)
     */
    protected $gender;


    /**
     * @var string
     *
     * @ORM\Column(name="mobile1", type="string", length=45, nullable=true)
     */
    protected $mobile1;

      /**
     * @var string
     *
     * @ORM\Column(name="mobile2", type="string", length=45, nullable=true)
     */
    protected $mobile2;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=45, nullable=true)
     */
    protected $email;

    /**
     * @var string
     *
     * @ORM\Column(name="occupation", type="string", length=45, nullable=false)
     */
    protected $occupation;

    

    /**
     * @ORM\OneToOne(targetEntity="Applicant\Entity\Person", mappedBy="guardian",)
     */
    protected $person;


        /**
     * Set id.
     *
     * @param int $id
     * @return GuardianInterface
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }


    /**
     * Set firstName
     *
     * @param string firstName
     * @return GuardianInterface
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;

        return $this;
    }

    /**
     * Get firstName
     *
     * @return string 
     */
    public function getFirstName()
    {
        return $this->firstName;
    }


    /**
     * Set lastName
     *
     * @param string $lastName
     * @return GuardianInterface
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;

        return $this;
    }

    /**
     * Get lastName
     *
     * @return string 
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * Set $middleName
     *
     * @param string $middleName
     * @return GuardianInterface
     */
    public function setMiddleName($middleName)
    {
        $this->middleName = $middleName;

        return $this;
    }

    /**
     * Get $middleName
     *
     * @return string 
     */
    public function getMiddleName()
    {
        return $this->middleName;
    }


    /**
     * Set mobile
     *
     * @param string $mobile1
     * @return GuardianInterface
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
     * @return GuardianInterface
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
     * @return GuardianInterface
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
     * @return GuardianInterface
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
     * @return GuardianInterface
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