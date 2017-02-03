<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/1/22
 * Time: 15:20
 */

namespace app\index\controller;


use app\common\util\Result;
use think\Controller;
use think\Request;

class CommonController extends Controller {

    public function _empty(Request $request){
        return '<h1>操作不存在: ' . $request->module() . '-' . $request->controller() . '-' . $request->action() . '</h1>';
    }

    protected function response($code, $message='', $data=[]){
        if(is_array($code) || is_object($code)){
            $data = $code;
            $code = Result::OK;
        }
        if(!is_string($message)){
            $data = $message;
            $message = '';
        }
        if((empty($code) || !is_numeric($code)) && $code !== 0){
            $data = [
                '原始响应数据' => [
                    'code' => $code,
                    'message' => $message,
                    'data' => $data
                ]
            ];
            $code = Result::RETURN_CODE_INVALID;
            $message = Result::getDefaultMessage($code);
        }
        if(empty($message)){
            $message = Result::getDefaultMessage($code);
        }
        $result = [
            'code' => $code + config('error_code_base'),
            'message' => $message,
            'data' => $data
        ];
        return json($result);
    }
}