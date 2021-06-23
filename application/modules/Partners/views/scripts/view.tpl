<h1><?php echo $this->currentPartner['name']; ?></h1>
<div class="block-razd"></div>
<div class="chain">
	<a href="/">Главная</a>
	<a href="/partners/">Партнеры</a>
	<?php echo $this->currentPartner['name']; ?>
</div>
<div class="block-razd"></div>
<div class="block">
    <?php if($this->currentPartner['picture'] != '') { ?>
	<div class="picture"><img alt="" src="/<?php echo $this->currentPartner['picture']; ?>p.jpg" /></div>
	<?php } ?>
	<div class="block-text spacer"><?php echo $this->currentPartner['text']; ?></div>
</div>
<div class="block-razd"></div>
<div class="back"><a href="/partners/">Вернуться <img src="/themes/default/images/more.png"></a></div>