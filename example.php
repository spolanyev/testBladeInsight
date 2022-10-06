<?php

declare(strict_types=1);

namespace TestBladeInsight;

ini_set('display_errors', '1');
ini_set('error_reporting', (string) E_ALL);
date_default_timezone_set('Europe/Lisbon');

$fullPathFileLog = __DIR__ . DIRECTORY_SEPARATOR . 'Logs' . DIRECTORY_SEPARATOR . 'log.txt';

ini_set('log_errors', '1');
ini_set('error_log', $fullPathFileLog);

require __DIR__ . DIRECTORY_SEPARATOR . 'UserInterface' . DIRECTORY_SEPARATOR . 'Startup' . DIRECTORY_SEPARATOR . 'autoload.php';
$application = new Application($fullPathFileLog);
$application->run();
