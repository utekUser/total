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
	<title>Дерево каталогов</title>
	<link href="css/myfmstyle.css" rel="stylesheet" type="text/css" />
	<script type="text/javascript">

		/* MYAJ */
		function callMYAJ(url, rdata, pageElement, callMessage, errorMessage)
		{
		  document.getElementById(pageElement).innerHTML = callMessage;
		  try
		  {
			req = new XMLHttpRequest(); /* e.g. Firefox */
		  }
		  catch(e)
		  {
			try
			{
				req = new ActiveXObject("Msxml2.XMLHTTP");  /* some versions IE */
			}
			catch(e)
			{
				try
				{
					req = new ActiveXObject("Microsoft.XMLHTTP");  /* some versions IE */
				}
				catch (E) { req = false; }
		  	}
	  	  }
		  req.onreadystatechange = function() { responseMYAJ(pageElement, errorMessage); };
/*		  if (rdata instanceof Object)
		  {
			req.open("POST",url,true);
			req.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
			req.send(urlencMYAJ(rdata));
		  }
		  else
		  {
*/			req.open("GET",url,true);
			req.send(null);
//		  }
		}

		function responseMYAJ(pageElement, errorMessage)
		{
		  var output = '';
		  if(req.readyState == 4)
		  {
			if(req.status == 200)
			{
				output = req.responseText;
				document.getElementById(pageElement).innerHTML = output;
			}
			else
			{
				document.getElementById(pageElement).innerHTML = errorMessage;
			}
		  }
		}


		function urlencMYAJ(edata)
		{
		  var query = [];
		  if (edata instanceof Object)
		  {
			for (var k in edata)
			{
				query.push(encodeURIComponent(k) + "=" + encodeURIComponent(edata[k]));
			}
			return query.join('&');
		  }
		  else
		  {
			return encodeURIComponent(edata);
		  }
		}
	
		function chdir(path)
		{
		  parent.path.location.href="path.php?path="+path;
		  parent.cont.location.href="cont.php?path="+path;
		}

		function openDir(path)
		{
		  if (document.getElementById('img'+path).getAttribute('open')=='false')
		  {
		    document.getElementById('img'+path).setAttribute('src', 'images/folder-.gif');
		    document.getElementById('img'+path).setAttribute('open', 'true');
		    
		    if (document.getElementById(path).innerHTML=="")
		    	callMYAJ("loadtree.php?p="+path, null, path, "", "Error!");
		    else
		    	document.getElementById(path).style.visibility = 'visible'; document.getElementById(path).style.display = 'block';
//		    document.getElementById(path).innerHTML="<table><tr><td>bla</td></tr></table>";
		  //  alert(document.getElementById(path).innerHTML);
		  }
		  else
		  {
		    document.getElementById('img'+path).setAttribute('src', 'images/folder+.gif');
		    document.getElementById('img'+path).setAttribute('open', 'false');
//		    document.getElementById(path).innerHTML="";
		    document.getElementById(path).style.visibility = 'hidden'; document.getElementById(path).style.display = 'none';
		  }
		  
		  return false;
		}
	</script>

</head>
<body>

<div class="cont-div">
	<div class="filem-wh-tl">
		<div class="filem-wh-tr">
			<div class="filem-wh-tm"></div>
		</div>
	</div>
	<div class="filem-wh-ml">
		<div class="filem-wh-mr">
			<div class="filem-wh-mm">
			
<?php
  include("conf.php");
  include("loadtree.php");
?>

			</div>
		</div>
	</div>
	<div class="filem-wh-bl">
		<div class="filem-wh-br">
			<div class="filem-wh-bm"></div>
		</div>
	</div>
</div>
</body>
</html>