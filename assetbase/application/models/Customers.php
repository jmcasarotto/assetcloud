<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Customers extends CI_Model
{
	function __construct()
	{
		parent::__construct();
	}
	
	function Customers_List(){

		$this->db->order_by('cliLastName','asc');
		$this->db->order_by('cliName','asc');
		$query= $this->db->get('admcustomers');
		
		if ($query->num_rows()!=0)
		{
			return $query->result_array();	
		}
		else
		{
			return false;
		}
	}

	function Equipos_List(){

		$this->db->order_by('codigo','asc');
		$this->db->order_by('descripcion','asc');
		$query= $this->db->get('equipos');
		
		if ($query->num_rows()!=0)
		{
			return $query->result_array();	
		}
		else
		{
			return false;
		}
	}
	
	function getCustomer($data = null){
		if($data == null)
		{
			return false;
		}
		else
		{
			$action = $data['act'];
			$id_solicitud = $data['id'];

			$data = array();

			//Datos de la familia
			$query= $this->db->get_where('solicitud_reparacion',array('id_solicitud'=>$idorden));
			if ($query->num_rows() != 0)
			{

				$f = $query->result_array();
				$data['solicitud'] = $f[0];
			} else {
				$servicio = array();
				$servicio['causa'] = '';
				$servicio['fsolicitado'] = '';
				$servicio['f_sugerido'] = '';
				$servicio['hora_sug'] = '';
				$servicio['causa'] = '';
				$data['servicio'] = $servicio;
			}

			//Readonly
			$readonly = false;
			if($action == 'Del' || $action == 'View'){
				$readonly = true;
			}
			$data['read'] = $readonly;

			

			//Zonas
			$query= $this->db->get('equipos');
			if ($query->num_rows() != 0)
			{
				$data['equipos'] = $query->result_array();	
			}

		}
	}
	
	function setCustomer($data = null){
		if($data == null)
		{
			return false;
		}
		else
		{
			$id = $data['id'];
			$act = $data['act'];
			$nro = $data['nro'];
			$name = $data['name'];
			$lnam = $data['lnam'];
			$dni = $data['dni'];
			$mail = $data['mail'];
			$fech = explode('-', $data['fech']);
			$fech = $fech[2].'-'.$fech[1].'-'.$fech[0];
			$dom = $data['dom'];
			$tel = $data['tel'];
			$movil = $data['movil'];
			$zona = $data['zona'];
			$img = $data['img'];
			$update = $data['update'];
			$preferences = $data['pref'];
			$day = $data['days'];
			$color = $data['color'];


			$data = array(
				   'cliDni' => $dni,
				   'cliName' => $name,
				   'cliLastName' => $lnam,
				   'cliDateOfBirth' => $fech,
				   'cliNroCustomer' => $nro,
				   'cliAddress' => $dom,
				   'cliPhone' => $tel,
				   'cliMovil' => $movil,
				   'cliEmail' => $mail,
				   'zonaId' => $zona,
				   'cliDay' => $day,
				   'cliColor' => $color
				);

			switch($act){
				case 'Add':
					//Agregar Usuario 
					if($this->db->insert('admcustomers', $data) == false) {
						return false;
					} else {
						$id = $this->db->insert_id();

						$img = str_replace('data:image/png;base64,', '', $img);
						$img = str_replace(' ', '+', $img);
						$data = base64_decode($img);
						file_put_contents('assets/img/customers/'.$id.'.png', $data);

						$data = array(
								'cliImagePath' => $id.'.png'
							);
						if($this->db->update('admcustomers', $data, array('cliId'=>$id)) == false) {
				 		return false;
				 		}

				 		//Agregar preferencias
				 		if(count($preferences) > 0) {
					 		foreach ($preferences as $p) {
					 			if($p != 0) {
									$data = array(
									   'sfamId' => $p,
									   'cliId' => $id
									);
									if($this->db->insert('admcustomerpreferences', $data) == false) {
										return false;
									}
								}
							}
						}

					}
					break;

				 case 'Edit':
				 	//Actualizar usuario
				 	if($this->db->update('admcustomers', $data, array('cliId'=>$id)) == false) {
				 		return false;
				 	}

				 	if($update == true) {
					 	$img = str_replace('data:image/png;base64,', '', $img);
						$img = str_replace(' ', '+', $img);
						$data = base64_decode($img);
						file_put_contents('assets/img/customers/'.$id.'.png', $data);

						$data = array(
									'cliImagePath' => $id.'.png'
								);
							if($this->db->update('admcustomers', $data, array('cliId'=>$id)) == false) {
					 		return false;
					 		}
				 	}

					//Eliminar preferencias
					if($this->db->delete('admcustomerpreferences', array('cliId' => $id)) == false) {
						return false;
					}

					//Agregar preferencias
					if(count($preferences) > 0) {
				 		foreach ($preferences as $p) {
				 			if($p != 0) {
								$data = array(
								   'sfamId' => $p,
								   'cliId' => $id
								);
								if($this->db->insert('admcustomerpreferences', $data) == false) {
									return false;
								}
							}
						}
					}
				 	break;

				 case 'Del':
				 	//Eliminar preferencias
					if($this->db->delete('admcustomerpreferences', array('cliId' => $id)) == false) {
						return false;
					}

				 	//Eliminar usuario
				 	if($this->db->delete('admcustomers', array('cliId'=>$id)) == false) {
				 		return false;
				 	}
				 	break;
			}
			return true;

		}
	}

	function visits($data = null){
		if($data == null)
		{
			return false;
		}
		else
		{
			$month = $data['month'] + 1;
			$this->db->select('solicitud_reparacion.*, equipos.codigo, equipos.descripcion');
			$this->db->from('solicitud_reparacion');
			$this->db->join('equipos', 'equipos.id_equipo = solicitud_reparacion.id_equipo');
			$this->db->where('solicitud_reparacion.estado','C'); // Set Filter		
			$this->db->where('month(solicitud_reparacion.f_sugerido)', $month);			

			$query= $this->db->get();
			
			if ($query->num_rows()!=0)
			{
				return $query->result_array();	
			}
			else
			{
				return false;
			}
		}
	}

	function getPreventivos($data = null){
		
		if($data == null)
		{
			return false;
		}
		else
		{
			$month = $data['month'] + 1;			
			//echo "mes en el modelo: ";
			//echo $month;
			// $this->db->select('preventivo.prevId,
			// 					preventivo.id_tarea,
			// 					preventivo.perido,
			// 					preventivo.cantidad,
			// 					preventivo.ultimo,
			// 					equipos.id_equipo,
			// 					preventivo.id_equipo,
			// 					tareas.descripcion								
			// 					');
			// $this->db->from('preventivo');
			// $this->db->join('equipos', 'preventivo.id_equipo = equipos.id_equipo');
			// $this->db->join('tareas', 'preventivo.id_tarea = tareas.id_tarea');	
			// //$this->db->where('preventivo.estadoprev','C'); 		
			// //$this->db->where('month(preventivo.ultimo)', $month);

			// $this->db->where('month('DATE_ADD(preventivo.ultimo, INTERVAL 60 DAY )')', '6', TRUE);

			$sql= "select preventivo.prevId, 
					preventivo.id_tarea, 
					preventivo.perido, 
					preventivo.cantidad, 
					preventivo.ultimo, 
					equipos.id_equipo, 
					preventivo.id_equipo, 
					tareas.descripcion,
					equipos.codigo, 
					DATE_ADD(preventivo.ultimo, INTERVAL preventivo.cantidad DAY) AS prox 
					from preventivo 
					join equipos ON preventivo.id_equipo = equipos.id_equipo 
					join tareas ON preventivo.id_tarea = tareas.id_tarea 
					where preventivo.estadoprev = 'C' 
					AND month(DATE_ADD(preventivo.ultimo, INTERVAL preventivo.cantidad DAY)) = $month ";
			
			$query= $this->db->query($sql);
			
			if ($query->num_rows()!=0)
			{
				return $query->result_array();	
			}
			else
			{
				return false;
			}
		}

	}

	function status($data = null){
		if($data == null)
		{
			return false;
		}
		else
		{
			$vstId = $data['id'];

			$this->db->select('cliId, vstNote');
			$query = $this->db->get_where('admvisits', array('vstId'=>$vstId));
			$id = $query->result_array();
			$cliId = $id[0]['cliId'];
			$note = $id[0]['vstNote'];
			
			$data = array();
			$this->db->select('admcustomers.cliId, admcustomers.cliName, admcustomers.cliLastName, IF((sum(admcredits.crdDebe) - sum(admcredits.crdHaber) ) IS NULL, 0 ,(sum(admcredits.crdDebe) - sum(admcredits.crdHaber) )) as balance, admcustomers.cliImagePath,  '.$vstId.' as vstId , admcustomers.cliAddress, \''.$note.'\' as note ');
			$this->db->from('admcustomers');
			$this->db->join('admcredits', ' admcredits.cliId = admcustomers.cliId', 'left');	
			$this->db->where('admcustomers.cliId', $cliId);
			$this->db->group_by("admcustomers.cliId"); 
			$query= $this->db->get();

			if ($query->num_rows() != 0)
			{
			 	return $query->result_array();
			}
			else
			{
				return array();
			}
		}
	}
	
}
?>