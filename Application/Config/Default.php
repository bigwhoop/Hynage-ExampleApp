<?php
namespace HynageExampleApp\Config;
use Hynage\Filter,
    Hynage\Autoloader;

$capWordsFilter = new Filter\String\CapWords();

$config = array();

// PHP settings
$config['phpSettings'] = array(
    'error_reporting' => E_ALL,
    'display_errors'  => true,
    'log_errors'      => false,
);

// Include paths
$config['includePaths'] = array(
    realpath(__DIR__ . '/../..'), // Project root
    realpath(__DIR__ . '/..'),    // Application directory
);

// Autoloaders
$config['autoloaders'] = array(
    // new Autoloader\Callback('HynageExampleApp', function($class) {
    //     $path = str_replace('\\', DIRECTORY_SEPARATOR, $class);
    //     $path = $path . '.php';
    //     require_once $path;
    // }),
);

// Database configuration
$config['database'] = array(
    'uri' => 'mysql://usr@localhost:3306/hynage',
    
    // $em->findEntity('User', ...) leads to entity type 'App\Models\User'
    'entityNameFormatter' => function($name) {
        return 'App\\Models\\' . $name;
    },
    
    // $em->getRepository('User') leads to entity type 'App\Models\Repositories\UserRepository'
    'repositoryNameFormatter' => function($name) {
        return 'App\\Models\\Repositories\\' . $name . 'Repository';
    },
);

// Session
$config['session'] = array(
    'lifetime' => 60 * 30, // 30min
);

// Front controller
$config['frontController'] = array(
    'formatters' => array(
        // Rewrites 'about-us' to '\HynageExampleApp\Controllers\AboutUsController'
        'controllerName' => function($class) use ($capWordsFilter) {
            return '\\HynageExampleApp\\Controllers\\' . $capWordsFilter->filter($class) . 'Controller';
        },
        
        // Rewrites 'about-us' to '<PROJECT>/Application/Controllers/AboutUs.php'
        'controllerPath' => function($class) use ($capWordsFilter) {
            return (__DIR__ . '/../Controllers/' . $capWordsFilter->filter($class) . '.php');
        },
        
        // 'requestPath' is a callable that takes an URI path and returns and URI path
        'requestPath' => require __DIR__ . '/Routes.php',
        
        // Rewrites 'about-us' to 'aboutUsAction'
        'actionName'  => array(new Filter\MVC\DefaultActionName(), 'filter'),
    ),
    'defaults'  => array(
        'controller' => 'index',
        'action'     => 'index',
    ),
    'errors'  => array(
        'controller' => 'errors',
        'action'     => 'error',
    ),
);

// Views
$config['view'] = array(
    'basePath' => realpath(__DIR__ . '/../Views'),
);

// Layouts
$config['layout'] = array(
    'basePath' => realpath(__DIR__ . '/../Layouts'),
    'layout'   => 'Website.phtml',
    'params'   => array(),
);

// Security
$config['security'] = array(
    'secretkey' => 'supersecretkey',
);

return $config;