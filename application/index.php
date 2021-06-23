<?php

// Constants
define('_ENGINE', TRUE);
define('DS', DIRECTORY_SEPARATOR);
define('PS', PATH_SEPARATOR);

// Define full application path, environment, and name
defined('APPLICATION_PATH') || define('APPLICATION_PATH', realpath(dirname(dirname(__FILE__)))); // путь с главной категории
defined('APPLICATION_PATH_CORE') || define('APPLICATION_PATH_CORE', realpath(dirname(__FILE__))); // это с application
// echo APPLICATION_PATH; /opt/web/sites/total/total
// Define application environment
// Определение текущего режима работы приложения
//defined('APPLICATION_ENV') || define('APPLICATION_ENV', (getenv('APPLICATION_ENV') ? getenv('APPLICATION_ENV') : 'development'));
defined('APPLICATION_ENV') || define('APPLICATION_ENV', (getenv('APPLICATION_ENV') ? getenv('APPLICATION_ENV') : 'production'));

defined('VENDOR_DIR') || define('VENDOR_DIR', dirname(dirname(__FILE__)) . '/vendor');

// Setup required include paths; optimized for Zend usage. Most other includes
// will use an absolute path
set_include_path(
	APPLICATION_PATH . DS . 'application' . DS . 'libraries' . PS .
	APPLICATION_PATH . DS . 'application' . DS . 'libraries' . DS . 'Zend' . PS .
	APPLICATION_PATH . DS . 'application' . DS . 'modules' . PS .
	APPLICATION_PATH . '/vendor/webtomsk/' .
	'.' // get_include_path()
);

require APPLICATION_PATH . '/vendor/autoload.php';
require_once APPLICATION_PATH . '/vendor/webtomsk/Engine/Loader.php';
require_once APPLICATION_PATH . '/vendor/webtomsk/Engine/Application.php';

$includePaths = array(dirname(dirname(__FILE__)) . '/vendor/zendframework/zendframework1/library');
array_push($includePaths, get_include_path());
set_include_path(join(PATH_SEPARATOR, $includePaths));

Engine_Loader::getInstance()
	// Libraries
	->register('Zend', APPLICATION_PATH . DS . 'application' . DS . 'libraries' . DS . 'Zend')
	->register('Zend', dirname(dirname(__FILE__)) . '/vendor/zendframework/zendframework1/library' . DS . 'Zend')
	->register('Engine', APPLICATION_PATH . '/vendor/webtomsk/Engine')
	->register('Module', APPLICATION_PATH . DS . 'application' . DS . 'modules');

Engine_Api::getInstance()->run();

// Create application, bootstrap, and run
$application = new Engine_Application(
	APPLICATION_ENV
);

if (APPLICATION_ENV !== 'development') {
	try {
		$application->bootstrap();
	} catch (Exception $e) {
		echo file_get_contents(dirname(__FILE__) . DS . 'offline.html');
		exit();
	}
} else {
	/* unset($_SESSION['name']);
	  session_destroy(); */
	$application->bootstrap();
}