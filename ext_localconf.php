<?php
if (!defined('TYPO3_MODE')) {
	die ('Access denied.');
}
// Add table garbage collection task
$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['scheduler']['tasks']['Webit\\RealurlClearcacheTask\\Task\\MultipleTablesGarbageCollectionTask'] = array(
		'extension' => $_EXTKEY,
		'title' => 'Multiple tables garbage collection clean RealUrlCache',
		'description' => 'Task to delete old entries from specific tables of RealUrl.',
		'additionalFields' => 'Webit\\RealurlClearcacheTask\\Task\\MultipleTablesGarbageCollectionAdditionalFieldProvider'
);

// Register realurl cache-tables in table garbage collection task
if (!is_array($GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['scheduler']['tasks']['TYPO3\\CMS\\Scheduler\\Task\\TableGarbageCollectionTask']['options']['tables']['tx_realurl_chashcache'])) {
	$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['scheduler']['tasks']['TYPO3\\CMS\\Scheduler\\Task\\TableGarbageCollectionTask']['options']['tables']['tx_realurl_chashcache'] = array(
			'dateField' => 'tstamp',
			'expirePeriod' => 180
	);
}
if (!is_array($GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['scheduler']['tasks']['TYPO3\\CMS\\Scheduler\\Task\\TableGarbageCollectionTask']['options']['tables']['tx_realurl_pathcache'])) {
	$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['scheduler']['tasks']['TYPO3\\CMS\\Scheduler\\Task\\TableGarbageCollectionTask']['options']['tables']['tx_realurl_pathcache'] = array(
			'dateField' => 'tstamp',
			'expirePeriod' => 180
	);
}
if (!is_array($GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['scheduler']['tasks']['TYPO3\\CMS\\Scheduler\\Task\\TableGarbageCollectionTask']['options']['tables']['tx_realurl_urldecodecache'])) {
	$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['scheduler']['tasks']['TYPO3\\CMS\\Scheduler\\Task\\TableGarbageCollectionTask']['options']['tables']['tx_realurl_urldecodecache'] = array(
			'dateField' => 'tstamp',
			'expirePeriod' => 180
	);
}
if (!is_array($GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['scheduler']['tasks']['TYPO3\\CMS\\Scheduler\\Task\\TableGarbageCollectionTask']['options']['tables']['tx_realurl_urlencodecache'])) {
	$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['scheduler']['tasks']['TYPO3\\CMS\\Scheduler\\Task\\TableGarbageCollectionTask']['options']['tables']['tx_realurl_urlencodecache'] = array(
			'dateField' => 'tstamp',
			'expirePeriod' => 180
	);
}
