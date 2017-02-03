<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/1/26
 * Time: 14:12
 */

namespace ms\sdk;


class FastApp {

    private static $domain = 'fa.com';
//    private static $domain = 'fastapp.ecs.niucha.ren';

    public static function register($appName){
        if(empty($appName)){
            return false;
        }
        $url = 'http://' . self::$domain . '/index/app/register';
        $data = [
            'app_name' => $appName,
        ];
        $result = SdkUtils::apiPost($url, $data);
        dump($result);
        return $result;
    }
}