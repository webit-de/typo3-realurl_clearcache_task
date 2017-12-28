<?php
namespace Webit\RealurlClearcacheTask\Task;

/**
 * This file is part of the TYPO3 CMS project.
 *
 * It is free software; you can redistribute it and/or modify it under
 * the terms of the GNU General Public License, either version 2
 * of the License, or any later version.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 * The TYPO3 project - inspiring people to share!
 */

/**
 * Remove old entries from tables.
 *
 * This task deletes rows from tables older than the given number of days.
 *
 * Available tables must be registered in
 * $GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['scheduler']['tasks']['TYPO3\\CMS\\Scheduler\\Task\\TableGarbageCollectionTask']['options']['tables']
 * See ext_localconf.php of scheduler extension for an example
 *
 * @author Marco Grahl <grahl@webit.de>
 */
class MultipleTablesGarbageCollectionTask extends \TYPO3\CMS\Scheduler\Task\TableGarbageCollectionTask {

	/**
	 * Multiple tables that should be cleaned up,
	 * set by additional field provider.
	 *
	 * @var array Selected tables to do garbage collection for
	 */
	public $multipleTables = array();

	/**
	 * Flag for Truncation of tables
	 * without consideration of timestamp
	 *
	 * @var bool Flag to set if tables should be truncate
	 */
	public $truncateTables = FALSE;

	/**
	 * Execute garbage collection, called by scheduler.
	 *
	 * @throws \RuntimeException If configured table was not cleaned up
	 * @return bool TRUE if task run was successful
	 */
	public function execute() {
		$tableConfigurations = $GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['scheduler']['tasks']['TYPO3\\CMS\\Scheduler\\Task\\TableGarbageCollectionTask']['options']['tables'];
		$tableHandled = FALSE;
		foreach ($tableConfigurations as $tableName => $configuration) {
			if ($this->allTables || in_array($tableName, $this->multipleTables)) {
				if ($this->truncateTables) {
					$GLOBALS['TYPO3_DB']->exec_TRUNCATEquery($tableName);
					$error = $GLOBALS['TYPO3_DB']->sql_error();
					if ($error) {
						throw new \RuntimeException('TYPO3\\CMS\\Scheduler\\Task\\TableGarbageCollectionTask failed for table ' . $this->table . ' with error: ' . $error, 1308255491);
					}
				} else {
					$this->handleTable($tableName, $configuration);
				}
				$tableHandled = TRUE;
			}
		}
		if (!$tableHandled) {
			throw new \RuntimeException('TYPO3\\CMS\\Scheduler\\Task\\TableGarbageCollectionTask misconfiguration: ' . $this->table . ' does not exist in configuration', 1308354399);
		}
		return TRUE;
	}

	/**
	 * This method returns the selected table as additional information
	 *
	 * @return string Information to display
	 */
	public function getAdditionalInformation() {
		if ($this->allTables) {
			$message = $GLOBALS['LANG']->sL('LLL:EXT:scheduler/mod1/locallang.xlf:label.tableGarbageCollection.additionalInformationAllTables');
		} else {
			$message = sprintf($GLOBALS['LANG']->sL('LLL:EXT:scheduler/mod1/locallang.xlf:label.tableGarbageCollection.additionalInformationTable'),
					implode(LF, $this->multipleTables));
		}
		return $message;
	}
}
