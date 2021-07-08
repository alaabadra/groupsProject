<?php

namespace App\Http\Controllers\API\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Offensiveword;
use App\Models\Permission;
use App\Models\Reservation;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Throwable;
class OffensivewordController extends Controller
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
                $Offensiveword=Offensiveword::with(['postsoffensiveword'])->get();
                DB::commit();
                if($Offensiveword){
                    return \response()->json([
                        'data'=>$Offensiveword,
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

    
    
    public function postsOffensiveword($OffensivewordId)
    {
       // DB::beginTransaction();
       // try {
            $authId= authId();
            $resultAdmin=  role($authId,3);
              if($resultAdmin==true){
                $Offensiveword=Offensiveword::find($OffensivewordId)->postsOffensiveword()->get();
                DB::commit();
                if($Offensiveword){
                    return \response()->json([
                        'data'=>$Offensiveword,
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
                $Offensiveword= new User();
                $Offensiveword->name=$request->name;
                $Offensiveword->status='pending';
                $Offensiveword->save();
                DB::commit();
                return \response()->json([
                    'message'=>'created successfully',
                    'status'=>200,
                    'OffensivewordId'=>$Offensiveword->id
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
                $Offensiveword= User::where(['id'=>$id])->first();
                DB::commit();
                if($Offensiveword){
                        return  \response()->json([
                            'data'=>$Offensiveword,
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
                $Offensiveword= User::where(['id'=>$id])->first();  
                if(!empty($Offensiveword)){
                        $Offensiveword->name=$request->name;
                        $Offensiveword->status='pending';
                       
                        $Offensiveword->save();
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
                $Offensiveword=User::where(['id'=>$id])->first();
                if(!empty($Offensiveword)){
                        $Offensiveword->update(['status'=>'pending_delete']);
                        $Offensiveword->save();
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
