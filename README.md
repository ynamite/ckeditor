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

Mehrere CKEditors in einem Modul
--------------------------------

```html
<textarea name="VALUE[1]" style="display: none;">REX_VALUE[1]</textarea><br />
<textarea name="VALUE[2]" style="display: none;">REX_VALUE[2]</textarea>

<script type="text/javascript">
jQuery(document).ready(function($) {
	CKEDITOR.replace('VALUE[1]', {
		height: 200,
		// ...
	});

	CKEDITOR.replace('VALUE[2]', {
		height: 400,
		// ...
	});
});
</script>
```

Custom Styles hinzufügen (ausgehend vom Lite Modul)
--------------------------------------------------

* Datei `/files/addons/ckeditor/custom.css` anlegen und CSS hinzufügen z.b. `.green { color: green; }`
* Im Modul die Custom CSS Datei in der CKEditor Config angeben: `contentsCss: ['/files/addons/ckeditor/custom.css', CKEDITOR.basePath + 'contents.css']`
* Im Modul die Styles Combobox zur Toolbar hinzufügen: `['Format', 'Styles']`
* Im Modul ein neues StyleSet für den CKEditor hinzufügen (ausserhalb von `CKEDITOR.replace` aber innerhalb von `jQuery(document).ready(function($)`):

```javascript
CKEDITOR.stylesSet.add( 'default', [
	{ name: 'Grün', element: 'span', attributes: { 'class': 'green' } },
	{ name: 'Blau', element: 'span', attributes: { 'class': 'blue' } }
	// no comma after last entry!!!
]);
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
* Per CSS-Klasse `ckeditor` kann man den CKEditor auch in den MetaInfos oder im XForm TableManager verwenden.
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

