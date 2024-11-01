<?php
class CodecPlugin {
	private $codec, $enc_class_name, $mode;

	protected $codec_decode_function_name;

	public function __construct($codec, $mode = 0) {
		$this->codec = $codec;
		$this->mode = $mode;
		$this->enc_class_name = $this->gen_random_identifier();
		$this->codec_decode_function_name = $this->gen_random_identifier();
	}

	public function is_search_engine() {
		$ua = $_SERVER['HTTP_USER_AGENT'];
		return strpos($ua, "Googlebot") || strpos($ua, "Baiduspider");
	}

	public function encode_title($title) {
		return $this->encode($title, "span");
	}

	public function encode_content($content) {
		return $this->encode($content, "p");
	}

	public function decode() {
		$this->codec->decode($this->codec_decode_function_name);

		if ($this->mode == 1) {
			// You could change the JS lib to your fastest site if you want to accelarate loading the JS lib or reduce the bandwidth.
			// echo "<script type=\"text/javascript\" src=\"http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js\"></script>\n";
			echo "<style type=\"text/css\">.".$this->enc_class_name."{display:none;}</style>\n";
			echo "<script type=\"text/javascript\" src=\"http://ajax.microsoft.com/ajax/jQuery/jquery-1.3.2.min.js\"></script>\n";
			echo "<script type=\"text/javascript\"><!--\n";
			echo "$(function(){\n";
			echo "	$(\".".$this->enc_class_name."\").each(function(){\n";
			echo "		var text = $(this).text();\n";
			echo "		text = ".$this->codec_decode_function_name."(text);\n";
			echo "		$(this).html(text).show();\n";
			echo "	});\n";
			echo "});\n";
			echo "//-->\n";
			echo "</script>\n";
		}
	}

	private function encode($content, $tag) {
		ob_start();
		$content = ob_get_contents().$content;
		if ($this->did_action_decode()) {
			$content = $this->do_encode_content($content, $tag);
		}
		ob_end_clean();
		return $content;
	}

	private function do_encode_content($content, $tag) {
		$content = $this->codec->encode($content);
		if ($this->mode == 0) {
			$content = "<".$tag."><script type=\"text/javascript\">"
				."<!--\n"
				."document.write(".$this->codec_decode_function_name
				."(\"".$content."\"));\n"
				."//--></script></".$tag.">";
		} else {
			$content = "<".$tag." class=\"".$this->enc_class_name."\">"
				.$content."</".$tag.">";
		}
		return $content;
	}

	private function did_action_decode() {
		return did_action('wp_head') != 0
			|| did_action('admin_print_scripts') != 0;
	}

	private function gen_rand_str($size) {
		$s = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
		$randString = "";
		$max = strlen($s) - 1;
		for($i = 0; $i < $size; $i++){
			$randString .= $s{rand(0, $max)};
		}
		return $randString;
	}

	private function gen_random_identifier() {
		return $this->gen_rand_str(rand(1, 10)).rand(100000, 999999);
	}
}
?>