<?php
require("codec-option-manager.class.php");
require("codec-plugin.class.php");
require("codec.interface.php");

$codec_option_manager = new CodecOptionManager();
// codec algorithm
$codec_alg = $codec_option_manager->get_option();

// Create codec instance by reflection.
require($codec_alg."-codec/".$codec_alg."-codec.class.php");
$refClass = new ReflectionClass($codec_alg."Codec");
$codec = $refClass->newInstance();

// Create a codec plugin instance.
$codec_plugin = new CodecPlugin($codec, 1);

/**
 * Add option page link to admin menu.
 */
function wp_codec_cn_options() {
	if (function_exists('add_options_page')) {
		add_options_page('wp-codec-cn', 'wp-codec-cn', 9, 'wp-codec-cn/options.php');
	}
}

/**
 * Title filter.
 */
function encode_title($title) {
	global $codec_plugin;
	return $codec_plugin->encode_title($title);
}

/**
 * Content filter.
 */
function encode_content($content) {
	global $codec_plugin;
	return $codec_plugin->encode_content($content);
}

/**
 * Decode action.
 */
function decode() {
	global $codec_plugin;
	$codec_plugin->decode();
}
?>
