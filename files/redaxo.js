jQuery(document).ready(function($) {
    CKEDITOR.on('dialogDefinition', function(ev) {

        // Dialog name und Devinition/Tabs
        var dialogName = ev.data.name;
        var dialogTabs = ev.data.definition;

        // Plugin table ////////////////////////////////////////////////////////
        /*
		if (dialogName == 'table') {

            // auf das Tab 'info' bezogen
            var infoTab = dialogTabs.getContents('info');
            // Felder entfernen        
            infoTab.remove('txtWidth');
            infoTab.remove('txtHeight');
            infoTab.remove('txtBorder');
            infoTab.remove('txtCellSpace');
            infoTab.remove('txtCellPad');
            infoTab.remove('cmbAlign');
            infoTab.remove('txtSummary');
            infoTab.remove('txtCaption');
        }//endif
		*/

        // Plugin image2 ///////////////////////////////////////////////////////
        if (dialogName == 'image2') {
            /*
             * image2 später zu rexImage (neues Plugin).. und anpassungen machen
             */
            // auf das Tab 'info' bezogen
            var infoTab = dialogTabs.getContents('info');
            var src = infoTab.get('src');
            src['className'] = 'rex-url';
            infoTab.add({
                type: 'button',
                id: 'medialink',
                label: 'Medienpool Link',
                align: 'center',
                style: 'display:inline-block;margin-top:14px;',
                onClick: function() {
                    openMediaPool('TINY');
                }
            });
        }//endif

        // Plugin link /////////////////////////////////////////////////////////
        if (dialogName == 'link') {

            // auf das Tab 'info' bezogen
            var infoTab = dialogTabs.getContents('info');
            // Entfernen da nicht kompatibel mit Email Obfuscator
            infoTab.remove('emailSubject');
            infoTab.remove('emailBody');
            var linkType = infoTab.get('linkType');
            linkType[ 'items' ] = [// unwichtig - nur Reihenfolge geändert
                ['URL', 'url'], //###lang
                ['E-Mail', 'email'], //###lang
                ['Anker in diesem Block', 'anchor']//###lang
            ];
            var protocol = infoTab.get('protocol');
            protocol['className'] = 'rex-protocol';
            protocol[ 'items' ] = [
                ['http://\u200E', 'http://'],
                ['https://\u200E', 'https://'],
                ['<andere>', ''] //###lang
            ];
            var url = infoTab.get('url');
            url['className'] = 'rex-url';
            url[ 'onKeyUp' ] = function() {
                this.allowOnChange = false;
                var protocolCmb = this.getDialog().getContentElement('info', 'protocol'),
                        url = this.getValue(),
                        urlOnChangeProtocol = /^(http|https):\/\/(?=.)/i,
                        urlOnChangeTestOther = /^((redaxo|files)|[#\/\.\?])/i;
                var protocol = urlOnChangeProtocol.exec(url);
                if (protocol) {
                    this.setValue(url.substr(protocol[ 0 ].length));
                    protocolCmb.setValue(protocol[ 0 ].toLowerCase());
                } else if (urlOnChangeTestOther.test(url))
                    protocolCmb.setValue('');
                this.allowOnChange = true;
            };
            infoTab.remove('urlOptions');
            infoTab.add({
                type: 'vbox',
                id: 'urlOptions',
                children: [
                    {
                        type: 'hbox',
                        widths: ['25%', '75%'],
                        children: [
                            {
                                id: 'protocol',
                                type: 'select',
                                className: 'rex-protocol',
                                label: 'Protokoll', //###lang
                                'default': 'http://',
                                items: [
                                    // Force 'ltr' for protocol names in BIDI. (#5433)
                                    ['http://\u200E', 'http://'],
                                    ['https://\u200E', 'https://'],
                                    ['<andere>', '']//###lang
                                ],
                                setup: function(data) {
                                    if (data.url)
                                        this.setValue(data.url.protocol || '');
                                },
                                commit: function(data) {
                                    if (!data.url)
                                        data.url = {};

                                    data.url.protocol = this.getValue();
                                }
                            },
                            {
                                type: 'text',
                                id: 'url',
                                label: 'URL', //###lang
                                required: true,
                                className: 'rex-url',
                                onLoad: function() {
                                    this.allowOnChange = true;
                                },
                                onKeyUp: function() {
                                    this.allowOnChange = false;
                                    var protocolCmb = this.getDialog().getContentElement('info', 'protocol'),
                                            url = this.getValue(),
                                            urlOnChangeProtocol = /^(http|https):\/\/(?=.)/i,
                                            urlOnChangeTestOther = /^((redaxo|files)|[#\/\.\?])/i;

                                    var protocol = urlOnChangeProtocol.exec(url);
                                    if (protocol) {
                                        this.setValue(url.substr(protocol[ 0 ].length));
                                        protocolCmb.setValue(protocol[ 0 ].toLowerCase());
                                    } else if (urlOnChangeTestOther.test(url))
                                        protocolCmb.setValue('');

                                    this.allowOnChange = true;
                                },
                                onChange: function() {
                                    if (this.allowOnChange) // Dont't call on dialog load.
                                        this.onKeyUp();
                                },
                                validate: function() {
                                    var dialog = this.getDialog();

                                    if (dialog.getContentElement('info', 'linkType') && dialog.getValueOf('info', 'linkType') != 'url')
                                        return true;

                                    if ((/javascript\:/).test(this.getValue())) {
                                        alert('ungültiger Wert');//###lang
                                        return false;
                                    }

                                    if (this.getDialog().fakeObj) // Edit Anchor.
                                        return true;

                                    var func = CKEDITOR.dialog.validate.notEmpty('URL fehlt');//###lang
                                    return func.apply(this);
                                },
                                setup: function(data) {
                                    this.allowOnChange = false;
                                    if (data.url)
                                        this.setValue(data.url.url);
                                    this.allowOnChange = true;

                                },
                                commit: function(data) {
                                    // IE will not trigger the onChange event if the mouse has been used
                                    // to carry all the operations #4724
                                    this.onChange();

                                    if (!data.url)
                                        data.url = {};

                                    data.url.url = this.getValue();
                                    this.allowOnChange = false;
                                }
                            }
                        ],
                        setup: function(data) {
                            if (!this.getDialog().getContentElement('info', 'linkType'))
                                this.getElement().show();
                        }
                    },
                    {
                        type: 'button',
                        id: 'internallink',
                        label: 'Interner Link',
                        style: 'float : right;',
                        onClick: function() {
                            openLinkMap("TINY", "&clang=" + getParam("clang"));
                        }
                    },
                    {
                        type: 'button',
                        id: 'medialink',
                        label: 'Medienpool Link',
                        style: 'float : right;',
                        onClick: function() {
                            openMediaPool('TINY');
                        }
                    }
                ]
            });
            // auf das Tab 'target' bezogen
            var targetTab = dialogTabs.getContents('target');
            var linkTargetType = targetTab.get('linkTargetType');
            linkTargetType[ 'items' ] = [
                ['normal', 'notSet'],
                ['neues Fenster', '_blank']
            ];
        }//endif
    }); // end dialogDefinition

    $('form').submit(function() {
		for (var i in CKEDITOR.instances) {
			var data = CKEDITOR.instances[i].getData();
			var doDataUpdate = false;

			// replace &nbsp;
			if (data.indexOf("&nbsp;") != -1) {
				data = data.replace(/&nbsp;/g, "  ");
				doDataUpdate = true;
			}

			// replace multiple <br>s with a single one
			if (data.indexOf("<br />\n<br />") != -1 || data.indexOf("<br />\r\n<br />") != -1 || data.indexOf("<br /><br />") != -1) {
				data = data.replace(/(<br\s*\/?>\s*)+/igm, "<br />\n");
				doDataUpdate = true;
			}

			// replace leading <br>s
			if (data.match(/(<(?!br)(\w)[^>]*>)(\s*<br\s*\/?>\s*)+/igm)) {
				data = data.replace(/(<(?!br)(\w)[^>]*>)(\s*<br\s*\/?>\s*)+/igm, '$1');
				doDataUpdate = true;
			}

			// replace trailing <br>s
			if (data.match(/(\s*<br\s*\/?>\s*)+(<\/(?!br)(\w)>)/igm)) {
				data = data.replace(/(\s*<br\s*\/?>\s*)+(<\/(?!br)(\w)>)/igm, '$2');
				doDataUpdate = true;
			}

			// replace empty paragraphs
			if (data.match(/(<p>(\s|&nbsp;|<br\s*\/?>)*<\/p>)/igm)) {
				data = data.replace(/(<p>(\s|&nbsp;|<br\s*\/?>)*<\/p>)/igm, '');
				doDataUpdate = true;
			}

			if (doDataUpdate) {
				CKEDITOR.instances[i].setData(data);
			}
		}

		return true;
	});
}); // end document ready

function insertLink(link, name) {
    jQuery('.rex-url input').val(link);
    jQuery('.rex-protocol option:last').attr("selected", "selected");
}
function insertFileLink(link) {
    jQuery('.rex-url input').val("/" + link);
    // only for link dialog
    jQuery('.rex-protocol option:last').attr("selected", "selected");
}
function getParam(variable) {
    var query = window.location.search.substring(1);
    var vars = query.split("&");
    for (var i = 0; i < vars.length; i++) {
        var pair = vars[i].split("=");
        if (pair[0] == variable) {
            return pair[1];
        }
    }
    return(false);
}

   
