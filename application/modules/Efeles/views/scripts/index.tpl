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
</style>
<div class="artickle-path">Выбор раздела: <a href="/efeles/">Все разделы</a></div>
<div style="margin: 2em 0 1em; overflow: auto;">
    <?php foreach ($this->section as $sectionValue) : 
    if ($sectionValue['amount'] > 0) : ?>
    <div style="width: 45%; margin: 0 2em 1.0em 0; float: left;" <?php if($this->sectionName == $sectionValue['name']) { echo 'class="active"';}?> >
         <?php echo $this->Link('/efeles/' . $sectionValue['url'] . '/', $sectionValue['name'], $sectionValue['name']); ?>
         <span>(<?php echo $sectionValue['amount']; ?>)</span>
        <div><?php //echo $sectionValue['text']; ?></div>
    </div>
    <?php endif;
    endforeach; ?>
</div>
<?php /* <div class="artickle-section">	
<ul>
<?php //$section = array();
foreach ($this->section as $sectionValue) :
//$section[$sectionValue['id']] = $sectionValue['url'];
if($this->sectionName == $sectionValue['name']) : ?>
<li>
    <span class="active">
        <b><?php echo $sectionValue['name']; ?></b>
        <span>(<?php echo $sectionValue['amount']; ?>)</span>
    </span>
</li>
<?php else : 
if ($sectionValue['amount'] > 0) : ?>
<li>
    <?php echo $this->Link('/efeles/' . $sectionValue['url'] . '/', $sectionValue['name'], $sectionValue['name']); ?>
    <span>(<?php echo $sectionValue['amount']; ?>)</span>
</li>
<?php endif; ?>
<?php endif; ?>
<?php endforeach; ?>
</ul>
</div> */ ?>
<?php /*if($this->sectionName != "") : ?>
<div style="margin-bottom:15px; clear: left;">
    <?php foreach ($this->paginator as $someArticle) : ?>
    <div class="news-main">
        <?php if($someArticle['picture'] != '') : ?>
        <div class="news-photo">
            <a href="/efeles/<?php echo $someArticle['id']; ?>.html">
                <img style="border: 0px;" alt="" src="/<?php echo $someArticle['picture']; ?>p.jpg" />
            </a>
        </div>
        <?php endif; ?>
        <div class="news-a"><a href="/efeles/<?php echo $someArticle['id']; ?>.html"> <?php echo $someArticle['name']; ?></a></div>
        <div><p><?php echo $someArticle['short']; ?></p></div>
    </div>
    <?php endforeach; ?>
    <?php if($this->paginator->count() > 1) : ?>
    <div class="newPaginator">
        <?php echo $this->paginationControl($this->paginator, 'Sliding', 'user-page.tpl'); ?>
    </div>
    <?php endif; ?>
</div>
<?php endif;*/ ?>

<div>
    <input type="hidden" id="catalog-type" value="efele" />
    <div class="oiltableN">
        <table>
            <thead>
                <tr>
                    <th>Фото</th>
                    <th width="130">Наименование</th>
                    <th>Наличие</th>
                    <th style="width: 150px;">Цена за (1 шт.)</th>
                    <th><img src="/themes/default/images/newdesign/baggray2.png" style="margin: 0 5px 0 -20px;" />Количество</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($this->paginator as $someArticle) : ?>
                <tr>
                    <?php if ($this->priceType == 'recom') {
                    if ($someArticle['price_rec'] != 0) {
                    $price = $someArticle['price_rec'];
                    } else {
                    $price = $someArticle['price_base'];
                    }
                    } elseif ($this->priceType == 'base') {
                    $price = $someArticle['price_base'];
                    } ?>
                    <td>
                        <a href="/efeles/<?php echo $someArticle['id']; ?>.html">
                            <?php if ($someArticle['picture'] != '') { ?>
                            <img style="width: 5em;" alt="" src="/<?php echo $someArticle['picture']; ?>p.jpg"/>
                            <?php } else { ?>
                            <img style="width: 50px; height: 60px;" alt="" src="/themes/default/images/catalog-item.png"/>
                            <?php } ?>
                        </a>
                    </td>
                    <td>
                        <a class="oilTitle" href="/efeles/<?php echo $someArticle['id']; ?>.html">
                            <?php echo $someArticle['name']; ?>
                        </a>
                    </td>
                    <td>
                        <p class="oilText">                     
                            <?php echo number_format($someArticle['warehouse_tver'] + $someArticle['warehouse_snab'] + $someArticle['warehouse_snabfilt'], 0, ' ', ' '); ?><span> шт.</span>
                        </p>
                    </td>
                    <td>
                        <p class="oilText">
                            <?php echo number_format($price, 0, ' ', ' '); ?><span> руб.</span>
                        </p>
                    </td>
                    <?php if ($someArticle['warehouse_tver'] + $someArticle['warehouse_snab'] + $someArticle['warehouse_snabfilt'] == 0) : ?>
			<td colspan="2">
                            <p style="text-align: center;">Товар временно отсутствует на складе</p>
			</td>
                    <?php else : ?>
                        <td width="130" class="item-amount">
                            <a class="add-less" href="javascript:{}">Меньше</a>
                            <?php if (isset($_SESSION['basket']['efele'][$someArticle['id']])) { ?>
                            <?php $value = $_SESSION['basket']['efele'][$someArticle['id']]; ?>
                            <div class="input-field"><div><div>
                                <input type="text" name="price" id="<?php echo $someArticle['id']; ?>" value="<?php echo $value; ?>" onchange="changeAmount(this, 'efele', <?php echo $someArticle['id']; ?>);" />
                                <input type="hidden" name="sumCount" id="sumCount<?php echo $someArticle['id']; ?>" value="<?php echo $someArticle['warehouse_tver'] + $someArticle['warehouse_snab'] + $someArticle['warehouse_snabfilt']; ?>" />
                            </div></div></div>
                            <?php } else { ?>
                            <div class="input-field"><div><div>
                                        <input type="text" name="price" id="<?php echo $someArticle['id']; ?>" value="1" />
                                        <input type="hidden" name="sumCount" id="sumCount<?php echo $someArticle['id']; ?>" value="<?php echo $someArticle['warehouse_tver'] + $someArticle['warehouse_snab'] + $someArticle['warehouse_snabfilt']; ?>" />
                                    </div></div></div>
                            <?php } ?>
                            <a class="add-more" href="javascript:{}">Больше</a>
                        </td>
                        <td class="item-action">
                            <?php if ($this->auth_id) { ?>
                            <?php if (isset($_SESSION['basket']['efele'][$someArticle['id']])) { ?>
                            <a class="delete-item" href="javascript:{};" onclick="deleteItem(this, 'efele', <?php echo $someArticle['id']; ?>);">Удалить</a>
                            <?php } else { ?>
                            <a class="add-to-bask" href="javascript:{};" onclick="addItem(this, 'efele', <?php echo $someArticle['id']; ?>);">В корзину</a>
                            <?php } ?>
                            <?php } else { ?>
                            <a class="add-to-bask" href="javascript:{};" onclick="regCart();">В корзину</a>
                            <?php } ?>
                        </td>
                    <?php endif; ?>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <!-- pager -->    
    <div class="newPaginator">
        <?php if ($this->paginator->count() > 1) 
        echo $this->paginationControl($this->paginator, 'Sliding', 'user-page.tpl', array('addParam' => $this->pageParam));
        ?>
        <br style="clear: right;"/>
    </div>
    <!-- /pager -->
</div>