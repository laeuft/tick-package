<?php
namespace Laeuft\Tick\Controller;

/*                                                                        *
 * This script belongs to the FLOW3 package "Laeuft.Tick".                *
 *                                                                        *
 *                                                                        */

use TYPO3\FLOW3\Annotations as FLOW3;

use TYPO3\FLOW3\Mvc\Controller\ActionController;
use \Laeuft\Tick\Domain\Model\Tick;

/**
 * Tick controller for the Laeuft.Tick package
 *
 * @FLOW3\Scope("singleton")
 */
class TickController extends ActionController {

	/**
	 * @FLOW3\Inject
	 * @var \Laeuft\Tick\Domain\Repository\TickRepository
	 */
	protected $tickRepository;

	/**
	 * @FLOW3\Inject
	 * @var \Laeuft\Tick\Domain\Repository\ChecklistRepository
	 */
	protected $checklistRepository;

	/**
	 * @FLOW3\Inject
	 * @var \Laeuft\Tick\Domain\Repository\TaskRepository
	 */
	protected $taskRepository;

	/**
	 * Shows a list of ticks
	 *
	 * @return void
	 */
	public function indexAction() {
		$this->view->assign('ticks', $this->tickRepository->findAll());
	}

	/**
	 * Shows a single tick object
	 *
	 * @param \Laeuft\Tick\Domain\Model\Tick $tick The tick to show
	 * @return void
	 */
	public function showAction(Tick $tick) {
		$this->view->assign('tick', $tick);
	}

	/**
	 * Shows a form for creating a new tick object
	 *
	 * @return void
	 */
	public function newAction() {
	}

	/**
	 * Adds the given new tick object to the tick repository
	 *
	 * @param \Laeuft\Tick\Domain\Model\Task $task
	 * @param \Laeuft\Tick\Domain\Model\Checklist $checklist
	 *
	 * @return void
	 */
	public function createAction(\Laeuft\Tick\Domain\Model\Task $task, \Laeuft\Tick\Domain\Model\Checklist $checklist) {
		$newTick = new \Laeuft\Tick\Domain\Model\Tick();
		$newTick->setTask($task);
		$newTick->setChecklist($checklist);
		$checklist->addTick($newTick);
		$this->tickRepository->add($newTick);
		$this->addFlashMessage('Created a new tick.');
		$this->redirect('show', 'Checklist', 'Laeuft.Tick', array('checklist' => $checklist));
	}

	/**
	 * Shows a form for editing an existing tick object
	 *
	 * @param \Laeuft\Tick\Domain\Model\Tick $tick
	 * @return void
	 */
	public function editAction(Tick $tick) {
		$this->view->assign('tick', $tick);
	}

	/**
	 * Updates the given tick object
	 *
	 * @param \Laeuft\Tick\Domain\Model\Tick $tick
	 * @return void
	 */
	public function updateAction(Tick $tick) {
		$this->tickRepository->update($tick);
		$this->addFlashMessage('Updated the tick.');
		$this->redirect('index');
	}

	/**
	 * Removes the given tick object from the tick repository
	 *
	 * @param \Laeuft\Tick\Domain\Model\Tick $tick
	 * @param \Laeuft\Tick\Domain\Model\Checklist $checklist
	 * @return void
	 */
	public function deleteAction(Tick $tick, \Laeuft\Tick\Domain\Model\Checklist $checklist) {
		$this->tickRepository->remove($tick);
		$this->addFlashMessage('Deleted a tick.');
		$this->redirect('show', 'Checklist', 'Laeuft.Tick', array('checklist' => $checklist));
	}

}

?>