<?php

if (!function_exists('math_clamp')) {
	function math_clamp($current, $min, $max) {
		return max($min, min($max, $current));
	}
}