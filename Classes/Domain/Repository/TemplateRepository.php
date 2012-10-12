<?php
namespace Laeuft\Tick\Domain\Repository;

/*                                                                        *
 * This script belongs to the FLOW3 package "Laeuft.Tick".                *
 *                                                                        *
 *                                                                        */

use TYPO3\FLOW3\Annotations as FLOW3;

/**
 * A repository for Templates
 *
 * @FLOW3\Scope("singleton")
 */
class TemplateRepository extends \TYPO3\FLOW3\Persistence\Repository {

	/**
	 * Selects one random template out of all templates
	 *
	 * @return \Laeuft\Tick\Domain\Model\Template
	 */
	public function findOneRandom() {
		$allTemplates = $this->findAll();
		$template = $allTemplates->offsetGet(
			rand(
				1,
				$allTemplates->count() - 1
			)
		);

		return $template;
	}

	/**
	* Returns all templates sorted by name descending
	*
	* @return $result
	*/
	public function findAllSortedName() {
		$query = $this->createQuery();
		$query->setOrderings(
			array(
				'name' => \TYPO3\FLOW3\Persistence\QueryInterface::ORDER_ASCENDING
			)
		);
		$result = $query->execute();

		return $result;
	}

}
?>