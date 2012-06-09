<?php
namespace Laeuft\Tick\Domain\Model;

/*                                                                        *
 * This script belongs to the FLOW3 package "Laeuft.Tick".                *
 *                                                                        *
 *                                                                        */

use TYPO3\FLOW3\Annotations as FLOW3;

/**
 * A Template
 *
 * @FLOW3\Scope("prototype")
 * @FLOW3\Entity
 */
class Template {

	/**
	 * The name
	 * @var string
	 */
	protected $name;


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

}
?>