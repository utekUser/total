<style>
    .formask {
        margin: 15px 0;
    }
    .inpNew input, .inpNew textarea {
        background: #ffffff;
        border: 1px solid #c3c3c3;
        border-radius: 2px;
        font-family: OfficinaSansCBook;
        font-size: 13px;
        font-weight: normal;
        height: 25px;
        padding: 4px 10px;
        width: 256px
    }
    .inpNew textarea {
        height: 120px;
        width: 335px;   
        padding: 10px;
    }
    .submitbuttonW {
        background: url(/themes/default/images/newdesign/send.png);
        width: 96px;
        height: 31px;
        border: 0px;
        font-size: 0px;
	cursor: pointer;
    }
    .submitbuttonW:hover {
        background: url(/themes/default/images/newdesign/sendh.png);
    }
</style>
<?php 
mb_internal_encoding('utf-8'); 
$chars = array('&nbsp;', '&iexcl;', '&cent;', '&pound;', '&curren;', '&yen;', '&brvbar;', '&sect;', '&uml;', '&copy;', '&ordf;', '&laquo;', '&not;', '&shy;', '&reg;', '&macr;', '&deg;', '&plusmn;', '&sup2;', '&sup3;', '&acute;', '&micro;', '&para;', '&middot;', '&cedil;', '&sup1;', '&ordm;', '&raquo;', '&frac14;', '&frac12;', '&frac34;', '&iquest;', '&times;', '&divide;');
?>
<div id='dim' style="display: none; position:absolute; top:50%; left:30%; background-color: #99F199; border: 1px solid lightblue; width: 450px; padding: 10px;">
    <h2>Ваша заявка принята. <br/> Скоро мы Вам позвоним.</h2>
</div>
<div style="display:none">            
    <div id="callmeForm" style="padding:30px; width: 345px;">
        <h1 style="text-transform: uppercase; font-size: 18px;font-family: OfficinaSansCBook;">Заказать обратный звонок</h1>
        <form method="post" action="/?callme=yes">
            <div class="formask inpNew">
                <input required="" placeholder="Имя:" name="callmenametotalby" type="text">
                <input style="display: none;" name="antispam" type="text">
				<input type="hidden" name="callmechartotalby" value="<?php echo $chars[array_rand($chars)]; ?>" /> 
            </div>
            <div class="formask inpNew">
                <input id="fromcontactphone" placeholder="Телефон:" name="callmephonetotalby" type="text">
            </div>
            <div class="formask inpNew">
                <textarea placeholder="Текст сообщения:" name="callmecommenttotalby" rows="5"></textarea>
            </div>
			<div class="g-recaptcha" data-sitekey="6LfqKxQUAAAAAMqF0JGAcIYmu3x29QU_RUG50ecK"></div>
            <p style="margin: 0 0 0 0; font-family: Arial; font-size: 12px; color: #8b8c8d;">Наши менеджеры свяжутся с Вами в ближайшее время</p>
            <input class="submitbuttonW" style="margin-top: 10px;" type="submit">
        </form>        
    </div>
	<div id="callmeFormByTime" style="padding:30px; width: 345px;">
        <h1 style="text-transform: uppercase; font-size: 18px;font-family: OfficinaSansCBook; margin: 0 0 50px 0;">Мы рады помочь Вам!</h1>
        <form method="post" action="/?callme=yes">
			<div style="width: 400px; overflow: auto; background: url('/files/stock/callboy.png') no-repeat 100% 0%; background-size: contain; height: 110px;">
				<p style="margin: -10px 0 0 0; font-family: Arial; font-size: 12px; color: #8b8c8d;">
					<br/><br/>Не можете найти на нашем сайте нужную<br/> информацию? Мы рады перезвонить Вам и помочь
				</p>
			</div>
			<br style="clear: left;" />
            <div class="formask inpNew">
                <input required="" placeholder="Имя*:" name="callmenametotalby" type="text">
                <input style="display: none;" name="antispam" type="text">
				<input type="hidden" name="callmechartotalby" value="<?php echo $chars[array_rand($chars)]; ?>" /> 
            </div>
            <div class="formask inpNew">
                <input required="" id="fromcontactphone" placeholder="Телефон*:" name="callmephonetotalby" type="text">
            </div>
			<div class="g-recaptcha" data-sitekey="6LfqKxQUAAAAAMqF0JGAcIYmu3x29QU_RUG50ecK"></div>
            <input class="submitbuttonW" style="margin-top: 10px;" type="submit">
        </form>        
    </div>
</div>
<div class="headerDiv hD1">
    <a href="/" title="Главная">
        <img src="/themes/default/images/newdesign/logo.png" style="width: 77px;" title="Логотип Томавтотрейд" alt="Логотип Томавтотрейд" />
    </a>
</div>
<div class="headerDiv hD2">
    <p class="hD2p1">томавтотрейд</p>
    <p class="hD2p2">Официальный дистрибьютор TOTAL Lubricants, MANN+HUMMEL, Coolstream</p>
</div>
<div class="headerDiv hD3">
    <p class="hD3p1">Оптовый отдел</p>
    <p class="hD3p2">(3822) 266-933, (3822) 266-866</p>
    <?php //if ($_SERVER['REMOTE_ADDR'] == '78.140.9.206' || $_SERVER['REMOTE_ADDR'] == '46.161.158.155' || $_SERVER['REMOTE_ADDR'] == '88.204.72.104' || $_SERVER['REMOTE_ADDR'] == '95.170.159.81') { ?>
    <p class="hD3p2" style="margin-top: 15px;">
        <a id="askq" class="inlineCallmeForm cboxElement" href="#callmeForm"
           style="font-family: OfficinaSansCBook; cursor: pointer; font-size: 14px; text-decoration: underline;">
            Заказать обратный звонок
        </a>
		<a id="askq1" class="inlineCallmeFormByTime cboxElement" href="#callmeFormByTime"
           style="display: none;">
            Заказать обратный звонок
        </a>
    </p>
    <?php //} ?>
</div>
<div class="headerDiv hD4">
    <p class="hD4p1">Розница:</p>
    <p class="hD4p2">(3822) 266-687</p>
</div>                
<?php //if ($auth1->hasIdentity()) { ?>
<div class="headerDiv hD5">
    <p class="hD4p2 fD4p1">г. Томск, ул. Тверская, 18</p>
    <p class="hD4p2 fD4p2"><a href="mailto:avr@mail.tomsknet.ru">avr@mail.tomsknet.ru</a></p>
    <?php /* <p class="hD5p1"><?php echo Basket_Models_Control::getCountI(); ?></p> */ ?>
</div>
<?php //} ?>