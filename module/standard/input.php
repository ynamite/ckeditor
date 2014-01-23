<?php
// module: ckeditor_standard_in
?> 

<textarea name="VALUE[1]" class="ckeditor" style="display: none;">REX_VALUE[1]</textarea>

<script type="text/javascript">
jQuery(document).ready(function($) {
	CKEDITOR.replace('VALUE[1]', {
		height: 400,
		fillEmptyBlocks: false,
		forcePasteAsPlainText: false,
		entities: false,
		linkShowTargetTab: true,
		format_tags: 'p;h1;h2;h3;pre',
		removePlugins: '',
		extraPlugins: 'rex_help',
		removeDialogTabs: 'link:advanced',
		toolbar: [
			['Cut', 'Copy', 'Paste', 'PasteText', 'PasteFromWord', '-', 'Undo', 'Redo'],
			['Link', 'Unlink', 'Anchor'],
			['Image', 'Table', 'Seperator', 'HorizontalRule', 'SpecialChar'],
			['Maximize'],
			['Source'],
			'/',
			['Bold', 'Italic', 'Strike', '-', 'RemoveFormat'],
			['NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-', 'Blockquote'],
			['Styles', 'Format'],
			['rex_help']
			// no comma after last entry!!!
		]
		// no comma after last entry!!!
	});
});
</script>

