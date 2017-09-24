$(document).ready(function(){	

	$('#reg').click(function(){
			if($('#checkout_form').find('input').eq(0).val() == ''){
				alert('¬ведите ‘»ќ');
				return false;
			}
			else if($('#checkout_form').find('input').eq(1).val() == ''){
				alert('¬ведите email');
				return false;
			}
			else if($('#checkout_form').find('input').eq(2).val() == ''){
				alert('¬ведите пароль');
				return false;
			}
			else if($('#checkout_form').find('input').eq(3).val() == ''){
				alert('¬ведите пароль повторно');
				return false;
			}
			else if(($('#checkout_form').find('input').eq(2).val()) != ($('#checkout_form').find('input').eq(3).val())){
				alert('¬веденные пароли не совпадают');
				return false;
			}
			else if($('#checkout_form').find('input').eq(2).val().length <6){
				alert('ѕароль должен содержать хот€ бы 6 символов');
				return false;
			}
			
			return true;
	});
});