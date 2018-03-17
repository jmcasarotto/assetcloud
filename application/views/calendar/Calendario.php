<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Calendario extends CI_Controller {

	function __construct()
        {
		parent::__construct();
		$this->load->model('Calendarios');
	}



	

public function index($permission)
	{
		
		$data['list'] = $this->Calendarios->getPreventivosPorHora();
		$data['permission'] = $permission;
		$this->load->view('calendar/calendar', $data);

		
		
	}


	public function indexot($permission)
	{
		
		$this->load->view('calendar/calendar1', $data);
	}
	
	
public function setot(){
	$dato = $this->input->post();
	
		$data = $this->Calendarios->setVisit($this->input->post());
		
		 if($data  == false)
		 {
			echo json_encode(false);

		 }
		 else
		 {
		 	echo json_encode($data);
		 }
	}

	

	public function getPreventivo(){
		$data = $this->Calendarios->getPreventivos($this->input->post());
		if($data  == false)
		{
			echo json_encode(false);
		}
		else
		{
			echo json_encode($data);	
		}
	}


	public function getcalendarot(){
		$data = $this->Calendarios->getot($this->input->post());
		if($data  == false)
		{
			echo json_encode(false);
		}
		else
		{
			echo json_encode($data);	
		}
	}
	public function getcalendarpred(){
		$data = $this->Calendarios->getot($this->input->post());
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