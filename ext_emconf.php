<?php

$EM_CONF[$_EXTKEY] = array(
	'title' => 'RealUrl ClearCache Task',
	'description' => 'Add RealUrl-Cache-tables to an multiple table garbage collection task',
	'category' => 'misc',
	'shy' => 0,
	'version' => '2.0.0',
	'dependencies' => '',
	'conflicts' => '',
	'priority' => '',
	'loadOrder' => '',
	'module' => '',
	'state' => 'obsolete',
	'uploadfolder' => 0,
	'createDirs' => '',
	'modify_tables' => '',
	'clearCacheOnLoad' => 0,
	'lockType' => '',
	'author' => 'Marco Grahl',
	'author_email' => 'grahl@webit.de',
	'author_company' => '',
	'CGLcompliance' => '',
	'CGLcompliance_note' => '',
	'constraints' => array(
		'depends' => array(
			'typo3' => '6.2.0-6.2.99',
			'realurl' => ''
		),
		'conflicts' => array(
		),
		'suggests' => array(
		),
	),
);
