<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/ImplementJwt.php';

class AuthCheck
{
     private $CI = null; 
    public function __construct($token)
    {
        $this->CI =& get_instance();
        $token = $token['token'];

        // $this->CI->load->model('admin/Admin_models');
        // print_r($token['token']);exit();
        // foreach (getallheaders() as $name => $value) {
        //   if($name == 'x-access-token'){
        //       $token = $value;
        //   }
        // }


        if (!empty($token)) {
        
          $this->objOfJwt = new ImplementJwt();
          
          try
          {
            $jwtData = $this->objOfJwt->DecodeToken($token);
            $date= $jwtData['timeStamp'];
            $datetemp = strtotime($date);
            $newdate = date('Y-m-d',strtotime("+1 year",$datetemp));

            $datenow = Date('Y-m-d');
     
            if(strtotime($newdate)<strtotime($datenow)){
              header('Content-Type: application/json');
              http_response_code('200');
  
              $jsonResult['status'] =false;
              $jsonResult['code'] ='0000';
              $jsonResult['message'] = "Token is has expired ,Plase login agian.";
  
              echo json_encode($jsonResult);
              exit(0);
            }
          }
          catch (Exception $e)
          {
            header('Content-Type: application/json');
            http_response_code('200');

            $jsonResult['status'] = false;
            $jsonResult['code'] ='0000';
            $jsonResult['message'] = "Invalid token. Please check you request.";

            echo json_encode($jsonResult);
            exit(0);
          }


        }
        else
        {
          header('Content-Type: application/json');
          http_response_code('200');
            
          $jsonResult['status' ]= false;
          $jsonResult['message'] = "Missing auth token. Please check you request.";

          echo json_encode($jsonResult);
          exit(0);
        }


    }
}
