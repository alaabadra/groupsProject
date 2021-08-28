<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use App\Models\User;
use App\Models\Visitor;
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
    public function showDataVisitor($id)
    {
        DB::beginTransaction();
        try {
            $authId= authId();
            $resultRoleVisitor= role($authId,1);
              if($resultRoleVisitor==true){
                $Visitor= User::where(['id'=>$id])->first();

                    if($Visitor){
                        DB::commit();
                        return $Visitor;
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
            $resultRoleVisitor= role($authId,1);
              if($resultRoleVisitor==true){
                $Visitor= User::where(['id'=>$id])->first();           
                $Visitor->name=$request->name;
                $Visitor->email=$request->email;
                $Visitor->phoneNo=$request->phoneNo;
                $Visitor->password=bcrypt($request->password);
                $Visitor->address=$request->address;
                $Visitor->role_id=3;
                $Visitor->save();
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
