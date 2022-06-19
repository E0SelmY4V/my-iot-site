<?php

namespace app\register\controller;

use app\BaseController;
use think\facade\View;
use think\facade\Session;
use think\captcha\facade\Captcha;
use think\facade\Db;
use app\common\model\iotuser;

class index extends BaseController
{
    public function index()
    {
        if (request()->isPost()) {
            $post = input('post.');
            $user = new iotuser();
            $user->name = $post['account'];
            $salt = random_int(1000, 9999);
            $user->password = md5($post['pwd'] . $salt);
            $user->salt = $salt;
            $user->save();
            return "<h1>成功注册！</h1>";
        } else return View::fetch('index');
    }
}
