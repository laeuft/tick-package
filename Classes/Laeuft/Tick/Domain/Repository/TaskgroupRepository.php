<?php
namespace Laeuft\Tick\Domain\Repository;

/*                                                                        *
 * This script belongs to the FLOW3 package "Laeuft.Tick".                *
 *                                                                        *
 *                                                                        */

use TYPO3\Flow\Annotations as Flow;

/**
 * A repository for Taskgroups
 *
 * @Flow\Scope("singleton")
 */
class TaskgroupRepository extends \TYPO3\Flow\Persistence\Repository {

	/**
	* Get the next sort order according to the taskgroups in the current template
	*
	* @param \Laeuft\Tick\Domain\Model\Template $template
	* @return integer
	*/
	public function getNextSortOrder(\Laeuft\Tick\Domain\Model\Template $template) {
		// get all the taskgroups in the current template and sort them by sortOrder descending
		$query = $this->createQuery();
		$query->setOrderings(array('sortOrder' => \TYPO3\Flow\Persistence\QueryInterface::ORDER_DESCENDING));
		$query->matching($query->equals('template', $template));
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
	* Get all taskgroups of the given template ordered by the
	* sortOrder.
	*
	* @param $template
	*/
	public function findByTemplate($template) {
		$query = $this->createQuery();

		$query->setOrderings(
			array(
				'sortOrder' => \TYPO3\Flow\Persistence\QueryInterface::ORDER_ASCENDING
			)
		);
		$query->matching(
			$query->equals('template', $template)
		);
		$result = $query->execute();

		return $result;
	}

	/**
	* Return the taskgroup which will be shifted
	*
	* @param \Laeuft\Tick\Domain\Model\Template $template
	* @param \Laeuft\Tick\Domain\Model\Taskgroup $taskgroup
	* @param integer $shiftValue
	*
	* @return \TYPO3\Flow\Persistence\QueryResultInterface
	*/
	public function findToShift($template, $taskgroup, $shiftValue) {
		$query = $this->createQuery();
		$query->matching(
			$query->logicalAnd(
				array(
					$query->equals('template', $template),
					$query->equals('sortOrder', $taskgroup->getSortOrder() + $shiftValue)
				)
			)
		);

		return $query->execute();
	}

}
?>