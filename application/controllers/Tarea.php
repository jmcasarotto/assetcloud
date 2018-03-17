<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Tarea extends CI_Controller {
  function __construct()
        {
    parent::__construct();
    $this->load->model('Tareas');
  }

  public function index($permission)
  {
    $data['list'] = $this->Tareas->tarea_List();
    $data['permission'] = $permission;
    $this->load->view('tarea/list', $data);
  }
  
  
  public function getpencil(){

    $id=$_GET['id_tarea'];
    //print_r($id);
    $result = $this->Tareas->getpencil($id);
    print_r(json_encode($result));

  }

  public function edit_tarea(){

    $datos=$_POST['parametros'];
    $id=$_POST['ed'];
    
    $result = $this->Tareas->update_editar($datos,$id);
    return true;
    }

    public function agregar_tarea(){

      if($_POST){
        $datos=$_POST['parametros'];

        $result = $this->Tareas->agregar_tareas($datos);
          //print_r($this->db->insert_id());
          
          if($result)
            echo $this->db->insert_id();
          else echo 0;
      }
    }

    public function baja_tarea(){
  
    $idtarea=$_POST['idtarea'];
    
    $result = $this->Tareas->eliminacion($idtarea);
    print_r($result);
  
  }

  
  
}
