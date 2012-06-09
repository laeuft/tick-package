<?php
namespace Laeuft\Tick\Domain\Model;

/*                                                                        *
 * This script belongs to the FLOW3 package "Laeuft.Tick".                *
 *                                                                        *
 *                                                                        */

use TYPO3\FLOW3\Annotations as FLOW3;

/**
 * A Checklist
 *
 * @FLOW3\Scope("prototype")
 * @FLOW3\Entity
 */
class Checklist {

	/**
	 * The name
	 * @var string
	 */
	protected $name;


	/**
	 * Get the Checklist's name
	 *
	 * @return string The Checklist's name
	 */
	public function getName() {
		return $this->name;
	}

	/**
	 * Sets this Checklist's name
	 *
	 * @param string $name The Checklist's name
	 * @return void
	 */
	public function setName($name) {
		$this->name = $name;
	}

}
?>