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
    .section-info {
        color: #8b8c8d;
        font-family: Arial;
        font-size: 12px;
        margin-top: 30px;
    }
</style>
<div class="search-blockN">
    <div style="float: right; font-size:11px; color:#999; text-align:right; margin: 10px 5px 0 0;">Последнее обновление прайса: <?php echo $this->Date(date('Y-m-d H:i:s', $this->task), 'datetimesign'); ?></div>
    <div class="grey-corner-mN">
        <div class="search-opt">
            <form action="/plug/" method="get">
                <div class="search-form-labelN">Быстрый поиск
                    <div style="font-family: Arial; color: #8b8c8d; font-size: 12px; text-transform: none;">
                        Введите до 50-ти наименований, каждое в новой строке
                    </div>                    
                </div>
                <?php if ($this->code) { ?>
                <?php $i = 1; ?>
                <?php foreach ($this->code as $code) { ?>
                <?php if ($i == 1) { ?>
                <div class="search-opt-row">
                    <div class="input-fieldN" style="float: left;"><input type="text" name="code[]" value="<?php echo $code; ?>" /></div>
                    <div class="search-item-plus" style="margin-left: -31px;"><input type="button" class="plus-item" id="add-search-field" value="" /></div>
                    <div class="search-form-button"><input type="submit" value="Найти" /></div>
                </div>
                <?php } else { ?>
                <div class="search-opt-row">
                    <div class="input-fieldN" style="float: left;"><input type="text" name="code[]" value="<?php echo $code; ?>" /></div>
                    <div><input type="button" value="" class="minus-item"></div>
                </div>
                <?php } ?>
                <?php $i++; ?>
                <?php } ?>
                <?php } else { ?>
                <div class="search-opt-row">
                    <div class="input-fieldN" style="float: left;"><input type="text" name="code[]" /></div>
                    <div class="search-item-plus" style="margin-left: -31px;"><input type="button" class="plus-item" id="add-search-field" value="" /></div>
                    <div class="search-form-button"><input type="submit" value="Отправить" /></div>
                </div>
                <?php } ?>
            </form>
        </div>
        <div class="filter-mannN">
            <a target="_blank" title="Online сервис по подбору продукции NGK" rel="nofollow" href="http://www.ngk.de/nc/ru/podbor-produkcii/">Online сервис по подбору продукции NGK</a>
        </div>
    </div>
</div>

<?php if (!isset($_GET['code'])) { ?>
<div class="razd-grey"></div>
<?php if (Engine_Cms::displayContent(9))     { ?>
<div class="section-info"><?php echo Engine_Cms::displayContent(9); ?></div>
<?php } ?>
<div class="razd-grey"></div>
<?php } ?>

