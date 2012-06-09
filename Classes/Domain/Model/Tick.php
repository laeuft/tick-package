<?php
namespace Laeuft\Tick\Domain\Model;

/*                                                                        *
 * This script belongs to the FLOW3 package "Laeuft.Tick".                *
 *                                                                        *
 *                                                                        */

use TYPO3\FLOW3\Annotations as FLOW3;

/**
 * A Tick
 *
 * @FLOW3\Scope("prototype")
 * @FLOW3\Entity
 */
class Tick {

	/**
	 * The name
	 * @var string
	 */
	protected $name;


	/**
	 * Get the Tick's name
	 *
	 * @return string The Tick's name
	 */
	public function getName() {
		return $this->name;
	}

	/**
	 * Sets this Tick's name
	 *
	 * @param string $name The Tick's name
	 * @return void
	 */
	public function setName($name) {
		$this->name = $name;
	}

}
?>