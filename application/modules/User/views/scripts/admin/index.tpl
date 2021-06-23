<?php 
$accHref = "";
if (isset($_GET['page'])) 
	$accHref = "&page=" .$_GET['page'];
?>
<div style="padding: 10px;border: 1px solid #e5e5e5;margin: 0 0 15px 5px;border-radius: 3px;background: #edeaea;">
	<a href="/admin/user/maildelivery/">Сделать рассылку пользователям</a>
</div>

<div style="padding: 10px;border: 1px solid #e5e5e5;margin: 0 0 15px 5px;border-radius: 3px;background: #eaedea;">
	<a href="/admin/user/?account=0<?php echo $accHref; ?>">Только физические лица</a><br><br>
	<a href="/admin/user/?account=1<?php echo $accHref; ?>">Только юридические лица</a>
</div>
<?php 
if (isset($_GET['account'])) 
	$accHref .= "&account=" .$_GET['account'];
?>
<script>
    var userID = null;
    function showModal(element) {
        userID = $(element).closest('tr').find( 'input[type=checkbox]' ).attr('value');
        userType = $( element).closest( 'tr').find( 'input[type=hidden]').attr('value');
        $( "input[name=account][value=" + userType + "]").attr('checked', 'checked');
        $('.modal').modal({keyboard: true});
    }
    $(function() {
        $( "#editType" ).submit(function( event ) {
            event.preventDefault();
            var form = $( this),
                    account = form.find( "input[name=account]:checked" ).val(),
                    url = form.attr( "action");

            var posting = $.post( url, { account: account, userID: userID }, 'json' );

            posting.done(function( data ) {
                if ( data.status == 'ok' ) {
                    $('.modal').modal('hide');
                    window.location.href = "/admin/user/";
                }
            });
        });
    });
</script>
<div class="modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="/admin/user/edittype/" name="editType" id="editType">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">Изменить тип зарегистрированного пользователя</h4>
                </div>
                <div class="modal-body">

                    <p><strong>При переключении типа лица, будет выбран тип цены по умолчанию: </strong>для физического лица — базовая, для юридического — рекомендуемая.</p>

                    <div class="radio">
                        <label>
                            <input type="radio" name="account" value="0">
                            Физическое лицо
                        </label>
                    </div>
                    <div class="radio">
                        <label>
                            <input type="radio" name="account" value="1">
                            Организация (юридическое лицо и индивидуальный предприниматель (ИП))
                        </label>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Отмена</button>
                    <button type="submit" class="btn btn-primary">Сохранить изменения</button>
                </div>
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->


<?php /* ?><div class="path-l">
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
</div><?php */ ?>

<?php /* ?><div class="add-row">
    <a href="/admin/<?php echo $this->control; ?>/add">Добавить</a>
</div><?php */ ?>

