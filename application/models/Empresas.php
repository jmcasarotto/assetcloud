<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Empresas extends CI_Model
{
	function __construct()
	{
		parent::__construct();
	}

	function Empresas_List()
	{
		$query= $this->db->get('empresas');

		if ($query->num_rows()!=0)
		{
			return $query->result_array();
		}
		else
		{
			return false;
		}
	}

	function getEmpresa($data = null)
	{
		if($data == null)
		{
			return false;
		}
		else
		{
			$action = $data['act'];
			$idemp = $data['id'];

			$data = array();
			//dump_exit($data);
			//Datos de la familia
			$query= $this->db->get_where('empresas',array('id_empresa'=>$idemp));
			if ($query->num_rows() != 0)
			{
				$f = $query->result_array();
				$data['empresa'] = $f[0];
			} else {
				$Empresa = array();
				$Empresa['id_empresa'] = '';
				$Empresa['descripcion'] = '';
				$Empresa['empcuit'] = '';
				$Empresa['empdir'] = '';
				$Empresa['emptelefono'] = '';
				$Empresa['empcelular'] = '';
				$Empresa['empemail'] = '';
				$data['empresa'] = $Empresa;
			}

			//Readonly
			$readonly = false;
			if($action == 'Del' || $action == 'View'){
				$readonly = true;
			}
			$data['read'] = $readonly;

			//Zonas
			$query= $this->db->get('confzone');
			if ($query->num_rows() != 0)
			{
				$data['zone'] = $query->result_array();
			}

			return $data;
		}
	}

	function setEmpresa($data = null)
	{
		if($data == null)
		{
			return false;
		}
		else
		{
			$id = $data['id'];
			$name = $data['name'];
			$cuit = $data['cuit'];
			$dir = $data['dom'];
			$mail = $data['mail'];
			$tel = $data['tel'];
			$mov = $data['movil'];
			$zon = $data['zona'];

			$act = $data['act'];

			$data = array(
					   'descripcion' => $name,
					   'empcuit' => $cuit,
					   'empdir' => $dir,
					   'empemail' => $mail,
					   'emptelefono' => $tel,
					  'empcelular' => $mov,
 					   'zonaId' => $zon





					);

			switch($act)
			{
				case 'Add':
					//Agregar familia
					if($this->db->insert('empresas', $data) == false) {
						return false;
					}
					break;

				case 'Edit':
					//Actualizar nombre
					if($this->db->update('empresas', $data, array('id_empresa'=>$id)) == false) {
						return false;
					}
					break;

				case 'Del':
					//Eliminar familia
					if($this->db->delete('empresas', $data, array('id_empresa'=>$id)) == false) {
						return false;
					}

					break;
			}

			return true;

		}
	}


	function eliminacion($data)
    {
       	$this->db->where('id_empresa', $data);
		$query =$this->db->delete('empresas');
        return $query;
    }

    public function addEmpresa($empresa)
    {
        $this->db->insert('empresas',$empresa);
        $lastid = $this->db->insert_id();
        return $lastid;
    }

}

?>