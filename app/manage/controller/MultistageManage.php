<?php

namespace app\manage\controller;

use app\common\controller\Base;
use app\common\model\iotuser_group;
use app\common\model\iotuser_power;
use app\common\model\iotuser_func;
use app\common\model\iotuser;
use think\facade\View;

/**
 * 多层级数据增删改查控制器基类
 */
class MultistageManage extends Base
{
	/**
	 * 处理POST请求
	 *
	 * @param string $name 当前类的绝对名字
	 * @param array $post POST请求数组
	 * @return mixed 请求结果
	 */
	public function handlePost(string $name, array $post)
	{
		$sign = getClassName($name);
		if ($post['type'] == "get") {
			return View::fetch($sign . '/index');
		}
		$isPowerless = $this->testFunc($post['type']);
		if ($isPowerless) {
			return $isPowerless;
		}
		switch ($post['type']) {
			case 'create':
				return $this->createToDb($sign, $post, true) ? '1' : '0';
			case 'update':
				return $this->createToDb($sign, $post, false) ? '1' : '0';
			case 'delete':
				return $this->delAll($sign, $post['id']) ? '1' : '0';
			case 'retrieve':
				$list = $this->pageRetrieve($sign, "parent", $post['id'], 10);
				return View::fetch('common/retrieve', [
					'list' => $list,
					'sign' => $sign,
				]);
			case 'quote':
				$list = $this->pageRetrieve($sign, "parent", $post['id'], 10);
				return View::fetch('common/quote', [
					'list' => $list,
					'sign' => $sign,
				]);
		}
	}
	/**
	 * 查看是否有权限访问./manage/xxx下的$name功能
	 *
	 * @param string $name 功能名称
	 * @return bool|string 有权限返回否，否则返回错误页面
	 */
	public function testFunc(string $name)
	{
		$user = request()->user;
		$from = request()->browsingMiddle;
		$testNow = iotuser_power::where("parent", request()->browsingMiddle['power'])->where("name", $name)->select()->toArray()[0];
		if ($user['power'] != "all" && array_search($testNow['id'], $user['power']) === false) {
			return View::fetch("common/error", [
				"from" => $from['chinese'],
				"why" => "操作缺少 " . $testNow['chinese'] . " 权限",
			]);
		} else {
			return false;
		}
	}
	/**
	 * 分页获取数据
	 *
	 * @param string $from 要操作的数据库
	 * @param string $what 要判断的字段
	 * @param int $value 要判断的值
	 * @param int $number 一页多少条数据
	 * @return object 查询的结果
	 */
	public function pageRetrieve(string $from, string $what, int $value, int $number)
	{
		switch ($from) {
			case 'User':
				return iotuser::paginate($number);
			case 'Func':
				return iotuser_func::where($what, $value)->paginate($number);
			case 'Group':
				return iotuser_group::where($what, $value)->paginate($number);
			case 'Power':
				return iotuser_power::where($what, $value)->paginate($number);
		}
	}
	/**
	 * 连锁删除
	 *
	 * @param string $from 要操作的数据库
	 * @param int $id 要删除的id
	 * @return boolean 是否成功删除
	 */
	static public function delAll(string $from, int $id)
	{
		if ($id == 0) return false;
		switch ($from) {
			case 'User':
				iotuser::destroy($id);
				return true;
			case 'Func':
				$func = iotuser_func::find($id);
				self::delAll('Power', $func->power);
				$func->delete();
				$list = iotuser_func::where('parent', $id)->select()->toArray();
				break;
			case 'Group':
				iotuser_group::destroy($id);
				$list = iotuser_group::where('parent', $id)->select()->toArray();
				break;
			case 'Power':
				iotuser_power::destroy($id);
				$list = iotuser_power::where('parent', $id)->select()->toArray();
				break;
		}
		$len = count($list);
		for ($i = 0; $i < $len; $i++) {
			self::delAll($from, $list[$i]['id']);
		}
		return true;
	}
	/**
	 * 添加或修改一行数据
	 *
	 * @param string $from 要操作的数据库
	 * @param array $arr 数组，包含字段的值
	 * @param bool $way 表示是否是新建
	 * @return bool 是否成功添加
	 */
	static public function createToDb(string $from, array $arr, bool $way)
	{
		switch ($from) {
			case 'User':
				if ($way) $data = new iotuser;
				else $data = iotuser::find($arr['id']);

				// name字段
				$data->name = $arr['name'];

				// status字段
				$data->status = array_key_exists('status', $arr);

				// chinese字段
				$data->chinese = $arr['chinese'];

				// salt字段
				$salt = random_int(1000, 9999);
				$data->salt = $salt;

				// power字段
				$data->power = $arr['power'];

				// password字段
				$data->password = md5($arr['password'] . $salt);

				return $data->save();
			case 'Func':
				if ($way) $data = new iotuser_func;
				else $data = iotuser_func::find($arr['id']);

				// name字段
				$data->name = $arr['name'];

				// chinese字段
				$data->chinese = $arr['chinese'];

				// parent字段
				$data->parent = $arr['parent'];

				// status字段
				$data->status = array_key_exists('status', $arr);

				// level字段，为相关权限获取父节点
				if ($arr['parent']) {
					$parent = iotuser_func::find((int)$arr['parent'])->toArray();
					$data->level = $parent['level'] + 1;
					$power_parent = $parent['power'];
				} else {
					$data->level = 0;
					$power_parent = 0;
				}

				// power字段，修改相关权限
				$power = self::createToDb('Power', [
					'id'        => $data->power,
					'name'      => $data->name,
					'chinese'   => $data->chinese,
					'parent'    => $power_parent,
					'powertype' => 5,
					'value'     => '1',
					'getId'     => true,
				], $way);
				if ($power) $data->power = $power;

				return $data->save();
			case 'Group':
				if ($way) $data = new iotuser_group;
				else $data = iotuser_group::find($arr['id']);

				// name字段
				$data->name = $arr['name'];

				// chinese字段
				$data->chinese = $arr['chinese'];

				// parent字段
				$data->parent = $arr['parent'];

				// power字段
				$data->power = $arr['power'];

				return $data->save();
			case 'Power':
				if ($way) $data = new iotuser_power;
				else $data = iotuser_power::find($arr['id']);

				// name字段
				$data->name = $arr['name'];

				// chinese字段
				$data->chinese = $arr['chinese'];

				// parent字段
				$data->parent = $arr['parent'];

				// type字段
				$data->type = $arr['powertype'];

				// value字段
				$data->value = $arr['value'];

				$res = $data->save();
				return array_key_exists('getId', $arr) ? $data->id : $res;
		}
	}
}
