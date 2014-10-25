<?php
// init addon
$REX['ADDON']['name']['ckeditor'] = 'CKEditor';
$REX['ADDON']['page']['ckeditor'] = 'ckeditor';
$REX['ADDON']['version']['ckeditor'] = '2.5.0';
$REX['ADDON']['author']['ckeditor'] = "RexDude";
$REX['ADDON']['supportpage']['ckeditor'] = 'forum.redaxo.de';
$REX['ADDON']['perm']['ckeditor'] = 'ckeditor[]';

// permissions
$REX['PERM'][] = 'ckeditor[]';

if ($REX['REDAXO']) {
	// add lang file
	$I18N->appendFile($REX['INCLUDE_PATH'] . '/addons/ckeditor/lang/');

	// includes
	require($REX['INCLUDE_PATH'] . '/addons/ckeditor/classes/class.rex_ckeditor_utils.inc.php');

	// default settings (user settings are saved in data dir!)
	$REX['ADDON']['ckeditor']['settings'] = array(
		'smart_strip' => true,
		'resize_grip' => false
	);

	// overwrite default settings with user settings
	rex_ckeditor_utils::includeSettingsFile();

	// add subpages
	$REX['ADDON']['ckeditor']['SUBPAGES'] = array(
		array('', $I18N->msg('ckeditor_start')),
		array('lite_module', $I18N->msg('ckeditor_lite_module')),
		array('image_module', $I18N->msg('ckeditor_image_module')),
		array('standard_module', $I18N->msg('ckeditor_standard_module')),
		array('settings', $I18N->msg('ckeditor_settings')),
		array('help', $I18N->msg('ckeditor_help'))
	);

	// add css/js to page header
	if (rex_request('page') != 'mediapool' && rex_request('page') != 'linkmap') { // needed for new redaxo.js patching the link dialog etc., as outehwise insertLink() etc. is definied twice
	   rex_register_extension('OUTPUT_FILTER', 'rex_ckeditor_utils::addToOutputFilter'); // better loading time with output filter and avoids flickering
	}
}
?>
