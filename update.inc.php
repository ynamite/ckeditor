<?php

// if one day ckeditor_update_msg value will be changed, key name + update.inc.php must be changed too, otherwise user will get old msg!

if ($I18N->hasMsg('ckeditor_update_msg')) {
	$msg = $I18N->msg('ckeditor_update_msg');
} else {
	$msg = 'CKEditor AddOn: Bitte beachten Sie die <a href="index.php?page=ckeditor&subpage=help&chapter=update">Update-Hinweise</a>.';
}

echo rex_info($msg);

$REX['ADDON']['update']['ckeditor'] = 1;
