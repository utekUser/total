<?php // if ($_SERVER['REMOTE_ADDR'] == '78.140.9.206' || $_SERVER['REMOTE_ADDR'] == '46.161.158.155' || $_SERVER['REMOTE_ADDR'] == '88.204.72.104' || $_SERVER['REMOTE_ADDR'] == '95.170.159.81') { ?>
<div class="mainWrapper">  
    <div class="sliderWrapper">
        <?php
        $slidesCount = count($this->layout()->slides);
        if ($slidesCount) {
        ?>
        <div id="banners-scrollerDesing">
            <ul id="mycarouselDesign" class="jcarousel-skin-alena">
                <?php foreach ($this->layout()->slides as $value) { ?>
                <li><div><a href="<?php echo ($value->url ? $value->url : '#'); ?>"><img alt="" src="/<?php echo $value->file; ?>" width="940" height="380" /></a></div></li>
                <?php }?>
            </ul>
            <div class="jcarousel-control">
                <div>
                    <?php for ($i = 1; $i <= $slidesCount; $i++) { ?>
                    <?php if ($i == 1) { ?>
                    <a href="#" class="control-active"><?php echo $i; ?></a>
                    <?php } else { ?>
                    <a href="#"><?php echo $i; ?></a>
                    <?php } ?>
                    <?php } ?>
                </div>
            </div>
        </div>
        <?php } ?>
    </div>
    <div class="mainpageMenu">
        <div id="mainpageMenu">
            <a href="/oils/"><div class="menupart partolis"><p>Масла</p></div></a>
            <a href="/filters/"><div class="menupart partfilters"><p>Фильтры</p></div></a>            
            <?php /* <a href="/plug/"><div class="menupart partplug"><p>Свечи</p></div></a> */ ?>
			<a href="/coolstream/"><div class="menupart coolstream"><p>Охлаждающие жидкости</p></div></a>
            <a href="/zapchasti-dlja-korejskih-avto/"><div class="menupart partchast"><p>Запчасти для корейских авто</p></div></a>
        </div>
    </div>
    <div class="newsWrapper">
        <div class="newsDesign">
            <h2>Новости</h2>
            <div class="newsDesign">
                <div class="onewnewDesign">
                    <?php if($this->layout()->news[0]['picture'] != '') { ?>
                    <div class="news-photo" style="position: relative; float: none;">
                        <a href="<?php echo '/news/' . ($this->layout()->news[0]['url'] ? $this->layout()->news[0]['url'] . '-' : '') . $this->layout()->news[0]['id'] . '.html'; ?>">
                            <img width="280px" alt="" src="/<?php echo $this->layout()->news[0]['picture']; ?>b.jpg" />
                            <?php if ($this->layout()->news[0]['stock']) { ?><img width="60%" style="border: 0; position: absolute; bottom: 0; right: 0;" src="/images/stock.png" /><?php } ?>
                        </a>
                    </div>
                    <?php } ?>                    
                    <div class="news-a"><?php echo $this->Link('/news/' . ($this->layout()->news[0]['url'] ? $this->layout()->news[0]['url'] . '-' : '') . $this->layout()->news[0]['id'] . '.html', $this->layout()->news[0]['name']); ?></div>                    
                    <p>
                        <span class="news-date"><img src="/themes/default/images/newdesign/clock.png" />  <?php echo $this->Date($this->layout()->news[0]['posted'], 'date'); ?></span>
                        <span class="news-views"><img src="/themes/default/images/newdesign/eye.png" />  <?php echo $this->layout()->news[0]['view']; ?></span>
                    </p>
                    <div class="news-short"><?php echo $this->layout()->news[0]['short']; ?></div>
                </div>
                <div class="fournewsDesign">
                    <?php $i = 0; ?>
                    <?php foreach ($this->layout()->news as $new) { ?>
                    <?php if ($i != 0) { ?>
                    <div class="newDesign"> 
                        <?php if($new['picture'] != '') { ?>
                        <div class="news-photo" style="position: relative;">
                            <a href="<?php echo '/news/' . ($new['url'] ? $new['url'] . '-' : '') . $new['id'] . '.html'; ?>">
                                <img width="90px" alt="" src="/<?php echo $new['picture']; ?>p.jpg" />
                                <?php if ($new['stock']) { ?><img width="60%" style="border: 0; position: absolute; bottom: 0; right: 0;" src="/images/stock.png" /><?php } ?>
                            </a>
                        </div>
                        <?php } ?>                    
                        <div class="news-a"><?php echo $this->Link('/news/' . ($new['url'] ? $new['url'] . '-' : '') . $new['id'] . '.html', $new['name']); ?></div>
                        <p>
                            <span class="news-date"><img src="/themes/default/images/newdesign/clock.png" />  <?php echo $this->Date($new['posted'], 'date'); ?></span>
                            <span class="news-views"><img src="/themes/default/images/newdesign/eye.png" />  <?php echo $new['view']; ?></span>
                        </p>
                    </div>
                    <?php } ?>
                    <?php $i++; } ?>
                </div>
            </div>
        </div>
        <div class="articleDesign">
            <h2>Статьи</h2>
            <div class="articlesDesign">
                <?php foreach ($this->layout()->articles as $article) { ?>
                <div class="articleDesign">
                    <?php if($article['picture'] != '') { ?>
                    <div class="news-photo">
                        <a href="<?php echo '/articles/' . $article['section_url'] . '/' . ($article['url'] ? $article['url'] . '-' : '') . $article['id'] . '.html'; ?>">
                            <img width="90px" alt="" src="/<?php echo $article['picture']; ?>p.jpg" />
                        </a>
                    </div>
                    <?php } ?>
                    <div class="news-a">
                        <?php echo $this->Link('/articles/' . $article['section_url'] . '/' . ($article['url'] ? $article['url'] . '-' : '') . $article['id'] . '.html', $article['name']); ?>
                    </div>
                    <p>
                        <span class="news-date"><img src="/themes/default/images/newdesign/clock.png" />  <?php echo $this->Date($article['posted'], 'date'); ?></span>
                        <span class="news-views"><img src="/themes/default/images/newdesign/eye.png" />  <?php echo $article['view']; ?></span>
                    </p>
                </div>
                <?php } ?>
            </div>
        </div>
        <br style="clear: left;">
    </div>
