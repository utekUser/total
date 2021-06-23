<?php
define('_ENGINE', TRUE);
    include '../../kernel/main/conf.php';
    
	function after_store($url, $mis, $comment, $name){
		$mlb=cms::setup_value('error_mail');
		if(conf::$uside && $mlb!=''){
			$mailsend=explode(',',$mlb);
			foreach ($mailsend as $key=>$value){
				$m=mail($value,
							'Сообщение об ошибке на сайте http://'.$_SERVER['HTTP_HOST'],
							'Данные клиента:<br>'.
							'<b>Адрес страницы:</b> '.$url."<br>".
							'<b>Ошибка:</b> '.$mis."<br>".
//							'<b>Ваш e-mail:</b> '.vars('address')."<br>".
							'<b>Комментарий:</b> '.vars('time')."<br>".$comment,
					    	"From: \"".$name."\" <".vars('address').">\n" .
							"Content-Transfer-Encoding: 8bit\n" .
							"MIME-Version: 1.0\n" .
							"Content-Type: text/html; charset=windows-1251\n".
							"X-Mailer: PHP/" . phpversion()
					);
	      }
		};
	}
?>
<!-- Скрипт отправки сообщений об ошибке http://mistakes.ru/script/mistakes_dev -->
<!-- Версия 3.0 -->
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1251">
	<TITLE>Отправить ошибку</TITLE>
<style type="text/css">
body {
margin: 20px 25px;
font-size:14px;
font-family:Helvetica, Sans-serif, Arial;
line-height:2em;
}
form
{margin: 0;}
.text {
font-weight: bold;
font-size:12px;
color:#777;
}
.copyright
{
font-size:11px;
color:#777;
}
</style>

<script language="JavaScript"> 
var p=top;
function readtxt()
{ if(p!=null)document.forms.mistake.url.value=p.loc
 if(p!=null)document.forms.mistake.mis.value=p.mis
}
function hide()
{ var win=p.document.getElementById('mistake');
win.parentNode.removeChild(win);
}
</script>

<?php 
if($_POST['submit']) { 
    # Заголовок сообщения - замените "yousite.ru" на имя своего сайта:
		$title = 'Сообщение об ошибке на сайте yousite.ru';
        $url = (trim($_POST['url'])); 
        $mis =  substr(htmlspecialchars(trim($_POST['mis'])), 0, 100000); 
		$comment =  substr(htmlspecialchars(trim($_POST['comment'])), 0, 100000);
		$mess = '
		Адрес страницы: '.$url.'
		Ошибка: '.$mis.'
		Комментарий: '.$comment.'
		'.$_POST['mess']; 
		# Email адрес, на который должны приходить сообщения: 
        $to = 'alex@r70.ru';
        # От кого пришло сообщение - можно указать имя сайта:  
        $from=$_SERVER['HTTP_HOST']; 
        $strSQL = "
INSERT INTO ".conf::$dbprefix."mistake 
            		(`posted`,`address`,`error`,`сomments`,`fixed`) 
            		VALUES('".date('Y-m-d H:i:00')."','".$url."','".$mis."','".$comment."',0)";
        mysql_query($strSQL);
        after_store($url, $mis, $comment,'Клиент');
//        mail($to, $title, $mess, 'From: '.$from); 
        echo '<br><br><br><center>Спасибо!<br>Ваше сообщение отправлено.<br><br><br><input onclick="hide()" type="button" value="Закрыть окно" id="close" name="close"><br><br><br><center>'; 
exit();
} 
?>

</head>
<body onload=readtxt()>
<span class="text">
Адрес страницы :
 </span>
<br /> 
<form name="mistake" action="" method=post>
<input type="text" name="url" size="30">
              <br />
              <span class="text">
              Ошибка :
              </span>
              <br /> 
              <textarea rows="5" name="mis" cols="30"></textarea> 
              <br />
              <span class="text">
              Комментарий :
              </span>
              <br /> 
              <textarea rows="5" name="comment" cols="30"></textarea> 
              <div style="margin-top: 7px"><input type="submit" value="Отправить" name="submit">
              <input onclick="hide()" type="button" value="Отмена" id="close" name="close"> 
              </div>
</form> 

</body></html>
