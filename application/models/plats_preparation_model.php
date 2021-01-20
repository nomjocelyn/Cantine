<?php defined('BASEPATH') OR exit('No direct script access allowed');

  require_once('Base_Model.php');

  class Plats_preparation_model extends Base_Model {

    public function __construct()
    {
      parent::__construct();
    }

    public function get_plats_a_preparer($date)
    {
      $sql = "select * from platAPreparer where dateCommande='%s'";
      $sql = sprintf($sql, $date);
      $query = $this->db->query($sql);
      $result = array();
      foreach($query->result_array() as $row)
      {
        $result [] = $row;
      }
      return $result;
    }

  }

?>
