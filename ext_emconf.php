<?php

########################################################################
# Extension Manager/Repository config file for ext "vimeo_connector".
#
# Auto generated 18-09-2011 18:58
#
# Manual updates:
# Only the data in the array - everything else is removed by next
# writing. "version" and "dependencies" must not be touched!
########################################################################

$EM_CONF[$_EXTKEY] = array(
	'title' => 'Vimeo Connector',
	'description' => 'Importing your videos from Vimeo',
	'category' => 'plugin',
	'shy' => 0,
	'version' => '1.0.0',
	'dependencies' => 'extbase',
	'conflicts' => '',
	'priority' => '',
	'loadOrder' => '',
	'module' => '',
	'state' => 'stable',
	'uploadfolder' => 1,
	'createDirs' => '',
	'modify_tables' => '',
	'clearcacheonload' => 1,
	'lockType' => '',
	'author' => 'Felix Oertel',
	'author_email' => 'f@oer.tel',
	'author_company' => '',
	'CGLcompliance' => '',
	'CGLcompliance_note' => '',
	'constraints' => array(
		'depends' => array(
			'php' => '5.3.0-0.0.0',
			'typo3' => '4.5.0-4.5.99',
			'extbase' => '1.3.0-devel-1.4.0',
		),
		'conflicts' => array(
		),
		'suggests' => array(
		),
	),
	'_md5_values_when_last_written' => 'a:33:{s:16:"ext_autoload.php";s:4:"fb57";s:21:"ext_conf_template.txt";s:4:"8dcb";s:12:"ext_icon.gif";s:4:"7f47";s:17:"ext_localconf.php";s:4:"40f1";s:14:"ext_tables.php";s:4:"3b4c";s:14:"ext_tables.sql";s:4:"c9bc";s:41:"Classes/Controller/CategoryController.php";s:4:"925c";s:38:"Classes/Controller/VideoController.php";s:4:"0fdf";s:33:"Classes/Domain/Model/Category.php";s:4:"5f0f";s:29:"Classes/Domain/Model/Type.php";s:4:"0593";s:30:"Classes/Domain/Model/Video.php";s:4:"c2ce";s:48:"Classes/Domain/Repository/CategoryRepository.php";s:4:"4c7a";s:45:"Classes/Domain/Repository/VideoRepository.php";s:4:"1607";s:44:"Classes/Domain/Repository/YearRepository.php";s:4:"cc64";s:32:"Classes/SchedulerTask/Import.php";s:4:"1ab9";s:46:"Configuration/FlexForms/Flexform_TeaserBox.xml";s:4:"9158";s:30:"Configuration/TCA/Category.php";s:4:"a213";s:26:"Configuration/TCA/Type.php";s:4:"8137";s:27:"Configuration/TCA/Video.php";s:4:"cbe9";s:38:"Configuration/TypoScript/constants.txt";s:4:"8887";s:34:"Configuration/TypoScript/setup.txt";s:4:"b340";s:40:"Resources/Private/Language/locallang.xml";s:4:"87ac";s:46:"Resources/Private/Partials/ArchiveListing.html";s:4:"4a6c";s:43:"Resources/Private/Partials/Pagebrowser.html";s:4:"bde5";s:46:"Resources/Private/Partials/RelatedListing.html";s:4:"3b36";s:44:"Resources/Private/Partials/VideoListing.html";s:4:"0ff1";s:43:"Resources/Private/Partials/VimeoPlayer.html";s:4:"03dc";s:47:"Resources/Private/Templates/Category/Index.html";s:4:"b93e";s:46:"Resources/Private/Templates/Category/Show.html";s:4:"a55a";s:46:"Resources/Private/Templates/Video/Archive.html";s:4:"353a";s:43:"Resources/Private/Templates/Video/Show.html";s:4:"fd44";s:48:"Resources/Private/Templates/Video/TeaserBox.html";s:4:"b811";s:63:"Resources/Public/Icons/tx_vimeoconnector_domain_model_video.png";s:4:"7f47";}',
	'suggests' => array(
	),
);

?>