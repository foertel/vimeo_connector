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
class Tx_VimeoConnector_Domain_Model_Video extends Tx_Extbase_DomainObject_AbstractEntity {

	/**
	 * @var string
	 */
	protected $title;

	/**
	 * @var string
	 */
	protected $description;

	/**
	 * @var int
	 */
	protected $identifier;

	/**
	 * @var int
	 */
	protected $duration;

	/**
	 * @var Tx_Extbase_Persistence_ObjectStorage<Tx_VimeoConnector_Domain_Model_Category>
	 */
	protected $categories;

	/**
	 * @var Tx_Extbase_Persistence_ObjectStorage<Tx_VimeoConnector_Domain_Model_Video>
	 */
	protected $related;

	/**
	 * @var DateTime
	 */
	protected $dateTaken;

	/**
	 * @var string
	 */
	protected $thumbnail;

	/**
	 * @var DateTime
	 */
	protected $imported;

	/**
	 * @var DateTime
	 */
	protected $uploaded;

	/**
	 * @var Tx_VimeoConnector_Domain_Model_Type
	 */
	protected $type;

	/**
	 * @param string $title
	 * @return Tx_VimeoConnector_Domain_Model_Video this
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
	 * @return Tx_VimeoConnector_Domain_Model_Video this
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
	 * @param int $identifier
	 * @return Tx_VimeoConnector_Domain_Model_Video this
	 */
	public function setIdentifier($identifier) {
		$this->identifier = $identifier;
		return $this;
	}

	/**
	 * @return int
	 */
	public function getIdentifier() {
		return $this->identifier;
	}

	/**
	 * @param int $duration
	 * @return Tx_VimeoConnector_Domain_Model_Video this
	 */
	public function setDuration($duration) {
		$this->duration = $duration;
		return $this;
	}

	/**
	 * @return int
	 */
	public function getDuration() {
		return $this->duration;
	}

	/**
	 * @param Tx_Extbase_Persistence_ObjectStorage<Tx_VimeoConnector_Domain_Model_Category> $categories
	 * @return Tx_VimeoConnector_Domain_Model_Video this
	 */
	public function setCategories(Tx_Extbase_Persistence_ObjectStorage $categories) {
		$this->categories = $categories;
		return $this;
	}

	/**
	 * @return Tx_Extbase_Persistence_ObjectStorage<Tx_VimeoConnector_Domain_Model_Category>
	 */
	public function getCategories() {
		return $this->categories;
	}

	/**
	 * @param Tx_Extbase_Persistence_ObjectStorage<Tx_VimeoConnector_Domain_Model_Video> $related
	 * @return Tx_VimeoConnector_Domain_Model_Video this
	 */
	public function setRelated(Tx_Extbase_Persistence_ObjectStorage $related) {
		$this->related = $related;
		return $this;
	}

	/**
	 * @return Tx_Extbase_Persistence_ObjectStorage<Tx_VimeoConnector_Domain_Model_Video>
	 */
	public function getRelated() {
		return $this->related;
	}

	/**
	 * @param DateTime $dateTaken
	 * @return Tx_VimeoConnector_Domain_Model_Video this
	 */
	public function setDateTaken($dateTaken) {
		$this->dateTaken = $dateTaken;
		return $this;
	}

	/**
	 * @return DateTime
	 */
	public function getDateTaken() {
		return $this->dateTaken;
	}

	/**
	 * @param string $thumbnail
	 * @return Tx_VimeoConnector_Domain_Model_Video this
	 */
	public function setThumbnail($thumbnail) {
		$this->thumbnail = $thumbnail;
		return $this;
	}

	/**
	 * @return string
	 */
	public function getThumbnail() {
		return $this->thumbnail;
	}

	/**
	 * @param DateTime $imported
	 * @return Tx_VimeoConnector_Domain_Model_Video this
	 */
	public function setImported($imported) {
		$this->imported = $imported;
		return $this;
	}

	/**
	 * @return DateTime
	 */
	public function getImported() {
		return $this->imported;
	}

	/**
	 * @param DateTime $uploaded
	 * @return Tx_VimeoConnector_Domain_Model_Video this
	 */
	public function setUploaded($uploaded) {
		$this->uploaded = $uploaded;
		return $this;
	}

	/**
	 * @return DateTime
	 */
	public function getUploaded() {
		return $this->uploaded;
	}

	/**
	 * @param Tx_VimeoConnector_Domain_Model_Type $type
	 * @return Tx_VimeoConnector_Domain_Model_Video this
	 */
	public function setType($type) {
		$this->type = $type;
		return $this;
	}

	/**
	 * @return Tx_VimeoConnector_Domain_Model_Type
	 */
	public function getType() {
		return $this->type;
	}
}
?>