<?php
declare (strict_types = 1);

namespace app\controller;

use app\model\Music as MusicModel;
use think\Facade\Request;
use app\validate\PageLimit;
use app\validate\IntNum;

class Music
{
    public function getList() {
        $page = (int)Request::post('page');
        $limit = (int)Request::post('limit');

        validate(PageLimit::class)->check(['page' => $page, 'limit' => $limit]);

        $musicModel = new MusicModel();
        $page = $musicModel->getList($page, $limit);
        
        return json(['code' => 0, 'msg' => 'success', 'page' => $page]);
    }

    public function getInfo(int $id) {
        validate(IntNum::class) -> check(['num'=>$id]);

        $info = MusicModel::getInfo($id);

        return json(['code'=>404, 'msg'=>'success', 'info'=>$info]);
    }
}
