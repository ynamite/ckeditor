<?php
// module: ckeditor_standard_in
?> 

<textarea name="VALUE[1]" style="display: none;">REX_VALUE[1]</textarea>

<script type="text/javascript">
jQuery(document).ready(function($) {
	CKEDITOR.replace('VALUE[1]', {
		height: 400,
		fillEmptyBlocks: false,
		entities: false,
		removeButtons: '',
		extraPlugins: 'showborders'
		// no comma after last entry!!!
	});
});
</script>

