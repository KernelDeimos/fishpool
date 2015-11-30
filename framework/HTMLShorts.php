<?php
class HTMLShorts {
	static function includeCSS($src) {
		print('<link rel="stylesheet" type="text/css" href="'.$src.'">');
	}
	static function includeJS($src) {
		print('<script src="'.$src.'"></script>');
	}
	static function metaCharset($set) {
		print('<meta http-equiv="Content-Type" content="text/html" charset="'.$set.'" />');
	}

	static function pre($text) {
		print("<pre>\n");
		print($text."\n");
		print("</pre>\n");
	}
}
