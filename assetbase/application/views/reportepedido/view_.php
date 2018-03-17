<input type="hidden" id="permission" value="<?php echo $permission;?>">
<section class="content"> 
<div class="row">
<div class="col-xs-12">
	<div class="alert alert-danger alert-dismissable" id="error" style="display: none">
        <h4><i class="icon fa fa-ban"></i> Error!</h4>
        Revise que todos los campos esten completos
  </div>
</div>
</div>
<div class="row">
    <div class="col-xs-12">
      <div class="box">
        <div class="box-header">
        <br>
          <h3 class="box-title">Reporte de Atrículos de pedidos</h3>
        </div>
        <br>
	         
	    
          <div role="tabpanel" class="tab-pane" style="width: 98%;  float: center;  margin: auto;">
            <div class="form-group">
              <div class="panel panel-default">
                <div class="panel-heading">
                  <h2 class="panel-title ">   <label>Datos a filtrar:</label></h2>
                </div>
					
      					<div class="box-body" style="  margin: 20px;"> 
                <form class="form-inline" > 
                <div class="row">
                <div class="col-sm-12 col-md-12" > 
      					 
      					  <div class="form-group col-xs-4" >
      						  <div class="checkbox" style="margin-left: 20px;">
      							 <label>
      							   <input type="checkbox" class="check" id="selEquipo">
      							 </label>
      						  </div>
      						  <label for="equipSelec">Equipo</label>
      						    <select class="form-control" id="equipSelec" placeholder="Seleccione tipo...">
      								  <option value=""></option>						  			  
      								</select>						    	  
      					  </div>
                  <div class="form-group col-xs-4" size="50">
                    <div class="checkbox" style="margin-left: 20px;">
                     <label>
                       <input type="checkbox" class="check" id="selOt">
                     </label>
                    </div>
                    <label for="artSelec" >Orden de Trabajo</label>
                      <select class="form-control" id="otSelec" style="width: 100px; "  placeholder="Seleccione tipo..." >
                        <option value=""></option>                      
                      </select>                   
                  </div>
      						</br> 
                  </br>
                  <br>
                  <div class="form-group col-xs-4" >
                    <div class="checkbox" style="margin-left: 20px;">
                     <label>
                       <input type="checkbox" class="check" id="selArticulo">
                     </label>
                    </div>
                    <label for="artSelec" >Articulo</label>
                      <select class="form-control "   id="artSelec" placeholder="Seleccione tipo..."  >
                        <option value=""></option>                      
                      </select>                   
                  </div>
                  <div class="form-group col-xs-4" size="27" >
                    <div class="checkbox" style="margin-left: 20px;">
                     <label>
                       <input type="checkbox" class="check" id="selestado">
                     </label>
                    </div>
                    <label for="estSelec" >Estado</label>
                      <select class="form-control" id="estSelec" placeholder="Seleccione tipo..." >
                       <option value=""></option> 
                        <option value="1">ENTREGADO</option> 
                        <option value="2">PEDIDO</option>                  
                      </select>                   
                  </div>
                  <br>
                  </br>
                  <br>
      					  <div class="form-group  col-xs-4"  >
      						  <div class="checkbox" style="margin-left: 20px;">
      							   <label>
      							     <input type="checkbox" class="check" id="selFecha">
      							   </label>
      							</div>
      						  <label for="desde">Desde</label>
      						  <input type="text" class="form-control fecha check" id="desde" size="27">
      					 </div>  
      						<div class="form-group" style="margin-right:  20px;">
      							<label for="hasta">Hasta</label>
      							 <input type="text" class="form-control fecha check" id="hasta" size="27">
      						</div> 
                  <br> 
                  <br>
                  <div class="form-group col-xs-4" size="27" >
                    <div class="checkbox" style="margin-left: 20px;">
                     <label>
                       <input type="checkbox" class="check" id="selnota">
                     </label>
                    </div>
                    <label for="notSelec" >Nota de Pedido</label>
                      <select class="form-control" id="notSelec" placeholder="Seleccione tipo..." >
                        <option value=""></option> 
                                      
                      </select>                   
                  </div>
                  <br>
                  </br>
                  <br>
                  <!--onclick="javascript:consReporte()"   <span class="glyphicon glyphicon-search"></span>-->
      						<center><button class="btn btn-default" id="consulta" ><label>Consultar   </label>    </button>  
                        <a class="btn btn-default" id="export-btn" onclick=" descargarExcel()"><label>Exportar</label></a>
                  </center>
                  <br>
                  <br>
                </div>
                </div>
                </form> 

      					</div>
              </div>
            </div>
          </div>
			
          <br>
          <br>
				<div id="tablaReportes"  data-tableName="Test Table 2" style="display: none; text-align: center; width:90%;  margin: 0 80px;">
           <table id="sales" class="table table-bordered table-hover" style="text-align: center">
            <thead>
              <tr>                
                <th width="20%" style="text-align: center">Orden de Trabajo</th>
                <th width="20%" style="text-align: center">Descripcion</th>
                <th width="20%" style="text-align: center">Tarea</th>
                <th width="20%" style="text-align: center">Equipo</th>
                <th style="text-align: center">Articulo</th>
                <th style="text-align: center">Cantidad</th>
                <th style="text-align: center">Proveedor</th>
                <th style="text-align: center">Fecha de Entrega </th>
                <th style="text-align: center">Fecha de Entregado</th>
                <th style="text-align: center">Estado</th>
              </tr>
            </thead>
            <tbody>
            </tbody>
            </table>    
        </div>
 		
 	  </div>
 	</div>
