<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Contratistas extends CI_Model
{
	function __construct()
	{
		parent::__construct();
	}
	
	function contratistas_List()
	{

		$query= $this->db->get('contratistas');
		
		if ($query->num_rows()!=0)
		{
			return $query->result_array();	
		}
		else
		{
			return false;
		}
	}
	
	function getcontratistas($data = null)
	{
		if($data == null)
		{
			return false;
		}
		else
		{
			$action = $data['act'];
			$idcontratista = $data['id'];

			$data = array();

			//Datos de la familia
			$query= $this->db->get_where('contratistas',array('id_contratista'=>$idcontratista));
			if ($query->num_rows() != 0)
			{

				$f = $query->result_array();
				$data['contratista'] = $f[0];
			} else {
				$contratista = array();
				$contratista['nombre'] = '';
				$contratista['contradireccion'] = '';
				$contratista['contramail'] = '';
				$contratista['contramail1'] = '';
				$contratista['contracelular1'] = '';
				$contratista['contracelular2'] = '';
				$contratista['contratelefono'] = '';
				$contratista['contracontacto'] = '';
				$data['contratista'] = $contratista;
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
	
	function setcontratistas($data = null)
	{
		if($data == null)
		{
			return false;
		}
		else
		{
			$id = $data['id'];
			$name = $data['name'];
			$dir = $data['dir'];
			$mai1 = $data['mai'];
			$mai2 = $data['mai1'];
			$cel1 = $data['cel1'];
			$cel2 = $data['cel2'];
			$tel = $data['tel'];
			$cont = $data['cont'];
			
			$act = $data['act'];

			$data = array(
					   'nombre' => $name,
					    'contradireccion' => $dir,
					     'contramail' => $mai1,
					     'contramail1' => $mai2,
					     'contracelular1' => $cel1,
					     'contracelular2' => $cel2,
					     'contratelefono' => $tel,
					       'contracontacto' => $cont

					    
					    
					   
					);

			switch($act)
			{
				case 'Add':
					//Agregar familia
					if($this->db->insert('contratistas', $data) == false) {
						return false;
					}
					break;

				case 'Edit':
					//Actualizar nombre
					if($this->db->update('contratistas', $data, array('id_cobrador'=>$id)) == false) {
						return false;
					}
					break;

				case 'Del':
					//Eliminar familia
					if($this->db->delete('contratistas', $data, array('id_cobrador'=>$id)) == false) {
						return false;
					}
					
					break;
			}

			return true;

		}
	}

	function eliminacion($data)
    {
       	$this->db->where('id_contratista', $data);
		$query =$this->db->delete('contratistas');
        return $query;
    }

    function getpencil($id){

		$query= $this->db->get_where('contratistas',array('id_contratista'=>$id));
		if($query->num_rows()>0){
            return $query->result();
        }
        else{
            return false;
        }
	}


  	function update_editar($data, $id){
  		
        $this->db->where('id_contratista', $id);
        $query = $this->db->update("contratistas",$data);
        return $query;
    }

}	

?>