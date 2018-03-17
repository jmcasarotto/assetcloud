<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Ordenservicios extends CI_Model{
	
    function __construct(){
        
		parent::__construct();
	}
	
	function index(){

		echo "cargo modelo Ordenservicios";
	}

	function getEquipos($data = null){

        $id = $data['id_equipo'];       

        $this->db->select('
                equipos.codigo AS nomb_equipo,                
                equipos.descripcion AS desc_equip,
                equipos.fecha_ingreso,
                equipos.fecha_baja,
                equipos.fecha_garantia,
                equipos.estado,
                equipos.marca,
                grupo.descripcion AS grupo_desc,
                sector.descripcion As sector_desc,
                equipos.ubicacion');
        
        $this->db->from('equipos');        
        $this->db->join('grupo', 'equipos.id_grupo = grupo.id_grupo');
        $this->db->join('sector', 'equipos.id_sector = sector.id_sector');
        $this->db->group_by('equipos.id_equipo');
        $this->db->having('equipos.id_equipo', $id);
        $query = $this->db->get();      

        foreach ($query->result_array() as $row){ 

                $data['nomb_equipo'] = $row['nomb_equipo'];
                $data['desc_equipo'] = $row['desc_equip'];
                $data['fecha_ingreso'] = $row['fecha_ingreso'];
                $data['fecha_baja'] = $row['fecha_baja'];
                $data['fecha_garantia'] = $row['fecha_garantia'];
                $data['estado'] = $row['estado'];
                $data['marca'] = $row['marca'];
                $data['grupo_desc'] = $row['grupo_desc'];
                $data['sector'] = $row['sector_desc'];
                $data['ubicacion'] = $row['ubicacion'];
                return $data;
        }
    }

    function getsolicitudes($data=null){

        $this->db->select('solicitud_reparacion.id_solicitud, 
                            solicitud_reparacion.causa, 
                            solicitud_reparacion.id_equipo');
        $this->db->from('solicitud_reparacion');
        $this->db->where('estado', 'S');
        $query = $this->db->get();

        if ($query->num_rows()!=0)
        {               
            return $query->result_array();
        }
        else
        {
            return array();
        }       
    }

    function getOrdenInactivas(){

        $this->db->select(
                    'orden_servicio.id_orden, 
                    orden_servicio.estado,
                    equipos.id_equipo,
                    orden_servicio.comprobante,
                    orden_servicio.fecha, 
                    equipos.codigo,
                    solicitud_reparacion.id_solicitud,
                    solicitud_reparacion.solicitante, 
                    solicitud_reparacion.f_solicitado,                     
                    solicitud_reparacion.causa');
        $this->db->from('orden_servicio');
        $this->db->join('solicitud_reparacion', 'orden_servicio.id_solicitudreparacion = solicitud_reparacion.id_solicitud');
        $this->db->join('equipos', 'solicitud_reparacion.id_equipo = equipos.id_equipo');
        $this->db->where('orden_servicio.estado','T');
        $query = $this->db->get();

        if ($query->num_rows()!=0)
        {
            return $query->result_array();  
        }
        else
        {   
            return array();
        }  
    }

    function getComponentes($data = null){
        
        $id = $data['id_equipo'];
    
        $this->db->select('componentes.id_componente, componentes.descripcion');
        $this->db->from('componentes');
        $this->db->join('componenteequipo', 'componentes.id_componente = componenteequipo.id_componente');
        $this->db->join('equipos', 'componenteequipo.id_equipo = equipos.id_equipo'); 
        $this->db->where('equipos.id_equipo', $id);
        $query = $this->db->get();      
        
        return $query->result_array();                
    }

    function getContratistas(){

        $query = $this->db->query("SELECT `id_contratista`, `nombre` FROM `contratistas`");
        $contratistas = $query->result_array();
        
        return $contratistas;
    }

    function getArticulos(){
        $query = $this->db->query("SELECT articles.artId, articles.artBarCode,articles.artDescription FROM articles");
        $i=0;
        foreach ($query->result() as $row){

        	$insumos[$i]['value'] = $row->artId;
            $insumos[$i]['label'] = $row->artBarCode;
            $insumos[$i]['descripcion'] = $row->artDescription;
            $i++;
        }
        return $insumos;
    }

    function getInsumOrdenes($data){        

        $id_orden = $data['id_orden'];

        $this->db->select(
                    'deta_ordeninsumos.cantidad,
                    articles.artDescription AS descripcion,
                    abmdeposito.depositodescrip AS deposito');        
        $this->db->from('orden_insumos');
        $this->db->join('orden_servicio', 'orden_servicio.id_orden_insumo = orden_insumos.id_orden');        
        $this->db->join('deta_ordeninsumos', 'deta_ordeninsumos.id_ordeninsumo = orden_insumos.id_orden');        
        $this->db->join('tbl_lote', 'deta_ordeninsumos.loteid = tbl_lote.loteid');        
        $this->db->join('articles','articles.artId = tbl_lote.artId');
        $this->db->join('abmdeposito','abmdeposito.depositoId = tbl_lote.depositoid');
        $this->db->where('orden_servicio.id_orden', $id_orden);

        $query = $this->db->get();

        if ($query->num_rows()!=0)
        {
            return $query->result_array();  
        }
        else
        {   
            return array();
        }   
    }

    function getDepositos(){

        $query = $this->db->query("SELECT `depositoId`, `depositodescrip` FROM `abmdeposito`");
        $depositos = $query->result_array();

        return $depositos;
    }

    function getHerramientas(){
        
        $this->db->select('herrdescrip, herrmarca, herrcodigo, herrId');
        $this->db->from('herramientas');
        $this->db->where('equip_estad', 'AC');
        $query = $this->db->get();
        $i=0;
        foreach ($query->result() as $row){

            $herramientas[$i]['label'] = $row->herrdescrip;
            $herramientas[$i]['value'] = $row->herrmarca;
            $herramientas[$i]['codherram'] = $row->herrcodigo;
            $herramientas[$i]['herrId'] = $row->herrId;

            $i++;
        }
        return $herramientas;
    }

    function getHerramOrdenes($data){
        $id_orden = $data['id_orden'];

        $this->db->select(
                    'herramientas.herrcodigo,
                    herramientas.herrmarca,
                    herramientas.herrdescrip');
        
        $this->db->from('orden_servicio');        
        $this->db->join('tbl_valesalida', 'orden_servicio.valesid = tbl_valesalida.valesid');        
        $this->db->join('tbl_detavalesalida', 'tbl_detavalesalida.valesid = tbl_valesalida.valesid');        
        $this->db->join('herramientas', 'tbl_detavalesalida.herrId = herramientas.herrId');        
        $this->db->where('orden_servicio.id_orden', $id_orden);

        $query = $this->db->get();

        if ($query->num_rows()!=0)
        {
            return $query->result_array();  
        }
        else
        {   
            return array();
        }   
    }

    function getTareas(){      

        $query = $this->db->query("SELECT `id_tarea`, `descripcion` FROM `tareas`");
        $tareas = $query->result_array();
        
        return $tareas;
    }

    function getTareasOrden($data){
        
        $id_orden = $data['id_orden'];

        $this->db->select(
                    'tareas.descripcion, 
                    componentes.descripcion AS componente,
                    deta_ordenservicio.tiempo AS horas,
                    deta_ordenservicio.monto');
        $this->db->from('orden_servicio');
        $this->db->join('deta_ordenservicio', 'deta_ordenservicio.id_ordenservicio = orden_servicio.id_orden');
        $this->db->join('tareas', 'deta_ordenservicio.id_tarea = tareas.id_tarea');
        $this->db->join('componentes', 'deta_ordenservicio.id_componente = componentes.id_componente');
        $this->db->where('orden_servicio.id_orden', $id_orden);
        
        $query = $this->db->get();

        if ($query->num_rows()!=0)
        {
            return $query->result_array();  
        }
        else
        {   
            return array();
        }   
    }

    function getOperarios(){
        $query = $this->db->query("SELECT `usrId`, CONCAT(`usrLastName`,', ',`usrname`)  as `operario` FROM `sisusers`");
        $i=0;
        foreach ($query->result() as $row)
        {   
            $equipos[$i]['label'] = $row->operario;
            $equipos[$i]['value'] = $row->usrId;
            $i++;
        }
        return $equipos; 
    }

    function validaOperarios($data){
        
        $query = $this->db->query("SELECT CONCAT(`usrLastName`,', ',`usrname`)  as `operario` FROM `sisusers`");
        $recurso = (string)$data['operario'];
        
        foreach($query->result_array() as $row){                
             
            $usuario = (string)$row['operario'];
            
            if (strcasecmp ($usuario , $recurso) == 0) { 
                $resp['resp'] = true;                
               return $resp;  
            }  
            
        }
        $resp['resp'] = false;
        return $resp;
    }

    function getOperariosOrden($data){

        $id_orden = $data['id_orden'];

        $sql = "SELECT sisusers.usrId, CONCAT(sisusers.usrLastName,',' ,sisusers.usrname)  as operario FROM sisusers
                INNER JOIN asignausuario ON asignausuario.usrId = sisusers.usrId
                INNER JOIN orden_servicio ON asignausuario.id_orden = orden_servicio.id_orden
                WHERE orden_servicio.id_orden = $id_orden";
        $query = $this->db->query($sql);
        return $query->result_array();              
    }

    function getOrdServiciosList(){
                
        $this->db->select(
                    'orden_servicio.id_orden, 
                    orden_servicio.estado,
                    equipos.id_equipo,
                    orden_servicio.comprobante,
                    orden_servicio.fecha, 
                    equipos.codigo,
                    solicitud_reparacion.id_solicitud,
                    solicitud_reparacion.solicitante, 
                    solicitud_reparacion.f_solicitado,                     
                    solicitud_reparacion.causa');
        $this->db->from('orden_servicio');
        $this->db->join('solicitud_reparacion', 'orden_servicio.id_solicitudreparacion = solicitud_reparacion.id_solicitud');
        $this->db->join('equipos', 'solicitud_reparacion.id_equipo = equipos.id_equipo');
        
        $query = $this->db->get();

        if ($query->num_rows()!=0)
        {
            return $query->result_array();  
        }
        else
        {   
            return array();
        }      
    }

    function getSolEquipCausas($data){

        $id_solicitud = $data['id_solic'];
        $this->db->select('solicitud_reparacion.id_solicitud, solicitud_reparacion.causa, solicitud_reparacion.id_equipo ');
        $this->db->from('solicitud_reparacion');       
        $this->db->where('solicitud_reparacion.id_solicitud', $id_solicitud);
        $query = $this->db->get();

        if ($query->num_rows()!=0)
        {
            return $query->result_array();  
        }
        else
        {   
            return array();
        }  
    }

    function getLotesActivos($depos){  // devuelve id lote y cant s/dep, estado e id de articulo
        
        $depo = $depos['depoid'];
        $insum = $depos['id_insum'];
        
        $this->db->select('loteid, cantidad');
        $this->db->from('tbl_lote');
        $this->db->where('lotestado', 'AC');
        $this->db->where('depositoid', $depo);
        $this->db->where('artId', $insum);
                                
        $query = $this->db->get();               
        
        foreach ($query->result() as $row){ 
          
            $datos_lote['id_lote'] = $row->loteid;
            $datos_lote['cantidad'] = $row->cantidad;           
        } 

        return $datos_lote;                       
    }
    ////// Cierra Informe de Servicios
    function setEstados($data){
        
        $id_ordenservicio = $data['id_orden'];       
        $estado['estado'] = 'T';
        
        $this->db->where('id_orden', $id_ordenservicio);
        $this->db->update('orden_servicio', $estado); 

        // cierra Solicitud de Servicio
        // $this->db->select('orden_servicio.id_solicitudreparacion');
        // $this->db->from('orden_servicio');
        // $this->db->where('orden_servicio.id_orden', $id_ordenservicio);
        // $query= $this->db->get();

        // foreach ($query->result() as $row){                            
        //     $id_solicitud =  $row->id_solicitudreparacion;       
        // }

        // $this->db->where('id_solicitud', $id_solicitud);
        // $this->db->update('solicitud_reparacion', $estado);        
    }

    function setOrdenServicios($data = null){
        
        if($data == null) {
            return false;
        }
        else{    

            $this->db->trans_start();   // inicio transaccion
            
            ////////// para guardar herramientas                 
                if ( !empty($data['herrid']) ){
                    $date = $data['fecha'];
                    $date = explode('/', $date);                    
                    
                    $userdata = $this->session->userdata('user_data');
                    $usrId = $userdata[0]['usrId'];     // guarda usuario logueado

                    $valeSalHerram = array(
                                        'fecha' => $date[2].'-'.$date[1].'-'.$date[0],
                                        'usrid' => $usrId
                                    );
                    $this->db->insert('tbl_valesalida', $valeSalHerram);
                    $idInsertVale = $this->db->insert_id();

                            // detalle herramientas
                    for ($i=0; $i < count($data['herrid']) ; $i++) { 
                        
                        $detavalHerram["valesid"] = $idInsertVale;
                        $detavalHerram["herrId"] = $data["herrid"][$i];
                        
                        $this->db->insert('tbl_detavalesalida', $detavalHerram);
                    }
                }else{
                    $idInsertVale = 1;    // no puede ser 0 por la clave foranea
                }

            ///////// guarda insumos
                if (!empty($data['insum_Id'])) {
                    
                    //  orden insumos                    
                    $userdata = $this->session->userdata('user_data');
                    $usrId = $userdata[0]['usrId'];     // guarda usuario logueado   
                    $comprobante = $data['comprobante'];

                    $ordIns = array(
                                'fecha' => date('Y-m-d H:i:s'),
                                'solicitante' => $usrId,
                                'comprobante' => $comprobante
                                );
                    $this->db->insert('orden_insumos', $ordIns);
                    $idInsertOrdInsum = $this->db->insert_id();
                    
                    //  /orden insumos

                    //   deta orden insumos
                    $depo = $data['depositoid']; 

                    for($i=0; $i<count($data['cant_insumos']); $i++) { // para cada insumo 
                        
                        $cant = $data['cant_insumos'][$i];   // cant de ins de un registro

                        $depo['depoid'] = $data['depositoid'][$i]; 
                        $depo['id_insum'] = $data['insum_Id'][$i];                        
                        
                        $lote = $this->getLotesActivos($depo); 
                       
                       if ( $lote['cantidad'] > 0 ) {                     //lote con insumos
                           
                           if ( $lote['cantidad'] >= $cant ) {

                               // actualizo en deta_ordeninsumo y resto en lote
                               $valEnLote['cantidad'] = $lote['cantidad'] - $cant;   
                               $id_lote = $lote['id_lote'];      
                               $this->db->where('loteid', $id_lote);
                               $this->db->update('tbl_lote', $valEnLote);       // resto cantidad en lote

                               $detOrdenIns = array(
                                            'id_ordeninsumo' => $idInsertOrdInsum, // viene de orden insumo
                                            'loteid' => $id_lote,
                                            'cantidad' => $cant
                                            );
                                $this->db->insert('deta_ordeninsumos', $detOrdenIns); 

                           }
                           else{    //no alcanza lote
                                echo "no alcanza la cantidad en este lote: ";
                                echo $lote['id_lote'];
                           }

                       }
                       else{
                            // lote sin insumos para ese deposito ( cambie deposito )
                            //return false;
                       }                   
                    } // fin for(){}

                   //   / deta orden insumos
                }else{
                   $idInsertOrdInsum = 1;   // no puede ser 0 or la clave foranea
                } 

            ////// guarda orden servicio                 

                $comprobante = $data['comprobante'];
                $id_equipo = $data['id_equipoSolic'];
                $id_contratista = $data['contratista'];
                $id_solicitudreparacion = $data['id_solicitudreparacion'];

                $ord_serv = array(
                                'fecha' => date('Y-m-d H:i:s'),
                                'comprobante' => $comprobante,
                                'id_equipo' => $id_equipo,
                                'id_contratista' => $id_contratista,
                                'id_solicitudreparacion' => $id_solicitudreparacion,
                                'valesid' => $idInsertVale,
                                'id_orden_insumo' => $idInsertOrdInsum,
                                'estado' => 'C'
                            );

                $this->db->insert('orden_servicio', $ord_serv);
                $idInsertOrden = $this->db->insert_id();

                /// deta
              
                for ($i=0; $i < count($data['tarea_id']) ; $i++) {
                    $tarea_id = $data['tarea_id'][$i];
                    $cant_horas = $data['cant_horas'][$i];                    
                    $monto = $data['costos'][$i];
                    $comp_id = $data['comp_id'][$i];
                    $rh = $idInsertOrden; // guarda id Orden de Servicio
                    
                    $tarea = array(
                                'id_ordenservicio' => $idInsertOrden,
                                'id_tarea' => $tarea_id,
                                'tiempo' => $cant_horas,
                                'monto' => $monto,
                                'id_componente' => $comp_id,
                                'rh' => $rh
                            );

                    $this->db->insert('deta_ordenservicio', $tarea);
                }

            ////// actualiza estado de solicitud de reparacion

                $estado['estado'] = 'C';
                $this->db->where('id_solicitud', $id_solicitudreparacion);
                $this->db->update('solicitud_reparacion', $estado);  

            ////// guarda Operarios
                if (!empty($data['usrid'])) {

                    $fechaSist = date('Y-m-d H:i:s');
                    
                    for ($i=0; $i < count($data['usrid']) ; $i++) { 

                        $asigUsr["usrId"] = $data['usrid'][$i];
                        $asigUsr["id_orden"] = $idInsertOrden;      // id orden servicio
                        $asigUsr["fechahora"] = $fechaSist;
                         
                        $this->db->insert('asignausuario', $asigUsr);
                    }

                } 
                
            $this->db->trans_complete();

             if ($this->db->trans_status() === FALSE)
             {
                 return false;  
             }
             else{
                 return true;
             }    
        }
    }
}

