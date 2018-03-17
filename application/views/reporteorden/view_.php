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
          <h3 class="box-title">Reporte de Orden de Trabajo</h3>
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
                    </br> 
                  </br>
                  <br>
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
                  <div class="form-group col-xs-4" size="27" >
                    <div class="checkbox" style="margin-left: 20px;">
                     <label>
                       <input type="checkbox" class="check" id="selestado">
                     </label>
                    </div>
                    <label for="estSelec" >Estado</label>
                      <select class="form-control" id="estSelec" placeholder="Seleccione tipo..." >
                        <option value=""></option>  
                         <option value="1">Curso</option> 
                         <option value="2">Asignadas</option>  
                         <option value="3">Terminadas</option> 
                         <option value="4">Entregadas</option>                 
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
                  </div> </br> 
                  <br>             
                  </br>                  
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
                <th style="text-align: center">Fecha</th>
                <th style="text-align: center">Fecha de Programacion</th>
                <th style="text-align: center">Fecha Terminacion</th>
                <th style="text-align: center">Fecha de Entregada </th>
                <th style="text-align: center">Origen</th>
                <th style="text-align: center">Estado</th>
              </tr>
            </thead>
            <tbody>
            </tbody>
            </table>    
        </div>
        <br>
        <br>
    
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
var opcest=0;
var avestado="";
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


</script>



<!-- Trae equipos p/ sector seleccionado -->
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
                  //alert('error');
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
                  //alert('error');
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
                'url': "Reportepedido/getestado",
                'success': function (data) {
                  console.log("tengo los datos de la orden");
                   console.log(data);
                    
                    var $select = $("#estSelec");

                    for (var i = 0; i < data.length; i++) {

                      $select.append($('<option />', { value: data[i]['estadoid'], text: data[i]['descripcion'] }));
                    }

                 },
                'error' : function (data){
                  console.log('Error en estado');
                  //alert('error');
                 }

        });
      });



</script>

