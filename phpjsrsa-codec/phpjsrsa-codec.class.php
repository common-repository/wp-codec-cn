<?php
/**
 * http://code.google.com/p/phpjsrsa/
 */
require("phpjsrsa/BigInteger.php");
require("phpjsrsa/BigIntext.php");
require("phpjsrsa/rsa.class.php");

class phpjsrsaCodec implements Codec {
	private $phpjsrsabasepath = "wp-codec-cn/phpjsrsa-codec/phpjsrsa";
	private $RSA, $keys;

	public function __construct() {
		$this->RSA = new RSA();
		$this->keys = $this->RSA->generate_keys ('62700433', '62702257');
	}

	public function encode($content) {
		$time1=time();
		$content = $this->RSA->encrypt ($content, $this->keys[1], $this->keys[0], 6);
		$time2=time()-$time1;
		echo $time2;
		return $content;
	}

	public function decode($decode_function_name) {
		// You could change the JS lib to your fastest site if you want to accelarate loading the JS lib or reduce the bandwidth.
		echo "<script type='text/javascript' src='".plugins_url($this->phpjsrsabasepath."/jsbn.js")."'></script>\n";
		echo "<script type='text/javascript' src='".plugins_url($this->phpjsrsabasepath."/jsbn2.js")."'></script>\n";
		echo "<script type='text/javascript' src='".plugins_url($this->phpjsrsabasepath."/rsa.js")."'></script>\n";
		echo "<script type='text/javascript'>\n";
		echo "<!--\n";
		echo "function ".$decode_function_name."(text) {\n";
		echo "	return decrypt(text, ".$this->keys[2].", ".$this->keys[0].");\n";
		echo "}\n";
		echo "//-->\n";
		echo "</script>\n";
	}
}
?>