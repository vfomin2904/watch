$(document).ready(function(){	

	var $i = 1;
		
	$('#mini_photo img').click(function(){
		if(!($(this).hasClass('active'))){
			$('.active').removeClass('active');
			$(this).addClass('active');
			var src = $(this).attr('src');
			$('#photo_box img:first').attr('src',src);
		}
	});
	
	$('.login_rev').click(function(){
		$('#door').click();
	});
	$('.write_rev').click(function(){
		$('#send_rev_box').css({'display':'block'});
		$('#rev_form textarea:first').focus();
	});
	$('#hide').click(function(){
		$(this).parent().parent().css({'display':'none'});
	});
	
	$('#buybutton').click(function(){
		var id = $(this).closest('#info_box').attr("prod_id");
		$.ajax({
			type: "POST",
			url: "scripts/cart.php",
			data:{
				id : id,
				count : 1
			},
			cache: false
		});
		var t = Number($('#cart').attr('count'));
		var cart_count = Number($('#cart').attr('count'))+$i;
		if(cart_count<=10)
			$('#cart').find('img').eq(1).attr('src','../img/cart_'+cart_count+'.png');
		$(this).text('Добавлено').attr('id','addbutton');
		$i++;
	});
});