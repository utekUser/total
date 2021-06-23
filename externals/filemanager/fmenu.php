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
; */
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
	<TITLE>Содержимое каталога</TITLE>
	<link href="css/myfmstyle.css" rel="stylesheet" type="text/css" />
	<script language="javascript">
	    function selected()
	    {
	        var string='';
		tbody=parent.cont.document.getElementsByTagName('tbody').item(0);
		for (var i=0; (node=tbody.getElementsByTagName("tr").item(i)); i++)
		{
		  if (node.getElementsByTagName("td").item(0).getElementsByTagName('input').item(0)!=null && node.getElementsByTagName("td").item(0).getElementsByTagName('input').item(0).checked)
		  {
		    string+=node.getElementsByTagName("td").item(2).getElementsByTagName("a").item(0).childNodes.item(0).nodeValue+';';
		  }
		}
		return string;
	    }
	    
	    function addmsg(msg)
	    {
	       parent.path.document.getElementById("log").innerHTML=msg+'\n';
  	    }
	</script>
</HEAD>
<body>
<table width="100%" cellpadding="0" cellspacing="0">
    <tr>
    	<td width="45%">
    	<div class="filem-block">
			<div class="filem-block-tl">
				<div class="filem-block-tr">
					<div class="filem-block-tm"></div>
				</div>
			</div>
			<div class="filem-block-ml">
				<div class="filem-block-mr">
					<div class="filem-block-mm">
		    			<form enctype='multipart/form-data' action='' name='upload' method='POST' onSubmit='if (this.lfile.value=="") return false; this.path.value=parent.path.document.getElementById("path").value; this.convert.value=document.getElementById("conv").checked;'>
							<input type='hidden' name='path' value='' />
							<input type='hidden' name='op' value='downloaded' />
							<input type='hidden' name='convert' value='' />
							<div><input name='lfile' size=28 type='file' /></div>
							<div class="input-upload-parent">
								<input type='submit' value='Загрузить' class="input-upload" />
								<a href="#" class="input-reset">Сброс</a>
							</div>
						</form>
						<input type="radio" id='conv' checked='checked'><a href="#">Преобразовывать русские имена</a>
					</div>
				</div>
			</div>
			<div class="filem-block-bl">
				<div class="filem-block-br">
					<div class="filem-block-bm"></div>
				</div>
			</div>
		</div>
	</td>
    <td width="34%">
    <div class="filem-block">
    	<div class="filem-block-tl">
    		<div class="filem-block-tr">
    			<div class="filem-block-tm"></div>
    		</div>
    	</div>
    	<div class="filem-block-ml">
    		<div class="filem-block-mr">
    			<div class="filem-block-mm">
	    			<form enctype='multipart/form-data' action='' name='crdir' method='POST' onSubmit='if (this.dir.value=="") return false; this.path.value=parent.path.document.getElementById("path").value; if (document.getElementById("conv").checked) this.convert.value="true"; else this.convert.value="false";'>
						<input type='hidden' name='path' value='' />
						<input type='hidden' name='op' value='createdir' />
						<input type="text" name="dir" size="20" value='' class="input-add-catalog"/>
						<input type="submit" value="Создать каталог" class="submit-add-catalog"/><br />
						<input type='hidden' name='convert' value='' />
					</form>
    			</div>
    		</div>
    	</div>
    	<div class="filem-block-bl">
    		<div class="filem-block-br">
    			<div class="filem-block-bm"></div>
    		</div>
    	</div>
    </div>
    </td>
    <td width="21%">
    <div class="filem-block">
    	<div class="filem-block-tl">
    		<div class="filem-block-tr">
    			<div class="filem-block-tm"></div>
    		</div>
    	</div>
    	<div class="filem-block-ml">
    		<div class="filem-block-mr">
    			<div class="filem-block-mm">
	    			<form enctype='multipart/form-data' action='' name='delete' method='POST' onSubmit='if (!confirm("Вы действительно хотите удалить выбранные файлы?")) return false; this.path.value=parent.path.document.getElementById("path").value; if ((this.sel.value=selected())=="") return false;'>
						<input type='hidden' name='path' value='' />
						<input type='hidden' name='op' value='delete' />
						<input type='hidden' name='sel' value='' />
						<input type='submit' value='Удалить файлы' class="input-delete" /><br />
					</form>
    			</div>
    		</div>
    	</div>
    	<div class="filem-block-bl">
    		<div class="filem-block-br">
    			<div class="filem-block-bm"></div>
    		</div>
    	</div>
    </div>
    </td>
    </tr>
