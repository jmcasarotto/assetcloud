<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Altparametro extends CI_Controller {
  function __construct()
        {
    parent::__construct();
    $this->load->model('Altparametros');
  }

  public function index($permission)
  {
    $data['list'] = $this->Altparametros->param_List();
    $data['permission'] = $permission;
    $this->load->view('altparametro/list', $data);
  }
  
  
  public function getpencil(){

    $id=$_GET['id_pa'];
    //print_r($id);
    $result = $this->Altparametros->getpencil($id);
    print_r(json_encode($result));

  }

  public function edit_param(){

    $datos=$_POST['parametros'];
    $id=$_POST['ed'];
    
    $result = $this->Altparametros->update_editar($datos,$id);
    return true;
    }

    public function agregar_parametro(){

      if($_POST){
        $datos=$_POST['parametros'];

        $result = $this->Altparametros->agregar_parametros($datos);
          //print_r($this->db->insert_id());
          
          if($result)
            echo $this->db->insert_id();
          else echo 0;
      }
    }

    public function baja_parametro(){
  
    $idpa=$_POST['idpa'];
    
    $result = $this->Altparametros->eliminacion($idpa);
    print_r($result);
  
  }

  
  
}
