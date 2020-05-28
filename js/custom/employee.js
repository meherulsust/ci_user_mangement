$(document).ready(function(){               
	$('.datepicker').datepicker({
		format: 'yyyy-mm-dd',
		autoclose: true
	});	
	
	$('.chosen-select').chosen();
	
	$('#department_id').selectChain({
	    target: $('#employee_id'),
	    value:'title',
	    url: site_url+'ajax/get_employee',
	    type: 'post',
		data:{department_id: 'department_id'}
	});	
		
	$("#salary").keyup(function(){
		var salary = $('#salary').val();
		$.ajax({
			type: "POST",
			url: site_url+'employee/convert_number_to_words',
			data: 'salary='+salary,
			success: function(response){
				$("#salary_word").html(response);
			}
		});
		return false;
	});
		
});
