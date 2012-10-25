<?php
namespace Laeuft\Tick\Command;

/*                                                                        *
 * This script belongs to the FLOW3 package "Laeuft.Tick".                *
 *                                                                        *
 *                                                                        */

use TYPO3\Flow\Annotations as Flow;

/**
 * Setup command controller for the Laeuft.Tick package
 *
 * @Flow\Scope("singleton")
 */
class TickCommandController extends \TYPO3\Flow\Cli\CommandController {

	/**
	 * @var array some random words
	 */
	protected $randomWords = array(
		'Projekt',
		'Extension',
		'Mittagessen',
		'Website',
		'Onlineshop',
		'Haus',
		'Musik',
		'Fisch',
		'Hausputz',
		'Konzept',
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
		'umsetzen',
		'essen',
		'verbiegen',
		'machen',
		'erledigen',
		'reparieren',
		'zeichnen',
		'verstehen',
		'messen',
	);

	/**
	 * @var string some dummy text for descriptions
	 */
	protected $dummyText = 'Lorem ipsum dolor sit amet. Consectetuer adispiscint elit. Lorem ipsum dolor sit amet. Consectetuer adispiscint elit. Lorem ipsum dolor sit amet. Consectetuer adispiscint elit. Lorem ipsum dolor sit amet. Consectetuer adispiscint elit. Lorem ipsum dolor sit amet. Consectetuer adispiscint elit. Lorem ipsum dolor sit amet. Consectetuer adispiscint elit. Lorem ipsum dolor sit amet. Consectetuer adispiscint elit. Lorem ipsum dolor sit amet. Consectetuer adispiscint elit. Lorem ipsum dolor sit amet. Consectetuer adispiscint elit.';


	/**
	 * @Flow\Inject
	 * @var \Laeuft\Tick\Domain\Repository\TemplateRepository
	 */
	protected $templateRepository;

	/**
	 * @Flow\Inject
	 * @var \Laeuft\Tick\Domain\Repository\ChecklistRepository
	 */
	protected $checklistRepository;

	/**
	 * @Flow\Inject
	 * @var \TYPO3\Flow\Persistence\Doctrine\PersistenceManager
	 */
	protected $persistenceManager;

	/**
	 * Initialize Command
	 *
	 * This will initialize a bunch of templates, and checklists. Just a random collection
	 * of dummy data that can be used to manually test the whole application.
	 *
	 * @return void
	 */
	public function initializeCommand() {
		echo('Hello, I\'m James and I\'ll prepare some dummy data for you :-)' . PHP_EOL);

		// create some templates
		for ($i = 0; $i < rand(5, 10); $i++) {
			$template = new \Laeuft\Tick\Domain\Model\Template();
			$template->setName(
				$this->generateRandomTemplateName()
			);

			// add some task groups and tasks on them
			$numberOfTasks = 0;
			for ($j = 0; $j < rand(5, 14); $j++) {
				$taskgroup = $this->createDummyTaskgroup(rand(4, 10));
				$taskgroup->setName(
					$this->generateRandomTaskgroupName()
				);
				$template->addTaskgroup($taskgroup);
				$numberOfTasks += $j;
			}

			$this->templateRepository->add($template);
		}

		echo('Created ' . $i . ' templates with a total of ' . $numberOfTasks . ' tasks.' . PHP_EOL);
		echo('Now going to persist them...' . PHP_EOL);

		$this->persistenceManager->persistAll();


		echo('Next up: Creating some started checklists based on the new templates...' . PHP_EOL);
		// create some checklists
		$numberOfTicks = 0;
		for ($i = 0; $i < 10; $i++) {
			$checklist = $this->createDummyChecklist();
			$numberOfTicks += $checklist->getTicks()->count();

			$this->checklistRepository->add(
				$checklist
			);
		}
		echo('Created ' . $i . ' checklists with a total of ' . $numberOfTicks . ' ticks.' . PHP_EOL);

		echo('Now going to persist them...' . PHP_EOL);
		$this->persistenceManager->persistAll();

		echo('Wohoo, we\'re through. Thanks for all the fish!' . PHP_EOL);
	}

	/**
	 * Creates a dummy checklist
	 *
	 * @return \Laeuft\Tick\Domain\Model\Checklist
	 */
	protected function createDummyChecklist() {
		$checklist = new \Laeuft\Tick\Domain\Model\Checklist();

		$template = $this->templateRepository->findOneRandom();
		$checklist->setTemplate(
			$template
		);
		$checklist->setProjectId(
			$this->generateRandomProjectId()
		);
		// TODO: Add an owner!

		// pick some of the tasks and create a tick on them
		while ($checklist->getTemplate()->getTaskgroups()->current()) {
			$taskgroup = $checklist->getTemplate()->getTaskgroups()->current();
			while ($taskgroup->getTasks()->current()) {
				if (rand(0, 20) %6 == 0) {

					$task = $taskgroup->getTasks()->current();
					$tick = new \Laeuft\Tick\Domain\Model\Tick();
					$tick->setTask($task);
					$tick->setDate(new \DateTime());
					// TODO: Set the user!

					$checklist->addTick($tick);
				}

				$taskgroup->getTasks()->next();
			}

			$checklist->getTemplate()->getTaskgroups()->next();
		}

		return $checklist;
	}

	/**
	 * Generates a dummy taskgroup containing a number of tasks with a random name
	 * @param integer the number of tasks to generate
	 * @return \Laeuft\Tick\Domain\Model\Taskgroup
	 */
	protected function createDummyTaskgroup($numberOfTasks) {
		$taskgroup = new \Laeuft\Tick\Domain\Model\Taskgroup();

		for ($i = 0; $i < $numberOfTasks; $i++) {
			$taskgroup->addTask(
				$this->createDummyTask()
			);
		}

		return $taskgroup;
	}

	/**
	 * Creates a dummy task with name and by chance also a description
	 *
	 * @return \Laeuft\Tick\Domain\Model\Task a task
	 */
	protected function createDummyTask() {
		$task = new \Laeuft\Tick\Domain\Model\Task();
		$task->setName(
			$this->generateRandomTaskName()
		);

		// on a certain chance, add an (optional) description
		if (rand(0, 20) % 4) {
			$task->setDescription(
				$this->generateRandomDescription()
			);
		}

		return $task;
	}

	/**
	 * Returns parts of the dummy text, 30 to 255 characters max
	 *
	 * @return string some foobar text of random length
	 */
	protected function generateRandomDescription() {
		$description = substr($this->dummyText, 0, rand(30, 255));

		return $description;
	}

	/**
	 * Generates a random dummy project number in the format 1056-25-01
	 *
	 * @return string a face project id
	 */
	protected function generateRandomProjectId() {
		$id = rand(1111, 9999) . '-' . rand(20, 80) . '-0' . rand(1, 9);

		return $id;
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