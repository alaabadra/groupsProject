<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use App\Models\User;
use Illuminate\Http\Request;
use Throwable;
use DB;

class ProfileController extends Controller
{

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showDataUser($id)
    {
        DB::beginTransaction();
        try {
            $authId= authId();
            $resultRoleUser= role($authId,1);
              if($resultRoleUser==true){
                $User= User::where(['id'=>$id])->first();

                    if($User){
                        DB::commit();
                        return $User;
                     }else{
                       return \response()->json([
                           'data'=>'there is no data',
                           'status'=>404
                       ]);
                     }
            }else{
                return \response()->json([
                    'data'=>'you cannt enter here , because you havent auth admin',
                    'status'=>401
                ]);
            }
    
        } catch (Throwable $err) {
            DB::rollback();
            return \response()->json($err, 500);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        DB::beginTransaction();
        try {
            $authId= authId();
            $resultRoleUser= role($authId,1);
              if($resultRoleUser==true){
                $User= User::where(['id'=>$id])->first();           
                $User->name=$request->name;
                $User->email=$request->email;
                $User->phoneNo=$request->phoneNo;
                $User->password=bcrypt($request->password);
                $User->address=$request->address;
                $User->role_id=3;
                $User->save();
                DB::commit();
                return \response()->json([
                    'message'=>'updated successfully',
                    'status'=>200
                ]);
            }else{
                return \response()->json([
                    'data'=>'you cannt enter here , because you havent auth admin',
                    'status'=>401
                ]);
            }  
        } catch (Throwable $err) {
            DB::rollback();
            return \response()->json($err, 500);
        }
    }


}
