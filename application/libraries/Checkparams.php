<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Checkparams
{
 
    public function __construct()
    {
  
      
    }
    public function checkParam($request,$nameparam)
    {
        // $nameparam = ['users_id','token'];
        $checkparam = 0;
        foreach ($request as $key => $value) {
            foreach ($nameparam as $keys => $values) {
                if($key==$values){
                    $checkparam ++;
                }
        
            }
        
        
        }
        if($checkparam!=count($nameparam)){
            $jsonResult['status'] =false;
            $jsonResult['message'] = "Check You params !!!!";

            echo json_encode($jsonResult);
            exit(0);
        }
      
    }
}
