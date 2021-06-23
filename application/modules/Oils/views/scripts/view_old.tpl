<?php if ($_SERVER['REMOTE_ADDR'] == '78.140.9.206' || $_SERVER['REMOTE_ADDR'] == '46.161.158.155' || $_SERVER['REMOTE_ADDR'] == '88.204.72.104' || $_SERVER['REMOTE_ADDR'] == '95.170.159.81') { ?>
<style>
    .oil-detailed h1 {
        font-weight: normal;
    }
    .oil-info p {
        color: #8b8c8d;
        font-family: Arial;
        font-size: 12px;
    }
    .oilAr p span {
        color: #8b8c8d;
        font-family: Arial;
        font-size: 12px;
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
    .input-field {
        float: left;
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
</style>
<div class="oil-detailed">
    <h1><?php echo $this->oil->name; ?></h1>
    <div class="catalog-item">
        <div class="item-left" style="margin-right: 100px;">
            <div class="item-photo" style="border: 0px;">
                <?php if ($this->oil->picture != '') { ?>
                <a class="gallery" href="/<?php echo $this->oil->picture; ?>b.jpg"><img alt="" style="width: 115px; height: 145px;" src="/<?php echo $this->oil->picture; ?>p.jpg"/></a>
                <?php } else { ?>
                <img alt="" style="width: 115px; height: 145px;" src="/themes/default/images/catalog-item.png"/>
                <?php } ?>
            </div>
        </div>
        <div class="item-info">
            <?php 
            if ($this->priceType == 'recom') { 
            if ($this->oil['price_rec'] != 0) { 
            $price = $this->oil['price_rec'];
            } elseif ($this->oil['price_rec'] == 0 && $this->oil['env'] > 0) { 
            $price = $this->oil['price_base']; 
            } else {
            $price = 'noshow';
            }
            } elseif ($this->priceType == 'base') { 
            $price = $this->oil['price_base']; 
            } 
            ?>
            <div class="oilAr">
                <p><span style="font-weight: bold;">Артикул: <?php echo 60000 + $this->oil->id; ?></span></p>
                <p><span style="font-weight: bold;">Цена: <?php echo $price; ?> руб.</span></p>
                <div style="margin: 20px 0 0 0;">
                <a class="add-less" href="javascript:{}">Меньше</a>
                <?php if (isset($_SESSION['basket']['oil'][$this->oil->id])) { ?>
                <?php $value = $_SESSION['basket']['oil'][$this->oil->id]; ?>
                <div class="input-field" style="width: 42px;"><div><div><input type="text" name="price" id="<?php echo $this->oil->id; ?>" value="<?php echo $value; ?>" onchange="changeAmount(this, 'oil', <?php echo $this->oil->id; ?>);" /></div></div></div>
                <?php } else { ?>
                <div class="input-field" style="width: 42px;"><div><div><input type="text" name="price" id="<?php echo $this->oil->id; ?>" value="1" /></div></div></div>
                <?php } ?>
                <a class="add-more" href="javascript:{}">Больше</a>  
                </div>
                <?php if ($this->auth_id) $onclick = 'addToBasket(this, \'oil\', ' . $this->oil->id . ');'; else $onclick = 'regCart();'; ?>                                
                <a style="margin: 50px 0 0 85px;" onclick="<?php echo $onclick; ?>" href="javascript:{};" class="add-to-bask">В корзину</a>
            </div>
        </div>
    </div>
</div>
<br style="clear: both;" />
<?php if ($this->oil->info != '') { ?>

<div class="oil-info" style="margin: 30px 0 0 0;"><?php echo $this->oil->info; ?></div>
<?php } ?>
</div>
<script type="text/javascript">
    $(function(){
        $('.add-more, .add-less').click(function() {
            var input = $(this).parent().find('input');            
            if ($(this).attr('class') == 'add-more') {
                var amount = parseInt(input.val()) + 1;
            } else {             
                if (parseInt(input.val()) > 1) {
                    var amount = parseInt(input.val()) - 1;
                } else {
                    var amount = 1;
                }
            }
            input.val(amount);
            var action = $(this).parent().parent().find('.item-action a').attr('class');
            if (action == 'delete-item') {
                var type = $('#catalog-type').val();
                var id = $(input).attr('id')
                changeAmount($(input), type, id);
            }
        });
    })
</script>

<?php } else { ?>
<div class="path">
    <a href="/"><img alt="" src="/themes/default/images/house.png" /></a>
    <a href="/oils/">Автомасла</a>
    <span><?php echo $this->oil->name; ?></span>
</div>
<?php /* ?>
<div class="search-block">
    <div class="grey-corner-tl">
        <div class="grey-corner-tr">
            <div class="grey-corner-tm"></div>
        </div>
    </div>
    <div class="grey-corner-m">
        <div class="search-form">
            <form action="" method="post">
                <div class="search-form-label">Быстрый поиск</div>
                <div class="search-form-field input-field"><div><div><input type="text" /></div></div></div>
                <div class="search-form-button"><input type="image" src="/themes/default/images/search-button.png" /></div>
            </form>
        </div>
        <div class="razd-grey"></div>
        <div class="search-form-options">
            <form action="" method="post">
                <div class="option-row">
                    <div class="option-title">Тип масла:</div>
                    <div class="option-type"><input type="checkbox" /><span><a href="#">Синтетическое</a></span></div>
                    <div class="option-type"><input type="checkbox" /><span><a href="#">Полусинтетическое</a></span></div>
                    <div class="option-type"><input type="checkbox" /><span><a href="#">Минеральное</a></span></div>
                </div>
                <div class="option-row">
                    <div class="option-title">Тип двигателя:</div>
                    <div class="option-type"><input type="checkbox" /><span><a href="#">Дизельный</a></span></div>
                    <div class="option-type"><input type="checkbox" /><span><a href="#">Бензиновый</a></span></div>
                </div>
                <div class="option-row">
                    <div class="option-title">Применение:</div>
                    <div class="option-type"><input type="checkbox" /><span><a href="#">Моторные</a></span></div>
                    <div class="option-type"><input type="checkbox" /><span><a href="#">Трансмиссионные</a></span></div>
                    <div class="option-type"><input type="checkbox" /><span><a href="#">Тормозные</a></span></div>
                </div>
                <div class="options-search"><input type="image" src="/themes/default/images/find.png"/></div>                  
            </form>
        </div>
    </div>
    <div class="grey-corner-bl">
        <div class="grey-corner-br">
            <div class="grey-corner-bm"></div>
        </div>
    </div>
</div>
<?php */ ?>
<div class="oil-detailed">
    <h1><?php echo $this->oil->name; ?></h1>
    <div class="catalog-item">
        <div class="item-left">
            <div class="item-photo">
                <?php if ($this->oil->picture != '') { ?>
                <a class="gallery" href="/<?php echo $this->oil->picture; ?>b.jpg"><img alt="" src="/<?php echo $this->oil->picture; ?>p.jpg"/></a>
                <?php } else { ?>
                <img alt="" src="/themes/default/images/catalog-item.png"/>
                <?php } ?>
            </div>
            <?php /*?><div class="item-detailed"><a href="#">Подробнее</a></div><?php*/ ?>
        </div>
        <div class="item-info">
            <?php if (false) { ?>
            <div class="page-razd"></div>
            <div class="oil-type">
                <div>Тип: <a href="#">синтетическое</a></div>
                <div>Применение: <a href="#">трансмиссионное</a></div>
            </div>
            <?php } ?>
            <div class="page-razd"></div>
            <?php 
            if ($this->priceType == 'recom') { 
            if ($this->oil['price_rec'] != 0) { 
            $price = $this->oil['price_rec'];
            } elseif ($this->oil['price_rec'] == 0 && $this->oil['env'] > 0) { 
            $price = $this->oil['price_base']; 
            } else {
            $price = 'noshow';
            }
            } elseif ($this->priceType == 'base') { 
            $price = $this->oil['price_base']; 
            } 
            ?>
            <table width="100%" cellspacing="0" cellpadding="0" border="0" class="order-history">
                <tr>
                    <th>Артикул</th>
                    <th>Цена/руб.</th>
                    <th colspan="2">Количество</th>
                </tr>
                <tr>
                    <td class="item-name"><?php echo 60000 + $this->oil->id; ?></td>
                    <td class="item-price"><span><?php echo $price; //echo $this->oil->price_base; ?> руб.</span></td>
                    <td class="item-amount">
                        <a class="add-less" href="javascript:{}">Меньше</a>
                        <?php if (isset($_SESSION['basket']['oil'][$this->oil->id])) { ?>
                        <?php $value = $_SESSION['basket']['oil'][$this->oil->id]; ?>
                        <div class="input-field"><div><div><input type="text" name="price" id="<?php echo $this->oil->id; ?>" value="<?php echo $value; ?>" onchange="changeAmount(this, 'oil', <?php echo $this->oil->id; ?>);" /></div></div></div>
                        <?php } else { ?>
                        <div class="input-field"><div><div><input type="text" name="price" id="<?php echo $this->oil->id; ?>" value="1" /></div></div></div>
                        <?php } ?>
                        <a class="add-more" href="javascript:{}">Больше</a>
                    </td>
                    <?php if ($this->auth_id) $onclick = 'addToBasket(this, \'oil\', ' . $this->oil->id . ');'; else $onclick = 'regCart();'; ?>
                    <td class="item-action"><a onclick="<?php echo $onclick; ?>" href="javascript:{};" class="add-to-bask">В корзину</a></td>
                </tr>
            </table>
        </div>
    </div>
    <?php if ($this->oil->info != '') { ?>
    <div class="page-razd"></div>
    <div class="oil-info"><?php echo $this->oil->info; ?></div>
    <?php } ?>
    <div class="page-razd"></div>
    <div class="back"><a href="/oils/">Вернуться</a></div>
</div>
<?php /* ?>		
<div class="current-order">
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
<?php */ ?>
<script type="text/javascript">
            $(function(){
            $('.add-more, .add-less').click(function() {
            var input = $(this).parent().find('input');
                    if ($(this).attr('class') == 'add-more') {
            var amount = parseInt(input.val()) + 1;
            } else {             if (parseInt(input.val()) > 1) {
            var amount = parseInt(input.val()) - 1;
            } else {
            var amount = 1;
            }
            }
            input.val(amount);
                    var action = $(this).parent().parent().find('.item-action a').attr('class');
                    if (action == 'delete-item') {
            var type = $('#catalog-type').val();
                    var id = $(input).attr('id')
                    changeAmount($(input), type, id);
            }
            });
            })
</script>
<?php } ?>