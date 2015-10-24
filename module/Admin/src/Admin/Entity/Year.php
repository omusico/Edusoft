<?php
namespace Admin\Entity;
use Doctrine\ORM\Mapping as ORM;
/**
*@ORM\Table(name="year")
*@ORM\Entity
*/
class year
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
     * @ORM\Column(name="name", type="string", length=100, nullable=false)
     */
   protected $name;



    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }
    /**
     * Set id
     *@param int $id
     * @return year
     */
    public function setId($id)
    {
        $this->id=$id;
        return $this;
    }

    /**
     * Set sessionName
     *
     * @param string $name
     * @return year
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



/**
     * Convert the object to an array.
     *
     * @return array
     */
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