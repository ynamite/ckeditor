<?php
// module: ckeditor_standard_in
?> 

<textarea name="VALUE[1]" style="display: none;">REX_VALUE[1]</textarea>

<script type="text/javascript">
jQuery(document).ready(function($) {
	CKEDITOR.replace('VALUE[1]', {
		height: 400,
		fillEmptyBlocks: false,
		forcePasteAsPlainText: true,
		entities: false,
		linkShowTargetTab: true,
		//format_tags: '',
		removePlugins: 'div,justify,colorbutton',
		extraPlugins: 'rex_help',
		removeButtons: '',
		toolbarGroups: [
			{ name: 'clipboard',   groups: [ 'clipboard', 'undo', 'align' ] },
			{ name: 'editing',     groups: [ 'find', 'selection' ] },
			{ name: 'links' },
			{ name: 'insert' },
			{ name: 'forms' },
			{ name: 'tools' },
			{ name: 'document',	   groups: [ 'mode', 'document', 'doctools' ] },
			{ name: 'others' },
			'/',
			{ name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ] },
			{ name: 'paragraph',   groups: [ 'list', 'indent', 'blocks' ] },
			{ name: 'styles' },
			{ name: 'colors' },
			{ name: 'rex_help' }
			// no comma after last entry!!!
		]
		// no comma after last entry!!!
	});
});
</script>

