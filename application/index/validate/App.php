<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/1/22
 * Time: 15:35
 */

namespace app\index\validate;


use think\Validate;

class App extends Validate {
    protected $rule = [
        'app_id' => 'require|number',
        'app_key' => 'require',
        'app_name' => 'require',
    ];
    protected $message = [
        'app_id.require' => 'app_id不能为空',
        'app_id.number' => 'app_id只能是数字',
        'app_key.require' => 'app_key不能为空',
        'app_name.require' => '应用名称不能为空'
    ];

    protected $scene = [
        'register' => ['app_key', 'app_name'],
        'authorize' => ['app_id', 'app_key'],
    ];
}