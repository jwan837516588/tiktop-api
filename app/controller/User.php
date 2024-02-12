<?php
declare(strict_types=1);

namespace app\controller;

use app\model\User as UserModel;
use app\validate\PageLimit;
use think\facade\Request;

class User
{
    public function getList()
    {
        $page = (int) Request::post("page");
        $limit = (int) Request::post("limit");
        $user_type = (string) Request::post("type");

        validate(PageLimit::class)->check(['page' => $page, 'limit' => $limit]);

        $userModel = new UserModel();
        $page = $userModel->getList($page, $limit, $user_type);
        return json(['code'=>0, 'msg'=>'success', 'page'=>$page]);
    }
}
