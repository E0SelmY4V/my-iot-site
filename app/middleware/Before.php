<?php
declare (strict_types = 1);

namespace app\middleware;

use app\common\model\iotuser;
use app\common\model\iotuser_group;
use app\common\model\iotuser_power;
use app\common\model\iotuser_func;

class Before
{
	public function handle($request, \Closure $next)
	{
		$request->isLogin = !empty(Session('iotcom'));
		if ($request->isLogin) {
			$user = iotuser::where('id', Session('iotcom'))->select()->toArray()[0];
			$request->user = user_format($user);
		}
		$arr = explode("/", $_SERVER['QUERY_STRING']);
		if (count($arr) >= 3) {
			$request->browsingTop = $arr[2];
		} else {
			$request->browsingTop = './';
		}
		return $next($request);
	}
}
