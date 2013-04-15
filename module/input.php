<?php
// module: ckeditor_default_in

if (OOAddon::isAvailable("ckeditor")) {
	if ($REX['ADDON']['ckeditor']['settings']['lazy_load']) {
		// lazy load ckeditor files
		echo rex_ckeditor_utils::getHtml();
	}
?> 

<textarea name="VALUE[1]" id="ckeditor" class="ckeditor" style="display: none;">REX_VALUE[1]</textarea>

<script type="text/javascript">
jQuery(document).ready( function($) {
	$('#REX_FORM').submit(function() {
		// strip empty paragraphs out if there are any, can also be done via php in output module
		var data = CKEDITOR.instances.ckeditor.getData();
	
		if (data.match(/<p>\s*<\/p>\s\s+/g) || data.indexOf("<p></p>") != -1 || data.indexOf("<p>&nbsp;</p>") != -1) {
			data = data.replace(/<p>\s*<\/p>\s\s+/g, '');
			data = data.replace("<p></p>", "");
			data = data.replace("<p>&nbsp;</p>", "");
			CKEDITOR.instances.ckeditor.setData(data);
		}

		return true;
	});
});	
</script>

<?php 
} else { 
	echo rex_warning('Dieses Modul ben&ouml;tigt das CKEditor Addon!'); 
}
?>
