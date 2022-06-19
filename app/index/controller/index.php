<?php

namespace app\index\controller;

use app\BaseController;
use think\facade\View;
use think\facade\Session;
use app\common\model\iotuser;
use app\common\model\iotuser_func;

class index extends BaseController
{
	public function index()
	{
		if (request()->isPost()) {
			$post = input('post.');
			if (array_key_exists('logout', $post)) {
				Session::delete("iotcom");
			}
			$res = $this->login($post);
			if ($res === true) {
				return "ok";
			} else {
				return $res;
			}
		} else {
			if (request()->isLogin) {
				$list = $this->getFuncSidebar(request()->user['power']);
				return View::fetch('index', [
					"sidebar" => $list,
				]);
			} else {
				return View::fetch('login', [
					"reason" => "未登录",
				]);
			}
		}
	}
	/**
	 * 登入账号
	 *
	 * @param array $arr 登录信息
	 * @return bool/string 成功则返回true，否则返回错误码
	 */
	public function login($arr)
	{
		if (!captcha_check($arr['captcha'])) {
			return "1";
		}
		if (!$arr['name']) {
			return "2-1";
		}
		$user = iotuser::where('name', $arr['name'])->select()->toArray();
		if (count($user) == 0) {
			return "2-0";
		}
		if (md5($arr['password'] . $user[0]['salt']) != $user[0]['password']) {
			return "3";
		}
		$data = iotuser::find($user[0]['id']);
		$data->date = date("Y-m-d H:i:s", time());
		$data->save();
		Session::set('iotcom', $user[0]['id']);
		return true;
	}
	/**
	 * 获取用户能用的所有功能
	 *
	 * @param mixed $power 用户权限
	 * @return array 用户能用的所有功能
	 */
	public function getFuncSidebar($power)
	{
		$list = $this->getAllFunc(0);
		$list = $this->getUseableFunc($power, $list);
		return $list;
	}
	/**
	 * 根据父节点获取子功能
	 *
	 * @param int $parent 父节点id
	 * @return array 对应父节点所有的子功能
	 */
	static public function getAllFunc($parent)
	{
		$list = iotuser_func::where("parent", $parent)->where("status", 0)->select()->toArray();
		foreach ($list as $key => $value) {
			$list[$key]['children'] = self::getAllFunc($value['id']);
		}
		return $list;
	}
	/**
	 * 根据父节点获取用户能用的子功能
	 *
	 * @param mixed $power 用户的权限数组
	 * @param array $func 所有的网站功能
	 * @return array 用户的网站功能
	 */
	static public function getUseableFunc($power, array $func)
	{
		$list = [];
		foreach ($func as $key => $value) {
			if (!($power != "all" && array_search($value['power'], $power) === false)) {
				$value['children'] = self::getUseableFunc($power, $value['children']);
				array_push($list, $value);
			}
		}
		return $list;
	}
}
