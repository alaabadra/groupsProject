<?php
            $authId= $this->authId();
            $resultRoleUser= $this->roleUser($authId,3);
              if($resultRoleUser==true){
               
            }else{
                return \response()->json([
                    'data'=>'you cannt enter here , because you havent auth admin',
                    'status'=>401
                ]);
            }