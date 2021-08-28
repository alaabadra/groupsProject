<?php

namespace App\Http\Controllers\API\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Forbiddenword;
use App\Models\Permission;
use App\Models\Reservation;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Throwable;
class ForbiddenwordController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       // DB::beginTransaction();
       // try {
            $authId= authId();
            $resultAdmin=  role($authId,3);
              if($resultAdmin==true){
                $Forbiddenword=Forbiddenword::with(['commentsForbiddenword','postsForbiddenword','repliesForbiddenword'])->get();
                DB::commit();
                if($Forbiddenword){
                    return \response()->json([
                        'data'=>$Forbiddenword,
                        'status'=>404
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
                    'status'=>400
                ]);
              }
          
        // } catch (Throwable $err) {
        //     DB::rollback();
        //     return \response()->json($err, 500);
        // }
    }

    public function commentsForbiddenword($forbiddenwordId)
    {
       // DB::beginTransaction();
       // try {
            $authId= authId();
            $resultAdmin=  role($authId,3);
              if($resultAdmin==true){
                $Forbiddenword=Forbiddenword::find($forbiddenwordId)->commentsForbiddenword()->get();
                DB::commit();
                if($Forbiddenword){
                    return \response()->json([
                        'data'=>$Forbiddenword,
                        'status'=>404
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
                    'status'=>400
                ]);
              }
          
        // } catch (Throwable $err) {
        //     DB::rollback();
        //     return \response()->json($err, 500);
        // }
    }
    
    public function postsForbiddenword($forbiddenwordId)
    {
       // DB::beginTransaction();
       // try {
            $authId= authId();
            $resultAdmin=  role($authId,3);
              if($resultAdmin==true){
                $Forbiddenword=Forbiddenword::find($forbiddenwordId)->postsForbiddenword()->get();
                DB::commit();
                if($Forbiddenword){
                    return \response()->json([
                        'data'=>$Forbiddenword,
                        'status'=>404
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
                    'status'=>400
                ]);
              }
          
        // } catch (Throwable $err) {
        //     DB::rollback();
        //     return \response()->json($err, 500);
        // }
    }

    public function repliesForbiddenword($forbiddenwordId)
    {
       // DB::beginTransaction();
       // try {
            $authId= authId();
            $resultAdmin=  role($authId,3);
              if($resultAdmin==true){
                $Forbiddenword=Forbiddenword::find($forbiddenwordId)->repliesForbiddenword()->get();
                DB::commit();
                if($Forbiddenword){
                    return \response()->json([
                        'data'=>$Forbiddenword,
                        'status'=>404
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
                    'status'=>400
                ]);
              }
          
        // } catch (Throwable $err) {
        //     DB::rollback();
        //     return \response()->json($err, 500);
        // }
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
            $authId=authId();
            $resultAdmin=role($authId,3);
              if($resultAdmin==true){
                $Forbiddenword= new User();
                $Forbiddenword->name=$request->name;
                $Forbiddenword->status='pending';
                $Forbiddenword->save();
                DB::commit();
                return \response()->json([
                    'message'=>'created successfully',
                    'status'=>200,
                    'ForbiddenwordId'=>$Forbiddenword->id
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
       // DB::beginTransaction();
        //try {
            $authId= authId();
            $resultAdmin= role($authId,3);
              if($resultAdmin==true){
                $Forbiddenword= User::where(['id'=>$id])->first();
                DB::commit();
                if($Forbiddenword){
                        return \response()->json([
                            'data'=>$Forbiddenword,
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
        // } catch (Throwable $err) {
        //     DB::rollback();
        //     return \response()->json($err, 500);
        // }
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
            $resultAdmin= role($authId,3);
              if($resultAdmin==true){
                $Forbiddenword= User::where(['id'=>$id])->first();  
                if(!empty($Forbiddenword)){
                        $Forbiddenword->name=$request->name;
                        $Forbiddenword->status='pending';
                        $Forbiddenword->save();
                        DB::commit();
                        return \response()->json([
                            'message'=>'updated successfully',
                            'status'=>200
                        ]);

                }else{
                    return \response()->json([
                        'message'=>'there is no data',
                        'status'=>200
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
            $resultAdmin= role($authId,3);
              if($resultAdmin==true){
                $Forbiddenword=User::where(['id'=>$id])->first();
                if(!empty($Forbiddenword)){
                        $Forbiddenword->update(['status'=>'pending_delete']);
                        $Forbiddenword->save();
                        DB::commit();
                        return \response()->json([
                            'message'=>'deleted successfully',
                            'status'=>200
                        ]);
                }else{
                    return \response()->json([
                        'message'=>'there is no data',
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
