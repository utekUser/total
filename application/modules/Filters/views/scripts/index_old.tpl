<?php /* if (false) { */if ($_SERVER['REMOTE_ADDR'] == '78.140.9.206' || $_SERVER['REMOTE_ADDR'] == '46.161.158.155' || $_SERVER['REMOTE_ADDR'] == '88.204.72.104' || $_SERVER['REMOTE_ADDR'] == '95.170.159.81') { ?>
<style>
    input.plus-item {
        background: url(/themes/default/images/newdesign/plusy.png) no-repeat 0 0;
        width: 31px;
        height: 31px;
    }
    input.plus-item:hover {
        background: url(/themes/default/images/newdesign/plusy.png) no-repeat 0 0;
    }
    .search-form-button input {
        background: url("/themes/default/images/newdesign/find.png") top center;
        border: 0;
        width: 71px;
        height: 31px;
        cursor: pointer;
        font-size: 0;
    }
    .search-form-button input:hover {
        background: url("/themes/default/images/newdesign/findh.png") top center;
    }
    .oilMenuBlock {
        margin: 15px 0;
    }
    .oilMenuBlock a {
        color: #8b8c8d; font-size: 16px; font-family: OfficinaSansCBook; text-transform: uppercase;
        margin: 0 15px 0 0;        
        cursor: pointer;
        text-decoration: none;
    }
    .oilMenuBlock a:hover {
        border-bottom: 3px #fee248 solid;
    }
    .section-info {
        color: #8b8c8d;
        font-family: Arial;
        font-size: 12px;
        margin-top: 30px;
    }
</style>
<div class="oilMenuBlock">
    <a href="/filters/masljanye/" title="Маслянные фильтры">маслянные</a>
    <a href="/filters/toplivnye/" title="Топливные фильтры">топливные</a>
    <a href="/filters/vozdushnye/" title="Воздушные фильтры">воздушные</a>
    <a href="/filters/salonnye/" title="Салонные фильтры">салонные</a>
    <a href="/filters/aksessuary/" title="Аксессуары">аксессуары</a>
    <a href="/filters/drugie-filtry/" title="Другие фильтры">другие</a>
</div>
<div class="search-blockN">
    <div style="font-size:11px; color:#999; text-align:right; margin:10px 5px 0 0;">Последнее обновление прайса: <?php echo $this->Date(date('Y-m-d H:i:s', $this->task), 'datetimesign'); ?></div>
    <div class="grey-corner-mN">
        <div class="search-opt">
            <form action="/filters/" method="get">
                <div class="search-form-labelN">Быстрый поиск
                    <div style="font-family: Arial; color: #8b8c8d; font-size: 12px; text-transform: none;">
                        Введите до 50-ти наименований, каждое в новой строке
                    </div>                    
                </div>                
                <?php if ($this->codeOpt) { ?>
                <?php $i = 1; ?>
                <?php foreach ($this->codeOpt as $codeOpt) { ?>
                <?php if ($i == 1) { ?>
                <div class="search-opt-row">
                    <div class="input-fieldN" style="float: left;">
                        <input type="text" name="codeOpt[]" value="<?php echo $codeOpt; ?>" />
                    </div>
                    <div class="search-item-plus" style="margin-left: -31px;">
                        <input type="button" class="plus-item" id="add-search-field" value="" />
                    </div>
                    <div class="search-form-button">
                        <input type="submit" value="Найти" />
                    </div>
                </div>
                <?php } else { ?>
                <div class="search-opt-row">
                    <div class="input-fieldN" style="float: left;">
                        <input type="text" name="codeOpt[]" value="<?php echo $codeOpt; ?>" />
                    </div>
                    <div>
                        <input type="button" value="" class="minus-item">
                    </div>
                </div>
                <?php } ?>
                <?php $i++; ?>
                <?php } ?>
                <?php } else { ?>
                <div class="search-opt-row">
                    <div class="input-fieldN" style="float: left;">
                        <input type="text" name="codeOpt[]" />
                    </div>
                    <div class="search-item-plus" style="margin-left: -31px;">
                        <input type="button" class="plus-item" id="add-search-field" value="" />
                    </div>
                    <div class="search-form-button">
                        <input type="submit" value="Отправить" />
                    </div>
                </div>	
                <?php } ?>
                <div class="filter-mannN">
                    <a href="https://www.mann-hummel.com/mf_prodkata_eur/index.html?ktlg_page=01&ktlg_lang=8&ktlg_subpage=00&ktlg_01_mrksl=0&ktlg_01_mdrsl=&ktlg_01_modsl=0&ktlg_01_fzkat=&ktlg_01_fzart=1" rel="nofollow" target="_blank">
                        Online сервис по подбору фильтров MANN-FILTER
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
<?php if (!$this->code && !$this->codeOpt && !$this->page) { ?>
<?php if ($this->filterDescr && Engine_Cms::displayContent(8)) { ?>
<div class="section-info"><?php echo Engine_Cms::displayContent(8); ?></div>
<?php } ?>
<?php if ($this->sectionInfo != '') { ?>
<div class="section-info"><?php echo $this->sectionInfo; ?></div>
<?php } ?>
<?php } ?>

<div class="search-results">
    <div class="item-info">
        <h2 style="color: #8b8c8d; font-size: 18px; font-family: OfficinaSansCBook; text-transform: uppercase;">Результаты поиска</h2>
        <?php // echo 'Найдено: ' . $this->paginator->getTotalItemCount(); ?>
        <?php if (sizeof($this->paginator)) { ?>
        <input type="hidden" id="catalog-type" value="filter" />
        <div class="oiltableN">
            <style>
                th, td {
                    padding: 8px;
                }
                a.delete-item {
                    display: block;
                    width: 85px;
                    height: 31px;
                    background: url(/themes/default/images/newdesign/delete.png) no-repeat 0 0;
                    font-size: 0;
                    margin: 0 auto;
                }
                a.delete-item:hover {
                    background-position: 0 0;
                }
                a.add-to-bask {
                    display: block;
                    width: 96px;
                    height: 31px;
                    background: url(/themes/default/images/newdesign/tobasket.png) no-repeat 0 0;
                    font-size: 0;
                    margin: 0 auto;
                }
                a.add-to-bask:hover {
                    background: url(/themes/default/images/newdesign/tobasketh.png) no-repeat 0 0;
                }
                a.add-more {
                    width: 20px;
                    height: 20px;
                    display: block;
                    font-size: 0;
                    float: left;
                    background: url(/themes/default/images/newdesign/plus.png) no-repeat 0 0;
                    margin: 0 3px;
                }
                a.add-more:hover {
                    background: url(/themes/default/images/newdesign/plush.png) no-repeat 0 0;
                    background-position: 0 0;
                }
                a.add-less {
                    width: 20px;
                    height: 20px;
                    display: block;
                    font-size: 0;
                    float: left;
                    background: url(/themes/default/images/newdesign/minus.png) no-repeat 0 0;
                    margin: 0 3px;
                }
                a.add-less:hover { 
                    background: url(/themes/default/images/newdesign/minush.png) no-repeat 0 0;
                    background-position: 0px 0px;
                }
                div.input-field, div.input-field div, div.input-field div div {
                    padding: 0;
                    background: none;
                }
                .input-field div div input {
                    width: 40px;
                    padding: 0;
                    text-align: center;
                    background-color: #f8f8f8;
                    border: #cfcfcf 1px solid;
                    border-radius: 0px;
                    margin: 0px 0 0 0;
                    height: 18px;
                    line-height: 18px;
                }
                .filterTitle a {
                    color: #00aaf0;
                    font-family: Arial;
                    font-size: 12px;
                    text-transform: uppercase;
                    text-decoration: underline;
                    cursor: pointer;
                }
                .filterTitle a:hover {
                    color: #03597d;
                }
            </style>
            <table>
                <thead>
                    <tr>
                        <th width="130">Наименование</th>
                        <th>Наличие</th>
                        <th style="width: 150px;">Цена за (1 шт.)</th>
                        <th style="background: url(/themes/default/images/newdesign/baggray2.png) 7px 6px no-repeat">Количество</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($this->paginator as $filter) { ?>
                    <?php 
                    if ($this->priceType == 'recom') { 
                    if ($filter['price_rec'] != 0) { 
                    $price = $filter['price_rec'];
                    } else { 
                    $price = $filter['price_base']; 
                    } 
                    //            	    else {
                    //            	        $price = 'noshow';
                    //            	    }
                    } elseif ($this->priceType == 'base') { 
                    $price = $filter['price_base']; 
                    } 
                    ?>
                    <?php if ($price != 'noshow') { ?>
                    <tr>
                        <td class="filterTitle">
                            <?php
                            $preg = preg_match('/(MANN LUFTENTOELELEMENT|MANN)(.*)$/', $filter['invoice_name'], $matches);
                            $sFilter = trim($matches[2]);
                            ?>
                            <a href="https://www.mann-hummel.com/mf_prodkata_eur/index.html?ktlg_page=2&ktlg_subpage=01&ktlg_lang=8&ktlg_02_sFilter=<?php echo $sFilter; ?>" target="_blank">
                                <?php echo $filter['invoice_name']; ?>
                            </a>
                        </td>
                        <td class="item-price" style="padding: 0 10px 0 8px">
                            <p class="oilText">
                                <?php echo number_format($filter['env'], 0, ' ', ' '); ?>&nbsp;шт.
                            </p>
                            <?php /* <div style="position: relative; float: right;">
                            <?php
                            $env = (int) $filter['env'];
                            if ($env > 100) {
                            $style = " background-position: -225px 0px;";
                            } elseif ($env > 98) {
                            $style = " background-position: -209px 0px;";
                            } elseif ($env > 91) {
                            $style = " background-position: -194px 0px;";
                            } elseif ($env > 84) {
                            $style = " background-position: -179px 0px;";
                            } elseif ($env > 77) {
                            $style = " background-position: -164px 0px;";
                            } elseif ($env > 70) {
                            $style = " background-position: -149px 0px;";
                            } elseif ($env > 63) {
                            $style = " background-position: -134px 0px;";
                            } elseif ($env > 56) {
                            $style = " background-position: -119px 0px;";
                            } elseif ($env > 49) {
                            $style = " background-position: -104px 0px;";
                            } elseif ($env > 42) {
                            $style = " background-position: -89px 0px;";
                            } elseif ($env > 35) {
                            $style = " background-position: -73px 0px;";
                            } elseif ($env > 28) {
                            $style = " background-position: -59px 0px;";
                            } elseif ($env > 21) {
                            $style = " background-position: -45px 0px;";
                            } elseif ($env > 14) {
                            $style = " background-position: -29px 0px;";
                            } elseif ($env > 7) {
                            $style = " background-position: -14px 0px;";
                            } elseif ($env > 0) {
                            $style = " background-position: 0 0px;";
                            } else {
                            $style = " background-position: -255px 0px;";
                            }
                            if ($env > 100) {
                            echo '<span style="display: block; float: left; color: #000; font-weight: normal; margin: 0 5px 0 0;">' . "> " . $env = 100 . '</span>';
                            echo '<span class="aCirc" style="display: block; float: left; background: url(\'/images/env.png\') no-repeat; width: 15px; height: 14px;' . $style . '"></span>';
                            } else {
                            echo '<span style="display: block; float: left; color: #000; font-weight: normal; margin: 0 5px 0 0;">' . $env . '</span>';
                            echo '<span class="aCirc" style="display: block; float: left; background: url(\'/images/env.png\') no-repeat; width: 15px; height: 14px;' . $style . '"></span>';
                            }
                            ?>
                            </div> */ ?>
                        </td>
                        <td class="item-price">
                            <p class="oilText"><?php echo $price; ?>&nbsp;руб.</p>
                        </td>
                        <td class="item-amount">
                            <a class="add-less" href="javascript:{}">Меньше</a>
                            <?php if (isset($_SESSION['basket']['filter'][$filter['id']])) { ?>
                            <?php $value = $_SESSION['basket']['filter'][$filter['id']]; ?>
                            <div class="input-field" style="width: 42px;"><div><div><input type="text" name="price" id="<?php echo $filter['id']; ?>" value="<?php echo $value; ?>" onchange="changeAmount(this, 'filter', <?php echo $filter['id']; ?> );" /></div></div></div>
                            <?php } else { ?>
                            <div class="input-field" style="width: 42px;"><div><div><input type="text" name="price" id="<?php echo $filter['id']; ?>" value="1" /></div></div></div>
                            <?php } ?>
                            <a class="add-more" href="javascript:{}">Больше</a>
                        </td>
                        <td class="item-action">
                            <?php if ($this->auth_id) { ?>
                            <?php if (isset($_SESSION['basket']['filter'][$filter['id']])) { ?>
                            <a class="delete-item" href="javascript:{};" onclick="deleteItem(this, 'filter', <?php echo $filter['id']; ?> );">Удалить</a>
                            <?php } else { ?>
                            <a class="add-to-bask" href="javascript:{};" onclick="addItem(this, 'filter', <?php echo $filter['id']; ?> );">В корзину</a>
                            <?php } ?>
                            <?php } else { ?>
                            <a class="add-to-bask" href="javascript:{};" onclick="regCart();">В корзину</a>
                            <?php } ?>
                        </td>
                    </tr>
                    <?php } ?>
                    <?php } ?>
                </tbody>
            </table>
        </div>
        <?php } else { ?>
        <p>К сожалению, ничего не найдено.</p>



        <?php
        if (isset($_GET['codeOpt'][0])) {
        $searchRequest = htmlspecialchars($_GET['codeOpt'][0]);
        }
        $category = ' (категория: фильтра)';
        ?>
        <div class="desired">
            <h1>Желаемый продукт</h1>
            <p>Товар с вхождением <strong>«<?php echo $searchRequest; ?>»</strong> — не найден. Возможно сейчас его нет в наличии на складе.</p>
            <p>Вы можете добавить его в заказ в раздел «Желаемая продукция» — наши менеджеры свяжутся с Вами, подтвердят возможность выполнения заказа и сообщат о возможных сроках доставки.</p>

            <form class="desired-ajax-form" action="/catalog/desired/">
                <button type="submit" class="btn btn-success">Добавить</button>
                <div class="desired-ajax-form__input"><input name="name" type="text" class=""form-control placeholder="Наименование товара"<?php if (isset($searchRequest)) { echo 'value="' . $searchRequest . $category . '"'; } ?>></div>
            </form>
            <div id="desiredtable">
                <table style="width: 100%">
                    <thead>
                        <tr>
                            <td style="font-weight: 700">Наименование желаемого товара для заказа</td>
                            <td>&nbsp;</td>
                        </tr>
                    </thead>
                    <?php foreach ($this->desired as $product) { ?>
                    <tr>
                        <td><?php echo htmlspecialchars($product['name']); ?></td>
                        <td style="width: 50px; text-align: right"><a id="desired<?php echo $product['id']; ?>" style="margin: 25px 0px 0 0;" href="/delete/">Удалить</a></td>
                    </tr>
                    <?php } ?>
                </table>
            </div>
        </div>
        <?php } ?>

    </div>
</div>

<?php if($this->paginator->count() > 1) { ?>
<div class="newPaginator">
    <?php echo $this->paginationControl($this->paginator, 'Sliding', 'user-page.tpl'); ?>
</div>
<?php } ?>
<script type="text/javascript">
            $(function(){
            $('#add-search-field').bind('click', addSearchField);
                    $('.minus-item').bind('click', removeModelList);
                    $('#srchEx').bind('click', findExample);
            })
            function addSearchField (e) {
            var parent = $(this).parent().parent ();
                    var new_div = parent.clone();
                    new_div.find('.input-field input').val("");
                    new_div.appendTo (parent.parent ());
                    new_div.find ('.search-form-button').remove();
                    new_div.find ('.plus-item').removeAttr('id');
                    new_div.find ('.plus-item').removeClass("plus-item").addClass("minus-item").bind('click', removeModelList);
            }
    function removeModelList (e) {
    $(this).parent().parent().remove();
    }
    function findExample (e) {
    var example = $(this).text();
            $('#srchField').val(example);
    }
</script>
<?php } else { ?>
<div class="path">
    <a href="/"><img alt="" src="/themes/default/images/house.png" /></a>
    <?php if ($this->sectionName) { ?>
    <a href="/filters/">Каталог фильтров</a>
    <span><?php echo $this->sectionName; ?></span>
    <?php } else { ?>
    <span><?php echo Engine_Application::getPageHeader(); ?></span>
    <?php } ?>
</div>
<h1><?php echo Engine_Application::getPageHeader(); ?></h1>
<div style="font-size:11px; color:#999; text-align:right; margin:10px 0 -5px 0;">Последнее обновление прайса: <?php echo $this->Date(date('Y-m-d H:i:s', $this->task), 'datetimesign'); ?></div>
<?php if (false) { ?>
<!--<div class="catalog-item item-filtr">
        <div class="item-left">
                <div class="item-photo">
                        <a href="#"><img alt="" src="/themes/default/images/oils.jpg"/></a>
                </div>
                <div class="see-pictures">
                        <div class="img-pager-l">
                                <div class="img-pager-r">
                                        <div class="img-pager-m">
                                                
                                                        <a href="#">1</a>
                                                        <a class="active" href="#">2</a>
                                                        <a href="#">3</a>
                                                
                                        </div>
                                </div>
                        </div>
                </div>
        </div>
        <div class="item-info">
                Топливные фильтры MANN - идеальная чистота топлива благодаря современной системе впрыскивания<br /><br />
                
                Главным условием того, чтобы при эксплуатации автомобиля не возникало проблем, является чистота топлива. 
                Топливо подается в систему впрыскивания или в карбюратор топливным насосом. Наличие частиц грязи в топливе 
                вызывает повышенный износ, особенно в современных системах впрыскивания. Наличие воды в топливе также может 
                стать причиной серьезных повреждений в результате коррозии. В некоторых случаях это может привести к полному 
                отказу системы впрыскивания и к остановке автомобиля. Износ системы впрыскивания или карбюратора приводит к 
                значительному увеличению потребления топлива и к ухудшению эксплуатационных характеристик двигателя.<br /><br />
                
                Для современных систем впрыскивания, таких как форсунка "common rail" или насос-форсунка требуются 
                новаторские решения, специально приспособленные к новым конструкциям. MANN-FILTER отвечает на новые 
                требования автомобильной промышленности, серией топливных фильтров высшего качества.<br /><br />
                
                Функции топливных фильтров MANN:<br />
            Топливные фильтры MANN обеспечивают эксплуатационную надежность двигателей<br />
             они надежно защищают и чрезвычайно чувствительный механизм впрыскивания, и карбюратор<br />
             они удаляют из топлива нежелательные загрязнения, такие как пыль, ржавчина и вода, являющиеся причиной 
             износа<br />
             они защищают систему впрыскивания от коррозии<br /><br />
                Чтобы эффективно выполнять все эти функции, фильтры должны осуществлять максимальную очистку и отличаться 
                высоким качеством. Разумеется, фильтры MANN-FILTER удовлетворяет всем этим  требованиям. 
                Серия фильтрующих средств „Multigrade“  - шаг  к созданию фильтров будущего.

        </div>
</div>-->
<?php } ?>
<div class="search-block">
    <div class="grey-corner-tl">
        <div class="grey-corner-tr">
            <div class="grey-corner-tm"></div>
        </div>
    </div>
    <div class="grey-corner-m">
        <?php /* ?>
        <div class="search-form">
            <form action="/filters/" method="get">
                <div class="search-form-label">Поиск по номеру</div>
                <div class="search-number-field">
                    <div class="input-field"><div><div><input id="srchField" type="text" name="code" value="<?php echo $this->code; ?>"/></div></div></div>
                    <div class="search-example">Например: <a id="srchEx" href="javascript:void(0)">MH 55</a></div>
                </div>
                <div class="search-form-button"><input type="submit" value="Отправить" /></div>
            </form>
        </div>
        <div class="razd-grey"></div>
        <?php */ ?>
        <div class="filter-mann">
            <img alt="" src="/themes/default/images/mann-logo.png" />
            <span><a href="https://www.mann-hummel.com/mf_prodkata_eur/index.html?ktlg_page=01&ktlg_lang=8&ktlg_subpage=00&ktlg_01_mrksl=0&ktlg_01_mdrsl=&ktlg_01_modsl=0&ktlg_01_fzkat=&ktlg_01_fzart=1" rel="nofollow" target="_blank">Online сервис по подбору фильтров MANN-FILTER</a></span>
        </div>
        <div class="razd-grey"></div>
        <div class="search-opt">
            <form action="/filters/" method="get">
                <?php /* ?><div class="search-opt-title">Оптовый выбор:</div><?php */ ?>
                <div>Введите до 50-ти наименований, каждое в новой строке</div>
                <?php if ($this->codeOpt) { ?>
                <?php $i = 1; ?>
                <?php foreach ($this->codeOpt as $codeOpt) { ?>
                <?php if ($i == 1) { ?>
                <div class="search-opt-row">
                    <?php /* ?><div>Наименование:</div><?php */ ?>
                    <div class="input-field"><div><div><input type="text" name="codeOpt[]" value="<?php echo $codeOpt; ?>" /></div></div></div>
                    <div class="search-item-plus"><input type="button" class="plus-item" id="add-search-field" value="" /></div>
                    <div class="search-form-button"><input type="submit" value="Найти" /></div>
                </div>
                <?php } else { ?>
                <div class="search-opt-row">
                    <?php /* ?><div>Наименование:</div><?php */ ?>
                    <div class="input-field"><div><div><input type="text" name="codeOpt[]" value="<?php echo $codeOpt; ?>" /></div></div></div>
                    <div><input type="button" value="" class="minus-item"></div>
                </div>
                <?php } ?>
                <?php $i++; ?>
                <?php } ?>
                <?php } else { ?>
                <div class="search-opt-row">
                    <?php /* ?><div>Наименование:</div><?php */ ?>
                    <div class="input-field"><div><div><input type="text" name="codeOpt[]" /></div></div></div>
                    <div class="search-item-plus"><input type="button" class="plus-item" id="add-search-field" value="" /></div>
                    <div class="search-form-button"><input type="submit" value="Отправить" /></div>
                </div>	
                <?php } ?>
            </form>
        </div>
    </div>
    <div class="grey-corner-bl">
        <div class="grey-corner-br">
            <div class="grey-corner-bm"></div>
        </div>
    </div>
</div>
<?php if (!$this->code && !$this->codeOpt && !$this->page) { ?>
<?php if ($this->filterDescr && Engine_Cms::displayContent(8)) { ?>
<div class="section-info"><?php echo Engine_Cms::displayContent(8); ?></div>
<?php } ?>
<?php if ($this->sectionInfo != '') { ?>
<div class="section-info"><?php echo $this->sectionInfo; ?></div>
<?php } ?>
<?php } ?>

<div class="search-results">
    <div class="item-info">
        <div class="to-basket">
            <span id="basket-link"><?php echo Basket_Models_Control::getCount(); ?></span>
            <a href="/basket/"><img alt="Корзина" src="/themes/default/images/basket.png" /></a>
        </div>
        <h2>Результаты поиска</h2>
        <?php // echo 'Найдено: ' . $this->paginator->getTotalItemCount(); ?>
        <?php if (sizeof($this->paginator)) { ?>
        <input type="hidden" id="catalog-type" value="filter" />
        <table width="100%" cellspacing="0" cellpadding="0" border="0" class="order-history">
            <tr>
                <th>&nbsp;</th>
                <th class="item-name">Наименование</th>
                <!--<th>Упаковка/л.</th>-->
                <th style="text-align: right;">Наличие</th>
                <th>Цена/руб.</th>
                <th class="item-amount" colspan="2">Количество</th>
            </tr>
            <?php foreach ($this->paginator as $filter) { ?>
            <?php 
            if ($this->priceType == 'recom') { 
            if ($filter['price_rec'] != 0) { 
            $price = $filter['price_rec'];
            } else { 
            $price = $filter['price_base']; 
            } 
            //            	    else {
            //            	        $price = 'noshow';
            //            	    }
            } elseif ($this->priceType == 'base') { 
            $price = $filter['price_base']; 
            } 
            ?>
            <?php if ($price != 'noshow') { ?>
            <tr>
                <td class="item-check">
                    <?php if ($this->auth_id) { ?>
                    <?php if (isset($_SESSION['basket']['filter'][$filter['id']])) { ?>
                    <input type="checkbox" class="rem-input" onclick="deleteItem(this, 'filter', <?php echo $filter['id']; ?> );" checked="checked"/>
                    <?php } else { ?>
                    <input type="checkbox" class="add-input" onclick="addItem(this, 'filter', <?php echo $filter['id']; ?> );" />
                    <?php } ?>
                    <?php } else { ?>
                    <input type="checkbox" onclick="regCart();"/>
                    <?php } ?>

                </td>
                <td class="item-name">
                    <?php
                    $preg = preg_match('/(MANN LUFTENTOELELEMENT|MANN)(.*)$/', $filter['invoice_name'], $matches);
                    $sFilter = trim($matches[2]);
                    ?>
                    <a href="https://www.mann-hummel.com/mf_prodkata_eur/index.html?ktlg_page=2&ktlg_subpage=01&ktlg_lang=8&ktlg_02_sFilter=<?php echo $sFilter; ?>" target="_blank"><?php echo $filter['invoice_name']; ?><img src="/themes/default/images/new_window_icon.png" /></a>
                </td>
                <!--<td class="item-volume">1 л.</td>-->
                <td class="item-price" style="padding: 0 10px 0 8px">
                    <div style="position: relative; float: right;">
                        <?php
                        $env = (int) $filter['env'];
                        if ($env > 100) {
                        $style = " background-position: -225px 0px;";
                        } elseif ($env > 98) {
                        $style = " background-position: -209px 0px;";
                        } elseif ($env > 91) {
                        $style = " background-position: -194px 0px;";
                        } elseif ($env > 84) {
                        $style = " background-position: -179px 0px;";
                        } elseif ($env > 77) {
                        $style = " background-position: -164px 0px;";
                        } elseif ($env > 70) {
                        $style = " background-position: -149px 0px;";
                        } elseif ($env > 63) {
                        $style = " background-position: -134px 0px;";
                        } elseif ($env > 56) {
                        $style = " background-position: -119px 0px;";
                        } elseif ($env > 49) {
                        $style = " background-position: -104px 0px;";
                        } elseif ($env > 42) {
                        $style = " background-position: -89px 0px;";
                        } elseif ($env > 35) {
                        $style = " background-position: -73px 0px;";
                        } elseif ($env > 28) {
                        $style = " background-position: -59px 0px;";
                        } elseif ($env > 21) {
                        $style = " background-position: -45px 0px;";
                        } elseif ($env > 14) {
                        $style = " background-position: -29px 0px;";
                        } elseif ($env > 7) {
                        $style = " background-position: -14px 0px;";
                        } elseif ($env > 0) {
                        $style = " background-position: 0 0px;";
                        } else {
                        $style = " background-position: -255px 0px;";
                        }
                        if ($env > 100) {
                        echo '<span style="display: block; float: left; color: #000; font-weight: normal; margin: 0 5px 0 0;">' . "> " . $env = 100 . '</span>';
                        echo '<span class="aCirc" style="display: block; float: left; background: url(\'/images/env.png\') no-repeat; width: 15px; height: 14px;' . $style . '"></span>';
                        } else {
                        echo '<span style="display: block; float: left; color: #000; font-weight: normal; margin: 0 5px 0 0;">' . $env . '</span>';
                        echo '<span class="aCirc" style="display: block; float: left; background: url(\'/images/env.png\') no-repeat; width: 15px; height: 14px;' . $style . '"></span>';
                        }
                        ?>
                    </div>
                </td>
                <td class="item-price">
                    <span><?php echo $price; ?> руб.</span>
                </td>
                <td class="item-amount">
                    <a class="add-less" href="javascript:{}">Меньше</a>
                    <?php if (isset($_SESSION['basket']['filter'][$filter['id']])) { ?>
                    <?php $value = $_SESSION['basket']['filter'][$filter['id']]; ?>
                    <div class="input-field"><div><div><input type="text" name="price" id="<?php echo $filter['id']; ?>" value="<?php echo $value; ?>" onchange="changeAmount(this, 'filter', <?php echo $filter['id']; ?> );" /></div></div></div>
                    <?php } else { ?>
                    <div class="input-field"><div><div><input type="text" name="price" id="<?php echo $filter['id']; ?>" value="1" /></div></div></div>
                    <?php } ?>
                    <a class="add-more" href="javascript:{}">Больше</a>
                </td>
                <td class="item-action">
                    <?php if ($this->auth_id) { ?>
                    <?php if (isset($_SESSION['basket']['filter'][$filter['id']])) { ?>
                    <a class="delete-item" href="javascript:{};" onclick="deleteItem(this, 'filter', <?php echo $filter['id']; ?> );">Удалить</a>
                    <?php } else { ?>
                    <a class="add-to-bask" href="javascript:{};" onclick="addItem(this, 'filter', <?php echo $filter['id']; ?> );">В корзину</a>
                    <?php } ?>
                    <?php } else { ?>
                    <a class="add-to-bask" href="javascript:{};" onclick="regCart();">В корзину</a>
                    <?php } ?>
                </td>
            </tr>
            <?php } ?>
            <?php } ?>
        </table>
        <?php } else { ?>
        <p>К сожалению, ничего не найдено.</p>



        <?php
        if (isset($_GET['codeOpt'][0])) {
        $searchRequest = htmlspecialchars($_GET['codeOpt'][0]);
        }
        $category = ' (категория: фильтра)';
        ?>
        <div class="desired">
            <h1>Желаемый продукт</h1>
            <p>Товар с вхождением <strong>«<?php echo $searchRequest; ?>»</strong> — не найден. Возможно сейчас его нет в наличии на складе.</p>
            <p>Вы можете добавить его в заказ в раздел «Желаемая продукция» — наши менеджеры свяжутся с Вами, подтвердят возможность выполнения заказа и сообщат о возможных сроках доставки.</p>

            <form class="desired-ajax-form" action="/catalog/desired/">
                <button type="submit" class="btn btn-success">Добавить</button>
                <div class="desired-ajax-form__input"><input name="name" type="text" class=""form-control placeholder="Наименование товара"<?php if (isset($searchRequest)) { echo 'value="' . $searchRequest . $category . '"'; } ?>></div>
            </form>
            <div id="desiredtable">
                <table style="width: 100%">
                    <thead>
                        <tr>
                            <td style="font-weight: 700">Наименование желаемого товара для заказа</td>
                            <td>&nbsp;</td>
                        </tr>
                    </thead>
                    <?php foreach ($this->desired as $product) { ?>
                    <tr>
                        <td><?php echo htmlspecialchars($product['name']); ?></td>
                        <td style="width: 50px; text-align: right"><a id="desired<?php echo $product['id']; ?>" style="margin: 25px 0px 0 0;" href="/delete/">Удалить</a></td>
                    </tr>
                    <?php } ?>
                </table>
            </div>
        </div>



        <?php } ?>

    </div>
</div>

<?php if($this->paginator->count() > 1) { ?>
<div class="page-razd"></div>
<?php echo $this->paginationControl($this->paginator, 'Sliding', 'user-page.tpl'); ?>
<?php } ?>
<?php if (false) { ?>
<!--<div class="current-order">
        <div class="current-order-title">
                <a href="/basket/"><img alt="" src="/themes/default/images/basket.png" /></a>
                <span>Текущий заказ</span>
        </div>
        <div class="page-razd"></div>
        <div class="item-info">
                <table width="100%" cellspacing="0" cellpadding="0" border="0" class="order-history">
                        <tr>
                                <th>Наименование товара / Артикул</th>
                                <th>Упаковка/л.</th>
                                <th>Цена/руб.</th>
                                <th colspan="2">Количество</th>
                        </tr>
                        <tr>
                                <td class="item-name"><a href="#">Топливный фильтр W 713/16 QUA EN 9000 0W30</a></td>
                                <td class="item-volume">1 л.</td>
                                <td class="item-price"><span>209 руб.</span></td>
                                <td class="item-amount"><div class="input-field"><div><div><input type="text" value="1" /></div></div></div></td>
                                <td class="item-action"><a class="delete-item" href="#">В корзину</a></td>
                        </tr>
                        <tr>
                                <td class="item-name"><a href="#">Трансмиссионное масло Transmission SYN FE 75W-90 QUA EN 9000 0W30</a></td>
                                <td>4 л.</td>
                                <td><span>1800 руб.</span></td>
                                <td><div class="input-field"><div><div><input type="text" value="1" /></div></div></div></td>
                                <td><a class="delete-item" href="#">В корзину</a></td>
                        </tr>
                        <tr>
                                <td class="item-name"><a href="#">Трансмиссионное масло Transmission SYN FE 75W-90 QUA EN 9000 0W30</a></td>
                                <td>4 л.</td>
                                <td><span>1800 руб.</span></td>
                                <td><div class="input-field"><div><div><input type="text" value="1" /></div></div></div></td>
                                <td><a class="delete-item" href="#">В корзину</a></td>
                        </tr>
                        <tr>
                                <td class="item-name"><a href="#">Трансмиссионное масло Transmission SYN FE 75W-90 QUA EN 9000 0W30</a></td>
                                <td>4 л.</td>
                                <td><span>1800 руб.</span></td>
                                <td><div class="input-field"><div><div><input type="text" value="1" /></div></div></div></td>
                                <td><a class="delete-item" href="#">В корзину</a></td>
                        </tr>
                </table>
        </div>
</div>
<div class="page-razd"></div>
<div class="total-sum">Итоговая сумма: <span>6500 руб.</span></div>
<div class="page-razd"></div>
<div class="appr-order"><a href="#">Оформить заказ</a></div>
-->
<?php } ?>
<script type="text/javascript">
            $(function(){
            $('#add-search-field').bind('click', addSearchField);
                    $('.minus-item').bind('click', removeModelList);
                    $('#srchEx').bind('click', findExample);
//    $('.add-more, .add-less').click(function() {
//        var input = $(this).parent().find('input');
//        if ($(this).attr('class') == 'add-more') {
//            var amount = parseInt(input.val()) + 1;
//        } else {
//            if (parseInt(input.val()) > 1) {
//                var amount = parseInt(input.val()) - 1;
//            } else {
//                var amount = 1;
//            }
//        }
//        input.val(amount);
//        var action = $(this).parent().parent().find('.item-action a').attr('class');
//        if (action == 'delete-item') {
//            var type = $('#catalog-type').val();
//            var id = $(input).attr('id')
//            changeAmount($(input), type, id);
//        }
//    });
            })
            function addSearchField (e) {
            var parent = $(this).parent().parent ();
                    var new_div = parent.clone();
                    new_div.find('.input-field input').val("");
                    new_div.appendTo (parent.parent ());
                    new_div.find ('.search-form-button').remove();
                    new_div.find ('.plus-item').removeAttr('id');
                    new_div.find ('.plus-item').removeClass("plus-item").addClass("minus-item").bind('click', removeModelList);
            }
    function removeModelList (e) {
    $(this).parent().parent().remove();
    }
    function findExample (e) {
    var example = $(this).text();
            $('#srchField').val(example);
    }
</script>
<?php } ?>