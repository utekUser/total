<h1>Добро пожаловать в Систему управления сайтами</h1>
<table class="admin-info" cellspacing="0" cellpadding="0" border="0">
    <tr>
        <td colspan="2" style="text-align:center; background:#DDDDDD;">
            <strong>Технические данные</strong>
        </td>
    </tr>
    <tr>
        <td>Имя хоста:</td>
        <td><?php echo $_SERVER['SERVER_NAME']; ?></td>
    </tr>
    <tr>
        <td>IP-адрес сервера:</td>
        <td><?php echo $_SERVER['SERVER_ADDR']; ?></td>
    </tr>
    <tr>
        <td>Операционная система:</td>
        <td><?php echo PHP_OS; ?></td>
    </tr>
    <tr>
        <td>Установленое ПО:</td>
        <td><?php echo $_SERVER["SERVER_SOFTWARE"]; ?></td>
    </tr>
    <tr>
        <td>Версия PHP:</td>
        <td><?php echo phpversion(); ?></td>
    </tr>
    <!--			<tr>
    <td>Версия MySQL:</td>
    <td><php echo mysqli_get_server_info(); ?></td>
    </tr>-->
    <tr>
        <td>Максимальный размер загрузки:</td>
        <td><?php echo ini_get('upload_max_filesize'); ?></td>
    </tr>
    <tr>
        <td>Максимальный размер загрузки через POST:</td>
        <td><?php echo (ini_get('file_uploads')==0) ? $lang['sys_offswitched'] : @ini_get('post_max_size'); ?></td>
    </tr>
    <tr>
    <?php
    //    $free_space = disk_free_space('/');
    //	if( $free_space < 1024 ) $free_space = $free_space.' bytes'; elseif ( $free_space < 1048576 ) $free_space = round( ( $free_space / 1024 ), 1 ).' KB'; elseif( $free_space < 1073741824 ) $free_space = round(($free_space / 1048576),1).' MB'; else $free_space = round(($free_space / 1073741824),1).' GB';
    ?>
    <!--				<td>Размер свободного места на диске:</td>
    <td>
    <php echo $free_space; ?>
    </td>-->
    </tr>
    <tr>
        <td>Максимальное время исполнения:</td>
        <td><?php echo ini_get('max_execution_time'); ?> сек</td>
    </tr>
    <tr>
        <td colspan="2" style="border-left:none; border-right:none;">
            &nbsp;
        </td>
    </tr>
    <tr>
        <td colspan="2" style="text-align:center; background:#DDDDDD;">
            <strong>Используемое дисковое пространство</strong>
        </td>
    </tr>
    <tr>
        <td>Размер сайта:</td>
        <td><?php echo Engine_Cms::getSiteSize(APPLICATION_PATH); ?></td>
    </tr>
    <tr>
        <td colspan="2" style="border-left:none; border-right:none;">
            &nbsp;
        </td>
    </tr>
    <tr>
        <td colspan="2" style="text-align:center; background:#DDDDDD;">
            <strong>О вас</strong>
        </td>
    </tr>
    <tr>
        <td>Ваш IP-адрес:</td>
        <td><?php echo $_SERVER['REMOTE_ADDR']; ?></td>
    </tr>
</table>