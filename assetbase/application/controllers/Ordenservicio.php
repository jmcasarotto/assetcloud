<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Ordenservicio extends CI_Controller {

    public function __construct(){
        parent::__construct();
        $this->load->model('Ordenservicios');
    }

    public function index($permission){
      	$data['permission'] = $permission;		// envia permisos
      	$data['list'] = $this->Ordenservicios->getOrdServiciosList();
        $this->load->view('ordenservicios/list',$data);
    }
    // FUNCION ANTERIOR - EN DESUSO
      // public function cargarOrden($permission, $id_sol = null, $id_eq = null){ 
      //     $data['permission'] = $permission;    // envia permisos 
      //     $data['id_solicitud'] = $id_sol;
      //     $data['id_eq'] = $id_eq;
          
      //     $this->load->view('ordenservicios/view_',$data);
      // }

    public function cargarOrden($permission, $id_sol = null, $id_eq = null, $causa = null){ 
        $data['permission'] = $permission;    // envia permisos 
        $data['id_solicitud'] = $id_sol;      // id de O.T. 
        $data['id_eq'] = $id_eq;              // id de equipo
        $data['causa'] = $causa;              // motivo de la O.T.
        
        $this->load->view('ordenservicios/view_',$data);
    }


    public function getsolicitud(){

      $response = $this->Ordenservicios->getsolicitudes($this->input->post());
      echo json_encode($response);
    }

    public function getSolEquipCausa(){
      $response = $this->Ordenservicios->getSolEquipCausas($this->input->post());
      echo json_encode($response);
    }

    public function getEquipo (){
      $response = $this->Ordenservicios->getEquipos($this->input->post());
      echo json_encode($response);
    }

    public function getContratista (){
      $response = $this->Ordenservicios->getContratistas($this->input->post());
      echo json_encode($response);
    }

    public function getArticulo (){
      $response = $this->Ordenservicios->getArticulos($this->input->post());
      echo json_encode($response);
    }

    public function getInsumOrden(){
      $response = $this->Ordenservicios->getInsumOrdenes($this->input->post());
      echo json_encode($response);
    }

    public function getLoteActivo(){
      
      $data = $this->input->post();     
      $response = $this->Ordenservicios->getLotesActivos($this->input->post());
      echo json_encode($response);      
    }

    public function getDeposito(){
      $response = $this->Ordenservicios->getDepositos($this->input->post());
      echo json_encode($response);
    }

    public function getHerramienta(){
      $response = $this->Ordenservicios->getHerramientas($this->input->post());
      echo json_encode($response);
    }

    public function getHerramOrden(){
      $response = $this->Ordenservicios->getHerramOrdenes($this->input->post());
      echo json_encode($response);
    }

    public function getTarea(){
      $response = $this->Ordenservicios->getTareas($this->input->post());
      echo json_encode($response);
    }

    public function getTareaOrden(){
      $response = $this->Ordenservicios->getTareasOrden($this->input->post());
      echo json_encode($response);
    }

    public function getComponente(){

      $response = $this->Ordenservicios->getComponentes($this->input->post());
      if($response){
        $arre['datos'] = $response;
        print_r(json_encode($arre)) ;
      }else{
        echo "sin datos";
      }
    }

    public function getOperario(){
      $response = $this->Ordenservicios->getOperarios($this->input->post());
      echo json_encode($response);
    }

    public function getOperarioOrden(){
      $response = $this->Ordenservicios->getOperariosOrden($this->input->post());
      echo json_encode($response);
    }

    public function getSolServicioList(){
      $response = $this->Ordenservicios->getSolServiciosList($this->input->post());
      echo json_encode($response);
    }

    public function setEstado(){
      $data = $this->input->post();
      $response = $this->Ordenservicios->setEstados($data);
      echo json_encode($response);  
    }

    public function setOrdenServ(){
      $data = $this->input->post();
      $response = $this->Ordenservicios->setOrdenServicios($data);
      echo json_encode($response);
    }

    /*public function getsolImp(){  

      $id=$_POST['id_orden'];
      $result = $this->Ordenservicios->getsolImps($id);

      if($result){ 
        $arre['datos']=$result; 
        print_r(json_encode($arre));  
      }
      else echo "nada";
      //return json_encode($arre);
    }*/

    public function getsolImp(){  

      $id=$_POST['id_orden'];
      $result = $this->Ordenservicios->getsolImps($id);

      if($result){ 
        
        $arre['datos']=$result;
        $equipos = $this->Ordenservicios->getequiposBycomodato($id);
        
        if($equipos)
        {
          $arre['equipos']=$equipos;
        }
        else $arre['equipos']=0;


        echo json_encode($arre);
      }
      else echo "nada";


  }
  
  
}