<div class="search-results">
    <div class="item-info">
        <h2 style="color: #8b8c8d; font-size: 18px; font-family: OfficinaSansCBook; text-transform: uppercase;">Результаты поиска</h2>
        <?php if (sizeof($this->paginator)) { ?>
        <input type="hidden" id="catalog-type" value="plug" />
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
                    <?php foreach ($this->paginator as $plug) { ?>
                    <?php
                    if ($this->priceType != 'base') {
                    if ($plug['price_' . $this->priceType] != 0.00) {
                    $price = $plug['price_' . $this->priceType];
                    } else {
                    $price = $plug['price_base'];
                    }
                    //    			    else {
                    //    			        $price = 'noshow';
                    //    			    }
                    } else {
                    $price = $plug['price_base'];
                    }
                    //    			else {
                    //			        $price = 'noshow';
                    //			    }
                    //                if ($this->priceType == 'ng3') {
                    //                    if ($plug['price_rec'] != 0) {
                    //                        $price = $plug['price_rec'];
                    //            	    } elseif ($plug['price_rec'] == 0 && $plug['env'] > 0) {
                    //                        $price = $plug['price_base'];
                    //            	    } else {
                    //            	        $price = 'noshow';
                    //            	    }
                    //                } elseif ($this->priceType == 'base') {
                    //                    $price = $plug['price_base'];
                    //                }
                    ?>
                    <?php if ($price != 'noshow') { ?>
                    <tr>
                        <td class="filterTitle"><a href="#"><?php echo $plug['invoice_name']; ?></a></td>
                        <td class="item-price">
                            <p class="oilText"><?php echo number_format($plug['env'], 0, ' ', ' '); ?>&nbsp;шт.</p>
                        </td>
                        <td class="item-price">
                            <p class="oilText"><?php echo $price; ?>&nbsp;руб.</p>
                        </td>
                        <td class="item-amount">
                            <a class="add-less" href="javascript:{}">Меньше</a>
                            <?php if (isset($_SESSION['basket']['plug'][$plug['id']])) { ?>
                            <?php $value = $_SESSION['basket']['plug'][$plug['id']]; ?>
                            <div class="input-field" style="width: 42px;"><div><div><input type="text" name="price" id="<?php echo $plug['id']; ?>" value="<?php echo $value; ?>" onchange="changeAmount(this, 'plug', <?php echo $plug['id']; ?> );" /></div></div></div>
                            <?php } else { ?>
                            <div class="input-field" style="width: 42px;"><div><div><input type="text" name="price" id="<?php echo $plug['id']; ?>" value="1" /></div></div></div>
                            <?php } ?>
                            <a class="add-more" href="javascript:{}">Больше</a>
                        </td>
                        <td class="item-action">
                            <?php if ($this->auth_id) { ?>
                            <?php if (isset($_SESSION['basket']['plug'][$plug['id']])) { ?>
                            <a class="delete-item" href="javascript:{};" onclick="deleteItem(this, 'plug', <?php echo $plug['id']; ?> );">Удалить</a>
                            <?php } else { ?>
                            <a class="add-to-bask" href="javascript:{};" onclick="addItem(this, 'plug', <?php echo $plug['id']; ?> );">В корзину</a>
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
        if (isset($_GET['code'][0])) {
        $searchRequest = htmlspecialchars($_GET['code'][0]);
        }
        $category = ' (категория: свечи)';
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
<div style="float: right; font-size:11px; color:#999; text-align:right; margin: 0">Последнее обновление прайса: <?php echo $this->Date(date('Y-m-d H:i:s', $this->task), 'datetimesign'); ?></div>

<div class="path">
    <a href="/"><img alt="" src="/themes/default/images/house.png" /></a>
    <span>Свечи NGK</span>
</div>
<h1 style="font-size: 26px; font-weight: 400;">Свечи NGK</h1>

<div style="border-radius: 5px 5px 5px 5px; background: #F2EFEF;" class="search-block">
    <div style="background: none;" class="grey-corner-m">
        <div class="search-opt">
            <form action="/plug/" method="get">
                <div>Введите до 50-ти наименований, каждое в новой строке</div>
                <?php if ($this->code) { ?>
                <?php $i = 1; ?>
                <?php foreach ($this->code as $code) { ?>
                <?php if ($i == 1) { ?>
                <div class="search-opt-row">
                    <div class="input-field"><div><div><input type="text" name="code[]" value="<?php echo $code; ?>" /></div></div></div>
                    <div class="search-item-plus"><input type="button" class="plus-item" id="add-search-field" value="" /></div>
                    <div class="search-form-button"><input type="submit" value="Найти" /></div>
                </div>
                <?php } else { ?>
                <div class="search-opt-row">
                    <div class="input-field"><div><div><input type="text" name="code[]" value="<?php echo $code; ?>" /></div></div></div>
                    <div><input type="button" value="" class="minus-item"></div>
                </div>
                <?php } ?>
                <?php $i++; ?>
                <?php } ?>
                <?php } else { ?>
                <div class="search-opt-row">
                    <div class="input-field"><div><div><input type="text" name="code[]" /></div></div></div>
                    <div class="search-item-plus"><input type="button" class="plus-item" id="add-search-field" value="" /></div>
                    <div class="search-form-button"><input type="submit" value="Отправить" /></div>
                </div>
                <?php } ?>
            </form>
        </div>

        <div class="razd-grey"></div>
        <div class="filter-mann">
            <span><a target="_blank" title="Online сервис по подбору продукции NGK" rel="nofollow" href="http://www.ngk.de/nc/ru/podbor-produkcii/">Online сервис по подбору продукции NGK</a></span>
        </div>
    </div>
</div>

<?php if (!isset($_GET['code'])) { ?>
<div class="razd-grey"></div>
<?php if (Engine_Cms::displayContent(9))     { ?>
<div class="section-info"><?php echo Engine_Cms::displayContent(9); ?></div>
<?php } ?>
<div class="razd-grey"></div>
<?php } ?>

<div class="search-results">
    <div class="item-info">
        <div class="to-basket">
            <span id="basket-link"><?php echo Basket_Models_Control::getCount(); ?></span>
            <a href="/basket/"><img alt="Корзина" src="/themes/default/images/basket.png" /></a>
        </div>
        <h2>Результаты поиска</h2>
        <?php if (sizeof($this->paginator)) { ?>
        <input type="hidden" id="catalog-type" value="plug" />
        <table width="100%" cellspacing="0" cellpadding="0" border="0" class="order-history">
            <tr>
                <th>&nbsp;</th>
                <th class="item-name">Наименование</th>
                <!--<th>Упаковка/л.</th>-->
                <th>Наличие</th>
                <th>Цена/руб.</th>
                <th class="item-amount" colspan="2">Количество</th>
            </tr>
            <?php foreach ($this->paginator as $plug) { ?>
            <?php
            if ($this->priceType != 'base') {
            if ($plug['price_' . $this->priceType] != 0.00) {
            $price = $plug['price_' . $this->priceType];
            } else {
            $price = $plug['price_base'];
            }
            //    			    else {
            //    			        $price = 'noshow';
            //    			    }
            } else {
            $price = $plug['price_base'];
            }
            //    			else {
            //			        $price = 'noshow';
            //			    }
            //                if ($this->priceType == 'ng3') {
            //                    if ($plug['price_rec'] != 0) {
            //                        $price = $plug['price_rec'];
            //            	    } elseif ($plug['price_rec'] == 0 && $plug['env'] > 0) {
            //                        $price = $plug['price_base'];
            //            	    } else {
            //            	        $price = 'noshow';
            //            	    }
            //                } elseif ($this->priceType == 'base') {
            //                    $price = $plug['price_base'];
            //                }
            ?>
            <?php if ($price != 'noshow') { ?>
            <tr>
                <td class="item-check">
                    <?php if ($this->auth_id) { ?>
                    <?php if (isset($_SESSION['basket']['plug'][$plug['id']])) { ?>
                    <input type="checkbox" class="rem-input" onclick="deleteItem(this, 'plug', <?php echo $plug['id']; ?> );" checked="checked"/>
                    <?php } else { ?>
                    <input type="checkbox" class="add-input" onclick="addItem(this, 'plug', <?php echo $plug['id']; ?> );" />
                    <?php } ?>
                    <?php } else { ?>
                    <input type="checkbox" onclick="regCart();"/>
                    <?php } ?>
                </td>
                <td class="item-name"><a href="#"><?php echo $plug['invoice_name']; ?></a></td>
                <!--<td class="item-volume">1 л.</td>-->
                <td class="item-price">
                    <?php echo number_format($plug['env'], 0, ' ', ' '); ?>
                </td>
                <td class="item-price">
                    <span><?php echo $price; ?> руб.</span>
                </td>
                <td class="item-amount">
                    <a class="add-less" href="javascript:{}">Меньше</a>
                    <?php if (isset($_SESSION['basket']['plug'][$plug['id']])) { ?>
                    <?php $value = $_SESSION['basket']['plug'][$plug['id']]; ?>
                    <div class="input-field"><div><div><input type="text" name="price" id="<?php echo $plug['id']; ?>" value="<?php echo $value; ?>" onchange="changeAmount(this, 'plug', <?php echo $plug['id']; ?> );" /></div></div></div>
                    <?php } else { ?>
                    <div class="input-field"><div><div><input type="text" name="price" id="<?php echo $plug['id']; ?>" value="1" /></div></div></div>
                    <?php } ?>
                    <a class="add-more" href="javascript:{}">Больше</a>
                </td>
                <td class="item-action">
                    <?php if ($this->auth_id) { ?>
                    <?php if (isset($_SESSION['basket']['plug'][$plug['id']])) { ?>
                    <a class="delete-item" href="javascript:{};" onclick="deleteItem(this, 'plug', <?php echo $plug['id']; ?> );">Удалить</a>
                    <?php } else { ?>
                    <a class="add-to-bask" href="javascript:{};" onclick="addItem(this, 'plug', <?php echo $plug['id']; ?> );">В корзину</a>
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
        if (isset($_GET['code'][0])) {
        $searchRequest = htmlspecialchars($_GET['code'][0]);
        }
        $category = ' (категория: свечи)';
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