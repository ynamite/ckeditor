DROP TABLE IF EXISTS `%TABLE_PREFIX%ckeditor_profiles`;

CREATE TABLE `%TABLE_PREFIX%ckeditor_profiles` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `name` varchar(50) NOT NULL DEFAULT '',
  `description` varchar(255) NOT NULL DEFAULT '',
  `jscode` text NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

INSERT INTO `%TABLE_PREFIX%ckeditor_profiles` (`id`, `name`, `description`, `jscode`) VALUES
(1, 'default', 'Einfache CKEditor Konfiguration', '{\r\n    height: 400,\r\n    fillEmptyBlocks: false,\r\n    forcePasteAsPlainText: true,\r\n    entities: false,\r\n    linkShowTargetTab: false,\r\n    format_tags: ''p;h2;h3'',\r\n    removePlugins: ''elementspath'',\r\n    extraPlugins: ''rex_help'',\r\n    removeDialogTabs: ''link:advanced'',\r\n    disallowedContent: ''table{width,height}[align,border,cellpadding,cellspacing,summary];caption;'',\r\n    toolbar: [\r\n        [''Format''],\r\n        [''Bold'', ''Italic''],\r\n        [''NumberedList'', ''BulletedList'', ''-'', ''Outdent'', ''Indent''],\r\n        [''Link'', ''Unlink'', ''Anchor''],\r\n        [''Table''],\r\n        [''PasteText'', ''PasteFromWord''],\r\n        [''Maximize''],\r\n        [''rex_help'']\r\n        // no comma after last entry!!!\r\n    ]\r\n    // no comma after last entry!!!\r\n}');
