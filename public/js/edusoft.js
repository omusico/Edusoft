 $("#add").click(function() {
 $('#table-settings tbody>tr:last')
    .clone(true)
    .insertAfter('#table-settings tbody>tr:last').hide().fadeIn().find('input').each(function(){
        $(this).val('');
    });
});


  $("#remove").click(function() {
 $('#table-settings tbody>tr:last-child')
    .remove()
  
    });






$( "#datepicker" ).datepicker();
			
			$('#startdate').datepicker({
				dateFormat : 'dd/mm/yy',
				changeMonth: true,
				changeYear: true,
				prevText : '<i class="fa fa-chevron-left"></i>',
				nextText : '<i class="fa fa-chevron-right"></i>',
				onSelect : function(selectedDate) {
					$('#enddate').datepicker('option', 'minDate', selectedDate);
				}
			});
			
			$('#enddate').datepicker({
				dateFormat : 'dd/mm/yy',
				changeMonth: true,
				changeYear: true,
				prevText : '<i class="fa fa-chevron-left"></i>',
				nextText : '<i class="fa fa-chevron-right"></i>',
				onSelect : function(selectedDate) {
					$('#startdate').datepicker('option', 'maxDate', selectedDate);
				}
			});

			
				// Validation
				$("#session").validate({

					// Rules for form validation
					rules : {
						year: {
							required : true
						},
						term : {
							required : true
							
						},
						startdate : {
							required : true
							
						},
						enddate : {
							required : true
							
						},
						
					},

					// Messages for form validation
					messages : {
						year : {
							required : 'Please select a year'
						},
						term : {
							required : 'Please select a term'
						},

						startdate : {
							required : 'input startdate'
							
						},

						enddate : {
							required : 'input enddate'
							
						},
					},

					// Do not change code below
					errorPlacement : function(error, element) {
						error.insertAfter(element.parent());
					},

				});




		function showimagepreview(input) {
        if (input.files && input.files[0]) {
        var filerdr = new FileReader();
        filerdr.onload = function(e) {
        $('#imageupload').attr('src', e.target.result);
        }
        filerdr.readAsDataURL(input.files[0]);
        }
        }


         function showpreview(input) {
        if (input.files && input.files[0]) {
        var filerdr = new FileReader();
        filerdr.onload = function(e) {
        $('#imageuploads').attr('src', e.target.result);
        }
        filerdr.readAsDataURL(input.files[0]);
        }
        }

   


		$('#dob').datepicker({
				dateFormat : 'dd/mm/yy',
				changeMonth: true,
				changeYear: true,
				prevText : '<i class="fa fa-chevron-left"></i>',
				nextText : '<i class="fa fa-chevron-right"></i>',
				
			});
			
			
		$('#admDate').datepicker({
				dateFormat : 'dd/mm/yy',
				changeMonth: true,
				changeYear: true,
				prevText : '<i class="fa fa-chevron-left"></i>',
				nextText : '<i class="fa fa-chevron-right"></i>',
				
			});