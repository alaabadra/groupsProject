<?php

namespace App\Http\Controllers\API\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Reservation;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Throwable;
class ReservationController extends Controller
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
                $Reservation=Reservation::get();

                if($Reservation){
                    DB::commit();
                    return $Reservation;
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
                $Reservation= new Reservation();
                $Reservation->user_id=$request->user_id;
                $Reservation->doctor_id=$request->doctor_id;
                $Reservation->address=$request->address;
                $Reservation->date=$request->date;
                $Reservation->save();
                DB::commit();
                return \response()->json([
                    'message'=>'created successfully',
                    'status'=>200,
                    'ReservationId'=>$Reservation->id
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
                $Reservation= Reservation::where(['id'=>$id])->first();

                if($Reservation){
                    DB::commit();
                    return $Reservation;
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
                $Reservation= Reservation::where(['id'=>$id])->first();
                $Reservation->user_id=$request->user_id;
                $Reservation->doctor_id=$request->doctor_id;
                $Reservation->address=$request->address;
                $Reservation->date=$request->date;
                $Reservation->save();
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
                $Reservation=Reservation::where(['id'=>$id])->first();

                $Reservation->delete();
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
