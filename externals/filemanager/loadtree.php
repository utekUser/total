<?php
  include("conf.php");  
  include("functions.php");
  
  if (!ini_get("register_globals")) {
    //import_request_variables('GPC');
extract($_GET, EXTR_OVERWRITE && EXTR_PREFIX_ALL);
 extract($_POST, EXTR_OVERWRITE && EXTR_PREFIX_ALL);
  }
  
  $directory=realpath($root);

  if (isset($p))
      $directory.=$p;
  
  if ($dir = @opendir($directory))
  {
    echo "<table border='0' cellspacing='0' cellpadding='0' width='100%' align='left'>\n";
    while (($file = @readdir($dir)) !== false)
    {
      if ($file!="." && $file!="..")
      {
       $tmp = $directory.DIRECTORY_SEPARATOR.$file;
       if (is_dir($tmp))
       {
        $fhavedirs=false;
        if ($subdir = @opendir($tmp))
        {
         while (($subfile = @readdir($subdir)) !== false)
         {
//         echo $tmp.DIRECTORY_SEPARATOR.$subfile."<br>";
          if ($subfile!="." && $subfile!=".." && is_dir($tmp.DIRECTORY_SEPARATOR.$subfile))
          {
            $fhavedirs=true;
            break;
          }
         }
         closedir($subdir);
	}
	
        $path=$p."/".$file;
        echo " <tr>\n";
        if ($fhavedirs)
          echo "  <td><img id='img".$path."' open='false' src='images/folder+.gif' onclick=\"openDir('$path');\">".spacer(4,1)."</td>\n";
        else
          echo "  <td>".spacer(20,1)."</td>\n";
        echo "  <td><img src='images/folder.gif'>".spacer(5,1)."</td>\n";
        echo "  <td width=100%><a href='#' onclick=\"chdir('$path'); return false;\">$file</a></td>\n";
        echo " </tr>\n";
        echo " <tr><td></td><td colspan='2'><span id='$path' style='visibility: visible; dislay: block;'></span></td></tr>\n";
       }
      }
    }  
    echo "</table>\n";
    closedir($dir);
  }
  else
  {
    echo "error!";
  }
