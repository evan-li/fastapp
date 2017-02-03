<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/1/22
 * Time: 15:04
 */

namespace app\index\controller;


use app\common\model\App;
use app\common\util\Result;
use think\helper\Str;
use think\Request;

class AppController extends CommonController {

    public function register(Request $request){
        $data = $request->get();
        if(empty($data)){
            return $this->response(Result::PARAM_INVALID);
        }

        $app = new App();
        $data['app_key'] = Str::random(64);
        $result = $app->validate('App.register')->save($data);
        if($result === false){
            return $this->response(Result::PARAM_INVALID, $app->getError());
        }

        return $this->response(Result::OK, $app);
    }

    public function all(){
        return $this->response(App::get(1));
    }

    public function authorize($app_id, $app_key){

        $data = [
            'app_id' => $app_id,
            'app_key' => $app_key
        ];
        $error = $this->validate($data, 'App.authorize');
        if($error !== true){
            return $this->response(Result::PARAM_INVALID, $error);
        }
        $app = App::get($app_id);
        if(empty($app)){
            return $this->response(Result::APP_NOT_FOUND);
        }
        if($app->app_key != $app_key){
            return $this->response(Result::APP_KEY_INVALID);
        }
        return $this->response($app);
    }

}