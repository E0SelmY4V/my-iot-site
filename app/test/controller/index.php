<?php

namespace app\test\controller;

use app\common\controller\Base;
use think\facade\View;
use think\facade\Session;
use think\captcha\facade\Captcha;
use think\facade\Db;
use app\common\model\iotuser;
use app\common\model\iotuser_power;
use app\common\model\iotuser_group;
use app\common\model\iotuser_func as model;

class index extends Base
{
	public function index()
	{
		if (request()->isPost()) {
			$post = input('post.');
			halt($post);
		}
		return View::fetch('index');
	}
}