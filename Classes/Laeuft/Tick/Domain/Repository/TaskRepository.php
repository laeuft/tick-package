<?php
namespace Laeuft\Tick\Domain\Repository;

/*                                                                        *
 * This script belongs to the FLOW3 package "Laeuft.Tick".                *
 *                                                                        *
 *                                                                        */

use TYPO3\Flow\Annotations as Flow;

/**
 * A repository for Tasks
 *
 * @Flow\Scope("singleton")
 */
class TaskRepository extends \TYPO3\Flow\Persistence\Repository {

	/**
	* Get the next sort order according to the tasks in the current taskgroup
	*
	* @param \Laeuft\Tick\Domain\Model\Template $template
	* @return integer
	*/
	public function getNextSortOrder(\Laeuft\Tick\Domain\Model\Taskgroup $taskgroup) {
		// get all the taskgroups in the current template and sort them by sortOrder descending
		$query = $this->createQuery();
		$query->setOrderings(array('sortOrder' => \TYPO3\Flow\Persistence\QueryInterface::ORDER_DESCENDING));
		$query->matching($query->equals('taskgroup', $taskgroup));
		$result = $query->execute();

		// check if any results exist
		if ($result->getFirst()) {
			// return the current highest sort order + 1
			return $result->getFirst()->getSortOrder() + 1;
		} else {
			// if no taskgroup exist return 1
			return 1;
		}
	}

	/**
	* Get all tasks of the given taskgroup ordered by the
	* sortOrder.
	*
	* @param \Laeuft\Tick\Domain\Model\Taskgrup $taskgroup
	*/
	public function findByTaskgroup($taskgroup) {
		$query = $this->createQuery();

		$query->setOrderings(
			array(
				'sortOrder' => \TYPO3\Flow\Persistence\QueryInterface::ORDER_ASCENDING
			)
		);
		$query->matching(
			$query->equals('taskgroup', $taskgroup)
		);
		$result = $query->execute();

		return $result;
	}

	/**
	* Return the task which will be shifted
	*
	* @param \Laeuft\Tick\Domain\Model\Task $task
	* @param \Laeuft\Tick\Domain\Model\Taskgroup $taskgroup
	* @param integer $shiftValue
	*
	* @return \TYPO3\Flow\Persistence\QueryResultInterface
	*/
	public function findToShift($taskgroup, $task, $shiftValue) {
		$query = $this->createQuery();
		$query->matching(
			$query->logicalAnd(
				array(
					$query->equals('taskgroup', $taskgroup),
					$query->equals('sortOrder', $task->getSortOrder() + $shiftValue)
				)
			)
		);

		return $query->execute();
	}

}
?>