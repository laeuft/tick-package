<?php
namespace Laeuft\Tick\Controller;

/*                                                                        *
 * This script belongs to the FLOW3 package "Laeuft.Tick".                *
 *                                                                        *
 *                                                                        */

use TYPO3\FLOW3\Annotations as FLOW3;

use TYPO3\FLOW3\Mvc\Controller\ActionController;
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
	 * @FLOW3\Inject
	 * @var \Laeuft\Tick\Domain\Repository\TemplateRepository
	 */
	protected $templateRepository;

	/**
	 * Shows a list of taskgroups
	 *
	 * @return void
	 */
	public function indexAction() {
		$this->view->assign('taskgroups', $this->taskgroupRepository->findAll());
	}

	/**
	* Renders a list of all taskgroups
	*
	* @return void
	*/
	public function listAction() {
		if ($this->request->hasArgument('templateId')) {
			$taskgroups = $this->taskgroupRepository->findByTemplate(
				$this->request->getArgument('templateId')
			);
		} else {
			$taskgroups = $this->taskgroupRepository->findAll();
		}

		$this->view->assign('taskgroups', $taskgroups);
		$this->view->assign('template', $this->request->getArgument('templateId'));
	}

	/**
	 * Shows a single taskgroup object
	 *
	 * @param \Laeuft\Tick\Domain\Model\Taskgroup $taskgroup The taskgroup to show
	 * @param \Laeuft\Tick\Domain\Model\Template $template The template the taskgroup is related
	 * @return void
	 */
	public function showAction(Taskgroup $taskgroup, \Laeuft\Tick\Domain\Model\Template $template) {
		$this->view->assign('taskgroup', $taskgroup);
		$this->view->assign('template', $template);
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
	 * @return void
	 */
	public function createAction() {
		if ($this->request->hasArgument('name') && $this->request->hasArgument('templateId')) {
			$templateId = $this->request->getArgument('templateId');
			$taskgroupName = $this->request->getArgument('name');

			$template = $this->templateRepository->findByIdentifier($templateId);

			$taskgroup = new \Laeuft\Tick\Domain\Model\Taskgroup();
			$taskgroup->setName($taskgroupName);
			$taskgroup->setTemplate($template);
			$taskgroup->setSortOrder($this->taskgroupRepository->getNextSortOrder($template));

			$template->addTaskgroup($taskgroup);

			$this->taskgroupRepository->add($taskgroup);
			$this->templateRepository->update($template);
		}
	}

	/**
	 * Adds the given new taskgroup object to the taskgroup repository
	 *
	 * @param \Laeuft\Tick\Domain\Model\Taskgroup $newTaskgroup A new taskgroup to add
	 * @param \Laeuft\Tick\Domain\Model\Template $tmeplate The template the taskgroup is related
	 * @return void
	 */
	/*public function createAction(Taskgroup $newTaskgroup, \Laeuft\Tick\Domain\Model\Template $template) {
		// add the new taskgroup to the template
		$template->addTaskgroup($newTaskgroup);

		$newTaskgroup->setSortOrder($this->taskgroupRepository->getNextSortOrder($template));
		// add the new taskgroup
		$this->taskgroupRepository->add($newTaskgroup);
		$this->addFlashMessage('Created a new taskgroup.');
		// go back to the template show form
		$this->redirect('show', 'Template', 'Laeuft.Tick', array('template' => $template));
	}*/

	/**
	 * Shows a form for editing an existing taskgroup object
	 *
	 * @param \Laeuft\Tick\Domain\Model\Taskgroup $taskgroup The taskgroup to edit
	 * @param \Laeuft\Tick\Domain\Model\Template $template The template the taskgroup is related
	 * @return void
	 */
	public function editAction(Taskgroup $taskgroup, \Laeuft\Tick\Domain\Model\Template $template) {
		$this->view->assign('taskgroup', $taskgroup);
		$this->view->assign('template', $template);
	}

	/**
	 * Updates the given taskgroup object
	 *
	 * @param \Laeuft\Tick\Domain\Model\Taskgroup $taskgroup The taskgroup to update
	 * @param \Laeuft\Tick\Domain\Model\Template $template The template the taskgroup is related
	 * @return void
	 */
	public function updateAction(Taskgroup $taskgroup, \Laeuft\Tick\Domain\Model\Template $template) {
		$this->taskgroupRepository->update($taskgroup);
		$this->addFlashMessage('Updated the taskgroup.');
		$this->redirect('show', 'Template', 'Laeuft.Tick', array('template' => $template));
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

	/**
	* Shift the selected taskgroup and change the sort order of all affected taskgroups
	*
	* @return void
	*/
	public function shiftAction() {
		if ($this->request->hasArgument('templateId') &&
			$this->request->hasArgument('taskgroupId') &&
			$this->request->hasArgument('shiftDirection')
		) {
			$taskgroupId = $this->request->getArgument('taskgroupId');
			$templateId = $this->request->getArgument('templateId');
			$shiftDirection = $this->request->getArgument('shiftDirection');

			$template = $this->templateRepository->findByIdentifier($templateId);
			$taskgroupToShift = $this->taskgroupRepository->findByIdentifier($taskgroupId);

			// get the taskgroup which is affected to be shifted
			$taskgroup = $this->taskgroupRepository->findToShift($template, $taskgroupToShift, $shiftDirection);

			// add the new value to the searched taskgroup
			$taskgroup->current()->setSortOrder($taskgroup->current()->getSortOrder() + ($shiftDirection * -1));
			$this->taskgroupRepository->update($taskgroup->current());

			// add the new value to the selected taskgroup
			$taskgroupToShift->setSortOrder($taskgroupToShift->getSortOrder() + $shiftDirection);
			$this->taskgroupRepository->update($taskgroupToShift);
		}
	}

}

?>