<?php

namespace App\Http\Controllers\API\Auth;

use App\Http\Controllers\Controller;
use App\Models\Permission;
use App\Models\Role;
use Illuminate\Http\Request;

use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Throwable;
class AuthController extends Controller
{
    public function register(Request $request){
        try{
            $userCount=User::where(['email'=>$request->email])->count();
            if($userCount>0){
                return \response()->json([
                    'data'=>'email is exist already',
                    'status'=>400
                ]);
            }else{
            if($request->password_confirmation==$request->password){
            $user=new User();
            $user->email=$request->email;
            $user->phoneNo=$request->phoneNo;
            $user->address=$request->address;
            $user->password=bcrypt($request->password);
            $user->name=$request->name;
            $roleUser=Role::where(['id'=>$request->role_id])->first();
            if(!empty($roleUser)){
               $user->role_id= $request->role_id; 
               $user->save();
               return \response()->json([
                   'data'=>'registered successfully',
                   'status'=>200
               ]);
            }else{
                $user->role_id= 1; 
                $user->save();
                return \response()->json([
                    'data'=>'registered successfully, but because role id that you put it , not exist , so we put you as user',
                    'status'=>200
                ]);   
            }
               
               
            }else{
                return \response()->json([
                    'data'=>'password must be matching',
                    'status'=>400
                ]);
            }
            }
        }catch(\Exception $ex){
            return response()->json([
                'status'=>500,
                'message'=>'There is something wrong, please try again'
            ]);  
        } 
    }
    public function login(Request $req){
        $user = User::where('email', $req->email)->first();
        if (! $user || ! Hash::check($req->password, $user->password)) {
           return \response()->json([
            'status'=>400,
            'data'=>"The provided credentials are incorrect."
           ]);
        }else{
            $token = $user->createToken('auth_token')->plainTextToken;
            return response()->json([
                    'access_token' => $token,
                    'token_type' => 'Bearer',
            ]);
        //     session()->put('token',$user->createToken('auth_token')->plainTextToken);
        //   return \response()->json([
        //     'status'=>200,
        //     'token'=>$user->createToken('auth_token')->plainTextToken
        //    ]);  
        }
    }
}
