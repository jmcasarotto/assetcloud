<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class app extends CI_Controller {
 function __construct()
        {
  parent::__construct();
  $this->load->model('Apps');
 }

 public function login(){
  $credentials = array(
       'pas'  => $_POST['pas'], 
       'usr' => $_POST['usr']
       );

  $result = $this->Apps->sessionStart_($credentials);
  
  echo json_encode($result);
 }


 public function getEquipo(){
  $result = $this->Apps->getEquipos();

  echo json_encode($result);

 }


  public function setOrder(){

   $dia = explode('/', $_POST['fecha']);
   $dia=$dia[2].'-'.$dia[1].'-'.$dia[0];
  $order = array(

       'f_solicitado' => date('Y-m-d H:i:s'), 
       'solicitante'  => $_POST['usr'],
       'f_sugerido' => $dia ,
        'observaciones' => $_POST['hora'],
       'hora_sug' => $_POST['hora'],
       'causa' => $_POST['falla'],
       'id_equipo' => $_POST['idEquipo'],
       'foto' => 'assets/files/orders/sinImagen.jpg'
      );

  $result = $this->Apps->setOrder($order);
  echo json_encode($result);

  //echo json_encode(false);
 }

 public function saveImage(){

  $image = $_POST['image'];
  $id = $_POST['id'];
   
  $data = array(
    'image' => $image,
    'id'  => $id
   );

  echo $this->Apps->saveImage($data);
 }


}