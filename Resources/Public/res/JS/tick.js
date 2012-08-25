var packageNameUrl = 'index.php/laeuft.tick/';

jQuery(document).ready(function() {
	jQuery('#showNewTemplateFields').click(function() {
		jQuery(this).parent().find('#newTemplateForm').toggle("slow");
	});
	jQuery('#showNewTaskGroupFields').click(function() {
		jQuery(this).parent().find('#newTaskgroupForm').toggle("slow");
	});
	jQuery('#showNewTaskFields').click(function() {
		jQuery(this).parent().parent().parent().parent().find('#newTaskForm').toggle("slow");
	});
});

jQuery('#createTemplate').live('click', function() {
	var path = jQuery('base').attr('href') + packageNameUrl + 'Template/create';
	var parameter = 'name=' + jQuery('#templateName').val();
	ajaxRequest(path, parameter);
});


function ajaxRequest(path, parameter) {
	$.ajax({
		url: path,
		data: parameter,
		beforeSend: function() {
			/* $('#process_loader').show();
			$('#checkUrl_verifyAction').attr('disabled', 'disabled'); */
		},
		success: function(result) {
			/* if (result) {
				if (result == 'ok') {
					$('#checkUrl_verifyAction').removeAttr('disabled');
					$('#result').show();
					$('#error').text('');
					$('#error').hide();
				} else {
					$('#checkUrl_verifyAction').removeAttr('disabled');
					$('#result').hide();
					$('#error').show();
					$('#error').text(result);
				}
				$('#process_loader').hide();
			} */
		}
	});
}