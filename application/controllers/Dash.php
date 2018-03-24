<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class dash extends CI_Controller {
	private $items;

	function __construct()
    {
		parent::__construct();
		$this->load->model('Groups');
		$this->load->model('Customers');
		$this->load->model('Calendar');

		$this->_init_Menu();	// Inicializa el menu
		//$this->output->enable_profiler(true);
	}

	/**
	 * Inicializa el Menú: carga la librería y el modelo e inicializa el menu.
	 *
	 * @return	void
	 */
	private function _init_Menu() {
		// Ejecuta la consulta y obtiene el arreglo de datos
		$items = $this->Groups->mnuAll();
		//dump_exit($items);
		//agrego los permisos de ejecucion al menu
		$this->items = $this->addPermisosItemsMenu($items);
		//dump_exit($this->items);
		// Carga la librería y pasa el arreglo de datos
		$this->load->library("multi_menu");
		$this->multi_menu->set_items($this->items);
	}

	public function index()
	{
		$this->load->view('header');
		$userdata = $this->session->userdata('user_data');

		if( !$userdata )
		{
			redirect( base_url() );
		}
		else
		{
			$data['usrimag']    = $userdata[0]['usrimag'];
			$data['userName']   = $userdata[0]['usrNick'];
			$data['grpId']      = $userdata[0]['grpId'];
			//para el dash x defecto segun grupo de usr
			$data['grpDash']    = $this->Groups->grpDash($userdata[0]['grpId']);
			//$data['permission'] = $this->items['seguridad'];

			$this->load->view('dash', $data);
			$this->load->view('menu');
			$this->load->view('content');
			$this->load->view('footerdash');
			$this->load->view('footer');
		}
	}

	/**
	 * agrega los permisos de ejecucion a los items del menu.
	 *
	 * @param 	array 	$items 	Todos los elementos del menu sin permisos.
	 * @return 	array 			Todos los elementos del menu con permisos.
	 */
	public function addPermisosItemsMenu($items)
	{
		$this->items = $items;
		//dump_exit($this->items);
		foreach ($this->items as &$value) {
			/*echo '<pre>';
			print_r($value);
			echo '</pre>';*/
			$fn = $this->Groups->mnuPermisos($value['id'], $value['grpId']);
			$n = 0;
			$permissions = "";
			//con foreach da error
			/*foreach ($fn as $item) {
				$permissions .= $item['actDescription']."-";
				$n++;
			}*/
			for($i=0; $i<sizeof($fn); $i++) {
				$permissions .= $fn[$i]['actDescription']."-";
			}
			$value['seguridad'] = $permissions;
		}

		return $this->items;
	}

    public function calendar()
    {
        $this->load->model('Preventivos');
        $data['list'] = $this->Preventivos->getPreventivosPorHora();
        $data['permission'] = $permission;
        $this->load->view('calendar/calendar', $data);
    }

    public function disponibilidad() {
    	$datos = $_POST['parametros'];
    	//dump_exit($datos["fechaInicio"]);
    	$disponibilidad = calcularDisponibilidad($datos["idEquipo"], $datos["fechaInicio"], $datos["fechaFin"]);
    	$tiempo       = json_encode( array_values($disponibilidad["tiempo"]) );
    	$hsOperativas = json_encode( array_values($disponibilidad["porcentajeHorasOperativas"]) );

    	$disponibilidad = '{ "tiempo": '.$tiempo.', "porcentajeHorasOperativas" : '.$hsOperativas.'}';

    	//dump_exit( $disponibilidad );
    	echo $disponibilidad;
    }
}
