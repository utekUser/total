<div style="padding: 10px;border: 1px solid #e5e5e5;margin: 0 0 15px 5px;border-radius: 3px;background: #edeaea;">
	<a href="/admin/user/">Вернуться к списку пользователей</a>
</div>
<div style="padding: 10px;border: 1px solid #e5e5e5;">
	<form method="get">
		<label for="emailto">Кому отправить письмо</label><br/>
		<select style="width: 100%; padding: 5px;" name="emailto">
			<option value="">Выберите значение</option>
			<option value="0">Физическим лицам</option>
			<option value="1">Юридическим лицам</option>
		</select>
		<br/><br/><label for="emailtheme">Тема письма</label><br/>
		<input style="width: 100%; padding: 5px;" type="text" name="emailtheme" id="emailtheme" value="" />
		<br/><br/><label for="emailtext">Текст письма</label><br/>
		<script type="text/javascript" src="/externals/tiny_mce_ru/tiny_mce.js"></script>        
		<script type="text/javascript">
        	tinyMCE.init({
        		// General options
        		language : 'ru',
//        		mode : "textareas",
                mode : "exact",
                elements : "emailtext",
        		theme : "advanced",
        		plugins : "autolink,lists,pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template,wordcount,advlist,autosave",
        		file_browser_callback : "fileBrowserCallBack",
        
        		// Theme options
        		theme_advanced_buttons1 : "save,newdocument,|,bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,styleselect,formatselect,fontselect,fontsizeselect",
        		theme_advanced_buttons2 : "cut,copy,paste,pastetext,pasteword,|,search,replace,|,bullist,numlist,|,outdent,indent,blockquote,|,undo,redo,|,link,unlink,anchor,image,cleanup,help,code,|,insertdate,inserttime,preview,|,forecolor,backcolor",
        		theme_advanced_buttons3 : "tablecontrols,|,hr,removeformat,visualaid,|,sub,sup,|,charmap,emotions,iespell,media,advhr,|,print,|,ltr,rtl,|,fullscreen",
        		theme_advanced_buttons4 : "insertlayer,moveforward,movebackward,absolute,|,styleprops,|,cite,abbr,acronym,del,ins,attribs,|,visualchars,nonbreaking,template,pagebreak,restoredraft",
        		theme_advanced_toolbar_location : "top",
        		theme_advanced_toolbar_align : "left",
        		theme_advanced_statusbar_location : "bottom",
        		theme_advanced_resizing : true,
        		
        		// это добавил
                force_br_newlines : true, 
                forced_root_block : '',
        
        		// Example content CSS (should be your site CSS)
        		content_css : "/themes/default/css/default.css",
        
        		// Drop lists for link/image/media/template dialogs
        		template_external_list_url : "lists/template_list.js",
        		external_link_list_url : "lists/link_list.js",
        		external_image_list_url : "lists/image_list.js",
        		media_external_list_url : "lists/media_list.js",
        
        		// Style formats
        		style_formats : [
        			{title : 'Bold text', inline : 'b'},
        			{title : 'Red text', inline : 'span', styles : {color : '#ff0000'}},
        			{title : 'Red header', block : 'h1', styles : {color : '#ff0000'}},
        			{title : 'Example 1', inline : 'span', classes : 'example1'},
        			{title : 'Example 2', inline : 'span', classes : 'example2'},
        			{title : 'Table styles'},
        			{title : 'Table row 1', selector : 'tr', classes : 'tablerow1'}
        		],
        
        		// Replace values for the template plugin
        		template_replace_values : {
        			username : "Some User",
        			staffid : "991234"
        		}
        	});
        </script>        <script type="text/javascript">
        function fileBrowserCallBack(field_name, url, type, win) {
        mywin = open("/externals/filemanager/", "filemanager", "resizable=yes,dialog=yes,modal=yes,width=750,height=550,status=no,toolbar=no,menubar=no");
        imagefield = win.document.forms[0].elements[field_name];
        }
        </script>        
        <div>
            <a href="javascript:;" onclick="tinyMCE.execCommand('mceToggleEditor',false,'emailtext');">
                <span>Переключить режим</span>
            </a>
        </div>
		<textarea style="width: 100%; padding: 5px;" name="emailtext" id="emailtext" rows="36" aria-hidden="true"></textarea>
		<br/><input style="width: 100%; padding: 5px;" type="submit" name="emailsend" />
	</form>
</div>
