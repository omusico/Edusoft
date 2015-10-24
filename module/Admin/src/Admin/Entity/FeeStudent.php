<?php

namespace Admin\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * FeeStudent
 *
 * @ORM\Table(name="fee_student")
 * @ORM\Entity
 */
class FeeStudent
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
    *@ORM\ManyToOne(targetEntity="Session")
    *@ORM\JoinColumn(name="session_id", referencedColumnName="id")
    **/
    protected $session;

      /**
    *@var integer $year
    *@ORM\ManyToOne(targetEntity="Student")
    *@ORM\JoinColumn(name="student_id", referencedColumnName="id")
    **/
    protected $student;

     /**
     * @ORM\OneToMany(targetEntity="Admin\Entity\FeePayments", mappedBy="feeStudent" , cascade={"persist"})
     */
    protected $payments;

     /**
     * @ORM\OneToMany(targetEntity="Admin\Entity\FeeStudentTotal", mappedBy="feeStudent", cascade={"persist"})
     */
    protected $studentTotal;

   
   /**
     * Never forget to initialize all your collections !
     */
    public function __construct()
    {
        $this->payments = new ArrayCollection();
         $this->studentTotal = new ArrayCollection();
    }

    /**
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    public function getTotal()
    {
        $total = 0;
        foreach ($this->payments as $payment) {
            $total += $payment->getAmount();
        }
        return $total;
    }

    /**
     * @param Collection $payments
     */
    public function addPayments(Collection $payments)
    {
        foreach ($payments as $payment) {
            $payment->setFeeStudent($this);
            $this->payments->add($payment);
        }
    }





    /**
     * @param Collection $payments
     */
    public function removePayments(Collection $payments)
    {
        foreach ($payments as $payment) {
            $payment->setFeeStudent(null);
            $this->payments->removeElement($payment);
        }
    }

    /**
     * @return Collection
     */
    public function getPayments()
    {
        return $this->payments;
    }

     public function setPayments()
    {
        return $this->payments;
    }

        /**
     * @return Collection
     */
    public function getStudentTotal()
    {
        return $this->studentTotal;
    }

     

    /**
     * Set session
     *
     * @param Session $session
     * @return Session
     */
    public function setSession(Session $session)
    {
        $this->session = $session;

        return $this;
    }

    /**
     * Get session
     *
     * @return Session 
     */
    public function getSession()
    {
        return $this->session;
    }



     /**
     * Set student
     *
     * @param Student $student
     * @return Student
     */
    public function setStudent(Student $student)
    {
        $this->student = $student;

        return $this;
    }

    /**
     * Get student
     *
     * @return Student 
     */
    public function getStudent()
    {
        return $this->student;
    }
  
}
