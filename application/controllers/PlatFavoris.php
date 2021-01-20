<?php

require 'Base_Controller.php';

class PlatFavoris extends Base_Controller {

   public function __construct() {
     parent::__construct();
     $this->load->model('plats_model');
     $this->load->model('etudiants_model');     
   }

public function index_post($idPlat)
   {
       $token=$this->etudiants_model->extract_token();
       $etu = $this->etudiants_model->get_etudiant_by_token($token);
       if($etu!=null)
       {
         $idEtudiant = $etu['idEtudiant'];
         $this->plats_model->setFavoris($idEtudiant,$idPlat);
          $this->response(['Plat inserted into Favorits successfully.'], Base_Controller::HTTP_OK);
       }
       else
       {
         $this->response(['Commande inserted successfully.'], Base_Controller::HTTP_OK);
       }
   }
   public function index_get()
   {
    $token=$this->etudiants_model->extract_token();
      $etu = $this->etudiants_model->get_etudiant_by_token($token);
      if($etu!=null)
      {
        $idEtudiant = $etu['idEtudiant'];
        $data=$this->plats_model->getFavoris($idEtudiant);
        $this->response($data, Base_Controller::HTTP_OK);
      }
      else
      {
        $this->response(['not connected'], Base_Controller::HTTP_OK);
      }
      
   }
 }