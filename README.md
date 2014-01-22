CKEditor AddOn für REDAXO 4
===========================

Der [CKEditor](http://ckeditor.com/) für REDAXO inkl. eines Beispielmoduls.

Features
--------

* CKEditor 4.3.2 Standard
* REDAXO Lite Modul mit einer minimalen Konfiguration, sowie Standard Modul
* CKEditor Einstellungen werden im Modul direkt vorgenommen
* Verbesserter Linkdialog: Unterstützung für Links über REDAXO Linkmap und Medienpool
* Vereinfachter Tabellendialog
* Kurzhilfe für Redakteure

Custom Styles hinufügen (ausgehend vom Lite Modul)
--------------------------------------------------

* `Styles` Combobox zur Toolbar hinzufügen: `['Format', 'Styles'],`
* Datei `/files/addons/ckeditor/custom.css` anlegen und gewünschtes CSS hinzufügen (z.b. `.green { color: green; }`) 
* Custom CSS Datei in der CKEditor Config im Modul mit angeben: `contentsCss: ['/files/addons/ckeditor/custom.css', CKEDITOR.basePath + 'contents.css']`
* Im Modul ein neues StyleSet für den CKEditor hinzufügen (ausserhalb von `CKEDITOR.replace` aber innerhalb von `jQuery(document).ready(function($)`):

```javascript
CKEDITOR.stylesSet.add( 'default', [
	{ name: 'Grün', element: 'span', attributes: { 'class': 'green' } },
	{ name: 'Blau',	element: 'span', attributes: { 'class': 'blue' } }
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
* [webghostx](https://github.com/webghostx) für die investigative Arbeit mit der CKEdior Config ;)

