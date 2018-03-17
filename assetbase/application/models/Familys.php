<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Familys extends CI_Model
{
	function __construct()
	{
		parent::__construct();
	}
	
	function Family_List(){

		$query= $this->db->get('conffamily');
		
		if ($query->num_rows()!=0)
		{
			return $query->result_array();	
		}
		else
		{
			return false;
		}
	}
	
	function getFamily($data = null){
		if($data == null)
		{
			return false;
		}
		else
		{
			$action = $data['act'];
			$idFamily = $data['id'];

			$data = array();

			//Datos de la familia
			$query= $this->db->get_where('conffamily',array('famId'=>$idFamily));
			if ($query->num_rows() != 0)
			{
				$f = $query->result_array();
				$data['family'] = $f[0];
			} else {
				$family = array();
				$family['famName'] = '';
				$data['family'] = $family;
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
	
	function setFamily($data = null){
		if($data == null)
		{
			return false;
		}
		else
		{
			$id = $data['id'];
			$act = $data['act'];
			$name = $data['name'];

			$data = array(
					   'famName' => $name
					);

			switch($act){
				case 'Add':
					//Agregar familia
					if($this->db->insert('conffamily', $data) == false) {
						return false;
					}
					break;

				case 'Edit':
					//Actualizar nombre
					if($this->db->update('conffamily', $data, array('famId'=>$id)) == false) {
						return false;
					}
					break;

				case 'Del':
					//Eliminar familia
					if($this->db->delete('conffamily', $data, array('famId'=>$id)) == false) {
						return false;
					}
					
					break;
			}

			return true;

		}
	}

	function FamilySF_List(){

		$this->db->select('*');
		$this->db->from('confsubfamily');
		$this->db->join('conffamily', 'conffamily.famId = confsubfamily.famId');

		$query = $this->db->get();
		
		if ($query->num_rows()!=0)
		{
			return $query->result_array();	
		}
		else
		{
			return false;
		}
	}

	function getSFFamily($data = null){
		if($data == null)
		{
			return false;
		}
		else
		{
			$action = $data['act'];
			$idSFFamily = $data['id'];

			$data = array();

			//Datos de la familia
			$query= $this->db->get_where('confsubfamily',array('sfamId'=>$idSFFamily));
			if ($query->num_rows() != 0)
			{
				$f = $query->result_array();
				$data['sfamily'] = $f[0];
			} else {
				$family = array();
				$family['sfamName'] = '';
				$family['famId'] = '';
				$data['sfamily'] = $family;
			}

			//Readonly
			$readonly = false;
			if($action == 'Del' || $action == 'View'){
				$readonly = true;
			}
			$data['read'] = $readonly;

			//Familias
			$query= $this->db->get('conffamily');
			if ($query->num_rows() != 0)
			{
				$data['familys'] = $query->result_array();	
			}

			return $data;
		}
	}

	function setSFFamily($data = null){
		if($data == null)
		{
			return false;
		}
		else
		{
			$id = $data['id'];
			$act = $data['act'];
			$name = $data['name'];
			$famId = $data['famId'];

			$data = array(
					   'sfamName' => $name,
					   'famId'	=> $famId
					);

			switch($act)
			{
				case 'Add':
					//Agregar sub-familia
					if($this->db->insert('confsubfamily', $data) == false) {
						return false;
					}
					break;

				case 'Edit':
					//Actualizar nombre
					if($this->db->update('confsubfamily', $data, array('sfamId'=>$id)) == false) {
						return false;
					}
					break;

				case 'Del':
					//Eliminar sub-familia
					if($this->db->delete('confsubfamily', $data, array('sfamId'=>$id)) == false) {
						return false;
					}
					
					break;
			}

			return true;

		}
	}
}
?>