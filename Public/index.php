<?php
namespace HynageExampleApp;
use Hynage\Application as Application;

// Define path to Hynage's library
define('HYNAGE_LIBRARY_PATH', realpath(__DIR__ . '/../../Source/Source'));

// Include Hynage by source
require HYNAGE_LIBRARY_PATH . '/Hynage/Application.php';

// Assemble path to config file
$config = realpath(__DIR__ . '/../Application/Config/Default.php');

// Start application
$app = Application::getInstance($config);
$app->dispatch();