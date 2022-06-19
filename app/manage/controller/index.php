<?php

namespace app\manage\controller;

use think\facade\View;
use app\common\controller\Base;

class index extends Base
{
	public function index()
	{
		$user = request()->user;
		return View::fetch('index', [
			"user" => $user
		]);
	}
}
