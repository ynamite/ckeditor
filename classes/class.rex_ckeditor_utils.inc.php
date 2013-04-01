<?php
class rex_ckeditor_utils {
	public static function appendToPageHeader($params) {
		global $REX;

		$insert = '<!-- BEGIN ckeditor -->' . PHP_EOL;
		$insert .= '<link rel="stylesheet" type="text/css" href="../' . self::getMediaAddonDir() . '/ckeditor/rex_custom.css" />' . PHP_EOL;
		//$insert .= '<script type="text/javascript">var CKEDITOR_BASEPATH = "../' . self::getMediaAddonDir() . '/ckeditor/vendor/";</script>' . PHP_EOL;
		$insert .= '<script type="text/javascript" src="../' . self::getMediaAddonDir() . '/ckeditor/vendor/ckeditor.js"></script>' . PHP_EOL;
		$insert .= '<!-- END ckeditor -->';
	
		return $params['subject'] . PHP_EOL . $insert;
	}

	protected static function getMediaAddonDir() {
		global $REX;

		// check for media addon dir var introduced in REX 4.5
		if (isset($REX['MEDIA_ADDON_DIR'])) {
			return $REX['MEDIA_ADDON_DIR'];
		} else {
			return 'files/addons';
		}
	}
}

