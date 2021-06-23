<div class="path-l">
	<div class="path-r">
		<div class="path-m">
			<div class="path">
                <?php echo $this->path; ?>
			</div>
			<div class="module-name">
                <?php echo $this->header; ?>
			</div>
		</div>
	</div>
</div>

<div class="add-row">
	<a href="/admin/<?php echo $this->control; ?>/add">Добавить</a>
</div>

<form action="" method="post" enctype="multipart/form-data">
<div class="mtable-tl">
	<div class="mtable-tr">
		<div class="mtable-tm">
			<div class="mtable-bl">
				<div class="mtable-br">
					<div class="mtable-bm">
						<div id="main-table">
							<table width="100%" border="0" cellspacing="0" cellpadding="0" class="admin-table">
								<tr>
								    <th class="td-l">&nbsp;</th>
                                    <?php foreach ($this->titles as $value) { ?>
                                        <th><?php echo $value; ?></th>
                                    <?php } ?>
                                    <th width="9%">Подразделы</th>
                                    <th width="7%">#</th>
                                    <th width="7%">Отображать</th>
                                    <th width="9%">Переместить</th>
								</tr>
								<?php
								$countOnPage = $this->paginator->getCurrentItemCount();
								$i = 1;
								$count = $this->paginator->getTotalItemCount();
								foreach ($this->paginator as $value) {
								?>
								<tr <?php echo ($i % 2 ? 'class="odd"' : ''); ?>>
								    <td align="left" width="2%"><input type="checkbox" value="<?php echo $value['id']; ?>" name="type[]"></td>
								    <?php 
								    $ii = 1;
								    foreach ($this->titles as $key => $valueM) {
								    ?>
								    <td <?php if($ii==1) echo 'align="left"'; ?>  valign="top" <?php if($ii!=1) echo 'width="7%"'; ?>>
								    
									    <a href="/admin/<?php echo $this->control; ?>/edit/<?php echo $value['id']; ?>"><?php echo htmlspecialchars($value[$key]); ?></a>
								    	<?php if ($ii == 1) { ?>
								    	<div class="row-actions-parent">
								    		<div class="row-actions">
								    			<span><a href="/admin/<?php echo $this->control; ?>/edit/<?php echo $value['id']; ?>" class="row-actions-change">Изменить</a></span>
								    			|
								    			<span><a onclick="if ( confirm( 'Вы собираетесь удалить ссылку «<?php //echo $value->name; ?>»\n  «Отмена» &mdash; оставить, «OK» &mdash; удалить.' ) ) { return true;}return false;" href="/admin/<?php echo $this->control; ?>/delete/<?php echo $value['id']; ?>" class="row-actions-del">Удалить</a></span>
								    		</div>
								    	</div>
								    	<?php } ?>
								    </td>
									<?php
									$ii++;
								    }
								    ?>
									<td valign="top"><a href="/admin/oils/section/?section=<?php echo $value['id']; ?>">перейти >>></a></td>
									<td valign="top"><?php echo $value['id']; ?></td>
									<td valign="top">
                                        <?php if ($value['display']) { ?>
                                        <a href="/admin/<?php echo $this->control; ?>/hide/<?php echo $value['id']; ?>">
                                            <img src="/application/themes/admin/images/display.png" alt="" width="18" height="15" />
                                        </a>
                                        <?php } else { ?>
                                        <a href="/admin/<?php echo $this->control; ?>/display/<?php echo $value['id']; ?>">
                                            <img src="/application/themes/admin/images/display-not.png" alt="" width="15" height="17" />
                                        </a>
                                        <?php } ?>
									</td>
									<td valign="top">
                                        <table class="main-table-pos" width="100%%" border="0" cellspacing="0" cellpadding="0">
                                          <tr>
                                            <td width="50%">
                                                <?php if ($i != $countOnPage) { ?>
                                                <a href="/admin/<?php echo $this->control; ?>/down/<?php echo $value['id']; ?>"><img src="/application/themes/admin/images/arrow-down.png" width="13" height="13" alt="Вниз" /></a>
                                                <?php } ?>
                                            </td>
                                            <td>
                                                <?php if ($i != 1) { ?>
                                                <a href="/admin/<?php echo $this->control; ?>/up/<?php echo $value['id']; ?>"><img src="/application/themes/admin/images/arrow-up.png" width="13" height="13" alt="Вверх" /></a>
                                                <?php } ?>
                                            </td>
                                          </tr>
                                        </table>
									</td>
								</tr>
								<?php
								    $i++;
								}
								?>
								
							</table>
							<table width="100%" border="0" cellspacing="0" cellpadding="0">
								<tr class="table-footer">
									<td>
										
									</td>
								</tr>
							</table>
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
        
        <select style="margin: 0 3em 0 3em;" onchange="this.form.submit();" name="submit_mult">
	        <option selected="selected" value="С отмеченными:">С отмеченными:</option>
	        <option value="display">Отобразить</option>
	        <option value="hide">Скрыть</option>
	        <option value="delete">Удалить</option>
	    </select>
    
    </div>
</form>