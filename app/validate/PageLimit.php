<?php
declare(strict_types=1);

namespace app\validate;

use think\Validate;

class PageLimit extends Validate
{
    /**
     * 定义验证规则
     * 格式：'字段名' =>  ['规则1','规则2'...]
     *
     * @var array
     */
    protected $rule = [
        "page" => "require|integer|egt:1",
        "limit"=> "require|integer|between:5,30",
    ];

    /**
     * 定义错误信息
     * 格式：'字段名.规则名' =>  '错误信息'
     *
     * @var array
     */
    protected $message = [];
}
