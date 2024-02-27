<?php
declare (strict_types = 1);

namespace app\controller;

use app\model\Article as ArticleModel;
use think\Facade\Request;
use app\validate\PageLimit;
use app\validate\IntNum;


class Article
{
    public function getList() {
        $page = (int)Request::post('page');
        $limit = (int)Request::post('limit');

        validate(PageLimit::class)->check(['page' => $page, 'limit' => $limit]);

        $articleModel = new ArticleModel();
        $page = $articleModel->getList($page, $limit);
        
        return json(['code' => 0, 'msg' => 'success', 'page' => $page]);
    }

    public function getInfo(int $id) {
        validate(IntNum::class) -> check(['num'=>$id]);

        $info = ArticleModel::getInfo($id);

        return json(['code'=>404, 'msg'=>'success', 'info'=>$info]);
    }
}
