<?php

namespace App\Http\Controllers\API\Supervisor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Group;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Throwable;

class GroupController extends Controller
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
            $resultRoleUser= role($authId,1);
              if($resultRoleUser==true){
                $groupsUser=User::find($authId)->groupsUser()->get();
                if($groupsUser){
                    DB::commit();
                    return $groupsUser;
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
            $resultRoleUser= role($authId,1);
              if($resultRoleUser==true){
                $Group= new Group();
                $Group->name=$request->name;
                $Group->description=$request->description;
                $Group->status='pending';
               $Group->save();
                DB::commit();
                return \response()->json([
                    'message'=>'created successfully',
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
    
        /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeAuserInGroup(Request $request)
    {
        DB::beginTransaction();
        try {
            $authId= authId();
            $resultRoleUser= role($authId,1);
              if($resultRoleUser==true){
    DB::table('users_groups')->insert(['user_id'=>$request->user_id,'group_id'=>$request->group_id,'status_invitation'=>'pending','status'=>'Active']);
                DB::commit();
                return \response()->json([
                    'message'=>'created successfully',
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
            $resultRoleUser= role($authId,1);
              if($resultRoleUser==true){
                $Group= Group::where(['id'=>$id])->first();

                if($Group){
                    DB::commit();
                    return $Group;
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
                $Group= Group::where(['id'=>$id])->first();
                $Group->name=$request->name;
                $Group->description=$request->description;
                $Group->status='pending';
                $Group->save();
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

       /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateAuserInGroup(Request $request, $id)
    {
        DB::beginTransaction();
        try {
            $authId= authId();
            $resultRoleUser= role($authId,1);
              if($resultRoleUser==true){
   DB::table('users_groups')->where(['id'=>$id])->update(['user_id'=>$request->user_id,'group_id'=>$request->group_id,'status_invitation'=>'pending','status'=>'Active']);
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
            $resultRoleUser= role($authId,1);
              if($resultRoleUser==true){
                Group::where(['id'=>$id])->update(['status'=>'InActive']);
                DB::commit();
                return \response()->json([
                    'message'=>'deleted successfully',
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

        /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroyUserFromGroup($id)
    {
        DB::beginTransaction();
        try {
            $authId= authId();
            $resultRoleUser= role($authId,1);
              if($resultRoleUser==true){
                DB::table('users_groups')->where(['id'=>$id])->update(['status'=>'InActive']);
                DB::commit();
                return \response()->json([
                    'message'=>'deleted successfully',
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
