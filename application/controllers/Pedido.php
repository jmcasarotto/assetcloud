<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pedido extends CI_Controller {

	function __construct(){
		
		parent::__construct();
		$this->load->model('Pedidos');
	}

	//////////////// ADMINISTRACION PEDIDOS ////////////////
	public function index($permission){

		$data['list'] = $this->Pedidos->otrabajos_List();
		$data['permission'] = $permission;
		$this->load->view('pedidos/list', $data);
	}

	public function getProveedor(){
      $response = $this->Pedidos->getProveedores();
      echo json_encode($response);
  	}

	public function getNotaPedidoId(){

	    $response = $this->Pedidos->getNotaPedidoIds($this->input->post());
	    echo json_encode($response);
  	}

  	public function ArtListPorIdNota($permission, $id_nota){
    		//echo("en cintroldor");
    		//dump_exit($id_nota);  		
      $data['list'] = $this->Pedidos->getNotaPedidoIds($id_nota);
  		$data['permission'] = $permission;
  		$this->load->view('pedidos/view_', $data);
  	}

  	public function setArtNotPedido(){
  		$response = $this->Pedidos->setArtNotPedidos($this->input->post());
  		echo json_encode($response);
  	}

  	public function setNuevoProveedor(){
  	    
  		$response = $this->Pedidos->setNuevosProveedores($this->input->post());
  		echo json_encode($response);
  	}

	
}