<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>CMS.Tomsk</title>
        <meta name="Description" content="CMS.Tomsk" />
        <meta name="Keywords" content="CMS.Tomsk" />
        <link href="/application/themes/admin/default/css/styles.css" rel="stylesheet" type="text/css" media="all" />
        <?php /* ?><script type="text/javascript" src="/externals/jquery/jquery.js"></script><?php */ ?>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
        <script type="text/javascript" src="/application/themes/admin/default/js/main.js"></script>
        <script type="text/javascript">
	    $(document).ready(function(){
	    	$('.admin-table tr').hover(
	    		function(){
	    			$(this).find('.row-actions').show();
	    		},
	    		function(){
	    			$(this).find('.row-actions').hide();
	    		}
	    	);
	    });
	    </script>
	    <!-- Calendar -->
	    <script id="objCalendarScript" type="text/javascript" src="/externals/calendar/calendar.js"></script>
	    <!-- Calendar -->
        <script language="javascript" type="text/javascript" src="/externals/urltranslit/jquery.urltranslit.js"></script>
        <script type="text/javascript">
        $(document).ready(function() {
            $("span.urltrans").urltranslit({destination: 'name', goal: 'url'});
        });
        </script>


        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">

        <!-- Optional theme -->
        <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap-theme.min.css">

        <!-- Latest compiled and minified JavaScript -->
        <script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>


    </head>
    <body>
        <div id="wrapper">
	        <div id="top">
	            <div id="top-head">
	            	<div class="top-head-left">
	            		Томавтотрейд
	            		<span>|</span>
	            		<a href="/" title="Перейти на сайт">Перейти на сайт</a>
	            	</div>

                    <div id="top-rmenu">
                        <div class="rmenu-tl">
                            <div class="rmenu-tr">
                                <div class="rmenu-bl">
                                    <div class="rmenu-br">
                                        <div class="rmenu-tc">
                                            <div class="rmenu-bc">
                                                <div class="rmenu-ml">
                                                    <div class="rmenu-mr">
                                                        <div class="rmenu-i">
                                                            <a class="first" href="javascript:open_browser();" title="Файловый менеджер">Файловый менеджер</a>
                                                            <a href="/admin/cms/setup/" title="Настройки">Настройки</a>
                                                            <a href="/admin/cms/tasks/" title="Настройки">Планировщик задач</a>
                                                            <a href="/admin/cms/optimization/" title="Оптимизация">Оптимизация</a>
                                                            <a href="/admin/cms/user/" title="Пользователи">Пользователи</a>
                                                            <a href="/admin/cms/module/" title="Модули">Модули</a>
                                                            <a href="/admin/cms/info/" title="Информация">Информация</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


	            	<div class="top-head-right">
	            		Привет, Admin
	            		<span>|</span>
	            		<a href="/admin/?mode=logout" title="Выйти">Выйти</a>
	            	</div>
	            </div>

	        </div>
            <div id="lmenu">
				<div class="lmenu-tl">
					<div class="lmenu-tr">
						<div class="lmenu-bl">
							<div class="lmenu-br">
								<div class="lmenu-ul">
								    <?php echo $this->layout()->leftmenu; ?>										
								</div>
							</div>
						</div>
					</div>
				</div>
            </div>
            <div id="content">
                <?php echo $this->layout()->content; ?>
            </div>
            <div class="clear"></div>
            <div class="empty"></div>
        </div>
        
        
<div id="footer">
	<div class="footer-left">
		<a href="http://cmstomsk.ru" target="_blank">CMS.Tomsk</a>
	</div>

</div>
</body>
</html>