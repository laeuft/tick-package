<?php
namespace Laeuft\Tick\Controller;

/*                                                                        *
 * This script belongs to the FLOW3 package "Laeuft.Tick".                *
 *                                                                        *
 *                                                                        */

use TYPO3\Flow\Annotations as Flow;

use TYPO3\Flow\Mvc\Controller\ActionController;
use \Laeuft\Tick\Domain\Model\Checklist;

/**
 * Standard controller for the Laeuft.Tick package
 *
 * @Flow\Scope("singleton")
 */
class StandardController extends ActionController {

	/**
	 * @Flow\Inject
	 * @var \Laeuft\Tick\Domain\Repository\ChecklistRepository
	 */
	protected $checklistRepository;

	/**
	 * @Flow\Inject
	 * @var \Laeuft\Tick\Domain\Repository\TemplateRepository
	 */
	protected $templateRepository;


	/**
	 * Shows a list of templates, a list of open checklists
	 *
	 * @return void
	 */
	public function indexAction() {
		$this->view->assign('templates', $this->templateRepository->findAllSortedName());
		$this->view->assign('checklists', $this->checklistRepository->findAll());
	}


}

?>