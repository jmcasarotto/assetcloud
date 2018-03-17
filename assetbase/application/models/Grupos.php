<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class grupos extends CI_Model
{
	function __construct()
	{
		parent::__construct();
	}
	
	function grupo_List()
	{

		$query= $this->db->get('grupo');
		
		if ($query->num_rows()!=0)
		{
			return $query->result_array();	
		}
		else
		{
			return false;
		}
	}
	
	function getgrupo($data = null)
	{
		if($data == null)
		{
			return false;
		}
		else
		{
			$action = $data['act'];
			$idgrupo = $data['id'];

			$data = array();

			//Datos de la familia
			$query= $this->db->get_where('grupo',array('id_grupo'=>$idgrupo));
			if ($query->num_rows() != 0)
			{

				$f = $query->result_array();
				$data['grupo'] = $f[0];
			} else {
				$grupo = array();
				$grupo['id_grupo'] = '';
				$grupo['descripcion'] = '';
								$data['grupo'] = $grupo;
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
	
	function setgrupo($data = null)
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
					if($this->db->insert('grupo', $data) == false) {
						return false;
					}
					break;

				case 'Edit':
					//Actualizar nombre
					if($this->db->update('grupo', $data, array('id_grupo'=>$id)) == false) {
						return false;
					}
					break;

				case 'Del':
					//Eliminar familia
					if($this->db->delete('grupo', $data, array('id_grupo'=>$id)) == false) {
						return false;
					}
					
					break;
			}

			return true;

		}
	}

}	

?>