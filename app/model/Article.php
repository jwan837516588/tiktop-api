<?php
declare (strict_types = 1);

namespace app\model;

use think\Exception\HttpException;

/**
 * @mixin \think\Model
 */
class Article extends BaseModel
{
    /**
     * convert string to list
     */
    public function getCoverUrlListAttr($value) {
        return explode(',', $value);
    }
    
    public function getList(int $page, int $limit) {
        return $this->with('user')->paginate(['page'=>$page, 'list_rows'=>$limit]);
    }

    public static function getInfo(int $id) {
        $res = self::with('user')->find($id);
        if (!$res) {
            throw new HttpException(404,'article not found');
        }
        return $res;
    }
}
