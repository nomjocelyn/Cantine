<?php

require 'Base_Controller.php';

class Info extends Base_Controller {

   public function __construct() {
     parent::__construct();
   }

   public function index_get()
   {
       $this->response(['MAMINANTENAINA Nomenjanahary Jocelyn ETU000890'], Base_Controller::HTTP_OK);
   }

}
