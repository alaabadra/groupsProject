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
    public function showDataSupervisor($id)
    {
        DB::beginTransaction();
        try {
            $authId= authId();
            $resultRoleSupervisor= role($authId,2);
              if($resultRoleSupervisor==true){
                $Supervisor= User::where(['id'=>$id])->first();

                if($Supervisor){
                    if($Supervisor->role_id==2){
                        DB::commit();
                        return $Supervisor;
                    }else{
                        return \response()->json([
                            'data'=>'this is not Supervisor',
                            'status'=>404
                        ]);
                    }
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
            $resultRoleSupervisor= role($authId,2);
              if($resultRoleSupervisor==true){
                $Supervisor= User::where(['id'=>$id])->first(); 
                if($Supervisor){
                    if($Supervisor->role_id==2){

                        $Supervisor->name=$request->name;
                        $Supervisor->email=$request->email;
                        $Supervisor->phoneNo=$request->phoneNo;
                        $Supervisor->password=bcrypt($request->password);
                        $Supervisor->address=$request->address;
                        $Supervisor->role_id=2;
                        $Supervisor->save();
                        DB::commit();
                        return \response()->json([
                            'message'=>'updated successfully',
                            'status'=>200
                        ]);
                    }else{
                        return \response()->json([
                            'data'=>'this is not Supervisor',
                            'status'=>404
                        ]);
                    }
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


}
