<?php /*a:1:{s:55:"F:\F1\DataLibraries\iot\app\manage\view\Func\index.html";i:1644142975;}*/ ?>
<script type="text/javascript">
	Func = new RetrieveController({
		name: "Func",
		chinese: "网站功能管理",
		unit: "功能",
	});
	Func.setMainCtr();
	mainCtr = Func;
	setInputList({
		0: 0,
		name: 'id',
		chinese: '',
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
		text: '<br />位于<b id="bParent"></b>下',
		kind: 'text',
	});
</script>