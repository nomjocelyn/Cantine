<?php defined('BASEPATH') OR exit('No direct script access allowed');

  require_once('Base_Model.php');

  class Plats_model extends Base_Model {

    public function __construct()
    {
      parent::__construct();
    }

    public function get_plats()
    {
      $sql = "select * from plat";
      $query = $this->db->query($sql);
      // $result = array();
      // foreach($query->result_array() as $row)
      // {
      //   $result [] = $row;
      // }
      // return $result;
      return $query->result();
    }

    public function get_plat($id)
    {
      $sql = "select * from plat where idPlat=%d";
      $sql = sprintf($sql, $id);
      $query = $this->db->query($sql);
      $plat = $query->row_array();
      $plat['image']=site_url("assets/img/".$plat['image']);
      return $plat;
    }

    public function get_plats_by_nom($nom)
    {
      $sql = "select * from plat where intitule like '%s%s%s'";
      $sql = sprintf($sql, '%', $nom, '%');
      $query = $this->db->query($sql);
      return $query->result();
    }

    public function get_plats_by_prix($prixMin, $prixMax)
    {
      $sql = "select * from plat where %d <= prix and prix <= %d";
      $sql = sprintf($sql, $prixMin, $prixMax);
      $query = $this->db->query($sql);
      return $query->result();
    }

    public function get_plats_by_categorie($idCategorie)
    {
      $sql = "select * from plat where idCategorie=%d";
      $sql = sprintf($sql, $idCategorie);
      $query = $this->db->query($sql);
      return $query->result();
    }

    public function get_plats_menu($date)
    {
      $sql = "select * from menuJournalier where dateMenu='%s'";
      $sql = sprintf($sql, $date);
      $query = $this->db->query($sql);
      return $query->result();
    }

    public function insert_plat($plat)
    {
      $this->db->insert('plat',$plat);
    }

    public function update_plat($id, $plat)
    {
      $this->db->update('plat', $plat, array('idPlat'=>$id));
    }

    public function delete_plat($id)
    {
      $this->db->delete('plat', array('idPlat'=>$id));
    }

    public function setFavoris($idEtudiant,$idPlat)
    {
      $sql="insert into Favoris (idEtudiant,idPlat) values(%d,%d)";
      $sql=sprintf($sql,$idEtudiant,$idPlat);
      $this->db->query($sql);
    }
    public function getFavoris($idEtudiant)
    {
      $sql="select plat.* from favoris join plat on(plat.idPlat=favoris.idPlat)";
      $query = $this->db->query($sql);
      foreach($query->result_array() as $row)
      {
        $result [] = $row;
      }
      return $result;
    }

  }
?>
