<?php

namespace App\Http\Controllers\API\Admin;
use App\Http\Controllers\Controller;
use App\Models\Permission;
use App\Models\Role;
use Illuminate\Http\Request;

use App\Models\DeletedMember;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Throwable;

class DeletedMemberController extends Controller
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
                                
                $DeletedMember=DeletedMember::get();

                if($DeletedMember){
                    DB::commit();
                    return $DeletedMember;
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
                $DeletedMember= DeletedMember::where(['id'=>$id])->first();
               
                if($DeletedMember){
                        DB::commit();
                        return $DeletedMember;
                   
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

 

    public function restoreMember($id){
        DB::beginTransaction();
        try {
            $authId= authId();
            $resultRoleAdmin= role($authId,3);
              if($resultRoleAdmin==true){

                $DeletedMember=DeletedMember::where(['id'=>$id])->first();
                if(!empty($DeletedMember)){
                  User::where(['id'=>$DeletedMember->user_id])->update(['status'=>'active']);
                    $DeletedMember->delete();
                    $DeletedMember->save();
                        DB::commit();
                        return \response()->json([
                            'message'=>'deleted successfully, but you restore this member from here'.$routeRestoreDeletedMembers,
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

                $DeletedMember=DeletedMember::where(['id'=>$id])->first();
                if(!empty($DeletedMember)){
                    $DeletedMember->update(['status'=>'inactive']);
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
