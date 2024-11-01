<?php
interface Codec {
	public function encode($content);
	public function decode($decode_function_name);
}
?>