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