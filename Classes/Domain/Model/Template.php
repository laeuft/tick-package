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
	 */
	protected $taskgroups;


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

}
?>