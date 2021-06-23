<div class="add-row">
	<a href="/admin/shop/manager/add">Добавить</a>
</div>
<form enctype="multipart/form-data" method="post" action="">
    <div class="mtable-tl">
    	<div class="mtable-tr">
    		<div class="mtable-tm">
    			<div class="mtable-bl">
    				<div class="mtable-br">
    					<div class="mtable-bm">
    						<div id="main-table">
    							<table width="100%" cellspacing="0" cellpadding="0" border="0" class="admin-table order-list"><tbody>
    								<tr>
    								    <th class="td-l">&nbsp;</th>
                                        <th>ФИО менеджера</th>
                                        <th>Телефон</th>
    								</tr>
    								<?php
    								$countOnPage = $this->paginator->getCurrentItemCount();
    								$i = 1;
    								$count = $this->paginator->getTotalItemCount();
    								foreach ($this->paginator as $value) {
    								?>
    								<tr <?php if ($i%2) echo 'class="odd"'; ?>>
                                        <td width="2%" align="left"><input type="checkbox" name="type[]" value="1" /></td>
                                        <td valign="top" align="left" width="270">
                                            <a href="/admin/shop/manager/edit/<?php echo $value['id']; ?>">&nbsp;<?php echo $value['manager_name']; ?></a>
                                        </td>
                                        <td valign="top"><?php echo $value['manager_phone']; ?></td>
                                    </tr>
    								<?php $i++; ?>
    								<?php } ?>
    							</tbody></table>
    							<table width="100%" cellspacing="0" cellpadding="0" border="0">
    								<tbody><tr class="table-footer">
    									<td>
    										<table width="100%" class="table-footer-all">
    											<tbody><tr>
    												<td width="30%" align="left">Всего: <b><?php echo $count; ?></b> записей</td>
    												<td width="40%" align="center">
                                                        												</td>
    												<td width="30%" align="right">
                                                        <input type="hidden" name="page2" value="1">
                                                        <select name="pager" onchange="this.form.submit()">
                                                            <option selected="selected" value="1">10</option>
                                                            <option value="2">20</option>
                                                            <option value="3">30</option>
                                                            <option value="4">40</option>
                                                            <option value="5">50</option>
                                                        </select>
    												    <a class="show-all" href="/admin/guestbook/?page=all">Показать все</a>
    												</td>
    											</tr>
    										</tbody></table>
    									</td>
    								</tr>
    							</tbody></table>
    						</div>
    					</div>
    				</div>
    			</div>
    		</div>
    	</div>
    </div>
    <div class="messages-ch">
        <span onclick="$('input[type=checkbox]').attr('checked',true);">Отметить все</span>
        |
        <span onclick="$('input[type=checkbox]').attr('checked',false);">Снять выделение</span>
        <select name="submit_mult" onchange="this.form.submit();" style="margin: 0 3em 0 3em;">
            <option value="С отмеченными:" selected="selected">С отмеченными:</option>
            <option value="display">Отобразить</option>
            <option value="hide">Скрыть</option>
            <option value="delete">Удалить</option>
        </select>
    </div>
</form>