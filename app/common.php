<?php

use app\common\model\iotuser;
use app\common\model\iotuser_group;
use app\common\model\iotuser_power;
use app\common\model\iotuser_func;
use app\manage\controller\func;
use think\exception\HttpResponseException;

/**
 * 格式化用户
 *
 * @param mixed $user 要格式化的用户数组
 * @return mixed 格式化后的用户数组
 */
function user_format($user)
{
	$user['group'] = iotuser_group::find($user['power'])->toArray();
	if ($user['group']['id'] != 1) {
		$user['power'] = json_decode('[' . $user['group']['power'] . ']');
	} else {
		$user['power'] = "all";
	}
	return $user;
}
/**
 * 批量格式化用户
 *
 * @param mixed $list 要格式化的用户数组数组
 * @return mixed 格式化后的用户数组数组
 */
function user_formatAll($list)
{
	$len = count($list);
	for ($i = 0; $i < $len; $i++) {
		$result[$i] = user_format($list[$i]);
	}
	return $result;
}
/**
 * 判断数据是否有子节点
 *
 * @param string $from 要操作的数据库
 * @param int $id 要查找的数据id
 * @return boolean 是否有子节点
 */
function isParent(string $from, int $id)
{
	if ($id == 0) return false;
	switch ($from) {
		case 'User':
			return false;
		case 'Func':
			$list = iotuser_func::where('parent', $id)->select()->toArray();
			break;
		case 'Group':
			$list = iotuser_group::where('parent', $id)->select()->toArray();
			break;
		case 'Power':
			$list = iotuser_power::where('parent', $id)->select()->toArray();
	}
	return count($list) ? true : false;
}
$GLOBALS['power_type'] = [[
	'name' => 'other',
	'chinese' => '其他',
], [
	'name' => 'create',
	'chinese' => '增加',
], [
	'name' => 'delete',
	'chinese' => '删除',
], [
	'name' => 'update',
	'chinese' => '修改',
], [
	'name' => 'retrieve',
	'chinese' => '查询',
], [
	'name' => 'visit',
	'chinese' => '访问',
],];
/**
 * 获得额外信息的HTML代码
 *
 * @param string $from 要操作的数据库
 * @param mixed $data 要获取信息的数据
 *
 * @return string HTML代码
 */
function getAddInfoHTML(string $from, $data)
{
	switch ($from) {
		case 'Func':
			return $data['status']
				? '<a class="status nok">禁用</a>'
				: '<a class="status ok">可用</a>';
		case 'Group':
			return '';
		case 'User':
			return $data['status']
				? '<a class="status nok">禁用</a>'
				: '<a class="status ok">可用</a>';
		case 'Power':
			$type = $data['type'];
			return '<a class="status ok' . $type . '">' . $GLOBALS['power_type'][$type]['chinese'] . '</a>';
	}
}
/**
 * 获取当前类的名字
 *
 * @param string $name 类的绝对名字
 * @return string 开头字母大写的类的名字
 */
function getClassName(string $name)
{
	$arr = explode("\\", $name);
	$name = ucfirst(end($arr));
	return $name;
}
/**
 * 检测用户是否有权限
 *
 * @param int $parent 父节点的id
 * @param string $name 检测的名称
 * @return int 检测的功能的数据数组
 */
function isPowerful(int $parent, string $name)
{
	$power = request()->user['power'];
	$testNow = iotuser_func::where("parent", $parent)->where("name", $name)->select()->toArray()[0];
	if ($power != "all" && array_search($testNow['power'], $power) === false) {
		throw new HttpResponseException(redirect('../error/nopower'));
	}
	if ($testNow['status']) {
		throw new HttpResponseException(redirect('../error/nafunc'));
	}
	return $testNow;
}
