<?php

namespace App\Http\Controllers\API\Visitor;

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
    public function getGroupsUser()
    {
        DB::beginTransaction();
        try {
            $authId= authId();
            $resultRoleUser= role($authId,1);
              if($resultRoleUser==true){
                $groupsUser=User::find($authId)->groupsUser()->get();
                if($groupsUser){
                    DB::commit();
                    return \response()->json([
                        'data'=>$groupsUser,
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
