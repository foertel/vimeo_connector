<?php

/*
 * It is free software; you can redistribute it and/or modify it under    *
 * the terms of the GNU Lesser General Public License as published by the *
 * Free Software Foundation, either version 3 of the License, or (at your *
 * option) any later version.                                             *
 *                                                                        *
 * This script is distributed in the hope that it will be useful, but     *
 * WITHOUT ANY WARRANTY; without even the implied warranty of MERCHAN-    *
 * TABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU Lesser       *
 * General Public License for more details.                               *
 *                                                                        *
 * You should have received a copy of the GNU Lesser General Public       *
 * License along with the script.                                         *
 * If not, see http://www.gnu.org/licenses/lgpl.html                      *
 *                                                                        *
 * The TYPO3 project - inspiring people to share!                         *
 *                                                                        */

/**
 * finds url strings in a given text and links them
 * 
 * @license http://www.gnu.org/licenses/lgpl.html GNU Lesser General Public License, version 3 or later
 * @author Christian Zenker <christian.zenker@599media.de>
 */
class Tx_VimeoConnector_ViewHelpers_UrlifyViewHelper extends Tx_Fluid_Core_ViewHelper_AbstractViewHelper {

	/**
	 * finds url strings in a given text and links them
	 *
	 * @param string $string a string of plain text
	 * @return string the string with all plain text links linked with an <a>-tag
	 * @author Christian Zenker <christian.zenker@599media.de>
	 */
	public function render($string = null) {
		if(empty($string)) {
			$string = $this->renderChildren();
		}

		$string = preg_replace_callback('|https?://[^\s]*|ims', array($this, 'replaceUrl'), $string);

		return $string;
	}

	protected function replaceUrl($match) {
		$uri = $match[0];

		if(strpos($uri, '://') === false) {
			$uri = 'http://'.$uri;
		}
		$parts = parse_url($uri);
		$host = $parts['host'];
		
		return sprintf(
			'<a href="%s" target="_blank">%s</a>',
			$uri,
			$host
		);

	}

}
?>