<?php

namespace App\Http\Controllers\API\Admin;
use App\Http\Controllers\Controller;

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
    public function showDataAdmin($id)
    {
        DB::beginTransaction();
        try {
            $authId= authId();
            $resultRoleAdmin= role($authId,3);
              if($resultRoleAdmin==true){
                $AdminCount= User::where(['id'=>$id])->count();
                DB::commit();
                if($AdminCount!==0){
                $Admin= User::where(['id'=>$id])->first();

                    if($Admin->role_id==3){

                        return $Admin;   
                    }else{
                        return \response()->json([
                            'data'=>'this is not admin',
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
            $resultRoleAdmin= role($authId,3);
              if($resultRoleAdmin==true){
                $Admin= User::where(['id'=>$id])->first();  
                if($Admin){
                    $Admin->name=$request->name;
                    $Admin->email=$request->email;
                    $Admin->phoneNo=$request->phoneNo;
                    $Admin->password=bcrypt($request->password);
                    $Admin->address=$request->address;
                    $Admin->role_id=3;
                    $Admin->save();
                    DB::commit();
                    return \response()->json([
                        'message'=>'updated successfully',
                        'status'=>200
                    ]);
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