</div>


<?php /* } else { ?>

<?php
$slidesCount = count($this->layout()->slides);
if ($slidesCount) {
?>
<div id="banners-scroller">
    <ul id="mycarousel" class="jcarousel-skin-tango">
        <?php foreach ($this->layout()->slides as $value) { ?>
        <li><div><a href="<?php echo ($value->url ? $value->url : '#'); ?>"><img alt="" src="/<?php echo $value->file; ?>" width="791" height="300" /></a></div></li>
        <?php }?>
    </ul>
    <div class="jcarousel-control">
        <div>
            <?php for ($i = 1; $i <= $slidesCount; $i++) { ?>
            <?php if ($i == 1) { ?>
            <a href="#" class="control-active"><?php echo $i; ?></a>
            <?php } else { ?>
            <a href="#"><?php echo $i; ?></a>
            <?php } ?>
            <?php } ?>
        </div>
    </div>
</div>
<?php } ?>


<?php if (Engine_Cms::displayContent(4)) { ?>
<div class="white-fon">
    <div class="white-fon-m">
        <h2>О компании</h2>
        <?php echo Engine_Cms::displayContent(4); ?>
    </div>
</div>
<?php } ?>
<?php if (false) { ?>
<div class="white-fon">
    <div class="white-fon-m">
        <h2 class="h2-good">Рекомендованные товары</h2>
        <div class="good nechet">
            <div class="good-photo"><a href="#"><img alt="" src="/themes/default/images/picture.png"/></a></div>
            <div class="good-a"><a href="#">TOTAL QUARTZ ENERGY 9000 0W30</a></div>
            <div class="good-name">Моторное масло TOTAL синтетическое</div>
            <div class="good-fas">Фасовка: <span>1; 4; 5; 208 л.</span></div>
            <div class="good-art">Артикул: <span>151515, 151513, 151512, 151514</span></div>
            <div class="good-price">Цена: <span>от 885 руб.</span></div>
            <div class="good-detailed"><a href="#">Подробнее</a></div>		
        </div>
        <div class="good">
            <div class="good-photo"><a href="#"><img alt="" src="/themes/default/images/picture.png"/></a></div>
            <div class="good-a"><a href="#">TOTAL QUARTZ ENERGY 9000 0W30</a></div>
            <div class="good-name">Моторное масло TOTAL синтетическое</div>
            <div class="good-fas">Фасовка: <span>1; 4; 5; 208 л.</span></div>
            <div class="good-art">Артикул: <span>151515, 151513, 151512, 151514</span></div>
            <div class="good-price">Цена: <span>от 885 руб.</span></div>
            <div class="good-detailed"><a href="#">Подробнее</a></div>		
        </div>
        <div class="good nechet">
            <div class="razd"></div>
            <div class="good-photo"><a href="#"><img alt="" src="/themes/default/images/picture.png"/></a></div>
            <div class="good-a"><a href="#">TOTAL QUARTZ ENERGY 9000 0W30</a></div>
            <div class="good-name">Моторное масло TOTAL синтетическое</div>
            <div class="good-fas">Фасовка: <span>1; 4; 5; 208 л.</span></div>
            <div class="good-art">Артикул: <span>151515, 151513, 151512, 151514</span></div>
            <div class="good-price">Цена: <span>от 885 руб.</span></div>
            <div class="good-detailed"><a href="#">Подробнее</a></div>		
        </div>
        <div class="good">
            <div class="razd"></div>
            <div class="good-photo"><a href="#"><img alt="" src="/themes/default/images/picture.png"/></a></div>
            <div class="good-a"><a href="#">TOTAL QUARTZ ENERGY 9000 0W30</a></div>
            <div class="good-name">Моторное масло TOTAL синтетическое</div>
            <div class="good-fas">Фасовка: <span>1; 4; 5; 208 л.</span></div>
            <div class="good-art">Артикул: <span>151515, 151513, 151512, 151514</span></div>
            <div class="good-price">Цена: <span>от 885 руб.</span></div>
            <div class="good-detailed"><a href="#">Подробнее</a></div>		
        </div>
    </div>
</div>
<?php } ?>
<?php if (sizeof($this->layout()->news) || sizeof($this->layout()->articles)) { ?>
<div class="white-fon">
    <div class="white-fon-m">
        <?php if (sizeof($this->layout()->news)) { ?>
        <div class="main-news">
            <h2><a href="/news/">Новости</a></h2>
            <?php foreach ($this->layout()->news as $new) { ?>
            <div class="news"> 
                <?php if($new['picture'] != '') { ?>
                <div class="news-photo" style="position: relative;">
                    <a href="<?php echo '/news/' . ($new['url'] ? $new['url'] . '-' : '') . $new['id'] . '.html'; ?>">
                        <img width="122px" alt="" src="/<?php echo $new['picture']; ?>p.jpg" />
                        <?php if ($new['stock']) { ?><img width="60%" style="border: 0; position: absolute; bottom: 0; right: 0;" src="/images/stock.png" /><?php } ?>
                    </a>
                </div>
                <?php } ?>
                <span class="news-date"><?php echo $this->Date($new['posted'], 'date'); ?></span>
                <span class="news-r">|</span>
                <span class="news-views">Просмотров: <?php echo $new['view']; ?></span>
                <div class="news-a"><?php echo $this->Link('/news/' . ($new['url'] ? $new['url'] . '-' : '') . $new['id'] . '.html', $new['name']); ?></div>
                <div><?php echo $new['short']; ?></div>
            </div>
            <?php } ?>
        </div>
        <?php } ?>
        <?php if (sizeof($this->layout()->articles)) { ?>
        <div class="main-articles">
            <h2><a href="/articles/">Статьи</a></h2>
            <?php foreach ($this->layout()->articles as $article) { ?>
            <div class="news"> 
                <?php if($article['picture'] != '') { ?>
                <div class="news-photo">
                    <a href="<?php echo '/articles/' . $article['section_url'] . '/' . ($article['url'] ? $article['url'] . '-' : '') . $article['id'] . '.html'; ?>">
                        <img width="122px" alt="" src="/<?php echo $article['picture']; ?>p.jpg" />
                    </a>
                </div>
                <?php } ?>
                <span class="news-date"><?php echo $this->Date($article['posted'], 'date'); ?></span>
                <span class="news-r">|</span>
                <span class="news-views">Просмотров: <?php echo $article['view']; ?></span>
                <div class="news-a">
                    <?php echo $this->Link('/articles/' . $article['section_url'] . '/' . ($article['url'] ? $article['url'] . '-' : '') . $article['id'] . '.html', $article['name']); ?>
                </div>
                <div><?php echo $article['short']; ?></div>
            </div>	
            <?php } ?>
        </div>
        <?php } ?>
    </div>
</div>
<?php } ?>
<?php } */ ?>