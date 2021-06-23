<?php // if ($_SERVER['REMOTE_ADDR'] == '78.140.9.206' || $_SERVER['REMOTE_ADDR'] == '46.161.158.155' || $_SERVER['REMOTE_ADDR'] == '88.204.72.104' || $_SERVER['REMOTE_ADDR'] == '95.170.159.81') { ?>
<?php if ($_SERVER['REQUEST_URI'] == "/about/" || $_SERVER['REQUEST_URI'] == "/terms/" || $_SERVER['REQUEST_URI'] == "/kontakty-i-shema-proezda-kompanii-tomavtotrejd-/" || $_SERVER['REQUEST_URI'] == "/guestbook/" || $_SERVER['REQUEST_URI'] == "/vacancy/") {
$firstBread['name'] = "О компании";
$firstBread['url'] = "/about/";
} else {
$firstBread['name'] = "Главная";
$firstBread['url'] = "/";
}?>
<?php if ($_SERVER['REQUEST_URI'] == "/about/" || $_SERVER['REQUEST_URI'] == "/terms/" || $_SERVER['REQUEST_URI'] == "/kontakty-i-shema-proezda-kompanii-tomavtotrejd-/" || $_SERVER['REQUEST_URI'] == "/guestbook/" || $_SERVER['REQUEST_URI'] == "/vacancy/") { ?>
<div class="breadcrumbsDesign">
    <p>
        <a href="<?php echo $firstBread['url']; ?>" title="<?php echo $firstBread['name']; ?>">
            <span class="bold"><?php echo $firstBread['name']; ?></span>
        </a> » 
        <a href="<?php echo $_SERVER['REQUEST_URI']; ?>" title="<?php echo Engine_Application::getPageHeader(); ?>">
            <span class="underline"><?php echo Engine_Application::getPageHeader(); ?></span>
        </a>
    </p>
</div>
<div class="commonWrapper">
    <div class="commonWL">
        <h1><?php echo Engine_Application::getPageHeader(); ?></h1>
        <?php echo $this->layout()->content; ?>
    </div>
    <div class="commonWL2">
        <ul>
            <li class="bord"><a href="/about/" title="О компании">О компании</a></li>
            <li class="bord"><a href="/kontakty-i-shema-proezda-kompanii-tomavtotrejd-/" title="Контакты">Контакты</a></li>
            <li class="bord"><a href="/vacancy/" title="Вакансии">Вакансии</a></li>
            <li class="bord"><a href="/terms/" title="Условия работы">Условия работы</a></li>
            <li><a href="/guestbook/" title="Задать вопрос специалисту">Задать вопрос специалисту</a></li>
        </ul>
    </div>
</div>
<?php } else { ?>
<div class="commonWrapper">
    <div class="commonW">
        <h1><?php echo Engine_Application::getPageHeader(); ?></h1>
        <?php echo $this->layout()->content; ?>
    </div>
</div>
<?php } ?>
<?php /* } else { ?>
<?php echo $this->layout()->content; ?>
<?php } */ ?>