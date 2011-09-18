<?php
/***************************************************************
*  Copyright notice
*
*  (c) 2011 Felix Oertel <f@oer.tel>
*  All rights reserved
*
*  This script is part of the TYPO3 project. The TYPO3 project is
*  free software; you can redistribute it and/or modify
*  it under the terms of the GNU General Public License as published by
*  the Free Software Foundation; either version 2 of the License, or
*  (at your option) any later version.
*
*  The GNU General Public License can be found at
*  http://www.gnu.org/copyleft/gpl.html.
*
*  This script is distributed in the hope that it will be useful,
*  but WITHOUT ANY WARRANTY; without even the implied warranty of
*  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
*  GNU General Public License for more details.
*
*  This copyright notice MUST APPEAR in all copies of the script!
***************************************************************/
/**
 * @author Felix Oertel <f@oer.tel>
 * @package vimeo_connector
 * @subpackage Repository
 */
class Tx_VimeoConnector_Domain_Repository_VideoRepository extends Tx_Extbase_Persistence_Repository {

	/**
	 * @param int $year
	 * @param int $month
	 * @return array
	 */
	public function findByMonth($year, $month) {
		$query = $this->createQuery();

		$firstDay = strtotime(intval($year) . '-' . intval($month) . '-01 00:00:01');
		$lastDay = strtotime(intval($year) . '-' . intval($month) . '-' . date('t', $firstDay) . ' 23:59:59');

		$query->matching(
			$query->logicalAnd(
				$query->greaterThanOrEqual('dateTaken', $firstDay),
				$query->lessThanOrEqual('dateTaken', $lastDay)
			)
		);

		return $query->execute();
	}

	/**
	 * @param array<int> $types
	 * @return array
	 */
	public function findForTeaserBox($types, $showAll) {
		$videos = array();
		$selectedVideos = array();

		$types = t3lib_div::intExplode(',', $types);

		if ($showAll) {
			array_unshift($types, 0);
		}

		foreach ($types as $type) {
			$result = $this
				->createQuery()
				->statement(
					'SELECT video.*'
						. ' FROM tx_vimeoconnector_domain_model_video video,'
							. ' tx_vimeoconnector_domain_model_type type'
						. ($type > 0 ? ' WHERE video.type = ' . intval($type) : '')
						. (!empty($selectedVideos) ? ' AND video.uid NOT IN (' . implode(',', $selectedVideos) . ')' : '')
						. ' ORDER BY video.date_taken DESC'
						. ' LIMIT 1'
				)
				->execute();

			$video = $result->getFirst();
			if ($video instanceof Tx_VimeoConnector_Domain_Model_Video) {
					/**
					 * this fakes a type with title 'All Videos' to be used as tab in the teaserBox
					 *
					 * @todo make localizable
					 */
				if ($type === 0) {
					$video->setType(
						array('title' => 'All Videos')
					);
				}

				$videos[] = $video;
				$selectedVideos[] = $video->getUid();
			}
		}

		return $videos;
	}
}
?>
