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
 * Scheduler Task to import video metadata from Vimeo
 *
 * @package vimeo_connector
 * @subpackage SchedulerTask
 */
class Tx_VimeoConnector_SchedulerTask_Import extends tx_scheduler_Task {

	/**
	 * @var string
	 */
	protected $api;

	/**
	 * @var string
	 */
	protected $userAccount;

	/**
	 * vimeo consumer key
	 * @var string
	 */
	protected $consumerKey;

	/**
	 * vimeo consumer secret
	 * @var string
	 */
	protected $consumerSecret;

	/**
	 * @var int
	 */
	protected $storagePid;

	/**
	 * @var array
	 */
	protected $vimeoVideos = array();

	/**
	 * Function executed from the scheduler, to run the task
	 *
	 * @return void
	 */
	public function execute() {
		$this->resolveExtensionConfiguration();

			// get first page with videos
		$data = $this->processJson($this->getJsonFromPage());
		$this->processVideos($data->videos->video);

			/**
			 * Vimeo only delivers 50 videos per page. So if there are
			 * more pages to request, this will be handled here.
			 */
		if ($data->videos->total > 50) {
			for($page = 2; $page <= ceil($data->videos->total / 50); $page++) {
				$result = $this->processJson($this->getJsonFromPage($page));
				$this->processVideos($result->videos->video);
			}
		}

		$this->processDeletes();

		return TRUE;
	}

	/**
	 * @param string $json
	 * @return stdClass
	 */
	protected function processJson($json) {
		$data = json_decode($json);

		if (is_object($data->err) && !empty($data->err->expl)) {
			throw new Exception('API: ' . $data->err->expl, 1316116574);
		}

		return $data;
	}

	/**
	 * syncs videos with the current database
	 *
	 * @param array<stdClass> $videos
	 * @return void
	 */
	protected function processVideos($videos) {
		$tce = t3lib_div::makeInstance('t3lib_TCEmain');
		$databaseRecord = array();
		foreach ((array)$videos as $video) {
			$this->vimeoVideos[] = $video->id;
			$existingRecord = $GLOBALS['TYPO3_DB']->exec_SELECTgetRows(
				'uid, tstamp',
				'tx_vimeoconnector_domain_model_video',
				'identifier = ' . intval($video->id)
			);

				// update existing record with new data
			if (!empty($existingRecord[0]) && $existingRecord[0]['tstamp'] < $video->modified_date) {
				$thumbnailFileName = $this->processThumbnail($video);

				$databaseRecord['tx_vimeoconnector_domain_model_video'][intval($existingRecord['uid'])] = array(
					'title' => $video->title,
					'description' => $video->description,
					'thumbnail' => $thumbnailFileName,
					'duration' => $video->duration,
					'tstamp' => time(),
					'crdate' => strtotime($video->upload_date)
				);

				// insert new record
			} elseif (empty($existingRecord)) {
				$thumbnailFileName = $this->processThumbnail($video);

				$databaseRecord['tx_vimeoconnector_domain_model_video']['NEW' . rand()] = array(
					'identifier' => intval($video->id),
					'pid' => intval($this->storagePid),
					'tstamp' => time(),
					'crdate' => strtotime($video->upload_date),
					'title' => $video->title,
					'description' => $video->description,
					'thumbnail' => $thumbnailFileName,
					'duration' => $video->duration
				);
			}
		}

		if (!empty($databaseRecord)) {
			$tce->start($databaseRecord, array());
			$tce->process_datamap();
		}
	}

	/**
	 * @return void
	 */
	protected function processDeletes() {
		$deletedVideos = $GLOBALS['TYPO3_DB']->exec_SELECTgetRows(
			'uid',
			'tx_vimeoconnector_domain_model_video',
			'identifier NOT IN (' . implode(',', $this->vimeoVideos) . ')'
		);

		foreach ($deletedVideos as $deletedVideo) {
			$deleteRecords['tx_vimeoconnector_domain_model_video'][$deletedVideo['uid']]['delete'] = TRUE;
		}

		if (!empty($deleteRecords)) {
			$tce = t3lib_div::makeInstance('t3lib_TCEmain');
			$tce->start(array(), $deleteRecords);
			$tce->process_cmdmap();
		}
	}

	/**
	 * @param stdClass $video
	 * @return string filename
	 */
	protected function processThumbnail($video) {
		if (!empty($video->thumbnails->thumbnail)) {
			$thumbnail = end($video->thumbnails->thumbnail);

			$thumbnailData = t3lib_div::getURL($thumbnail->_content);
			$thumbnailPath = t3lib_div::getFileAbsFileName('uploads/tx_vimeoconnector');
			preg_match('/\/([^\/]+)$/', $thumbnail->_content, $thumbnailUrlArray);
			$thumbnailFileName = t3lib_div::makeInstance('t3lib_basicFileFunctions')
				->getUniqueName(end($thumbnailUrlArray), $thumbnailPath);
			$writingFileSucceeded = t3lib_div::writeFile($thumbnailFileName, $thumbnailData);
			return ($writingFileSucceeded ? basename($thumbnailFileName) : NULL);
		}
	}

	/**
	 * build the query parameters, signs it with a hash and returns the API result
	 *
	 * @param int $page
	 * @return string json got back from the api
	 */
	protected function getJsonFromPage($page = 1) {
		$parameters = 'format=json'
		. '&full_response=1'
		. '&method=vimeo.videos.getAll'
		. '&oauth_consumer_key=' . $this->consumerKey
		. '&oauth_nonce=' . rand()
		. '&oauth_signature_method=HMAC-SHA1'
		. '&oauth_timestamp=' . time()
		. '&page=' . intval($page)
		. '&per_page=50'
		. '&user_id=' . $this->userAccount;

		$signature = urlencode(base64_encode(hash_hmac(
			'SHA1',
			'GET&' . urlencode($this->api) . '&' . urlencode($parameters),
			$this->consumerSecret . '&',
			true
		)));

		return t3lib_div::getURL($this->api . '?' . $parameters . '&oauth_signature=' . $signature);
	}

	/**
	 * parses the ext_conf
	 * @return void
	 */
	protected function resolveExtensionConfiguration() {
		$extensionConfiguration = unserialize($GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf']['vimeo_connector']);

		if (!is_array($extensionConfiguration)) {
			throw new Exception('Please configure vimeo_connector in EM.', 1316162578);
		}

		$this->api = $extensionConfiguration['api'];
		$this->consumerKey = $extensionConfiguration['consumerKey'];
		$this->consumerSecret = $extensionConfiguration['consumerSecret'];
		$this->userAccount = $extensionConfiguration['userAccount'];
		$this->storagePid = intval($extensionConfiguration['storagePid']);
	}
}
?>