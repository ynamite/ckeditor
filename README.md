CKEditor AddOn für REDAXO 4
===========================

Der CKEditor für REDAXO inkl. eines Beispielmoduls.

Features
--------

* CKEditor 4.1 Standard
* Grundkonfiguration wurde auf das Nötigste reduziert
* Verbesserter Linkdialog: Unterstützung für Links über REDAXO Linkmap und Medienpool
* Vereinfachter Tabellendialog
* REDAXO-Modul

Hinweise
--------

* Getestet mit REDAXO 4.5
* AddOn-Ordner lautet: `ckeditor`
* Per CSS-Klasse `ckeditor` kann man den CKEditor auch in den MetaInfos oder im XForm TableManager verwenden.
* Email-Adressen erscheinen im Klartext im Quellcode. Es wird deshalb so ein Tool wie der [Email Obfuscator](https://github.com/RexDude/email_obfuscator) (ab v1.2.6!) empfohlen um die Email-Adressen vor Spambots zu schützen.
* Einstellungen für den CKEditor in: `/files/addons/ckeditor/vendor/config.js` (befindet sich also im `'files/addons/` Ordner von REDAXO nicht vom AddOn selbst)

Changelog
---------

siehe [CHANGELOG.md](CHANGELOG.md)

Lizenz
------

* CKEditor: [LICENSE.md](files/vendor/LICENSE.md)
* CKEditor REDAXO AddOn: [LICENSE.md](LICENSE.md)

Credits
-------

* [CKEditor](http://ckeditor.com/)

