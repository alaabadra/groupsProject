<?php

namespace App\Http\Controllers\API\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Doctor;
use App\Models\Permission;
use App\Models\Reservation;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Throwable;
class SupervisorController extends Controller
{
    

    
    public function showAllUsersForMeSupervisor()
    {
        DB::beginTransaction();
        try {
            $supervisor_id= authId();
            $resultRoleDoctor= role($supervisor_id,2);

              if($resultRoleDoctor==true){
                $supervisor=User::where(['id'=>$supervisor_id])->first();
                $roleDoctor=$supervisor->role_id;
                $allPermissionsForThisRole=  DB::table('roles_permissions')->where(['role_id'=>$roleDoctor])->get();
                 foreach($allPermissionsForThisRole as $perm){
                   $permRoleDoctor=  Permission::where(['id'=>$perm->permission_id])->first();
                  if($permRoleDoctor->action=='view'){
                    $usersDoctor= Reservation::find($supervisor_id)->users()->get();        
                    if($usersDoctor){
                        DB::commit();
                        return $usersDoctor;
                     }else{
                       return \response()->json([
                           'data'=>'there is no data',
                           'status'=>404
                       ]);
                     }
                  }else{
                     return \response()->json([
                         'data'=>'you cannt make this action  , because you havent this permission',
                         'status'=>400
                     ]);
                  }
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
