<?php
namespace HynageExampleApp;

use Hynage\Application\WebApplication,
    Hynage\Autoloader;

// Define path to Hynage's library
define('HYNAGE_PATH', realpath(__DIR__ . '/../../Source/Source'));

// Register class loader
require_once HYNAGE_PATH . '/Hynage/Autoloader/Composite.php';
require_once HYNAGE_PATH . '/Hynage/Autoloader/NamespaceToDirectory.php';
$autoloader = new Autoloader\Composite();
$autoloader->addAutoloader(new Autoloader\NamespaceToDirectory('Hynage', HYNAGE_PATH))
           ->register();

// Assemble path to config file
$config = realpath(__DIR__ . '/../Application/Config/Default.php');

// Start application
$app = new WebApplication($config);
$app->dispatch();