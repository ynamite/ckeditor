<?php
// init addon
$REX['ADDON']['name']['ckeditor'] = 'CKEditor';
$REX['ADDON']['page']['ckeditor'] = 'ckeditor';
$REX['ADDON']['version']['ckeditor'] = '2.2.1';
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

	// add subpages
	$REX['ADDON']['ckeditor']['SUBPAGES'] = array(
		array('', $I18N->msg('ckeditor_start')),
		array('lite_module', $I18N->msg('ckeditor_lite_module')),
		array('standard_module', $I18N->msg('ckeditor_standard_module')),
		array('settings', $I18N->msg('ckeditor_settings')),
		array('help', $I18N->msg('ckeditor_help'))
	);

	// add css/js to page header
	rex_register_extension('OUTPUT_FILTER', 'rex_ckeditor_utils::addToOutputFilter'); // better loading time with output filter and avoids flickering
}
?>
