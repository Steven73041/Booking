<?php

use Illuminate\Support\Facades\Storage;

if (!function_exists('get_image_path')) {
	function get_image_path($image_name) {
		return asset('storage/'.$image_name);
//		return Storage::disk('public')->url($image_name);
	}
}