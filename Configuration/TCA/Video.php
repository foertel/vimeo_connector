<?php

$TCA['tx_vimeoconnector_domain_model_video'] = array(
	'ctrl' => $TCA['tx_vimeoconnector_domain_model_video']['ctrl'],
	'columns' => array(
		'hidden' => array(
			'exclude' => 0,
			'label'   => 'LLL:EXT:vimeo_connector/Resources/Private/Language/locallang.xml:tca.fields.hidden',
			'config'  => array(
				'type' => 'check',
			)
		),
		'title' => array(
			'exclude' => 0,
			'label'   => 'LLL:EXT:vimeo_connector/Resources/Private/Language/locallang.xml:domain.model.video.title',
			'config'  => array(
				'type' => 'input',
				'eval' => 'required',
				'readOnly' => TRUE
			)
		),
		'description' => array(
			'exclude' => 0,
			'label'   => 'LLL:EXT:vimeo_connector/Resources/Private/Language/locallang.xml:domain.model.video.description',
			'config'  => array(
				'type' => 'text',
				'rows' => 20,
				'cols' => 80,
				'readOnly' => TRUE
			)
		),
		'identifier' => array(
			'exclude' => 0,
			'label'   => 'LLL:EXT:vimeo_connector/Resources/Private/Language/locallang.xml:domain.model.video.identifier',
			'config'  => array(
				'type' => 'input',
				'eval' => 'int',
				'readOnly' => TRUE
			)
		),
		'duration' => array(
			'exclude' => 0,
			'label'   => 'LLL:EXT:vimeo_connector/Resources/Private/Language/locallang.xml:domain.model.video.duration',
			'config'  => array(
				'type' => 'input',
				'eval' => 'int',
				'readOnly' => TRUE
			)
		),
		'date_taken' => array(
			'exclude' => 0,
			'label'   => 'LLL:EXT:vimeo_connector/Resources/Private/Language/locallang.xml:domain.model.video.datetaken',
			'config'  => array(
				'type' => 'input',
				'eval' => 'date',
				'size' => 4
			)
		),
		'tstamp' => array(
			'exclude' => 0,
			'label'   => 'LLL:EXT:vimeo_connector/Resources/Private/Language/locallang.xml:domain.model.video.imported',
			'config'  => array(
				'type' => 'input',
				'eval' => 'date',
				'size' => 8,
				'readOnly' => TRUE
			)
		),
		'crdate' => array(
			'exclude' => 0,
			'label'   => 'LLL:EXT:vimeo_connector/Resources/Private/Language/locallang.xml:domain.model.video.uploaded',
			'config'  => array(
				'type' => 'input',
				'eval' => 'date',
				'size' => 8,
				'readOnly' => TRUE
			)
		),
		'thumbnail' => array(
			'exclude' => 0,
			'label'   => 'LLL:EXT:vimeo_connector/Resources/Private/Language/locallang.xml:domain.model.video.thumbnail',
			'config'  => array(
				'type' => 'group',
				'internal_type' => 'file',
				'allowed' => 'gif,png,jpeg,jpg',
				'uploadfolder' => 'uploads/tx_vimeoconnector',
				'show_thumbs' => TRUE,
				'size' => 1,
				'maxitems' => 1,
				'readOnly' => TRUE,
				'disable_controls' => 'list,browser,upload'
			)
		),
		'categories' => array(
			'exclude' => 0,
			'label'   => 'LLL:EXT:vimeo_connector/Resources/Private/Language/locallang.xml:domain.model.video.categories',
			'config'  => array(
				'type' => 'select',
				'foreign_table' => 'tx_vimeoconnector_domain_model_category',
				'MM' => 'tx_vimeoconnector_mm_video_category',
				'size' => 10,
				'maxitems' => 99999
			)
		),
		'sys_language_uid'=> array(
			'exclude'=>1,
			'label' =>'LLL:EXT:lang/locallang_general.xml:LGL.language',
			'config' => array(
				'type' => 'select',
				'foreign_table' => 'sys_language',
				'foreign_table_where' => 'ORDER BY sys_language.title',
				'items'       => array(
					array('LLL:EXT:lang/locallang_general.php:LGL.allLanguages', -1),
					array('LLL:EXT:lang/locallang_general.php:LGL.default_value',0)
				)
			)
		),
		'l18n_parent'=> array(
			'displayCond'=>'FIELD:sys_language_uid:>:0',
			'exclude'  =>1,
			'label'   =>'LLL:EXT:lang/locallang_general.xml:LGL.l18n_parent',
			'config'      => array(
				'type'  =>'select',
				'items'=> array(
					array('',0),
				),
				'foreign_table' => 'tx_vimeoconnector_domain_model_video',
				'foreign_table_where' => 'AND tx_vimeoconnector_domain_model_video.uid=###CURRENT_PID###'
					. ' AND tx_vimeoconnector_domain_model_video.sys_language_uid IN (-1,0)'
			)
		),
		'l18n_diffsource'=> array(
			'config'=> array(
				'type'=>'passthrough'
			)
		),
	),
	'types' => array(
		'1' => array('showitem' => 'hidden, title, description, duration, categories, date_taken, crdate, tstamp, thumbnail, identifier')
	)
);
?>