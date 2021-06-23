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
    <a href="/filters/masljanye/" title="Масляные фильтры">масляные</a>
    <a href="/filters/toplivnye/" title="Топливные фильтры">топливные</a>
    <a href="/filters/vozdushnye/" title="Воздушные фильтры">воздушные</a>
    <a href="/filters/salonnye/" title="Салонные фильтры">салонные</a>
    <a href="/filters/aksessuary/" title="Аксессуары">аксессуары</a>
    <a href="/filters/drugie-filtry/" title="Другие фильтры">другие</a>
</div>
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
            <form action="/filters/" method="get">
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
			<a href="https://catalog.mann-filter.com/EU/rus" rel="nofollow" target="_blank">
				Online сервис по подбору фильтров MANN-FILTER
			</a>
		</div>
    </div>
</div>
<?php //include 'description.php'; ?>
<?php if (!$this->code && !$this->codeOpt && !$this->page) : ?>
	<?php if ($this->filterDescr && Engine_Cms::displayContent(8)) : ?>
		<div class="section-info"><?php echo Engine_Cms::displayContent(8); ?></div>
	<?php endif; ?>
	<?php if ($this->sectionInfo != '') : ?>
		<div class="section-info"><?php echo $this->sectionInfo; ?></div>
	<?php endif; ?>
<?php endif; ?>

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
	                        <th><img src="/themes/default/images/newdesign/baggray2.png" style="margin: 0 5px 0 -20px;" />Количество</th>
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
										<?php /* <a href="https://www.mann-hummel.com/mf_prodkata_eur/index.html?ktlg_page=2&ktlg_subpage=01&ktlg_lang=8&ktlg_02_sFilter=<?php echo $sFilter; ?>" target="_blank"> */ ?>
			                            <a href="https://catalog.mann-filter.com/EU/rus" target="_blank">
											<?php echo $filter['invoice_name']; ?>
			                            </a>
			                        </td>
			                        <td class="item-price" style="padding: 0 10px 0 8px">
			                            <p class="oilText">
											<?php echo number_format($filter['warehouse_tver'] + $filter['warehouse_snab'] + $filter['warehouse_snabfilt'], 0, ' ', ' '); ?>&nbsp;шт.
			                            </p>
			                        </td>
			                        <td class="item-price">
			                            <p class="oilText"><?php echo $price; ?>&nbsp;руб.</p>
			                        </td>
									<?php if ($filter['warehouse_tver'] + $filter['warehouse_snab'] + $filter['warehouse_snabfilt'] == 0) : ?>
										<td colspan="2">
											<p style="text-align: center;">Товар временно отсутствует на складе</p>
										</td>
									<?php else : ?>
										<td class="item-amount">
											<a class="add-less" href="javascript:{}">Меньше</a>
											<?php if (isset($_SESSION['basket']['filter'][$filter['id']])) { ?>
												<?php $value = $_SESSION['basket']['filter'][$filter['id']]; ?>
												<div class="input-field" style="width: 42px;"><div><div>
															<input type="text" name="price" id="<?php echo $filter['id']; ?>" value="<?php echo $value; ?>" onchange="changeAmount(this, 'filter', <?php echo $filter['id']; ?>);" />
															<input type="hidden" name="sumCount" id="sumCount<?php echo $filter['id']; ?>" value="<?php echo $filter['warehouse_tver'] + $filter['warehouse_snab'] + $filter['warehouse_snabfilt']; ?>" />												   
														</div></div></div>
											<?php } else { ?>
												<div class="input-field" style="width: 42px;"><div><div>
															<input type="text" name="price" id="<?php echo $filter['id']; ?>" value="1" />
															<input type="hidden" name="sumCount" id="sumCount<?php echo $filter['id']; ?>" value="<?php echo $filter['warehouse_tver'] + $filter['warehouse_snab'] + $filter['warehouse_snabfilt']; ?>" />												   
														</div></div></div>
											<?php } ?>
											<a class="add-more" href="javascript:{}">Больше</a>
										</td>
										<td class="item-action">
											<?php if ($this->auth_id) { ?>
												<?php if (isset($_SESSION['basket']['filter'][$filter['id']])) { ?>
													<a class="delete-item" href="javascript:{};" onclick="deleteItem(this, 'filter', <?php echo $filter['id']; ?>);">Удалить</a>
												<?php } else { ?>
													<a class="add-to-bask" href="javascript:{};" onclick="addItem(this, 'filter', <?php echo $filter['id']; ?>);">В корзину</a>
												<?php } ?>
											<?php } else { ?>
												<a class="add-to-bask" href="javascript:{};" onclick="regCart();">В корзину</a>
											<?php } ?>
										</td>
									<?php endif; ?>
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
	                <div class="desired-ajax-form__input"><input name="name" type="text" class=""form-control placeholder="Наименование товара"<?php if (isset($searchRequest)) {
			echo 'value="' . $searchRequest . $category . '"';
		} ?>></div>
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
<?php
$searchText = "";
if (isset($_GET['codeOpt'])) {
	foreach ($_GET['codeOpt'] as $key => $value) {
		$searchText .= "&codeOpt[]=" . $value;
	}
}
?>
<script>
    $(document).ready(function () {
        var prev = $("div.pager a.prev").attr('href');
        $("div.pager a.prev").attr('href', prev + <?php echo "'" . $searchText . "'"; ?>);
        var next = $("div.pager a.next").attr('href');
        $("div.pager a.next").attr('href', next + <?php echo "'" . $searchText . "'"; ?>);
    });
</script>
	<?php if ($this->paginator->count() > 1) { ?>
	<div class="newPaginator">
	<?php echo $this->paginationControl($this->paginator, 'Sliding', 'user-page.tpl', array('addParam' => $this->pageParam . $searchText)); ?>
	</div>
<?php } ?>
<script type="text/javascript">
    $(function () {
        $('#add-search-field').bind('click', addSearchField);
        $('.minus-item').bind('click', removeModelList);
        $('#srchEx').bind('click', findExample);
    })
    function addSearchField(e) {
        var parent = $(this).parent().parent();
        var new_div = parent.clone();
        new_div.find('.input-field input').val("");
        new_div.appendTo(parent.parent());
        new_div.find('.search-form-button').remove();
        new_div.find('.plus-item').removeAttr('id');
        new_div.find('.plus-item').removeClass("plus-item").addClass("minus-item").bind('click', removeModelList);
    }
    function removeModelList(e) {
        $(this).parent().parent().remove();
    }
    function findExample(e) {
        var example = $(this).text();
        $('#srchField').val(example);
    }
</script>