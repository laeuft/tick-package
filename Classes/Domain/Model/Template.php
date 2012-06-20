<?php
namespace Laeuft\Tick\Domain\Model;

/*                                                                        *
 * This script belongs to the FLOW3 package "Laeuft.Tick".                *
 *                                                                        *
 *                                                                        */

use TYPO3\FLOW3\Annotations as FLOW3;
use Doctrine\ORM\Mapping as ORM;

/**
 * A Template
 *
 * @FLOW3\Entity
 */
class Template {

	/**
	 * The name
	 * @var string
	 */
	protected $name;

	/**
	 * The taskgroups
	 * @var \Doctrine\Common\Collections\Collection<\Laeuft\Tick\Domain\Model\Taskgroup>
	 * @ORM\OneToMany(mappedBy="template",cascade="persist")
	 * @ORM\OrderBy({"sortOrder" = "ASC"})
	 */
	protected $taskgroups;

	/**
	 * The checklists
	 * @var \Doctrine\Common\Collections\Collection<\Laeuft\Tick\Domain\Model\Checklist>
	 * @ORM\OneToMany(mappedBy="template",cascade="persist")
	 */
	protected $checklists;


	public function __construct() {
		$this->taskgroups = new \Doctrine\Common\Collections\ArrayCollection();
	}


	/**
	 * Get the Template's name
	 *
	 * @return string The Template's name
	 */
	public function getName() {
		return $this->name;
	}

	/**
	 * Sets this Template's name
	 *
	 * @param string $name The Template's name
	 * @return void
	 */
	public function setName($name) {
		$this->name = $name;
	}

	/**
	 * Get the Template's taskgroups
	 *
	 * @return \Laeuft\Tick\Domain\Model\Taskgroup The Template's taskgroups
	 */
	public function getTaskgroups() {
		return $this->taskgroups;
	}

	/**
	 * Sets this Template's taskgroups
	 *
	 * @param \Laeuft\Tick\Domain\Model\Taskgroup $taskgroups The Template's taskgroups
	 * @return void
	 */
	public function setTaskgroups($taskgroups) {
		$this->taskgroups = $taskgroups;
	}

	/**
	 * Adds a taskgroup to this template
	 *
	 * @param $taskgroup
	 */
	public function addTaskgroup(\Laeuft\Tick\Domain\Model\Taskgroup $taskgroup) {
		$taskgroup->setTemplate($this);
		$this->taskgroups->add($taskgroup);
	}

	/**
	 * Get the Template's checklists
	 *
	 * @return \Laeuft\Tick\Domain\Model\Checklist The Template's checklists
	 */
	public function getChecklists() {
		return $this->checklists;
	}

	/**
	 * Sets this Template's checklists
	 *
	 * @param \Laeuft\Tick\Domain\Model\Checklist $checklists The Template's checklists
	 * @return void
	 */
	public function setChecklists($checklists) {
		$this->checklists = $checklists;
	}

	/**
	 * Adds a Checklist to this template
	 *
	 * @param $Checklist
	 */
	public function addChecklist(\Laeuft\Tick\Domain\Model\Checklist $checklist) {
		$checklist->setTemplate($this);
		$this->checklists->add($checklist);
	}

}
?>