<?php

namespace app\manage\controller;

use think\facade\View;

/**
 * 权限管理控制器
 */
class power extends MultistageManage
{
	public function index()
	{
		parent::testPower(__CLASS__);
		if (request()->isPost()) {
			$post = input("post.");
			return parent::handlePost(__CLASS__, $post);
		} else {
			return View::fetch('common/manage');
		}
	}
}
