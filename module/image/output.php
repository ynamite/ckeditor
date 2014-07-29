<?php
if (!function_exists('rex_getAttribute')) {
	function rex_getAttribute($attribute, $value) {
		if ($value != '' || $attribute == 'alt') {
			return ' ' . $attribute . '="' . htmlspecialchars($value) . '"';
		} else {
			return '';
		}
	}
}

if (!function_exists('rex_getImageManagerImageSize')) {
	function rex_getImageManagerImageSize($file, $imageType) {
		global $REX;

		$resizedFile = $REX['INCLUDE_PATH'] . '/generated/files/image_manager__' . $imageType . '_' . $file;
		$imageSize = @getimagesize($resizedFile);

		if ($imageSize == false) {
			return array('width' => '', 'height' => '');
		} else {
			return array('width' => $imageSize[0], 'height' => $imageSize[1]);
		}
	}
}

if (!function_exists('rex_generateImgTag')) {
	function rex_generateImgTag($file, $divClass, $resize, $resizeImageType, $link, $linkType, $linkId, $linkExtern) {
		global $REX;
		
		if (class_exists('seo42')) {
			$imgFile = seo42::getMediaFile($file);
		} else {
			if (isset($REX['MEDIA_DIR'])) {
				$imgFile = $REX['HTDOCS_PATH'] . $REX['MEDIA_DIR'] . '/' . $file;
			} else {
				$imgFile = $REX['HTDOCS_PATH'] . 'files/' . $file;
			}
		}

		$media = OOMedia::getMediaByFileName($file);
	
		// resize
		if ($resize == 'resize') {
			if (class_exists('seo42')) {
				$imgSrc = seo42::getImageManagerFile($file, $resizeImageType);
			} else {
				$imgSrc = $REX['HTDOCS_PATH'] . 'index.php?rex_img_type=' . $resizeImageType . '&rex_img_file=' . $file;
			}

			$imgSize = rex_getImageManagerImageSize($file, $resizeImageType);

			$imgWidth = $imgSize['width'];
			$imgHeight = $imgSize['height'];
		} else {
			$imgSrc = $imgFile;

			$imgWidth = $media->getWidth();
			$imgHeight = $media->getHeight();
		}
	
		// link
		$linkStart = '';
		$linkEnd = '';

		if ($link == 'link') {
			switch ($linkType) {
				case 'imglink':
					$linkStart = '<a class="lightbox magnific-popup-image" href="' . $imgFile . '"' . rex_getAttribute('title', $media->getDescription()) . '>';
					$linkEnd = '</a>';
					break;
				case 'internlink':
					$linkStart = '<a href="' . rex_getUrl($linkId) . '">';
					$linkEnd = '</a>';
					break;
				case 'externlink':
					$linkStart = '<a href="' . $linkExtern . '">';
					$linkEnd = '</a>';
					break;	
			}
		}
	
		// output
		$output = '<div class="' . $divClass . '">';
		$output .= $linkStart;
		$output .= '<img src="' . $imgSrc . '"' . rex_getAttribute('width', $imgWidth) . rex_getAttribute('height', $imgHeight) . rex_getAttribute('alt', $media->getTitle()) . ' />';
		$output .= $linkEnd;
		$output .= '</div>';
	
		return $output;
	}
}

$clear = '';

if ('REX_FILE[1]' != '') {
	echo rex_generateImgTag('REX_FILE[1]', 'REX_VALUE[7]', 'REX_VALUE[2]', 'REX_VALUE[3]', 'REX_VALUE[4]', 'REX_VALUE[8]', 'REX_LINK_ID[1]', 'REX_VALUE[5]');
	$clear = '<div class="clearer"></div>';
}
?>

REX_HTML_VALUE[1]

<?php echo $clear; ?>

