<?php
function CoolSize($size) {
    $mb = 1024*1024;
    if ( $size > $mb ) {
        $mysize = sprintf ("%01.2f",$size/$mb) . " Mb";
    } elseif ( $size >= 1024 ) {
        $mysize = sprintf ("%01.2f",$size/1024) . " Kb";
    } else {
        $mysize = $size . " b";
    }
    return $mysize;
}

function spacer($w,$h){
    return "<img width=$w height=$h src='images/empty.gif' border=0>";
}






function rus2translit($string) {
    $converter = array(
        'а' => 'a',   'б' => 'b',   'в' => 'v',
        'г' => 'g',   'д' => 'd',   'е' => 'e',
        'ё' => 'e',   'ж' => 'zh',  'з' => 'z',
        'и' => 'i',   'й' => 'y',   'к' => 'k',
        'л' => 'l',   'м' => 'm',   'н' => 'n',
        'о' => 'o',   'п' => 'p',   'р' => 'r',
        'с' => 's',   'т' => 't',   'у' => 'u',
        'ф' => 'f',   'х' => 'h',   'ц' => 'c',
        'ч' => 'ch',  'ш' => 'sh',  'щ' => 'sch',
        'ь' => '\'',  'ы' => 'y',   'ъ' => '\'',
        'э' => 'e',   'ю' => 'yu',  'я' => 'ya',
        
        'А' => 'A',   'Б' => 'B',   'В' => 'V',
        'Г' => 'G',   'Д' => 'D',   'Е' => 'E',
        'Ё' => 'E',   'Ж' => 'Zh',  'З' => 'Z',
        'И' => 'I',   'Й' => 'Y',   'К' => 'K',
        'Л' => 'L',   'М' => 'M',   'Н' => 'N',
        'О' => 'O',   'П' => 'P',   'Р' => 'R',
        'С' => 'S',   'Т' => 'T',   'У' => 'U',
        'Ф' => 'F',   'Х' => 'H',   'Ц' => 'C',
        'Ч' => 'Ch',  'Ш' => 'Sh',  'Щ' => 'Sch',
        'Ь' => '\'',  'Ы' => 'Y',   'Ъ' => '\'',
        'Э' => 'E',   'Ю' => 'Yu',  'Я' => 'Ya',
    );
    return strtr($string, $converter);
}
function str2url($str) {
    $str = iconv("UTF-8", "cp1251", $str);
    // переводим в транслит
    $str = rus2translit($str);
    // в нижний регистр
    $str = strtolower($str);
    // заменям все ненужное нам на "-"
    $str = preg_replace('~[^-a-z0-9.]+~u', '-', $str);
    // удаляем начальные и конечные '-'
    $str = trim($str, "-");
    return $str;
}




function rus2lat($str)
{
	$chars = array(
			'й'=>'j','Й'=>'J',
			'ц'=>'c','Ц'=>'C',
			'у'=>'u','У'=>'U',
			'к'=>'k','К'=>'K',
			'е'=>'e','Е'=>'E',
			'н'=>'n','Н'=>'N',
			'г'=>'g','Г'=>'G',
			'ш'=>'sh','Ш'=>'Sh',
			'щ'=>'csh','Щ'=>'CSH',
			'з'=>'z','З'=>'Z',
			'х'=>'h','Х'=>'H',
			'ъ'=>'_','Ъ'=>'_',
			'ф'=>'f','Ф'=>'F',
			'ы'=>'y','Ы'=>'Y',
			'в'=>'v','В'=>'V',
			'а'=>'a','А'=>'A',
			'п'=>'p','П'=>'P',
			'р'=>'r','Р'=>'R',
			'о'=>'o','О'=>'O',
			'л'=>'l','Л'=>'L',
			'д'=>'d','Д'=>'D',
			'ж'=>'j','Ж'=>'J',
			'э'=>'e','Э'=>'E',
			'я'=>'ya','Я'=>'YA',
			'ч'=>'ch','Ч'=>'CH',
			'с'=>'s','С'=>'s',
			'м'=>'m','М'=>'M',
			'и'=>'i','И'=>'I',
			'т'=>'t','Т'=>'T',
			'ь'=>'_','Ь'=>'_',
			'б'=>'b','Б'=>'B',
			'ю'=>'u','Ю'=>'U',
			'ё'=>'e','Ё'=>'E',
			' '=>'_'
	);
	for ($i=0;$i<strlen($str);$i++){
		if ($chars[$str[$i]]!='')
		$res .= $chars[$str[$i]];
		else 
		$res .= $str[$i];
	}
	return $res;
}

// Удаление непустого каталога
function xrmdir($path)
{
  $result=true;
  if ($dir = opendir($path))
  {
    while (($file = @readdir($dir)) !== false)
    {
      $tmp = $path.DIRECTORY_SEPARATOR.$file;
      if (is_dir($tmp) && $file!="." && $file!="..")
      {
        if (!xrmdir($tmp))
          $result=false;
      }
      else if (is_file($tmp))
        if (!@unlink($tmp))
          $result=false;
    }
   closedir($dir);
  }
  else 
	$result=false;  
  if (!rmdir($path))
      $result=false;  
  return $result;
}
?>