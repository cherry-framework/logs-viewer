<?php

use Cherry\Log\LogViewer;

require_once __DIR__ . "/../vendor/autoload.php";

define('LOGS_PATH', __DIR__ . '/var/logs');

$viewer = new LogViewer();

$viewer->render();