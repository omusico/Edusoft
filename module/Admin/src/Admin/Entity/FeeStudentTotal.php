<?php

namespace Admin\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * FeeStudentTotal
 *
 * @ORM\Table(name="fee_student_total")
 * @ORM\Entity
 */
class FeeStudentTotal
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
     * @var integer
     *
     * @ORM\Column(name="amount", type="integer", nullable=true)
     */
    protected $amount;
         /**
     * @var string
     *
     * @ORM\Column(name="fee_status", type="string", nullable=true)
     */
    protected $feeStatus;
        
        /**
     * @var string
     *
     * @ORM\Column(name="section_fee", type="string", nullable=true)
     */
    protected $sectionFee;

     /**
    *@var integer $session
    *@ORM\ManyToOne(targetEntity="Session")
    *@ORM\JoinColumn(name="session_id", referencedColumnName="id")
    **/
    protected $session;


     /**
    *@var integer $feeStudent
    *@ORM\ManyToOne(targetEntity="FeeStudent", inversedBy="studentTotal")
    *@ORM\JoinColumn(name="feeStudent_id", referencedColumnName="id",  onDelete="CASCADE")
    **/
    protected $feeStudent;

   

   
    

   
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
     * Set amount
     *
     * @param integer $amount
     * @return FeeStudentTotal
     */
    public function setAmount($amount)
    {
        $this->amount = $amount;

        return $this;
    }

    /**
     * Get amount
     *
     * @return integer 
     */
    public function getAmount()
    {
        return $this->amount;
    }

        /**
     * Set feeStatus
     *
     * @param string $feeStatus
     * @return FeeStudentTotal
     */
    public function setFeeStatus($feeStatus)
    {
        $this->feeStatus = $feeStatus;

        return $this;
    }

    /**
     * Get feeStatus
     *
     * @return string 
     */
    public function getFeeStatus()
    {
             if($this->feeStatus=="Paid"){
                    $paid = $this->feeStatus="Paid";
                  echo '<span class="label label-success">'.$paid . '</span>';  }
                    else{
                $owning = $this->feeStatus="Owning";
                  echo '<span class="label label-warning">'.$owning . '</span>'; 
                 }   
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
     * Set feeStudent
     *
     * @param FeeStudent $feeStudent
     * @return FeeStudent
     */
    public function setFeeStudent(FeeStudent $feeStudent)
    {
        $this->feeStudent = $feeStudent;

        return $this;
    }

    /**
     * Get feeStudent
     *
     * @return FeeStudent 
     */
    public function getFeeStudent()
    {
        return $this->feeStudent;
    }

     /**
     * Set sectionFee
     *
     * @param integer $sectionFee
     * @return FeeStudentTotal
     */
    public function setSectionFee($sectionFee)
    {
        $this->sectionFee = $sectionFee;

        return $this;
    }

    /**
     * Get sectionFee
     *
     * @return integer 
     */
    public function getSectionFee()
    {
        return $this->sectionFee;
    }
  
}
