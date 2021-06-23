<style>
	.tabs{padding:0 0 10px}
	.tabs-list{list-style:none;margin:0;overflow:hidden;padding:0}
	.tabs-list .tab-name{text-align:center;font-size:16px;float:left;padding:8px 5px;color:#8b8c8d;text-decoration:none;cursor:pointer;text-transform:uppercase}
	.tabs-list .tab-name:first-child{border-left:none;padding:8px 5px 8px 0}
	.tabs-list .tab-name:last-child{border-right:none}
	.tabs-list .tab-active{color: #646363; font-size: 16px; font-family: OfficinaSansCBook;background:#fff;text-decoration:none;cursor:default}
	.tabs-list .tab-active span, .tabs-list span:hover{border-bottom: 3px #fee248 solid;}
	.tabs-block{background:#fff;padding:10px 0 12px;min-height:200px}
	.tabs-block .tab_block{display:none}
	.tabs-block .tab_block.block_active{display:block}
	.tabs-block .info-table td{border-top:1px solid #e8e9eb;padding:6px 10px}
	.tabs-block .info-table .odd{background:#f7f7f7}
</style>
<script>
	$(function () {
        //Переключение вкладок
        var $container = $('.js-tabs li');
        $container.click(function () {
            var $id = $(this).attr('id');
            $container.removeClass('tab-active');
            $(this).addClass('tab-active');
            $('.tabs .tab_block').removeClass('block_active');
            $('#content_' + $id).addClass('block_active');
        });
    });
</script>
<div class="tabs">
	<ul class="tabs-list tabs_menu js-tabs">
		<li id="tab_1" class="tab-name tab tab-active"><span>Воздушные</span></li>				
		<li id="tab_2" class="tab-name tab"><span>Масляные</span></li>				
		<li id="tab_3" class="tab-name tab"><span>Топливные</span></li>				
		<li id="tab_4" class="tab-name tab"><span>Салонные</span></li>				
		<li id="tab_5" class="tab-name tab"><span>Другие</span></li>				
	</ul>
	<div class="tabs-block tabs_content">
		<div id="content_tab_1" class="tab_block block_active">
			<div class="header-text">
				<div>Воздушный фильтр улавливает пыль из воздуха, всасываемого двигателем и помогает поддерживать надлежащую мощность двигателя, крутящий момент и низкий расход топлива.</div>
				<p class="jquery-typographer jquery-typographer-orphan"><strong>Если бы не фильтр, загрязненный воздух с уличной пылью и цветочной пыльцой попадал бы непосредственно в камеру сгорания.</strong> Загрязняющие вещества в двигателе оказывают такое действие, как наждачная бумага и вызывают повреждение поршневых колец, вкладышей подшипников и цилиндров.<br>
					&nbsp;
				</p>
			</div>
		</div>
		<div id="content_tab_2" class="tab_block">
			<div class="header-text">
				<p class="jquery-typographer jquery-typographer-orphan"><em>Масляный фильтр </em>очищает <em>масло</em>,<em> циркулирующее </em>в двигателе, захватывая все частицы, <em>образующиеся </em>в <em>процессе </em>износа подвижных частей, а также твердые частицы и остатки от <em>процесса сгорания</em>. <strong>Если бы не фильтр, загрязненное масло привело бы к ускоренному износу подвижных деталей и увеличению риска повреждения двигателя.</strong></p>
			</div>
		</div>
		<div id="content_tab_3" class="tab_block">
			<div class="header-text">
				<p class="jquery-typographer jquery-typographer-orphan">Топливный фильтр улавливает загрязняющие вещества, содержащиеся в топливе, в частности, ржавчину, металлическую стружку, пыль и другие твердые частицы. <strong>Последствиями несоответствующей фильтрации топлива могут быть: </strong></p>
				<ul>
					<li><strong>значительное снижение мощности двигателя </strong></li>
					<li><strong>нарушение или прерывание подачи топлива </strong></li>
					<li><strong>повреждение компонентов топливной системы</strong></li>
				</ul>
			</div>
		</div>
		<div id="content_tab_4" class="tab_block">
			<div class="header-text">
				<p class="jquery-typographer jquery-typographer-orphan">Салонный фильтр очищает воздух в салоне автомобиля, которым дышат пассажиры и водитель. <strong>Работа салонного воздушного фильтра очень важна, поскольку загрязненный воздух значительно влияет на наше здоровье и концентрацию во время вождения.</strong> Загрязненный воздух является очень серьезной угрозой. Согласно официальным данным Европейского агентства по окружающей среде:</p>
				<ul>
					<li><strong>Из-за загрязненного воздуха только в Европе ежегодно преждевременно умирают более 460 000 человек.</strong></li>
					<li>Проблема чрезмерно загрязненного воздуха касается 80% жителей всех городских районов Европы</li>
				</ul>
			</div>
		</div>
		<div id="content_tab_5" class="tab_block">
			<div class="product-info-text">
				<h2>ОСУШИТЕЛИ ВОЗДУХА</h2>
				<div>Осушители воздуха наиболее часто используются в пневматических тормозных системах грузовых автомобилей и автобусов. Их функция заключается в поглощении влаги, грязи и масляных капель, содержащихся в сжатом воздухе. Таким образом, осушители воздуха защищают пневматическую систему от коррозии и обеспечивают надлежащую работу, особенно в зимних условиях. Во время прохождения воздуха через осушитель происходит поглощение, то есть химическое связывание содержащейся в нем влаги с помощью специальных гранул с высокой гигроскопичностью. Использование осушителей воздуха оказывает влияние на увеличение срока службы элементов пневматической системы.</div>
			</div>
			<br>
			<div class="product-info-text">
				<h2>ФИЛЬТРЫ МОЧЕВИНЫ</h2>
				<div>В ответ на все более жесткие стандарты в области выбросов выхлопных газов, в транспортных средствах все чаще используется система SCR (селективного каталитического восстановления). Её цель состоит в том, чтобы уменьшить количество выбросов вредных выхлопных газов путем впрыска в катализатор специального водного раствора мочевины. Фильтры мочевины FILTRON улавливают примеси, содержащиеся в растворе мочевины, благодаря чему защищают от износа форсунки систем SCR и способствуют эффективному снижению вредных выбросов.</div>
			</div>
			<br>
			<div class="product-info-text">
				<h2>ФИЛЬТРЫ ОХЛАЖДАЮЩЕЙ ЖИДКОСТИ</h2>
				<div>Фильтры охлаждающей жидкости используются в больших дизельных двигателях грузовиков и эксплуатируемой техники. Их основная задача заключается в фильтрации охлаждающей жидкости и эффективном улавливании твердых примесей. В большинстве фильтров жидкостей содержатся активные вещества - ингибиторы коррозии, которые постепенно выпускаются в охлаждающую жидкость и дополняют уровень разлагающихся во время эксплуатации добавок, поддерживая на постоянном, высоком уровне теплопроводность жидкости, а также ее антикоррозийные и антикавитационные свойства.</div>
			</div>
		</div>
	</div>
</div>