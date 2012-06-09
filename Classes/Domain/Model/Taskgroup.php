<?php
namespace Laeuft\Tick\Domain\Model;

/*                                                                        *
 * This script belongs to the FLOW3 package "Laeuft.Tick".                *
 *                                                                        *
 *                                                                        */

use TYPO3\FLOW3\Annotations as FLOW3;

/**
 * A Taskgroup
 *
 * @FLOW3\Scope("prototype")
 * @FLOW3\Entity
 */
class Taskgroup {

	/**
	 * The name
	 * @var string
	 */
	protected $name;


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

}
?>