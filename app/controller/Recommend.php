<?php
declare (strict_types = 1);

namespace app\controller;

use think\Facade\Request;
use app\validate\PageLimit;
use app\model\Recommend as RecommendModel;

class Recommend
{
    public function getList()
    {
        $page = (int)Request::post('page');
        $limit = (int)Request::post('limit');

        validate(PageLimit::class)->check(['page' => $page, 'limit' => $limit]);

        $recommendModel = new RecommendModel();
        $page = $recommendModel->getList($page, $limit);
        
        return json(['code' => 0, 'msg' => 'success', 'page' => $page]);
    }
}
