<?php
declare (strict_types = 1);

namespace app\model;

use think\exception\HttpException;

/**
 * @mixin \think\Model
 */
class Music extends BaseModel
{

    public function getList(int $page, int $limit) {
        return $this->with('user')->paginate(['page'=>$page, 'list_rows'=>$limit]);
    }

    public static function getInfo(int $id) {
        $res = self::with('user')->find($id);
        if (!$res) {
            throw new HttpException(404,'music not found');
        }
        return $res;
    }
}
