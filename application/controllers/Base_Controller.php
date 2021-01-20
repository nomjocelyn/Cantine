<?php

 require APPPATH . '/libraries/REST_Controller.php';
 use Restserver\Libraries\REST_Controller;

class Base_Controller extends REST_Controller {

   public function __construct() {
     parent::__construct();
   }

}
