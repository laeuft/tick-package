<?php
namespace Laeuft\Tick\Domain\Model;

/*                                                                        *
 * This script belongs to the FLOW3 package "Laeuft.Tick".                *
 *                                                                        *
 *                                                                        */

use TYPO3\FLOW3\Annotations as FLOW3;

/**
 * A User
 *
 * @FLOW3\Scope("prototype")
 * @FLOW3\Entity
 */
class User {

	/**
	 * The name
	 * @var string
	 */
	protected $name;


	/**
	 * Get the User's name
	 *
	 * @return string The User's name
	 */
	public function getName() {
		return $this->name;
	}

	/**
	 * Sets this User's name
	 *
	 * @param string $name The User's name
	 * @return void
	 */
	public function setName($name) {
		$this->name = $name;
	}

}
?>