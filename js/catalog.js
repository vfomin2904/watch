$(document).ready(function(){	
	var count = $('.describe').size();
	var $i = 1;
	for(var i = 0;i<count;i++){
		var h = $('.prod_window').eq(i).find('img').height();
		if(h>225){
			$('.prod_window').eq(i).find('img').width(190).css({'margin-left':'25px'});
		}
	}
	
	$('.buybutton').click(function(){
		var id = $(this).closest('.prod_window').attr("prod_id");
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
		$(this).text('Добавлено').removeClass('buybutton').addClass('addbutton');
		$i++;
	});
});