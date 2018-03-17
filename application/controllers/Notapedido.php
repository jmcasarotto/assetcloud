<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Notapedido extends CI_Controller {

	function __construct(){

		parent::__construct();
		$this->load->model('Notapedidos');
	}

  public function index($permission){
    $data['list'] = $this->Notapedidos->notaPedidos_List();
    $data['permission'] = $permission;
    $this->load->view('notapedido/list',$data);
    //$this->load->view('notapedido/view_');
  }

  public function agregarNota($permission){
    //$data['list'] = $this->Notapedidos->notaPedidos_List();
    $data['permission'] = $permission;
    $this->load->view('notapedido/view_',$data);
    //$this->load->view('notapedido/view_');
  }

  public function getOrdenesCursos(){
    $response = $this->Notapedidos->getOrdenesCursos();
    echo json_encode($response);
  }

  public function getDetalle(){
    $response = $this->Notapedidos->getDetalles($this->input->post());
    echo json_encode($response);
  }

  public function getArticulo (){
    $response = $this->Notapedidos->getArticulos($this->input->post());
    echo json_encode($response);
  }

  public function getProveedor(){
      $response = $this->Notapedidos->getProveedores();
      echo json_encode($response);
  }

  public function getNotaPedidoId(){
    $response = $this->Notapedidos->getNotaPedidoIds($this->input->post());
    echo json_encode($response);
  }

  public function setNotaPedido(){
    $response = $this->Notapedidos->setNotaPedidos($this->input->post());
    echo json_encode($response);
  }
  

}

