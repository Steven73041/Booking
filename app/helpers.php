<?php
if (!function_exists('get_author')) {
	function get_author() {
		return __('Anastasis Mastoris');
	}
}

if (!function_exists('get_image')) {
	function get_image($img_src, $type = '') {
		$img = explode(".", $img_src);
		if ($type !== '') {
			switch ($type) {
				case "card":
					$size = "_232x132";
					break;
				case "single_room":
					$size = "_500x350";
					break;
				default:
					$size = null;
					break;
			}
		}
		return $img[0] . $size . "." . $img[1];
	}
}