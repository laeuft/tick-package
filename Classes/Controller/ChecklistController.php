<?php
namespace Laeuft\Tick\Controller;

/*                                                                        *
 * This script belongs to the FLOW3 package "Laeuft.Tick".                *
 *                                                                        *
 *                                                                        */

use TYPO3\FLOW3\Annotations as FLOW3;

use TYPO3\FLOW3\MVC\Controller\ActionController;
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
	 * Shows a list of checklists
	 *
	 * @return void
	 */
	public function indexAction() {
		$this->view->assign('checklists', $this->checklistRepository->findAll());
	}

	/**
	 * Shows a single checklist object
	 *
	 * @param \Laeuft\Tick\Domain\Model\Checklist $checklist The checklist to show
	 * @return void
	 */
	public function showAction(Checklist $checklist) {
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
	 * @param \Laeuft\Tick\Domain\Model\Checklist $newChecklist A new checklist to add
	 * @param \Laeuft\Tick\Domain\Model\Template $template The template the Checklist is related
	 * @return void
	 */
	public function createAction(Checklist $newChecklist) {
		$newChecklist->getTemplate()->addChecklist($newChecklist);
		$this->checklistRepository->add($newChecklist);
		$this->addFlashMessage('Created a new checklist.');
		$this->redirect('index', 'Standard');
	}

	/**
	 * Shows a form for editing an existing checklist object
	 *
	 * @param \Laeuft\Tick\Domain\Model\Checklist $checklist The checklist to edit
	 * @return void
	 */
	public function editAction(Checklist $checklist) {
		$this->view->assign('checklist', $checklist);
	}

	/**
	 * Updates the given checklist object
	 *
	 * @param \Laeuft\Tick\Domain\Model\Checklist $checklist The checklist to update
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
	 * @param \Laeuft\Tick\Domain\Model\Checklist $checklist The checklist to delete
	 * @return void
	 */
	public function deleteAction(Checklist $checklist) {
		$this->checklistRepository->remove($checklist);
		$this->addFlashMessage('Deleted a checklist.');
		$this->redirect('index');
	}

}

?>