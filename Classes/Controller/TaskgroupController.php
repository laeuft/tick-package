<?php
namespace Laeuft\Tick\Controller;

/*                                                                        *
 * This script belongs to the FLOW3 package "Laeuft.Tick".                *
 *                                                                        *
 *                                                                        */

use TYPO3\FLOW3\Annotations as FLOW3;

use TYPO3\FLOW3\MVC\Controller\ActionController;
use \Laeuft\Tick\Domain\Model\Taskgroup;

/**
 * Taskgroup controller for the Laeuft.Tick package 
 *
 * @FLOW3\Scope("singleton")
 */
class TaskgroupController extends ActionController {

	/**
	 * @FLOW3\Inject
	 * @var \Laeuft\Tick\Domain\Repository\TaskgroupRepository
	 */
	protected $taskgroupRepository;

	/**
	 * Shows a list of taskgroups
	 *
	 * @return void
	 */
	public function indexAction() {
		$this->view->assign('taskgroups', $this->taskgroupRepository->findAll());
	}

	/**
	 * Shows a single taskgroup object
	 *
	 * @param \Laeuft\Tick\Domain\Model\Taskgroup $taskgroup The taskgroup to show
	 * @return void
	 */
	public function showAction(Taskgroup $taskgroup) {
		$this->view->assign('taskgroup', $taskgroup);
	}

	/**
	 * Shows a form for creating a new taskgroup object
	 *
	 * @return void
	 */
	public function newAction() {
	}

	/**
	 * Adds the given new taskgroup object to the taskgroup repository
	 *
	 * @param \Laeuft\Tick\Domain\Model\Taskgroup $newTaskgroup A new taskgroup to add
	 * @return void
	 */
	public function createAction(Taskgroup $newTaskgroup) {
		$this->taskgroupRepository->add($newTaskgroup);
		$this->addFlashMessage('Created a new taskgroup.');
		$this->redirect('index');
	}

	/**
	 * Shows a form for editing an existing taskgroup object
	 *
	 * @param \Laeuft\Tick\Domain\Model\Taskgroup $taskgroup The taskgroup to edit
	 * @return void
	 */
	public function editAction(Taskgroup $taskgroup) {
		$this->view->assign('taskgroup', $taskgroup);
	}

	/**
	 * Updates the given taskgroup object
	 *
	 * @param \Laeuft\Tick\Domain\Model\Taskgroup $taskgroup The taskgroup to update
	 * @return void
	 */
	public function updateAction(Taskgroup $taskgroup) {
		$this->taskgroupRepository->update($taskgroup);
		$this->addFlashMessage('Updated the taskgroup.');
		$this->redirect('index');
	}

	/**
	 * Removes the given taskgroup object from the taskgroup repository
	 *
	 * @param \Laeuft\Tick\Domain\Model\Taskgroup $taskgroup The taskgroup to delete
	 * @return void
	 */
	public function deleteAction(Taskgroup $taskgroup) {
		$this->taskgroupRepository->remove($taskgroup);
		$this->addFlashMessage('Deleted a taskgroup.');
		$this->redirect('index');
	}

}

?>