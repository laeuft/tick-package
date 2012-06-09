<?php
namespace Laeuft\Tick\Controller;

/*                                                                        *
 * This script belongs to the FLOW3 package "Laeuft.Tick".                *
 *                                                                        *
 *                                                                        */

use TYPO3\FLOW3\Annotations as FLOW3;

use TYPO3\FLOW3\MVC\Controller\ActionController;
use \Laeuft\Tick\Domain\Model\Task;

/**
 * Task controller for the Laeuft.Tick package 
 *
 * @FLOW3\Scope("singleton")
 */
class TaskController extends ActionController {

	/**
	 * @FLOW3\Inject
	 * @var \Laeuft\Tick\Domain\Repository\TaskRepository
	 */
	protected $taskRepository;

	/**
	 * Shows a list of tasks
	 *
	 * @return void
	 */
	public function indexAction() {
		$this->view->assign('tasks', $this->taskRepository->findAll());
	}

	/**
	 * Shows a single task object
	 *
	 * @param \Laeuft\Tick\Domain\Model\Task $task The task to show
	 * @return void
	 */
	public function showAction(Task $task) {
		$this->view->assign('task', $task);
	}

	/**
	 * Shows a form for creating a new task object
	 *
	 * @return void
	 */
	public function newAction() {
	}

	/**
	 * Adds the given new task object to the task repository
	 *
	 * @param \Laeuft\Tick\Domain\Model\Task $newTask A new task to add
	 * @return void
	 */
	public function createAction(Task $newTask) {
		$this->taskRepository->add($newTask);
		$this->addFlashMessage('Created a new task.');
		$this->redirect('index');
	}

	/**
	 * Shows a form for editing an existing task object
	 *
	 * @param \Laeuft\Tick\Domain\Model\Task $task The task to edit
	 * @return void
	 */
	public function editAction(Task $task) {
		$this->view->assign('task', $task);
	}

	/**
	 * Updates the given task object
	 *
	 * @param \Laeuft\Tick\Domain\Model\Task $task The task to update
	 * @return void
	 */
	public function updateAction(Task $task) {
		$this->taskRepository->update($task);
		$this->addFlashMessage('Updated the task.');
		$this->redirect('index');
	}

	/**
	 * Removes the given task object from the task repository
	 *
	 * @param \Laeuft\Tick\Domain\Model\Task $task The task to delete
	 * @return void
	 */
	public function deleteAction(Task $task) {
		$this->taskRepository->remove($task);
		$this->addFlashMessage('Deleted a task.');
		$this->redirect('index');
	}

}

?>