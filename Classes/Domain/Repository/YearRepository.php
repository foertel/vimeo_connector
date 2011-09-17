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
class Tx_VimeoConnector_Domain_Repository_YearRepository {

	/**
	 * @return array<array>
	 */
	public function findAll() {
		$sqlResult = $GLOBALS['TYPO3_DB']->sql_query(
			'SELECT FROM_UNIXTIME(date_taken, \'%Y\') as year, FROM_UNIXTIME(date_taken, \'%c\') as month, COUNT(*) as count'
			. ' FROM tx_vimeoconnector_domain_model_video'
			. ' GROUP BY YEAR(FROM_UNIXTIME(date_taken, \'%Y-%m-%d\')), MONTH(FROM_UNIXTIME(date_taken, \'%Y-%m-%d\'))'
			. ' ORDER BY year DESC, month'
		);

		while ($row = $GLOBALS['TYPO3_DB']->sql_fetch_assoc($sqlResult)) {
			$years[$row['year']][$row['month']] = $row['count'];
		}

		return $years;
	}
}
?>
