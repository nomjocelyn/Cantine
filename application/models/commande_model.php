<?php defined('BASEPATH') OR exit('No direct script access allowed');

  require_once('Base_Model.php');

  class Commande_model extends Base_Model {
    public function __construct()
    {
      parent::__construct();
    }

    public function setCommande($idEtudiant,$idPlat,$quantite)
    {
      $sql = "insert into Commande(idEtudiant,dateCommande)values(%d,current_date)";
      $sql = sprintf($sql,$idEtudiant);
      $this->db->query($sql);
      $lastid=$this->db->insert_id();  
      $this->setCommande_Plat($lastid,$idPlat,$quantite);
    }
    public function setCommande_Plat($idCommande,$idPlat,$quantite)
    {
        $sql="insert into commandePlat(idCommande, idPlat, quantite) values(%d,%d,%d)";
        $sql=sprintf($sql,$idCommande,$idPlat,$quantite);
        $this->db->query($sql);
    }
    public function modifierCommande($idCommande,$idPlat1,$idPlatNouveau,$quantite)
    {
      $sql=" UPDATE CommandePlat SET idPlat=%d, quantite=%d WHERE idPlat=%d and idCommande=%d";
      $sql=sprintf($sql,$idPlatNouveau,$quantite,$idPlat1,$idCommande);
      $this->db->query($sql);

    }

  }

?>
