<?php
namespace Laeuft\Tick\Domain\Model;

/*                                                                        *
 * This script belongs to the FLOW3 package "Laeuft.Tick".                *
 *                                                                        *
 *                                                                        */

use TYPO3\FLOW3\Annotations as FLOW3;
use Doctrine\ORM\Mapping as ORM;

/**
 * A Tick
 *
 * @FLOW3\Entity
 */
class Tick {

	/**
	 * The date
	 * @var \DateTime
	 */
	protected $date;

	/**
	 * The user
	 * @var \Laeuft\Tick\Domain\Model\User
	 * @ORM\ManyToOne
	 */
	protected $user;

	/**
	 * The checklist
	 * @var \Laeuft\Tick\Domain\Model\Checklist
	 * @ORM\ManyToOne
	 */
	protected $checklist;

	/**
	 * The task
	 * @var \Laeuft\Tick\Domain\Model\Task
	 * @ORM\ManyToOne
	 */
	protected $task;


	/**
	 * Get the Tick's date
	 *
	 * @return \DateTime The Tick's date
	 */
	public function getDate() {
		return $this->date;
	}

	/**
	 * Sets this Tick's date
	 *
	 * @param \DateTime $date The Tick's date
	 * @return void
	 */
	public function setDate($date) {
		$this->date = $date;
	}

	/**
	 * Get the Tick's user
	 *
	 * @return \Laeuft\Tick\Domain\Model\User The Tick's user
	 */
	public function getUser() {
		return $this->user;
	}

	/**
	 * Sets this Tick's user
	 *
	 * @param \Laeuft\Tick\Domain\Model\User $user The Tick's user
	 * @return void
	 */
	public function setUser($user) {
		$this->user = $user;
	}

	/**
	 * Get the Tick's checklist
	 *
	 * @return \Laeuft\Tick\Domain\Model\Checklist The Tick's checklist
	 */
	public function getChecklist() {
		return $this->checklist;
	}

	/**
	 * Sets this Tick's checklist
	 *
	 * @param \Laeuft\Tick\Domain\Model\Checklist $checklist The Tick's checklist
	 * @return void
	 */
	public function setChecklist($checklist) {
		$this->checklist = $checklist;
	}

	/**
	 * Get the Tick's task
	 *
	 * @return \Laeuft\Tick\Domain\Model\Task The Tick's task
	 */
	public function getTask() {
		return $this->task;
	}

	/**
	 * Sets this Tick's task
	 *
	 * @param \Laeuft\Tick\Domain\Model\Task $task The Tick's task
	 * @return void
	 */
	public function setTask($task) {
		$this->task = $task;
	}

}
?>