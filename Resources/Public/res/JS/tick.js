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

	// open the modal with the previous appended data
	jQuery('#ajaxLoader').dialog({
		modal: true,
		draggable: false
	});

	jQuery('.ui-dialog-titlebar-close').hide();

	ajaxRequestCreate(path, parameter, 'reloadTemplateList');
});

/**************************************************************
	Check if the create taskgroup button has been clicked.
	Call ajax call to create the taskgroup. After taskgroup
	successfully has been created, reload the taskgroup list.
**************************************************************/
jQuery('#createTaskgroup').live('click', function() {
	var path = jQuery('base').attr('href') + packageNameUrl + 'Taskgroup/create';
	var taskgroupName = jQuery('#name').val();
	var template = jQuery('#template').val();

	var parameter = 'name=' + taskgroupName + '&templateId=' + template;

	var reloadParameter = 'templateId=' + template;

	// open the modal with the previous appended data
	jQuery('#ajaxLoader').dialog({
		modal: true,
		draggable: false
	});

	jQuery('.ui-dialog-titlebar-close').hide();

	ajaxRequestCreate(path, parameter, 'reloadTaskgroupList', reloadParameter);
});

/**************************************************************
	Check if the create task button has been clicked.
	Call ajax call to create the task. After task
	successfully has been created, reload the task list.
**************************************************************/
jQuery('#createTask').live('click', function() {
	var path = jQuery('base').attr('href') + packageNameUrl + 'Task/create';
	var taskName = jQuery('#name').val();
	var taskgroup = jQuery('#taskgroup').val();
	var template = jQuery('#template').val();
	var description = encodeURI(jQuery('#description').val());

	var parameter = 'name=' + taskName;
	parameter += '&description=' + description;
	parameter += '&taskgroupId=' + taskgroup;
	parameter += '&templateId=' + template;

	var reloadParameter = 'taskgroupId=' + taskgroup;

	// open the modal with the previous appended data
	jQuery('#ajaxLoader').dialog({
		modal: true,
		draggable: false
	});

	jQuery('.ui-dialog-titlebar-close').hide();

	ajaxRequestCreate(path, parameter, 'reloadTaskList', reloadParameter);
});

/**************************************************************
	AJAX-Call to create the template.

	Return:
	true	Return true if the request was successfull
	false	Return false if the request was not successfull
**************************************************************/
function ajaxRequestCreate(path, parameter, functionInSuccess, reloadParameter) {
	jQuery.ajax({
		type: 'POST',
		url: path,
		data: parameter,
		async: true,
		success: function(result) {
			window[functionInSuccess](reloadParameter);
		}
	});
}

/**************************************************************
	AJAX-Call to get all templates and replace the current
	list of templates with the complete one.
**************************************************************/
function reloadTemplateList() {
	var path = jQuery('base').attr('href') + packageNameUrl + 'Template/list';
	jQuery.ajax({
		type: 'POST',
		url: path,
		async: true,
		success: function(result) {
			jQuery('#templateList').replaceWith(result);
			jQuery('#ajaxLoader').dialog('close');

			jQuery('#templateName').val('')

			jQuery('#newTemplateForm').hide();
		}
	});
}

/**************************************************************
	AJAX-Call to get all templates and replace the current
	list of templates with the complete one.
**************************************************************/
function reloadTaskgroupList(reloadParameter) {
	var path = jQuery('base').attr('href') + packageNameUrl + 'Taskgroup/list';
	jQuery.ajax({
		type: 'POST',
		url: path,
		data: reloadParameter,
		async: true,
		success: function(result) {
			jQuery('#taskgroupList').replaceWith(result);
			jQuery('#ajaxLoader').dialog('close');

			jQuery('#name').val();

			jQuery('#newTaskgroupForm').hide();
		}
	});
}

/**************************************************************
	AJAX-Call to get all tasks and replace the current
	list of tasks with the complete one.
**************************************************************/
function reloadTaskList(reloadParameter) {
	var path = jQuery('base').attr('href') + packageNameUrl + 'Task/list';
	jQuery.ajax({
		type: 'POST',
		url: path,
		data: reloadParameter,
		async: true,
		success: function(result) {
			jQuery('#taskList').replaceWith(result);
			jQuery('#ajaxLoader').dialog('close');

			jQuery('#name').val('');
			jQuery('#description').val('');
			jQuery('#newTaskForm').hide();
		}
	});
}

