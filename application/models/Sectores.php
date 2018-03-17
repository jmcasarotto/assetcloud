<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class sectores extends CI_Model
{
	function __construct()
	{
		parent::__construct();
	}
	
	function grupo_List()
	{

		$query= $this->db->get('sector');
		
		if ($query->num_rows()!=0)
		{
			return $query->result_array();	
		}
		else
		{
			return false;
		}
	}
	
	function getsectores($data = null)
	{
		if($data == null)
		{
			return false;
		}
		else
		{
			$action = $data['act'];
			$idsector = $data['id'];

			$data = array();

			//Datos de la familia
			$query= $this->db->get_where('sector',array('id_sector'=>$idsector));
			if ($query->num_rows() != 0)
			{

				$f = $query->result_array();
				$data['sector'] = $f[0];
			} else {
				$sector = array();
				$sector['id_sector'] = '';
				$sector['descripcion'] = '';
				$data['sector'] = $sector;
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
	
	function setsectores($data = null)
	{
		if($data == null)
		{
			return false;
		}
		else
		{
			$id = $data['id'];
			$name = $data['name'];
			
			
			$act = $data['act'];

			$data = array(
					   'descripcion' => $name,
					    
					   
					);

			switch($act)
			{
				case 'Add':
					//Agregar familia
					if($this->db->insert('sector', $data) == false) {
						return false;
					}
					break;

				case 'Edit':
					//Actualizar nombre
					if($this->db->update('sector', $data, array('id_sector'=>$id)) == false) {
						return false;
					}
					break;

				case 'Del':
					//Eliminar familia
					if($this->db->delete('sector', $data, array('id_sector'=>$id)) == false) {
						return false;
					}
					
					break;
			}

			return true;

		}
	}

}	

?>