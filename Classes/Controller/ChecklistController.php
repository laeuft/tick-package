<?php
namespace Laeuft\Tick\Controller;

/*                                                                        *
 * This script belongs to the FLOW3 package "Laeuft.Tick".                *
 *                                                                        *
 *                                                                        */

use TYPO3\FLOW3\Annotations as FLOW3;

use TYPO3\FLOW3\Mvc\Controller\ActionController;
use \Laeuft\Tick\Domain\Model\Checklist;

/**
 * Checklist controller for the Laeuft.Tick package
 *
 * @FLOW3\Scope("singleton")
 */
class ChecklistController extends ActionController {

	/**
	 * @FLOW3\Inject
	 * @var \Laeuft\Tick\Domain\Repository\ChecklistRepository
	 */
	protected $checklistRepository;

	/**
	 * @FLOW3\Inject
	 * @var \Laeuft\Tick\Domain\Repository\TickRepository
	 */
	protected $tickRepository;

	/**
	 * @FLOW3\Inject
	 * @var \Laeuft\Tick\Domain\Repository\TemplateRepository
	 */
	protected $templateRepository;

	/**
	 * Shows a list of checklists
	 *
	 * @return void
	 */
	public function indexAction() {
		$this->view->assign('checklists', $this->checklistRepository->findAll());
	}

	/**
	* Renders a list of all checklists to a template
	*
	* @return void
	*/
	public function listAction() {
		$checklists = $this->checklistRepository->findAll();

		$this->view->assign('checklists', $checklists);
	}

	/**
	 * Shows a single checklist object
	 *
	 * @param \Laeuft\Tick\Domain\Model\Checklist $checklist
	 * @return void
	 */
	public function showAction(Checklist $checklist) {
		$arrTaskgroups = array();
		foreach ($checklist->getTemplate()->getTaskgroups() as $taskgroup) {
			$counter = 1;
			foreach ($taskgroup->getTasks() as $task) {
				$arrTaskgroups[$taskgroup->getName()][$counter]['task'] = $task;
				$arrTaskgroups[$taskgroup->getName()][$counter]['tick'] = $this->tickRepository->findOneByTask($task);
				$counter++;
			}
		}

		$this->view->assign('taskgroups', $arrTaskgroups);
		$this->view->assign('checklist', $checklist);
	}

	/**
	 * Shows a form for creating a new checklist object
	 *
	 * @return void
	 */
	public function newAction(\Laeuft\Tick\Domain\Model\Template $template) {
		$this->view->assign('template', $template);
	}

	/**
	 * Adds the given new checklist object to the checklist repository
	 *
	 * @return void
	 */
	public function createAction() {
		if ($this->request->hasArgument('projectId') && $this->request->hasArgument('template')) {
			$projectId = $this->request->getArgument('projectId');
			$templateId = $this->request->getArgument('template');

			$template = $this->templateRepository->findByIdentifier($templateId);

			$checklist = new \Laeuft\Tick\Domain\Model\Checklist();
			$checklist->setProjectId($projectId);
			$checklist->setTemplate($template);

			$template->addChecklist($checklist);

			$this->checklistRepository->add($checklist);
			$this->templateRepository->update($template);
		}
	}

	/**
	 * Shows a form for editing an existing checklist object
	 *
	 * @param \Laeuft\Tick\Domain\Model\Checklist $checklist
	 * @return void
	 */
	public function editAction(Checklist $checklist) {
		$this->view->assign('checklist', $checklist);
	}

	/**
	 * Updates the given checklist object
	 *
	 * @param \Laeuft\Tick\Domain\Model\Checklist $checklist
	 * @return void
	 */
	public function updateAction(Checklist $checklist) {
		$this->checklistRepository->update($checklist);
		$this->addFlashMessage('Updated the checklist.');
		$this->redirect('index');
	}

	/**
	 * Removes the given checklist object from the checklist repository
	 *
	 * @param \Laeuft\Tick\Domain\Model\Checklist $checklist
	 * @return void
	 */
	public function deleteAction(Checklist $checklist) {
		$this->checklistRepository->remove($checklist);
		$this->addFlashMessage('Deleted a checklist.');
		$this->redirect('index');
	}

}

?>