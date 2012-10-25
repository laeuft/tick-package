<?php
namespace Laeuft\Tick\Controller;

/*                                                                        *
 * This script belongs to the FLOW3 package "Laeuft.Tick".                *
 *                                                                        *
 *                                                                        */

use TYPO3\Flow\Annotations as Flow;

use TYPO3\Flow\Mvc\Controller\ActionController;
use \Laeuft\Tick\Domain\Model\Template;

/**
 * Template controller for the Laeuft.Tick package
 *
 * @Flow\Scope("singleton")
 */
class TemplateController extends ActionController {

	/**
	 * @Flow\Inject
	 * @var \Laeuft\Tick\Domain\Repository\TemplateRepository
	 */
	protected $templateRepository;

	/**
	 * @Flow\Inject
	 * @var \Laeuft\Tick\Domain\Repository\TaskgroupRepository
	 */
	protected $taskgroupRepository;

	/**
	 * @Flow\Inject
	 * @var \Laeuft\Tick\Domain\Repository\TaskRepository
	 */
	protected $taskRepository;

	/**
	 * Shows a list of templates
	 *
	 * @return void
	 */
	public function indexAction() {
		$this->view->assign('templates', $this->templateRepository->findAll());
	}

	/**
	* Renders a list of all templates
	*
	* @return void
	*/
	public function listAction() {
		$templates = $this->templateRepository->findAll();
		$this->view->assign('templates', $templates);
	}

	/**
	 * Shows a single template object
	 *
	 * @param \Laeuft\Tick\Domain\Model\Template $template
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
	 * @return void
	 */
	public function createAction() {
		// Check if the template name is available as GET parameter
		if ($this->request->hasArgument('name')) {
			// Get the template name
			$name = $this->request->getArgument('name');

			if ($name != '') {
				// Create a new template object
				$template = new \Laeuft\Tick\Domain\Model\Template();

				// add the name to the template
				$template->setName($name);

				// add the template to the repository
				$this->templateRepository->add($template);

				return true;
			}
		}
		return false;
	}

	/**
	 * Shows a form for editing an existing template object
	 *
	 * @param \Laeuft\Tick\Domain\Model\Template $template
	 * @return void
	 */
	public function editAction(Template $template) {
		$this->view->assign('template', $template);
	}

	/**
	 * Updates the given template object
	 *
	 * @param \Laeuft\Tick\Domain\Model\Template $template
	 * @return void
	 */
	public function updateAction(Template $template) {
		$this->templateRepository->update($template);
		$this->addFlashMessage('Updated the template.');
		$this->redirect('index', 'Standard');
	}

	/**
	 * Removes the given template object from the template repository
	 *
	 * @param \Laeuft\Tick\Domain\Model\Template $template
	 * @return void
	 */
	public function deleteAction(Template $template) {
		$this->templateRepository->remove($template);
		$this->addFlashMessage('Deleted a template.');
		$this->redirect('index');
	}

}

?>