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
                <?php if ($this->oil->warehouse_tver + $this->oil->warehouse_snab + $this->oil->warehouse_snabfilt == 0) : ?>
                    <div style="margin: 20px 0 0 0;">
                        <p>Товар временно отсутствует на складе</p>
                    </div>
                <?php else : ?>
                    <div style="margin: 20px 0 0 0;">
                    <a class="add-less" href="javascript:{}">Меньше</a>
                    <?php if (isset($_SESSION['basket']['oil'][$this->oil->id])) { ?>
                        <?php $value = $_SESSION['basket']['oil'][$this->oil->id]; ?>
                        <div class="input-field" style="width: 42px;"><div><div>
                                    <input type="text" name="price" id="<?php echo $this->oil->id; ?>" value="<?php echo $value; ?>" onchange="changeAmount(this, 'oil', <?php echo $this->oil->id; ?>);" />
                            <input type="hidden" name="sumCount" id="sumCount<?php echo $this->oil->id; ?>" value="<?php echo $this->oil->warehouse_tver + $this->oil->warehouse_snab + $this->oil->warehouse_snabfilt; ?>" />												   
                        </div></div></div>
                    <?php } else { ?>
                        <div class="input-field" style="width: 42px;"><div><div>
                                    <input type="text" name="price" id="<?php echo $this->oil->id; ?>" value="1" />
                                    <input type="hidden" name="sumCount" id="sumCount<?php echo $this->oil->id; ?>" value="<?php echo $this->oil->warehouse_tver + $this->oil->warehouse_snab + $this->oil->warehouse_snabfilt; ?>" />												   
                        </div></div></div>
                    <?php } ?>
                    <a class="add-more" href="javascript:{}">Больше</a>  
                    </div>
                    <?php if ($this->auth_id) $onclick = 'addToBasket(this, \'oil\', ' . $this->oil->id . ');'; else $onclick = 'regCart();'; ?>                                
                    <a style="margin: 50px 0 0 85px;" onclick="<?php echo $onclick; ?>" href="javascript:{};" class="add-to-bask">В корзину</a>
                <?php endif; ?>                
            </div>
        </div>
    </div>
    <br style="clear: both;" />
    <?php if ($this->oil->info != '') : ?>
        <div class="oil-info" style="margin: 30px 0 0 0;"><?php echo $this->oil->info; ?></div>
    <?php endif; ?>
</div>
<script type="text/javascript">
    /*$(function(){
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
    })*/
</script>