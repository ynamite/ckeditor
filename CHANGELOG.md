CKEditor AddOn - Changelog
==========================

### Version 2.2.0 - 08. Februar 2014

* Fixed #17: Geschützte Leerzeichen werden nicht mehr komplett entfernt, thx@webghost
* Fixed #16: Smart Strip Einstellung greift jetzt auch, wenn man den CKEditor per CSS Klasse `ckeditor` aufruft
* Resize Grip Einstellung hinzugefügt um zu steuern ob der Resize Grip zum vergrößern des Editors angezeigt wird
* Weitereführende Links und Artikel u.a. von webghost in die Readme gepackt

### Version 2.1.1 - 27. Januar 2014

* Image2 Plugin aus Litemodul entfernt, da unter Umständen Bilder per Copy And Paste im Editor landen konnten
* Fehlende ColorButtons zum Standardmodul hinzugefügt
* Bestätigungsdialog bei Modulaktualisierung hinzugefügt
* Finetuning

### Version 2.1.0 - 24. Januar 2014

* Module verbessert, CKEditor Replace jetzt per Textarea ID
* Custom Styles Beispiel in der Readme verbessert (vollständiges Beispiel-Modul hinzugefügt). Kommt jetzt ganz ohne eine extra CSS-Datei aus, thx@webghost
* Bilder haben einen Abstand bekommen zum Text
* Standard Modul: Alle verfügbaren Buttons und somit Funktionen hinzugefügt

### Version 2.0.0 - 23. Januar 2014

* AddOn Rewrite inkl. Update auf CKEditor 4.3.2 Standard + einige extra Plugins (siehe Readme)
* 2 neue Beispielmodule mit integrierter Konfiguration
* Medienpool-Button zum Image-Dialog hinzugefügt
* Smart Strip Einstellung um leere P's und multiple BR's zu entfernen
* Abschnitt "CKEditor Toolbar Buttons" zur Readme hinzugefügt, thx@webghost
* Abschnitt "Custom Styles hinzufügen (ausgehend vom Lite Modul)" zur Readme hinzugefügt, thx@webghost
* Finetuning

### Version 1.0.5 - 22. September 2013

* Mögliche mehrfach vorkommende BRs werden nun herausgefiltert. Der User hat so keine Chance mehr künstliche Abstände zu erzeugen.

### Version 1.0.4 - 09. September 2013

* Plugin `help` hinzugefügt. Durch Klick auf den entsprechenden Button wird eine Kurzhilfe für Redakteure angezeigt.
* `pastefromword` Plugin aktualisiert
* Der Target-Tab wurde im Link-Dialog standardmäßig ausgeschaltet. Über die Option `linkShowTargetTab` in der `config.js` wieder einzuschalten.

### Version 1.0.3 - 27. Mai 2013

* Per CSS-Klasse `ckeditor` kann man den CKEditor auch in den MetaInfos oder im XForm TableManager verwenden.
* Die Option `lazy_load` wurde standardmäßig auf `false` gesetzt in der `settings.inc.php`. Damit ist der CKEditor jetzt überall im Backend einsatzbereit.
* Per Link-Dialog lassen sich nun auch Email-Adressen nutzen. Wer den [Email Obfuscator](https://github.com/RexDude/email_obfuscator) einsetzt sollte bitte darauf achten Version 1.2.6 und höher zu nutzen!

### Version 1.0.2 - 19. April 2013

* Table Dialog angepasst und auf das Wesentliche reduziert
* Lazy Loading Option eingebaut um den CKEditor erst zu laden wenn er auch wirklich gebraucht wird

### Version 1.0.1 - 12. April 2013

* I18N Support
* Eingabe-Modul checkt ob das AddOn installiert ist

### Version 1.0.0 - 11. April 2013



