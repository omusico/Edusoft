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
*@ORM\Table(name="receivers")
*@ORM\Entity
*/
class Receivers
{
    /**
        * @var integer
        *@ORM\Column(name="id", type="integer", nullable=false)
        *@ORM\Id
        *@ORM\GeneratedValue(strategy="IDENTITY")
        */
    protected $id;

   
    /**
    *@var integer $messages
    *@ORM\ManyToOne(targetEntity="Messages", fetch="EAGER")
    **/
    protected $messages;

    /**
    *@var integer $to
    *@ORM\ManyToOne(targetEntity="\EduUser\Entity\User", fetch="EAGER")
    *@ORM\JoinColumn(name="to_id", referencedColumnName="id")
    **/
    protected $to;

   /**
     * @var int $unread
     *
     * @ORM\Column(name="unread", type="boolean")
     */
    protected $unread;

       /**
     * @var int $deleted
     *
     * @ORM\Column(name="deleted", type="boolean")
     */
    protected $deleted;


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
     * Set messages
    *
    * @param Messages $messages
    * @return Messages
    */
    public function setMessages(Messages $messages)
    {
        $this->messages = $messages;

        return $this;
    }

    /**
    *@return Messages
    **/
    public function getMessages()
    {
        return $this->messages;
    }

         /**
     * Set to
     *
     * @param \EduUser\Entity\User $to
     * @return \EduUser\Entity\User
     */
    public function setTo(\EduUser\Entity\User $to)
    {
        $this->to = $to;

        return $this;
    }

    /**
     * Get t0
     *
     * @return \EduUser\Entity\User
     */
    public function getTo()
    {
        return $this->to;
    }

    /**
     * @param int $unread
     */
    public function setUnread($unread)
    {
        $this->unread = $unread;
        return $this;
    }

       /**
     * @return int
     */
    public function getUnread()
    {
        return $this->unread;
    }
    
     /**
     * Set deleted
     *
     * @param int $deleted
     */
    public function setDeleted($deleted)
    {
        $this->deleted = $deleted;

        return $this;
    }

    /**
     * Get deleted
     *
     * @return int 
     */
    public function getDeleted()
    {
        return $this->deleted;
    }

}