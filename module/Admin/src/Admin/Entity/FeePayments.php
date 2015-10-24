<?php

namespace Admin\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * FeePayments
 *
 * @ORM\Table(name="fee_payments")
 * @ORM\Entity(repositoryClass="Admin\Repository\FeePaymentsRepository")
 */
class FeePayments
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
     * @ORM\Column(name="method", type="string", nullable=true)
     */
    protected $method;

      /**
     * @var string
     *
     * @ORM\Column(name="receipt", type="string", nullable=true)
     */
    protected $receipt;

      /**
     * @var string
     *
     * @ORM\Column(name="dop", type="string", nullable=true)
     */
    protected $dop;


 /**
     * @ORM\ManyToOne(targetEntity="Admin\Entity\FeeStudent", inversedBy="payments" )
     */
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
     * @return FeePayments
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
     * Set method
     *
     * @param string $method
     * @return FeePayments
     */
    public function setMethod($method)
    {
        $this->method = $method;

        return $this;
    }

    /**
     * Get method
     *
     * @return string 
     */
    public function getMethod()
    {
        return $this->method;
    }

     /**
     * Set dop
     *
     * @param string $dop
     * @return FeePayments
     */
    public function setDop($dop)
    {
        $this->dop = $dop;

        return $this;
    }

    /**
     * Get dop
     *
     * @return string 
     */
    public function getDop()
    {
        return $this->dop;
    }

         /**
     * Set receipt
     *
     * @param string $receipt
     * @return FeePayments
     */
    public function setReceipt($receipt)
    {
        $this->receipt = $receipt;

        return $this;
    }

    /**
     * Get receipt
     *
     * @return string 
     */
    public function getReceipt()
    {
        return $this->receipt;
    }


        /**
     * Allow null to remove association
     *
     * @param FeeStudent $feeStudent
     */
    public function setFeeStudent(FeeStudent $feeStudent=null)
    {
        $this->feeStudent = $feeStudent;
    }

    /**
     * @return FeeStudent
     */
    public function getFeeStudent()
    {
        return $this->feeStudent;
    }




    


 
  
}
