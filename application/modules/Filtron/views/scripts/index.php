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
<script>
    function isAlert() {
        var i = 0, j = 0;
        $("input[name='codeOpt[]']").each(function (i) {
            if (($(this).val().length < 3) && ($(this).val() != '')) {
                i = i + 1;
            } else {
                j = j + 1;
            }
        });
        if (j == $("input[name='codeOpt[]']").length) {
            $('#searchalert').animate({height: 'hide'}, 400);
        } else {
            $('#searchalert').animate({height: 'show'}, 400);
        }
    }
</script>
<div class="search-blockN">
    <div style="font-size:11px; color:#999; text-align:right; margin:10px 5px 0 0;">Последнее обновление прайса: <?php echo $this->Date(date('Y-m-d H:i:s', $this->task), 'datetimesign'); ?></div>
    <div class="grey-corner-mN">
        <div class="search-opt">
            <form action="/filtron/" method="get">
                <div class="search-form-labelN">Быстрый поиск
                    <div style="font-family: Arial; color: #8b8c8d; font-size: 12px; text-transform: none;">
                        Введите до 50-ти наименований, каждое в новой строке
                    </div>
					<div id="searchalert" style="font-family: Arial; color: #EE1313; font-size: 12px; text-transform: none; display: none;">
                        Для поиска необходимо ввести не менее трех символов
                    </div>					
                </div>                
				<?php if ($this->codeOpt) { ?>
					<?php $i = 1; ?>
					<?php foreach ($this->codeOpt as $codeOpt) { ?>
						<?php if ($i == 1) { ?>
							<div class="search-opt-row">
								<div class="input-fieldN" style="float: left;">
									<input type="text" oninput="isAlert()" name="codeOpt[]" value="<?php echo $codeOpt; ?>" />
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
									<input type="text" oninput="isAlert()" name="codeOpt[]" value="<?php echo $codeOpt; ?>" />
								</div>
								<div style="margin-left: -31px; float: left;">
									<input type="button" value="" class="minus-item">
								</div>
							</div>
						<?php } ?>
						<?php $i++; ?>
					<?php } ?>
				<?php } else { ?>
					<div class="search-opt-row">
						<div class="input-fieldN" style="float: left;">
							<input type="text" oninput="isAlert()" name="codeOpt[]" />
						</div>
						<div class="search-item-plus" style="margin-left: -31px;">
							<input type="button" class="plus-item" id="add-search-field" value="" />
						</div>
						<div class="search-form-button">
							<input type="submit" value="Отправить" />
						</div>
					</div>	
				<?php } ?>                
            </form>
        </div>
		<div class="filter-mannN">
			<?php /* <a href="https://www.mann-hummel.com/mf_prodkata_eur/index.html?ktlg_page=01&ktlg_lang=8&ktlg_subpage=00&ktlg_01_mrksl=0&ktlg_01_mdrsl=&ktlg_01_modsl=0&ktlg_01_fzkat=&ktlg_01_fzart=1" rel="nofollow" target="_blank"> */ ?>
			<a href="https://filtron.eu/ru" rel="nofollow" target="_blank">
				Online сервис по подбору фильтров FILTRON
			</a>
		</div>
    </div>
</div>
<?php include 'desctiption.php'; ?>
<div>
    <input type="hidden" id="catalog-type" value="filtron" />
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
						<?php
						if ($this->priceType == 'recom') {
							if ($someArticle['price_rec'] != 0) {
								$price = $someArticle['price_rec'];
							} else {
								$price = $someArticle['price_base'];
							}
						} elseif ($this->priceType == 'base') {
							$price = $someArticle['price_base'];
						}
						?>
						<?php $link = "/filtron/" . $someArticle['id'] . ".html"; ?>
						<?php $link = "#"; ?>
						<td>
							<a href="<?php echo $link; ?>">
								<?php if ($someArticle['picture'] != '') { ?>
									<img style="width: 5em;" alt="" src="/<?php echo $someArticle['picture']; ?>p.jpg"/>
								<?php } else { ?>
									<img style="width: 50px; height: 60px;" alt="" src="/themes/default/images/catalog-item.png"/>
								<?php } ?>
							</a>
						</td>
						<td>
							<a class="oilTitle" href="<?php echo $link; ?>">
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
								<?php if (isset($_SESSION['basket']['filtron'][$someArticle['id']])) { ?>
									<?php $value = $_SESSION['basket']['filtron'][$someArticle['id']]; ?>
									<div class="input-field"><div><div>
												<input type="text" name="price" id="<?php echo $someArticle['id']; ?>" value="<?php echo $value; ?>" onchange="changeAmount(this, 'filtron', <?php echo $someArticle['id']; ?>);" />
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
									<?php if (isset($_SESSION['basket']['filtron'][$someArticle['id']])) { ?>
										<a class="delete-item" href="javascript:{};" onclick="deleteItem(this, 'filtron', <?php echo $someArticle['id']; ?>);">Удалить</a>
									<?php } else { ?>
										<a class="add-to-bask" href="javascript:{};" onclick="addItem(this, 'filtron', <?php echo $someArticle['id']; ?>);">В корзину</a>
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
		<?php
		if ($this->paginator->count() > 1)
			echo $this->paginationControl($this->paginator, 'Sliding', 'user-page.tpl', array('addParam' => $this->pageParam));
		?>
        <br style="clear: right;"/>
    </div>
    <!-- /pager -->
</div>