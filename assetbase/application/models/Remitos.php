<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Remitos extends CI_Model
{
	function __construct()
	{
		parent::__construct();
	}
	
	public function index(){

		echo "cargo modelo de Remito";
	}

   function getcodigo(){

   	/* SELECT articles.artId, tbl_lote.loteid,articles.artBarCode, articles.artDescription
	FROM articles
	JOIN tbl_lote ON tbl_lote.prodId= articles.artId AND tbl_lote.lotestado='AC' 
	WHERE tbl_lote.prodId=articles.artId
	"; */
   	


	$sql="SELECT articles.artId,articles.artBarCode, articles.artDescription
	FROM articles
	
	";
	$query= $this->db->query($sql);

	//$query= $this->db->get_where('articles');
		if($query->num_rows()>0){
	    return $query->result();
	    }
	    else{
	    return false;
	    }
	    
	}

	function getproveedor(){

		$query= $this->db->get_where('abmproveedores');
			if($query->num_rows()>0){
	   	 	return $query->result();
	    }
	    else{
	    	return false;
	    }
	}
	


	function getdescrip($data = null){
		if($data == null)
		{
			return false;
		}
		else
		{
			
			$id = $data['artId'];



			//Datos del usuario
			$query= $this->db->get_where('articles',array('artId'=>$id));
			if($query->num_rows()>0){
                return $query->result();
            }
            else{
                return false;
            }
			
		}
	}

	
	function getlote($ide,$idd){
		
		//arriba artId prodId
			$sql="SELECT tbl_lote.loteid
			FROM tbl_lote
			Where tbl_lote.artId=$ide AND  tbl_lote.depositoid=$idd";

			$query= $this->db->query($sql);

			if($query->num_rows()>0){
                return $query->result();
            }
            else{
                return false; //false
            }	
		
	}
	function detaorden($ultimoId,$co,$dep,$indice,$ar){

		 
		$i=1;
		//$res=array();
		
		foreach ($indice as $row) {
			if($ar[$i]){
				if($dep[$i]){
				

					$a=$ar[$i];//articulo
					$d=$dep[$i];//deposito
					$res=$this->loteres($a,$d); //id de lote 
					print_r($res);
					if($res >0){

						if($co[$i]){ //cant
							$datos2 = array(
				        	 'id_remito'=>$ultimoId, 
				        	 'loteid'=>$res,
				        	 'cantidad'=>$co[$i]
				        	 
			        		);
			        	print_r($datos2);
			        	$result=$this->insert_detaremito($datos2);
			        	//print_r($result);

						}
						$this->sumarlote($res,$co[$i]);

					}
					else {
						$cod=$this->traercodigoart($ar[$i]);
						
						$datos3 = array(
							'codigo'=>$cod,		
							'fecha'=>date("Y-m-d H:i:s"),
							'cantidad'=>$co[$i],
							'artId'=>$ar[$i],  //artId arriba/ local prodId 
							'lotestado'=>'AC',
							'depositoId'=>$dep[$i]
							);

						$this->insert_lote($datos3); //inserta en lote

						$ultimolote=$this->db->insert_id();
						print_r($ultimolote);

						$datos2 = array(
				        	 'id_remito'=>$ultimoId, 
				        	 'loteid'=>$ultimolote,
				        	 'cantidad'=>$co[$i]
				        	 
			        	);

						$this->insert_detaremito($datos2); //inserta en detaremito
					}
					

				}

			}
		$i++;
			
		}

		return $result ;

			
			
	}


function sumarlote($res,$co){


	$sql= "SELECT tbl_lote.cantidad
	FROM tbl_lote
	WHERE tbl_lote.loteid=$res";


	$query= $this->db->query($sql); //aca esta la canidad

	foreach ($query->result() as $row){   
	                   
	            $datos= $row->cantidad;
	                 
	}

	$re= $datos + $co;
	print_r($re);
		
	$this->updatelote($re,$res);
return $re;
		
}

 function updatelote($re,$res)
    {
    	$sql="UPDATE tbl_lote SET  tbl_lote.cantidad =$re  WHERE tbl_lote.loteid=$res";
		$query= $this->db->query($sql);

		
	   	 return $query;
	   
    }

function traercodigoart($d){

	//artId
		$sql= "SELECT artBarCode
		FROM articles
		WHERE articles.artId=$d ";

		$query= $this->db->query($sql);

		if($query->result() ){

			foreach ($query->result() as $row){   
	                   
	            $datos= $row->artDescription;
	                 
	        }

	    return $datos;
		}
		else 
		{
			return 0;
		}

}


function loteres($a,$d){

		//artId prodId
		$sql= "SELECT tbl_lote.loteid
		FROM tbl_lote
		WHERE tbl_lote.artId=$a AND tbl_lote.depositoid=$d ";

		$query= $this->db->query($sql);

		if($query->result() ){

			foreach ($query->result() as $row){   
	                   
	            $datos= $row->loteid;
	                 
	        }

	    return $datos;
		}
		else 
		{
			return 0;
		}
			
}


	function getsolicitante(){

		$query= $this->db->get_where('solicitud_reparacion');
			if($query->num_rows()>0){
	   	 	return $query->result();
	    }
	    else{
	    	return false;
	    }
	}

	 public function insert_orden($data)
    {
        $query = $this->db->insert("remitos",$data);
        return $query;
    }
    
     public function insert_lote($data3)
    {
        $query = $this->db->insert("tbl_lote",$data3);
        return $query;
    }

    public function insert_detaremito($data2)
    {
        $query = $this->db->insert("deta-remito",$data2);
        return $query;
    }

    function getdeposito(){

    	$query= $this->db->get_where('abmdeposito');
			if($query->num_rows()>0){
	   	 	return $query->result();
	    }
	    else{
	    	return false;
	    }

	   /* if($data == null)
		{
			return false;
		}
		else
		{
			
			$id= $data['artId'];

			
			$sql= "SELECT articles.artId,tbl_lote.loteid, abmdeposito.depositoId, abmdeposito.depositodescrip
			FROM articles
			JOIN tbl_lote ON tbl_lote.prodId=articles.artId
			JOIN abmdeposito ON abmdeposito.depositoId=tbl_lote.depositoid
			WHERE tbl_lote.prodId=$id"; //
			$query= $this->db->query($sql);
			if($query->num_rows()>0){
                return $query->result();
            }
            else{
                return 0; //false
            }

			
			
		}*/
	}


 function getlotecant($id){
	$sql="SELECT  tbl_lote.cantidad
	FROM tbl_lote
	WHERE tbl_lote.depositoid=$id AND tbl_lote.lotestado='AC'
	";
	$query= $this->db->query($sql);

	/*if($query->num_rows()>0){
	   	 	return $query->result();
	    }
	    else{
	    	return false;
	    }*/

	$i=0;
               foreach ($query->result_array() as $row)
               {   
                   
                   $datos[$i]= $row['cantidad'];
                   $i++;
               }

		
	    return $datos;
	    
	}


    function lote($val,$co,$d){

    	if ($val!=0) {
    	 	$cant= $this->lotecantidad($val); //obtengo la cantidad segun el lote
    	 	print_r($cant);
    	}
    	if ($cant >=$co) {
    		$res=$cant - $co;
    		
		}	
		else {
			echo  "No hay insumos suficientes"; 
			//$res=$co - $cant;
			
		}	

		$datos3 = array(
					        			
			'cantidad'=>$res
		);

						        	
		print_r($datos3);
					        	
		$this->update_tbllote($val,$datos3);

	
	}

	function lotecantidad($v){

		$sql="SELECT  tbl_lote.cantidad
				FROM tbl_lote
				WHERE tbl_lote.loteid=$v";
		$query= $this->db->query($sql);

	  	foreach ($query->result() as $row){   
                   
            $datos= $row->cantidad;
                 
        }

		
	    return $datos;

	}


    public function update_tbllote($id,$data3)
    {
        $this->db->where('loteid', $id);
        $query = $this->db->update("tbl_lote",$data3);
        return $query;
    }

    public function alerta($codigo,$de)
    {
    	 //arriba es artId, prodId
        $sql="SELECT  tbl_lote.cantidad
				FROM tbl_lote
				WHERE tbl_lote.artId=$codigo AND tbl_lote.depositoid=$de AND tbl_lote.lotestado='AC'
				";

		$query= $this->db->query($sql);

	  	foreach ($query->result() as $row){   
                   
            $datos= $row->cantidad;
                 
        }

		
	    return $datos;
    }



}
?>