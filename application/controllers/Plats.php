<?php

require 'Base_Controller.php';

class Plats extends Base_Controller {

   public function __construct() {
     parent::__construct();
     $this->load->model('plats_model');
     $this->load->model('etudiants_model');     
   }

  public function index_get($id = 0)
   {
     if(!empty($id)){
       $data = $this->plats_model->get_plat($id);
     }
     else if(isset($_GET['nom'])){
       $nom = $this->input->get('nom');
       $data = $this->plats_model->get_plats_by_nom($nom);
     }
     else if(isset($_GET['prixMin']) && isset($_GET['prixMax']))
     {
       $prixMin = $this->input->get('prixMin');
       $prixMax = $this->input->get('prixMax');
       $data = $this->plats_model->get_plats_by_prix($prixMin, $prixMax);
     }
     else{
       $data = $this->plats_model->get_plats();
     }

     $this->response($data, Base_Controller::HTTP_OK);
   }

   public function get_plats_categorie_get($idCategorie)
   {
     $data = $this->plats_model->get_plats_by_categorie($idCategorie);

     $this->response($data, Base_Controller::HTTP_OK);
   }

   public function get_plats_menu_get($date)
   {
     $data = $this->plats_model->get_plats_menu($date);

     $this->response($data, Base_Controller::HTTP_OK);
   }

   public function index_post()
   {
     $input = $this->input->post();
     $this->plats_model->insert_plat($input);

     $this->response(['Plat created successfully.'], Base_Controller::HTTP_OK);
   }

   public function index_put($id)
   {
     $input = $this->put();
     $this->plats_model->update_plat($id,$input);

     $this->response(['Plat updated successfully.'], Base_Controller::HTTP_OK);
   }

   public function index_delete($id)
   {
     $this->plats_model->delete_plat($id);

     $this->response(['Plat deleted successfully.'], Base_Controller::HTTP_OK);
   }
   public function setFavoris_post($idPlat)
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
   public function getFavoris_get()
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
