$(document).ready(function(){
	$('#menu li').click(function(){
		var num = $(this).attr('num');
		$('#content').children().css('display','none');
		$('#content').children().eq(num).css('display','block');
		$('.active').removeClass('active');
		$(this).addClass('active');
	});
	$('#send_review').click(function(){
		var name = $(this).parent().siblings('input').eq(0).val(),
		 date = $(this).parent().siblings('input').eq(1).val(),
		 time = $(this).parent().siblings('input').eq(2).val(),
		 review = $(this).parent().siblings('textarea').val();
		 review = review.replace("\n","<br>");
		$.ajax({
			type: "POST",
			url: "scripts/send_review.php",
			data:{
				name : encodeURIComponent(name),
				date : date,
				time: time,
				rev_text: encodeURIComponent(review)
			},
			cache: false,
			success: function(data) {
				
			}
		});
	});
	
	$('#change_prod').click(function(){
		var id = $(this).siblings('input').eq(0).val(),
		name = $(this).siblings('input').eq(1).val(),
		 price = $(this).siblings('input').eq(2).val(),
		 oldprice = $(this).siblings('input').eq(3).val(),
		  discount = $(this).siblings('input').eq(4).val(),
		 description = $(this).siblings('textarea').val();
		 description = description.replace("\n","<br>");
		 if(id){
			$.ajax({
				type: "POST",
				url: "scripts/change_prod.php",
				data:{
					id : id,
					name : encodeURIComponent(name),
					price : price,
					oldprice: oldprice,
					discount: discount,
					description: encodeURIComponent(description)
				},
				cache: false,
				success: function(data) {
					$('<div class="success">Изменения сохранены</div>').insertAfter('header').fadeOut(3000);
				}
			});
		 }
		 else $('<div class="error">Поле ID обязательно для заполнения</div>').insertAfter('header').fadeOut(2000);
	});
});