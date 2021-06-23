<div class="path-l">
	<div class="path-r">
		<div class="path-m">
			<div class="path">
                <a href="/admin/">Главная</a> &gt; <a href="/admin/cms/">CMS</a> &gt; <span>Планировщик задач</span>                			</div>
			<div class="module-name">Планировщик задач</div>
		</div>
	</div>
</div>
                <form action="" method="post" enctype="multipart/form-data" id="form">
                <?php // foreach ($this->elements as $value) { ?>
                    <?php // if ($value->elmentHidden) { ?>
                                <?php // echo $value->display(); ?>
                    <?php // } ?>
                <?php // } ?>
                
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
                // $error = $this->form->getMessages();
                if (false && !empty($error)) {
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
                                <table cellpadding="10" cellspacing="0" class="edit-table" border="0">
                                <tr>
                                <th>
                                <input type="checkbox" onclick="$$('input[type=checkbox][name]').set('checked', this.get('checked'));"></th>
                                <th><strong>
                                ID          
                                </strong></th>
                                <th><strong>
                                
                                Имя
                                </strong></th>
                                <th><strong>
                                
                                Тайм-аут
                                </strong></th>
                                <th><strong>
                                Статистика          </strong></th>
                                <th><strong>
                                Processes          </strong></th>
                                </tr>
<?php foreach( $this->tasks as $task ): ?>
          <tr>
            <td class="nowrap" align="center">
              <input type="checkbox" name="selection[]" value="<?php echo $task->task_id ?>" />
            </td>
            <td class="nowrap" align="center">
              <?php echo $this->locale()->toNumber($task->task_id) ?>
            </td>
            <td class="nowrap">
              <?php if( !empty($task->title) ): ?>
                <?php echo $task->title ?>
              <?php else: ?>
                <?php echo $task->plugin ?>
              <?php endif; ?>

              <?php if( !empty($this->taskProgress[$task->plugin]) ): ?>
                <br />
                <?php // Percent mode ?>
                <?php if( !empty($this->taskProgress[$task->plugin]['progress']) && !empty($this->taskProgress[$task->plugin]['total'])  ): ?>
                  <i>
                  <?php echo $this->translate(
                    '%1$s' . '%% complete',
                    $this->locale()->toNumber(round((int) @$this->taskProgress[$task->plugin]['progress'] / $this->taskProgress[$task->plugin]['total'] * 100, 1))
                  ) ?>
                  <br />
                  <?php echo $this->translate(
                    '%1$s of %2$s',
                    $this->locale()->toNumber((int) @$this->taskProgress[$task->plugin]['progress']),
                    $this->locale()->toNumber($this->taskProgress[$task->plugin]['total'])
                  ) ?>
                  </i>
                <?php // Queue mode ?>
                <?php elseif( !empty($this->taskProgress[$task->plugin]['total']) ): ?>
                  <i>
                  <?php echo $this->translate(
                    '%1$s in queue',
                    $this->locale()->toNumber($this->taskProgress[$task->plugin]['total'])
                  ) ?>
                  </i>
                <?php // Progress mode ?>
                <?php elseif( !empty($this->taskProgress[$task->plugin]['progress']) ): ?>
                  <i>
                  <?php echo $this->translate(
                    '%1$s processed',
                    $this->locale()->toNumber($this->taskProgress[$task->plugin]['total'])
                  ) ?>
                  </i>
                <?php endif; ?>
              <?php endif; ?>
            </td>
            <td class="nowrap">
                <?php echo $this->locale()->toNumber($task->timeout) ?> секунд
            </td>
            <td class="nowrap">
              Успешно:
              <?php if( $task->success_count > 0 ): ?>
                <?php echo $this->locale()->toNumber($task->success_count) ?>
                раз, последний
                <?php echo $this->timestamp($task->success_last) ?>
              <?php else: ?>
                никогда
              <?php endif; ?>
              <br />

              Неудачно:
              <?php if( $task->failure_count > 0 ): ?>
                <?php echo $this->locale()->toNumber($task->failure_count) ?>
                раз, последний
                <?php echo $this->timestamp($task->failure_last) ?>
              <?php else: ?>
                никогда
              <?php endif; ?>
              <br />

              <?php if( $task->started_count != $task->success_count + $task->failure_count ): ?>
                <?php if( $task->started_count > 0 ): ?>
                Started:
                  <?php echo $this->locale()->toNumber($task->started_count) ?>
                  times, last
                  <?php echo $this->timestamp($task->started_last) ?>
                <?php else: ?>
                  never
                <?php endif; ?>
                <br />
              <?php endif; ?>

              <?php if( $task->completed_count != $task->success_count + $task->failure_count ): ?>
                Completed:
                <?php if( $task->completed_count > 0 ): ?>
                  <?php echo $this->locale()->toNumber($task->completed_count) ?>
                  times, last
                  <?php echo $this->timestamp($task->completed_last) ?>
                <?php else: ?>
                  never
                <?php endif; ?>
                <br />
              <?php endif; ?>
            </td>
            <td class="nowrap">
              <?php if( !empty($this->processIndex) && !empty($this->processIndex[$task->plugin]) ): ?>
                <?php foreach( $this->processIndex[$task->plugin] as $process ): ?>
                  <div>
                    <?php echo $this->htmlLink(array(
                      'reset' => false,
                      'action' => 'processes',
                      'pid' => $process['pid']
                    ), $process['pid']) ?>
                    <br />
                    <?php
                      $delta = time() - $process['started'];
                      echo $this->translate(array('Running for %d second', 'Running for %d seconds', $delta), $delta)
                    ?>
                  </div>
                <?php endforeach; ?>
              <?php endif; ?>
            </td>
            <?php /*
            <td class="admin_table_options">
              <span class="sep">|</span>
              <?php echo $this->htmlLink('javascript:void(0);', $this->translate('run'), array('onclick' => 'runTasks(' . $task->task_id . ', $(this));')) ?>
              <span class="sep">|</span>
              <?php echo $this->htmlLink(array('reset' => false, 'action' => 'edit', 'task_id' => $task->task_id), $this->translate('edit')) ?>
              <span class="sep">|</span>
              <?php echo $this->htmlLink(array('reset' => false, 'action' => 'reset-stats', 'task_id' => $task->task_id), $this->translate('reset stats')) ?>

            </td>
             *
             */ ?>
          </tr>
        <?php endforeach; ?>
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
                <br />
                
<div class="buttons" style="clear:both">
<button onclick="handleSelectedAction('run'); return false;">Run Selected Now</button>
<button onclick="handleSelectedAction('reset'); return false;">Reset Statistics</button>
</div>