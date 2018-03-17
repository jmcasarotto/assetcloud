<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Article extends CI_Controller {

	function __construct() 
        {
		parent::__construct();
		$this->load->model('Articles');
		//$this->Users->updateSession(true);
	}

	public function index($permission)
	{
		$data['list'] = $this->Articles->Articles_List();
		$data['permission'] = $permission;
		//echo json_encode($this->load->view('articles/list', $data, true));
		$this->load->view('articles/list', $data);
	}
	
	public function getArticle(){
		$data['data'] = $this->Articles->getArticle($this->input->post());
		$response['html'] = $this->load->view('articles/view_', $data, true);

		echo json_encode($response);
	}
	
	public function setArticle(){
		$data = $this->Articles->setArticle($this->input->post());
		if($data  == false)
		{
			echo json_encode(false);
		}
		else
		{
			echo json_encode(true);	
		}
	}


	public function getdatosart(){
		
		$art = $this->Articles->getdatosarts();
		//echo json_encode($Customers);

		if($art)
		{	
			$arre=array();
	        foreach ($art as $row ) 
	        {   
	           $arre[]=$row;
	        }
			echo json_encode($arre);
		}
		else echo "nada";
	}

	
	public function getdatosfam(){
		
		$art = $this->Articles->getdatosfams();
		//echo json_encode($Customers);

		if($art)
		{	
			$arre=array();
	        foreach ($art as $row ) 
	        {   
	           $arre[]=$row;
	        }
			echo json_encode($arre);
		}
		else echo "nada";
	}

	public function baja_articulo(){
	
		$idarticulo=$_POST['idelim'];
		
		$datos = array('artEstado'=>"AN");
		
		$result = $this->Articles->update_articulo($datos, $idarticulo);
		print_r($result);
	
	}
	public function getpencil(){

		$id=$_POST['idartic'];
		$result = $this->Articles->getpencil($id);
		print_r(json_encode($result));

	}

	public function editar_art(){
		
		$datos=$_POST['data'];
		$id=$_POST['ida'];

		$result = $this->Articles->update_editar($datos,$id);
		print_r(json_encode($result));
		
	}

	public function searchByCode() {
		$data = $this->Articles->searchByCode($this->input->post());
		if($data  == false)
		{
			echo json_encode(false);
		}
		else
		{
			echo json_encode($data);	
		}
	} 

	public function searchByAll() {
		$data = $this->Articles->searchByAll($this->input->post());
		if($data  == false)
		{
			echo json_encode(false);
		}
		else
		{
			echo json_encode($data);	
		}
	}
}