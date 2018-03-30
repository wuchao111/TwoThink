<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/3/27
 * Time: 16:21
 */

namespace app\admin\validate;

use app\common\validate\Base;

class Property extends Base
{
    protected $rule = [
        ['name', 'require|/^[a-zA-Z][\w_]{1,29}$/|checkName', '名字不能为空|字段名不合法|字段名已存在'],
        ['tel', 'require|length:1,11', '字电话不能为空|不能超过12个长度'],
        ['address','require|','地址不能为空'],
        ['titel','require|','标题不能为空'],
        ['content','require|','内容不能为空'],
    ];
}