<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Users extends CI_Model
{
	function __construct()
	{
		parent::__construct();
	}

	function User_List()
	{
		$query= $this->db->get('sisusers');
		//var_dump($query);
		if ($query->num_rows()!=0) {
			return $query->result_array();
		} else {
			return false;
		}
	}

	function getUser($data = null)
	{
		if($data == null) {
			return false;
		} else {
			$action = $data['act'];
			$idUsr = $data['id'];
			$data = array();

			//Datos del usuario
			$query= $this->db->get_where('sisusers',array('usrId'=>$idUsr));
			if ($query->num_rows() != 0) {
				$u = $query->result_array();
				$data['user'] = $u[0];
			} else {
				$user = array();
				$user['usrNick'] = '';
				$user['usrName'] = '';
				$user['usrLastName'] = '';
				$user['usrComision'] = '';
				$user['usrPassword'] = '';
				$user['grpId'] = 1;
				$user['usrimag'] = '';

				$data['user'] = $user;
			}

			//Readonly
			$readonly = false;
			if($action == 'Del' || $action == 'View'){
				$readonly = true;
			}
			$data['read'] = $readonly;

			//Grupos
			$query= $this->db->get('sisgroups');
			if ($query->num_rows() != 0) {
				$data['groups'] = $query->result_array();
			}

			return $data;
		}
	}

	function setUser($data = null)
	{
		print_r( $data );

		if($data == null) {
			return false;
		} else {
			$id   = $data['id'];
			$act  = $data['act'];
			$usr  = $data['usrNick'];
			$name = $data['usrName'];
			$lnam = $data['usrLastName'];
			$com  = $data['usrComision'];
			$pas  = $data['usrPassword'];
			$grp  = $data['grpId'];
			$img  = $data['usrimag'];

			if($act == 'Edit') {
				if($pas == '') {
					//No modificar la contraseña
					$data = array(
					   'usrNick'     => $usr,
					   'usrName'     => $name,
					   'usrLastName' => $lnam,
					   'usrComision' => $com,
					   'grpId'       => $grp,
					   'usrimag'    => $img
					);
				} else {
					//Modificar la contraseña
					$data = array(
					   'usrNick'     => $usr,
					   'usrName'     => $name,
					   'usrLastName' => $lnam,
					   'usrComision' => $com,
					   'usrPassword' => md5($pas),
					   'grpId'       => $grp,
					   'usrimag'    => $img
					);
				}
			} else {
				$data = array(
					   'usrNick'     => $usr,
					   'usrName'     => $name,
					   'usrLastName' => $lnam,
					   'usrComision' => $com,
					   'usrPassword' => md5($pas),
					   'grpId'       => $grp,
					   'usrimag'    => $img
					);
			}

			switch($act){
				case 'Add':
					//Agregar Usuario
					if($this->db->insert('sisusers', $data) == false) {
						return false;
					}else{
						return true;
					}
					break;

				 case 'Edit':
				 	//Actualizar usuario
				 	if($this->db->update('sisusers', $data, array('usrId'=>$id)) == false) {
				 		return false;
				 	}
				 	break;

				 case 'Del':
				 	//Eliminar usuario
				 	if($this->db->delete('sisusers', array('usrId'=>$id)) == false) {
				 		return false;
				 	}
				 	break;
			}

			return true;

		}
	}

	function sessionStart_($data = null){
		if($data == null)
		{
			return false;
		}
		else
		{
			$usr = $data['usr'];
			$pas = md5($data['pas']);

			$data = array(
					'usrNick' => $usr,
					'usrPassword' => $pas
				);

			$query= $this->db->get_where('sisusers',$data);
			if ($query->num_rows() != 0)
			{
				$this->session->set_userdata('user_data', $query->result_array());
				return true;
			} else {
				return false;
			}

		}
	}

    public function addUser($datos)
    {
        $this->db->insert('sisusers',$datos);
        $lastid = $this->db->insert_id();
        return $lastid;
    }
}
?>