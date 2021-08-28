<?php

namespace App\Http\Controllers\API\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Activity;
use App\Models\Permission;
use App\Models\Reservation;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Throwable;
class ActivityController extends Controller
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
                $Activity=Activity::with(['users','suppervisors','visitors'])->get();
                DB::commit();
                if($Activity){
                    return \response()->json([
                        'data'=>$Activity,
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

    
    
    public function users($ActivityId)
    {
       // DB::beginTransaction();
       // try {
            $authId= authId();
            $resultAdmin=  role($authId,3);
              if($resultAdmin==true){
                $Activity=Activity::find($ActivityId)->users()->get();
                DB::commit();
                if($Activity){
                    return \response()->json([
                        'data'=>$Activity,
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
    public function suppervisors($ActivityId)
    {
       // DB::beginTransaction();
       // try {
            $authId= authId();
            $resultAdmin=  role($authId,3);
              if($resultAdmin==true){
                $Activity=Activity::find($ActivityId)->suppervisors()->get();
                DB::commit();
                if($Activity){
                    return \response()->json([
                        'data'=>$Activity,
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
    public function visitors($ActivityId)
    {
       // DB::beginTransaction();
       // try {
            $authId= authId();
            $resultAdmin=  role($authId,3);
              if($resultAdmin==true){
                $Activity=Activity::find($ActivityId)->visitors()->get();
                DB::commit();
                if($Activity){
                    return \response()->json([
                        'data'=>$Activity,
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
                $Activity= new Activity();
                $Activity->name=$request->name;
                $Activity->description=$request->description;
                $Activity->date=$request->date;
                $Activity->status='pending';
                $Activity->save();
                DB::commit();
                return \response()->json([
                    'message'=>'created successfully',
                    'status'=>200,
                    'ActivityId'=>$Activity->id
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
                $Activity= User::where(['id'=>$id])->first();
                DB::commit();
                if($Activity){
                        return  \response()->json([
                            'data'=>$Activity,
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
                $Activity= Activity::where(['id'=>$id])->first();  
                if(!empty($Activity)){
                    $Activity->name=$request->name;
                    $Activity->description=$request->description;
                    $Activity->date=$request->date;
                    $Activity->status='pending';
                        $Activity->save();
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
                $Activity=User::where(['id'=>$id])->first();
                if(!empty($Activity)){
                        $Activity->update(['status'=>'pending_delete']);
                        $Activity->save();
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
