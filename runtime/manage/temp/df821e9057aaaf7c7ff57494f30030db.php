<?php /*a:1:{s:58:"F:\F1\DataLibraries\iot\app\manage\view\common\manage.html";i:1644137205;}*/ ?>
<!DOCTYPE html>
<html lang="ch">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>用户组管理</title>
	<script src="../public/static/js/jquery.min.js"></script>
	<script type="text/javascript">
		notReady = true;
		{ // 配置网页
			{ // 创建输入表函数
				defInputEle = {
					0: '',
					name: '',
					chinese: '',
					text: '',
					kind: 'input',
					type: 'text',
					invis: false,
					style: '',
					opt: [],
					create(parent) {
						return '';
					},
					update(data) {
						return '';
					},
					eventFunc: null,
				}
				function InputElement(obj) {
					if (typeof InputElement._flag == "undefined") {
						for (var i in defInputEle) InputElement.prototype[i] = defInputEle[i];
						InputElement._flag = true;
					}
					if (obj) for (var i in obj) this[i] = obj[i];
				}
				inputList = [];
				function setInputList() {
					var i, len = arguments.length, n = arguments;
					for (i = 0; i < len; i++) {
						inputList.push(new InputElement(n[i]));
					}
				}
			}
			{ // 创建表单函数
				function addChinese(div, ele) {
					var p = document.createElement("span");
					p.innerHTML = ele.chinese + "：";
					div.appendChild(p);
				}
				function setNode(div, node, list) {
					for (var i in list) if (typeof list[i] != "object") node.setAttribute(i, list[i]);
					for (var i in list.eventFunc) node[i] = list.eventFunc[i];
					div.appendChild(node);
				}
				function createForm() {
					inputList.forEach(function (ele, idx) {
						var txt = ele.chinese, div = document.createElement("div");
						if (ele.invis) div.setAttribute("class", "classHide");
						switch (ele.kind) {
							case 'input':
								addChinese(div, ele);
								var t = document.createElement("input");
								setNode(div, t, {
									style: ele.style,
									name: ele.name,
									type: ele.type,
									eventFunc: ele.eventFunc,
								})
								break;
							case 'checkbox':
								var t = document.createElement("input");
								setNode(div, t, {
									style: ele.style,
									name: ele.name,
									type: "checkbox",
									eventFunc: ele.eventFunc,
								})
								addChinese(div, ele);
								break;
							case 'button':
								var t = document.createElement("input");
								setNode(div, t, {
									name: ele.name,
									type: "hidden",
								})
								addChinese(div, ele);
								var s = document.createElement("input");
								setNode(div, s, {
									style: ele.style,
									eventFunc: ele.eventFunc,
									value: ele.text,
									type: "button",
								})
								break;
							case 'select':
								addChinese(div, ele);
								var t = document.createElement("select");
								setNode(div, t, {
									style: ele.style,
									name: ele.name,
									eventFunc: ele.eventFunc,
								})
								for (var i = 0; i < ele.opt.length; i++) {
									var s = document.createElement("option");
									s.setAttribute("value", ele.opt[i].value);
									s.innerHTML = ele.opt[i].text;
									t.appendChild(s);
								}
								break;
							case 'text':
								div.innerHTML = ele.text;
								break;
						}
						formHh.appendChild(div);
					});
				}
			}
		}
		{ // 增删改查函数
			{ // 增函数
				newing = false;
				function newf(n) {
					$('.h2Title').html('新建' + unit);
					inputList.forEach(function (ele) {
						var parent = n ? mainCtr.list[mainCtr.list[mainCtr.selectNow].parent] : mainCtr.list[mainCtr.selectNow];
						switch (ele.kind) {
							case "input":
								$('[name = "' + ele.name + '"]').val(ele.create(parent));
								break;
							case "checkbox":
								$('[name = "' + ele.name + '"]').attr('checked', ele.create(parent) ? true : false);
								break;
							case "button":
								$('[name = "' + ele.name + '"]').val(ele.create(parent));
								break;
							case "select":
								$('[name = "' + ele.name + '"]').val(ele.create(parent));
								break;
						}
					});
					$('.divNew').show();
					$('.divButtonNow').hide();
					$('.divButton').hide();
					newing = true;
				}
			}
			{ // 删函数
				function delf() {
					$.ajax({
						data: '&type=delete&id=' + mainCtr.selectNow,
						url: mainCtr.url,
						type: 'post',
						success: mainCtr.reLook.bind(mainCtr),
					});
				}
			}
			{ // 改函数
				function updatef() {
					newcanf();
					$('.h2Title').html('修改' + unit);
					inputList.forEach(function (ele) {
						var data = mainCtr.list[mainCtr.selectNow];
						switch (ele.kind) {
							case "input":
								$('[name = "' + ele.name + '"]').val(ele.update(data));
								break;
							case "checkbox":
								$('[name = "' + ele.name + '"]').attr('checked', ele.update(data) ? true : false);
								break;
							case "button":
								$('[name = "' + ele.name + '"]').val(ele.update(data));
								break;
							case "select":
								$('[name = "' + ele.name + '"]').val(ele.update(data));
								break;
						}
					});
					$('.divNew').show();
				}
			}
			{ // 查控制器
				RetrieveController = function (n) {
					if (typeof RetrieveController._flag == "undefined") {
						RetrieveController._flag = true;
						var obj = {
							// 当前选中的数据的id
							selectNow: 0,
							openf(id) { // 展开函数
								if (typeof this.openList[id] == 'undefined') {
									this.openList[id] = true;
									$.ajax({
										data: '&type=retrieve&id=' + id,
										url: this.url,
										async: false,
										type: 'post',
										success: function (text) {
											var list = $('<span/>');
											list.attr('id', window[n.name].sign + 'div' + id);
											list.html(text);
											list.insertAfter('#' + window[n.name].sign + 'li' + id);
											if (window[n.name].selectNow) $('#' + window[n.name].sign + 'span' + window[n.name].selectNow).css('background', 'orange');
										},
									});
									$('#' + this.sign + 'button' + id).html('收起');
								} else if (this.openList[id]) {
									$('#' + this.sign + 'div' + id).show();
									$('#' + this.sign + 'button' + id).html('收起');
								} else {
									$('#' + this.sign + 'div' + id).hide();
									$('#' + this.sign + 'button' + id).html('展开');
								}
								this.openList[id] = !this.openList[id];
							},
							reLook(n) { // 重置函数
								if (typeof n.length != "undefined") {
									if (n.length >= 2) {
										document.body.innerHTML += n;
										return;
									}
								}
								if (n != 2) alert(n ? '成功' : '失败');
								$('#' + this.sign + 'div0').remove();
								this.openList = {};
								this.list = {
									getStr(id) {
										var rslt = "<div class='divTable'><table>";
										for (i in this[id]) {
											if (i != 'chinese') {
												rslt += "<tr><td>"
												+ i
												+ "</td><td>"
												+ this[id][i]
												+ "</td></tr>";
											}
										}
										rslt += "</table></div>";
										return rslt;
									},
									get 0() {
										var i, obj = {};
										for (i in inputList) {
											obj[inputList[i].name] = inputList[i][0];
										}
										return obj;
									},
								};
								this.openf(0);
							},
							quote_openf(id) { // 作为引用的展开函数
								if (typeof this.quote_openList[id] == 'undefined') {
									this.quote_openList[id] = true;
									var n = this;
									$.ajax({
										data: '&type=quote&id=' + id,
										url: this.url,
										async: false,
										type: 'post',
										success: function (text) {
											var list = $('<span/>');
											list.attr('id', n.sign + 'div' + id);
											list.html(text);
											list.insertAfter('#' + n.sign + 'li' + id);
											n.quote_select();
										},
									});
									$('#' + this.sign + 'button' + id).html('收起');
								} else if (this.quote_openList[id]) {
									$('#' + this.sign + 'div' + id).show();
									$('#' + this.sign + 'button' + id).html('收起');
								} else {
									$('#' + this.sign + 'div' + id).hide();
									$('#' + this.sign + 'button' + id).html('展开');
								}
								this.quote_openList[id] = !this.quote_openList[id];
							},
							quote_reLook(n) { // 作为引用的重置函数
								if (n != 2) alert(n ? '成功' : '失败');
								$('#' + this.sign + 'div0').remove();
								this.quote_openList = {};
								this.quote_checkList = {};
								this.quote_selectArr = [];
								this.quote_openf(0);
							},
							quote_onlyOne: false,
							quote_select(n) { // 作为引用的选中函数
								if (typeof n == "number") {
									var idx = this.quote_selectArr.indexOf(n);
									if (idx == -1) {
										if (this.quote_onlyOne) {
											this.quote_select([n]);
											console.log(this.quote_selectArr)
										} else {
											this.quote_selectArr.push(n);
										}
									} else {
										if (!this.quote_onlyOne) {
											this.quote_selectArr.splice(idx, 1);
										}
									}
									this.quote_select();
									return;
								}
								if (typeof n == "object") this.quote_selectArr = n;
								for (var i in this.quote_checkList) this.quote_checkList[i] = false;
								var th = this;
								this.quote_selectArr.forEach(function(i) {
									if (typeof th.quote_checkList[i] != "undefined") th.quote_checkList[i] = true;
								});
								for (var i in this.quote_checkList) {
									console.log('#' + this.sign + 'checkbox' + i);
									$('#' + this.sign + 'checkbox' + i).attr("checked", this.quote_checkList[i]);
								}
							},
							select(n) { // 选择函数
								$('#' + this.sign + 'span' + this.selectNow).css('background', '');
								$('#' + this.sign + 'span' + n).css('background', 'orange');
								this.selectNow = n;
								$('#divNow').html('已选中<b>' + this.list[n].chinese + '</b><br />' + this.list.getStr(n));
								if (!newing) $('.divButtonNow').show();
								if (typeof this.isCanUpdate == "undefined") {
									$('.divDelRetrieve').show();
								} else {
									if (this.isCanUpdate()) $('.divDelRetrieve').show();
									else $('.divDelRetrieve').hide();
								}
								$('.divButton').hide();
							},
							setMainCtr() { // 设置为主要查控制器的函数
								unit = this.unit
								h1Title.innerText = this.chinese;
								$(".spanUnit").html(this.unit);
							}
						};
						for (i in obj) RetrieveController.prototype[i] = obj[i];
					}
					this.url = "./" + n.name;
					this.sign = n.name + "_";
					this.unit = n.unit;
					this.chinese = n.chinese;
					$(".aStart").attr('id', this.sign + 'li0');
					$(".aStart").attr("class", "");
				}
			}
			{ // 增和改的取消和确认
				function newcanf() {
					$('.divNew').hide();
					if (mainCtr.selectNow) {
						$('.divButtonNow').show();
					} else {
						$('.divButton').show();
					}
					newing = false;
				}
				function newsuref() {
					var data = '&type=' + (newing ? "create" : "update");
					var array = $('form').serializeArray();
					array.forEach(function (obj) {
						data += '&' + obj.name + '=' + obj.value;
					});
					$.ajax({
						data: data,
						url: mainCtr.url,
						type: 'post',
						success: mainCtr.reLook.bind(mainCtr),
					});
					newcanf();
				}
			}
		}
		{ // 网页UI相关
			function menuIO(n) {
				if (n) {
					$('.divSide').show();
					$('.buttonShow').hide();
					if (!uiStyle) {
						$('.divLook').css('padding-right', '6cm');
					}
				} else {
					$('.divSide').hide();
					$('.buttonShow').show();
					if (!uiStyle) {
						$('.divLook').css('padding-right', '');
					}
				}
			}
			function cleanui() {
				if (typeof uiStyle == 'undefined') uiStyle = !(window.innerWidth < 14 * onecm.clientHeight)
				if (window.innerWidth < 14 * onecm.clientHeight) {
					if (!uiStyle) {
						$('.divSide').css('top', '');
						$('.divSide').css('left', '0');
						$('.divSide').css('width', '');
						$('.divSide').css('bottom', '0');
						$('.divLook').css('padding-right', '');
						uiStyle = 1;
					}
				} else if (uiStyle) {
					$('.divSide').css('top', '0');
					$('.divSide').css('left', '');
					$('.divSide').css('width', '6cm');
					$('.divSide').css('bottom', '');
					$('.divLook').css('padding-right', '6cm');
					uiStyle = 0;
				}
			}
			window.onload = cleanui;
		}
		{ // 网页加载完后进行配置
			$(function () {
				$.ajax({
					data: "&type=get",
					url: window.location.href,
					type: 'post',
					success: function (text) {
						var div = $('<div/>');
						div.html(text);
						div.insertBefore(".divLook");
						createForm();
						cleanui();
						mainCtr.reLook(2);
						notReady = false;
						window.parent.Index.ifrLoad();
					},
				})
			});
		}
	</script>
	<style>
		.ok0 {
			background: blue;
		}

		.ok1,
		.ok2,
		.ok3,
		.ok4 {
			background: orange;
		}

		.ok5 {
			background: #000;
		}

		.divSide {
			position: fixed;
			right: 0;
			background: #07a8ff;
		}

		.divCon {
			position: relative;
			line-height: 1.25em;
			margin: 2px;
			background: #fff;
			padding: 0.2cm;
		}

		td {
			padding-right: 0.1cm;
			padding-left: 0.1cm;
		}

		.divTable {
			overflow: auto;
		}

		.classHide {
			display: none;
		}

		li span {
			margin-left: 0cm;
		}

		ul {
			user-select: none;
			margin-left: -0.5cm;
			margin-top: 0;
			margin-bottom: 0.2cm;
			display: inline-block;
		}

		.status {
			color: #fff;
			font-size: 0.8em;
			padding: 0.05cm;
			padding-left: 0.1cm;
			padding-right: 0.1cm;
			border-radius: 0.2cm;
			margin-left: -0.2cm;
		}

		.ok {
			background: green;
		}

		.nok {
			background: red;
		}

		.buttonHide {
			position: absolute;
			top: 0;
			right: 0;
			border-radius: 0;
			border-style: solid;
			border-width: 1px;
			border-bottom-width: 3px;
			border-left-width: 3px;
			border-color: #07a8ff;
			background: #07a8ff;
			color: #fff;
		}

		.buttonHide:hover {
			background: #06e;
		}

		.buttonHide:active {
			background: blue;
		}

		h3,
		h2,
		h1 {
			display: inline;
		}

		#divNow {
			padding-right: 0.8cm;
		}
	</style>
