<?php
namespace Laeuft\Tick\Domain\Model;

/*                                                                        *
 * This script belongs to the FLOW3 package "Laeuft.Tick".                *
 *                                                                        *
 *                                                                        */

use TYPO3\FLOW3\Annotations as FLOW3;
use Doctrine\ORM\Mapping as ORM;

/**
 * A Task
 *
 * @FLOW3\Entity
 */
class Task {

	/**
	 * The taskgroup
	 * @var \Laeuft\Tick\Domain\Model\Taskgroup
	 * @ORM\ManyToOne(inversedBy="tasks")
	 */
	protected $taskgroup;

	/**
	 * The name
	 * @var string
	 */
	protected $name;

	/**
	 * The description
	 * @var string
	 */
	protected $description;


	/**
	 * Get the Task's taskgroup
	 *
	 * @return \Laeuft\Tick\Domain\Model\Taskgroup The Task's taskgroup
	 */
	public function getTaskgroup() {
		return $this->taskgroup;
	}

	/**
	 * Sets this Task's taskgroup
	 *
	 * @param \Laeuft\Tick\Domain\Model\Taskgroup $taskgroup The Task's taskgroup
	 * @return void
	 */
	public function setTaskgroup($taskgroup) {
		$this->taskgroup = $taskgroup;
	}

	/**
	 * Get the Task's name
	 *
	 * @return string The Task's name
	 */
	public function getName() {
		return $this->name;
	}

	/**
	 * Sets this Task's name
	 *
	 * @param string $name The Task's name
	 * @return void
	 */
	public function setName($name) {
		$this->name = $name;
	}

	/**
	 * Get the Task's description
	 *
	 * @return string The Task's description
	 */
	public function getDescription() {
		return $this->description;
	}

	/**
	 * Sets this Task's description
	 *
	 * @param string $description The Task's description
	 * @return void
	 */
	public function setDescription($description) {
		$this->description = $description;
	}

}
?>