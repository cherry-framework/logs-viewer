<?php
/**
 * The file contains LogViewer class
 *
 * PHP version 5
 *
 * @category Library
 * @package  Cherry
 * @author   Temuri Takalandze <takalandzet@gmail.com>
 * @license  https://github.com/cherry-framework/logs-viewer/blob/master/LICENSE MIT
 * @link     https://github.com/cherry-framework/logs-viewer
 */

namespace Cherry\Log;

/**
 * Cherry project Log Viewer class
 *
 * @category Library
 * @package  Cherry
 * @author   Temuri Takalandze <takalandzet@gmail.com>
 * @license  https://github.com/cherry-framework/logs-viewer/blob/master/LICENSE MIT
 * @link     https://github.com/cherry-framework/logs-viewer
 */
class LogViewer
{
    private $_logsPath;

    /**
     * LogViewer constructor.
     */
    public function __construct()
    {
        $this->_logsPath = LOGS_PATH;
    }

    /**
     * Render Logs Viewer view.
     *
     * @return void
     */
    public function render()
    {
        $logFiles = $this->_getLogFiles();

        $allLogs = [];
        foreach ($logFiles as $logsFile) {
            $allLogs[] = $this->_readLogs($this->_logsPath . '/' . $logsFile);
        }

        include_once __DIR__ . '/../view/logs.php';
    }

    /**
     * Get log files from _logsPath.
     *
     * @return array Logs filenames
     */
    private function _getLogFiles()
    {
        $logFiles = [];

        if ($handle = opendir($this->_logsPath)) {
            while (false !== ($entry = readdir($handle))) {
                if ($entry != "." && $entry != "..") {
                    $logFiles[] = $entry;
                }
            }

            closedir($handle);
        }

        //Sort and reindex array
        natsort($logFiles);
        $logFiles = array_values($logFiles);

        return $logFiles;
    }

    /**
     * Read logs from given file.
     *
     * @param string $logsFile Logs file
     *
     * @return array Logs from file
     */
    private function _readLogs($logsFile)
    {
        $logs = [];

        $handle = fopen($logsFile, "r");

        while (!feof($handle)) {
            $line = fgets($handle);

            if ($line != '') {
                $dateTimeStart = strpos($line, '[');
                $dateTimeEnd = strpos($line, ']', $dateTimeStart);
                $levelEnd = strpos($line, ':', $dateTimeEnd);

                $logs[] = [
                    "dateTime" => substr(
                        $line, $dateTimeStart + 1,
                        $dateTimeEnd - $dateTimeStart - 1
                    ),
                    "level" => substr(
                        $line, $dateTimeEnd + 3,
                        $levelEnd - $dateTimeEnd - 3
                    ),
                    "message" => substr($line, $levelEnd + 2)
                ];
            }
        }

        fclose($handle);

        return $logs;
    }
}