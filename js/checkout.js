$(document).ready(function(){	
  $("#phone").mask("+7 (999) 999-99-99");
  
	$('select').eq(0).change(change_select);
	$('#checkout').click(function(){
			if($('#checkout_form').find('input').eq(0).val() == ''){
				alert('Введите название города');
				return false;
			}
			else if($('#checkout_form').find('input').eq(1).val() == ''){
				alert('Введите название улицы');
				return false;
			}
			else if($('#checkout_form').find('input').eq(2).val() == ''){
				alert('Введите номер дома');
				return false;
			}
			else if($('#checkout_form').find('input').eq(3).val() == ''){
				alert('Введите номер квартиры');
				return false;
			}
			else if(($('#checkout_form').find('input').eq(6).val() == '') && $('select').eq(0).val() == '2'){
				alert('Введите почтовый индекс');
				return false;
			}
			else if(($('#checkout_form').find('input').eq(7).val() == '') && $('select').eq(0).val() == '2'){
				alert('Введите имя получателя');
				return false;
			}
			else if(($('#checkout_form').find('input').eq(8).val() == '') && $('select').eq(0).val() == '2'){
				alert('Введите фамилию получателя');
				return false;
			}
			else if(($('#checkout_form').find('input').eq(10).val() == '') && ($('#checkout_form').find('input').eq(11).val() == '')) {
				alert('Введите номер телефона или email');
				return false;
			}
			
			return true;
	});
	change_select();
});

function change_select(){
	switch ($(this).val()) {
		  case '1':
			$('select').eq(1).prepend( $('<option selected value="1">Наличными курьеру</option>'));
			$('select').eq(1).find('option').last().remove();
			$('.adr_block').eq(6).css({'display':'none'});
			$('#name').css({'display':'none'});
			$('#index').css({'display':'none'});
			$('#checkout_form').find('input').eq(0).val('Москва').attr('readonly','readonly');
			break;
		  case '2':
			$('select').eq(1).find('option').eq(0).remove();
			$('select').eq(1).append( $('<option value="3">Наложенным платежом</option>'));
			$('.adr_block').eq(6).css({'display':'block'});
			$('#index').css({'display':'block'});
			$('#name').css({'display':'block'});
			$('#checkout_form').find('input').eq(0).val('').attr('readonly',false).val('');
			
			break;
		}
}