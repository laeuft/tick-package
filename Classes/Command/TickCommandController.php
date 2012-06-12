<?php
namespace Laeuft\Tick\Command;

/*                                                                        *
 * This script belongs to the FLOW3 package "Laeuft.Tick".                *
 *                                                                        *
 *                                                                        */

use TYPO3\FLOW3\Annotations as FLOW3;

/**
 * Setup command controller for the Laeuft.Tick package
 *
 * @FLOW3\Scope("singleton")
 */
class TickCommandController extends \TYPO3\FLOW3\MVC\Controller\CommandController {

	/**
	 * @var array some random words
	 */
	protected $randomWords = array(
		'Projekt',
		'Extension',
		'Mittagessen',
		'Website',
		'Onlineshop',
	);

	/**
	 * @var array some random funny words
	 */
	protected $randomFunnyWords = array(
		'Nutella',
		'SEO',
		'Foobar',
		'Powernap',
		'Lunchbreak',
		'Unicorn',
		'Over the sunny rainbow',
		'Superpower',
		'Hero Affairs',
		'Stuntshow',
		'Behind the scenes',
	);

	/**
	 * @var array some random verbs
	 */
	protected $randomVerbs = array(
		'anpassen',
		'abschliessen',
		'erstellen',
		'umsetzen'
	);


	/**
	 * @FLOW3\Inject
	 * @var \Laeuft\Tick\Domain\Repository\TemplateRepository
	 */
	protected $templateRepository;

	/**
	 * @FLOW3\Inject
	 * @var \Laeuft\Tick\Domain\Repository\TaskgroupRepository
	 */
	protected $taskgroupRepository;

	/**
	 * Initialize Command
	 *
	 * This will initialize a bunch of templates, and checklists. Just a random collection
	 * of dummy data that can be used to manually test the whole application.
	 *
	 * @return void
	 */
	public function initializeCommand() {
		$this->outputLine('Hello, I\'m James and I\'ll prepare some dummy data for you :-)');

		// create some templates
		for ($i = 0; $i < 8; $i++) {
			$template = new \Laeuft\Tick\Domain\Model\Template();
			$template->setName(
				$this->generateRandomTemplateName()
			);

			// add some task groups and tasks on them
			for ($j = 0; $j < rand(0,8); $j++) {
				$taskgroup = $this->createDummyTaskgroup(rand(4,10));
				$taskgroup->setName(
					$this->generateRandomTaskgroupName()
				);
				$this->taskgroupRepository->add($taskgroup);
				$template->addTaskgroup($taskgroup);
			}

			$this->templateRepository->add($template);
		}
	}

	/**
	 * Generates a dummy taskgroup containing a number of tasks with a random name
	 * @param integer the number of tasks to generate
	 * @return \Laeuft\Tick\Domain\Model\Taskgroup
	 */
	protected function createDummyTaskgroup($numberOfTasks) {
		$taskgroup = new \Laeuft\Tick\Domain\Model\Taskgroup();

		for ($i = 0; $i < $numberOfTasks; $i++) {
			$task = new \Laeuft\Tick\Domain\Model\Task();
			$task->setName(
				$this->generateRandomTaskName()
			);

			$taskgroup->addTask($task);
		}

		return $taskgroup;
	}

	/**
	 * Generates a random name for a template, consisting of a word and a verb
	 *
	 * @return string a random name
	 */
	protected function generateRandomTemplateName() {
		$name = $this->getRandomArrayEntry(
			$this->randomWords
		) . ' ' . $this->getRandomArrayEntry(
			$this->randomVerbs
		);

		return $name;
	}

	/**
	 * Generates a random name for a task, consisting of a word and a verb
	 *
	 * @return string a random name
	 */
	protected function generateRandomTaskName() {
		$name = $this->getRandomArrayEntry(
			$this->randomWords
		) . ' ' . $this->getRandomArrayEntry(
			$this->randomVerbs
		);

		return $name;
	}

	/**
	 * Generates a random name for a taskgroup
	 *
	 * @return string a random name
	 */
	protected function generateRandomTaskgroupName() {
		$name = $this->getRandomArrayEntry(
			$this->randomFunnyWords
		);

		return $name;
	}

	/**
	 * @param array $array
	 * @return mixed a random entry of the given array
	 */
	protected function getRandomArrayEntry(array $array) {
		$randomKey = array_rand($array);
		return $array[$randomKey];
	}

}

?>