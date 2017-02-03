<?php
namespace app\common\util;

/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/1/22
 * Time: 16:29
 */
class Result {

    const OK = 0;
    const PARAM_INVALID = 1;
    const RETURN_CODE_INVALID = 2;

    const DATA_NOT_FOUNT = 11;

    const APP_NOT_FOUND = 20;
    const APP_KEY_INVALID = 21;


    const API_ACCESS_FAIL = 30;


    private static $defaultMessage = [
        self::OK => '操作成功',
        self::PARAM_INVALID => '参数不合法',
        self::RETURN_CODE_INVALID => '响应code不合法',

        self::APP_NOT_FOUND => '应用不存在',
        self::APP_KEY_INVALID => 'APP_KEY无效',

        self::API_ACCESS_FAIL => 'API访问失败',

    ];

    public static function getDefaultMessage($code){
        return self::$defaultMessage[$code] ?: '默认响应消息不存在';
    }

}