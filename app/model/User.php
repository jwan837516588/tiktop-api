<?php
declare(strict_types=1);

namespace app\model;

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
}
