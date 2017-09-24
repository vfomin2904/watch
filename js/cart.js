$(document).ready(function(){	
	var $i =1;
	$('.count_col').find('img:first').click(function(){
		var cur_count = $(this).next().val();
		var id = $(this).closest('.product').attr('id');
		if(cur_count>1){
			$(this).next().val(cur_count-1);
			change_price(this);
			total();
			$.ajax({
				type: "POST",
				url: "scripts/change_cart.php",
				data:{
					id : id,
					cur_count : cur_count-1
				},
			cache: false
			});
		}
	});
	$('.count_col').find('img:last').click(function(){
		var cur_count = Number($(this).prev().val());
		var id = $(this).closest('.product').attr('id');
		if(cur_count<3){
		$(this).prev().val(Number(cur_count)+1);
		 change_price(this);
		 total();
		 $.ajax({
				type: "POST",
				url: "scripts/change_cart.php",
				data:{
					id : id,
					cur_count : cur_count+1
				},
			cache: false
			});
		}
	});
	$('.delete').click(function(){
		var result = confirm("Вы уверены, что хотите удалить данный товар из корзины?");
		if(result){
			var id = $(this).closest('.product').attr('id');
			var cart_count = $('#cart').attr('count')-$i;
			$.ajax({
				type: "POST",
				url: "scripts/change_cart.php",
				data:{
					id : id
				},
			cache: false
			});
			$(this).closest('.product').remove();
			total();
			if(cart_count<=10)
			$('#cart').find('img').eq(1).attr('src','../img/cart_'+cart_count+'.png');
			$i++;
			if($('.product').size() == 0){
				$('#totalPrice, #order').css({'display':'none'});
				$('#empt').css({'display':'block'});
			}
		}
	});
	total();

	for(var i =0;i<$('.count_col').length;i++){
		var obj = $('.count_col').eq(i).find('img');
		change_price(obj);
	}
	
});

function change_price(obj){
	var oldprice = $(obj).siblings('.price').attr('price');
	var k = $(obj).siblings('input').val();
	price = Number(oldprice) * k;
	$(obj).siblings('.price').find('span').text(price);
}

function total(){
	var a = $('.product').length;
	var total = 0;
	for(var i =0;i<a;i++){
		total += Number($('.price').eq(i).find('span').text()) * Number($('.count_col').eq(i).find('input').val());
	}
	$('#totalPrice').find('span').text(total);
}