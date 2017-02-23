CKEditor AddOn für REDAXO 5
===========================

Der [CKEditor](http://ckeditor.com/) für REDAXO inkl. eines Beispielmoduls.

Features
--------

* CKEditor Full
* REDAXO Modul
* Editor Profile
* Smart Strip Funktion: filtert leere P's und mehrfach vorkommende BR's heraus
* Linkdialog: Unterstützung für Links über REDAXO Linkmap und Medienpool
* Imagedialog: Unterstützung für Links über REDAXO Medienpool
* Vereinfachter Tabellendialog
* Kurzhilfe für REDAXO Redakteure

CKEditor in Modulen einsetzen
------------------------------

```html
<textarea class="ckeditor" data-ckeditor-profile="default" name="REX_INPUT_VALUE[1]">REX_VALUE[1]</textarea>
```

* Die Textarea muss lediglich die CSS-Klasse `ckeditor` zugewiesen bekommen. 
* Desweiteren regelt man über `data-ckeditor-profile` das zu ladende Profil. 
* Wenn nötig kann man über `data-ckeditor-height` die Höhe überschreiben (wird sonst aus dem Profil genommen).

CKEditor in den Metainfos etc. einsetzen
----------------------------------------

* In dem Feldattribute-Feld: `class="ckeditor" data-ckeditor-profile="default"`
* Optional ebenfalls möglich: `data-ckeditor-height="150"`

CKEditor in yForm einsetzen
----------------------------------------
* Im Individuelle Attribute-Feld: `{"class":"ckeditor","data-ckeditor-profile":"default"}`
* Weitere Attribute kommagetrennt möglich.
 

CKEditor Standard Profil
------------------------

```
{
    height: 400,
    fillEmptyBlocks: false,
    forcePasteAsPlainText: false,
    entities: false,
    linkShowTargetTab: true,
    format_tags: 'p;h1;h2;h3;pre',
    removePlugins: '',
    extraPlugins: 'rex_help',
    removeDialogTabs: '',
    disallowedContent: 'table{width,height}[align,border,cellpadding,cellspacing,summary];caption;',
    toolbar: [
        ['Cut', 'Copy', 'Paste', 'PasteText', 'PasteFromWord', '-', 'Undo', 'Redo'],
        ['Link', 'Unlink', 'Anchor'],
        ['Image', 'Table', 'Seperator', 'HorizontalRule', 'SpecialChar'],
        ['TextColor', 'BGColor'],
        ['CreateDiv'],
        ['Maximize'],
        ['Source'],
        ['rex_help'],
        '/',
        ['Format', 'Styles'],
        ['Bold', 'Italic', 'Underline', 'Strike', 'Subscript', 'Superscript', '-', 'RemoveFormat'],
        ['JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock'],
        ['NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-', 'Blockquote']
        // no comma after last entry!!!
    ]
    // no comma after last entry!!!
}
```

Custom Styles hinzufügen
------------------------

Das Profil muss wie folgt ergänzt werden:

* Die __Styles__ Combobox zur Toolbar hinzufügen
* __stylesSet__ definieren, ersetzt das Besetehende das definiert ist in `/assets/addons/ckeditor/vendor/styles.js`
* Custom CSS per __contentsCss__ für den Editor hinzufügen

Hier ein Lite Profil mit Custom Styles:

```
{
    height: 400,
    fillEmptyBlocks: false,
    forcePasteAsPlainText: true,
    entities: false,
    linkShowTargetTab: false,
    format_tags: 'p;h2;h3',
    removePlugins: 'elementspath',
    extraPlugins: 'rex_help',
    removeDialogTabs: 'link:advanced',
    disallowedContent: 'table{width,height}[align,border,cellpadding,cellspacing,summary];caption;',
    toolbar: [
        ['Format', 'Styles'],
        ['Bold', 'Italic'],
        ['NumberedList', 'BulletedList', '-', 'Outdent', 'Indent'],
        ['Link', 'Unlink', 'Anchor'],
        ['Table'],
        ['PasteText', 'PasteFromWord'],
        ['Maximize'],
        ['rex_help']
        // no comma after last entry!!!
    ],
    stylesSet: [
        { name: 'Grün', element: 'span', attributes: { 'class': 'green' } },
        { name: 'Blau', element: 'span', attributes: { 'class': 'blue' } }
        // no comma after last entry!!!
    ],    
    contentsCss: [CKEDITOR.basePath + 'contents.css', 
        '.green { background: lightgrey; color: green; }' +
        '.blue { background: lightgrey; color: blue; }'
        // no plus after last entry!!!
    ]
    // no comma after last entry!!!
}
```

Ausgabe nachträglich manipulieren
---------------------------------

```php
<?php
$text = <<< EOT
REX_VALUE[id=1 output=html]
EOT;

echo strtoupper($text);
?>
```

CKEditor Toolbar Buttons
------------------------

Hinweis: Mache Buttons sind nur verfügbar wenn die zugehörigen CKEditor Plugins installiert wurden.

* Source, Save, NewPage, DocProps, Preview, Print, Templates, document
* Cut, Copy, Paste, PasteText, PasteFromWord, Undo, Redo
* Find, Replace, SelectAll, Scayt
* Form, Checkbox, Radio, TextField, Textarea, Select, Button, ImageButton, HiddenField (benötigt das Forms Plugin!)
* Bold, Italic, Underline, Strike, Subscript, Superscript, RemoveFormat
* NumberedList, BulletedList, Outdent, Indent, Blockquote, CreateDiv, JustifyLeft, JustifyCenter, JustifyRight, JustifyBlock, BidiLtr, BidiRtl
* Link, Unlink, Anchor
* CreatePlaceholder, Image, Flash, Table, HorizontalRule, Smiley, SpecialChar, PageBreak, Iframe, InsertPre
* Styles, Format, Font, FontSize
* TextColor, BGColor
* UIColor, Maximize, ShowBlocks
* About

CKEditor Toolbar Configurator
-----------------------------

Es liegt ein Toolbar Konfigurator im Assets-Vrzeichnis.

Links
-----

* CKEditor Addon für REDAXO konfigurieren: http://usysto.net/blog/redaxo_ckeditor_addon.php
* REDAXO Artikel im Frontend editieren mit dem CKEditor: http://usysto.net/blog/redaxo_frontend_edit_mit_ckeditor.php
* Alle CKEditor Config-Optionen: http://docs.ckeditor.com/#!/api/CKEDITOR.config
* CKEditor Best Practices: http://docs.ckeditor.com/#!/guide/dev_best_practices
* Content Filtering (ACF): http://docs.ckeditor.com/#!/guide/dev_acf

Hinweise
--------

* Getestet mit REDAXO 5.2
* AddOn-Ordner lautet: `ckeditor`
* Bei einem Update des Addons sollte nach der Reinstallation der Browsercache gelöscht werden.

Changelog
---------

siehe `CHANGELOG.md` des AddOns

Lizenz
------

* CKEditor AddOn: MIT-Lizenz, siehe `LICENSE.md` des AddOns
* CKEditor: siehe `LICENSE.md` des CKEditors

Credits
-------

* [CKEditor](http://ckeditor.com/)
* [Xong](https://github.com/xong) für die RegEx-Hilfe
* [webghost](https://github.com/webghostx) für die investigative Arbeit mit der CKEditor Config und und und... ;)

