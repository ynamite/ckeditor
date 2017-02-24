$(document).on('rex:ready', function (event, container) {
    CKEDITOR.on('dialogDefinition', function(ev) {

        // Dialog name und Devinition/Tabs
        var dialogName = ev.data.name;
        var dialogTabs = ev.data.definition;

        // Plugin image2 ///////////////////////////////////////////////////////
        if (dialogName == 'image') {
            var infoTab = dialogTabs.getContents('info');
            var urlField = infoTab.get('txtUrl');
            urlField['className'] = 'rex-url';

			infoTab.remove('htmlPreview');
			infoTab.remove('medialink');
            infoTab.add({
                type: 'button',
                id: 'medialink',
                label: 'Medienpool Link',
                align: 'center',
                style: 'display:inline-block; position: absolute; right: 23px; top: 116px;',
                onClick: function() {
                     rex_getLinkfromMediaPool();
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
                           rex_getLinkfromLinkMap();

                        }
                    },
                    {
                        type: 'button',
                        id: 'medialink',
                        label: 'Medienpool Link',
                        style: 'float : right;',
                        onClick: function() {
                             rex_getLinkfromMediaPool();
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
}); // end document ready

function rex_getLinkfromLinkMap() {
	var linkMap = openLinkMap();

	$(linkMap).on('rex:selectLink', function (event, linkurl, linktext) {
		event.preventDefault();
		linkMap.close();

		jQuery('.rex-url input').val(linkurl);
		jQuery('.rex-protocol option:last').prop('selected', true);
	});
}

function rex_getLinkfromMediaPool() {
	var mediapool = openMediaPool('ckeditor_medialink');

	$(mediapool).on('rex:selectMedia', function (event, filename) {
		event.preventDefault();
		mediapool.close();
	
		jQuery('.rex-url input').val("/media/" + filename);
		jQuery('.rex-protocol option:last').prop('selected', true); // only for link dialog
	});
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

   
