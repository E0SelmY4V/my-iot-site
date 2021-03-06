<?php /*a:1:{s:55:"F:\F1\website\iot\app\index\view\index\index.html";i:1644130098;}*/ ?>
<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="zxx">
<!--<![endif]-->
<!-- Begin Head -->

<head>
	<title>意程智造物联网系统</title>
	<meta charset="utf-8">
	<meta content="width=device-width, initial-scale=1.0" name="viewport">
	<meta name="description" content="">
	<meta name="keywords" content="">
	<meta name="author" content="">
	<meta name="MobileOptimized" content="320">
	<!--Start Style -->
	<link rel="stylesheet" type="text/css" href="public/static/css/fonts.css">
	<link rel="stylesheet" type="text/css" href="public/static/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="public/static/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="public/static/css/icofont.min.css">
	<link rel="stylesheet" type="text/css" href="public/static/css/style.css">
	<link rel="stylesheet" id="theme-change" type="text/css" href="#">
	<style>
		.main-content {
			height: 90vh;
		}
	</style>
	<!-- Favicon Link -->
	<script type="text/javascript">
		Index = {
			ifrNow: 0,
			ifrChange(n) {
				this.ifrNow = 1 - this.ifrNow;
				document.getElementById('ifrView' + this.ifrNow).src = n;
				this.timer = setTimeout(function() {
					loading.style.right = "";
					loading.style.top = "";
					loading.style.position = "relative";
					document.getElementById('ifrView' + (1 - Index.ifrNow)).style.display = 'none'
				}, 300);
			},
			ifrLoad() {
				if (!document.getElementById('ifrView' + this.ifrNow).contentWindow.notReady) {
					window.clearTimeout(this.timer);
					loading.style.position = "fixed";
					loading.style.right = "1000%";
					loading.style.top = "0";
					document.getElementById('ifrView' + this.ifrNow).style.display = 'block';
					document.getElementById('ifrView' + (1 - this.ifrNow)).style.display = 'none';
				}
			},
		}
	</script>
</head>

<body>

	<div class="loader">
		<div class="spinner">
			<img src="public/static/images/loader.gif" alt="" />
		</div>
	</div>
	<!-- Main Body -->
	<div class="page-wrapper">
		<!-- Header Start -->
		<header class="header-wrapper main-header">
			<div class="header-inner-wrapper">
				<div class="logo-wrapper">
					<a href="index.html" class="admin-logo" style="color: #fff; text-align: center;">
						<span style="font-size: 0.6cm;">意程智造物联网系统</span>
					</a>
				</div>
				<div class="header-right">
					<div class="serch-wrapper">
						<form>
							<input type="text" placeholder="Search Here...">
						</form>
						<a class="search-close" href="javascript:void(0);"><span class="icofont-close-line"></span></a>
					</div>
					<div class="header-left">
						<div class="header-links">
							<a href="javascript:void(0);" id="sidebtn" class="toggle-btn">
								<span></span>
							</a>
						</div>
						<div class="header-links search-link">
							<a class="search-toggle" href="javascript:void(0);">
								<svg version="1.1" xmlns="http://www.w3.org/2000/svg"
									xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
									viewBox="0 0 56.966 56.966" style="enable-background:new 0 0 56.966 56.966;"
									xml:space="preserve">
									<path d="M55.146,51.887L41.588,37.786c3.486-4.144,5.396-9.358,5.396-14.786c0-12.682-10.318-23-23-23s-23,10.318-23,23
									s10.318,23,23,23c4.761,0,9.298-1.436,13.177-4.162l13.661,14.208c0.571,0.593,1.339,0.92,2.162,0.92
									c0.779,0,1.518-0.297,2.079-0.837C56.255,54.982,56.293,53.08,55.146,51.887z M23.984,6c9.374,0,17,7.626,17,17s-7.626,17-17,17
									s-17-7.626-17-17S14.61,6,23.984,6z" />
								</svg>
							</a>
						</div>
					</div>
				</div>
			</div>
		</header>
		<!-- Sidebar Start -->
		<aside class="sidebar-wrapper">
			<div class="side-menu-wrap">
				<ul class="main-menu">
					<?php
						function out($str, $list) {
							 if(is_array($list) || $list instanceof \think\Collection || $list instanceof \think\Paginator): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$func): $mod = ($i % 2 );++$i;?>
								<li>
									<a
										<?php if((count($func['children']) > 0)): ?>
											class="active" href="javascript: void(0);"
										<?php else: ?>
											href="javascript: Index.ifrChange('<?php echo htmlentities($str); ?><?php echo htmlentities($func['name']); ?>');"
										<?php endif; ?>
									>
										<span class="icon-menu feather-icon"></span>
										<span class="menu-text">
											<?php echo htmlentities($func['chinese']); ?>
										</span>
										<?php if((count($func['children']) > 0)): ?>
											<ul  class="sub-menu">
												<?php
													out($str.$func["name"]."/", $func['children']);
												 ?>
											</ul>
										<?php endif; ?>
									</a>
								</li>
							<?php endforeach; endif; else: echo "" ;endif;
						}
						out("./", $sidebar);
					 ?>
				</ul>
			</div>
		</aside>
		<!-- Container Start -->
		<div class="page-wrapper">
			<iframe src="./home" id="ifrView0" onload="Index.ifrLoad()" class="main-content"></iframe>
			<iframe id="ifrView1" onload="Index.ifrLoad()" class="main-content"></iframe>
			<div class="main-content" id="loading" style="z-index: -999;">
				<marquee direction="down" behavior="alternate" style="height: 100%;position: absolute;" scrollamount="50">
					<marquee behavior="alternate" scrollamount="50">
						<h1 style="font-size: 10vh;">加载中</h1>
					</marquee>
				</marquee>
			</div>
		</div>
	</div>

	<!-- Script Start -->
	<script src="public/static/js/jquery.min.js"></script>
	<script src="public/static/js/popper.min.js"></script>
	<script src="public/static/js/bootstrap.min.js"></script>
	<script src="public/static/js/swiper.min.js"></script>
	<script src="public/static/js/apexchart/apexcharts.min.js"></script>
	<script src="public/static/js/apexchart/control-chart-apexcharts.js"></script>
	<!-- Page Specific -->
	<script src="public/static/js/nice-select.min.js"></script>
	<!-- Custom Script -->
	<script src="public/static/js/custom.js"></script>
</body>

</html>