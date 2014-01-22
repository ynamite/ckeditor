<?php
// module: ckeditor_lite_in
?> 

<textarea name="VALUE[1]" style="display: none;">REX_VALUE[1]</textarea>

<script type="text/javascript">
jQuery(document).ready(function($) {
	CKEDITOR.replace('VALUE[1]', {
		height: 400,
		fillEmptyBlocks: false,
		forcePasteAsPlainText: true,
		entities: false,
		linkShowTargetTab: false,
		format_tags: 'p;h2;h3',
		removePlugins: 'elementspath',
		extraPlugins: 'rex_help',
		removeButtons: '',
		toolbar: [
			['Format'],
			['Bold', 'Italic'],
			['NumberedList', 'BulletedList', '-', 'Outdent', 'Indent'],
			['Link', 'Unlink', 'Anchor'],
			['Table'],
			['PasteText', 'PasteFromWord'],
			['rex_help']
			// no comma after last entry!!!
		]
		// no comma after last entry!!!
	});
});
</script>

<style type="text/css">
/* Remove resizer grip of dialogs */
.cke_dialog_footer .cke_resizer {
	display: none !important;
}

/* Remove resizer grip of texteditor */
.cke_bottom .cke_resizer {
	visibility: hidden !important;
}
</style>
