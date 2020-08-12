<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RegisterController{

    /**
     * json format function
     */
    public function toJson($code = 1,$msg = "base fail",$data = [],$page = []){
        return ["code"=>$code,"msg"=>$msg,"page"=>$page,"data"=>$data];
    }

    /**
     * register
     */
    public function register(Request $request){
        //receive params
        $name = $request->get("name");
        $pass = $request->get("pass");

        $result = DB::table('user')->where('name',$name)->first();

        if($result){
            return $this->toJson(1,'The account has been registered');
        }

        //Insert the data into the User table
        $user = DB::table('user')->insert([
            "name"=>$name,
            "pass"=>md5($pass),
            "created_at"=>time(),
            "updated_at"=>time()
        ]);

        if(!$user){
            return $this->toJson(1,'Error');
        }else{
            return $this->toJson(0,'Success');
        }
    }
}