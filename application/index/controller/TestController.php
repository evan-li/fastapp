<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/2/3
 * Time: 19:02
 */

namespace app\index\controller;


use ms\sdk\FastApp;

class TestController extends CommonController
{

    public function test(){
        $result = FastApp::register('测试sdk注册');
        return json($result);
    }
}