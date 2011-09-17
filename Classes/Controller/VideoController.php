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
 * @subpackage Controller
 */
class Tx_VimeoConnector_Controller_VideoController extends Tx_Extbase_MVC_Controller_ActionController {

	/**
	 * @var Tx_VimeoConnector_Domain_Repository_CategoryRepository
	 */
	protected $categoryRepository;

	/**
	 * @var Tx_VimeoConnector_Domain_Repository_YearRepository $partialHelper
	 */
	protected $yearRepository;

	/**
	 * @param Tx_VimeoConnector_Domain_Repository_CategoryRepository $categoryRepository
	 */
	public function injectCategoryRepository(Tx_VimeoConnector_Domain_Repository_CategoryRepository $categoryRepository) {
		$this->categoryRepository = $categoryRepository;
	}

	/**
	 * @param Tx_VimeoConnector_Domain_Repository_YearRepository $yearRepository
	 */
	public function injectYearRepository(Tx_VimeoConnector_Domain_Repository_YearRepository $yearRepository) {
		$this->yearRepository = $yearRepository;
	}

	/**
	 * @return void
	 */
	public function indexByCategoryAction() {
		if (empty($this->settings['category'])) {
			throw new Exception('There is no category configured to display videos from!', 1316104726);
		}

		$this->view->assign('category', $this->categoryRepository->findByUid(intval($this->settings['category'])));
		$this->view->assign('years', $this->yearRepository->findAll());
	}

	/**
	 * @return void
	 */
	public function showAction(Tx_VimeoConnector_Domain_Model_Video $video) {
		$this->view->assign('video', $video);
	}
}
?>
