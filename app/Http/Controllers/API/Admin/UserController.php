<?php

namespace App\Http\Controllers\API\Admin;
use App\Http\Controllers\Controller;
use App\Models\Deletedmember;
use App\Models\Permission;
use App\Models\Role;
use Illuminate\Http\Request;

use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Throwable;

class UserController extends Controller
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
                                
                $User=User::get();

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
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            $authId= authId();
            $resultRoleAdmin= role($authId,3);
              if($resultRoleAdmin==true){
                               
                $User= new User();
                $User->name=$request->name;
                $User->email=$request->email;
                $User->phoneNo=$request->phoneNo;
                $User->password=$request->password;
                $User->address=$request->address;
                $User->role_id=3;
                $User->save();
                DB::commit();
                return \response()->json([
                    'message'=>'created successfully',
                    'status'=>200,
                    'UserId'=>$User->id
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
            $resultRoleAdmin= role($authId,3);
              if($resultRoleAdmin==true){
                $User= User::where(['id'=>$id])->first();
                if(!empty($User)){
                        $User->email=$request->email;
                        $User->name=$request->name;
                        $User->phoneNo=$request->phoneNo;
                        $User->password=$request->password;
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
    public function destroy($id,$request)
    {
        DB::beginTransaction();
        try {
            $authId= authId();
            $resultRoleAdmin= role($authId,3);
              if($resultRoleAdmin==true){

                $User=User::where(['id'=>$id])->first();
                if(!empty($User)){
                    $User->update(['status'=>'temporarily_deleted']);

                    $routeRestoreDeletedMembers='/user/restore-deleted-members';
                    Deletedmember::insert(['user_id'=>$id,'reason'=>$request->reason]);
                       
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


    
}
