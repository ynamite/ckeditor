<?php
class rex_ckeditor_utils {
	public static function addToOutputFilter($params) {
		return str_replace('</body>', self::getHtml() . '</body>', $params['subject']);
	}

	public static function getHtml() {
		$html = PHP_EOL;

		$html .= '<!-- BEGIN ckeditor -->' . PHP_EOL;
		$html .= '<link rel="stylesheet" type="text/css" href="../' . self::getMediaAddonDir() . '/ckeditor/rex_custom.css" />' . PHP_EOL;
		//$insert .= '<script type="text/javascript">var CKEDITOR_BASEPATH = "../' . self::getMediaAddonDir() . '/ckeditor/vendor/";</script>' . PHP_EOL;
		$html .= '<script type="text/javascript" src="../' . self::getMediaAddonDir() . '/ckeditor/vendor/ckeditor.js"></script>' . PHP_EOL;
		$html .= '<!-- END ckeditor -->';

		return $html;
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

