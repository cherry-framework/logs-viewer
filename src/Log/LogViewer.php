<?php

namespace Cherry\Log;

class LogViewer
{
    private $logsPath;

    public function __construct()
    {
        $this->logsPath = LOGS_PATH;

        $logFiles = $this->_getLogFiles();

        $allLogs = [];
        foreach ($logFiles as $logsFile) {
            $allLogs[] = $this->_readLogs($this->logsPath . '/' . $logsFile);
        }

        require_once __DIR__ . '/../view/logs.php';
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
        $logFiles = array_values($logFiles);

        return $logFiles;
    }

    private function _readLogs($logsFile)
    {
        $logs = [];

        $handle = fopen($logsFile,"r");

        while(!feof($handle))  {
            $line = fgets($handle);

            if ($line != '') {
                $dateTimeStart = strpos($line, '[');
                $dateTimeEnd = strpos($line, ']', $dateTimeStart);
                $levelEnd = strpos($line, ':', $dateTimeEnd);

                $logs[] = [
                    "dateTime" => substr($line, $dateTimeStart + 1, $dateTimeEnd - $dateTimeStart - 1),
                    "level" => substr($line, $dateTimeEnd + 3, $levelEnd - $dateTimeEnd - 3),
                    "message" => substr($line, $levelEnd + 2)
                ];
            }
        }

        fclose($handle);

        return $logs;
    }
}