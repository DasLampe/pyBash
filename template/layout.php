<?php
// +----------------------------------------------------------------------+
// | Copyright (c) 2012 DasLampe <daslampe@lano-crew.org> |
// | Encoding:  UTF-8 |
// +----------------------------------------------------------------------+
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
	<title>pyBash</title>
	<link href="<?= LINK_TPL; ?>css/style.css" rel="stylesheet" type="text/css" />
	<script type="text/javascript" src="<?= LINK_MAIN; ?>core/lib/js/jquery.min.js"></script>
	<script type="text/javascript" src="<?= LINK_MAIN; ?>core/lib/js/webtoolkit.base64.js"></script>
	<script type="text/javascript" src="<?= LINK_MAIN; ?>core/lib/js/email_protection.js"></script>
</head>
<body>
<div class="ym-skiplinks">
	<a class="skip" title="ym-skip" href="#navigation">Skip to the navigation</a><span class="hideme">.</span>
	<a class="skip" title="ym-skip" href="#content">Skip to the content</a><span class="hideme">.</span>
</div>
	<div class="ym-wrapper">
		<header>
			<h1>pyBash</h1>
		</header>
		<nav id="nav">
			<a id="navigation" name="navigation"></a>
			<div class="ym-hlist">
				<?php
					include_once(PATH_CONTROLLER."menu.php");
				?>
			</div>
		</nav>
		<div id="main">
			<div class="ym-column">
				<div class="ym-col1">
					<div class="ym-cbox ym-clearfix">
						{page_content}
					</div>
				</div>
				{if} {sidebar} != "" {/if}
					<div class="ym-col3">
						<div class="ym-cbox">
							{sidebar}
						</div>
					</div>
				{/endif}
			</div>
		</div>
		<footer>
			Layout based on <a href="http://www.yaml.de/">YAML</a>
		</footer>
		</div>
	</div>
</body>
</html>
