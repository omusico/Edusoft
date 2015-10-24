<?php
/**
 * Cloud Base Educational Management System
 *
 * @author Isaac Bitrus 
 * @copyright Copyright (c) 2015 Edusoft (http://www.edusoft.com.ng)
 */
 
namespace Messages\Entity;
use Doctrine\ORM\Mapping as ORM;
/**
*@ORM\Table(name="messages")
*@ORM\Entity
*/
class Messages
{
    /**
        * @var integer
        *@ORM\Column(name="id", type="integer", nullable=false)
        *@ORM\Id
        *@ORM\GeneratedValue(strategy="IDENTITY")
        */
    protected $id;

        /**
     * @var string
     *
     * @ORM\Column(name="subject", type="string", length=100, nullable=false)
     */
    protected $subject;

    /**
     * @var string
     *
     * @ORM\Column(name="message", type="text",nullable=false)
     */
    protected $message;


       /**
    *@var integer $from
    *@ORM\ManyToOne(targetEntity="\EduUser\Entity\User")
    *@ORM\JoinColumn(name="from_id", referencedColumnName="id")
    **/
    protected $from;



   /**
     * @var Datetime
     *
     * @ORM\Column(name="date", type="datetime", length=100, nullable=false)
     */
    protected $date;

     public function __construct()
    {
          $this->date = new \DateTime();
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
     * Set name
     *
     * @param string $subject
     */
    public function setSubject($subject)
    {
        $this->subject = $subject;

        return $this;
    }

    /**
     * Get subject
     *
     * @return string 
     */
    public function getSubject()
    {
        return $this->subject;
    }

         /**
     * Set from
     *
     * @param \EduUser\Entity\User $from
     * @return \EduUser\Entity\User
     */
    public function setFrom(\EduUser\Entity\User $from)
    {
        $this->from = $from;

        return $this;
    }



    /**
     * Get from
     *
     * @return \EduUser\Entity\User
     */
    public function getFrom()
    {
        return $this->from;
    }

    /**
     * @param \DateTime $date
     */
    public function setDate($date)
    {
        $this->date = $date;
        return $this;
    }

       /**
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }
    
     /**
     * Set message
     *
     * @param string $message
     */
    public function setMessage($message)
    {
        $this->message = $message;

        return $this;
    }

    /**
     * Get message
     *
     * @return string 
     */
    public function getMessage()
    {
        return $this->message;
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