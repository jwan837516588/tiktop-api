<?php
declare(strict_types=1);

namespace app\model;

use think\exception\HttpException;
use think\facade\Config;
use think\Model;

/**
 * @mixin \think\Model
 */
class User extends Model
{
    public function getList(int $page, int $limit, string $type)
    {
        $types = [
            Config::get("utils.TIKTOP_OFFICIAL_ACCOUNT"),
            Config::get("utils.TIKTOP_SINGER"),
            Config::get("utils.NORMAL_USER"),
        ];

        if (in_array($type, $types, true)) {
            return $this->where('type', $type)->paginate(['list_rows' => $limit, 'page' => $page,]);
        }
        return $this->paginate([  'list_rows'=> $limit,'page'=> $page,]);
    }

    public static function getInfo(int $id) {
        $info = self::find($id);
        if (!$info) {
            throw new HttpException(404, "The user does not exist.");
        }

        return $info;
    }
}
