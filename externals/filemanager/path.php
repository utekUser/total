<?php
// Constants
define('_ENGINE', TRUE);
define('DS', DIRECTORY_SEPARATOR);
define('PS', PATH_SEPARATOR);

// Define full application path, environment, and name
defined('APPLICATION_PATH') || define('APPLICATION_PATH', realpath(dirname(dirname(dirname(__FILE__))))); // путь с главной категории
defined('APPLICATION_PATH_CORE') || define('APPLICATION_PATH_CORE', realpath(dirname(dirname(__FILE__)))); // это с application

// Define application environment
// Определение текущего режима работы приложения
defined('APPLICATION_ENV') || define('APPLICATION_ENV', (getenv('APPLICATION_ENV') ? getenv('APPLICATION_ENV') : 'development'));

// Setup required include paths; optimized for Zend usage. Most other includes
// will use an absolute path
/*set_include_path(
    APPLICATION_PATH . DS . 'application' . DS . 'libraries' . PS .
    APPLICATION_PATH . DS . 'application' . DS . 'libraries' . DS . 'Zend' . PS .
    APPLICATION_PATH . DS . 'application' . DS . 'modules' .  PS .
    '.' // get_include_path()
);

// Application
require_once APPLICATION_PATH . DS . 'application/libraries/Engine/Loader.php';
require_once APPLICATION_PATH . DS . 'application/libraries/Engine/Application.php';

Engine_Loader::getInstance()
// Libraries
->register('Zend',      APPLICATION_PATH . DS . 'application' . DS . 'libraries' . DS . 'Zend')
->register('Engine',    APPLICATION_PATH . DS . 'application' . DS . 'libraries' . DS . 'Engine')
->register('Module',    APPLICATION_PATH . DS . 'application' . DS . 'modules')
//->register('Module',    APPLICATION_PATH . DS . 'application' . DS . 'modules')
;*/
set_include_path(
APPLICATION_PATH . DS . 'application' . DS . 'libraries' . PS .
APPLICATION_PATH . DS . 'application' . DS . 'libraries' . DS . 'Zend' . PS .
APPLICATION_PATH . DS . 'application' . DS . 'modules' .  PS .
APPLICATION_PATH . '/vendor/webtomsk/' .
'.' // get_include_path()
); 
require APPLICATION_PATH .  '/vendor/autoload.php';
require_once APPLICATION_PATH . '/vendor/webtomsk/Engine/Loader.php';
require_once APPLICATION_PATH . '/vendor/webtomsk/Engine/Application.php';

Engine_Loader::getInstance()
    // Libraries
    ->register('Zend',      APPLICATION_PATH . DS . 'application' . DS . 'libraries' . DS . 'Zend')
    ->register('Engine', APPLICATION_PATH . '/vendor/webtomsk/Engine')
    ->register('Module',    APPLICATION_PATH . DS . 'application' . DS . 'modules')
;

Engine_Api::getInstance()->run();

    $auth = Zend_Auth::getInstance();
    $auth->setStorage(new Engine_Auth_Storage());
//    if ($_SESSION['SID']['_file_rw_perm_']!='allow') {
    if (!$auth->hasIdentity()) {
	    header("HTTP/1.0 403 Forbidden");
	    exit;
	} 
	header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
	header("Cache-Control: no-store, no-cache, must-revalidate");
	header("Cache-Control: post-check=0, pre-check=0", false);
	header("Pragma: no-cache");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Путь</title>
	<link href="css/myfmstyle.css" rel="stylesheet" type="text/css" />
</head>
<body>
<?php
  if (!ini_get("register_globals")) {
    //import_request_variables('GPC');
extract($_GET, EXTR_OVERWRITE && EXTR_PREFIX_ALL);
 extract($_POST, EXTR_OVERWRITE && EXTR_PREFIX_ALL);
  }
?>  
<div class="site-title">detroit.tomsk.ru</div>
<table border="0" width="100%">
	<tr>
		<td width="60%" valign="top">
			<form name="form">
				<input type="text" id="path" name="path" readonly="readonly" value="<?php if (isset($path) && $path!=NULL) echo $path; else echo '/';?>" />
			</form>
		</td>
		<td valign="top">
			<textarea id='log' rows='2' cols='100' readonly='readonly'></textarea>
		</td>
	</tr>
</table>
</body>
</html>