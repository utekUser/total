<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Официальный дистрибьютор TOTAL Lubricants, MANN-HUMMEL, NGK - Томавтотрейд</title>
        <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
        <?php //echo $this->headTitle(); ?>
        <?php //echo $this->headDescription(); ?>
        <?php //echo $this->headKeywords(); ?>
        <?php if (Engine_Auth::getAuth()) { ?>
        <style type="text/css" media="print">#wpadminbar { display:none; }</style>
        <style type="text/css">
            html { margin-top: 24px !important; }
            * html body { margin-top: 24px !important; }
        </style>
        <link href="/application/themes/admin/css/admin-bar.css" rel="stylesheet" type="text/css" media="all" />
        <?php } ?>

        <link rel="stylesheet" type="text/css" media="all" href="/themes/default/css/styles.css"  />
        <link rel="stylesheet" type="text/css" media="all" href="/themes/default/css/newdesign2015.css"  />
        <script type="text/javascript" src="/externals/jquery/jquery.js"></script>
        <script type="text/javascript" src="/externals/scrollto/jquery.scrollTo-1.4.2-min.js"></script>

        <script type="text/javascript" src="/themes/default/js/common.js?v=2014102002"></script>

        <script type="text/javascript" src="/externals/slimbox/js/slimbox2.js"></script>
        <link rel="stylesheet" type="text/css" href="/externals/slimbox/css/slimbox2.css" />
        <script type="text/javascript">
            $(function () {
                $('a.gallery').slimbox();
            });
        </script>
        <script type="text/javascript" src="/themes/default/js/jquery.colorbox-min.js"></script>
	<link href="/themes/default/css/colorbox.css" rel="stylesheet" type="text/css">
        <script>
    function hideAlert(){
        $("#dim").fadeOut();
        return false;
    }
    
    function showAlert(callback, timeout){
        $("#dim").fadeIn("fast", function(){
            if(typeof callback == "function")
                setTimeout(callback, parseInt(timeout) > 0 ? timeout : 5000); //По умолчанию скрываем через 5 сек.
        });
        return false;
    }
    
    $(document).ready(function () {
        $(".inlineCallmeForm").colorbox({inline: true, width: "460px"});
                <?php if (isset($_GET['callme'])) { ?>
                showAlert(hideAlert, 3000);
                <?php } ?>		
    });
