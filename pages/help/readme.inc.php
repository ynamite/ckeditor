<?php

$search = array('(CHANGELOG.md)', '(LICENSE.md)');
$replace = array('(index.php?page=ckeditor&subpage=help&chapter=changelog)', '(index.php?page=ckeditor&subpage=help&chapter=license)');

echo rex_ckeditor_utils::getHtmlFromMDFile('README.md', $search, $replace);

