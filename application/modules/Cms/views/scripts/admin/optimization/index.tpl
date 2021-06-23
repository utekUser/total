<div class="path-l">
	<div class="path-r">
		<div class="path-m">
			<div class="path">
                <a href="/admin/">Главная</a> &gt; <a href="/admin/cms/">CMS</a>                			</div>
			<div class="module-name">
                <a href="/admin/cms/">CMS</a>                			</div>
		</div>
	</div>
</div>
                <form action="" method="post" enctype="multipart/form-data" id="form">
                <?php foreach ($this->elements as $value) { ?>
                    <?php if ($value->elmentHidden) { ?>
                                <?php echo $value->display(); ?>
                    <?php } ?>
                <?php } ?>
                <div class="buttons">
                    <input class="default" type="submit" name="_save" value="Сохранить" />
                </div>
                
                <?php if (isset($_GET['form']) && $_GET['form'] == 'edit') { ?>
                <div class="new-row-l">
                	<div class="new-row-r">
                		<div class="new-row-m">
                			Данные сохранены!
                		</div>
                	</div>
                </div>
                <?php } ?>
                
                <?php
                $error = $this->form->getMessages();
                if (!empty($error)) {
                ?>
                <div class="error-l">
                	<div class="error-r">
                		<div class="error-m">
                			<b>Пожалуйста, исправьте ошибки ниже</b>
                		</div>
                	</div>
                </div>
                <?php } ?>
                
                <div class="edit-div">
	                <div class="edit-div-tl">
	                	<div class="edit-div-tr">
	                		<div class="edit-div-tm"></div>
	                	</div>
	                </div>
	                <div class="edit-div-ml">
	                	<div class="edit-div-mr">
	                		<div class="edit-div-mm">
                            	<table class="edit-table" cellpadding="0" cellspacing="0">
                                    <?php foreach ($this->elements as $value) { ?>
                                        <?php if (!$value->getIgnore()) { ?>
                                        <?php //if (!$value->elmentHidden && $value->isFormDisplay()) { ?>
                                            <tr>
                                            	<td class="td-title"><?php echo $value->getLabel(); ?></td>
                                                <td>
                                                    <?php // echo print_r($value->getMessages()); ?>
                                                    <?php
                                                    $error = $value->getMessages();
                                                    if (!empty($error)) {
                                                        $value->setAttrib('class', 'element-error');
                                                        echo '<ul class="errorlist">';
                                                        foreach ($error as $keyError => $valueError) {
                                                    ?>
                                                            <li><?php echo $valueError; ?></li>
                                                    <?php
                                                        }
                                                        echo '</ul>';
                                                    }
                                                    ?>
                                                    <?php echo $value; ?>
                                                </td>
                                            </tr>
                                        <?php } ?>
                                    <?php } ?>
                                </table>
	                		</div>
	                	</div>
	                </div>
	                <div class="edit-div-bl">
	                	<div class="edit-div-br">
	                		<div class="edit-div-bm"></div>
	                	</div>
	                </div> 
                </div>
                </form>
<script type="text/javascript">document.getElementById("globaltitle").focus();</script>