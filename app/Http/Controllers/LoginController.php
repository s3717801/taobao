<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;


class LoginController{

    /**
     * Login
     */
    public function login(Request $request){
        //received param
        $name = $request->get("name");
        $pass = $request->get("pass");

        //search data from database
        $user = DB::table('user')->where('name',$name)->where('pass',md5($pass))->first();

        if(!$user){
            return $this->toJson(1,'account or password error!');
        }else{
            $token = md5($user->id.time().$user->pass);
            DB::table('user')->where('id',$user->id)->update(["token"=>$token]);
            return $this->toJson(0,'login success',$token);
        }
    }

    /**
     * admin login
     */
    public function loginV2(Request $request){
		//get params
        $request = $request->json();
        $account = $request->get("account");
        $password = $request->get("password");

        //search data from database
        $user = DB::table('admin')->where('account',$account)->where('password',md5($password))->first();

        if(!$user){
            return $this->toJson(1,'account or password error');
        }else{
            $token = md5($user->id.time().$user->password);
            DB::table('admin')->where('id',$user->id)->update(["token"=>$token]);
            return $this->toJson(0,'success',$token);
        }
    }

    /**
     * output json data
     */
    public function toJson($code = 1,$msg = "base fail",$data = [],$page = []){
        return ["code"=>$code,"msg"=>$msg,"page"=>$page,"data"=>$data];
    }
}