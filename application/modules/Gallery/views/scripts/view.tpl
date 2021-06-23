<h1><?php echo $this->currentAlbum['name']; ?></h1>
<div class="works-menu">
	<div class="video-sm"><a href="/video/"><img alt="" src="/themes/default/images/video-small.png" /></a></div>
	<div class="foto-sm active"><img alt="" src="/themes/default/images/foto-small.png" /></div>
	<div class="audio-sm"><a href="/audio/"><img alt="" src="/themes/default/images/audio-small.png" /></a></div>
	<div class="clear"></div>
	<div class="main-razd"></div>
	<div class="chain">
		<a href="/gallery/">Фото</a>
		<a href="/gallery/<?php echo $this->sectionUrl; ?>/"><?php echo $this->sectionName; ?></a>
		<?php echo $this->currentAlbum['name']; ?>
	</div>
	<div class="main-razd"></div>
</div>
<div class="title">	
	<span class="block-date"><?php echo $this->Date($this->currentAlbum['posted'], 'date'); ?></span>
	<span class="block-r">|</span>
	<span class="block-views">Просмотров: <?php echo $this->currentAlbum['view']; ?></span>
	<span class="block-r">|</span>
	<span class="block-comments">Комментариев: <?php echo $this->currentAlbum['comment']; ?></span>
	
	<div class="block-title"><?php echo $this->currentAlbum['name']; ?></div>
</div>
<div class="text"><?php echo $this->currentAlbum['short']; ?></div>

<div class="photos">
<?php foreach ($this->albumPhoto as $albumPhoto) { ?>
<a class="gallery" href="/<?php echo $albumPhoto['picture']; ?>b.jpg"><img alt="" src="/<?php echo $albumPhoto['picture']; ?>p.jpg" /></a>
<?php } ?>
</div>

<div class="comments">
	<div class="main-razd"></div>
		<div class="add-comment"><a href="#">Оставить комментарий <img src="images/more.png" /></a></div>
	<div class="main-razd"></div>
	<b>Комментарии:</b>
	<div class="question">
		<span class="question-author">Иван Петрович</span>
		<span class="question-razd">|</span>
		<span class="question-date">22 августа 2011&nbsp;&nbsp;&nbsp;15:20</span>
		<div>Основные социо-культурные моменты 2000х: «убыстрение» и «замедление» времени, особенности
		новоговосприятия («клиповость» сознания и пр.), роль креативности и т.д. Тенденции, влияющие на 
		искусство: конец эпохи репрезентации; синтетические тенденции; выход за рамки «современности» 
		и обращениек предыдущим эпохам (миф, античность, Ренессанс); изменение технологий: цифра, 
		мультимедийность и виртуальность; нейтральность и новая эмоциональность.</div>	
	</div>
	<div class="question">
		<span class="question-author">Иван Петрович</span>
		<span class="question-razd">|</span>
		<span class="question-date">22 августа 2011&nbsp;&nbsp;&nbsp;15:20</span>
		<div>Основные социо-культурные моменты 2000х: «убыстрение» и «замедление» времени, особенности
		новоговосприятия («клиповость» сознания и пр.), роль креативности и т.д. Тенденции, влияющие на 
		искусство: конец эпохи репрезентации; синтетические тенденции; выход за рамки «современности» 
		и обращениек предыдущим эпохам (миф, античность, Ренессанс); изменение технологий: цифра, 
		мультимедийность и виртуальность; нейтральность и новая эмоциональность.</div>	
	</div>
	<div class="spacer"></div>
	<b>Ваш комментарий:</b>
	<div class="main-razd"></div>
	<div class="before-form">Сообщение будет отображаться после проверки администратором! <br />
	Поля, <b>выделенные полужирным</b>, обязательны для заполнения.</div>
	
	<form action="#question" method="post" id="form1" class="guestbook">
		<div class="book-form">
			<div class="book-form-title"><b>Ваше имя:</b></div>
			<div class="book-form-input">
				<input type="text" value="" name="author" class="book-input-i"/>
			</div>
			<div class="book-form-remark"></div>
		</div>
		<div class="book-form">
			<div class="book-form-title">E-mail:</div>
			<div class="book-form-input">
				<input type="text" value="" name="email" class="book-input-i" />
			</div>
			<div class="book-form-remark"></div>
		</div>
		
		<div class="book-form">
			<div class="book-form-title"><b>Сообщение:</b></div>
			<div class="book-form-input">
				<textarea rows="5" cols="45" name="question"></textarea>
			</div>
			<div class="book-form-remark"></div>
		</div>
		<div class="book-form">
			<div class="book-form-title"><b>Код защиты:</b></div>
			<div class="book-form-input">
				<img src="/themes/default/images/capcha.jpg" />
				<div class="book-input-code"><input type="text" value="" name="captcha" /></div>
			</div>
			<div class="book-form-remark"></div>
		</div>
		<div class="book-form">
			<div class="book-form-title">&nbsp;</div>
			<div class="book-form-input">
				<input type="submit" value="" name="button" class="book-button" />
			</div>
			<div class="book-form-remark"></div>
		</div>
	</form>
	<div class="main-razd"></div>
</div>	
	
<div class="back"><a href="#">Вернуться <img src="/themes/default/images/more.png" /></a></div>