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
 * @subpackage Model
 */
class Tx_VimeoConnector_Domain_Model_Category extends Tx_Extbase_DomainObject_AbstractEntity {

	/**
	 * @var string
	 */
	protected $title;

	/**
	 * @var string
	 */
	protected $description;

	/**
	 * @var Tx_Extbase_Persistence_ObjectStorage<Tx_VimeoConnector_Domain_Model_Video>
	 */
	protected $videos;

	/**
	 * @param string $title
	 * @return Tx_VimeoConnector_Domain_Model_Category this
	 */
	public function setTitle($title) {
		$this->title = $title;
		return $this;
	}

	/**
	 * @return string
	 */
	public function getTitle() {
		return $this->title;
	}

	/**
	 * @param string $description
	 * @return Tx_VimeoConnector_Domain_Model_Category this
	 */
	public function setDescription($description) {
		$this->description = $description;
		return $this;
	}

	/**
	 * @return string
	 */
	public function getDescription() {
		return $this->description;
	}

	/**
	 * @param Tx_Extbase_Persistence_ObjectStorage<Tx_VimeoConnector_Domain_Model_Video> $videos
	 * @return Tx_VimeoConnector_Domain_Model_Category this
	 */
	public function setVideos(Tx_Extbase_Persistence_ObjectStorage $videos) {
		$this->videos = $videos;
		return $this;
	}

	/**
	 * @return Tx_Extbase_Persistence_ObjectStorage<Tx_VimeoConnector_Domain_Model_Video>
	 */
	public function getVideos() {
		return $this->videos;
	}
}
?>