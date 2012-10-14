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
	* Renders a list of all tasks
	*
	* @return void
	*/
	public function listAction() {
		if ($this->request->hasArgument('taskgroupId')) {
			$tasks = $this->taskRepository->findByTaskgroup(
				$this->request->getArgument('taskgroupId')
			);
		} else {
			$tasks = $this->taskRepository->findAll();
		}

		$this->view->assign('tasks', $tasks);
		$this->view->assign('taskgroup', $this->request->getArgument('taskgroupId'));
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
	 * @return void
	 */
	public function createAction() {
		if ($this->request->hasArgument('name') &&
			$this->request->hasArgument('taskgroupId') &&
			$this->request->hasArgument('description')
		) {
			$taskgroupId = $this->request->getArgument('taskgroupId');
			$taskName = $this->request->getArgument('name');
			$description = $this->request->getArgument('description');

			$taskgroup = $this->taskgroupRepository->findByIdentifier($taskgroupId);

			$task = new \Laeuft\Tick\Domain\Model\Task();
			$task->setName($taskName);
			$task->setTaskgroup($taskgroup);
			$task->setDescription($description);
			$task->setSortOrder($this->taskRepository->getNextSortOrder($taskgroup));

			$taskgroup->addTask($task);

			$this->taskRepository->add($task);
			$this->taskgroupRepository->update($taskgroup);
		}
	}

	/**
	 * Shows a form for editing an existing task object
	 *
	 * @param \Laeuft\Tick\Domain\Model\Task $task The task to edit
	 * @param \Laeuft\Tick\Domain\Model\Taskgroup $taskgroup The tasks taskgroup
	 * @param \Laeuft\Tick\Domain\Model\Template $template The taskgrups template
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
	 * @param \Laeuft\Tick\Domain\Model\Taskgroup $taskgroup The tasks taskgroup
	 * @param \Laeuft\Tick\Domain\Model\Template $template The taskgroups template
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
	* @param \Laeuft\Tick\Domain\Model\Taskgroup $taskgroup The tasks taskgroup
	* @param \Laeuft\Tick\Domain\Model\Template $template The taskgruops template
	* @param integer $newValue
	*
	* @return void
	*/
	public function shiftAction() {
		if ($this->request->hasArgument('taskId') &&
			$this->request->hasArgument('taskgroupId') &&
			$this->request->hasArgument('shiftDirection')
		) {
			$taskId = $this->request->getArgument('taskId');
			$taskgroupId = $this->request->getArgument('taskgroupId');
			$shiftDirection = $this->request->getArgument('shiftDirection');

			$taskToShift = $this->taskRepository->findByIdentifier($taskId);
			$taskgroup = $this->taskgroupRepository->findByIdentifier($taskgroupId);

			// get the task which is affected to be shifted
			$task = $this->taskRepository->findToShift(
				$taskgroup,
				$taskToShift,
				$shiftDirection
			);

			// add the new value to the searched task
			$task->current()->setSortOrder(
				$task->current()->getSortOrder() + ($shiftDirection * -1)
			);
			$this->taskRepository->update($task->current());

			// add the new value to the selected task
			$taskToShift->setSortOrder($taskToShift->getSortOrder() + $shiftDirection);
			$this->taskRepository->update($taskToShift);
		}
	}

}

?>