/**
 * @license Copyright (c) 2003-2014, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see LICENSE.html or http://ckeditor.com/license
 */

CKEDITOR.editorConfig = function( config ) {
	// Define changes to default configuration here.
	// For the complete reference:
	// http://docs.ckeditor.com/#!/api/CKEDITOR.config

	config.fillEmptyBlocks = false;
	config.forcePasteAsPlainText = true;
	config.entities = false;
	config.linkShowTargetTab = false;
	config.format_tags = 'p;h2;h3';
	config.removePlugins = 'elementspath';
	config.extraPlugins = 'rex_help';
	config.removeDialogTabs = 'link:advanced';
	config.toolbar = [
		['Format'],
		['Bold', 'Italic'],
		['NumberedList', 'BulletedList', '-', 'Outdent', 'Indent'],
		['Link', 'Unlink', 'Anchor'],
		['Table'],
		['PasteText', 'PasteFromWord'],
		['rex_help']
		// no comma after last entry!!!
	];
};

