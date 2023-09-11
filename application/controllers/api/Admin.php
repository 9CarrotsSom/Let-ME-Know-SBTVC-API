<?php
defined('BASEPATH') OR exit('No direct script access allowed');

include("src/JWT.php");
use \Firebase\JWT\JWT;

class Admin extends MY_Controller {

    function __construct()
    {
        parent::__construct();
        $this->load->library('checkparams');
        $this->load->model('Api/Admin_models');
        $this->db->query("set names utf8mb4");
    }

    public function Test_post() {
        $people = array(
            array('name' => 'John', 'lastname' => 'Doe'),
            array('name' => 'Jane', 'lastname' => 'Doe')
        );
        
        $newPerson = array('name' => 'Bob', 'lastname' => 'Smith');
        array_push($people, $newPerson);
        $people[] = $newPerson;
        $data = ['status'=> true, 'error'=> false, 'Item'=>$people];
        $this->response($data, MY_Controller::HTTP_OK); 
    }

    public function Login_post() {
        $request =  $this->post();
        if (empty($request["Email"]) || empty($request["Password"])) {
            $data = ['status'=>false, 'error'=> true, 'message'=>'Please enter complete information.'];
            $this->response($data, MY_Controller::HTTP_OK); 
        }

        $request["Password"] = hash('sha512', $request["Password"]);

        $res = $this->Admin_models->Login($request);
        if (count($res) == 0) {
            $data = ['status'=>false, 'error'=> true, 'message'=>'No information found.'];
            $this->response($data, MY_Controller::HTTP_OK); 
        }
        $Token = $this->GetJWTToken($res[0]);
        $this->Admin_models->UpdateJWTToken($request["Email"], $Token);
        $data = ['status'=> true, 'error'=> false, 'Token'=> $Token, 'message'=> 'Welcome Thailand.'];
        $this->response($data, MY_Controller::HTTP_OK); 
    }

    public function GetJWTToken($data) {

        $payload = array(
            'Email'=> $data["Email"], 
            'Uuid'=> $data["Uuid"], 
            'PhoneNumber'=> $data["PhoneNumber"], 
            'TimeStamp'=> strtotime(date("Y-m-d H:i:s", strtotime("+24 hours"))),
        );

        $key = "SBTVC888";
        $Token = JWT::encode($payload, $key);
        return $Token;
    }

    public function DecodeJWTToken($Token) {
        $key = "SBTVC888";
        $payload = JWT::decode($Token, $key, array('HS256'));
        return $payload;
    }

    public function CheckTokenTime($Timestamp) {
        $Time = strtotime(date('Y/m/d h:i:sa'));
        if($Time > $Timestamp){
            return true;
        }else{
            return false;
        }
    }

    public function CheckJWTToken($Token) {

        if ($this->Admin_models->CheckJWTToken($Token) == false) {
            $data = ['status'=>false, 'error'=> true, 'message'=> 'Token missing.'];
            $this->response($data, MY_Controller::HTTP_OK); 
        }

        $payload = $this->DecodeJWTToken($Token);
        
        if ($this->CheckTokenTime($payload->TimeStamp)) {
            $data = ['status'=>false, 'error'=> true, 'message'=> 'Token time out.'];
            $this->response($data, MY_Controller::HTTP_OK); 
        }

        return $payload;
    }

    public function Base64Imgaes($Array) {
        // $Array = json_decode($Array, true);

        $ArrayPath = [];
        
        for ($x = 0 ; $x < count($Array); $x++) {

            $base64_string = $Array[$x]["base64_string"];
            $status_item = $Array[$x]["status_item"];

            if($base64_string != "isemty" && $status_item == 1){
                $data_base64 = explode( ',', $base64_string );
                $data = base64_decode($data_base64[ 1 ]);
                $img_name = round(microtime(true) * 1000).".jpg";

                if ($_SERVER['HTTP_HOST'] === 'localhost' || $_SERVER['HTTP_HOST'] === '127.0.0.1') {
                    // echo 'This code is running on a local machine';
                    $dirpath = realpath(dirname(getcwd()));
                    $path =  $dirpath."/php-api/image_item/";
                    $savepath ="/php-api/image_item/".$img_name;
                } else {
                    // echo 'This code is running on a server';
                    $path =  getcwd()."/image_item/";
                    $savepath = "/image_item/".$img_name;
                }

                if(!file_exists($path)){
                    $flgCreate = mkdir($path,0777,true);
                }
                if ( file_put_contents($path.$img_name, $data)) {  
                    array_push($ArrayPath,$savepath);
                } else {
                    echo "Sorry, there was an error uploading your file.";
                }
            }
        }
        return $ArrayPath;
    }

}