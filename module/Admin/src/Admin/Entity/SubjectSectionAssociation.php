<?php
namespace Admin\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * SubjectSectionAssociation
 *
 * @ORM\Table()
 * @ORM\Entity
 */
// @ORM\Entity(repositoryClass="Admin\Entity\SubjectSectionAssociationRepository")
class SubjectSectionAssociation
{
	/**
	 * @var integer
	 *
	 * @ORM\Column(name="id", type="integer")
	 * @ORM\Id
	 * @ORM\GeneratedValue(strategy="AUTO")
	 */
	private $id;
	/**
	 **/

	/**
	 *
	 * @ORM\ManyToOne(targetEntity="Admin\Entity\Subject", inversedBy="subject_section_associations")
	 * @ORM\JoinColumn(name="subject_id", referencedColumnName="id")
	 *
	 */
	private $subject;

	/**
	 *
	 * @ORM\ManyToOne(targetEntity="Admin\Entity\Section", inversedBy="subject_section_associations")
	 * @ORM\JoinColumn(name="section_id", referencedColumnName="id")
	 */
	private $section;

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
	 * Set subject
	 *
	 * @param \Admin\Entity\Subject $subject
	 * @return SubjectSectionAssociation
	 */
	public function setSubject(\Admin\Entity\Subject $subject = null)
	{
		$this->subject = $subject;

		return $this;
	}

	/**
	 * Get subject
	 *
	 * @return \Admin\Entity\Subject
	 */
	public function getSubject()
	{
		return $this->subject;
	}

	/**
	 * Set section
	 *
	 * @param \Admin\Entity\Section $section
	 * @return SubjectSectionAssociation
	 */
	public function setSection(\Admin\Entity\Section $section = null)
	{
		$this->section = $section;

		return $this;
	}

	/**
	 * Get section
	 *
	 * @return \Admin\Entity\Section
	 */
	public function getSection()
	{
		return $this->section;
	}
}
