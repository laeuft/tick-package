<?php
namespace Laeuft\Tick\Controller;

/*                                                                        *
 * This script belongs to the FLOW3 package "Laeuft.Tick".                *
 *                                                                        *
 *                                                                        */

use TYPO3\FLOW3\Annotations as FLOW3;

use TYPO3\FLOW3\Mvc\Controller\ActionController;
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
	 * @FLOW3\Inject
	 * @var \Laeuft\Tick\Domain\Repository\TaskgroupRepository
	 */
	protected $taskgroupRepository;

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
	 * @param \Laeuft\Tick\Domain\Model\Taskgroup $taskgroup The taskgroup the task is related
	 * @return void
	 */
	public function showAction(Task $task, \Laeuft\Tick\Domain\Model\Taskgroup $taskgroup) {
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
	 * @param \Laeuft\Tick\Domain\Model\Taskgroup $taskgroup The taskgroup the task is related
	 * @param \Laeuft\Tick\Domain\Model\Template $template The template the taskgroup is related
	 * @return void
	 */
	public function createAction(Task $newTask, \Laeuft\Tick\Domain\Model\Taskgroup $taskgroup, \Laeuft\Tick\Domain\Model\Template $template) {
		// add the new task to the taskgrup
		$taskgroup->addTask($newTask);

		$newTask->setSortOrder($this->taskRepository->getNextSortOrder($taskgroup));
		// add the new task
		$this->taskRepository->add($newTask);
		$this->addFlashMessage('Created a new task.');
		// go back to the taskgroup show form
		$this->redirect('show', 'Taskgroup', 'Laeuft.Tick', array('template' => $template, 'taskgroup' => $taskgroup));
	}

	/**
	 * Shows a form for editing an existing task object
	 *
	 * @param \Laeuft\Tick\Domain\Model\Task $task The task to edit
	 * @param \Laeuft\Tick\Domain\Model\Taskgroup $taskgroup The taskgroup the task is related
	 * @param \Laeuft\Tick\Domain\Model\Template $template The template the taskgroup is related
	 * @return void
	 */
	public function editAction(Task $task, \Laeuft\Tick\Domain\Model\Taskgroup $taskgroup, \Laeuft\Tick\Domain\Model\Template $template) {
		$this->view->assign('task', $task);
		$this->view->assign('taskgroup', $taskgroup);
		$this->view->assign('template', $template);
	}

	/**
	 * Updates the given task object
	 *
	 * @param \Laeuft\Tick\Domain\Model\Task $task The task to update
	 * @param \Laeuft\Tick\Domain\Model\Taskgroup $taskgroup The taskgroup the task is related
	 * @param \Laeuft\Tick\Domain\Model\Template $template The template the taskgroup is related
	 * @return void
	 */
	public function updateAction(Task $task, \Laeuft\Tick\Domain\Model\Taskgroup $taskgroup, \Laeuft\Tick\Domain\Model\Template $template) {
		$this->taskRepository->update($task);
		$this->addFlashMessage('Updated the task.');
		$this->redirect('show', 'Taskgroup', 'Laeuft.Tick', array('template' => $template, 'taskgroup' => $taskgroup));
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

	/**
	* Shift the selected task and change the sort order of all affected tasks
	*
	* @param \Laeuft\Tick\Domain\Model\Task $taskToShift
	* @param \Laeuft\Tick\Domain\Model\Taskgroup $taskgroup The taskgroup the task is related
	* @param \Laeuft\Tick\Domain\Model\Template $template The template the taskgroup is related
	* @param integer $newValue
	*/
	public function shiftAction(Task $taskToShift, \Laeuft\Tick\Domain\Model\Taskgroup $taskgroup, \Laeuft\Tick\Domain\Model\Template $template, $newValue) {
		// get the task which is affected to be shifted
		$task = $this->taskRepository->findToShift($taskgroup, $taskToShift, $newValue);

		// add the new value to the searched task
		$task->current()->setSortOrder($task->current()->getSortOrder() + ($newValue * -1));
		$this->taskRepository->update($task->current());

		// add the new value to the selected task
		$taskToShift->setSortOrder($taskToShift->getSortOrder() + $newValue);
		$this->taskRepository->update($taskToShift);

		$this->redirect(
			'show',
			'Taskgroup',
			'Laeuft.Tick',
			array(
				'taskgroup' => $taskgroup,
				'template' => $template
			)
		);
	}

}

?>