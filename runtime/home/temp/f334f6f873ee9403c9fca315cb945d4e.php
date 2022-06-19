<?php /*a:1:{s:54:"F:\F1\website\iot\app\home\view\index\index.html";i:1644141605;}*/ ?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<script src="../public/static/js/jquery.min.js"></script>
	<script>
		function logout() {
			$.ajax({
				url: "./",
				data: "logout",
				type: "post",
			})
			parent.location.href = './';
		}
	</script>
</head>

<body>
	<h1>欢迎您，<?php echo htmlentities($user['chinese']); ?>！</h1>
	您的用户组：
	<?php echo htmlentities($user['group']['chinese']); ?><br />
	您的权限： <?php if($user['power'] == 'all'): ?>
	<b>最高级权限</b>
	<?php else: if(is_array($user['power']) || $user['power'] instanceof \think\Collection || $user['power'] instanceof \think\Paginator): $i = 0; $__LIST__ = $user['power'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$qx): $mod = ($i % 2 );++$i;?><?php echo htmlentities($qx); ?> <?php endforeach; endif; else: echo "" ;endif; ?>
	<?php endif; ?>
	<br /><br />
	<button onclick="logout()">登出账号</button>
</body>

</html>