</div>
</section>
<style type="text/css">
  
  table thead {
  color: #040404;
  background-color: #D6DBDF;
}
</style>
<!-- Datepicker -->
<script>  
  $(".fecha").datepicker();
</script>


<!-- Habilitar y deshabilitar fecha sector y equipo-->
<script>
var opcs=0;
var opce=0;
var opcf=0;
var opca=0;
var opcest=0;
var avestado="";
var opcnot=0;
var opcot=0;
    function descargarExcel(){
        //Creamos un Elemento Temporal en forma de enlace
        var tmpElemento = document.createElement('a');
        // obtenemos la información desde el div que lo contiene en el html
        // Obtenemos la información de la tabla
        var data_type = 'data:application/vnd.ms-excel';
        var tabla_div = document.getElementById('sales');
        var tabla_html = tabla_div.outerHTML.replace(/ /g, '%20');
        tmpElemento.href = data_type + ', ' + tabla_html;
        //Asignamos el nombre a nuestro EXCEL
        tmpElemento.download = 'Reporte_Articulos_Pedido.xls';
        // Simulamos el click al elemento creado para descargarlo
        tmpElemento.click();
    }
   
	$(function() {
	  enabDisabFecha();
	  $("#selFecha").click(enabDisabFecha);
	});
	function enabDisabFecha() {
	  if (this.checked) {
      opcf=3;
	    $("input.fecha").removeAttr("disabled");
	  } else {
      opcf=0;
	    $("input.fecha").attr("disabled", true);
	    $("input.fecha").val('');
	  }
	}


	$(function() {
	  enabDisabArticulo();
	  $("#selArticulo").click(enabDisabArticulo);
	});

	function enabDisabArticulo() {
	  if (this.checked) {
      opca=1;
	    $("select#artSelec").removeAttr("disabled");
	  } else {
      opca=0;
	    $("select#artSelec").attr("disabled", true);
	    $("select#artSelec").val('');
	  }
	}

	$(function() {
	  enabDisabEquipo();
	  $("#selEquipo").click(enabDisabEquipo);
	});
	function enabDisabEquipo() {
	  if (this.checked) {
      opce=2;
	    $("select#equipSelec").removeAttr("disabled");
	  } else {
      opce=0;
	    $("select#equipSelec").attr("disabled", true);
	    $("select#equipSelec").val('');
	  }
	}

  $(function() {
    enabDisabestado();
    $("#selestado").click(enabDisabestado);
  });
  function enabDisabestado() {
    if (this.checked) {
      opcest=4;
      $("select#estSelec").removeAttr("disabled");
    } else {
      opcest=0;
      $("select#estSelec").attr("disabled", true);
      $("select#estSelec").val('');
    }
  }

  $(function() {
    enabDisabot();
    $("#selOt").click(enabDisabot);
  });
  function enabDisabot() {
    if (this.checked) {
      opcot=5;
      $("select#otSelec").removeAttr("disabled");
    } else {
      opcest=0;
      $("select#otSelec").attr("disabled", true);
      $("select#otSelec").val('');
    }
  }

  $(function() {
    enabDisabnota();
    $("#selnota").click(enabDisabnota);
  });
  function enabDisabnota() {
    if (this.checked) {
      opcnot=6;
      $("select#notSelec").removeAttr("disabled");
    } else {
      opcest=0;
      $("select#notSelec").attr("disabled", true);
      $("select#notSelec").val('');
    }
  }


</script>



