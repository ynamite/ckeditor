<?php
// module: ckeditor_lite_in
?> 

<textarea id="ckeditor1" name="VALUE[1]" style="display: none;">REX_VALUE[1]</textarea>

<script type="text/javascript">
jQuery(document).ready(function($) {
	CKEDITOR.replace('ckeditor1', {
		height: 400,
		fillEmptyBlocks: false,
		forcePasteAsPlainText: true,
		entities: false,
		linkShowTargetTab: false,
		format_tags: 'p;h2;h3',
		removePlugins: 'elementspath',
		extraPlugins: 'rex_help',
		removeDialogTabs: 'link:advanced',
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
