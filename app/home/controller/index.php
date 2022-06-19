<?php

namespace app\home\controller;

use app\BaseController;
use think\facade\View;

class index extends BaseController
{
	public function index()
	{
		$user = request()->user;
		return View::fetch('index', [
			"user" => $user
		]);
	}
}
