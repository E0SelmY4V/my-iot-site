<?php /*a:1:{s:56:"F:\F1\DataLibraries\iot\app\manage\view\cache\index.html";i:1643772164;}*/ ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>缓存管理</title>
	<script type="text/javascript">
		function clear() {
		}
	</script>
</head>
<body>
	<style>h2 {display: inline;} h1 {display: inline}</style>
	<h2>管理<h2><br /><h1>清除服务器缓存</h1>
	<hr color="#07a8ff" /><br /><br />
	<form action="cache" method="post" target="hh" style="/*display: none;*/">
		<input name="from[0]" value="cache" type="hidden"  />
		<input name="from[1]" id="fromInput" type="hidden" />
		<input id="subInput" type="submit" value="清除缓存" />
	</form><br />
	<iframe name="hh"></iframe>
</body>
</html>