<?php

if (!defined('TYPO3_MODE')) {
	die('Access denied.');
}

Tx_Extbase_Utility_Extension::registerPlugin($_EXTKEY, 'AllCategories', 'Vimeo - All Categories');
Tx_Extbase_Utility_Extension::registerPlugin($_EXTKEY, 'Category', 'Vimeo - Category');
Tx_Extbase_Utility_Extension::registerPlugin($_EXTKEY, 'Archive', 'Vimeo - Archive');
Tx_Extbase_Utility_Extension::registerPlugin($_EXTKEY, 'Play', 'Vimeo - Player');
Tx_Extbase_Utility_Extension::registerPlugin($_EXTKEY, 'TeaserBox', 'Vimeo - TeaserBox');

t3lib_extMgm::allowTableOnStandardPages('tx_vimeoconnector_domain_model_video');
$TCA['tx_vimeoconnector_domain_model_video'] = array(
	'ctrl' => array(
		'title'				=> 'LLL:EXT:vimeo_connector/Resources/Private/Language/locallang.xml:domain.model.video',
		'label' 			=> 'title',
		'tstamp' 			=> 'tstamp',
		'crdate' 			=> 'crdate',
		'dividers2tabs' 	=> TRUE,
		'delete' 			=> 'deleted',
		'default_sortby'	=> 'ORDER BY title',
		'enablecolumns' 	=> array(
			'disabled' => 'hidden',
			'starttime' => 'starttime',
			'endtime' => 'endtime',
		),
		'dynamicConfigFile' => t3lib_extMgm::extPath($_EXTKEY) . 'Configuration/TCA/Video.php',
		'iconfile' 			=> t3lib_extMgm::extRelPath($_EXTKEY) . 'Resources/Public/Icons/tx_vimeoconnector_domain_model_video.png'
	),
);

t3lib_extMgm::allowTableOnStandardPages('tx_vimeoconnector_domain_model_category');
$TCA['tx_vimeoconnector_domain_model_category'] = array(
	'ctrl' => array(
		'title'				=> 'LLL:EXT:vimeo_connector/Resources/Private/Language/locallang.xml:domain.model.category',
		'label' 			=> 'title',
		'tstamp' 			=> 'tstamp',
		'crdate' 			=> 'crdate',
		'dividers2tabs' 	=> TRUE,
		'delete' 			=> 'deleted',
		'default_sortby'	=> 'ORDER BY title',
		'enablecolumns' 	=> array(
			'disabled' => 'hidden',
			'starttime' => 'starttime',
			'endtime' => 'endtime',
		),
		'dynamicConfigFile' => t3lib_extMgm::extPath($_EXTKEY) . 'Configuration/TCA/Category.php',
		'iconfile' 			=> t3lib_extMgm::extRelPath($_EXTKEY) . 'Resources/Public/Icons/tx_vimeoconnector_domain_model_video.png'
	),
);

t3lib_extMgm::allowTableOnStandardPages('tx_vimeoconnector_domain_model_type');
$TCA['tx_vimeoconnector_domain_model_type'] = array(
	'ctrl' => array(
		'title'				=> 'LLL:EXT:vimeo_connector/Resources/Private/Language/locallang.xml:domain.model.type',
		'label' 			=> 'title',
		'tstamp' 			=> 'tstamp',
		'crdate' 			=> 'crdate',
		'dividers2tabs' 	=> TRUE,
		'delete' 			=> 'deleted',
		'default_sortby'	=> 'ORDER BY title',
		'enablecolumns' 	=> array(
			'disabled' => 'hidden',
			'starttime' => 'starttime',
			'endtime' => 'endtime',
		),
		'dynamicConfigFile' => t3lib_extMgm::extPath($_EXTKEY) . 'Configuration/TCA/Type.php',
		'iconfile' 			=> t3lib_extMgm::extRelPath($_EXTKEY) . 'Resources/Public/Icons/tx_vimeoconnector_domain_model_video.png'
	),
);

t3lib_extMgm::addStaticFile($_EXTKEY, 'Configuration/TypoScript', 'Vimeo Connector');

$extensionName = t3lib_div::underscoredToUpperCamelCase($_EXTKEY);

$pluginSignature = strtolower($extensionName) . '_allcategories';
$GLOBALS['TCA']['tt_content']['types']['list']['subtypes_excludelist'][$pluginSignature] = 'layout,select_key,recursive';
$pluginSignature = strtolower($extensionName) . '_category';
$GLOBALS['TCA']['tt_content']['types']['list']['subtypes_excludelist'][$pluginSignature] = 'layout,select_key,recursive';
$pluginSignature = strtolower($extensionName) . '_archive';
$GLOBALS['TCA']['tt_content']['types']['list']['subtypes_excludelist'][$pluginSignature] = 'layout,select_key,recursive';
$pluginSignature = strtolower($extensionName) . '_play';
$GLOBALS['TCA']['tt_content']['types']['list']['subtypes_excludelist'][$pluginSignature] = 'layout,select_key,recursive';
$pluginSignature = strtolower($extensionName) . '_teaserbox';
$GLOBALS['TCA']['tt_content']['types']['list']['subtypes_excludelist'][$pluginSignature] = 'layout,select_key,recursive';
$GLOBALS['TCA']['tt_content']['types']['list']['subtypes_addlist'][$pluginSignature] = 'pi_flexform';
t3lib_extMgm::addPiFlexFormValue($pluginSignature, 'FILE:EXT:' . $_EXTKEY . '/Configuration/FlexForms/Flexform_TeaserBox.xml');
?>