<?php

$TCA['tx_vimeoconnector_domain_model_type'] = array(
	'ctrl' => $TCA['tx_vimeoconnector_domain_model_type']['ctrl'],
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
			'label'   => 'LLL:EXT:vimeo_connector/Resources/Private/Language/locallang.xml:domain.model.type.title',
			'config'  => array(
				'type' => 'input',
				'eval' => 'required',
			)
		),
		'videos' => array(
			'exclude' => 0,
			'label'   => 'LLL:EXT:vimeo_connector/Resources/Private/Language/locallang.xml:domain.model.typee.videos',
			'config'  => array(
				'type' => 'select',
				'foreign_table' => 'tx_vimeoconnector_domain_model_video',
				'foreign_field' => 'type',
				'size' => 10,
				'maxitems' => 99999,
				'readOnly' => TRUE,
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
				'foreign_table' => 'tx_vimeoconnector_domain_model_category',
				'foreign_table_where' => 'AND tx_vimeoconnector_domain_model_category.uid=###CURRENT_PID###'
					. ' AND tx_vimeoconnector_domain_model_category.sys_language_uid IN (-1,0)'
			)
		),
		'l18n_diffsource'=> array(
			'config'=> array(
				'type'=>'passthrough'
			)
		),
	),
	'types' => array(
		'1' => array('showitem' => 'hidden, title, videos')
	)
);
?>