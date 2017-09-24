var intervalID;
var animation = false;

$(document).ready(function(){	
	intervalID=setInterval(next_slide,4000);
	$('.arrow').eq(0).click(function(){prev_slide()});
	$('.arrow').eq(1).click(function(){next_slide()});
	
	$('#slide').hover(function(){
		$('.arrow').fadeIn(500);
		},function(){
		$('.arrow').fadeOut(500);
		}
	);
	var $i = 1;
	
	$('.buybutton').click(function(){
		var id = $(this).closest('.spec_inner').attr("prod_id");
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
		$(this).text('В корзине').removeClass('buybutton').addClass('addbutton');
		$i++;
	});
});

function next_slide(){
	if(!animation){
		clearInterval(intervalID);
		animation = true;
		var scrollAmount = $('#slide_inner img').width();
		$('#slide_inner img').stop(true,true);
		$('#slide_inner img').first().insertAfter('#slide_inner img:last');
		$('#slide_inner img').css({'left':'+='+scrollAmount});
		$('#slide_inner img').animate({'left':'-=' + scrollAmount}, 700,(function(){animation = false;}));
		intervalID=setInterval(next_slide,4000);
	}
}

function prev_slide(){
	if(!animation){
		clearInterval(intervalID);
		animation = true;
		var scrollAmount = $('#slide_inner img').width();
		$('#slide_inner img').stop(true,true);
		$('#slide_inner img').last().insertBefore('#slide_inner img:first');
		$('#slide_inner img').css({'left':'-='+scrollAmount});
		$('#slide_inner img').animate({'left':'+=' + scrollAmount}, 700,(function(){animation = false;}));
		intervalID=setInterval(next_slide,4000);
	}
}