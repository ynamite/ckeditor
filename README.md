CKEditor AddOn für REDAXO 4
===========================

Der [CKEditor](http://ckeditor.com/) für REDAXO inkl. eines Beispielmoduls.

Features
--------

* CKEditor 4.3.2 Standard
* REDAXO Lite Modul mit einer minimalen Konfiguration, sowie Standard Modul
* CKEditor Einstellungen werden im Modul direkt vorgenommen
* Linkdialog: Unterstützung für Links über REDAXO Linkmap und Medienpool
* Imagedialog: Unterstützung für Mediepool-Links
* Vereinfachter Tabellendialog
* Kurzhilfe für Redakteure

CKEditor Plugins
----------------

* Hinzugefügt: Color Button, Div Container Manager, Enhanced Image, Justify, Show Table Borders, rex_help
* Entfernt: About CKEditor, Accessibility Help, Image, SpellCheckAsYouType (SCAYT), WebSpellChecker
* Modifiziert: Image2, Link, Table

CKEditor in AddOns wie XForm, MetaInfos etc. einsetzen
------------------------------------------------------

Die Textarea muss lediglich die CSS-Klasse `ckeditor` zugewiesen bekommen. Möchte man eine spezielle Konfiguration so muss man wie in den Modulen vorgehen.

Mehrere CKEditoren in einem Modul
---------------------------------

```html
<textarea id="ckeditor1" name="VALUE[1]" style="display: none;">REX_VALUE[1]</textarea><br />
<textarea id="ckeditor2" name="VALUE[2]" style="display: none;">REX_VALUE[2]</textarea>

<script type="text/javascript">
jQuery(document).ready(function($) {
	CKEDITOR.replace('ckeditor1', {
		height: 200,
		// ...
	});

	CKEDITOR.replace('ckeditor2', {
		height: 400,
		// ...
	});
});
</script>
```

Custom Styles hinzufügen
------------------------

Das Modul (hier das Lite Modul) muss wie folgt ergänzt werden:

* Die Styles Combobox zur Toolbar hinzufügen
* Custom CSS für den Editor hinzufügen (contentsCss)
* Ein neues StyleSet hinzufügen

```html
<textarea id="ckeditor1" name="VALUE[1]" style="display: none;">REX_VALUE[1]</textarea>

<script type="text/javascript">
jQuery(document).ready(function($) {
	CKEDITOR.replace('ckeditor1', {
		height: 400,
		fillEmptyBlocks: false,
		forcePasteAsPlainText: true,
		entities: false,
		linkShowTargetTab: false,
		format_tags: 'p;h2;h3',
		removePlugins: 'elementspath',
		extraPlugins: 'rex_help',
		removeDialogTabs: 'link:advanced',
		toolbar: [
			['Format', 'Styles'],
			['Bold', 'Italic'],
			['NumberedList', 'BulletedList', '-', 'Outdent', 'Indent'],
			['Link', 'Unlink', 'Anchor'],
			['Table'],
			['PasteText', 'PasteFromWord'],
			['rex_help']
			// no comma after last entry!!!
		],
		contentsCss: [CKEDITOR.basePath + 'contents.css', 
			'.green { background: lightgrey; color: green; }' +
			'.blue { background: lightgrey; color: blue; }'
			// no plus after last entry!!!
		]
		// no comma after last entry!!!
	});

	CKEDITOR.stylesSet.add('default', [
		{ name: 'Grün', element: 'span', attributes: { 'class': 'green' } },
		{ name: 'Blau', element: 'span', attributes: { 'class': 'blue' } }
		// no comma after last entry!!!
	]);
});
</script>
```

CKEditor Toolbar Buttons
------------------------

* Source, Save, NewPage, DocProps, Preview, Print, Templates, document
* Cut, Copy, Paste, PasteText, PasteFromWord, Undo, Redo
* Find, Replace, SelectAll, Scayt
* Form, Checkbox, Radio, TextField, Textarea, Select, Button, ImageButton, HiddenField
* Bold, Italic, Underline, Strike, Subscript, Superscript, RemoveFormat
* NumberedList, BulletedList, Outdent, Indent, Blockquote, CreateDiv, JustifyLeft, JustifyCenter, JustifyRight, JustifyBlock, BidiLtr, BidiRtl
* Link, Unlink, Anchor
* CreatePlaceholder, Image, Flash, Table, HorizontalRule, Smiley, SpecialChar, PageBreak, Iframe, InsertPre
* Styles, Format, Font, FontSize
* TextColor, BGColor
* UIColor, Maximize, ShowBlocks
* About

Hinweise
--------

* Getestet mit REDAXO 4.5
* AddOn-Ordner lautet: `ckeditor`
* Alle CKEditor Config-Optionen: http://docs.ckeditor.com/#!/api/CKEDITOR.config
* Email-Adressen erscheinen im Klartext im Quellcode. Es wird deshalb so ein Tool wie der [Email Obfuscator](https://github.com/RexDude/email_obfuscator) empfohlen um die Email-Adressen vor Spambots zu schützen.
* Durchgeführte Modifizierungen am CKEditor: https://github.com/RexDude/ckeditor/issues/15

Changelog
---------

siehe [CHANGELOG.md](CHANGELOG.md)

Lizenz
------

* CKEditor: siehe `/ckeditor/files/vendor/LICENSE.md`
* CKEditor REDAXO AddOn: [LICENSE.md](LICENSE.md)

Credits
-------

* [CKEditor](http://ckeditor.com/)
* [Parsedown](http://parsedown.org/) Class by Emanuil Rusev
* [Xong](https://github.com/xong) für die RegEx-Hilfe
* [webghostx](https://github.com/webghostx) für die investigative Arbeit mit der CKEditor Config ;)

