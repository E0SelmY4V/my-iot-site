<?php

namespace app\demo2\controller;

use app\common\controller\Base;
use think\Facade\View;

class demosub1 extends Base
{
	public function index()
	{
		return View::fetch();
	}
}
