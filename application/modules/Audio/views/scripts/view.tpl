<h1><?php echo $this->currentAudio['name']; ?></h1>
<div class="works-menu">
	<div class="video-sm"><a href="#"><img alt="" src="/themes/default/images/video-small.png" /></a></div>
	<div class="foto-sm"><a href="#"><img alt="" src="/themes/default/images/foto-small.png" /></a></div>
	<div class="audio-sm active"><a href="#"><img alt="" src="/themes/default/images/audio-small.png" /></a></div>
	<div class="clear"></div>
	<div class="main-razd"></div>
	<div class="chain">
		<a href="/audio/">Аудио</a>
		<?php echo $this->currentAudio['name']; ?>
	</div>
	<div class="main-razd"></div>
</div>
<div class="block">
	<span class="block-date"><?php echo $this->Date($this->currentAudio['posted'], 'date'); ?></span>
	<span class="block-r">|</span>
	<span class="block-views">Просмотров: <?php echo $this->currentAudio['view']; ?></span>
	<span class="block-r">|</span>
	<span class="block-comments">Комментариев: <?php echo $this->currentAudio['comment']; ?></span>
	<div class="block-title"><?php echo $this->currentAudio['name']; ?></div>
	<?php echo $this->currentAudio['short']; ?>
	<div class="block-audio">
	   <object width="400" height="20" type="application/x-shockwave-flash" data="../../../externals/players/player_mp3_maxi.swf">
    	   <param value="mp3=/<?php echo $this->currentAudio['file']; ?>&amp;showstop=1&amp;showvolume=1&amp;volume=75&amp;width=400" name="FlashVars">
    	   <param value="../../../externals/players/player_mp3_maxi.swf" name="src">
    	</object>
	</div>
	
	<!--<div class="simple-picture"><img alt="" src="/themes/default/images/1.png" /></div>-->
<!--	1. Свадьба Ивана и Дарьи <br/>
	2. Свадьба Ивана и Дарьи <br/>
	3. Свадьба Ивана и Дарьи <br/>-->
</div>


<div class="comments">
	<div class="main-razd"></div>
		<div class="action-container">
			<div class="add-comment left"><a href="#">Оставить комментарий <img src="/themes/default/images/more.png" /></a></div>
			<div class="back right"><a href="/audio/">Вернуться <img src="/themes/default/images/more.png" /></a></div>
		</div>
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
<div class="back"><a href="/audio/">Вернуться <img src="/themes/default/images/more.png" /></a></div>