/**************************************************************
	Check if the shift up icon has clicked on the taskgroup
	list. Shift the clicked taskgroup up and reload the
	taskgroup list.
**************************************************************/
jQuery('.shiftUpTaskgroup').live('click', function() {
	var path = jQuery('base').attr('href') + packageNameUrl + 'Taskgroup/shift';
	var taskgroup = jQuery(this).parent().parent().parent().find('.taskgroup').val();
	var template = jQuery(this).parent().parent().parent().find('.template').val();

	var parameter = 'taskgroupId=' + taskgroup;
	parameter += '&templateId=' + template;
	parameter += '&shiftDirection=' + -1;

	var reloadParameter = 'templateId=' + template;

	// open the modal with the previous appended data
	jQuery('#ajaxLoader').dialog({
		modal: true,
		draggable: false
	});

	jQuery('.ui-dialog-titlebar-close').hide();

	ajaxRequestCreate(path, parameter, 'reloadTaskgroupList', reloadParameter);
});

/**************************************************************
	Check if the shift down icon has clicked on the taskgroup
	list. Shift the clicked taskgroup down and reload the
	taskgroup list.
**************************************************************/
jQuery('.shiftDownTaskgroup').live('click', function() {
	var path = jQuery('base').attr('href') + packageNameUrl + 'Taskgroup/shift';
	var taskgroup = jQuery(this).parent().parent().parent().find('.taskgroup').val();
	var template = jQuery(this).parent().parent().parent().find('.template').val();

	var parameter = 'taskgroupId=' + taskgroup;
	parameter += '&templateId=' + template;
	parameter += '&shiftDirection=' + 1;

	var reloadParameter = 'templateId=' + template;

	// open the modal with the previous appended data
	jQuery('#ajaxLoader').dialog({
		modal: true,
		draggable: false
	});

	jQuery('.ui-dialog-titlebar-close').hide();

	ajaxRequestCreate(path, parameter, 'reloadTaskgroupList', reloadParameter);
});

/**************************************************************
	Check if the shift up icon has clicked on the task
	list. Shift the clicked task up and reload the
	taskgroup list.
**************************************************************/
jQuery('.shiftUpTask').live('click', function() {
	var path = jQuery('base').attr('href') + packageNameUrl + 'Task/shift';
	var task = jQuery(this).parent().parent().parent().find('.task').val();
	var taskgroup = jQuery(this).parent().parent().parent().find('.taskgroup').val();

	var parameter = 'taskId=' + task;
	parameter += '&taskgroupId=' + taskgroup;
	parameter += '&shiftDirection=' + -1;

	var reloadParameter = 'taskgroupId=' + taskgroup;

	// open the modal with the previous appended data
	jQuery('#ajaxLoader').dialog({
		modal: true,
		draggable: false
	});

	jQuery('.ui-dialog-titlebar-close').hide();

	ajaxRequestCreate(path, parameter, 'reloadTaskList', reloadParameter);
});

/**************************************************************
	Check if the shift down icon has clicked on the task
	list. Shift the clicked task down and reload the
	taskgroup list.
**************************************************************/
jQuery('.shiftDownTask').live('click', function() {
	var path = jQuery('base').attr('href') + packageNameUrl + 'Task/shift';
	var task = jQuery(this).parent().parent().parent().find('.task').val();
	var taskgroup = jQuery(this).parent().parent().parent().find('.taskgroup').val();

	var parameter = 'taskId=' + task;
	parameter += '&taskgroupId=' + taskgroup;
	parameter += '&shiftDirection=' + 1;

	var reloadParameter = 'taskgroupId=' + taskgroup;

	// open the modal with the previous appended data
	jQuery('#ajaxLoader').dialog({
		modal: true,
		draggable: false
	});

	jQuery('.ui-dialog-titlebar-close').hide();

	ajaxRequestCreate(path, parameter, 'reloadTaskList', reloadParameter);
});