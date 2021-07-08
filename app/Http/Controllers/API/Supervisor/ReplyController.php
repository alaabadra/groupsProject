<?php

namespace App\Http\Controllers\API\Supervisor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Reply;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Throwable;

class ReplyController extends Controller
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
            $resultRoleUser= role($authId,3);
              if($resultRoleUser==true){
                  $Replies=Reply::get();
                if($Replies){
                    DB::commit();
                    return $Replies;
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
            $resultRoleUser= role($authId,3);
              if($resultRoleUser==true){
                $Reply= new Reply();
                $Reply->text=$request->text;
                $Reply->status='InActive';
               $Reply->save();
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
            $resultRoleUser= role($authId,3);
              if($resultRoleUser==true){
                $Reply= Reply::where(['id'=>$id])->first();

                if($Reply){
                    DB::commit();
                    return $Reply;
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
     * @param  int  $comment_id
     * @return \Illuminate\Http\Response
     */
    public function showRepliesComment($comment_id)
    {
        DB::beginTransaction();
        try {

            $authId= authId();
            $resultRoleUser= role($authId,3);
              if($resultRoleUser==true){
                $Replies= Reply::where(['comment_id'=>$comment_id])->get();

                if($Replies){
                    DB::commit();
                    return $Replies;
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
            $resultRoleUser= role($authId,3);
              if($resultRoleUser==true){
                $Reply= Reply::where(['id'=>$id])->first();
                $Reply->text=$request->text;
                $Reply->status='InActive';
                $Reply->save();
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
            $resultRoleUser= role($authId,3);
              if($resultRoleUser==true){
               $Reply= Reply::where(['id'=>$id])->update(['status'=>'InActive']);
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
