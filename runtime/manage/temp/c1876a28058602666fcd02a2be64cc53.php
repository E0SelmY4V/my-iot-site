<?php /*a:1:{s:56:"F:\F1\DataLibraries\iot\app\manage\view\Group\index.html";i:1644143761;}*/ ?>
<script type="text/javascript">
	Group = new RetrieveController({
		name: "Group",
		chinese: "用户组管理",
		unit: "用户组",
	});
	Group.isCanUpdate = function() {
		return this.selectNow > 1;
	};
	Group.setMainCtr();
	mainCtr = Group;
	setInputList({
		0: 0,
		name: 'id',
		chinese: '编号',
		type: 'number',
		invis: true,
		create(parent) {
			return '';
		},
		update(data) {
			return data.id;
		},
	}, {
		name: 'name',
		chinese: '英文名',
		create(parent) {
			return '';
		},
		update(data) {
			return data.name;
		},
	}, {
		0: "全局",
		name: 'chinese',
		chinese: '中文名',
		create(parent) {
			return '';
		},
		update(data) {
			return data.chinese;
		},
	}, (function () {
		var showParent = function (ele) {
			var rslt, txt;
			if (typeof ele == "object") {
				rslt = ele.id;
				txt = ele.chinese;
			} else {
				rslt = ele;
				ele = mainCtr.list[ele];
				txt = typeof ele == 'undefined' ? '不知道哪里' : ele.chinese;
			}
			bParent.innerText = txt;
			return rslt;
		}
		return {
			name: 'parent',
			chinese: '父节点',
			type: 'number',
			style: 'width: 4em;',
			create(parent) {
				return showParent(parent);
			},
			update(data) {
				return showParent(data.parent);
			},
			eventFunc: {
				oninput() {
					showParent(this.value);
				},
			},
		}
	})(), {
		0: "",
		name: "power",
		chinese: "权限",
		text: "设置权限",
		kind: "button",
		create(parent) {
			Power.quote_select(JSON.parse('[' + parent.power + ']'));
            setTimeout(function() {
				$('[name = "power"]').val(Power.quote_selectArr.join(","));
			}, 1)
		},
		update(data) {
			Power.quote_select(JSON.parse('[' + data.power + ']'));
            setTimeout(function() {
				$('[name = "power"]').val(Power.quote_selectArr.join(","));
			}, 1)
		},
		eventFunc: {
			onclick() {
				$(".view0").show();
				$(".mainView").hide();
				$(".mainSide").hide();
			},
		},
	}, {
		text: '<br />位于<b id="bParent"></b>下',
		kind: 'text',
	});
	(function() {
		var a = $("<div/>");
		a.attr("class", "view0 classHide");
		a.html(
			"<h1>设置权限</h1><br />"
			+ "<span>请在需要设置的权限左边打勾</span><br /><br />"
			+ "<a class='aStart'></a><br /><br />"
			+ "<button onclick='endQuote(0)'>取消修改</button> "
			+ "<button onclick='endQuote(1)'>确认修改</button>"
		);
		a.insertBefore(".divLook");
		Power = new RetrieveController({
			name: "Power",
			chinese: "权限管理",
			unit: "权限",
		});
		Power.quote_reLook(2);
	}());
	function endQuote(n) {
		$(".view0").hide();
		$(".mainView").show();
		$(".mainSide").show();
		if(n) $('[name = "power"]').val(Power.quote_selectArr.join(","));
	}
</script>