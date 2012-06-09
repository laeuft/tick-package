<?php
namespace Laeuft\Tick\Controller;

/*                                                                        *
 * This script belongs to the FLOW3 package "Laeuft.Tick".                *
 *                                                                        *
 *                                                                        */

use TYPO3\FLOW3\Annotations as FLOW3;

use TYPO3\FLOW3\MVC\Controller\ActionController;
use \Laeuft\Tick\Domain\Model\Template;

/**
 * Template controller for the Laeuft.Tick package 
 *
 * @FLOW3\Scope("singleton")
 */
class TemplateController extends ActionController {

	/**
	 * @FLOW3\Inject
	 * @var \Laeuft\Tick\Domain\Repository\TemplateRepository
	 */
	protected $templateRepository;

	/**
	 * Shows a list of templates
	 *
	 * @return void
	 */
	public function indexAction() {
		$this->view->assign('templates', $this->templateRepository->findAll());
	}

	/**
	 * Shows a single template object
	 *
	 * @param \Laeuft\Tick\Domain\Model\Template $template The template to show
	 * @return void
	 */
	public function showAction(Template $template) {
		$this->view->assign('template', $template);
	}

	/**
	 * Shows a form for creating a new template object
	 *
	 * @return void
	 */
	public function newAction() {
	}

	/**
	 * Adds the given new template object to the template repository
	 *
	 * @param \Laeuft\Tick\Domain\Model\Template $newTemplate A new template to add
	 * @return void
	 */
	public function createAction(Template $newTemplate) {
		$this->templateRepository->add($newTemplate);
		$this->addFlashMessage('Created a new template.');
		$this->redirect('index');
	}

	/**
	 * Shows a form for editing an existing template object
	 *
	 * @param \Laeuft\Tick\Domain\Model\Template $template The template to edit
	 * @return void
	 */
	public function editAction(Template $template) {
		$this->view->assign('template', $template);
	}

	/**
	 * Updates the given template object
	 *
	 * @param \Laeuft\Tick\Domain\Model\Template $template The template to update
	 * @return void
	 */
	public function updateAction(Template $template) {
		$this->templateRepository->update($template);
		$this->addFlashMessage('Updated the template.');
		$this->redirect('index');
	}

	/**
	 * Removes the given template object from the template repository
	 *
	 * @param \Laeuft\Tick\Domain\Model\Template $template The template to delete
	 * @return void
	 */
	public function deleteAction(Template $template) {
		$this->templateRepository->remove($template);
		$this->addFlashMessage('Deleted a template.');
		$this->redirect('index');
	}

}

?>