<!-- Trae sectores y equipos p/ sector seleccionado -->
<script> 


      $(function() {
        
        $.ajax({
                //'data' : {id_sector : id },
                'async': true,
                'type': "POST",
                'global': false,
                'dataType': 'json',
                'url': "Sservicio/getEquipo",
                'success': function (data) {
                    
                    var $select = $("#equipSelec");

                    for (var i = 0; i < data.length; i++) {

                      $select.append($('<option />', { value: data[i]['id_equipo'], text: data[i]['descripcion'] }));
                    }

                 },
                'error' : function (data){
                  console.log('Error en getEquiSector');
                  alert('error');
                 }

        });
      });

      $(function() {
        
        $.ajax({
                //'data' : {id_sector : id },
                'async': true,
                'type': "POST",
                'global': false,
                'dataType': 'json',
                'url': "Reportepedido/getarticulo",
                'success': function (data) {
                  console.log("tengo los datos del articulo");
                   console.log(data);
                    
                    var $select = $("#artSelec");

                    for (var i = 0; i < data.length; i++) {

                      $select.append($('<option />', { value: data[i]['artId'], text: data[i]['artBarCode'] }));
                    }

                 },
                'error' : function (data){
                  console.log('Error en articulor');
                  alert('error');
                 }

        });
      });

      $(function() {
        
        $.ajax({
                //'data' : {id_sector : id },
                'async': true,
                'type': "POST",
                'global': false,
                'dataType': 'json',
                'url': "Reportepedido/getorden",
                'success': function (data) {
                  console.log("tengo los datos de la orden");
                   console.log(data);
                    
                    var $select = $("#otSelec");

                    for (var i = 0; i < data.length; i++) {

                      $select.append($('<option />', { value: data[i]['id_orden'], text: data[i]['id_orden'] }));
                    }

                 },
                'error' : function (data){
                  console.log('Error en articulor');
                  alert('error');
                 }

        });
      });

      $(function() {
        
        $.ajax({
                //'data' : {id_sector : id },
                'async': true,
                'type': "POST",
                'global': false,
                'dataType': 'json',
                'url': "Reportepedido/getnota",
                'success': function (data) {
                  console.log("tengo los datos de la orden");
                   console.log(data);
                    
                    var $select = $("#notSelec");

                    for (var i = 0; i < data.length; i++) {

                      $select.append($('<option />', { value: data[i]['id_notaPedido'], text: data[i]['id_notaPedido'] }));
                    }

                 },
                'error' : function (data){
                  console.log('Error en estado');
                  alert('error');
                 }

        });
      });



</script>

