jQuery(document).ready(function() {
	jQuery('#showNewTemplateFields').click(function() {
		jQuery(this).parent().find('#newTemplateForm').show("slow");
	});
	jQuery('#showNewTaskGroupFields').click(function() {
		jQuery(this).parent().find('#newTaskgroupForm').show("slow");
	});
});