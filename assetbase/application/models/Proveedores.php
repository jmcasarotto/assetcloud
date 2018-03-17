<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class proveedores extends CI_Model
{
	function __construct()
	{
		parent::__construct();
	}
	
	function proveedores_List()
	{

		$query= $this->db->get('abmproveedores');
		
		if ($query->num_rows()!=0)
		{
			return $query->result_array();	
		}
		else
		{
			return false;
		}
	}
	
	function getproveedores($data = null)
	{
		if($data == null)
		{
			return false;
		}
		else
		{
			$action = $data['act'];
			$idrep = $data['id'];

			$data = array();

			//Datos de la familia
			$query= $this->db->get_where('abmproveedores',array('provid'=>$idrep));
			if ($query->num_rows() != 0)
			{

				$f = $query->result_array();
				$data['proveedor'] = $f[0];
			} else {
				$proveedor = array();
				$proveedor['provnombre'] = '';
				$proveedor['provdomicilio'] = '';
				$proveedor['provmail'] = '';
				$proveedor['provtelefono'] = '';
				$proveedor['provcuit'] = '';
				$proveedor['provestado'] = '';
				$data['proveedor'] = $proveedor;
			}

			//Readonly
			$readonly = false;
			if($action == 'Del' || $action == 'View'){
				$readonly = true;
			}
			$data['read'] = $readonly;

			return $data;
		}
	}
	
	function setproveedores($data = null)
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
			$dir = $data['dir'];
			$mail = $data['mai'];
			$tel = $data['tel'];
			
			$est = $data['est'];
			
			$act = $data['act'];

			$data = array(
					   'provnombre' => $name,
					   'provcuit' => $cuit,
					   'provdomicilio' => $dir,
					   'provmail' => $mail,
					   'provtelefono' => $tel,
					   
					   'provestado' => $est



					  
					   
					);

			switch($act)
			{
				case 'Add':
					//Agregar familia
					if($this->db->insert('abmproveedores', $data) == false) {
						return false;
					}
					break;

				case 'Edit':
					//Actualizar nombre
					if($this->db->update('abmproveedores', $data, array('provid'=>$id)) == false) {
						return false;
					}
					break;

				case 'Del':
					//Eliminar familia
					if($this->db->delete('abmproveedores', $data, array('socid'=>$id)) == false) {
						return false;
					}
					
					break;
			}

			return true;

		}
	}

}	

?>