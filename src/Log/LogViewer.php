<?php

namespace Cherry\Log;

class LogViewer
{
    private $logsPath;
    private $logsFiles;

    public function __construct()
    {
        $this->logsPath = LOGS_PATH;

        $logFiles = $this->_getLogFiles();

        $this->logsFiles = $logFiles;

        $logs = $this->_readLogs($this->logsPath . '/' . $logFiles[0]);

        require_once __DIR__ . '/../templates/logs.php';
    }

    private function _getLogFiles()
    {
        $logFiles = [];

        if ($handle = opendir($this->logsPath)) {
            while (false !== ($entry = readdir($handle))) {
                if ($entry != "." && $entry != "..") {
                    $logFiles[] = $entry;
                }
            }

            closedir($handle);
        }

        natsort($logFiles);

        return $logFiles;
    }

    private function _readLogs(string $logsFile)
    {
        $logs = [];

        $handle = fopen($logsFile,"r");

        while(!feof($handle))  {
            $line = fgets($handle);

            if ($line != '') {

                $dateTimeStart = strpos($line, '[');
                $dateTimeEnd = strpos($line, ']', $dateTimeStart);
                $levelEnd = strpos($line, ':', $dateTimeEnd);

                $log = [
                    "dateTime" => substr($line, $dateTimeStart + 1, $dateTimeEnd - $dateTimeStart - 1),
                    "level" => substr($line, $dateTimeEnd + 3, $levelEnd - $dateTimeEnd - 3),
                    "message" => substr($line, $levelEnd + 2)
                ];
                $logs[] = $log;
            }
        }

        fclose($handle);

        return $logs;
    }
}