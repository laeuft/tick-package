<?php
namespace Laeuft\Tick\Domain\Model;

/*                                                                        *
 * This script belongs to the FLOW3 package "Laeuft.Tick".                *
 *                                                                        *
 *                                                                        */

use TYPO3\Flow\Annotations as Flow;
use Doctrine\ORM\Mapping as ORM;

/**
 * A Checklist
 *
 * @Flow\Entity
 */
class Checklist {

	/**
	 * The template
	 * @var \Laeuft\Tick\Domain\Model\Template
	 * @ORM\ManyToOne
	 */
	protected $template;

	/**
	 * The project id
	 * @var string
	 */
	protected $projectId;

	/**
	 * The owner
	 * @var \Laeuft\Tick\Domain\Model\User
	 * @ORM\ManyToOne(inversedBy="checklists")
	 */
	protected $owner;

	/**
	 * The ticks
	 * @var \Doctrine\Common\Collections\Collection<\Laeuft\Tick\Domain\Model\Tick>
	 * @ORM\OneToMany(mappedBy="checklist",cascade="persist")
	 */
	protected $ticks;

	/**
	 * The checklist status
	 * @var integer
	 */
	protected $checklistStatus;


	/**
	* Initiates a new tick to this checklist
	*
	*/
	public function __construct() {
		$this->ticks = new \Doctrine\Common\Collections\ArrayCollection();
	}

	/**
	 * Get the Checklist's template
	 *
	 * @return \Laeuft\Tick\Domain\Model\Template The Checklist's template
	 */
	public function getTemplate() {
		return $this->template;
	}

	/**
	 * Sets this Checklist's template
	 *
	 * @param \Laeuft\Tick\Domain\Model\Template $template The Checklist's template
	 * @return void
	 */
	public function setTemplate($template) {
		$this->template = $template;
	}

	/**
	 * Get the Checklist's project id
	 *
	 * @return string The Checklist's project id
	 */
	public function getProjectId() {
		return $this->projectId;
	}

	/**
	 * Sets this Checklist's project id
	 *
	 * @param string $projectId The Checklist's project id
	 * @return void
	 */
	public function setProjectId($projectId) {
		$this->projectId = $projectId;
	}

	/**
	 * Get the Checklist's owner
	 *
	 * @return \Laeuft\Tick\Domain\Model\User The Checklist's owner
	 */
	public function getOwner() {
		return $this->owner;
	}

	/**
	 * Sets this Checklist's owner
	 *
	 * @param \Laeuft\Tick\Domain\Model\User $owner The Checklist's owner
	 * @return void
	 */
	public function setOwner($owner) {
		$this->owner = $owner;
	}

	/**
	 * Get the Checklist's ticks
	 *
	 * @return \Laeuft\Tick\Domain\Model\Tick The Checklist's ticks
	 */
	public function getTicks() {
		return $this->ticks;
	}

	/**
	 * Sets this Checklist's ticks
	 *
	 * @param \Laeuft\Tick\Domain\Model\Tick $ticks The Checklist's ticks
	 * @return void
	 */
	public function setTicks($ticks) {
		$this->ticks = $ticks;
	}

	/**
	 * Adds a single tick to this checklist
	 *
	 * @param \Laeuft\Tick\Domain\Model\Tick a tick
	 * @return void
	 */
	public function addTick(\Laeuft\Tick\Domain\Model\Tick $tick) {
		$tick->setChecklist($this);
		$this->ticks->add($tick);
	}

	/**
	 * Get the Checklist's status
	 *
	 * @return integer The Checklist's status
	 */
	public function getChecklistStatus() {
		return $this->checklistStatus;
	}

	/**
	 * Sets this Checklist's status
	 *
	 * @param integer $checklistStatus The Checklist's status
	 * @return void
	 */
	public function setChecklistStatus($checklistStatus) {
		$this->checklistStatus = $checklistStatus;
	}

}
?>