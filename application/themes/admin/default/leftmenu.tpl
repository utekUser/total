<ul>
<?php foreach ($this->leftmenu as $value) { ?>
    	<?php if ($_st) { ?>
    	<li class="razd">&nbsp;</li>
    	<?php } ?>
    	<li <?php echo ($this->leftmenuselect == $value['path']) ? 'class="lmenu-li-a"' : 'class="lmenu-li"'; ?>><a href="/admin/<?php echo $value['path']; ?>/"><?php echo $value['name']; ?></a></li>
<?php
    $_st = true;
}
?>
</ul>