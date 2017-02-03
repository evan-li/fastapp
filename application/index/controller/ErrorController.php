<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/1/22
 * Time: 15:24
 */

namespace app\index\controller;


use think\Request;

class ErrorController extends CommonController {

    public function index(Request $request){
        return $this->_empty($request);
    }
}