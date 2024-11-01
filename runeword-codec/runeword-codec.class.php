<?php
/**
 * http://tubewall.zobyhost.com/enc/index.php
 */
require("runeword/runeword.php");

class runewordCodec implements Codec {
	private $runewordbasepath = "wp-codec-cn/runeword-codec/runeword";
	public function encode($content) {
		return rw_encode($content);
	}

	public function decode($decode_function_name) {
		global $alpha;
		echo "<script type=\"text/javascript\" src=\"".plugins_url($this->runewordbasepath."/runeword.js")."\"></script>\n";
		echo "<script type=\"text/javascript\">\n";
		echo "<!--\n";
		echo "var runes=\"".$alpha."\";\n";
		echo "function ".$decode_function_name."(text) {\n";
		echo "	return twRuneWord.decode(text);\n";
		echo "}\n";
		echo "//-->\n";
		echo "</script>\n";
	}
}
?>