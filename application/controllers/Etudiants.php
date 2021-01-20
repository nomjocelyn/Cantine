<?php

require 'Base_Controller.php';

class Etudiants extends Base_Controller {

   public function __construct() {
     parent::__construct();
     $this->load->model('etudiants_model');

   }

   

   public function index_post($numETU)
   {
     if(!empty($numETU)){
       $etudiant = $this->etudiants_model->get_etudiant($numETU, $this->input->post('pwd'));
       if($etudiant!=null){
         $token = sha1($etudiant['idEtudiant'].$numETU);
         $etudiant = $this->etudiants_model->insert_token($etudiant['idEtudiant'], $token);
         $this->response([$token], Base_Controller::HTTP_OK);
       }
       else{
         $this->response(['Numero ou mot de passe incorrect'], Base_Controller::HTTP_OK);
       }

     }
     else{
       $etudiant = $this->input->post();
       $this->etudiants_model->insert_etudiant($etudiant);

       $this->response(['Etudiant inscrit'], Base_Controller::HTTP_OK);
     }
   }

   public function index_put()
   {
    
    $token=$this->etudiants_model->extract_token();

     if(!empty($token))
     {
       $etu = $this->etudiants_model->get_etudiant_by_token($token);

       if($etu!=null)
       {
         $idEtudiant = $etu['idEtudiant'];

         $etudiant = $this->put();
         $etudiant['idEtudiant'] = $idEtudiant;
         $this->etudiants_model->update_etudiant($etudiant);

         $this->response(['Profil modifié'], Base_Controller::HTTP_OK);
       }
       else{
          $this->response(['Etudiant non connecté'], Base_Controller::HTTP_OK);
       }
     }
     else{
       $this->response(['Etudiant non spécifié'], Base_Controller::HTTP_OK);
     }

   }
   public function get_montant_par_Etudiant_get($date)
   {
      $token=$this->etudiants_model->extract_token();
      $etu = $this->etudiants_model->get_etudiant_by_token($token);
      
      if($etu!=null)
       {
          $idEtudiant = $etu['idEtudiant'];
          $array=$this->etudiants_model->get_montant_par_Etudiant($idEtudiant,$date);
          var_dump($array);

          $this->response($array, Base_Controller::HTTP_OK);
       }
       else
       {
          $this->response(['Etudiant non connecté'], Base_Controller::HTTP_OK);
       }

      
   }


   



}
