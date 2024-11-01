<?php
if(isset($_POST['submit'])) {
	$codec_alg = $_POST['codec_alg'];
	$codec_option_manager->update_option($codec_alg);
}

$codec_alg = $codec_option_manager->get_option();
?>
<style type="text/css">
.warning{background-color:#ffff00;color:#ff0000;}
.disabled{color:#666;}
</style>
<?php if (isset($_POST['submit'])) : ?>
<div id="message" class="updated fade"><p><strong><?php _e('Settings saved.') ?></strong></p></div>
<?php endif; ?>
<div class="wrap">
	<?php screen_icon(); ?>
	<h2>wp-codec-cn 选项</h2>
	<form method="post" action="<?php echo $_SERVER["REQUEST_URI"]; ?>">
		<h3>编解码算法</h3>
		<dl>
			<dt><label><input type="radio" value="base64" name="codec_alg"
				<?php
				if ($codec_alg == "base64") {
					echo ' checked="checked"';
				}
				?> />
				Base64</label>
			</dt>
			<dd>
				<div>使用<a href="http://zh.wikipedia.org/zh-cn/Base64">Base64</a>和<a href="http://zh.wikipedia.org/zh-cn/ROT13">ROT13</a>编码解码：
				服务器端PHP使用base64和ROT13对文章内容和回复内容编码后输出，客户端网页中使用Javascript解码后显示。</div>
			</dd>
			<dt>
				<label><input type="radio" value="phpjsrsa" name="codec_alg"
				<?php
				$disabled = !file_exists(dirname(__FILE__)."/phpjsrsa-codec/phpjsrsa/rsa.class.php");
				if ($disabled) {
					echo ' disabled="disabled"';
				}
				if ($codec_alg == "phpjsrsa") {
					echo ' checked="checked"';
				}
				?> />
				phpjsrsa
				</label>
			</dt>
			<dd>
				<?php
				if ($disabled) {
					echo '<div><span class="disabled">已禁用，因为未找到该编码所需的文件。请先到<a href="http://code.google.com/p/phpjsrsa/">phpjsrsa主页</a>下载后解压缩到'.dirname(__FILE__).'/phpjsrsa-codec/phpjsrsa/。</span></div>';
				}
				?>
				<div>使用<a href="http://code.google.com/p/phpjsrsa/">phpjsrsa</a>编码解码：
				服务器端PHP使用<a href="http://zh.wikipedia.org/zh-cn/RSA%E5%8A%A0%E5%AF%86%E6%BC%94%E7%AE%97%E6%B3%95">RSA</a>对文章内容和回复内容加密后输出，
				客户端网页中使用Javascript解密后显示。<span class="warning">对服务器和客户端的CPU消耗均较高，小心选用。</span></div>
			</dd>
			<dt>
				<label><input type="radio" value="runeword" name="codec_alg"
				<?php
				$disabled = !file_exists(dirname(__FILE__)."/runeword-codec/runeword/runeword.php");
				if ($disabled) {
					echo ' disabled="disabled"';
				}
				if($codec_alg == "runeword") {
					echo ' checked="checked"';
				}
				?> />
				符文之语
				</label>
			</dt>
			<dd>
				<?php
				if ($disabled) {
					echo '<div><span class="disabled">已禁用，因为未找到该编码所需的文件。请先到<a href="http://tubewall.zobyhost.com/enc/index.php">符文之语主页</a>下载后解压缩到'.dirname(__FILE__).'/runeword-codec/runeword/。</span></div>';
				}
				?>
				<div>使用<a href="http://tubewall.zobyhost.com/enc/index.php">符文之语</a>编码解码：
				服务器端PHP使用随机的不相干文字对文章内容和回复内容编码后输出，客户端网页中使用Javascript解码后显示。</div>
			</dd>
		</dl>
		<p><input name="submit" class="button" value=" 保 存 " type="submit" /></p>
	</form>
	<p>访问：<a href="http://liuchangjun.com/tag/codec/" title="插件主页">插件主页</a></p>
	<p><a href="http://code.google.com/p/wp-plugins-cn/" title="代码主页">代码主页 - Code license: Artistic License/GPL</a></p>
</div>
