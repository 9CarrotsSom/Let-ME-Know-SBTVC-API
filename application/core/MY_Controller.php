<?php
use Restserver\Libraries\REST_Controller; 
defined('BASEPATH') OR exit('No direct script access allowed');

// //To Solve File REST_Controller not found
require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

class MY_Controller extends REST_Controller {

    function __construct()
    {
        header ("Access-Control-Allow-Origin: *");
        header ("Access-Control-Expose-Headers: Content-Length, X-JSON,x-access-token");
        header ("Access-Control-Allow-Methods: GET, POST, PATCH, PUT, DELETE, OPTIONS");
        header ("Access-Control-Allow-Headers: *");
        header ('Access-Control-Allow-Credentials: true');
        parent::__construct();
    }
    public function index_options() {
        return $this->response(NULL, REST_Controller::HTTP_OK);
    }

}

?>
