<?php
/*
Plugin Name: wp-codec-cn
Plugin URI: http://liuchangjun.com/tag/codec/
Version: 0.2-SNAPSHOT
Author: Star
Author URI: http://liuchangjun.com/
Description: Encode / decode the posts and comments with one of the following algorithms: base64, phpjsrsa, rune word etc.
*/
/*
Revision:
0.1 - 2009.9.21 - initial version.
0.2 - 2010.1.17 - rebuild the architecture to add the algorithms easyly, update by zhoushuqun.

Refer to:
http://secret.moumentei.com/
http://jquery.com/
http://www.webtoolkit.info/
*/

require("codec.php");

// Add option link to the admin menu.
add_action('admin_menu', 'wp_codec_cn_options');

if (!$codec_plugin->is_search_engine()) {
	/* 
	Add encode for posts and comments 
	*/
	// add_filter('the_title', 'encode_title');	// encode the title
	add_filter('the_content', 'encode_content');	// encode the posts
	add_filter('comment_text', 'encode_content');	// encode the comments
	add_action('wp_head', 'decode');	// add decode script in the head of wordpress
	add_action('admin_print_scripts', 'decode');	// add decode script in the admin head of wordpress
}
?>
