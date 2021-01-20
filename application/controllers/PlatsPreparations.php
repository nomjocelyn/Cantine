<?php

require 'Base_Controller.php';

class PlatsPreparations extends Base_Controller {

   public function __construct() {
     parent::__construct();
     $this->load->model('plats_preparation_model');
   }

  public function index_get($date)
   {
     $data = $this->plats_preparation_model->get_plats_a_preparer($date);

     $this->response($data, Base_Controller::HTTP_OK);
   }

}
