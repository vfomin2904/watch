$(document).ready(function(){	

	$('#reg').click(function(){
			if($('#checkout_form').find('input').eq(0).val() == ''){
				alert('������� ���');
				return false;
			}
			else if($('#checkout_form').find('input').eq(1).val() == ''){
				alert('������� email');
				return false;
			}
			else if($('#checkout_form').find('input').eq(2).val() == ''){
				alert('������� ������');
				return false;
			}
			else if($('#checkout_form').find('input').eq(3).val() == ''){
				alert('������� ������ ��������');
				return false;
			}
			else if(($('#checkout_form').find('input').eq(2).val()) != ($('#checkout_form').find('input').eq(3).val())){
				alert('��������� ������ �� ���������');
				return false;
			}
			else if($('#checkout_form').find('input').eq(2).val().length <6){
				alert('������ ������ ��������� ���� �� 6 ��������');
				return false;
			}
			
			return true;
	});
});