<?php /*a:1:{s:56:"F:\F1\DataLibraries\iot\app\manage\view\Power\index.html";i:1644142969;}*/ ?>
<script type="text/javascript">
	Power = new RetrieveController({
		name: "Power",
		chinese: "权限管理",
		unit: "权限",
	});
	Power.setMainCtr();
	Power.isCanUpdate = function(n) {
		return this.list[this.selectNow].type != 5
	}
	mainCtr = Power;
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
	}, {
		name: 'powertype',
		chinese: "类 型",
		kind: "select",
		opt: [{
			value: 0,
			text: '其他权限',
		}, {
			value: 1,
			text: '增加权限',
		}, {
			value: 2,
			text: '删除权限',
		}, {
			value: 3,
			text: '修改权限',
		}, {
			value: 4,
			text: '查询权限',
		}],
		create(parent) {
			return '0';
		},
		update(data) {
			return data.type;
		}
	}, {
		name: 'value',
		chinese: ' 值 ',
		create(parent) {
			return '';
		},
		update(data) {
			return data.value;
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
		text: '<br />位于<b id="bParent"></b>下',
		kind: 'text',
	});
</script>