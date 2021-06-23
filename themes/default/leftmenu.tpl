<?php $_i = false; ?>
<ul class="left-menu">
    <?php foreach ($this->leftmenu as $leftMenu) { ?>
    <?php ($_i) ? $first = '' : $first = 'first '; ?>
    <?php ($this->menuselect == $leftMenu['url']) ? $class = 'active' : $class = ''; ?>
        <li class="<?php echo $first, $class; ?>"><a href="/<?php echo $leftMenu['url']; ?>/"><?php echo $leftMenu['name']; ?></a></li>
    <?php $_i = true; ?>
    <?php } ?>
</ul>