<!-- Validacion de campos y Envio form -->
<script> 
$("#consulta").click(function(evento){
    evento.preventDefault();
    //alert("entre");  $emid: $("#emp").val()
    //$("#cargando").show();
    var id_eq = $('#equipSelec').val();

     // var id_sec = $('#idSector').val();
    
    console.log("Id de equipo es:");
    console.log(id_eq);
    console.log("Bandera que me indica que seleccione equipo es:")
    console.log(opce);
   

    $("#tablaReportes").css("display", "block");//muestro tabla
    $("#sales tbody tr").remove();//limpio tr de tabla 
    if((opce ==2) && (opcf==0)){ //seleccione equipo
      console.log("selecciono equipo");
        $.ajax({    
            data:{
              id_eq: id_eq
            },
            type: 'POST',             
            dataType: 'json',
            url: 'index.php/Reportepedido/getequipo',                
            success: function(result){  
            console.log(result); 
            // console.log(result[0]['id_equipo']); 
                    limpCombo();
                    if(result !==0){

                   
                      for(var i=0; i <= result.length-1; i++){

                        if(result[i]['estdet']=='E'){
                          var e='Entregado';
                        }
                        else {
                          if(result[i]['estdet']=='P'){
                          var e='Pedido';
                          }
                        }
                        var diasSemana = new Array("Domingo","Lunes","Martes","Miércoles","Jueves","Viernes","Sábado");
                        fecha = new Date(result[i]['fechaEntrega']);
                        fecha2 = new Date(result[i]['fechaEntregado']);



                         var tr ="<tr>"+
                        "<td>"+result[i]['id_orden']+"</td>"+ 
                        "<td>"+result[i]['desot']+"</td>"+
                        "<td>"+result[i]['deta']+"</td>"+ 
                        "<td>"+result[i]['codigo']+"</td>"+ 
                        "<td>"+result[i]['artBarCode']+"</td>"+ 
                        "<td>"+result[i]['cantidad']+"</td>"+
                        "<td>"+result[i]['provnombre']+"</td>"+
                        "<td>"+ fecha.toLocaleDateString("es-ES", diasSemana)+"</td>"+
                        "<td>"+fecha2.toLocaleDateString("es-ES", diasSemana)+"</td>"+
                        "<td>"+e+"</td>"+
                        "</tr>";
                      

                        $('#sales tbody').append(tr);
                      }
                    }
                    else 
                      alert("Este equipo no se puede filtrar, POR FAVOR SELCCIONO OTRO ");
            },
            error: function(result){
                    limpCombo();
                    // WaitingClose();                                              
                    alert("Error en consulta Ordenes");
            }
        });
    }
    else {
      if((opce ==0) && (opcf==3)){ //selecciono fecha

        console.log("Seleccione las fechas");
        var de = $('#desde').val();
        var a = $('#hasta').val();  
        console.log(de);
        console.log(a);
        console.log("Bandera que me indica, que seleccione fecha:");
        console.log(opcf);
        calcular_fecha(de,a);
    

      }
    }
    if((opce ==0) && (opcf==0) && (opca==1)){ //seleccione articulo

      var id_art = $('#artSelec').val();
      console.log("Id de articulo es:");
      console.log(id_art);
      console.log("Bandera que me indica que seleccione articulo es:");
      console.log(opca);
      calcular_articulo(id_art);

    }
    else{
      //selecciona estado
      if((opce ==0) && (opcf==0) && (opca==0) && (opcest==4)){

        var est = $('#estSelec').val();
        var nombre =$("select#estSelec option:selected").html();

        console.log("Id de estado es:");
        console.log(est);
        console.log(nombre);
        console.log("Bandera que me indica que seleccione estado es:");
        console.log(opcest);
        //1- Entregado, 2- Pedido
        veretado(nombre, est); //seleccione estado
       
      }
    }
    //selecciona ot 
    if((opce ==0) && (opcf==0) && (opca==0) && (opcest==0) && (opcot==5)){ //selecciono OT

      var id_ot = $('#otSelec').val();
      console.log("Id de ot es:");
      console.log(id_ot);
      console.log("Bandera que me indica que seleccione ot es:");
      console.log(opcot);
      calcular_orden(id_ot);

    }
    else {
      //selecciono nota
      if((opce ==0) && (opcf==0) && (opca==0) && (opcest==0) && (opcot==0) && (opcnot==6)){
        var id_not = $('#notSelec').val();
        console.log("Id de nota es:");
        console.log(id_not);
        console.log("Bandera que me indica que seleccione nota es:");
        console.log(opcnot);
        calcular_nota(id_not);
      }
    }
    /*---COMBINACION 1 -----*/
    //selecciono equipo y ot
    if((opce ==2) && (opcf==0) && (opca==0) && (opcest==0) && (opcot==5)){  

      var id_ot = $('#otSelec').val();
      console.log("Id de ot es:");
      console.log(id_ot);
      var id_eq = $('#equipSelec').val();
      console.log("Id de equipo es:");
      console.log(id_eq);

      console.log("Bandera que me indica que seleccione ot y equipo es:");
      console.log(opcot);
      console.log(id_eq);
     calcular_eqot(id_ot, id_eq);
     

    }
    //selecciono equipo y estado 
    if((opce ==2) &&  (opcest==4)){

      var id_est = $('#estSelec').val();
      var estado=$("select#estSelec option:selected").html();
      console.log("Id de estado es:");
      console.log(id_est);
      console.log("El nombre de estado es:");
      console.log(estado);
      var id_eq = $('#equipSelec').val();
      console.log("Id de equipo es:");
      console.log(id_eq);

      console.log("Bandera que me indica que seleccione estado y equipo es:");
      console.log(opcest);
      console.log(id_eq);
      if(estado=='ENTREGADO'){
        var vares='E';
      }
      else{
         if(estado=='PEDIDO'){
        var vares='P';
        }
      
      }
      calcular_eqest(vares, id_eq);

    }
    //selecciono equip y fecha //no funciona 
    if((opce ==2) &&  (opcf==3)){

      var fdesde = $('#desde').val();
      var fhasta=$('#hasta').val();
      console.log("las fechas seleccionadas son:");
      console.log(fdesde);
      console.log(fhasta);
      var id_eq = $('#equipSelec').val();
      console.log("Id de equipo es:");
      console.log(id_eq);

      console.log("Bandera que me indica que seleccione equipo y fecha es:");
      console.log(opcf);
      console.log(id_eq);
  
     calcular_eqfecha(fdesde,fhasta, id_eq);
 
    }
    //selecciono equipo y articulo

    if((opce ==2) && (opcf==0) && (opcest==0) && (opcot==0) && (opcnot==0) && (opca==1)){

      var id_art = $('#artSelec').val();
      
      console.log("Id de articulo es:");
      console.log(id_art);
      
      var id_eq = $('#equipSelec').val();
      console.log("Id de equipo es:");
      console.log(id_eq);

      console.log("Bandera que me indica que seleccione articulo y equipo es:");
      console.log(opca);
      console.log(id_art);
 
      //calcular_eqart(id_art, id_eq);

    }
    //seleccionar equipo y nota de pedido
  
});



  function limpCombo(){

  		$('.check').attr('checked',false);

      $("input.buscSector").attr("disabled", true);
	    $("input.buscSector").val('');
	    $("#idSector").val('');

	    $("select#equipSelec").attr("disabled", true);
	    $("select#equipSelec").val('');

      $("select#artSelec").attr("disabled", true);
      $("select#artSelec").val('');

	    $("input.fecha").attr("disabled", true);
	    $("input.fecha").val('');

      $("select#estSelec").attr("disabled", true);
      $("select#estSelec").val('');
  }

  function calcular_fecha(de, a){

    console.log("Esoty calculando fechas");
    console.log(de);
    console.log(a);

        $.ajax({    
            data:{
              de: de,
              a:a
            },
            type: 'POST',             
            dataType: 'json',
            url: 'index.php/Reportepedido/getfecha',                
            success: function(result){  
              console.log(result); 
              limpCombo();
              if(result !==0){

                 $("#tablaReportes").css("display", "block");//muestro tabla
                 $("#sales tbody tr").remove();//limpio tr de tabla 
                  for(var i=0; i <= result.length-1; i++){

                    if(result[i]['estdet']=='E'){
                      var e='Entregado';
                    }
                    else {
                      if(result[i]['estdet']=='P'){
                      var e='Pedido';
                      }
                    }

                    var diasSemana = new Array("Domingo","Lunes","Martes","Miércoles","Jueves","Viernes","Sábado");
                        fecha = new Date(result[i]['fechaEntrega']);
                        fecha2 = new Date(result[i]['fechaEntregado']);

                    var tr ="<tr>"+
                        "<td>"+result[i]['id_orden']+"</td>"+ 
                        "<td>"+result[i]['desot']+"</td>"+
                        "<td>"+result[i]['deta']+"</td>"+ 
                        "<td>"+result[i]['codigo']+"</td>"+ 
                        "<td>"+result[i]['artBarCode']+"</td>"+ 
                        "<td>"+result[i]['cantidad']+"</td>"+
                        "<td>"+result[i]['provnombre']+"</td>"+
                        "<td>"+ fecha.toLocaleDateString("es-ES", diasSemana)+"</td>"+
                        "<td>"+fecha2.toLocaleDateString("es-ES", diasSemana)+"</td>"+
                        "<td>"+e+"</td>"+
                        "</tr>";

                    $('#sales tbody').append(tr);
                  }
              }
              else 
                alert("Las fechas seleccionadas no se pueden filtrar, POR FAVOR seleccione otro rango de fecha");
                   
            },
            error: function(result){
                    limpCombo();                                            
                    alert("Error en consulta Ordenes");
            }
        });

  }

  function calcular_articulo(id_art){

    console.log("Esoty calculando articulo");
    console.log(id_art);
 
        $.ajax({    
            data:{
              id_art: id_art
            },
            type: 'POST',             
            dataType: 'json',
            url: 'index.php/Reportepedido/traerArticulo',                
            success: function(result){  
              console.log(result); 
              // console.log(result[0]['id_equipo']); 
              limpCombo();
                  if(result!==0){
         
                     $("#tablaReportes").css("display", "block");//muestro tabla
                     $("#sales tbody tr").remove();//limpio tr de tabla 
                      for(var i=0; i <= result.length-1; i++){

                         if(result[i]['estdet']=='E'){
                          var e='Entregado';
                        }
                        else {
                          if(result[i]['estdet']=='P'){
                          var e='Pedido';
                          }
                        }

                        var diasSemana = new Array("Domingo","Lunes","Martes","Miércoles","Jueves","Viernes","Sábado");
                        fecha = new Date(result[i]['fechaEntrega']);
                        fecha2 = new Date(result[i]['fechaEntregado']);

                         var tr ="<tr>"+
                        "<td>"+result[i]['id_orden']+"</td>"+ 
                        "<td>"+result[i]['desot']+"</td>"+
                        "<td>"+result[i]['deta']+"</td>"+ 
                        "<td>"+result[i]['codigo']+"</td>"+ 
                        "<td>"+result[i]['artBarCode']+"</td>"+ 
                        "<td>"+result[i]['cantidad']+"</td>"+
                        "<td>"+result[i]['provnombre']+"</td>"+
                        "<td>"+ fecha.toLocaleDateString("es-ES", diasSemana)+"</td>"+
                        "<td>"+fecha2.toLocaleDateString("es-ES", diasSemana)+"</td>"+
                        "<td>"+e+"</td>"+
                        "</tr>";
                      

                        $('#sales tbody').append(tr);
                      }
                  }
                    else 
                      alert("Este articulo no se puede filtrar , POR FAVOR seleccione otro articulo");
              
            },
            error: function(result){
                    limpCombo();
                    //WaitingClose();                                              
                    alert("Error en consulta Ordenes");
            }
        });
  }

  function calcular_estado(avestado){

    console.log("Estoy calculando estado");
    console.log(avestado);
     $.ajax({    
            data:{
              avestado: avestado
            },
            type: 'POST',             
            dataType: 'json',
            url: 'index.php/Reportepedido/calestado',                
            success: function(result){ 

                      console.log(result);             
                      limpCombo();
                      if(result!==0){
                        $("#sales tbody tr").remove();
                        $("#tablaReportes").css("display", "block");//muestro foto
                        for(var i=0; i <= result.length-1; i++){

                           if(result[i]['estdet']=='E'){
                            var e='Entregado';
                          }
                          else {
                            if(result[i]['estdet']=='P'){
                            var e='Pedido';
                            }
                          }

                          
                          var diasSemana = new Array("Domingo","Lunes","Martes","Miércoles","Jueves","Viernes","Sábado");
                          fecha = new Date(result[i]['fechaEntrega']);
                          fecha2 = new Date(result[i]['fechaEntregado']);

                          var tr ="<tr>"+
                                  "<td>"+result[i]['id_orden']+"</td>"+ 
                                  "<td>"+result[i]['desot']+"</td>"+
                                  "<td>"+result[i]['deta']+"</td>"+ 
                                  "<td>"+result[i]['codigo']+"</td>"+ 
                                  "<td>"+result[i]['artBarCode']+"</td>"+ 
                                  "<td>"+result[i]['cantidad']+"</td>"+
                                  "<td>"+result[i]['provnombre']+"</td>"+
                                  "<td>"+ fecha.toLocaleDateString("es-ES", diasSemana)+"</td>"+
                                  "<td>"+fecha2.toLocaleDateString("es-ES", diasSemana)+"</td>"+
                                  "<td>"+e+"</td>"+
                                  "</tr>";

                         $('#sales tbody').append(tr);
                        }
                      }
                      else 
                        alert("El dato que selecionado no se puede filtrar, POR FAVOR SELECCIONE OTRO ESTADO");
                    
            },
            error: function(result){
                    limpCombo();
                    WaitingClose();                                              
                    alert("Error en consulta estado");
            }
        });

  }
  function calcular_nota(id_not){

    console.log("Estoy calculando nota");
    console.log(id_not);
     $.ajax({    
            data:{
              id_not: id_not
            },
            type: 'POST',             
            dataType: 'json',
            url: 'index.php/Reportepedido/calnota',                
            success: function(result){ 

                      console.log(result);             
                      limpCombo();
                      if(result!==0){
                        $("#sales tbody tr").remove();
                        $("#tablaReportes").css("display", "block");//muestro foto
                        for(var i=0; i <= result.length-1; i++){

                           if(result[i]['estdet']=='E'){
                            var e='Entregado';
                          }
                          else {
                            if(result[i]['estdet']=='P'){
                            var e='Pedido';
                            }
                          }

                          
                          var diasSemana = new Array("Domingo","Lunes","Martes","Miércoles","Jueves","Viernes","Sábado");
                          fecha = new Date(result[i]['fechaEntrega']);
                          fecha2 = new Date(result[i]['fechaEntregado']);

                          var tr ="<tr>"+
                                  "<td>"+result[i]['id_orden']+"</td>"+ 
                                  "<td>"+result[i]['desot']+"</td>"+
                                  "<td>"+result[i]['deta']+"</td>"+ 
                                  "<td>"+result[i]['codigo']+"</td>"+ 
                                  "<td>"+result[i]['artBarCode']+"</td>"+ 
                                  "<td>"+result[i]['cantidad']+"</td>"+
                                  "<td>"+result[i]['provnombre']+"</td>"+
                                  "<td>"+ fecha.toLocaleDateString("es-ES", diasSemana)+"</td>"+
                                  "<td>"+fecha2.toLocaleDateString("es-ES", diasSemana)+"</td>"+
                                  "<td>"+e+"</td>"+
                                  "</tr>";

                         $('#sales tbody').append(tr);
                        }
                      }
                      else 
                        alert("El dato que selecionado no se puede filtrar, POR FAVOR SELECCIONE OTRO ESTADO");
                    
            },
            error: function(result){
                    limpCombo();
                    WaitingClose();                                              
                    alert("Error en consulta estado");
            }
        });
  }

  function veretado(nombre, est){

      console.log("El nombre del estado es:");
      console.log(nombre);
      console.log("El el id de estado es:");
      console.log(est);
       $.ajax({
                  //'data' : {id_sector : id },
                  'async': true,
                  'type': "POST",
                  'global': false,
                  'dataType': 'json',
                  'url': "Reportepedido/getestado",
                  'success': function (data) {
                    console.log("tengo los datos de la orden");
                    console.log(data);
                    console.log(data[0]['estado']); 
                    for (var i = 0; i < data.length-1; i++) {
                         if (data[i]['estadoid']==est){
                          avestado=data[i]['estado'];
                          calcular_estado(avestado);

                         }
                    
                    }


                   },
                  'error' : function (data){
                    console.log('Error en estado');
                    alert('error');
                   }

          });
  }
 
  function calcular_orden(id_ot){

    console.log("Esoty calculando OT");
    console.log(id_ot);
 
        $.ajax({    
            data:{
              id_ot: id_ot
            },
            type: 'POST',             
            dataType: 'json',
            url: 'index.php/Reportepedido/traerot',                
            success: function(result){  
              console.log(result); 
              // console.log(result[0]['id_equipo']); 
              limpCombo();
                  if(result!==0){
         
                     $("#tablaReportes").css("display", "block");//muestro tabla
                     $("#sales tbody tr").remove();//limpio tr de tabla 
                      for(var i=0; i <= result.length-1; i++){

                        if(result[i]['estdet']=='E'){
                          var e='Entregado';
                        }
                        else {
                          if(result[i]['estdet']=='P'){
                          var e='Pedido';
                          }
                        }

                        var diasSemana = new Array("Domingo","Lunes","Martes","Miércoles","Jueves","Viernes","Sábado");
                        fecha = new Date(result[i]['fechaEntrega']);
                        fecha2 = new Date(result[i]['fechaEntregado']);

                         var tr ="<tr>"+
                        "<td>"+result[i]['id_orden']+"</td>"+ 
                        "<td>"+result[i]['desot']+"</td>"+
                        "<td>"+result[i]['deta']+"</td>"+ 
                        "<td>"+result[i]['codigo']+"</td>"+ 
                        "<td>"+result[i]['artBarCode']+"</td>"+ 
                        "<td>"+result[i]['cantidad']+"</td>"+
                        "<td>"+result[i]['provnombre']+"</td>"+
                        "<td>"+ fecha.toLocaleDateString("es-ES", diasSemana)+"</td>"+
                        "<td>"+fecha2.toLocaleDateString("es-ES", diasSemana)+"</td>"+
                        "<td>"+e+"</td>"+
                        "</tr>";
                      

                        $('#sales tbody').append(tr);
                      }
                  }
                    else 
                      alert("Este articulo no se puede filtrar , POR FAVOR seleccione otro articulo");
              
            },
            error: function(result){
                    limpCombo();
                    //WaitingClose();                                              
                    alert("Error en consulta Ordenes");
            }
        });

  }
  function calcular_eqot(id_ot, id_eq){

    console.log("Esoty calculando OT y eq");
    console.log(id_ot);
    console.log(id_eq);
 
        $.ajax({    
            data:{
              id_ot: id_ot,
              id_eq:id_eq
            },
            type: 'POST',             
            dataType: 'json',
            url: 'index.php/Reportepedido/guardaroteq',                
            success: function(result){  
              console.log(result); 
              // console.log(result[0]['id_equipo']); 
              limpCombo();
                  if(result!==0){
         
                     $("#tablaReportes").css("display", "block");//muestro tabla
                     $("#sales tbody tr").remove();//limpio tr de tabla 
                      for(var i=0; i <= result.length-1; i++){

                        if(result[i]['estdet']=='E'){
                          var e='Entregado';
                        }
                        else {
                          if(result[i]['estdet']=='P'){
                          var e='Pedido';
                          }
                        }

                        var diasSemana = new Array("Domingo","Lunes","Martes","Miércoles","Jueves","Viernes","Sábado");
                        fecha = new Date(result[i]['fechaEntrega']);
                        fecha2 = new Date(result[i]['fechaEntregado']);

                         var tr ="<tr>"+
                        "<td>"+result[i]['id_orden']+"</td>"+ 
                        "<td>"+result[i]['desot']+"</td>"+
                        "<td>"+result[i]['deta']+"</td>"+ 
                        "<td>"+result[i]['codigo']+"</td>"+ 
                        "<td>"+result[i]['artBarCode']+"</td>"+ 
                        "<td>"+result[i]['cantidad']+"</td>"+
                        "<td>"+result[i]['provnombre']+"</td>"+
                        "<td>"+ fecha.toLocaleDateString("es-ES", diasSemana)+"</td>"+
                        "<td>"+fecha2.toLocaleDateString("es-ES", diasSemana)+"</td>"+
                        "<td>"+e+"</td>"+
                        "</tr>";
                      

                        $('#sales tbody').append(tr);
                      }
                  }
                    else 
                      alert("Este equipo y OT no se puede filtrar , POR FAVOR seleccione otro datos");
              
            },
            error: function(result){
                    limpCombo();
                    //WaitingClose();                                              
                    alert("Error en consulta Ordenes");
            }
        });



  }
  function   calcular_eqest(vares, id_eq){

    console.log("Esoty calculando esttado y eq");
    console.log(vares);
    console.log(id_eq);
 
        $.ajax({    
            data:{
              vares: vares,
              id_eq:id_eq
            },
            type: 'POST',             
            dataType: 'json',
            url: 'index.php/Reportepedido/guardarestaeq',                
            success: function(result){  
              console.log(result); 
              // console.log(result[0]['id_equipo']); 
              limpCombo();
                  if(result!==0){
         
                     $("#tablaReportes").css("display", "block");//muestro tabla
                     $("#sales tbody tr").remove();//limpio tr de tabla 
                      for(var i=0; i <= result.length-1; i++){

                        if(result[i]['estdet']=='E'){
                          var e='Entregado';
                        }
                        else {
                          if(result[i]['estdet']=='P'){
                          var e='Pedido';
                          }
                        }

                        var diasSemana = new Array("Domingo","Lunes","Martes","Miércoles","Jueves","Viernes","Sábado");
                        fecha = new Date(result[i]['fechaEntrega']);
                        fecha2 = new Date(result[i]['fechaEntregado']);

                         var tr ="<tr>"+
                        "<td>"+result[i]['id_orden']+"</td>"+ 
                        "<td>"+result[i]['desot']+"</td>"+
                        "<td>"+result[i]['deta']+"</td>"+ 
                        "<td>"+result[i]['codigo']+"</td>"+ 
                        "<td>"+result[i]['artBarCode']+"</td>"+ 
                        "<td>"+result[i]['cantidad']+"</td>"+
                        "<td>"+result[i]['provnombre']+"</td>"+
                        "<td>"+ fecha.toLocaleDateString("es-ES", diasSemana)+"</td>"+
                        "<td>"+fecha2.toLocaleDateString("es-ES", diasSemana)+"</td>"+
                        "<td>"+e+"</td>"+
                        "</tr>";
                      

                        $('#sales tbody').append(tr);
                      }
                  }
                    else 
                      alert("Este equipo y estado no se puede filtrar , POR FAVOR seleccione otros datos ");
              
            },
            error: function(result){
                    limpCombo();
                    //WaitingClose();                                              
                    alert("Error en consulta Ordenes");
            }
        });

  }
  function calcular_eqfecha(fdesde,fhasta, id_eq){

    console.log("Esoty calculando fechas y eq");
    console.log(fdesde);
    console.log(fhasta);
    console.log(id_eq);
 
        $.ajax({    
            data:{
              fdesde: fdesde,
              fhasta:fhasta,
              id_eq:id_eq
            },
            type: 'POST',             
            dataType: 'json',
            url: 'index.php/Reportepedido/guardareqfecha',                
            success: function(result){  
              console.log(result); 
              limpCombo();
                  if(result!==0){
         
                     $("#tablaReportes").css("display", "block");//muestro tabla
                     $("#sales tbody tr").remove();//limpio tr de tabla 
                      for(var i=0; i <= result.length-1; i++){

                        if(result[i]['estdet']=='E'){
                          var e='Entregado';
                        }
                        else {
                          if(result[i]['estdet']=='P'){
                          var e='Pedido';
                          }
                        }

                        var diasSemana = new Array("Domingo","Lunes","Martes","Miércoles","Jueves","Viernes","Sábado");
                        fecha = new Date(result[i]['fechaEntrega']);
                        fecha2 = new Date(result[i]['fechaEntregado']);

                         var tr ="<tr>"+
                        "<td>"+result[i]['id_orden']+"</td>"+ 
                        "<td>"+result[i]['desot']+"</td>"+
                        "<td>"+result[i]['deta']+"</td>"+ 
                        "<td>"+result[i]['codigo']+"</td>"+ 
                        "<td>"+result[i]['artBarCode']+"</td>"+ 
                        "<td>"+result[i]['cantidad']+"</td>"+
                        "<td>"+result[i]['provnombre']+"</td>"+
                        "<td>"+ fecha.toLocaleDateString("es-ES", diasSemana)+"</td>"+
                        "<td>"+fecha2.toLocaleDateString("es-ES", diasSemana)+"</td>"+
                        "<td>"+e+"</td>"+
                        "</tr>";
                      

                        $('#sales tbody').append(tr);
                      }
                  }
                    else 
                      alert("Este equipo y estado no se puede filtrar , POR FAVOR seleccione otros datos ");
              
            },
            error: function(result){
                    limpCombo();
                    //WaitingClose();                                              
                    alert("Error en consulta Ordenes");
            }
        });

  }
     


</script>
<!-- / Validacion de campos y Envio form -->


