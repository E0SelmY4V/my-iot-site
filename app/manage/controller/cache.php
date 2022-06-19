<?php

namespace app\manage\controller;

use think\facade\View;
use app\common\controller\Base;

/**
 * 缓存管理控制器
 */
class cache extends Base
{
	public function index()
	{
		parent::testPower(__CLASS__);
		if (request()->isPost()) {
			$this->deldir(root_path() . 'runtime');
			return "成功清除缓存";
		} else {
			return View::fetch();
		}
	}
	/**
	 * 删除目录
	 *
	 * @param string $dir 要删除的目录
	 * @return boolean 是否成功删除
	 */
	static public function deldir(string $dir)
	{
		$dh = opendir($dir);
		while ($file = readdir($dh)) {
			if ($file != "." && $file != "..") {
				$fullpath = $dir . "/" . $file;
				if (!is_dir($fullpath)) unlink($fullpath);
				else self::deldir($fullpath);
			}
		}
		closedir($dh);
		return rmdir($dir) ? true : false;
	}
}
