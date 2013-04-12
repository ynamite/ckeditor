<?php
// init addon
$REX['ADDON']['name']['ckeditor'] = 'CKEditor';
$REX['ADDON']['page']['ckeditor'] = 'ckeditor';
$REX['ADDON']['version']['ckeditor'] = '1.0.1';
$REX['ADDON']['author']['ckeditor'] = "RexDude";
$REX['ADDON']['supportpage']['ckeditor'] = 'forum.redaxo.de';
$REX['ADDON']['perm']['ckeditor'] = 'ckeditor[]';

// permissions
$REX['PERM'][] = 'ckeditor[]';

if ($REX['REDAXO']) {
	// includes
	require($REX['INCLUDE_PATH'] . '/addons/ckeditor/classes/class.rex_ckeditor_utils.inc.php');
	require($REX['INCLUDE_PATH'] . '/addons/ckeditor/settings.inc.php');

	// add lang file
	$I18N->appendFile($REX['INCLUDE_PATH'] . '/addons/ckeditor/lang/');

	// add css/js to page header
	//if (rex_request('page') == 'content' && rex_request('function') == 'add' || rex_request('function') == 'edit') { // better loading time and avoids flickering when using this
		rex_register_extension('PAGE_HEADER', 'rex_ckeditor_utils::appendToPageHeader');
	//}
}
?>
