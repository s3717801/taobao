<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    private $token = '';

    /**
     * token
     * Controller constructor.
     */
    function __construct(Request $request){
        //get access token
        $token = $request->get("token");

//        if(!$token){
//            header('content-type:application/json;charset=utf-8');
//            echo json_encode(["code"=>1,"msg"=>"token is empty"]);exit;
//        }
//
//        $user = DB::table('user')->where("token",$token)->first();
//
//        if(!$user){
//            header('content-type:application/json;charset=utf-8');
//            echo json_encode(["code"=>1,"msg"=>"please login in first"]);exit;
//        }
//        $this->token = $user->id;
    }

    /**
     * output json of format data
     */
    public function toJson($code = 1,$msg = "base fail",$data = [],$page = []){
        return ["code"=>$code,"msg"=>$msg,"page"=>$page,"data"=>$data];
    }

    /**
     * get access token
     */
    public function getToken(){
        return $this->token;
    }
}
