<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/1/31
 * Time: 21:59
 */

namespace ms\sdk;


use app\common\util\Result;

class SdkUtils {

    private static function curlPost($url, $data){
        $ch = curl_init();//初始化curl
        curl_setopt($ch,CURLOPT_URL, $url);  //抓取指定网页
        curl_setopt($ch, CURLOPT_HEADER, 0); //设置header
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); //要求结果为字符串且输出到屏幕上
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch, CURLOPT_POST, 1); //post提交方式
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data );
        $result = curl_exec($ch);
        if (curl_errno($ch)) {
            $errorMessage = serialize( curl_error($ch) );
            exit("访问网络出错：【{$errorMessage}】");
        }
        curl_close($ch);
        return $result;
    }

    private static function curlGet($url){
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HEADER, FALSE);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        $result = curl_exec($ch);
        if (curl_errno($ch)) {
            $errorMessage = serialize( curl_error($ch) );
            exit("访问网络出错：【{$errorMessage}】");
        }
        curl_close($ch);
        return $result;
    }

    /**
     * post方式请求api   将返回的json格式解析成数组后再返回
     * @param $url
     * @param $data
     * @return mixed
     */
    public static function apiPost($url, $data){
        $result = self::curlPost($url, $data);
        $resultData = json_decode($result, 1);
        if(is_null($resultData)){
            return [
                'code' => Result::API_ACCESS_FAIL,
                'message' => Result::getDefaultMessage(Result::API_ACCESS_FAIL),
                'data' => $result
            ];
        }
        return $resultData;
    }

    /**
     *
     * 拼接签名字符串
     * @param array $data
     *
     * @return string 返回已经拼接好的字符串
     */
    public static function toUrlParams($data){
        $buff = "";
        foreach ($data as $k => $v)
        {
            if($k != "sign"){
                $buff .= $k . "=" . $v . "&";
            }
        }

        $buff = trim($buff, "&");
        return $buff;
    }

    /**
     * 生成的签名
     * @param $url string 要访问的地址, 不带http及https
     * @param $data array 访问的数据
     * @return string
     */
    public static function genSign($url, $data){
        asort($data);
        $params = self::toUrlParams($data);
        if(preg_match('/^(http|https):\/\//', $url, $matches)){
            $url = str_replace($matches[0], '', $url);
        }
        $sign = md5($url . '?' . $params);
        return $sign;
    }
}