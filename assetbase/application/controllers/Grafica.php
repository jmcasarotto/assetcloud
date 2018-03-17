<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Grafica extends CI_Controller {
    function __construct()
    {
        parent::__construct();
        $this->load->model('Graficas');
    }

    public function index()
    {
        $this->load->view('graficas/list');
    }

    public function getEquipos()
    {
        $response = $this->Graficas->getEquipo();
        echo json_encode($response);
    }

    public function getParametros()
    {
        $response = $this->Graficas->getParametroEquipos( $this->input->post() );
        print_r( json_encode($response) );
    }

    public function getValoresParametro()
    {
        $response = $this->Graficas->getValorParametros( $this->input->post() );
        print_r( json_encode($response) );
    }

}