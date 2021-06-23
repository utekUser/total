$(document).ready(function() {
	$('.up-window-item').hover(
		function() {
            item_top = $(this).offset().top;
            item_left = $(this).offset().left;		
            item_width = $(this).width();
            ttt = $("#up-window");
			ttt_width = ttt.height();
			
   		 	ttt.css({'left': item_left - 20, 'top': item_top - ttt_width + 5});
            ttt.show();
		}
		,
		function() {
			$('.up-window').hide();
		}
	);
	ttt = $('#up-window').hover(
		
		function() {
            ttt.show();
		}
		,
		function() {
			$('.up-window').hide();
		}
	);
});