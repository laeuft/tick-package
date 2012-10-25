<?php
namespace Laeuft\Tick\Domain\Model;

/*                                                                        *
 * This script belongs to the FLOW3 package "Laeuft.Tick".                *
 *                                                                        *
 *                                                                        */

use TYPO3\Flow\Annotations as Flow;
use Doctrine\ORM\Mapping as ORM;

/**
 * A User
 *
 * @Flow\Entity
 */
class User {

	/**
	 * The name
	 * @var string
	 */
	protected $name;

	/**
	 * The checklists
	 * @var \Laeuft\Tick\Domain\Model\Checklist
	 * @ORM\OneToMany(mappedBy="checklist")
	 */
	protected $checklists;


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

	/**
	 * Get the User's checklists
	 *
	 * @return \Laeuft\Tick\Domain\Model\Checklist The User's checklists
	 */
	public function getChecklists() {
		return $this->checklists;
	}

	/**
	 * Sets this User's checklists
	 *
	 * @param \Laeuft\Tick\Domain\Model\Checklist $checklists The User's checklists
	 * @return void
	 */
	public function setChecklists($checklists) {
		$this->checklists = $checklists;
	}

}
?>