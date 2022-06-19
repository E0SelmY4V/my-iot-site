<?php /*a:1:{s:55:"F:\F1\DataLibraries\iot\app\manage\view\User\index.html";i:1644138992;}*/ ?>
<script type="text/javascript">
    $(".divButtonNow").html('<hr color="#07a8ff" /><button onclick="newf(0);nextParent = 0;">新建<span class=\'spanUnit\'></span></button>')
	User = new RetrieveController({
		name: "User",
		chinese: "用户管理",
		unit: "用户",
	});
	User.setMainCtr();
	mainCtr = User;
	setInputList({
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
		chinese: '账 号',
		create(parent) {
			return '';
		},
		update(data) {
			return data.name;
		},
	}, {
		name: 'chinese',
		chinese: '昵 称',
		create(parent) {
			return '';
		},
		update(data) {
			return data.chinese;
		},
	}, {
		name: 'password',
		chinese: '密 码',
		create(parent) {
			return '';
		},
		update(data) {
			return '';
		},
	}, {
		name: 'status',
		chinese: '禁用',
		kind: 'checkbox',
		create(parent) {
			return false;
		},
		update(data) {
			return data.status;
		},
	}, {
		0: "",
		name: "power",
		chinese: "用户组",
		text: "设置用户组",
		kind: "button",
		create(parent) {
			Group.quote_select([3]);
            setTimeout(function() {
				$('[name = "power"]').val(Group.quote_selectArr.join(","));
			}, 1)
		},
		update(data) {
			Group.quote_select(JSON.parse('[' + data.power + ']'));
            setTimeout(function() {
				$('[name = "power"]').val(Group.quote_selectArr.join(","));
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
        kind: 'text',
        text: '<br />'
    });
	(function() {
		var a = $("<div/>");
		a.attr("class", "view0 classHide");
		a.html(
			"<h1>设置用户组</h1><br />"
			+ "<span>请在需要设置的用户组左边打勾</span><br /><br />"
			+ "<a class='aStart'></a><br /><br />"
			+ "<button onclick='endQuote(0)'>取消修改</button> "
			+ "<button onclick='endQuote(1)'>确认修改</button>"
		);
		a.insertBefore(".divLook");
		Group = new RetrieveController({
			name: "Group",
			chinese: "用户组管理",
			unit: "用户组",
		});
		Group.quote_reLook(2);
        Group.quote_onlyOne = true;
	}());
	function endQuote(n) {
		$(".view0").hide();
		$(".mainView").show();
		$(".mainSide").show();
		if(n) $('[name = "power"]').val(Group.quote_selectArr.join(","));
	}
</script>