<!-- Validacion de campos y Envio form -->
<script> 
 $("#consulta").click(function(evento){
    evento.preventDefault();
  
    // var id_eq = $('#equipSelec').val();
    
    // console.log("Id de equipo es:");
    // console.log(id_eq);
    // console.log("Bandera que me indica que seleccione equipo es:")
    // console.log(opce);
   

    $("#tablaReportes").css("display", "block");//muestro tabla
    $("#sales tbody tr").remove();//limpio tr de tabla 
    //seleccione equipo
    if(opce ==2){ 

      var id_eq = $('#equipSelec').val();
      console.log("selecciono equipo");
      console.log(id_eq);
      console.log("Bandera que me indica que seleccione equipo es:")
      console.log(opce);
    
      // console.log("Id de equipo es:");
   
        $.ajax({    
            data:{
              id_eq: id_eq
            },
            type: 'POST',             
            dataType: 'json',
            url: 'index.php/Reporteorden/getequipo',                
            success: function(result){  
            console.log(result); 
            // console.log(result[0]['id_equipo']); 
                    limpCombo();
                    if(result !==0){

                   
                      for(var i=0; i <= result.length-1; i++){

                        if(result[i]['estadoeq']=='AC'){
                          var e='Activo';
                        }
                        else {
                          if(result[i]['estadoeq']=='IN'){
                          var e='Inactivo';
                          }
                        }
                        if(result[i]['estadoeq']=='RE'){
                          var e='Reparacion';
                        }
                        else {
                          if(result[i]['estadoeq']=='AN'){
                          var e='Anulado';
                          }
                        }
                        var diasSemana = new Array("Domingo","Lunes","Martes","Miércoles","Jueves","Viernes","Sábado");
                        fecha = new Date(result[i]['fecha_inicio']);
                        fecha2 = new Date(result[i]['fecha_entrega']);
                        fecha3 = new Date(result[i]['fecha_terminada']);
                        fecha4 = new Date(result[i]['fecha_entregada']);



                         var tr ="<tr>"+
                        "<td>"+result[i]['id_orden']+"</td>"+ 
                        "<td>"+result[i]['desot']+"</td>"+
                        "<td>"+result[i]['det']+"</td>"+ 
                        "<td>"+result[i]['codigo']+"</td>"+ 
                        "<td>"+ fecha.toLocaleDateString("es-ES", diasSemana)+"</td>"+
                        "<td>"+fecha2.toLocaleDateString("es-ES", diasSemana)+"</td>"+
                        "<td>"+fecha3.toLocaleDateString("es-ES", diasSemana)+"</td>"+
                        "<td>"+fecha4.toLocaleDateString("es-ES", diasSemana)+"</td>"+
                        "<td>"+result[i]['destipo']+"</td>"+
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
                   //alert("Error en consulta Ordenes");
            }
        });
    }
    //seleccionar estado 
    if((opce ==0) && (opcf==0) && (opcest==4)){

        var est = $('#estSelec').val();
        var nombre =$("select#estSelec option:selected").html();

        console.log("Id de estado es:");
        console.log(est);
        console.log(nombre);
        console.log("Bandera que me indica que seleccione estado es:")
        console.log(opcest);
         //1- Entregado, 2- Pedido
        veretado(nombre, est);
      }

    //     var est = $('#estSelec').val();
    //     var nombre =$("select#estSelec option:selected").html();

    //     console.log("Id de estado es:");
    //     console.log(est);
    //     console.log(nombre);
    //     console.log("Bandera que me indica que seleccione estado es:")
    //     console.log(opcest);
    //     //1- Entregado, 2- Pedido
    //     veretado(nombre, est);
       
    //   }
    // }
    // else {
    //   if((opce ==0) && (opcf==3)){ //selecciono fecha

    //     console.log("Seleccione las fechas");
    //     var de = $('#desde').val();
    //     var a = $('#hasta').val();  
    //     console.log(de);
    //     console.log(a);
    //     console.log("Bandera que me indica, que seleccione fecha:");
    //     console.log(opcf);
    //     calcular_fecha(de,a);
    

    //   }
    // }
    // if((opce ==0) && (opcf==0) && (opca==1)){ //seleccione articulo

    //   var id_art = $('#artSelec').val();
    //   console.log("Id de articulo es:");
    //   console.log(id_art);
    //   console.log("Bandera que me indica que seleccione articulo es:")
    //   console.log(opca);
    //   calcular_articulo(id_art);

    // }
    // else{

    //   if((opce ==0) && (opcf==0) && (opca==0) && (opcest==4)){

    //     var est = $('#estSelec').val();
    //     var nombre =$("select#estSelec option:selected").html();

    //     console.log("Id de estado es:");
    //     console.log(est);
    //     console.log(nombre);
    //     console.log("Bandera que me indica que seleccione estado es:")
    //     console.log(opcest);
    //     //1- Entregado, 2- Pedido
    //     veretado(nombre, est);
       
    //   }
    // }
    if((opce ==0) && (opcf==0) && (opcest==0) && (opcot==5)){ //selecciono OT

      var id_ot = $('#otSelec').val();
      console.log("Id de ot es:");
      console.log(id_ot);
      console.log("Bandera que me indica que seleccione ot es:")
      console.log(opcot);
      calcular_orden(id_ot);

    }

    // if((opce ==2) && (opcf==0) && (opca==0) && (opcest==0) && (opcot==5)){ //selecciono equipo y ot 

    //   var id_ot = $('#otSelec').val();
    //   console.log("Id de ot es:");
    //   console.log(id_ot);
    //   var id_eq = $('#equipSelec').val();
    //   console.log("Id de equipo es:");
    //   console.log(id_eq);

    //   console.log("Bandera que me indica que seleccione ot y equipo es:")
    //   console.log(opcot);
    //   console.log(id_eq);
    //  calcular_eqot(id_ot, id_eq);
     

    // }

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

  // function calcular_fecha(de, a){

  //   console.log("Esoty calculando fechas");
  //   console.log(de);
  //   console.log(a);

  //       $.ajax({    
  //           data:{
  //             de: de,
  //             a:a
  //           },
  //           type: 'POST',             
  //           dataType: 'json',
  //           url: 'index.php/Reportepedido/getfecha',                
  //           success: function(result){  
  //             console.log(result); 
  //             limpCombo();
  //             if(result !==0){

  //                $("#tablaReportes").css("display", "block");//muestro tabla
  //                $("#sales tbody tr").remove();//limpio tr de tabla 
  //                 for(var i=0; i <= result.length-1; i++){

  //                   if(result[i]['estdet']=='E'){
  //                     var e='Entregado';
  //                   }
  //                   else {
  //                     if(result[i]['estdet']=='P'){
  //                     var e='Pedido';
  //                     }
  //                   }

  //                   var diasSemana = new Array("Domingo","Lunes","Martes","Miércoles","Jueves","Viernes","Sábado");
  //                       fecha = new Date(result[i]['fechaEntrega']);
  //                       fecha2 = new Date(result[i]['fechaEntregado']);

  //                   var tr ="<tr>"+
  //                       "<td>"+result[i]['id_orden']+"</td>"+ 
  //                       "<td>"+result[i]['desot']+"</td>"+
  //                       "<td>"+result[i]['deta']+"</td>"+ 
  //                       "<td>"+result[i]['codigo']+"</td>"+ 
  //                       "<td>"+result[i]['artBarCode']+"</td>"+ 
  //                       "<td>"+result[i]['cantidad']+"</td>"+
  //                       "<td>"+result[i]['provnombre']+"</td>"+
  //                       "<td>"+ fecha.toLocaleDateString("es-ES", diasSemana)+"</td>"+
  //                       "<td>"+fecha2.toLocaleDateString("es-ES", diasSemana)+"</td>"+
  //                       "<td>"+e+"</td>"+
  //                       "</tr>";

  //                   $('#sales tbody').append(tr);
  //                 }
  //             }
  //             else 
  //               alert("Las fechas seleccionadas no se pueden filtrar, POR FAVOR seleccione otro rango de fecha");
                   
  //           },
  //           error: function(result){
  //                   limpCombo();                                            
  //                   alert("Error en consulta Ordenes");
  //           }
  //       });

  // }

  // function calcular_articulo(id_art){

  //   console.log("Esoty calculando articulo");
  //   console.log(id_art);
 
  //       $.ajax({    
  //           data:{
  //             id_art: id_art
  //           },
  //           type: 'POST',             
  //           dataType: 'json',
  //           url: 'index.php/Reportepedido/traerArticulo',                
  //           success: function(result){  
  //             console.log(result); 
  //             // console.log(result[0]['id_equipo']); 
  //             limpCombo();
  //                 if(result!==0){
         
  //                    $("#tablaReportes").css("display", "block");//muestro tabla
  //                    $("#sales tbody tr").remove();//limpio tr de tabla 
  //                     for(var i=0; i <= result.length-1; i++){

  //                        if(result[i]['estdet']=='E'){
  //                         var e='Entregado';
  //                       }
  //                       else {
  //                         if(result[i]['estdet']=='P'){
  //                         var e='Pedido';
  //                         }
  //                       }

  //                       var diasSemana = new Array("Domingo","Lunes","Martes","Miércoles","Jueves","Viernes","Sábado");
  //                       fecha = new Date(result[i]['fechaEntrega']);
  //                       fecha2 = new Date(result[i]['fechaEntregado']);

  //                        var tr ="<tr>"+
  //                       "<td>"+result[i]['id_orden']+"</td>"+ 
  //                       "<td>"+result[i]['desot']+"</td>"+
  //                       "<td>"+result[i]['deta']+"</td>"+ 
  //                       "<td>"+result[i]['codigo']+"</td>"+ 
  //                       "<td>"+result[i]['artBarCode']+"</td>"+ 
  //                       "<td>"+result[i]['cantidad']+"</td>"+
  //                       "<td>"+result[i]['provnombre']+"</td>"+
  //                       "<td>"+ fecha.toLocaleDateString("es-ES", diasSemana)+"</td>"+
  //                       "<td>"+fecha2.toLocaleDateString("es-ES", diasSemana)+"</td>"+
  //                       "<td>"+e+"</td>"+
  //                       "</tr>";
                      

  //                       $('#sales tbody').append(tr);
  //                     }
  //                 }
  //                   else 
  //                     alert("Este articulo no se puede filtrar , POR FAVOR seleccione otro articulo");
              
  //           },
  //           error: function(result){
  //                   limpCombo();
  //                   //WaitingClose();                                              
  //                   alert("Error en consulta Ordenes");
  //           }
  //       });
  // }

  // function calcular_estado(avestado){

  //   console.log("Estoy calculando estado");
  //   console.log(avestado);
  //    $.ajax({    
  //           data:{
  //             avestado: avestado
  //           },
  //           type: 'POST',             
  //           dataType: 'json',
  //           url: 'index.php/Reportepedido/calestado',                
  //           success: function(result){ 

  //                     console.log(result);             
  //                     limpCombo();
  //                     if(result!==0){
  //                       $("#sales tbody tr").remove();
  //                       $("#tablaReportes").css("display", "block");//muestro foto
  //                       for(var i=0; i <= result.length-1; i++){

  //                          if(result[i]['estdet']=='E'){
  //                           var e='Entregado';
  //                         }
  //                         else {
  //                           if(result[i]['estdet']=='P'){
  //                           var e='Pedido';
  //                           }
  //                         }

                          
  //                         var diasSemana = new Array("Domingo","Lunes","Martes","Miércoles","Jueves","Viernes","Sábado");
  //                         fecha = new Date(result[i]['fechaEntrega']);
  //                         fecha2 = new Date(result[i]['fechaEntregado']);

  //                         var tr ="<tr>"+
  //                                 "<td>"+result[i]['id_orden']+"</td>"+ 
  //                                 "<td>"+result[i]['desot']+"</td>"+
  //                                 "<td>"+result[i]['deta']+"</td>"+ 
  //                                 "<td>"+result[i]['codigo']+"</td>"+ 
  //                                 "<td>"+result[i]['artBarCode']+"</td>"+ 
  //                                 "<td>"+result[i]['cantidad']+"</td>"+
  //                                 "<td>"+result[i]['provnombre']+"</td>"+
  //                                 "<td>"+ fecha.toLocaleDateString("es-ES", diasSemana)+"</td>"+
  //                                 "<td>"+fecha2.toLocaleDateString("es-ES", diasSemana)+"</td>"+
  //                                 "<td>"+e+"</td>"+
  //                                 "</tr>";

  //                        $('#sales tbody').append(tr);
  //                       }
  //                     }
  //                     else 
  //                       alert("El dato que selecionado no se puede filtrar, POR FAVOR SELECCIONE OTRO ESTADO");
                    
  //           },
  //           error: function(result){
  //                   limpCombo();
  //                   WaitingClose();                                              
  //                   alert("Error en consulta estado");
  //           }
  //       });

  // }

  function veretado(nombre, est){

      console.log("El nombre del estado es:");
      console.log(nombre);
      console.log("El el id de estado es:");
      console.log(est);
       if(result!==0){

       $("#tablaReportes").css("display", "block");//muestro tabla
       $("#sales tbody tr").remove();//limpio tr de tabla 
       for(var i=0; i <= result.length-1; i++){

          if(result[i]['estadoeq']=='C'){
            var e='Curso';
          }
          else {
            if(result[i]['estadoeq']=='T'){
            var e='Terminadas';
            }
          }
          if(result[i]['estadoeq']=='AS'){
            var e='Asignadas';
          }
          else {
            if(result[i]['estadoeq']=='P'){
            var e='Pedido';
            }
          }
          var diasSemana = new Array("Domingo","Lunes","Martes","Miércoles","Jueves","Viernes","Sábado");
          fecha = new Date(result[i]['fecha_inicio']);
          fecha2 = new Date(result[i]['fecha_entrega']);
          fecha3 = new Date(result[i]['fecha_terminada']);
          fecha4 = new Date(result[i]['fecha_entregada']);



           var tr ="<tr>"+
          "<td>"+result[i]['id_orden']+"</td>"+ 
          "<td>"+result[i]['desot']+"</td>"+
          "<td>"+result[i]['det']+"</td>"+ 
          "<td>"+result[i]['codigo']+"</td>"+ 
          "<td>"+ fecha.toLocaleDateString("es-ES", diasSemana)+"</td>"+
          "<td>"+fecha2.toLocaleDateString("es-ES", diasSemana)+"</td>"+
          "<td>"+fecha3.toLocaleDateString("es-ES", diasSemana)+"</td>"+
          "<td>"+fecha4.toLocaleDateString("es-ES", diasSemana)+"</td>"+
          "<td>"+result[i]['destipo']+"</td>"+
          "<td>"+e+"</td>"+
          
          "</tr>";
        

          $('#sales tbody').append(tr);
        }
      }
      else 
        alert("Esta OT no se puede filtrar, POR FAVOR SELCCIONO OTRA OT ");
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
            url: 'index.php/Reporteorden/traerot',                
            success: function(result){  
              console.log(result); 
              // console.log(result[0]['id_equipo']); 
              limpCombo();
                  if(result!==0){
         
                     $("#tablaReportes").css("display", "block");//muestro tabla
                     $("#sales tbody tr").remove();//limpio tr de tabla 
                     for(var i=0; i <= result.length-1; i++){

                        if(result[i]['estadoeq']=='C'){
                          var e='Curso';
                        }
                        else {
                          if(result[i]['estadoeq']=='IN'){
                          var e='Inactivo';
                          }
                        }
                        if(result[i]['estadoeq']=='RE'){
                          var e='Reparacion';
                        }
                        else {
                          if(result[i]['estadoeq']=='AN'){
                          var e='Anulado';
                          }
                        }
                        var diasSemana = new Array("Domingo","Lunes","Martes","Miércoles","Jueves","Viernes","Sábado");
                        fecha = new Date(result[i]['fecha_inicio']);
                        fecha2 = new Date(result[i]['fecha_entrega']);
                        fecha3 = new Date(result[i]['fecha_terminada']);
                        fecha4 = new Date(result[i]['fecha_entregada']);



                         var tr ="<tr>"+
                        "<td>"+result[i]['id_orden']+"</td>"+ 
                        "<td>"+result[i]['desot']+"</td>"+
                        "<td>"+result[i]['det']+"</td>"+ 
                        "<td>"+result[i]['codigo']+"</td>"+ 
                        "<td>"+ fecha.toLocaleDateString("es-ES", diasSemana)+"</td>"+
                        "<td>"+fecha2.toLocaleDateString("es-ES", diasSemana)+"</td>"+
                        "<td>"+fecha3.toLocaleDateString("es-ES", diasSemana)+"</td>"+
                        "<td>"+fecha4.toLocaleDateString("es-ES", diasSemana)+"</td>"+
                        "<td>"+result[i]['destipo']+"</td>"+
                        "<td>"+e+"</td>"+
                        
                        "</tr>";
                      

                        $('#sales tbody').append(tr);
                      }
                    }
                    else 
                      alert("Esta OT no se puede filtrar, POR FAVOR SELCCIONO OTRA OT ");
              
            },
            error: function(result){
                    limpCombo();
                    //WaitingClose();                                              
                    alert("Error en consulta Ordenes");
            }
        });

  }
  // function calcular_eqot(id_ot, id_eq){

  //   console.log("Esoty calculando OT y eq");
  //   console.log(id_ot);
  //   console.log(id_eq);
 
  //       $.ajax({    
  //           data:{
  //             id_ot: id_ot,
  //             id_eq:id_eq
  //           },
  //           type: 'POST',             
  //           dataType: 'json',
  //           url: 'index.php/Reportepedido/guardaroteq',                
  //           success: function(result){  
  //             console.log(result); 
  //             // console.log(result[0]['id_equipo']); 
  //             limpCombo();
  //                 // if(result!==0){
         
  //                 //    $("#tablaReportes").css("display", "block");//muestro tabla
  //                 //    $("#sales tbody tr").remove();//limpio tr de tabla 
  //                 //     for(var i=0; i <= result.length-1; i++){

  //                 //       if(result[i]['estdet']=='E'){
  //                 //         var e='Entregado';
  //                 //       }
  //                 //       else {
  //                 //         if(result[i]['estdet']=='P'){
  //                 //         var e='Pedido';
  //                 //         }
  //                 //       }

  //                 //       var diasSemana = new Array("Domingo","Lunes","Martes","Miércoles","Jueves","Viernes","Sábado");
  //                 //       fecha = new Date(result[i]['fechaEntrega']);
  //                 //       fecha2 = new Date(result[i]['fechaEntregado']);

  //                 //        var tr ="<tr>"+
  //                 //       "<td>"+result[i]['id_orden']+"</td>"+ 
  //                 //       "<td>"+result[i]['desot']+"</td>"+
  //                 //       "<td>"+result[i]['deta']+"</td>"+ 
  //                 //       "<td>"+result[i]['codigo']+"</td>"+ 
  //                 //       "<td>"+result[i]['artBarCode']+"</td>"+ 
  //                 //       "<td>"+result[i]['cantidad']+"</td>"+
  //                 //       "<td>"+result[i]['provnombre']+"</td>"+
  //                 //       "<td>"+ fecha.toLocaleDateString("es-ES", diasSemana)+"</td>"+
  //                 //       "<td>"+fecha2.toLocaleDateString("es-ES", diasSemana)+"</td>"+
  //                 //       "<td>"+e+"</td>"+
  //                 //       "</tr>";
                      

  //                 //       $('#sales tbody').append(tr);
  //                 //     }
  //                 // }
  //                 //   else 
  //                 //     alert("Este articulo no se puede filtrar , POR FAVOR seleccione otro articulo");
              
  //           },
  //           error: function(result){
  //                   limpCombo();
  //                   //WaitingClose();                                              
  //                   alert("Error en consulta Ordenes");
  //           }
  //       });



  // }
     


</script>
<!-- / Validacion de campos y Envio form -->


