<?php

namespace app\demo1\controller;

use app\common\controller\Base;
use think\Facade\View;

class index extends Base
{
	public function index()
	{
		return View::fetch();
	}
}
