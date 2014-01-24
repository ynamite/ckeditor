<?php
// module: ckeditor_standard_in
?> 

<textarea id="ckeditor1" name="VALUE[1]" style="display: none;">REX_VALUE[1]</textarea>

<script type="text/javascript">
jQuery(document).ready(function($) {
	CKEDITOR.replace('ckeditor1', {
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
			['CreateDiv'],
			['Maximize'],
			['Source'],
			['rex_help'],
			'/',
			['Format', 'Styles'],
			['Bold', 'Italic', 'Underline', 'Strike', 'Subscript', 'Superscript', '-', 'RemoveFormat'],
			['JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock'],
			['NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-', 'Blockquote']
			// no comma after last entry!!!
		]
		// no comma after last entry!!!
	});
});
</script>

