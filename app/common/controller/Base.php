<?php

namespace app\common\controller;

use app\BaseController;

class Base extends BaseController
{
	public function initialize()
	{
		request()->browsingTop = isPowerful(0, request()->browsingTop);
	}
	/**
	 * 查看是否有权限访问./manage/$name
	 *
	 * @param string $name 当前类的绝对名字
	 */
	public function testPower(string $name)
	{
		$sign = ucwords(getClassName($name));
		$parent = request()->browsingTop['id'];
		request()->browsingMiddle = isPowerful($parent, $sign);
	}
}
