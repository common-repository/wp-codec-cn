<?php
class CodecOptionManager {
	private $option_name = "wp-codec-cn";

	public function get_option() {
		$codec_alg = get_option($this->option_name);
		if ($codec_alg == "") {
			$codec_alg = "base64";
		}
		return $codec_alg;
	}

	public function update_option($codec_alg) {
		update_option($this->option_name, $codec_alg);
	}
}
?>