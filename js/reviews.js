$(document).ready(function(){	
	$('.rev_unlock').click(function(){
		$('#rev_form').css({'display':'block'});
		$('#rev_form').children('textarea').focus();
	});
	$('.rev_lock').click(function(){
		$('#door').click();
	});
	$('#rev_panel img').click(function(){
		$('#overlay').css({'display':'none'});
		$('#rev_panel').css({'display':'none'});
		$('body, html').css({'overflow':'auto'});
	});
	$('#hide').click(function(){
		$(this).parent().css({'display':'none'});;
	});
	$('.remove').click(function(){
		var result = confirm("Вы уверены, что хотите удалить отзыв?");
		var rev_id = $(this).parent().attr('rev_id');
		if(result){
		$.ajax({
			type: "POST",
			url: "scripts/delete_rev.php",
			data:{
				rev_id : rev_id
			},
			cache: false
		});
		$(this).parent().remove();
		}
	});
	
	$('.change').click(function(){
		var rev_id = $(this).parent().attr('rev_id');
		var text = $(this).next('p').html();
		text = text.replace(/\<br>/gi,"\n");
		var obj = $(this).next('p');
		$('<textarea rows="1" cols="52" name="rev_text" required></textarea>').insertAfter(obj);
		$(this).siblings('textarea').val(text).focus();
		$(this).next('p').css({'display':'none'});
		var textarea = $(this).siblings('textarea');
		$('<input class="send_change" type="button" value="Изменить"></input>').insertAfter(textarea);
		$(this).css({'display':'none'});
		
		$('.send_change').click(function(){
		var review = $(this).siblings('textarea').val();
		review = review.replace(/\n/gi,"<br>");
		$(this).siblings('textarea').remove();
		$(this).prev('p').html(review).css({'display':'block'});
		$(this).remove();
		$('.change').css({'display':'block'});
		$.ajax({
		type: "POST",
		url: "scripts/change_rev.php",
		data:{
			rev_id : rev_id,
			review : encodeURIComponent(review)
		},
		cache: false
});
		
	});
	});
});