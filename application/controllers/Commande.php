<?php

require 'Base_Controller.php';

class Commande extends Base_Controller {

   public function __construct() {
     parent::__construct();
     $this->load->model('commande_model');
     $this->load->model('etudiants_model');
   }

  
   public function index_post()
   {
    $token=$this->commande_model->extract_token();
    $etu = $this->etudiants_model->get_etudiant_by_token($token);
    if($etu!=null)
    {
      $input = $this->input->post();
      $idEtudiant=$etu['idEtudiant'];

      $idPlat=$input['idPlat'];
      $quantite=$input['quantite'];

      $this->commande_model->setCommande($idEtudiant,$idPlat,$quantite);

      $this->response(['Commande inserted successfully.'], Base_Controller::HTTP_OK);
    }
    else
    {
      $this->response(['Etudiant non connecté'], Base_Controller::HTTP_OK);
    }
   }
   public function index_put($idCommande,$idPlat1,$idPlatNouveau,$quantite)
   {
     $token=$this->commande_model->extract_token();
     $etu = $this->etudiants_model->get_etudiant_by_token($token);
     if($etu!=null)
     {
        $this->modifierCommande($idCommande,$idPlat1,$idPlatNouveau,$quantite);
     }
   }

}
