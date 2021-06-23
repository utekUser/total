<?php /* <div class="path">
  <a href="/"><img alt="" src="/themes/default/images/house.png" /></a>
  <span><?php echo Engine_Application::getPageHeader(); ?></span>
  </div>
  <h2 style="font-size: 20px; text-transform: none; font-weight: normal"><?php echo Engine_Application::getPageHeader(); ?></h2>
 */ ?>
<style>
    .order-basket table th, .order-history table td {
        background: #ffffff;
        text-align: left;
    }
    .order-basket table {
        border: 0px;
        border-bottom: 5px solid #f1f0f0;
        border-radius: 3px;
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
	.margBot {
		margin: 0 0 5px 0;
	}
	.margNull {
		margin: 0 0 0 0;
	}
</style>
<div class="order-basket">
	<?php if (sizeof($this->items)) { ?>
		<form action="/basket/" method="post" name="basket">
			<div class="current-order">
				<?php /* <div class="current-order-title">
				  <img alt="" src="/themes/default/images/basket.png" />
				  <span>Текущий заказ</span>
				  </div>
				  <div class="page-razd"></div> */ ?>
				<div class="item-info">
					<table width="100%" cellspacing="0" cellpadding="0" border="0" class="order-history">
						<tr>
							<th style="border-bottom: 1px solid #e4e4e4; border-top: 1px solid #e4e4e4; width: 28%; padding: 8px 0;">Наименование товара</th>
							<th style="border-bottom: 1px solid #e4e4e4; border-top: 1px solid #e4e4e4; width: 20%; padding: 8px 0;">Наличие на складах</th>
							<th style="border-bottom: 1px solid #e4e4e4; border-top: 1px solid #e4e4e4; width: 18%; padding: 8px 0; text-align: center;">Цена, руб.</th>
							<th style="border-bottom: 1px solid #e4e4e4; border-top: 1px solid #e4e4e4; padding: 8px 0;" colspan="2">
								<img src="/themes/default/images/newdesign/baggray2.png" style="margin: 0 5px 0 3px;" />
								Количество
							</th>
						</tr>
						<?php $totalPrice = 0; ?>
						<?php foreach ($this->items as $item) { /* echo '<pre>'; print_r($item); echo '</pre>'; */ ?>
							<tr>
								<td class="item-name"><?php echo $item['name']; ?></td>
								<td class="item-name">
									<?php if ($item['type'] == "plug") : ?>
										<p class="margBot">
											<?php echo $item['warehouse_tver']; ?>
											<span style="color:#8b8c8d; font-weight: normal;"> шт. (Тверская 18)</span>
										</p>
									<?php elseif ($item['type'] == "oil") : ?>
										<p class="margBot">
											<?php echo $item['warehouse_tver']; ?>
											<span style="color:#8b8c8d; font-weight: normal;"> шт. (Тверская 18)</span>
										</p>
										<p class="margBot">
											<?php echo $item['warehouse_snab']; ?>
											<span style="color:#8b8c8d; font-weight: normal;"> шт. (Томскснаб)</span>
										</p>
									<?php elseif ($item['type'] == "coolstream") : ?>
										<p class="margBot">
											<?php echo $item['warehouse_tver']; ?>
											<span style="color:#8b8c8d; font-weight: normal;"> шт. (Тверская 18)</span>
										</p>
										<p class="margBot">
											<?php echo $item['warehouse_snab']; ?>
											<span style="color:#8b8c8d; font-weight: normal;"> шт. (Томскснаб)</span>
										</p>
									<?php elseif ($item['type'] == "autoparts") : ?>
										<p class="margBot">
											<?php echo $item['warehouse_skl1']; ?>
											<span style="color:#8b8c8d; font-weight: normal;"> шт. Склад №1 розн</span>
										</p>
										<p class="margBot">
											<?php echo $item['warehouse_skl3']; ?>
											<span style="color:#8b8c8d; font-weight: normal;"> шт. Склад №3 запчасти - фильтр</span>
										</p>
									<?php elseif ($item['type'] == "filtron") : ?>
										<p class="margBot">
											<?php echo $item['warehouse_tver']; ?>
											<span style="color:#8b8c8d; font-weight: normal;"> шт. (Тверская 18)</span>
										</p>
										<p class="margBot">
											<?php echo $item['warehouse_snabfilt']; ?>
											<span style="color:#8b8c8d; font-weight: normal;"> шт. (Томскснаб-Фильтра)</span>
										</p>
									<?php else : ?>
										<p class="margBot">
											<?php echo $item['warehouse_tver']; ?>
											<span style="color:#8b8c8d; font-weight: normal;"> шт. (Тверская 18)</span>
										</p>
										<p class="margNull">
											<?php echo $item['warehouse_snabfilt']; ?>
											<span style="color:#8b8c8d; font-weight: normal;"> шт. (Томскснаб-Фильтра)</span>
										</p>
									<?php endif; ?>                      
								</td>
								<td class="item-price">
									<?php echo $item['price']; ?> руб.
								</td>
								<td class="item-amount">
									<a class="add-less" href="javascript:{}">Меньше</a>
									<div class="input-field">
										<div>
											<div>
												<input type="text" onchange="changeAmount(this, '<?php echo $item['type']; ?>', <?php echo $item['id']; ?>);" value="<?php echo $item['amount']; ?>" name="<?php echo $item['type']; ?>[<?php echo $item['id']; ?>]"/>
											</div>
										</div>
									</div>
									<a class="add-more" href="javascript:{}">Больше</a>
									<?php /* <?php echo $item['amount'] . ' шт.'; ?> */ ?>
								</td>
								<td class="item-action" style="padding: 10px 0;">
									<a class="delete-item" style="margin: 0;" href="javascript:{};" onclick="deleteToBasket(this, '<?php echo $item['type']; ?>', <?php echo $item['id']; ?>);">Удалить</a>
								</td>
							</tr>
							<?php $totalPrice += $item['price'] * $item['amount']; ?>
						<?php } ?>
					</table>
				</div>
			</div>
			<?php /* <div class="page-razd"></div>
			  <div class="total-sum">Итого: <span><?php echo $totalPrice; ?> руб.</span></div> */ ?>
			<div class="total-sum">Итого: <?php echo $totalPrice; ?> руб.</div>
			<?php /* <div class="page-razd"></div> */ ?>
			<div class="appr-order">
				<input type="submit" value="Пересчитать" class="recount"/>
			</div>
		</form>
	<?php } else { ?>
		<table width="100%" cellspacing="0" cellpadding="0" border="0" class="order-history">
			<tr>
				<th style="border-bottom: 1px solid #e4e4e4; border-top: 1px solid #e4e4e4; width: 50%;">Наименование товара</th>
				<!--<th>Упаковка/л.</th>-->
				<th style="border-bottom: 1px solid #e4e4e4; border-top: 1px solid #e4e4e4; width: 25%;">Цена, руб.</th>
				<th style="border-bottom: 1px solid #e4e4e4; border-top: 1px solid #e4e4e4;" colspan="2" style="width: 60px">Количество</th>
			</tr>
			<tr class="info">
				<td colspan="4" class="item-name" style="padding: 5px 15px;">
					<p style="font-size: 12px">Корзина пуста, подберите что-нибудь в нашем <a href="/catalog/">каталоге</a> или воспользуйтесь блоком «Желаемый продукт».</p>
				</td>
			</tr>
		</table>
	<?php } ?>
</div>
<div class="desired">
    <h1>Желаемый продукт</h1>
    <p>Если вы не нашли на нашем сайте нужный вам товар — Вы можете добавить его в заказ в раздел «Желаемая продукция» — наши менеджеры свяжутся с Вами, подтвердят возможность выполнения заказа и сообщат о возможных сроках доставки.</p>
    <form class="desired-ajax-form" action="/catalog/desired/">
        <button type="submit" class="btn btn-success">Добавить</button>
        <div class="desired-ajax-form__input"><input name="name" type="text" class=""form-control placeholder="Наименование товара"></div>
    </form>
    <div id="desiredtable">
		<?php if (count($this->desired)) { ?>
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
		<?php } ?>
    </div>
</div>
<div class="appr-order appr-order-next<?php if (!sizeof($this->items) && !sizeof($this->desired)) echo ' appr-order_show'; ?>">
    <a class="arrange" style="float: right" href="/order/">Оформить заказ</a>
</div>