</table>
	
      <?php
	include("functions.php");
	include("conf.php");

	if (!ini_get("register_globals")) {
	  //import_request_variables('GPC');
extract($_GET, EXTR_OVERWRITE && EXTR_PREFIX_ALL);
 extract($_POST, EXTR_OVERWRITE && EXTR_PREFIX_ALL);
	}
  
  	switch ($op)
	{
	  case 'downloaded':
	  {
	    if (!$admin) echo "<script language='javascript'>addmsg('У вас нет прав на данное действие!');</script>";
	    if ($admin && is_uploaded_file($_FILES['lfile']['tmp_name']))
	    {
		$root=realpath($root);
		$filename=$_FILES['lfile']['name'];
		if ($convert=='true') $filename=str2url($filename);
		$filesize=CoolSize($_FILES['lfile']['size']);
		if (file_exists($root.DIRECTORY_SEPARATOR.$path.DIRECTORY_SEPARATOR.$filename))
		{
		  $file_array = explode('.', $filename);
        	  $num = count($file_array);
        	  $fileres = $file_array[($num - 1)];
        	  if ($num==1) 
        	  {
        	    $i=1;
          	    while (file_exists($root.DIRECTORY_SEPARATOR.$path.DIRECTORY_SEPARATOR.$filename."(".$i.")")) {$i++;}
        	    $filename=$filename."($i)";
        	  }
        	  else
        	  {
        	   $filename="";
		   for ($i=0; $i<$num-1; $i++)  
		   { 
		     $filename.=$file_array[$i];
		     if ($i!=$num-2) $filename.=".";
		   }   
		   $i=1;
		   while (file_exists($root.DIRECTORY_SEPARATOR.$path.DIRECTORY_SEPARATOR.$filename."(".$i.").".$file_array[($num - 1)])) {$i++;}
		   $filename.="($i).".$file_array[($num - 1)];
		  }
		  echo "<script language='javascript'>addmsg('Файл с таким именем уже существует! Файл переименован');</script>";
		}
	        if (!@copy($_FILES['lfile']['tmp_name'], $root.DIRECTORY_SEPARATOR.$path.DIRECTORY_SEPARATOR.$filename))
	            echo "<script language='javascript'>addmsg('Ошибка при копировании файла!');</script>";
	        else
	            echo "<script language='javascript'>addmsg('Файл ".$filename." успешно загружен(".$filesize.")'); parent.cont.location=parent.cont.location;</script>";
	    }
	  }
	  break;
	
	  case 'rename':
	  {
	    if (!$admin) echo "<script language='javascript'>addmsg('У вас нет прав на данное действие!');</script>";
	    else
	    {
	      $root=realpath($root);
	      $old=$root.DIRECTORY_SEPARATOR.$path.DIRECTORY_SEPARATOR.$oldfile;
	      if ($convert=='true') $newfile=str2url($newfile);
	      $new=$root.DIRECTORY_SEPARATOR.$path.DIRECTORY_SEPARATOR.$newfile;
	      if (!@rename($old, $new))
	            echo "<script language='javascript'>addmsg('Ошибка при переименовании файлов'); parent.cont.location=parent.cont.location;</script>";
	      else 
	            if (is_dir($new)) echo "<script language='javascript'>addmsg('Файлы успешно переименованы!'); parent.tree.location=parent.tree.location;</script>";
	            echo "<script language='javascript'>parent.cont.location=parent.cont.location;</script>";
	    }
	  }
	  
	  case 'delete':
	  {
	    if (!$admin) echo "<script language='javascript'>addmsg('У вас нет прав на данное действие!');</script>";
	    else
	    {
  		$flag=false;
   		$errfiles="";
  		if ($sel!="")
		{
    		  $mfiles=explode(";", $sel);
    		  $flag=true;
    		  $root=realpath($root);
		  foreach($mfiles as $file)
    		  {
       		     if ($file!="")
       		     {
       		       $tmp=realpath($root.DIRECTORY_SEPARATOR.$path.DIRECTORY_SEPARATOR.$file);
       		       if (is_dir($tmp))
       		       {
       		        if (!xrmdir($tmp))
       		        {
          		  $errfiles.=$file." ";
          		  $flag=false;
       		        }
       		       }
       		       else if (is_file($tmp))
       		        if (!@unlink($tmp))
       		        {
          		  $errfiles.=$file." ";
          		  $flag=false;
          		}
       		     }
    		  }
  		 if ($flag)
		 {
	            echo "<script language='javascript'>addmsg('Файлы успешно удалены!'); parent.cont.location=parent.cont.location; parent.tree.location=parent.tree.location;</script>";
  		 }
		 else
		 {
	            echo "<script language='javascript'>addmsg('Ошибка при удалении файлов: ".$errfiles."'); parent.cont.location=parent.cont.location;</script>";
  		 }
  		}
	    }
	  }
	  break;

	  case 'createdir':
	  {
	    if (!$admin) echo "<script language='javascript'>addmsg('У вас нет прав на данное действие!');</script>";
	    else
	    {
    	      $root=realpath($root);
  	      if ($convert=='true') $dir=str2url($dir);
  	      if (@mkdir($root.DIRECTORY_SEPARATOR.$path.DIRECTORY_SEPARATOR.$dir))
	        echo "<script language='javascript'>addmsg('Каталог ".$dir." создан!'); parent.cont.location=parent.cont.location; parent.tree.location=parent.tree.location;</script>";
  	      else 
	        echo "<script language='javascript'>addmsg('Ошибка при создании каталога!');</script>";
  	    } 
  	  }
	  break;
	}
	
	
	
       ?>
	
	
	<!--  if (!is_uploaded_file($_FILES['lfile']['tmp_name']))
  {


	<a href="upload.php" target="_blank" onClick="popupWin = window.open(this.href+'?path='+parent.path.document.forms['form'].path.value, 'createdir', 'dialog=yes,modal=yes,width=250,height=100,status=no,toolbar=no,menubar=no'); popupWin.focus(); return false;">Загрузить файл на сервер</a><br>
	<a href="createdir.php" target="_blank" onClick="popupWin = window.open(this.href+'?path='+parent.path.document.forms['form'].path.value, 'createdir', 'dialog=yes,modal=yes,width=250,height=100,status=no,toolbar=no,menubar=no'); popupWin.focus(); return false;">Создать папку</a>
	<a href="delete.php" target="_blank" onClick="if (confirm('Удалить выбранные файлы?')) {popupWin = window.open(this.href+'?path='+parent.path.document.forms['form'].path.value+'&files='+selected(), 'deletedir', 'dialog=yes,modal=yes,width=250,height=100,status=no,toolbar=no,menubar=no'); popupWin.focus(); return false;}">Удалить</a><br>
-->	
</body>
</html>