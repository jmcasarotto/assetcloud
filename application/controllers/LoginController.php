<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class LoginController extends CI_Controller {

    function __construct()
    {
        parent::__construct();
        $this->load->model('Users');
        $this->load->model('Clientes');
        $this->load->model('Empresas');
        $this->load->model('UsuarioEmpresa');
        $this->load->model('Paises');
        $this->load->model('Ciudades');
        $this->load->library('email');
        $this->load->library('form_validation');
    }
    public function ciudades($codigo_pais)
    {
        $ciudades = $this->Ciudades->getCiudades($codigo_pais);

        if(isset($ciudades))
        {
            foreach ($ciudades as $s) {
                print "<option value=".$s['idCiudades'].">".$s['Ciudad']."</option>";
            }
        }else{
                print "<option value=''>No hay datos</option>";
        }

    }

    public function index()
    {
        $this->load->helper('form');
        $this->load->view('header');
        $paises['paises'] = $this->Paises->getPaises();
        $this->load->view('registro/registrarse',$paises);
    }

    public function store()
    {
        $config['upload_path'] = './uploads/';
        $config['allowed_types'] = 'gif|jpg|png|jpeg';
        $config['max_size']    = '10000';
        $config['overwrite'] = TRUE;
        $config['remove_spaces'] = TRUE;
        $config['encrypt_name'] = TRUE;
        $this->load->library('upload', $config);
        $this->upload->do_upload('logo');

        if(!$this->upload->do_upload())
        {
            $data_upload_files = $this->upload->data();
            $image_minsize = $this->_create_thumbnail($data_upload_files['file_name']);
            $image = $image_minsize['upload_path'];
            $image_path = $this->upload->data($image);

            $user = array(
                'usrNick' => $this->input->post('email'),
                'usrName' => $this->input->post('usrname'),
                'usrLastName' => $this->input->post('usrLastName'),
                'usrPassword' => md5($this->input->post('password')),
                'grpId' => 1,
            );

            $datos = array(
                'clientrazonsocial' => $this->input->post('razonsocial'),
                'clientdireccion' => $this->input->post('direccion'),
                'clientmail' => $this->input->post('email'),
                'clienttelefono' => $this->input->post('telefonofijo'),
                'clientetelefono1' => $this->input->post('celular'),
                'localidadid' => $this->input->post('localidad'),
                'paisid' => $this->input->post('pais'),
                'provinciaid' => $this->input->post('provincia'),
            );

            $usuarioid = $this->Users->addUser($user);
            $clienteid = $this->Clientes->addCliente($datos);

            $datosEmpresa = array(
                'descripcion' => $this->input->post('descripcion'),
                'empcuit' => $this->input->post('cuit'),
                'empdir' => $this->input->post('direccionempresa'),
                'emptelefono' => $this->input->post('telefonoempresa'),
                'empemail' => $this->input->post('emailempresa'),
                'empcelular' => $this->input->post('celularempresa'),
                'localidadid' => $this->input->post('localidadempresa'),
                'paisid' => $this->input->post('paisempresa'),
                'provinciaid' => $this->input->post('provinciaempresa'),
                'gps' => $this->input->post('gps'),
                'zonaId' => 1,
                'emlogo'=> $image_path['full_path'],
                'clienteid' => $clienteid
            );

            $empresaid = $this->Empresas->addEmpresa($datosEmpresa);
            $this->UsuarioEmpresa->addUsuarioEmpresa($usuarioid, $empresaid);
        }

    }
    function _create_thumbnail($filename){
        $config['image_library'] = 'gd2';
        //CARPETA EN LA QUE ESTÁ LA IMAGEN A REDIMENSIONAR
        $config['source_image'] = 'uploads/'.$filename;
        $config['create_thumb'] = TRUE;
        $config['maintain_ratio'] = TRUE;
        //CARPETA EN LA QUE GUARDAMOS LA MINIATURA
        $config['new_image']='uploads/thumbs/';
        $config['width'] = 150;
        $config['height'] = 150;
        $this->load->library('image_lib', $config);
        $imagen = $this->image_lib->resize();
        return $imagen;
    }
}