<form action="" method="post" enctype="multipart/form-data">
    <div class="mtable-tl">
        <div class="mtable-tr">
            <div class="mtable-tm">
                <div class="mtable-bl">
                    <div class="mtable-br">
                        <div class="mtable-bm">
                            <div id="main-table">
                                <style>
                                    #main-table table{
                                        text-align: left !important;
                                    }
                                </style>
                                <table width="100%" border="0" cellspacing="0" cellpadding="0" class="admin-table">
                                    <tr>
                                        <th class="td-l">&nbsp;</th>
                                        <?php foreach ($this->titles as $value) { ?>
											<th><?php echo $value; ?></th>
                                        <?php } ?>
                                    </tr>
                                    <?php
									$countOnPage = $this->paginator->getCurrentItemCount();
									$i = 1;
									$count = $this->paginator->getTotalItemCount();
									foreach ($this->paginator as $value) { ?>
										<tr <?php echo ($i % 2 ? 'class="odd"' : ''); ?>>
											<td align="left"><input type="checkbox" value="<?php echo $value['id']; ?>" name="type[]"></td>
											<?php
											$ii = 1;
											foreach ($this->titles as $key => $valueM) { ?>
												<?php if ($key == 'access') { ?>
													<td <?php if($ii==1) echo 'align="left"'; ?>  valign="top" <?php if($ii!=1) echo ''; ?>>
													<?php if ($value[$key]) { ?>
														<a href="/admin/<?php echo $this->control; ?>/?forbid=<?php echo $value['id']; ?>">
															<img src="/application/themes/admin/images/display.png" alt="" width="18" height="15" />
														</a>
														<?php } else { ?>
														<a href="/admin/<?php echo $this->control; ?>/?access=<?php echo $value['id']; ?>">
															<img src="/application/themes/admin/images/display-not.png" alt="" width="15" height="17" />
														</a>
													<?php } ?>
													</td>
												<?php } else { ?>
													<td <?php if($ii==1) echo 'align="left" width="320"'; ?>  valign="top" <?php if($ii!=1) echo ''; ?>>
													<a href="/admin/<?php echo $this->control; ?>/edit/<?php echo $value['id'] . $accHref; ?>">
														<?php if ($key == 'type') { ?>
															<?php $type = $this->userForm->type->getMultiOptions(); ?>
															<?php echo $type[$value[$key]]; ?>
															<input type="hidden" value="<?php echo $value[$key]; ?>">
														<?php } elseif ($key == 'manager_id') { ?>	
															<?php if ($value[$key] == 0) : ?>
																Нет менеджера
															<?php else : ?>
																<?php echo $value['manager_name']; ?>
															<?php endif; ?>
														<?php } else { ?>
															<?php echo htmlspecialchars($value[$key]); ?>
														<?php } ?>
													</a>
													<?php if ($ii == 1) { ?>
														<div class="row-actions-parent">
															<div class="row-actions">
																<span><a href="/admin/<?php echo $this->control; ?>/edit/<?php echo $value['id'] . $accHref; ?>" class="row-actions-change">Изменить</a></span>
																|
																<span><a href="/admin/<?php echo $this->control; ?>/edit/<?php echo $value['id'] . $accHref; ?>" class="row-actions-change" onclick="showModal(this); return false;">Изменить тип пользователя</a></span>
																|
																<span><a onclick="if ( confirm( 'Вы собираетесь удалить ссылку «<?php //echo $value->name; ?>»\n  «Отмена» &mdash; оставить, «OK» &mdash; удалить.' ) ) { return true;}return false;" href="/admin/<?php echo $this->control; ?>/delete/<?php echo $value['id']; ?>" class="row-actions-del">Удалить</a></span>
															</div>
														</div>
													<?php } ?>
													</td>
												<?php }
												$ii++;
											} ?>                                    
										</tr>
										<?php
										$i++;
									} ?>

                                </table>
                                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                    <tr class="table-footer">
                                        <td>
                                            <table width="100%" class="table-footer-all">
                                                <tr>
                                                    <td width="30%" align="left">Всего: <b><?php echo $count; ?></b> записей</td>
                                                    <td width="40%" align="center">
                                                        <?php //echo $this->paginationControl($this->paginator, 'Sliding', 'admin-page.tpl'); ?>
                                                    </td>
                                                    <td width="30%" align="right">
                                                        <input type="hidden" value="<?php echo $this->paginator->getCurrentPageNumber(); ?>" name="page2">
                                                        <select onchange="this.form.submit()" name="pager">
                                                            <option value="1" selected="selected">10</option>
                                                            <option value="2">20</option>
                                                            <option value="3">30</option>
                                                            <option value="4">40</option>
                                                            <option value="5">50</option>
                                                        </select>
														<?php $pallHref = "/admin/" . $this->control . "/?page=all";
															$pallHref .= $accHref;														
														?>
                                                        <?php /* <a href="/admin/<?php echo $this->control; ?>/?page=all" class="show-all">Показать все</a> */ ?>
                                                        <a href="<?php echo $pallHref; ?>" class="show-all">Показать все</a>
                                                    </td>
                                                </tr>
                                            </table>
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