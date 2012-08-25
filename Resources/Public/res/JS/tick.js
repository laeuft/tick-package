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

/**************************************************************
	Check if the create template button has been clicked.
	Call ajax call to create the template. After template
	successfully has been created, reload the template list.
**************************************************************/
jQuery('#createTemplate').live('click', function() {
	var path = jQuery('base').attr('href') + packageNameUrl + 'Template/create';
	var parameter = 'name=' + jQuery('#templateName').val();
	ajaxRequest(path, parameter);

	var path = jQuery('base').attr('href') + packageNameUrl + 'Template/list';
	reloadTemplateList(path, '');
});

/**************************************************************
	AJAX-Call to create the template.

	Return:
	true	Return true if the request was successfull
	false	Return false if the request was not successfull
**************************************************************/
function ajaxRequest(path, parameter) {
	jQuery.ajax({
		url: path,
		data: parameter,
		async: false,
		beforeSend: function() {

		},
		success: function(result) {
			return 1;
		}
	});
}

function reloadTemplateList(path, parameter) {
	jQuery.ajax({
		url: path,
		data: parameter,
		async: false,
		beforeSend: function() {

		},
		success: function(result) {
			jQuery('#templateList').replaceWith(result);
		}
	});
}