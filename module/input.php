<?php
// module: ckeditor_default_in
?>

<textarea name="VALUE[1]" class="ckeditor" style="display: none;">REX_VALUE[1]</textarea>

<script type="text/javascript">
jQuery(document).ready( function($) {
	$('#REX_FORM').submit(function() {
		// strip empty paragraphs out if there are any, can also be done via php in output module
		var data = CKEDITOR.instances.ckeditor.getData();
	
		if (data.match(/<p>\s*<\/p>\s\s+/g)) {			
			data = data.replace(/<p>\s*<\/p>\s\s+/g, '');
			CKEDITOR.instances.ckeditor.setData(data);
		}

		return true;
	});
});	
</script>
