<?php
namespace Laeuft\Tick\Domain\Model;

/*                                                                        *
 * This script belongs to the FLOW3 package "Laeuft.Tick".                *
 *                                                                        *
 *                                                                        */

use TYPO3\Flow\Annotations as Flow;
use Doctrine\ORM\Mapping as ORM;

/**
 * A Taskgroup
 *
 * @Flow\Entity
 */
class Taskgroup {

	/**
	 * The name
	 * @var string
	 */
	protected $name;

	/**
	 * The template
	 * @var \Laeuft\Tick\Domain\Model\Template
	 * @ORM\ManyToOne(inversedBy="taskgroups")
	 */
	protected $template;

	/**
	 * The tasks
	 * @var \Doctrine\Common\Collections\Collection<\Laeuft\Tick\Domain\Model\Task>
	 * @ORM\OneToMany(mappedBy="taskgroup",cascade="persist")
	 * @ORM\OrderBy({"sortOrder" = "ASC"})
	 */
	protected $tasks;

	/**
	 * The sort order
	 * @var integer
	 */
	protected $sortOrder;


	/**
	* Initiates a new task to this taskgroup
	*
	* @return void
	*/
	public function __construct() {
		$this->tasks = new \Doctrine\Common\Collections\ArrayCollection();
	}


	/**
	 * Get the Taskgroup's name
	 *
	 * @return string The Taskgroup's name
	 */
	public function getName() {
		return $this->name;
	}

	/**
	 * Sets this Taskgroup's name
	 *
	 * @param string $name The Taskgroup's name
	 * @return void
	 */
	public function setName($name) {
		$this->name = $name;
	}

	/**
	 * Get the Taskgroup's template
	 *
	 * @return \Laeuft\Tick\Domain\Model\Template The Taskgroup's template
	 */
	public function getTemplate() {
		return $this->template;
	}

	/**
	 * Sets this Taskgroup's template
	 *
	 * @param \Laeuft\Tick\Domain\Model\Template $template The Taskgroup's template
	 * @return void
	 */
	public function setTemplate($template) {
		$this->template = $template;
	}

	/**
	 * Get the Taskgroup's tasks
	 *
	 * @return \Laeuft\Tick\Domain\Model\Task The Taskgroup's tasks
	 */
	public function getTasks() {
		return $this->tasks;
	}

	/**
	 * Sets this Taskgroup's tasks
	 *
	 * @param \Laeuft\Tick\Domain\Model\Task $tasks The Taskgroup's tasks
	 * @return void
	 */
	public function setTasks($tasks) {
		$this->tasks = $tasks;
	}

	/**
	 * Adds an additional task to this taskgroup
	 *
	 * @param \Laeuft\Tick\Domain\Model\Task the task
	 * @return void
	 */
	public function addTask(\Laeuft\Tick\Domain\Model\Task $task) {
		$task->setTaskgroup($this);
		$this->tasks->add($task);
	}

	/**
	 * Get the Taskgroup's sortOrder
	 *
	 * @return integer The Taskgroup's sortOrder
	 */
	public function getSortOrder() {
		return $this->sortOrder;
	}

	/**
	 * Sets this Taskgroup's SortOrder
	 *
	 * @param integer $sortOrder The Taskgroup's sortOrder
	 * @return void
	 */
	public function setSortOrder($sortOrder) {
		$this->sortOrder = $sortOrder;
	}

}
?>