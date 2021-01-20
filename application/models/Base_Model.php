<?php defined('BASEPATH') OR exit('No direct script access allowed');

  class Base_Model extends CI_Model {
    public function __construct()
    {
      parent::__construct();
    }

    public function extract_token()
    {
      $auth=$this->input->get_request_header("authorization",true);
      $exploded=explode(' ', $auth);
      if(count($exploded)<2)
      {
        return null;
      }
      return $exploded[1];
    }
  }

?>
