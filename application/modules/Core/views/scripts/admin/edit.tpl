                <div class="path-l">
                	<div class="path-r">
                		<div class="path-m">
                			<div class="path">
                				<a href="#">Главная</a> > 
                				<a href="#">Карта сайта</a>
                			</div>
                			<div class="module-name">
                				<a href="#">Карта сайта</a>
                			</div>
                		</div>
                	</div>
                </div>
                
                <div class="buttons">
                	<a href="#">Назад</a>
                    <a href="#">Сохранить</a>
                    <a href="#">Сохранить и вернуться к списку</a>
                    <a href="#" class="del">Удалить</a>
                </div>
                
                <div class="new-row-l">
                	<div class="new-row-r">
                		<div class="new-row-m">
                			Новая запись добавлена
                		</div>
                	</div>
                </div>
                
                <div class="error-l">
                	<div class="error-r">
                		<div class="error-m">
                			<b>ОШ�?БКА:</b> Поле <b>раздел сайта</b> обязательно для заполнения
                		</div>
                	</div>
                </div>
                
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
                                <tr>
                                	<td class="td-title"><?php echo $value->getLabel(); ?></td>
                                    <td><?php echo $value->display(); ?></td>
                                </tr>
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
                <div class="buttons">
                	<a href="#">Назад</a>
                    <a href="#">Сохранить</a>
                    <a href="#">Сохранить и вернуться к списку</a>
                    <a href="#" class="del">Удалить</a>
                </div>  