</head>

<body>
	<div class="divLook mainView">
		<h2>管理</h2><br />
		<h1 id="h1Title"></h1>
		<hr color="#07a8ff" /><br />
		<a class="aStart"></a><br />
		<!--iframe name='hh'></iframe-->
		<div style="position: absolute;height: 79%">&nbsp;</div>
	</div>
	<div class="divSide mainSide">
		<div class="divCon">
			<div id="divNow">请点击一个<span class='spanUnit'></span></div>
			<div class="divDelRetrieve classHide">
				<button onclick="updatef()">修改</button><button onclick="delf()">删除</button>
			</div>
			<div class="divButtonNow classHide">
				<br /><button onclick="newf(1)">新建同级<span class='spanUnit'></span></button>
				<br /><button onclick="newf(0)">新建子级<span class='spanUnit'></span></button>
			</div>
			<div class="divButton">
				<hr color="#07a8ff" />
				<button onclick="newf(0);nextParent = 0;">新建<span class='spanUnit'></span></button>
			</div>
			<div class="divNew classHide">
				<hr color="#07a8ff" />
				<h2 class="h2Title">新建</h2><br />
				<form id="formHh">
					<!--input type='submit' /-->
				</form>
				<button onclick="newcanf()">取消</button><button onclick="newsuref()">确定</button>
			</div>
			<button class="buttonHide" onclick="menuIO(0)">隐<br />藏<br />面<br />板</button>
		</div>
	</div>
	<button class="buttonShow classHide divSide" style="background: #eee;" onclick="menuIO(1)">显示面板</button>
	<a id="onecm" style="height: 1cm;display: block;"></a>
</body>

</html>