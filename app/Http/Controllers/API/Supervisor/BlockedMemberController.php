<?php

namespace App\Http\Controllers\API\Admin;
use App\Http\Controllers\Controller;
use App\Models\Permission;
use App\Models\Role;
use Illuminate\Http\Request;

use App\Models\BlockedMember;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Throwable;

class BlockedMemberController extends Controller
{

 /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        DB::beginTransaction();
        try {

            $authId= authId();
            $resultRoleAdmin= role($authId,3);
              if($resultRoleAdmin==true){
                                
                $BlockedMember=BlockedMember::with(['user'])->get();

                if($BlockedMember){
                    DB::commit();
                    return $BlockedMember;
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
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        DB::beginTransaction();
        try {

            $authId= authId();
            $resultRoleAdmin= role($authId,3);
              if($resultRoleAdmin==true){
                $BlockedMember= BlockedMember::where(['id'=>$id])->first();
               
                if($BlockedMember){
                        DB::commit();
                        return $BlockedMember;
                   
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
    public function store($user_id)
    {
        DB::beginTransaction();
        try {

            $authId= authId();
            $resultRoleAdmin= role($authId,3);
              if($resultRoleAdmin==true){
                $BlockedMember= BlockedMember::insert(['user_id'=>$user_id,'status'=>'pending_block']);
               
                if($BlockedMember){
                        DB::commit();
                        return $BlockedMember;
                   
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
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::beginTransaction();
        try {
            $authId= authId();
            $resultRoleAdmin= role($authId,3);
              if($resultRoleAdmin==true){

                $BlockedMember=BlockedMember::where(['id'=>$id])->first();
                if(!empty($BlockedMember)){
                    $BlockedMember->update(['status'=>'pending_delete']);
                        DB::commit();
                        return \response()->json([
                            'message'=>'deleted this member successfully from whole webiste',
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
