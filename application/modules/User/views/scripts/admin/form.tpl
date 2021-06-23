<ol class="breadcrumb">
    <li><a href="/admin/">Главная</a></li>
    <li><a href="/admin/user/">Пользователи</a></li>
    <li class="active">Редактирование пользователя</li>
</ol>
<?php 
$accHref = "";
if (isset($_GET['account']))
	$accHref = $_GET['account'];
if (isset($_POST['account']))
	$accHref .= $_POST['account'];
$allHref = "";
if (isset($_GET['page']))
	$allHref = $_GET['page'];
if (isset($_POST['page']))
	$allHref .= $_POST['page'];
?>
<form action="" method="post" enctype="multipart/form-data" id="form">
	<input type="hidden" name="account" value="<?php echo $accHref; ?>" />
	<input type="hidden" name="page" value="<?php echo $allHref; ?>" />
    <div class="buttons">
        <a class="btn btn-info btn-large" href="/admin/<?php echo $this->control; ?>">Назад</a>
        <input class="default btn btn-success btn-large" type="submit" name="_save" value="Сохранить" />
        <input class="btn btn-success btn-large" type="submit" name="_continue" value="Сохранить и продолжить редактирование" />
        <a href="/admin/<?php echo $this->control; ?>/delete/<?php echo $this->id; ?>" class="del btn btn-danger btn-large" onclick="if ( confirm( 'Вы собираетесь удалить ссылку «»\n  «Отмена» — оставить, «OK» — удалить.' ) ) { return true;}return false;">Удалить</a>
    </div>
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
                        <?php /*if ($value->getName() == 'type') continue;*/ ?>
                        <?php if (!$value->getIgnore() && !preg_match("/_Hidden/i", get_class($value))) { ?>
                        <tr>
                            <td class="td-title"><?php echo $value->getLabel(); ?></td>
                            <td>
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
                        <?php foreach ($this->elementsInfo as $value) { ?>
                        <?php if (isset($this->elements['type']) && !$this->elements['type']->getValue()) { ?>
                        <?php $names = array('price_type', 'vip', 'name', 'info', 'address', 'phone'); ?>
                        <?php if (!$value->getIgnore() && !preg_match("/_Hidden/i", get_class($value)) && in_array($value->getName(), $names)) { ?>
                        <tr>
                            <td class="td-title"><?php echo $value->getLabel(); ?></td>
                            <td>
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
                        <?php } else { ?>
                        <?php if (!$value->getIgnore() && !preg_match("/_Hidden/i", get_class($value))) { ?>
                        <tr>
                            <td class="td-title"><?php echo $value->getLabel(); ?></td>
                            <td>
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
    <div class="clear"></div>
</form>
<script type="text/javascript">document.getElementById("name").focus();</script>