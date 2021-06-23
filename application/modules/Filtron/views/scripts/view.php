<?php /* ?>
<h1 style="font-size: 26px; font-weight: 400; padding-top: 20px;"><?php echo $this->currentArticle['name']; ?></h1>
<div class="news-main">
    <div class="news-photo">
        <?php if ($this->currentArticle['picture'] != '') { ?>
        <a class="gallery" href="/<?php echo $this->currentArticle['picture']; ?>b.jpg"><img class="img-detailed" alt="" src="/<?php echo $this->currentArticle['picture']; ?>p.jpg" /></a>
        <?php } ?>
    </div>
    <span class="news-date" style="color: #939495; font-family: Arial; font-size: 11px; font-weight: normal;"><img src="/themes/default/images/newdesign/clock.png" /> <?php echo $this->Date($this->currentArticle['posted'], 'date'); ?></span>
    <span class="news-views"><img src="/themes/default/images/newdesign/eye.png" /> <?php echo $this->currentArticle['view']; ?></span>
    <div><?php if($this->currentArticle['text'] != '') echo $this->currentArticle['text']; else echo $this->currentArticle['short']; ?></div>
</div>
<?php */ ?>
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

    .progress-bar-primary {
        background-color: #2c4b9d;
        background: linear-gradient(to right, #0065b3, #ff3c00);
    }
    .progress {
        overflow: hidden;
        height: 20px;
        margin-bottom: 20px;
        background-color: #f5f5f5;
        border-radius: 4px;
        -webkit-box-shadow: inset 0 1px 2px rgba(0, 0, 0, 0.1);
        box-shadow: inset 0 1px 2px rgba(0, 0, 0, 0.1);
    }
    .progress-bar {
        float: left;
        width: 0%;
        height: 100%;
        font-size: 12px;
        line-height: 20px;
        color: #ffffff;
        text-align: center;
        background-color: #cccccc;
        -webkit-box-shadow: inset 0 -1px 0 rgba(0, 0, 0, 0.15);
        box-shadow: inset 0 -1px 0 rgba(0, 0, 0, 0.15);
        -webkit-transition: width 0.6s ease;
        transition: width 0.6s ease;
    }
    .progress-striped .progress-bar {
        background-image: -webkit-gradient(linear, 0 100%, 100% 0, color-stop(0.25, rgba(255, 255, 255, 0.15)), color-stop(0.25, transparent), color-stop(0.5, transparent), color-stop(0.5, rgba(255, 255, 255, 0.15)), color-stop(0.75, rgba(255, 255, 255, 0.15)), color-stop(0.75, transparent), to(transparent));
        background-image: -webkit-linear-gradient(45deg, rgba(255, 255, 255, 0.15) 25%, transparent 25%, transparent 50%, rgba(255, 255, 255, 0.15) 50%, rgba(255, 255, 255, 0.15) 75%, transparent 75%, transparent);
        background-image: -moz-linear-gradient(45deg, rgba(255, 255, 255, 0.15) 25%, transparent 25%, transparent 50%, rgba(255, 255, 255, 0.15) 50%, rgba(255, 255, 255, 0.15) 75%, transparent 75%, transparent);
        background-image: linear-gradient(45deg, rgba(255, 255, 255, 0.15) 25%, transparent 25%, transparent 50%, rgba(255, 255, 255, 0.15) 50%, rgba(255, 255, 255, 0.15) 75%, transparent 75%, transparent);
        background-size: 40px 40px;
    }
    .progress.active .progress-bar {
        -webkit-animation: progress-bar-stripes 2s linear infinite;
        animation: progress-bar-stripes 2s linear infinite;
    }
    .progress-bar-success {
        background-color: #5cb85c;
    }
    .progress-striped .progress-bar-success {
        background-image: -webkit-gradient(linear, 0 100%, 100% 0, color-stop(0.25, rgba(255, 255, 255, 0.15)), color-stop(0.25, transparent), color-stop(0.5, transparent), color-stop(0.5, rgba(255, 255, 255, 0.15)), color-stop(0.75, rgba(255, 255, 255, 0.15)), color-stop(0.75, transparent), to(transparent));
        background-image: -webkit-linear-gradient(45deg, rgba(255, 255, 255, 0.15) 25%, transparent 25%, transparent 50%, rgba(255, 255, 255, 0.15) 50%, rgba(255, 255, 255, 0.15) 75%, transparent 75%, transparent);
        background-image: -moz-linear-gradient(45deg, rgba(255, 255, 255, 0.15) 25%, transparent 25%, transparent 50%, rgba(255, 255, 255, 0.15) 50%, rgba(255, 255, 255, 0.15) 75%, transparent 75%, transparent);
        background-image: linear-gradient(45deg, rgba(255, 255, 255, 0.15) 25%, transparent 25%, transparent 50%, rgba(255, 255, 255, 0.15) 50%, rgba(255, 255, 255, 0.15) 75%, transparent 75%, transparent);
    }
    .progress-bar-info {
        background-color: #5bc0de;
    }
    .progress-striped .progress-bar-info {
        background-image: -webkit-gradient(linear, 0 100%, 100% 0, color-stop(0.25, rgba(255, 255, 255, 0.15)), color-stop(0.25, transparent), color-stop(0.5, transparent), color-stop(0.5, rgba(255, 255, 255, 0.15)), color-stop(0.75, rgba(255, 255, 255, 0.15)), color-stop(0.75, transparent), to(transparent));
        background-image: -webkit-linear-gradient(45deg, rgba(255, 255, 255, 0.15) 25%, transparent 25%, transparent 50%, rgba(255, 255, 255, 0.15) 50%, rgba(255, 255, 255, 0.15) 75%, transparent 75%, transparent);
        background-image: -moz-linear-gradient(45deg, rgba(255, 255, 255, 0.15) 25%, transparent 25%, transparent 50%, rgba(255, 255, 255, 0.15) 50%, rgba(255, 255, 255, 0.15) 75%, transparent 75%, transparent);
        background-image: linear-gradient(45deg, rgba(255, 255, 255, 0.15) 25%, transparent 25%, transparent 50%, rgba(255, 255, 255, 0.15) 50%, rgba(255, 255, 255, 0.15) 75%, transparent 75%, transparent);
    }
    .progress-bar-warning {
        background-color: #f0ad4e;
    }
    .progress-striped .progress-bar-warning {
        background-image: -webkit-gradient(linear, 0 100%, 100% 0, color-stop(0.25, rgba(255, 255, 255, 0.15)), color-stop(0.25, transparent), color-stop(0.5, transparent), color-stop(0.5, rgba(255, 255, 255, 0.15)), color-stop(0.75, rgba(255, 255, 255, 0.15)), color-stop(0.75, transparent), to(transparent));
        background-image: -webkit-linear-gradient(45deg, rgba(255, 255, 255, 0.15) 25%, transparent 25%, transparent 50%, rgba(255, 255, 255, 0.15) 50%, rgba(255, 255, 255, 0.15) 75%, transparent 75%, transparent);
        background-image: -moz-linear-gradient(45deg, rgba(255, 255, 255, 0.15) 25%, transparent 25%, transparent 50%, rgba(255, 255, 255, 0.15) 50%, rgba(255, 255, 255, 0.15) 75%, transparent 75%, transparent);
        background-image: linear-gradient(45deg, rgba(255, 255, 255, 0.15) 25%, transparent 25%, transparent 50%, rgba(255, 255, 255, 0.15) 50%, rgba(255, 255, 255, 0.15) 75%, transparent 75%, transparent);
    }
    .progress-bar-danger {
        background-color: #d9534f;
    }
    .progress-striped .progress-bar-danger {
        background-image: -webkit-gradient(linear, 0 100%, 100% 0, color-stop(0.25, rgba(255, 255, 255, 0.15)), color-stop(0.25, transparent), color-stop(0.5, transparent), color-stop(0.5, rgba(255, 255, 255, 0.15)), color-stop(0.75, rgba(255, 255, 255, 0.15)), color-stop(0.75, transparent), to(transparent));
        background-image: -webkit-linear-gradient(45deg, rgba(255, 255, 255, 0.15) 25%, transparent 25%, transparent 50%, rgba(255, 255, 255, 0.15) 50%, rgba(255, 255, 255, 0.15) 75%, transparent 75%, transparent);
        background-image: -moz-linear-gradient(45deg, rgba(255, 255, 255, 0.15) 25%, transparent 25%, transparent 50%, rgba(255, 255, 255, 0.15) 50%, rgba(255, 255, 255, 0.15) 75%, transparent 75%, transparent);
        background-image: linear-gradient(45deg, rgba(255, 255, 255, 0.15) 25%, transparent 25%, transparent 50%, rgba(255, 255, 255, 0.15) 50%, rgba(255, 255, 255, 0.15) 75%, transparent 75%, transparent);
    }
    .oil-info h3 {
        font-size: 22px; margin: 15px 0 10px;     clear: left;
    }
    .oil-info p {
        font-size: 15px; margin-bottom: 15px;
    }
    .oil-info img {
        max-width: 100%;
    }
    .oil-info ul:not(.slides):not(.flex-direction-nav):not(.adn-questions__list) li:not(.adn-questions__list__item) {
        padding-left: 20px; list-style: none;
        position: relative; margin-bottom: 5px; line-height: 20px;
    }
    .oil-info ul:not(.slides):not(.flex-direction-nav) li:before {
        content: "/"; background-image: linear-gradient(48deg, #303395, #28efef);
        font-family: "GraphikLC-Bold"; font-size: 25px;
        font-style: normal; font-stretch: normal;
        line-height: 1; letter-spacing: normal;
        -webkit-background-clip: text; -webkit-text-fill-color: transparent;
        position: absolute; left: 3px; top: -1px; font-weight: bold;
    }
    .catalog.detail .friction_units{
        margin-top: 60px;
        margin-bottom: -20px;
    }

    .catalog.detail ul{
        padding-left: 0px;
    }
    .catalog.detail ul:not(.slides):not(.flex-direction-nav):not(.adn-questions__list) li:not(.adn-questions__list__item){    
        padding-left: 20px;
        list-style: none;
        position: relative;
        margin-bottom: 5px;
        line-height: 20px;
    }
    .catalog.detail ul:not(.slides):not(.flex-direction-nav) li:before {
        content: "/";
        background-image: linear-gradient(48deg, #303395, #28efef);
        font-family: "GraphikLC-Bold";
        font-size: 25px;
        font-style: normal;
        font-stretch: normal;
        line-height: 1;
        letter-spacing: normal;
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        position: absolute;
        left: 3px;
        top: -1px;
    }
    .oil-info ul.cat-about__list li {
        padding-left: 0px !important; float: left; width: 27%; min-height: 152px;
    }
    .oil-info ul.cat-about__list li:before {
        display: none;
    }
    .catalog.detail .point_body .point_content ul{
        padding-left: 20px;
        list-style-type: disc;
    }
    .catalog.detail .point_body .point_content ul li{padding-left: 0px !important; list-style-type: disc !important; line-height: 24px !important; margin-bottom: 0px !important;}
    .catalog.detail .point_body .point_content ul li:before {display: none}
    .dropDInfoText {
        display: none;
    }
    .dropDInfo:hover {
        cursor: pointer;
    }
    .dropDInfo:after {
        content: "\2630"; padding: 0 0 0 1em;
    }
</style>
<?php if ($this->priceType == 'recom') { 
if ($this->oil['price_rec'] != 0) { 
$price = $this->oil['price_rec'];
} elseif ($this->oil['price_rec'] == 0 && $this->oil['env'] > 0) { 
$price = $this->oil['price_base']; 
} else {
$price = 'noshow';
}
} elseif ($this->priceType == 'base') { 
$price = $this->oil['price_base']; 
} ?>
<script>
    $(document).ready(function () {
        $( "h3.dropDInfo" ).click(function() {
            $(this).next().toggle();
        });
    });
</script>
<div class="oil-detailed">
    <h1><?php echo $this->oil->name; ?></h1>
    <div class="catalog-item">
        <div class="item-left" style="margin-right: 100px; width: 30%;">
            <div class="item-photo" style="border: 0px;">
                <?php if ($this->oil->picture != '') : ?>
                <a class="gallery" href="/<?php echo $this->oil->picture; ?>b.jpg">
                    <img alt="" src="/<?php echo $this->oil->picture; ?>b.jpg"/>
                </a>
                <?php else : ?>
                <img alt="" style="width: 115px; height: 145px;" src="/themes/default/images/catalog-item.png"/>
                <?php endif; ?>
            </div>
        </div>
        <div class="item-info">            
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
                        <?php if (isset($_SESSION['basket']['filtron'][$this->oil->id])) : ?>
                            <?php $value = $_SESSION['basket']['filtron'][$this->oil->id]; ?>
                            <div class="input-field" style="width: 42px;">
                                <div><div>
                                    <input type="text" name="price" id="<?php echo $this->oil->id; ?>" value="<?php echo $value; ?>" onchange="changeAmount(this, 'filtron', <?php echo $this->oil->id; ?>);" />
                                    <input type="hidden" name="sumCount" id="sumCount<?php echo $this->oil->id; ?>" value="<?php echo $this->oil->warehouse_tver + $this->oil->warehouse_snab + $this->oil->warehouse_snabfilt; ?>" />
                                </div></div>
                            </div>
                        <?php else : ?>
                            <div class="input-field" style="width: 42px;"><div><div>
                                        <input type="text" name="price" id="<?php echo $this->oil->id; ?>" value="1" />
                                        <input type="hidden" name="sumCount" id="sumCount<?php echo $this->oil->id; ?>" value="<?php echo $this->oil->warehouse_tver + $this->oil->warehouse_snab + $this->oil->warehouse_snabfilt; ?>" />
                            </div></div></div>
                        <?php endif; ?>
                        <a class="add-more" href="javascript:{}">Больше</a>  
                    </div>
                    <?php if ($this->auth_id) {
                    $onclick = 'addToBasket(this, \'filtron\', ' . $this->oil->id . ');';
                    } else { 
                    $onclick = 'regCart();'; 
                    } ?>                                
                    <a style="margin: 50px 0 0 180px;" onclick="<?php echo $onclick; ?>" href="javascript:{};" class="add-to-bask">В корзину</a>
                <?php endif; ?>
                <div style="margin: 2em 0;">
                    <p><?php echo $this->oil['short']; ?></p>
                </div>
            </div>
        </div>
    </div>
</div>
<br style="clear: both;" />
<?php if ($this->oil->info != '') : ?>
<div class="oil-info" style="margin: 0;">
    <?php echo $this->oil->info; ?>
</div>
<?php endif; ?>
</div>
    <script type="text/javascript">
/*$(function(){
            $('.add-more, .add-less').click(function() {
    var input = $(this).parent().find('input');
    var amount = 0;
    if ($(this).attr('class') == 'add-more') {
    alert(input.val());
    amount = parseInt(input.val() - 1) + 1;
        } else {
            if (parseInt(input.val()) > 1) {
    amount = parseInt(input.val() - 1) - 1;
    } else {
            amount = 1;
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