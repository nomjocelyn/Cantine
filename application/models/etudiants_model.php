<?php defined('BASEPATH') OR exit('No direct script access allowed');

  require_once('Base_Model.php');

  class Etudiants_model extends Base_Model {

    public function __construct()
    {
      parent::__construct();
    }

    public function insert_etudiant($etudiant)
    {
      $sql = "insert into etudiant(numETU, pwd, nom, dateNaissance) values ('%s', sha1('%s'), '%s', '%s')";
      $sql = sprintf($sql, $etudiant['numETU'], $etudiant['pwd'], $etudiant['nom'], $etudiant['dateNaissance']);
      $this->db->query($sql);
    }

    public function get_etudiant($numETU, $pwd)
    {
      $sql = "select * from etudiant where numETU='%s' and pwd=sha1('%s')";
      $sql = sprintf($sql, $numETU, $pwd);
      $query = $this->db->query($sql);
      return $query->row_array();
    }

    public function insert_token($idEtudiant, $token)
    {
      $sql = "insert into token(idEtudiant,token) values (%d,'%s')";
      $sql = sprintf($sql, $idEtudiant, $token);
      $this->db->query($sql);
    }

    public function update_etudiant($etudiant)
    {
      $sql = "update etudiant set nom='%s', dateNaissance='%s' where idEtudiant=%d";
      $sql = sprintf($sql, $etudiant['nom'], $etudiant['dateNaissance'], $etudiant['idEtudiant']);
      $this->db->query($sql);
    }

    public function get_etudiant_by_token($token)
    {
      $sql = "select * from token where token='%s'";
      $sql = sprintf($sql, $token);
      $query = $this->db->query($sql);
      return $query->row_array();
    }
    public function get_montant_par_Etudiant($idEtudiant,$date)
    {
      $sql="select * from platEtudiant where dateCommande='%s' and idEtudiant=%d";
      $sql = sprintf($sql,$date, $idEtudiant);
      $query = $this->db->query($sql);
      $tab=array();
      $tab[0]=$query->result_array() ;;
      
      $sql2="select sum(montant) from platETudiant where dateCommande='%s' and idEtudiant=%d";
      $sql2 = sprintf($sql2,$date, $idEtudiant);
      $query2 = $this->db->query($sql2);
      $tab[1]=$query2->result_array();
      return $tab;
    }

  
  }

?>
