<script type="text/javascript">
(function($) {
    $(function() {
        $('ul.tabs').each(function() {
            $(this).find('li').each(function(i) {
                $(this).click(function(){
                    $(this).addClass('current').siblings().removeClass('current')
                    .parents('div.order-tabs').find('div.box').hide().end().find('div.box:eq('+i+')').fadeIn(150);
                });
            });
        });
    })
})(jQuery)
</script>
<style>
.box { display: none; }
.box.visible { display: block; }
</style>
<div class="order-tabs">
    <ul class="tabs">
        <li class="current"><div><div><div>Заказ</div></div></div></li>
        <li><div><div><div>Состав заказа</div></div></div></li>
        <li><div><div><div>Транзакции по заказу</div></div></div></li>
    </ul>
    <div class="edit-div-tl">
    	<div class="edit-div-tr">
    		<div class="edit-div-tm"></div>
    	</div>
    </div>
    <div class="edit-div-ml">
        <div class="edit-div-mr">
            <div class="edit-div-mm">
                <div class="box visible">
                <?php //echo '<pre>'; print_r($this->elements); echo '</pre>'; ?>
                    <!--<form enctype="multipart/form-data" method="post" action="">-->
                        <div class="edit-div">
                            <script type="text/javascript">
                            $(document).ready(function() {
                                $('.changeStatus').click(function() {
                                    var viewStatusDIV = $('#viewStatusDIV');
                                    var editStatusDIV = $('#editStatusDIV');
                                    if (viewStatusDIV.css('display')=='block') {
                                        viewStatusDIV.hide();
                                        editStatusDIV.show();
                                    } else {
                                        viewStatusDIV.show();
                                        editStatusDIV.hide();
                                    }
                                });
                                $('.cancelOrder').click(function() {
                                    var viewStatusDIV = $('#viewCancelDIV');
                                    var editStatusDIV = $('#editCancelDIV');
                                    if (viewStatusDIV.css('display')=='block') {
                                        viewStatusDIV.hide();
                                        editStatusDIV.show();
                                    } else {
                                        viewStatusDIV.show();
                                        editStatusDIV.hide();
                                    }
                                });
                                $('.payOrder').click(function() {
                                    var viewStatusDIV = $('#viewPayDIV');
                                    var editStatusDIV = $('#editPayDIV');
                                    if (viewStatusDIV.css('display')=='block') {
                                        viewStatusDIV.hide();
                                        editStatusDIV.show();
                                    } else {
                                        viewStatusDIV.show();
                                        editStatusDIV.hide();
                                    }
                                });
                            });
                            </script>
                            <table cellspacing="0" cellpadding="0" class="edit-table"><tbody>
                                <tr><td colspan="2" class="order-title"><b>Заказ</b></td></tr>
                                <tr>
                                    <td class="td-title">ID заказа</td>
                                    <td><?php echo $this->orderId; ?></td>
                                </tr>
                                <tr>
                                    <td class="td-title">Дата создания заказа</td>
                                    <td><?php echo $this->Date($this->elements['date']->getValue(), 'numeric'); ?></td>
                                </tr>
                                <tr>
                                    <td class="td-title">Дата последнего изменения</td>
                                    <td><?php echo $this->Date($this->elements['modified']->getValue(), 'numeric'); ?></td>
                                </tr>
                                <tr>
                                    <td class="td-title">Текущий статус заказа </td>
                                    <td>
                                        <form name="change_status" action="/admin/shop/order/" method="get">
                                            <div id="viewStatusDIV">
                                                [<?php echo $this->statusList[$this->elements['status_id']->getValue()]['code']; ?>]
                                                <?php echo $this->statusList[$this->elements['status_id']->getValue()]['name']; ?>
                                                 &nbsp;&nbsp;<?php echo $this->Date($this->elements['status_modified']->getValue(), 'numeric'); ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                <a class="changeStatus" href="javascript:{}">Сменить статус...</a>
                                            </div>
                                            <div id="editStatusDIV">
                                                <select name="status_list">
                                                    <?php foreach ($this->statusList as $statusid => $status) { ?>
                                                    <option value="<?php echo $statusid; ?>">[<?php echo $status['code']; ?>] <?php echo $status['name']; ?></option>
                                                    <?php } ?>
                                                </select>
                                                <input type="hidden" value="change_status" name="action" />
                                                <input type="hidden" value="<?php echo $this->orderId; ?>" name="order" />
                                                <input type="submit" value="Изменить">
                                                <br /><br />
                                                <a class="changeStatus" href="javascript:{}">Не менять</a>
                                            </div>
                                        </form>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="td-title">Сумма заказа</td>
                                    <td><b><?php echo $this->elements['total_sum']->getValue(); ?> руб.</b></td>
                                </tr>
                                <tr>
                                    <td class="td-title">Отменен</td>
                                    <td>
                                        <form name="change_cancel" action="/admin/shop/order/" method="get">
                                            <?php if (!$this->elements['rejected']->getValue()) { ?>
                                            <div id="viewCancelDIV">Нет &nbsp;&nbsp;
                                                <?php if ($this->elements['rejection_date']->getValue()) echo $this->Date($this->elements['rejection_date']->getValue(), 'numeric'); ?>
                                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                <a class="cancelOrder" href="javascript:{};">Отменить заказ...</a>
                                            </div>
                                            <div id="editCancelDIV">
                                                Смена флага с <b>не отменен</b> на <b>отменен</b><br /><br />
                                                Причина отмены заказа (доступна для просмотра покупателем):<br />
                                                <textarea cols="40" rows="3" name="rejection_reason"></textarea><br />
                                                <input type="hidden" value="<?php echo $this->orderId; ?>" name="order" />
                                                <input type="hidden" value="change_cancel" name="action" />
                                                <input type="hidden" value="1" name="rejected" /><br />
                                                <input type="submit" value="Изменить" /><br /><br />
                                                <a class="cancelOrder" href="javascript:{}">Не менять</a>
                                            </div>
                                            <?php } else { ?>
                                            <div id="viewCancelDIV">Да &nbsp;&nbsp;<?php echo $this->Date($this->elements['rejection_date']->getValue(), 'numeric'); ?>
                                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                <a class="cancelOrder" href="javascript:{}">Снять отмену заказа...</a><br />
                                                <?php echo $this->elements['rejection_reason']->getValue(); ?>
                                            </div>
                                            <div id="editCancelDIV">
                                                Смена флага с <b>отменен</b> на <b>не отменен</b><br /><br />
                                                Причина отмены заказа (доступна для просмотра покупателем):<br />
                                                <textarea cols="40" rows="3" name="rejection_reason"><?php echo $this->elements['rejection_reason']->getValue(); ?></textarea><br />
                                                <input type="hidden" value="<?php echo $this->orderId; ?>" name="order" />
                                                <input type="hidden" value="change_cancel" name="action" />
                                                <input type="hidden" value="0" name="rejected" /><br />
                                                <input type="submit" value="Изменить" /><br /><br />
                                                <a class="cancelOrder" href="javascript:{}">В режим просмотра...</a>
                                            </div>
                                            <?php } ?>
                                        </form>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                    
                                    </td>
                                    <td>
                                        <?php
                                        $value = $this->elements['pdf']->getValue();
                                        if ($value && file_exists(APPLICATION_PATH . DS . $value)) {
                                        ?>
                                        <a href="/<?php echo $value; ?>" target="_blank">Скачать заказ (PDF)</a>
                                        <?php
                                        }
                                        ?>
                                    </td>
                                </tr>
                                <tr><td colspan="2" class="order-title"><b>Покупатель</b></td></tr>
                                <tr>
                                    <td class="td-title">Покупатель</td>
                                    <td><?php echo $this->elements['customer_name']->getValue(); ?></td>
                                </tr>
                                <tr>
                                    <td class="td-title">Имя входа покупателя (логин)</td>
                                    <td><?php echo $this->elements['customer_login']->getValue(); ?></td>
                                </tr>
                                <tr>
                                    <td class="td-title">E-Mail покупателя</td>
                                    <td><a href="mailto:<?php echo $this->elements['customer_email']->getValue(); ?>"><?php echo $this->elements['customer_email']->getValue(); ?></a></td>
                                </tr>
                                <tr>
                                    <td class="td-title">Телефон покупателя</td>
                                    <td><?php echo $this->elements['customer_phone']->getValue(); ?></td>
                                </tr>
                                <tr>
                                    <td class="td-title">Тип плательщика</td>
                                    <td>
                                        <?php if (!$this->elements['customer_type']->getValue()) echo 'Физическое лицо'; else echo 'Юридическое лицо'; ?></td>
                                </tr>
                                <tr><td colspan="2" class="order-title"><b>Оплата</b></td></tr>
                                <tr>
                                    <td class="td-title">Оплачен</td>
                                    <td>
                                        <form name="change_pay_form" action="/admin/shop/order/" method="get">
                                        <?php if ($this->elements['payment']->getValue()) { ?>
                                            <div id="viewPayDIV">
                                                Да &nbsp;&nbsp; <?php echo $this->Date($this->elements['payment_date']->getValue(), 'numeric'); ?>
                                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                <a class="payOrder" href="javascript:{}">Снять оплату заказа...</a><br />
                                                Платежный документ №<?php echo $this->elements['payment_doc']->getValue(); ?> от 
                                                <?php echo $this->Date($this->elements['payment_doc_date']->getValue(), 'date'); ?>
                                            </div>
                                            <div id="editPayDIV">Смена флага с <b>Оплачен</b> на <b>Не оплачен</b><br /><br />
                                                <table cellspacing="1" cellpadding="3" border="0"><tbody>
                                                    <tr>
                                                        <td width="0%" nowrap="">Номер платежного документа:</td>
                                                        <td><?php echo $this->elements['payment_doc']; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td width="0%" nowrap="">Дата платежного документа (DD.MM.YYYY):</td>
                                                        <td><?php echo $this->elements['payment_doc_date']; ?></td>
                                                    </tr>
                                                </tbody></table><br /><br>
                                                <input type="hidden" value="" name="payment_doc" />
                                                <input type="hidden" value="" name="payment_doc_date" />
                                                <input type="hidden" value="<?php echo $this->elements['total_sum']->getValue(); ?>" name="total_sum" />
                                                <input type="hidden" value="0" name="payment" />
                                                <input type="hidden" value="<?php echo $this->orderId; ?>" name="order">
                                                <input type="hidden" value="change_pay" name="action" />
                                                <input type="submit" value="Снять оплату" />
                                                <br><br>
                                                <a href="javascript:{}">Не менять</a>
                                            </div>

                                        <?php } else { ?>
                                            <div id="viewPayDIV">
                                                Нет &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                <a class="payOrder" href="javascript:{}">Оплатить заказ...</a>
                                            </div>
                                            <div id="editPayDIV">
                                            Смена флага с <b>Не оплачен</b> на <b>Оплачен</b><br /><br />
                                                <table cellspacing="1" cellpadding="3" border="0"><tbody>
                                                    <tr>
                                                        <td width="0%" nowrap="">Номер платежного документа:</td>
                                                        <td><?php echo $this->elements['payment_doc']; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td width="0%" nowrap="">Дата платежного документа:</td>
                                                        <td><?php echo $this->elements['payment_doc_date']; ?></td>
                                                    </tr>
                                                </tbody></table><br />
                                                <input type="hidden" value="1" name="payment" />
                                                <input type="hidden" value="<?php echo $this->orderId; ?>" name="order" />
                                                <input type="hidden" value="<?php echo $this->elements['total_sum']->getValue(); ?>" name="total_sum" />
                                                <input type="hidden" value="change_pay" name="action" />
                                                <input type="submit" value="Оплатить" name="payout_button" />&nbsp;&nbsp;&nbsp;<br /><br />
                                                <a class="payOrder" href="javascript:{}">Не менять</a>
                                            </div>
                                        </form>
                                        <?php } ?>
                                    </td>
                                </tr>
                                <tr><td colspan="2" class="order-title"><b>Комментарий</b></td></tr>
                                <tr>
                                    <td class="td-title">Комментарий</td>
                                    <td><?php echo $this->elements['comment']; ?></td>
                                </tr>
                            </tbody></table>
                        </div>
                        <div class="clear"></div>
                    <!--</form>-->
                </div>
                <div class="box">
                    <table cellspacing="0" cellpadding="0" border="0"><tbody>
    				<tr>
    					<td colspan="2">
    					   <table width="100%" cellspacing="1" cellpadding="3" border="0" class="edit-table"><tbody>
        					   <tr class="heading">
            						<td class="td-title">Артикул</td>
            						<td class="td-title">Название</td>
            						<td class="td-title">Свойства</td>
            						<td class="td-title">Скидка на товар</td>
            						<td class="td-title">Тип цены</td>
            						<td class="td-title">Количество</td>
            						<td class="td-title">Цена</td>
            						<td class="td-title">Сумма</td>
            					</tr>
            					<?php $total_price = 0; ?>
            					<?php foreach ($this->items as $item) { ?>
            					<tr>
        							<td valign="top"><?php echo $item['base_id']; ?></td>
        							<td valign="top"><?php echo $item['name']; ?></td>
        							<td valign="top"><?php echo $item['properties']; ?></td>
        							<td valign="top"><?php echo $item['sale']; ?></td>
        							<td valign="top">
        							<?php 
        							if ($item['price_type'] == 'recom') { 
        							    echo 'Рекомендуемая цена';
        							} else { 
        							    echo 'Базовая цена';
        							} 
        							?>
        							</td>
        							<td valign="top"><?php echo $item['amount']; ?></td>
        							<td valign="top" align="right"><?php echo number_format($item['price'], 2, '.', ' '); ?> руб.</td>
        							<td valign="top" align="right"><?php echo number_format($item['price'] * $item['amount'], 2, '.', ' '); ?> руб.</td>
        						</tr>
        						<?php $total_price += $item['price'] * $item['amount']; ?>
            					<?php } ?>
        						<tr>
        							<td align="right"><b>Скидка:</b></td>
        							<td align="right" colspan="8">0 руб</td>
        						</tr>
        						<tr>
        							<td align="right"><b>Итого:</b></td>
        							<td align="right" colspan="8"><b><?php echo number_format($total_price, 2, '.', ' '); ?> руб.</b></td>
        						</tr>
                            </tbody></table>

                            <div style="margin: 0 7px">
                                <h3>Желаемый продукт</h3>
                                <div id="desiredtable">
                                    <table class="table table-striped" style="width: 100%">
                                        <thead>
                                        <tr>
                                            <td style="font-weight: 700">Наименование желаемого товара для заказа</td>
                                        </tr>
                                        </thead>
                                        <?php foreach ($this->desired as $product) { ?>
                                        <tr>
                                            <td><?php echo htmlspecialchars($product['name']); ?></td>
                                        </tr>
                                        <?php } ?>
                                    </table>
                                </div>
                            </div>
                        </td>
                    </tr>
                    </tbody></table>



                </div>
                <div class="box">
                    <table width="100%" cellspacing="1" cellpadding="3" border="0" class="edit-table"><tbody>
                        <tr>
                            <td class="td-title">Дата</td>
                            <td class="td-title">Сумма</td>
                            <td class="td-title">Описание</td>
                            <td class="td-title">Комментарии</td>
                        </tr>
                        <?php foreach ($this->transactions as $transaction) { ?>
                        <tr>
                            <td><?php echo $this->Date($transaction['date'], 'numeric'); ?></td>
                            <td><?php echo $transaction['sum']; ?></td>
                            <td><?php echo $transaction['description']; ?></td>
                            <td><?php echo $transaction['comment']; ?></td>
                        </tr>
                        <?php } ?>
                    </tbody></table>
                </div>
            </div>
        </div>
    </div>
    <div class="edit-div-bl">
        <div class="edit-div-br">
            <div class="edit-div-bm"></div>
        </div>
    </div>
</div>