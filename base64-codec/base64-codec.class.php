<?php
class base64Codec implements Codec {
	public function encode($content) {
		return str_rot13(base64_encode($content));
	}

	public function decode($decode_function_name) {
		echo "<script type=\"text/javascript\" src=\"http://www.webtoolkit.info/djs/webtoolkit.base64.js\"></script>";
		echo "<script type=\"text/javascript\">\n";
		echo "<!--\n";
		echo "String.prototype.rot13 = function(){\n";
		echo "	return this.replace(/[a-zA-Z]/g, function(c){\n";
		echo "		return String.fromCharCode((c <= \"Z\" ? 90 : 122) >= (c = c.charCodeAt(0) + 13) ? c : c - 26);\n";
		echo "	});\n";
		echo "};\n";
		echo "function ".$decode_function_name."(text) {\n";
		echo "	return Base64.decode(text.rot13());\n";
		echo "}\n";
		echo "//-->\n";
		echo "</script>\n";
	}
}
?>