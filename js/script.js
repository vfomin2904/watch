$(document).ready(function(){	
	$('#question img').click(function(){
		$('#overlay').css({'display':'none'});
		$('#question').css({'display':'none'});
		$('body, html').css({'overflow':'auto'});
	});
	$('#send_question').click(function(){
		var email = $('#question').find('input').eq(0).val(),
		question = $('#question').find('textarea').val();
		$.ajax({
				type: "POST",
				url: "scripts/send_question.php",
				data:{
					email : email,
					question : encodeURIComponent(question)
				},
				cache: false,
				success: function(data) {
					$('<div class="success">Изменения сохранены</div>').insertAfter('header').fadeOut(3000);
				}
			});
		var href = window.location.href;
		location.href = href+"?success_message=Вопрос  отправлен";
	});
	$('#menu a:last, #footer_menu a:last').click(function(){
		if($(window).width() >= '960' && $(window).height() >= '400'){
			$('#overlay').css({'display':'block'});
			$('#question').css({'display':'block'});
			$('body,html').animate({scrollTop:0}, 250);
			$('body, html').css({'overflow':'hidden'});
			return false;
		}
	});
	$('.in').click(function(){
		$('#overlay').css({'display':'block'});
		$('#login').css({'display':'block'});
		$('body,html').animate({scrollTop:0}, 250);
		$('body, html').css({'overflow':'hidden'});
	});
	$('.out').click(function(){
		var href = window.location.href;
		location.href = "scripts/signout.php?href="+href;
	});
	$('#login img').click(function(){
		$('#overlay').css({'display':'none'});
		$('#login').css({'display':'none'});
		$('body, html').css({'overflow':'auto'});
	});
	
	$('.error').fadeOut(2500);
	$('.success').fadeOut(2500);
});