<?php
class Calendars extends CI_Model
{
	function __construct()
	{
		parent::__construct();
	}
	
	function setVisit($data = null){
		if($data == null)
		{
			return false;
		}
		else
		{
			$equipId = $data['equipid'];
			$dia = $data['dia'];
			$hora = $data['hora'];
			$min = $data['min'];
			$note = $data['note'];
			$solicita = $data['solicita'];
			
			$dia = explode('-', $dia);
			
			$insert = array(
				   'f_sugerido' => $dia[2].'-'.$dia[1].'-'.$dia[0],
				   'hora_sug' => $hora.':'.$min,
				   'id_equipo' => $equipId,
				   'estado' => 'C',
				   'solicitante' => 'solicita',
				   'causa' => $note
				);

			if($this->db->insert('solicitud_reparacion', $insert) == false) {
				return false;
			}else{
				return "Se programo la Orden de Servicio para el día <br>".$data['dia']." a las ".$data['hora'].":".$data['min'];
			}
		}
	}

	function setReprogramVisit($data = null){
		if($data == null)
		{
			return false;
		}
		else
		{
			$vstId = $data['vstId'];
			$dia = $data['dia'];
			$hora = $data['hora'];
			$min = $data['min'];
			$note = $data['note'];
			
			$dia = explode('-', $dia);

			$update = array(
				   'vstDate' => $dia[2].'-'.$dia[1].'-'.$dia[0].' '.$hora.':'.$min,
				   'vstStatus' => 'PN',
				   'vstNote' => $note
				);

			if($this->db->update('admvisits', $update, array('vstId'=>$vstId)) == false) {
				return false;
			}else{
				return "Se re-programo la visita para el día <br>".$data['dia']." a las ".$data['hora'].":".$data['min'];
			}
		}
	}

	function cancelVisit($data = null){
		if($data == null)
			{
				return false;
			}
			else
			{
				$update = array();
				$update['vstStatus'] = 'VS';
				//Actualizar estado de visita
				if($this->db->update('admvisits', $update, array('vstId'=>$data['vstId'])) == false) {
					return false;
				}
			}
		return "La visita fue cerrada";
	}

	function getCalendarsPreventivo($data = null){
		
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

	function getSaleData(){
		$data = array();
		$this->db->select('admcustomers.cliId, admcustomers.cliName, admcustomers.cliLastName, admcustomers.cliDni, admcustomers.cliAddress, admcustomers.cliImagePath, IF((sum(admcredits.crdDebe) - sum(admcredits.crdHaber) ) IS NULL, 0 ,(sum(admcredits.crdDebe) - sum(admcredits.crdHaber) )) as balance ');
		$this->db->from('admcustomers');
		$this->db->join('admcredits', ' admcredits.cliId = admcustomers.cliId', 'left');	
		$this->db->group_by("admcustomers.cliId"); 
		$this->db->order_by('admcustomers.cliLastName','asc');
		$this->db->order_by('admcustomers.cliName','asc');
		$query= $this->db->get();

		if ($query->num_rows() != 0){
		 	$data['customers'] = $query->result_array();	
		} else {
			$data['customers'] = array();
		}
		
		$this->db->select('prodId, prodCode, prodDescription, prodPrice, prodMargin');
		$this->db->from('admproducts');
		$this->db->where(array('prodStatus'=>'AC'));
		$this->db->order_by('prodDescription','asc');
		$query = $this->db->get();

		if ($query->num_rows() != 0){
		 	$data['products'] = $query->result_array();	
		} else {
			$data['products'] = array();
		}

		return $data;
	}

	

?>