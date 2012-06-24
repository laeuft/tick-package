<?php
namespace Laeuft\Tick\Domain\Repository;

/*                                                                        *
 * This script belongs to the FLOW3 package "Laeuft.Tick".                *
 *                                                                        *
 *                                                                        */

use TYPO3\FLOW3\Annotations as FLOW3;

/**
 * A repository for Taskgroups
 *
 * @FLOW3\Scope("singleton")
 */
class TaskgroupRepository extends \TYPO3\FLOW3\Persistence\Repository {

	/**
	* Get the next sort order according to the taskgroups in the current template
	*
	* @param \Laeuft\Tick\Domain\Model\Template $template
	* @return mixed
	*/
	public function getNextSortOrder(\Laeuft\Tick\Domain\Model\Template $template) {
		// get all the taskgroups in the current template and sort them by sortOrder descending
		$query = $this->createQuery();
		$query->setOrderings(array('sortOrder' => \TYPO3\FLOW3\Persistence\QueryInterface::ORDER_DESCENDING));
		$query->matching($query->equals('template', $template));
		$result = $query->execute();

		// check if any results exist
		if($result->getFirst()) {
			// return the current highest sort order + 1
			return $result->getFirst()->getSortOrder() + 1;
		} else {
			// if no taskgroup exist return 1
			return 1;
		}
	}

	/**+
	* Return the taskgroup which will be shifted
	*
	* @param \Laeuft\Tick\Domain\Model\Template $template
	* @param \Laeuft\Tick\Domain\Model\Taskgroup $taskgroup
	* @param integer $shiftValue
	*
	* @return \TYPO3\FLOW3\Persistence\QueryResultInterface
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