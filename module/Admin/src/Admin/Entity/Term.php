<?php
namespace Admin\Entity;
use Doctrine\ORM\Mapping as ORM;
/**
*@ORM\Table(name="term")
*@ORM\Entity
*/
class term
{
	/**
		*@ORM\Column(name="id", type="integer", nullable=false)
		*@ORM\Id
		*@ORM\GeneratedValue(strategy="IDENTITY")
		*/
	protected $id;

	/**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=100, nullable=false)
     */
    protected $name;

    

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
     * Set termName
     *
     * @param string $name
     * @return term
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get sessionName
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

       public function getArrayCopy() 
    {
        return get_object_vars($this);
    }

    public function exchangeArray ($data = array()) 
    {
        //$this->id = $data['id'];
        $this->name = $data['name'];
      
     }
}