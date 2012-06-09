<?php
namespace Laeuft\Tick\Domain\Model;

/*                                                                        *
 * This script belongs to the FLOW3 package "Laeuft.Tick".                *
 *                                                                        *
 *                                                                        */

use TYPO3\FLOW3\Annotations as FLOW3;

/**
 * A Task
 *
 * @FLOW3\Scope("prototype")
 * @FLOW3\Entity
 */
class Task {

	/**
	 * The name
	 * @var string
	 */
	protected $name;


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

}
?>