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
 * Standard controller for the Laeuft.Tick package
 *
 * @FLOW3\Scope("singleton")
 */
class StandardController extends ActionController {

	/**
	 * @FLOW3\Inject
	 * @var \Laeuft\Tick\Domain\Repository\ChecklistRepository
	 */
	protected $checklistRepository;

	/**
	 * @FLOW3\Inject
	 * @var \Laeuft\Tick\Domain\Repository\TemplateRepository
	 */
	protected $templateRepository;


	/**
	 * Shows a list of templates, a list of open checklists
	 *
	 * @return void
	 */
	public function indexAction() {
		$this->view->assign('templates', $this->templateRepository->findAll());
		$this->view->assign('checklists', $this->checklistRepository->findAll());
	}


}

?>