</script>

        <script type="text/javascript" src="/externals/jcarousel/jquery.jcarousel.min.js"></script>
        <link rel="stylesheet" type="text/css" href="/externals/jcarousel/jcarouselskin.css" />
        <script type="text/javascript">
            function mycarousel_initCallback(carousel) {
                jQuery('.jcarousel-control a').bind('click', function () {
                    carousel.scroll(jQuery.jcarousel.intval(jQuery(this).text()));
                    return false;
                });
            }
            function mycarouselDesign_initCallback(carousel) {
                jQuery('.jcarousel-control a').bind('click', function () {
                    carousel.scroll(jQuery.jcarousel.intval(jQuery(this).text()));
                    return false;
                });
            }
            jQuery(document).ready(function () {
                jQuery("#mycarousel").jcarousel({
                    scroll: 1,
                    wrap: 'circular',
                    auto: 7,
                    initCallback: mycarousel_initCallback,
                    itemVisibleInCallback: {
                        onAfterAnimation: function (c, o, i, s) {
                            var size = c.options.size;
                            i = (((i - 1) % size) + size) % size;
                            jQuery('.jcarousel-control a').removeClass('control-active');
                            jQuery('.jcarousel-control a:eq(' + i + ')').addClass('control-active');
                        }
                    }
                });
                jQuery("#mycarouselDesign").jcarousel({
                    scroll: 1,
                    wrap: 'circular',
                    auto: 7,
                    initCallback: mycarouselDesign_initCallback,
                    itemVisibleInCallback: {
                        onAfterAnimation: function (c, o, i, s) {
                            var size = c.options.size;
                            i = (((i - 1) % size) + size) % size;
                            jQuery('.jcarousel-control a').removeClass('control-active');
                            jQuery('.jcarousel-control a:eq(' + i + ')').addClass('control-active');
                        }
                    }
                });
            });
        </script>

        <!-- Всплывающее окно -->
        <script type="text/javascript" src="/themes/default/js/jquery.arcticmodal-0.3.min.js" ></script>
        <link type="text/css" rel="stylesheet" href="/themes/default/css/jquery.arcticmodal-0.3.css"/>
        <script type="text/javascript" src="/themes/default/js/jquery.cookie.js" ></script>

        <meta name='yandex-verification' content='60045f3dff84f9a9' />
		<script src='https://www.google.com/recaptcha/api.js'></script>
    </head>

    <body>
        <?php 
        $auth = Zend_Auth::getInstance()->setStorage(new Zend_Auth_Storage_Session('Zend_Auth_User'));
        ?>
        <?php //$userType = Engine_AuthUser::getUserType(); ?> 
        <script type="text/javascript">
            $(document).ready(function () {
                function arcticmodal_close() {
                    $('#boxUserFirstInfo').arcticmodal('close');
                    <?php /* $('#boxUserFirstInfo1').arcticmodal('close');  */ ?>
                }

                if (!$.cookie('wasVisit')) {
                    $('#boxUserFirstInfo').arcticmodal({
                        closeOnOverlayClick: true,
                        closeOnEsc: true
                    });
                    <?php /* $('#boxUserFirstInfo1').arcticmodal({
                        closeOnOverlayClick: true,
                        closeOnEsc: true
                    }); */ ?>
                    //setTimeout(arcticmodal_close, 6000)
                }
                $.cookie('wasVisit', true, {
                    expires: 1,
                    path: '/'
                });

//            $(".sale227").click(function() {
//            $('#boxUserFirstInfo').arcticmodal({
//            closeOnOverlayClick: true,
//            closeOnEsc: true
//            });
//            });

					setTimeout(function(){
						if (!$.cookie('wasShownCallMe')) {
							$(".inlineCallmeFormByTime").colorbox({
								inline: true, 
								width: "490px",  
								open: true
							}); 
						}
						
						$.cookie('wasShownCallMe', true, {
							expires: 1,
							path: '/'
						});
					}, 180000); 
				//}
            });
        </script> 
        <style>
            .arcticmodal-container_i td {
                padding: 0;
                backgroud: none !important;
            }
            .arcticmodal-container_i2 {
                padding: 0;
                backgroud: none !important;;
            }
        </style>
       <div style="display: none;">
            <div class="box-modal" id="boxUserFirstInfo">
                <div class="box-modal_close arcticmodal-close">закрыть</div>		
                <br><br>
                <a href="https://russia.filtron.eu/" target="_blank">
                    <img style="display: block;" width="600" src="/media/filebrowser/uploads/banners/2021/04/MF_web_600x300_2021.jpg" />
                </a>                
                <br><br>                
            </div>
            <?php /* <div class="box-modal" id="boxUserFirstInfo1">
                <div class="box-modal_close arcticmodal-close">закрыть</div>		
                <br><br>
                <div style="width: 550px; margin: 0 auto; padding: 1em;">
                    <p style="text-align: center"><strong>Уважаемые партнёры!</strong></p>
                    <p style="text-align: center">Уведомляем Вас о повышении цен на 20% на отпускаемую продукцию Total <br>
                        с 12 апреля 2021 г.</p>
                    <p>Снижение объёмов производства нефтеперерабатывающих заводов повлияло на объём производства базового сырья, что в свою 
                    очередь спровоцировало повышение цен со стороны заводов на ограниченный объём базовых масел. Среднее повышение
                    стоимости базовых масел 51 % ..</p>
                    <p>В связи с этим принято решение о повышении стоимости продукции до 20%.</p>
                    <p style="text-align: right;">..из письма от Тотал Восток</p>
                </div>               
                <br><br>                
            </div> */ ?>
        </div>

        <div id="top-link"><a href="#top">наверх</a></div>

        <?php if ($_SERVER['REMOTE_ADDR'] == '78.139.228.23') { ?>
        <style>
            .top-menu {
                background: #ffb400
            }
            .top-menu__m {
                width: 1005px; margin: 0 auto;
                height: 40px;
                position: relative;
            }
            .top-menu__m a {
                display: block; float: right; height: 40px; border-right: 1px solid #000; line-height: 40px; padding: 0 18px; color: #000
            }
            .top-menu__m a:hover {
                background: #ff8c00;
            }
            a.top-menu__m__basket {
                position: relative;
                padding: 0 18px 0 48px;
            }
            .top-menu__m__basket span:before {
                background: url("/static/images/basket.png") no-repeat;
                content: " ";
                display: block;
                width: 28px;
                height: 24px;

                left: 14px;
                position: absolute;
                top: 8px;
            }
        </style>
        <div class="top-menu">
            <div class="top-menu__m">
                <a class="top-menu__m__signup" href="/account/signup/">Регистрация</a>
                <a class="top-menu__m__login" href="/account/login/">Вход</a>
                <a class="top-menu__m__basket" href="/basket/"><span>Корзина пуста</span></a>

                <div class="login" style="position: absolute; top: 40px; right: 0; display: none; z-index: 100; background: #ffb400; padding: 15px 5px 5px 15px;">
                    <form>
                        <div style="float: left">
                            <input type="text" name="email" placeholder="E-mail">
                        </div>
                        <div style="float: left">
                            <input type="password" name="password" placeholder="Пароль" style="padding: 0 7px">
                            <a style="height: 20px; float: none; line-height: normal; padding: 0" href="/account/restore/">Забыли пароль?</a>
                        </div>
                        <div style="float: left">
                            <button type="button">Войти</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <?php } ?>

        <?php /* ?>
        <div id="wrapper">
            <div id="header">
                <a href="/oils/" class="logo-total"><img alt="" src="/themes/default/images/total-logo-new.png" /></a>
                <a href="/oils/" class="logo-elf"><img alt="" src="/themes/default/images/elf-logo-new.png" /></a>
                <a href="/filters/" class="logo-mann"><img alt="" src="/themes/default/images/mann-logo.png" /></a>
                <a href="/plug/" class="logo-ngk"><img width="60" alt="" src="/images/ngk.png" /></a>
                <a href="/" class="logo-img"><img alt="" src="/themes/default/images/tom-auto-treid-logo.png" /></a>
                <div class="logo">
                    <a href="/" style="text-decoration: none">
                        <span style="color: rgb(255, 255, 255); font-family: serif; font-size: 52px; margin: 0 0 0 10px; text-decoration: none;">Томавтотрейд</span>
                    </a>
                    <p>Официальный дистрибьютор TOTAL Lubricants,<br>MANN-HUMMEL, NGK</p>
                </div>
            </div>
            <div id="top-menu"><?php echo $this->layout()->topmenu; ?></div>
            <?php if ($this->layout()->module != 'account') { ?>
            <div id="left-panel">
                <?php if (strripos($_SERVER['REQUEST_URI'],'oils')) {   ?>                
                <script type="text/javascript">
                    $(document).ready(function () {
                        $('.splLink').click(function () {
                            $(this).parent().children('div.splCont').toggle('normal');
                            return false;
                        });
                    });
                </script>                
                <form method="get">                              
                    <div class="search-menu">
                        <div style="font-size: 17px;">Поиск по параметрам</div>
                        <div class="seachBlock">
                            <?php foreach ($this->filters as $filterKey => $filter) { ?>
                            <div class="search-menu__filter ">
                                <button class="splLink" type="button"></button>
                                <div class="search-menu__title"><?php echo $filter['name']; ?></div>
                                <?php
                                $display = 'none';
                                foreach ($filter['values'] as $key => $value) {
                                if (isset($_GET['filters'][$filterKey])) {
                                foreach ($_GET['filters'][$filterKey] as $getBrand) {
                                if ($getBrand == $value) {
                                $display = 'block';
                                break;
                                }
                                }
                                }
                                }
                                ?>
                                <div class="splCont seach<?php echo $filterKey; ?> hide<?php echo $filterKey; ?>" style="display: <?php echo $display; ?>;">
                                    <?php
                                    switch ($filter['type']) {
                                    case 'checkbox':
                                    echo '<ul>';
                                    foreach ($filter['values'] as $key => $value) {
                                    $checked = '';
                                    if (isset($_GET['filters'][$filterKey])) {
                                    foreach ($_GET['filters'][$filterKey] as $getBrand) {
                                    if ($getBrand === $value) {
                                    $checked = 'checked';
                                    break;
                                    }
                                    }
                                    }
                                    echo '<li>
                                    <label>
                                    <input type="checkbox" name="filters[' . $filterKey . '][]" value="' . $key . '" ' . $checked . '>
                                    ' . $value . '
                                    </label>
                                    </li>';
                                    }
                                    echo '</ul>';
                                    break;
                                    case 'range':
                                    echo '
                                    <p>от</p>
                                    <input type="text" size="5" name="filters[' . $filterKey . '][' . $filter['from'] . ']" value="' . (isset($_GET['filters'][$filterKey][$filter['from']]) ? $_GET['filters'][$filterKey][$filter['from']] : '') . '">
                                    ' . $filter['value'] . '<p>до</p>
                                    <input type="text" size="5" name="filters[' . $filterKey . '][' . $filter['to'] . ']" value="' . (isset($_GET['filters'][$filterKey][$filter['to']]) ? $_GET['filters'][$filterKey][$filter['to']] : '') . '">
                                    ' . $filter['value'] . '';
                                    break;
                                    }
                                    ?>
                                </div>
                            </div>
                            <?php } ?>
                            <button style="width: 173px;" class="searchButton" type="submit">Показать товары</button>
                        </div>
                    </div>
                </form>
                <?php } 
                if (!$auth->hasIdentity()) {
                ?>
                <div class="auth">
                    <div class="white-block">
                        <form method="post" action="/account/login/" name="auth" >
                            <div><span>Логин:</span><div class="field"><div><div><input type="text" name="login" value="" /></div></div></div></div>
                            <div><span>Пароль:</span><div class="field"><div><div><input type="password" name="password" value="" /></div></div></div></div>
                            <div style="clear: both">
                                <label>
                                    <input style="vertical-align: bottom" type="checkbox" checked="checked" name="remember">
                                    Оставаться в системе
                                </label>
                            </div>
                        </form>
                        <div><a href="/account/signup/">Регистрация</a></div>
                        <div class="forget_pass"><a href="/account/restore/">Забыли пароль?</a></div>
                        <input type="image" src="/themes/default/images/enter.png" class="enter" onclick="document.auth.submit();" />
                    </div>
                </div>
                <?php } ?>

                <?php

                if ($auth->hasIdentity()) {
                ?>
                <div class="client-block">
                    <div class="white-block">
                        <div class="client-name"><?php if($this->layout()->userInfo['name'] != '') echo $this->layout()->userInfo['name']; ?></div>
                        <ul class="left-menu">
                            <li class="first "><a href="/control/">Личный кабинет</a></li>
                            <li class=""><a href="/control/profile/">&nbsp;&mdash;&nbsp;Личные данные</a></li>
                            <li class=""><a href="/messages/mailbox/">Сообщения</a>&nbsp;<b>(<?php echo $this->layout()->unread; ?>)</b></li>
                            <?php if (!$this->layout()->isManager) { ?>
                            <li class="" id="basket"><?php echo Basket_Models_Control::getCount(); ?></li>
                            <li class=""><a href="/control/history/">История заказов</a></li>
                            <li class=""><a href="/prices/">Прайс-листы</a></li>
                            <?php } ?>
                            <!---->
                        </ul>
                    </div>
                    <a href="/account/logout/" class="client-exit"></a>
                </div>	
                <?php } ?>
                <?php if ($auth->hasIdentity()) { ?>
                <?php $userType = Engine_AuthUser::getUserType(); ?>
                <?php if ($userType) { ?>
                <?php 
                $user_id = $auth->getIdentity(); 
                $model = new Notice_Models_Connection(); 
                $count = $model->getUserUnread($user_id);
                ?>
                <a href="/control/notice/" class="notice-button">Уведомления <?php echo ($count ? '<b>(' . $count . ')</b>' : ''); ?></a>
                <?php } ?>
                <?php } ?>


                <?php if ($this->layout()->module == 'oils') { ?>


                <?php echo $this->layout()->oilsMenu; ?>
                <script type="text/javascript">
                    $(function () {
                        var ul = $('.catalog-oils').find('ul:hidden');
                        ul.parent().find('div:first').append('<span class="menu-state"></span>');

                        var active = $('.catalog-oils').find('li.active');
                        active.parent().show();
                        active.parent().parent().parent().show();
                        active.find('ul:first').show();
                        active.find('div:first').find('span').addClass('menu-hidden');

                        $('.menu-state').click(function () {
                            var ul = $(this).parent().parent().find('ul:first');
                            if (ul.is(":visible")) {
                                ul.hide("slow");
                                $(this).removeClass("menu-hidden");
                            } else {
                                ul.show("slow");
                                $(this).addClass("menu-hidden");
                            }
                        });
                    })
                </script>
                <?php if (false) { ?>
                <div class="catalog-list">
                    <div class="white-block-t"></div>
                    <div class="white-block">
                        <div class="catalog-title">Каталог продукции</div>
                    </div>
                    <div class="catalog-list-inner">
                        <ul>
                            <li class="li-first">
                                <div><a href="#" class="active">Масла TOTAL</a>
                                    <img alt="" src="/themes/default/images/menu-shown.png" /></div>
                                <ul>
                                    <li>
                                        <div><a href="#">Автомасла</a><span class="menu-state"></span></div>
                                        <ul>
                                            <li><div><a href="#">Автомобильные масла</a></div></li>
                                            <li><div><a href="#">Моторные масла</a></div></li>
                                            <li><div><a href="#">Трансмиссионные масла</a></div></li>
                                            <li><div><a href="#">Жидкости ATF</a></div></li>
                                            <li><div><a href="#">Антифризы</a></div></li>
                                            <li><div><a href="#">Тормозные жидкости</a></div></li>
                                            <li><div><a href="#">Гидравлические жидкости</a></div></li>
                                            <li><div><a href="#">Смазки</a></div></li>
                                            <li><div><a href="#">Моторные масла</a></div></li>
                                            <li><div><a href="#">INEO 5W-30/5W-40</a></div></li>
                                        </ul>
                                    </li>
                                    <li>
                                        <div><a href="#">Мото</a></div>
                                    </li>
                                    <li><div><a href="#">Грузовые масла</a></div></li>
                                    <li><div><a href="#">Сельское хозяйство</a></div></li>
                                    <li><div><a href="#">Строительство</a></div></li>
                                    <li><div><a href="#">Промышленность</a></div></li>
                                    <li><div><a href="#">Рыболовство</a></div></li>
                                    <li>
                                        <div><a href="#">Катера</a></div>
                                    </li>
                                    <li>
                                        <div><a href="#">Судовые масла</a></div>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                    <div class="white-block">
                        <ul>
                            <li class="li-first">
                                <div><a href="#"><b>Масла ELF</b></a></div>
                            </li>
                        </ul>
                    </div>
                    <div class="white-block-b"></div>

                </div>
                <?php } ?>
                <?php } elseif ($this->layout()->module == 'filters') { ?>
                <div class="catalog-filter">
                    <div class="white-block">
                        <div class="catalog-title">Каталог фильтров</div>
                    </div>
                    <ul>
                        <?php foreach ($this->layout()->filterSection as $filerSection) { ?>
                        <?php if($filerSection['url'] == $this->layout()->sectionUrl) $class = 'class="active"'; else $class = '';  ?>
                        <li <?php echo $class; ?>><a href="/filters/<?php echo $filerSection['url']; ?>/"><?php echo $filerSection['name']; ?></a></li>
                        <?php } ?>
                    </ul>
                </div>
                <?php }  ?>
                <div class="contacts">
                    <div class="white-block">
                        <div class="title">Контакты</div>
                        <div class="contacts-info">
                            <p style="font-size: 12px; color: #000">
                                <strong>Адрес:</strong><br>
                                г. Томск, ул. Тверская, 18<br>
                                <a href="http://total.tomsk.ru/kontakty-i-shema-proezda-kompanii-tomavtotrejd-/" rel="nofollow">Схема проезда</a>
                            </p>

                            <p style="font-size: 12px; color: #000"><strong>Телефоны:</strong><br>
                                Оптовый отдел:<br>
                                <span style="font-size: 14px; font-weight: 700">(3822) 266-933<br>(3822) 266-866</span><br>
                                Розница<br>
                                <span style="font-size: 14px; font-weight: 700">(3822) 266-687</span>
                            </p>

                            <a href="mailto:avr@mail.tomsknet.ru" class="mail">avr@mail.tomsknet.ru</a>
                        </div>
                    </div>
                </div>
                <div class="ask-question">
                    <a href="/guestbook/">Задать вопрос</a>
                </div>



                <?php if (Engine_Cms::displayContent(2)) { ?>
                <div class="left-panel-banner"><?php echo Engine_Cms::displayContent(2); ?></div>
                <?php } ?>

            </div>
            <?php } ?>

            <!--content start-->
            <?php if ($this->layout()->module != 'account') { ?>
            <div class="content">
                <?php } else { ?>
                <div class="content content-w960">
                    <?php } ?>

                    <?php
                    $select = Engine_Application::getPageConf();
                    if ($select['main']) {
                    include 'main.tpl';    
                    } else { 
                    if (!$select['module']) {
                    ?>
                    <div class="white-fon">
                        <div class="white-fon-m">
                            <h1><?php echo Engine_Application::getPageHeader(); ?></h1>
                            <?php include 'common.tpl'; ?>
                        </div>
                    </div>
                    <?php } else { ?>
                    <div class="white-fon">
                        <div class="white-fon-m">
                            <?php include 'common.tpl'; ?>
                        </div>
                    </div>
                    <?php } ?>
                    <?php } ?>
                </div>
                <!--content end-->

                <div class="clear"></div>
                <div class="empty"></div>
            </div>
            <div id="footer">
                <div class="footer-inner">

                    <div class="footer-menu">
                        <div class="footer-menu__title">Медиа-центр</div>
                        <ul>
                            <li><a href="/news/">Новости</a></li>
                            <li><a href="/articles/">Статьи</a></li>
                            <li><a href="/video/">Видео</a></li>
                        </ul>
                    </div>
                    <div class="copyright">© 2011–<?php echo date('Y'); ?> «Томавтотрейд»</div>
                </div>
            </div>           
        </div> <?php */ ?>
        <?php if (Engine_Auth::getAuth()) { ?>
        <div id="adminpanel">
            <div class="quicklinks">
                <ul>
                    <li class="submenu">
                        <a href="#" class="admin-arrow-down">admin</a>
                        <ul>
                            <li class="submenu-top"></li>
                            <li>
                                <a href="#">Изменить профиль</a>
                            </li>											

                            <li class="submenu-razd"></li>											
                            <li>
                                <a href="/admin/?mode=logout">Выйти</a>
                            </li>
                            <li class="submenu-end"></li>
                        </ul>
                    </li>
                    <li class="menu-razd">|</li>
                    <li>
                        <a href="/admin">Администрирование</a>
                    </li>	
                    <li class="menu-razd">|</li>												
                    <li class="submenu">
                        <a href="#" class="admin-arrow-down">Добавить</a>
                        <ul>
                            <li class="submenu-top"></li>
                            <li>
                                <a href="/admin/sitemap/add">Страницу</a>
                            </li>																					
                            <li>
                                <a href="/admin/cms/user/add">Пользователя</a>
                            </li>
                            <li class="submenu-end"></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
        <?php } ?>
        <?php //echo $_SERVER['REMOTE_ADDR'];
        //if ($_SERVER['REMOTE_ADDR'] == '78.140.9.206' || $_SERVER['REMOTE_ADDR'] == '46.161.158.155' || $_SERVER['REMOTE_ADDR'] == '88.204.72.104' || $_SERVER['REMOTE_ADDR'] == '95.170.159.81') { ?>
        <?php
        $auth1 = Zend_Auth::getInstance()->setStorage(new Zend_Auth_Storage_Session('Zend_Auth_User'));
        ?>
        <div class="allNewWrapper">
            <div id="topLoginWrapper">
                <div id="topLoginDiv">
                    <div class="tLDL tLDL1" style="width: <?php if (!$auth1->hasIdentity()) { ?> 750<?php } else { ?> 550<?php } ?>px;"></div>
                    <?php if (!$auth1->hasIdentity()) { ?>
                    <div class="tLDL tLDL2">
                        <a href="/account/login/" title="Войти на сайт">Вход</a>
                    </div>
                    <div class="tLDL tLDL3">
                        <a href="/account/signup/" title="Зарегистрироваться на сайте">Регистрация</a>
                    </div>
                    <?php } elseif ($auth1->hasIdentity()) { ?>
                    <div class="tLDL tLDL2" style="height: 19px; width: 295px; text-align: right;"> 
                        <a href="/control/"><?php if($this->layout()->userInfo['name'] != '') echo $this->layout()->userInfo['name']; ?></a>                       
                    </div>
                    <div class="tLDL tLDL3" style="width: 40px;">
                        <a href="/account/logout/" title="Выйти с сайта">Выйти</a>
                    </div>
                    <?php } ?>
                </div>
            </div>
            <div class="headerWrapper">
                <?php include 'header.tpl'; ?>
            </div>
			<?php /* <div style="text-align: center; font-size: 16px; text-transform: uppercase; color:#EF5252;"><strong>На сайте ведутся технические работы</strong></div> */ ?>
            <div class="topMenuWrapper">
                <div id="topMenuWrapper">
                    <div id="top-menu"><?php echo $this->layout()->topmenu; ?></div>
                </div>
            </div>
            <div class="contentWrapper">                
                <!--content start-->
                <?php if ($this->layout()->module != 'account') { ?>
                <div class="content" style="margin: 0;">
                    <?php } else { ?>                    
                    <div class="content content-w960">
                        <?php } ?>

                        <?php
                        $select = Engine_Application::getPageConf();						
                        if ($select['main']) {
							include 'main.tpl';    
                        } else { ?>
							<div class="content-w941">                                                                                                 
								<?php if ((!$select['module'] || $_SERVER['REQUEST_URI'] == "/guestbook/") && ($_SERVER['REQUEST_URI'] != "/prices/")) { ?>
									<div class="white-fon" style="margin: 0;">
										<div class="white-fon-m" style="border-radius: 0px; padding-bottom: 0;">
											<?php include 'common.tpl'; ?>
										</div>
									</div>
								<?php } else { ?>
									<div class="white-fon" style="margin: 0;">
										<div class="white-fon-m" style="border-radius: 0px; padding-bottom: 0;">
											<?php include 'common1.tpl'; ?>
										</div>
									</div>
								<?php } ?>
							</div>
                        <?php } ?>
                        <?php if ($this->layout()->module != 'account') { ?>
                    </div>
                    <?php } else { ?>
                </div>
                <?php } ?>
                <!--content end-->
            </div>

            <div class="footerWrapper">
                <?php include 'footer.tpl'; ?>                
            </div>
        </div>
        <?php //} ?>
        <?php //if ($_SERVER['REMOTE_ADDR'] == '78.140.9.206' || $_SERVER['REMOTE_ADDR'] == '46.161.158.155' || $_SERVER['REMOTE_ADDR'] == '88.204.72.104' || $_SERVER['REMOTE_ADDR'] == '95.170.159.81') { ?>
        <?php if ($auth1->hasIdentity()) { ?>
        <ul class="services-menu2 buttons">
            <a href="/messages/mailbox/"><li class="mess"><p>СООБЩЕНИЯ</p></li></a>
            <?php /* <a href="/basket/"><li class="bagr"><p>КОРЗИНА</p></li></a> */ ?>
            <a href="/control/history/"><li class="hist"><p>ИСТОРИЯ ЗАКАЗОВ</p></li></a>
        </ul>
        <?php } ?>
        <?php //} ?>
        <!-- Yandex.Metrika counter -->
        <script type="text/javascript">
                    (function (d, w, c) {
                        (w[c] = w[c] || []).push(function () {
                            try {
                                w.yaCounter15934891 = new Ya.Metrika({id:15934891,
                            webvisor:true,
                            clickmap:true,
                            trackLinks:true,
                            accurateTrackBounce:true});
                            } catch (e) {
                            }
                        });

                        var n = d.getElementsByTagName("script")[0],
                                s = d.createElement("script"),
                                f = function () {
                                    n.parentNode.insertBefore(s, n);
                                };
                        s.type = "text/javascript";
                        s.async = true;
                        s.src = (d.location.protocol == "https:" ? "https:" : "http:") + "//mc.yandex.ru/metrika/watch.js";

                        if (w.opera == "[object Opera]") {
                            d.addEventListener("DOMContentLoaded", f, false);
                        } else {
                            f();
                        }
                    })(document, window, "yandex_metrika_callbacks");
        </script>
        <noscript><div><img src="//mc.yandex.ru/watch/15934891" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
        <!-- /Yandex.Metrika counter -->
    </body>
</html>
