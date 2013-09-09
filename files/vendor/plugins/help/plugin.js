/**
 * Basic sample plugin inserting helpeviation elements into CKEditor editing area.
 *
 * Created out of the CKEditor Plugin SDK:
 * http://docs.ckeditor.com/#!/guide/plugin_sdk_sample_1
 */

// Register the plugin within the editor.
CKEDITOR.plugins.add( 'help', {

	// Register the icons.
	icons: 'help',

	// The plugin initialization logic goes inside this method.
	init: function( editor ) {

		// Define an editor command that opens our dialog.
		editor.addCommand( 'help', new CKEDITOR.dialogCommand( 'helpDialog' ) );

		// Create a toolbar button that executes the above command.
		editor.ui.addButton( 'help', {

			// The text part of the button (if available) and tooptip.
			label: 'Kurzhilfe',

			// The command to execute on click.
			command: 'help',

			// The button placement in the toolbar (toolbar group name).
			toolbar: 'help'
		});

		// Register our dialog file. this.path is the plugin folder path.
		CKEDITOR.dialog.add( 'helpDialog', this.path + 'dialogs/help.js' );
	}
});

