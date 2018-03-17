﻿<input type="hidden" id="permission" value="<?php echo $permission;?>">
<section class="content">
  <div class="row">
    <div class="col-xs-12">
      <div class="box">
        <div class="box-header">
          <h3 class="box-title">Orden de trabajo</h3>
          <?php
          if (strpos($permission,'Add') !== false) {
            echo '<button class="btn btn-block btn-success" style="width: 100px; margin-top: 10px;"  data-toggle="modal" data-target="#modalagregar" id="btnAdd">Agregar</button>'; 
          }
          ?>
        </div><!-- /.box-header -->
        <div class="box-body">
          <table id="otrabajo" class="table table-bordered table-hover">
            <thead>
              <tr>
                <th width="15%">Acciones</th>
                <th>Id</th>
     
                <th>Fecha</th>
                <th>Fecha Entrega</th>
                <th>Fecha Terminada </th>
                <th>Detalle </th>
                <th>Equipo </th>
                <th>Solicita </th>
                <th>Asignado </th>
                <th>Estado </th>

              </tr>
            </thead>
            <tbody>
              <?php

              //dump_exit($list);


                if(count($list) > 0) { 


                  $userdata = $this->session->userdata('user_data');
                  $usrId= $userdata[0]['usrId']; 

               	  foreach($list as $a){
                  
                    $gr=$a['grpId'];
                    //echo "grupo";
                    //echo $gr;
                    if($gr=='1') { 

                 
                                         
                       if (($a['estado'] =='As') || ($a['estado'] =='P') || ($a['estado'] =='C')) {
                     
                        $id=$a['id_orden'];
                        $id_equipo = $a['id_equipo'];
                        $causa = $a['descripcion'];

                        echo '<tr id="'.$id.'" class="'.$id.'" data-id_equipo="'.$id_equipo.'" data-causa="'.$causa.'" >';
      	                echo '<td>';

                        if (strpos($permission,'Del') !== false) {
                          echo '<i class="fa fa-fw fa-times-circle" style="color: #A4A4A4; cursor: pointer; margin-left: 15px;" title="Eliminar" data-toggle="modal" data-target="#modalaviso"></i>';
                           echo '<i class="fa fa-fw fa-print" style="color: #A4A4A4; cursor: pointer; margin-left: 15px;" title="Imprimir"  ></i> '; 
                        }
                       

                        if (strpos($permission,'Edit') !== false) {
      	                	echo '<i class="fa fa-fw fa-pencil" style="color: #A4A4A4; cursor: pointer; margin-left: 15px;" title="Editar" data-toggle="modal" data-target="#modaleditar" ></i>';
                          
                          echo '<i class="fa fa-check-square-o" style="color:#A4A4A4; cursor: pointer; margin-left: 15px;"  title="Asignar tarea " id="btnAddtarea"></i>';
                        }
                      
                        if (strpos($permission,'Asignar') !== false) {
                          echo '<i class="fa fa-thumb-tack " style="color: #A4A4A4; cursor: pointer; margin-left: 15px;" title="Asignar OT" data-toggle="modal" data-target="#modalAsig" ></i>';
                         
                        }

                        if (strpos($permission,'OP') !== false) {
                          echo '<i class="fa fa-tags" style="color: #A4A4A4; cursor: pointer; margin-left: 15px;"  title="Cargar Pedido " data-toggle="modal" data-target="#modalpedido"></i>';
                        }

                        if (strpos($permission,'Pedidos') !== false) {
                          echo '<i class="fa fa-truck" style="color: #A4A4A4; cursor: pointer; margin-left: 15px;"  title="Mostrar Perdido " data-toggle="modal" data-target="#modallista"></i>';
                                              
                         
                        }

                        if(($a['estado'] == 'As' || $a['estado'] == 'P') && ($a['id_usuario_a'] == $usrId)){
                        //if($a['estado'] == 'As' ){
                          echo '<i  href="#"class="fa fa-fw fa fa-toggle-on" style="color: #A4A4A4; cursor: pointer; margin-left: 15px;" title="Finalizar Orden" data-toggle="modal" data-target="#modalfinalizar"></i>';
                        }

                        //// GENERA INFORME DE SERVICIOS
                        if (strpos($permission,'Del') !== false) {
                          echo '<i class="fa fa-sticky-note-o" id="cargOrden" style="color: #A4A4A4; cursor: pointer; margin-left: 15px;" title="Informe de Servicios" ></i>';
                        }
                            
      	                echo '</td>';
                        echo '<td style="text-align: right">'.$a['id_orden'].'</td>';
                       
      	                echo '<td style="text-align: left">'.date_format(date_create($a['fecha_inicio']), 'd-m-Y').'</td>';
                        echo '<td style="text-align: right">'.date_format(date_create($a['fecha_entrega']), 'd-m-Y').'</td>';
                        echo '<td style="text-align: right">'.date_format(date_create($a['fecha_terminada']), 'd-m-Y').'</td>';
                        echo '<td style="text-align: right">'.$a['descripcion'].'</td>';
                        // echo '<td style="text-align: left">'.$a['cliLastName'].' , '.$a['cliName'].'</td>';
                        echo '<td style="text-align: left">'.$a['codigo'].' </td>';
                        echo '<td style="text-align: right">'.$a['usrName'].'</td>';
                        echo '<td style="text-align: right">'.$a['nombre'].'</td>';
                        echo '<td style="text-align: center">'.($a['estado'] == 'C' ? '<small class="label pull-left bg-green">Curso</small>' : ($a['estado'] == 'P' ? '<small class="label pull-left bg-red">Pedido</small>' : '<small class="label pull-left bg-yellow">Asignado</small>')).'</td>';
      	                echo '</tr>';
                      
        		          }

                    }   

                             
                  }
                }
              ?>
            </tbody>
          </table>
        </div><!-- /.box-body -->
      </div><!-- /.box -->
    </div><!-- /.col -->
  </div><!-- /.row -->
</section><!-- /.content -->

<script>
var iort= "";
var ido ="";
var idp ="";
var idArt = 0;
var acArt = '';
var i ="";
var idord ="";
var idfin= "";
$(document).ready(function(event) {
  
  //Al apretar la opcion asignar tareas , esto lleva a esa pantalla, esto es lo que hay q cambiar para subir
  $(".fa-check-square-o").click(function (e) { 
    var id = $(this).parent('td').parent('tr').attr('id');
    console.log("El id de OT es:");
    console.log(id);
    iort= id;
    WaitingOpen();
    $('#content').empty();
    $("#content").load("<?php echo base_url(); ?>index.php/Otrabajo/cargartarea/<?php echo $permission; ?>/"+iort+"");
    WaitingClose();  
  });
   //Asignar OT/ aca traigo los datos a mostrar en el modal  
  $(".fa-thumb-tack").click(function (e) { 
          
   // $('#modalAsig').modal('show');
    var id_orden = $(this).parent('td').parent('tr').attr('id');  
    console.log("El id de orden es:");
    console.log(id_orden);    
    traer_usuario();
    $.ajax({
        type: 'GET',
        data: { id_orden: id_orden},
        url: 'index.php/Otrabajo/getasigna', 
        success: function(data){
                
                console.log(data);
                datos={
                  'id_orden':id_orden,
                  'nro':data['datos'][0]['nro'],
                  'fecha_inicio':data['datos'][0]['fecha_inicio'],
                  'estado':data['datos'][0]['estado'],
                  'descripcion':data['datos'][0]['descripcion'],
                  'equipo': data['datos'][0]['codigo'],
                  
                 

                };

                var arre = new Array();
                arre=datos['fecha_inicio'].split(' ');
                //var fe= date_format(date_create(arre[0]), 'd-m-Y');

                $('#id_orden').val(datos['id_orden']);
                $('#nro').val(datos['nro']);
                $('#fecha_inicio').val(arre[0]); 
                $('#estado').val(datos['estado']);
                $('#equipo1').val(datos['equipo']);
                
                $('#descripcion').val(datos['descripcion']);
                
                //traerUsuario(); 
               // click_pedent();
               
              },
          
        error: function(result){
              
              console.log(result);
            },
            dataType: 'json'
      }); 
   

  });

   //cargar pedido
  $(".fa-tags").click(function (e) { 

    var id_orden = $(this).parent('td').parent('tr').attr('id');
    ido=id_orden; //aca esta el id de orden de trabajo
    console.log("El id de orden para la carga de pedido es :");
    console.log(ido);
    i=1;
    var opcion =i; 
    $('#num1').append(opcion);
    i=i+1; 
    traer_proveedor();
    
  });


  $(".fa-truck").click(function (e) { 

   $("#modallista tbody tr").remove();
    var idorde = $(this).parent('td').parent('tr').attr('id');
    
    //idord= idorde;
    console.log("ID de orden de trabajo para mostrar pedido es :");
    console.log(idorde);    
    $.ajax({
        type: 'POST',
        data: { idorde:idorde},
        url: 'index.php/Otrabajo/getmostrar', //index.php/
          success: function(data){
            console.log("llego el detalle");
            console.log(data);
           
            for (var i = 0; i < data.length; i++) {

              if (data[i]['estado']== 'P'){
              var estado= '<small class="label pull-left bg-green">Pedido</small>';
              }
              else 
                if (data[i]['estado']== 'C'){
                var estado= '<small class="label pull-left bg-blue">Curso</small>';
                }
                else
                  if (data[i]['estado']== 'E'){ 
                  var estado= '<small class="label pull-left bg-red">Entregado</small>';
                  }
                    else{ 
                      var estado= '<small class="label pull-left bg-yellow">Terminado</small>';
                    }
              var tr = "<tr >"+
                      "<td ></td>"+
                      "<td>"+data[i]['nro_trabajo']+"</td>"+
                      "<td>"+data[i]['fecha']+"</td>"+
                      "<td>"+data[i]['fecha_entrega']+"</td>"+
                      "<td>"+data[i]['provnombre']+"</td>"+
                      "<td>"+data[i]['descripcion']+"</td>"+
                      "<td>"+estado+"</td>"+
                      "</tr>";
              $('#tabladetalle tbody').append(tr);

            }
            console.log(tr);

          },
            
          error: function(result){
                console.log("Entro x el error de detalle");
                
                console.log(result);
              },
              dataType: 'json'
    });
    
  });

  $('#btnSave').click(function(){

      if(acArt == 'View')
      {
        $('#modalOT').modal('hide');
        return;
      }

      var hayError = false;
      if($('#nro').val() == '')
      {
        hayError = true;
      }

      if($('#vfech').val() == '')
      {
        hayError = true;
      }

      if($('#vsdetalle').val() == '')
      {
        hayError = true;
      }

      if($('#sucid').val() == '')
      {
        hayError = true;
      }

     


      $('#error').fadeOut('slow');
      WaitingOpen('Guardando cambios');
        $.ajax({
              type: 'POST',
              data: { 
                      id : idArt, 
                      act: acArt, 
                      nro: $('#nro').val(),
                      fech: $('#vfech').val(),
                      deta: $('#vsdetalle').val(),
                      sucid: $('#sucid').val(),
                      cli: $('#cliid').val()
                      
                    },
          url: 'index.php/Otrabajo/setotrabajo', 
          success: function(result){
                        WaitingClose();
                        //$('#modalOT').modal('hide');
                        //setTimeout("cargarView('otrabajos', 'index', '"+$('#permission').val()+"');",1000);
                        regresa1();
                },
          error: function(result){
                WaitingClose();
                alert("error");
              },
              dataType: 'json'
          });
  });

    //Eliminar
  $(".fa-times-circle").click(function (e) { 
                 
    var ido = $(this).parent('td').parent('tr').attr('id');
    console.log("ESTOY ELIMINANDO , el id de orden es:");
    console.log(ido);
    gloid=ido;
                                
  }); 
var origen="";
  $(".fa-print").click(function (e) {

        e.preventDefault();
        var ido = $(this).parent('td').parent('tr').attr('id');
        console.log("El id de orden al imprimir es :");
        console.log(ido);
        

        $.ajax({
              type: 'POST',
              data: { ido: ido},
              url: 'index.php/Otrabajo/getprint', //index.php/
              success: function(data){
                   
                    console.log("Entre a la impresion");
                    console.log(data);
                    // console.log(data.datos.codigo);
                     console.log(data[0]['codigo']);
                    // console.log(data.equipos.asegurado);
                    // console.log(data.orden.nombre);

                    var fecha = new Date(data[0]['fecha']);
                    var day = fecha.getDate();
                    var month = fecha.getMonth();
                    var year = fecha.getUTCFullYear();
                    fecha = day + '-' + (month+1) + '-' + year;
                    //data.equipos.fecha_vigencia
                    //data.equipos.fecha_inicio
                    var fechapro = new Date(data[0]['fecha_program']);
                    var day = fechapro.getDate();
                    var month = fechapro.getMonth();
                    var year = fechapro.getUTCFullYear();
                    fechapro = day + '-' + (month+1) + '-' + year;

                    var fechaent = new Date(data[0]['fecha_entrega']);
                    var day = fechaent.getDate();
                    var month = fechaent.getMonth();
                    var year = fechaent.getUTCFullYear();
                    fechaent = day + '-' + (month+1) + '-' + year;

                    var fechater = new Date(data[0]['fecha_terminada']);
                    var day = fechater.getDate();
                    var month = fechater.getMonth();
                    var year = fechater.getUTCFullYear();
                    fechater = day + '-' + (month+1) + '-' + year;

                    var fechaentregada = new Date(data[0]['fecha_entregada']);
                    var day = fechaentregada.getDate();
                    var month = fechaentregada.getMonth();
                    var year = fechaentregada.getUTCFullYear();
                    fechaentregada = day + '-' + (month+1) + '-' + year;
                    
                    if(data[0]['id']==1){
                      origen='OT';

                    }
                    else{
                      if(data[0]['id']==2){
                      origen='Solicitud de Servicio';
                      }

                    }
                     if(data[0]['id']==3){
                      origen='Preventivo';

                    }
                    else{
                      if(data[0]['id']==4){
                      origen='Backlog';
                      }
                     
                    }
                     if(data[0]['id']==5){
                      origen='Predictivo';

                    }
                    else{
                      if(data[0]['id']==6){
                      origen='Correctivo Programado';
                      }
                     
                    }

                     var  texto =

                                '<div class="" id="vistaimprimir">'+
                                  '<div class="container">'+
                                    '<div class="thumbnail">'+

                                      '<div class="caption">'+
                                        '<div class="row" >'+
                                          '<div class="panel panel-default">'+
                                            '<div class="form-group">'+
                                              '<h3 class="text-center" align="center"></h3>'+
                                            '</div>'+
                                            '<hr/>'+
                                            '<div class="panel-body">'+
                                              '<div class="container">'+
                                                '<div class="thumbnail">'+
                                                  '<div class="row">'+
                                                    '<div class="col-sm-12 col-md-12">'+
                                                      '<table width="100%" style="text-align:justify" >'+
                                                        '<tr>'+
                                                        '<tr>'+
                                                          '<td  colspan="1"  align="left" >'+
                                                            '<div class="text-left"> <img src="img/LOGO.jpg" width="280" height="80" /> </div></td>'+
                                                          '</td>'+ 
                                                          '<td >'+
                                                            '<div  class="col-md-4 "><h3> ORDEN DE TRABAJO</h3>'+
                                                            '</div>'+
                                                            
                                                          '</td>'+

                                                        '</tr>'+
                                                        '</tr>'+
                                                      '</table>'+
                                                    '</div>'+
                                                  '</div>'+
                                                  '<br>'+
                                                  '<br>'+
                                                  '<div class="row">'+
                                                    '<div class="col-sm-12 col-md-12">'+
                                                      '<table width="100%" style="text-align:justify" border="1px solid black" >'+  
                                                        '<tr>'+
                                                            '<td>ID de Orden de trabajo</td>'+
                                                            '<td>'+data[0]['id_orden']+'</td>'+
                                                            '</tr>'+
                                                            '<tr>'+
                                                            '<td style="text-align: left"" >fecha</td>'+
                                                            '<td>'+fecha+'</td>'+
                                                            '</tr>'+

                                                            '<tr>'+
                                                            '<td>Fecha de programación</td>'+
                                                            '<td>'+fechapro+'</td>'+
                                                            '</tr>'+
                                                            '<tr>'+
                                                            '<td align="left" >Fecha de Entrega</td>'+
                                                            '<td>'+fechaent+'</td>'+
                                                            '</tr>'+

                                                            '<tr>'+
                                                            '<td>Fecha Entregada</td>'+
                                                            '<td>'+fechaentregada+'</td>'+
                                                            '</tr>'+
                                                            '<tr>'+
                                                            '<td>Fecha Terminada</td>'+
                                                            '<td>'+fechater+'</td>'+
                                                            '</tr>'+

                                                            '<tr>'+
                                                            '<td>Tarea</td>'+
                                                            '<td>'+data[0]['detarea']+'</td>'+
                                                            '</tr>'+
                                                            '<tr>'+
                                                            '<td>Equipo</td>'+
                                                            '<td>'+data[0]['codigo']+'</td>'+
                                                            '</tr>'+

                                                            '<tr>'+
                                                            '<td>Diración</td>'+
                                                            '<td>'+data[0]['duracion']+'</td>'+
                                                            '</tr>'+
                                                            '<tr>'+
                                                            '<td>Origen de OT</td>'+
                                                            '<td>'+origen+'</td>'+
                                                            '</tr>'+

                                                            

                                                            
                                                      
                                                      '</table>'+
                                                    '</div>'+
                                                  '</div>'+
                                                  '<br>'+
                                                  '<br>'+
                                                 
                                              
                                                  '<br>'+
                                                  '<br>'+

                                                 //aca va la tabla 

                                              
                                           
                                                '</div>'+
                                              '</div>'+
                                            '</div>'+

                                           
                                          '</div>'+
                                        '</div>'+
                                      '</div>'+
                                      '<style>'+
                                         '.table, .table>tr, .table>td  {} '+
                                      '</style>';
                                      //border:  1px solid black;


                                       var mywindow = window.open('', 'Imprimir', 'height=700,width=900');
                                        mywindow.document.write('<html><head><title></title>');
                                        //mywindow.document.write('<link rel="stylesheet" href="main.css" type="text/css" />');
                                        //mywindow.document.write('<link rel="stylesheet" href="main.css">
                                        mywindow.document.write('</head><body onload="window.print();">');
                                        mywindow.document.write(texto);
                                        mywindow.document.write('</body></html>');

                                        mywindow.document.close(); // necessary for IE >= 10
                                        mywindow.focus(); // necessary for IE >= 10
                                        //mywindow.print();
                                        //mywindow.close();
                                        return true; 
                 

                  
                   
                    },
              error: function(result){

                        console.log(result);
                        console.log("error en la vistaimprimir");
                                      },
                    dataType: 'json'
        });
  });    

  $(".fa-toggle-on").click(function (e) { 

    var idord = $(this).parent('td').parent('tr').attr('id');
    console.log(idord);  
    idfin=idord;
  });
  
  $('#vfecha').datepicker({
      changeMonth: true,
      changeYear: true
  }); 

  $("#fecha_entrega").datepicker({
    dateFormat: 'dd/mm/yy',
    firstDay: 1
  }).datepicker("setDate", new Date());

  $("#fecha1").datepicker({
    dateFormat: 'dd/mm/yy',
    firstDay: 1
  }).datepicker("setDate", new Date()); 

  $("#fecha_inicio1").datepicker({
    dateFormat: 'dd/mm/yy',
    firstDay: 1
  }).datepicker("setDate", new Date()); 

  $(".datepicker").datepicker({
      
      changeMonth: true,
      changeYear: true
  });

  // Edito- listo
  $(".fa-pencil").click(function (e) { 

    $("#modaleditar tbody").remove();
     
    console.log("Estoy editado ");
    var idord = $(this).parent('td').parent('tr').attr('id');
    idp=idord;
    console.log("El id de orden es:");
    console.log(idord);
    console.log(idp);
  
    $.ajax({
        type: 'POST',
        data: { idp: idp},
        url: 'index.php/Otrabajo/getpencil', //index.php/
        success: function(data){
              console.log("Datos que llegan en el editar");                  
              console.log(data);
             //console.log(data[0]['nro']);
              datos={
                  'nro':data[0]['nro'],
                  'equipo' :data[0]['codigo'],
                  'id_equipo':data[0]['id_equipo'],
                  
                  'fecha_inicio':data[0]['fecha_inicio'],
                  'idusuario':data[0]['id_usuario'],
                  'nota':data[0]['descripcion'],
                  'id_sucu':data[0]['id_sucursal'],
                  'sucursal':data[0]['descripc'],
                  'id_proveedor':data[0]['provid'],
                  'nombreprov':data[0]['provnombre'],
                }
              console.log("datos a enviar");
              console.log(datos);
              completarEdit(datos);
             // OpenSale();               
            
              },
          
        error: function(result){
              
              console.log(result);
            },
            dataType: 'json'
    });
  
  });

 // Genera Informe de Servicio - Hugo
  $('.fa-sticky-note-o').click( function cargarVista(){
      
      var id_sol = parseInt($(this).parent('td').parent('tr').attr('id'));
      var id_eq = parseInt($(this).parent('td').parent('tr').data('id_equipo')); 
      var desc = $(this).parent('td').parent('tr').data('causa');
      //alert(desc);

      WaitingOpen();
      $('#content').empty();
      $("#content").load("<?php echo base_url(); ?>index.php/Ordenservicio/cargarOrden/<?php echo $permission; ?>/"+id_sol+"/"+id_eq+"/"+desc+"");
      WaitingClose();
  });

  $('#otrabajo').DataTable({
        "paging": true,
        "lengthChange": true,
        "searching": true,
        "ordering": true,
        "info": true,
        "autoWidth": true,
        "language": {
              "lengthMenu": "Ver _MENU_ filas por página",
              "zeroRecords": "No hay registros",
              "info": "Mostrando pagina _PAGE_ de _PAGES_",
              "infoEmpty": "No hay registros disponibles",
              "infoFiltered": "(filtrando de un total de _MAX_ registros)",
              "sSearch": "Buscar:  ",
              "oPaginate": {
                  "sNext": "Sig.",
                  "sPrevious": "Ant."
                }
          }
  });

 

});

function completarEdit(datos){

  console.log("datos que llegaron");
  console.log(datos);
  $('#nroedit').val(datos['nro']);
  $('select#equipo1').append($('<option />', { value: datos['id_equipo'],text: datos['equipo']+'.'}));
  //$('#equipo1').val(datos['id_equipo']);
  $('#id_equipo1').val(datos['id_equipo']);
  traer_equipo2();
 // $('#equipo1').val(datos['id_equipo']);
  $('#fecha_inicio1').val(datos['fecha_inicio']);
  $('#vsdetalleedit').val(datos['nota']);
  //$('#sucidedit').val(datos['id_sucu']);
  $('#prov1').val(datos['id_proveedor']);

  $('select#sucidedit').append($('<option />', { value: datos['id_sucu'],text: datos['sucursal']+'.'}));
  traer_sucursal2();
 $('select#prov1').append($('<option />', { value: datos['id_proveedor'],text: datos['nombreprov']+'.'}));
  traer_prov1();  
}
    
function LoadOT(id_, action){
  idArt = id_;
  acArt = action;
  LoadIconAction('modalAction',action);
  WaitingOpen('Cargando Orden de trabajo');
  $.ajax({
          type: 'POST',
          data: { id : id_, act: action },
    		  url: 'index.php/otrabajo/getotrabajo', 
    		    success: function(result){
			                WaitingClose();
			                $("#modalBodyOT").html(result.html);
                      $('#vfech').datepicker({
                        changeMonth: true,
                        changeYear: true
                      });
			                setTimeout("$('#modalOT').modal('show')",800);
                      
    					},
    		    error: function(result){
    					WaitingClose();
    					alert("error");
    				},
          dataType: 'json'
  });
  
}

function traer_clientes(idcliente){

    $.ajax({
          type: 'POST',
          data: { idcliente: idcliente},
          url: 'index.php/Otrabajo/getcliente',  //index.php/
          async:false,
          success: function(data){
                  
                  $('#cliente option').remove();
                   var opcion  = "<option value='-1'>Seleccione...</option>" ; 
                  $('#cliente').append(opcion); 
                  for(var i=0; i < data.length ; i++) {   
                   
                      var apellido = data[i]['cliLastName']; 
                      var opcion  = "<option value='"+data[i]['cliId']+"'>" +apellido+ "</option>" ; 
                      $('#cliente').append(opcion);                
                  }
                },
          error: function(result){
                
                console.log(result);
              },
              dataType: 'json'
    });
}

function finalOT(id_, action){ //esto es nuevo 

  idot = id_;
  ac = action;
  est='T';
  LoadIconAction('modalAction',action);
  WaitingOpen('Finalizando');
  $.ajax({
          type: 'POST',
          data: { id : id_, act: action,estado:est },
          url: 'index.php/otrabajo/setfinal', 
            success: function(data){
                      WaitingClose();
                    
                    
            },
            error: function(result){
              WaitingClose();
              alert("error");
            },
            dataType: 'json'
  });
}
 
   
function traer_usuario(){

  console.log("Traer usuario");
  $("#usuario1").html('');                
  $.ajax({
          'data' : {},
          'async': true,
          'type': "POST",
          'global': false,
          'dataType': 'json',
          'url': "Otrabajo/getusuario",
          'success': function (data) {
              console.log("Entro por Traer usuario ok");
              //console.log(data[0]['id_equipo']);

               // Asigna opciones al select Equipo en modal
              var $select = $("#usuario1");
              //data[i]['usrId']

              for (var i = 0; data.length; i++) {

                $select.append($('<option />', { value: data[i]['usrId'], text: data[i]['usrLastName']+' '+data[i]['usrName'] }));
              }

           },
          'error' : function (data){
            console.log('Error en getusuario');
            alert('error');
           },

  });
}




function traer_sucursal2(){
  $('#sucidedit').html('');
  $.ajax({
      type: 'POST',
      data: { },
      url: 'index.php/Otrabajo/traer_sucursal', //index.php/
      success: function(data){
             
               //var opcion  = "<option value='-1'>Seleccione...</option>" ; 
                $('#sucidedit').append(opcion); 
              for(var i=0; i < data.length ; i++) 
              {    
                    var nombre = data[i]['descripc'];
                    var opcion  = "<option value='"+data[i]['id_sucursal']+"'>" +nombre+ "</option>" ; 

                  $('#sucidedit').append(opcion); 
                                 
              }
            },
      error: function(result){
            
            console.log(result);
          },
          dataType: 'json'
  });
}    
      
function traer_proveedor(){

  $('#proveedor').html('');
  $.ajax({
    type: 'POST',
    data: {},
    url: 'index.php/Otrabajo/getproveedor', //index.php/
    success: function(data){
           
             var opcion  = "<option value='-1'>Seleccione...</option>" ; 
              $('#proveedor').append(opcion); 
            for(var i=0; i < data.length ; i++) 
            {    
                  var nombre = data[i]['provnombre'];
                  var opcion  = "<option value='"+data[i]['provid']+"'>" +nombre+ "</option>" ; 

                $('#proveedor').append(opcion);                
            }
          },
    error: function(result){
          
          console.log(result);
        },
        dataType: 'json'
    });

}

traer_prov();
function traer_prov(){
  $.ajax({
    type: 'POST',
    data: {},
    url: 'index.php/Otrabajo/getproveedor', //index.php/
    success: function(data){
           
             var opcion  = "<option value='-1'>Seleccione...</option>" ; 
              $('#prov').append(opcion); 
            for(var i=0; i < data.length ; i++) 
            {    
                  var nombre = data[i]['provnombre'];
                  var opcion  = "<option value='"+data[i]['provid']+"'>" +nombre+ "</option>" ; 

                $('#prov').append(opcion);                
            }
          },
    error: function(result){
          
          console.log(result);
        },
        dataType: 'json'
    });

}

//Trae los proveedores del edit 
function traer_prov1(){
  $.ajax({
    type: 'POST',
    data: {},
    url: 'index.php/Otrabajo/getproveedor', //index.php/
    success: function(data){
           
             //var opcion  = "<option value='-1'>Seleccione...</option>" ; 
             // $('#prov1').append(opcion); 
            for(var i=0; i < data.length ; i++) 
            {    
                  var nombre = data[i]['provnombre'];
                  var opcion  = "<option value='"+data[i]['provid']+"'>" +nombre+ "</option>" ; 

                $('#prov1').append(opcion);                
            }
          },
    error: function(result){
          
          console.log(result);
        },
        dataType: 'json'
  });

}


traer_clientes()
function traer_clientes(){
  $.ajax({
    type: 'POST',
    data: { },
    url: 'index.php/Otrabajo/traer_cli', //index.php/
    success: function(data){
           
             var opcion  = "<option value='-1'>Seleccione...</option>" ; 
              $('#cli').append(opcion); 
            for(var i=0; i < data.length ; i++) 
            {    
                  var nombre = data[i]['cliLastName']+'. .'+datos['cliName'];
                  var opcion  = "<option value='"+data[i]['cliId']+"'>" +nombre+ "</option>" ; 

                $('#cli').append(opcion); 
                               
            }
          },
    error: function(result){
          
          console.log(result);
        },
        dataType: 'json'
    });
}
    
traer_sucursal()
function traer_sucursal(){
      $.ajax({
        type: 'POST',
        data: { },
        url: 'index.php/Otrabajo/traer_sucursal', //index.php/
        success: function(data){
               
                 var opcion  = "<option value='-1'>Seleccione...</option>" ; 
                  $('#suci').append(opcion); 
                for(var i=0; i < data.length ; i++) 
                {    
                      var nombre = data[i]['descripc'];
                      var opcion  = "<option value='"+data[i]['id_sucursal']+"'>" +nombre+ "</option>" ; 

                    $('#suci').append(opcion); 
                                   
                }
              },
        error: function(result){
              
              console.log(result);
            },
            dataType: 'json'
        });
} 
    

function click_pedent(){  

  var fechai= $("#fecha_inicio").val(); //optengo el valor del campo fecha 
  $.ajax({
        type: 'GET',
        data: {fechai:fechai }, /* destinodo*/
        url: 'index.php/Otrabajo/getpedidos', //index.php/
        success: function(data){
                              
                console.log(data);             
                var direccion = data[0]['destinodireccion']; 
                var contacto = data[0]['destinocontacto']; 
                $('#domicilio').val(direccion);       
                $('#contacto').val(contacto);                

              },
         error: function(result){
              
              console.log(result);
            },
            dataType: 'json'
        });

}

function guardareditar(){

  console.log("estoy guardando lo editado ");
  var id_orden = $('#id_orden').val();
  var nro = $('#nroedit').val();
  var fecha_inicio = $('#fecha_inicio1').val();
  var descripcion = $('#vsdetalleedit').val();
  var id_sucu= $('#sucidedit').val();
  var proveedor=  $('#prov1').val();
  var equipo = $('#equipo1').val();
  var equipo1 = $('#id_equipo1').val();
  var parametros = {
      //'id_orden': id_orden,
      'nro': nro,
      'fecha_inicio': fecha_inicio, 
      'descripcion': descripcion,     
      'id_sucursal': id_sucu,
      'id_proveedor': id_sucu,
      'id_equipo': equipo1

  };
  console.log("Parametros:");
  console.log(parametros);
  console.log("El id de orden es:");
  console.log(idp);
  console.log("El id de equipo es:");
  console.log(equipo);
  console.log(equipo1);
  console.log("El id de proveedor es:");
  console.log(proveedor);
     $.ajax({
         type: 'POST',
         data: {parametros:parametros, idp:idp},
         url: 'index.php/Otrabajo/guardar_editar',  //index.php/
         success: function(data){
                
                console.log("Exito en la edicion");
                console.log(data);
              
                regresa1();
               
              },
         error: function(result){
              
             console.log(result);
             // $('#modalAsig').modal('hide');
             }
         // dataType: 'json'
     });
           
}

traer_equipo()
function traer_equipo(){

  $.ajax({
    type: 'POST',
    data: { },
    url: 'index.php/Otrabajo/getequipo', //index.php/
    success: function(data){
           
             var opcion  = "<option value='-1'>Seleccione...</option>" ; 
              $('#equipo').append(opcion); 
            for(var i=0; i < data.length ; i++) 
            {    
                  var nombre = data[i]['codigo'];
                  var opcion  = "<option value='"+data[i]['id_equipo']+"'>" +nombre+ "</option>" ; 

                $('#equipo').append(opcion); 
                               
            }
          },
    error: function(result){
          
          console.log(result);
        },
        dataType: 'json'
    });
}

function traer_equipo2(){
  $.ajax({
    type: 'POST',
    data: { },
    url: 'index.php/Otrabajo/getequipo', //index.php/
    success: function(data){
           
            // var opcion  = "<option value='-1'>Seleccione...</option>" ; 
             // $('#equipo1').append(opcion); 
            for(var i=0; i < data.length ; i++) 
            {    
                  var nombre = data[i]['codigo'];
                  var opcion  = "<option value='"+data[i]['id_equipo']+"'>" +nombre+ "</option>" ; 

                $('#equipo1').append(opcion); 
                               
            }
          },
    error: function(result){
          
          console.log(result);
        },
        dataType: 'json'
    });
}

function guardarpedido(){

  console.log("si guardo pedido");
  var id_orden = $(this).parent('td').parent('tr').attr('id');
  var numero = $('#num1').val();
  var fecha = $('#fecha1').val();
  var fecha_entrega = $('#fecha_entrega2').val();
  var proveedor= $('#proveedor').val();
  var descripcion2 = $('#descripcion2').val(); 
  var parametros = {
     
      'id_proveedor': proveedor,
      'nro_trabajo': numero,
      'descripcion': descripcion2,
      'fecha' : fecha,
      'fecha_entrega': fecha_entrega,
      'estado': 'P',
      'id_trabajo' :ido 
      
  };
  console.log(parametros);
  console.log(ido);
  console.log(numero);
  console.log(fecha);
  console.log(fecha_entrega2);
  console.log(proveedor);
  console.log(descripcion2);
  $.ajax({
        type: 'POST',
        data: {data:parametros, ido:ido},
        url: 'index.php/Otrabajo/agregar_pedido',  //index.php/
        success: function(data){
                console.log("Estoy guardando pedido");
                regresa1();
               
              },
        error: function(result){
              
              console.log(result);
             
           }
           // dataType: 'json'
  });                 
}  
   
//guardar AGREGAR
function orden(){

  console.log("si guardo ");
  var id_orden = $('#id_orden').val();
  var nro = $('#nro').val();
  var fecha_inicio = $('#fecha_inicio').val();
  var fecha_entrega = $('#fecha_entrega').val();
  var usuario= $('#usuario1').val();
  var estado= $('#estado').val();
  var cliente = $('#id_cliente').val();
  var parametros = {
      //'id_orden': id_orden,
      'nro': nro,
      'fecha_inicio': fecha_inicio,
      'fecha_entrega': fecha_entrega,
      'id_usuario_a': usuario,
      'estado': 'As',     
      'cliId': cliente,
  };
  console.log(parametros);
  console.log(id_orden); //data:parametros,
  $.ajax({
      type: 'POST',
      data: { id_orden:id_orden, fecha_entrega:fecha_entrega, usuario:usuario},
      url: 'index.php/Otrabajo/guardar', 
      success: function(data){
              console.log(data);
              regresa1();
             
            },
      error: function(result){
            
            console.log(result);
           
          },
          dataType: 'json'
  });
                 
}
//Refresca    
function regresa(){

  $('#content').empty(); //listOrden  
  $("#content").load("<?php echo base_url(); ?>index.php/Otrabajo/listOrden/<?php echo $permission; ?>");
  WaitingClose();
}
    
  
function regresa1(){
  
    $('#content').empty();
    $('#modalOT').empty();
    $('#modalAsig').empty(); //local index 
    $("#content").load("<?php echo base_url(); ?>index.php/Otrabajo/listOrden/<?php echo $permission; ?>");
    WaitingClose();
    WaitingClose();
}
//Guarda OT     
function guardaragregar(){

  console.log("Guarda OT");

  var id_orden = $('#id_orden').val();
  var num = $('#nro1').val();
  var fecha_inicio = $('#fecha').val();
  var descripcion= $('#vsdetal').val();
  var sucursal = $('#suci').val();
  var proveedor= $('#prov').val();
  var equipo= $('#equipo').val();;

  console.log("Datos a guardar");
  console.log(id_orden);
  console.log(num);
  console.log(fecha_inicio);
  console.log(descripcion);
  console.log(sucursal);
  console.log(proveedor);
  console.log(equipo);

  $.ajax({
        type: 'POST', //parametros:parametros
        data: {id_orden:id_orden, num:num, equipo:equipo, descripcion:descripcion, sucursal:sucursal, proveedor:proveedor},
        url: 'index.php/Otrabajo/guardar_agregar',  //index.php/
        success: function(data){
        
                console.log(data);  
                regresa1();
               
              },
        error: function(result){
              
              console.log(result);
            
            }
           
  });
                 
}
//OT TOTAL, pasa a la partalla de ot terminadas 
function guardartotal(){
 
  console.log("Estoy finalizando total la ot ");
  console.log(idfin);
  $.ajax({
        type: 'POST',
        data: { idfin: idfin},
        url: 'index.php/Otrabajo/FinalizaOt', //index.php/
        success: function(data){
                console.log(data);
                alert("Se Finalizando la ORDEN TRABAJO");
                regresa();
              },
          
        error: function(result){
              console.log(result);
            }
            //dataType: 'json'
    });

} 

//OT PARCIAL, pasa a la partalla de ot PARCIAL 
function guardarparcial(){

  console.log("Estoy finalizando parcial la ot ");
  console.log(idfin); 
  $.ajax({
        type: 'POST',
        data: { idfin: idfin},
        url: 'index.php/Otrabajo/CambioParcial', //index.php/
        success: function(data){
                console.log(data);
                alert("Se Finalizando PARCIAL LA ORDEN TRABAJO");
                regresa();
              },
          
        error: function(result){
              console.log(result);
            }
            //dataType: 'json'
    });

} 

function eliminarpred(){

  var idpre = $(this).parent('td').parent('tr').attr('id');
  console.log("Estoy por la opcion SI a eliminar")
  console.log(gloid);
          
  $.ajax({
    type: 'POST',
    data: { gloid: gloid},
    url: 'index.php/Otrabajo/baja_predictivo', //index.php/
    success: function(data){
            //var data = jQuery.parseJSON( data );
            console.log(data);  
            regresa();
          },
      
    error: function(result){
          
          console.log(result);
        }
        //dataType: 'json'
  });

}

</script>

<!-- Modal ASIGNA-->
<div id="modalAsig" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title"><span  class="fa fa-thumb-tack " style="color: #A4A4A4"></span>   Asignacion Orden de trabajo</h4>
      </div>
      <div class="modal-body">
        <div class="row" >
            <div class="col-sm-12 col-md-12">
              <fieldset> </fieldset>
                <br>
                  <div class="col-xs-8">Nro:
                    <input type="text" class="form-control" id="nro"  name="nro"   disabled >
                  </div>
                  <input type="hidden" id="id_orden" name="id_orden">

                  <div class="col-xs-8">Fecha de inicio:
                    <input type="text" class="form-control" id="fecha_inicio" name="fecha_inicio" disabled>
                  </div>

                  <div class="row" >
                    <div class="col-sm-12 col-md-12">
                      <div class="col-xs-8">Equipo:
                        <input type="text"  id="equipo1" name="equipo1" class="form-control " disabled >
                        

                      </div>
                      <div class="col-xs-8">Descripcion:
                        
                      </div>
                      <div class="col-xs-12">
                        <textarea  class="form-control" rows="6" cols="500" id="descripcion" name="descripcion" value="" disabled ></textarea>
                      </div>
                    </div>
                  </div> 
                  <div class="row" >
                    <div class="col-sm-12 col-md-12">      
                      <div class="col-xs-8">Fecha de entrega:
                        <input type="text" id="fecha_entrega" name="fecha_entrega" class="form-control datepicker" / >
                      </div>
                      <br>
                      <br>
                      <div  class="col-xs-8">Usuario:
                        <select id="usuario1" name="usuario1" class="form-control " value="" ></select>
                      <input type="hidden" id="id_usuario" name="id_usuario">
                      </div>
                      <br>
                      <br>
                      <div class="col-xs-3">
                        
                      </div>
                    </div>
                  </div>    
            </div>
          </div>
        </div>
        <div class="modal-footer">
           <button type="button" class="btn btn-default" data-dismiss="modal" >Cancelar</button>
            <button type="button" class="btn btn-primary" id="reset" data-dismiss="modal" onclick="orden()">Guardar</button>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Modal editar-->
<div class="modal fade" id="modaleditar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-lg" role="document" style="width: 60%">
    <div class="modal-content">

      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title"  id="myModalLabel"><span id="modalAction" class="fa fa-fw fa-pencil" style="color: #A4A4A4" > </span> Editar Orden de Trabajo</h4>
       </div> <!-- /.modal-header  -->

      <div class="modal-body input-group ui-widget" id="modalBodyArticle">

        <div class="row">
          <div class="col-xs-4">
           <label style="margin-top: 7px;">Nro <strong style="color: #dd4b39">*</strong>: </label>
          </div>
          <div class="col-xs-8">
            <input type="text" class="form-control" placeholder="Nro Orden de trabajo" id="nroedit" name="nroedit">
          </div>
        </div><br>
        <div class="row">
          <div class="col-xs-4">
            <label style="margin-top: 7px;">Equipo <strong style="color: #dd4b39">*</strong>: </label>
          </div>
          <div class="col-xs-8">
            <select class="form-control" id="equipo1" name="equipo1" value="" style="width: 100%;">
               
            </select>
            <input type="hidden" class="form-control"  id="id_equipo1" name="id_equipo1">
          </div>
        </div><br>

        <div class="row">
          <div class="col-xs-4">
              <label style="margin-top: 7px;">Fecha <strong style="color: #dd4b39">*</strong>: </label>
          </div>
          <div class="col-xs-8">
            <input type="text" class="datepicker form-control fecha_inicio1 " id="fecha_inicio1" name="vfecha" value="<?php echo date_format(date_create(date("Y-m-d")), 'd-m-Y') ; ?>" size="26"/>
          <!-- <input type="text" class="form-control" id="vfecha" placeholder="dd-mm-aaaa" name="vfecha">-->
          </div>
        </div><br>

        <div class="row">
          <div class="col-xs-4">
             <label style="margin-top: 7px;">Nota: </label>
          </div>
          <div class="col-xs-8">
            <textarea placeholder="Orden de trabajo" class="form-control" rows="10" id="vsdetalleedit" name="vsdetalleedit" value=""></textarea>
          </div>
        </div>
        <br>
        <div class="row">
          <div class="col-xs-4">
              <label style="margin-top: 7px;">Sucursal <strong style="color: #dd4b39">*</strong>: </label>
          </div>
          <div class="col-xs-8">
            <select class="form-control" id="sucidedit" name="sucidedit" value="" style="width: 100%;">
              
            </select>
          </div>
        </div>
        <br>
        <div class="row">
          <div class="col-xs-4">
              <label style="margin-top: 7px;">Proveedor <strong style="color: #dd4b39">*</strong>: </label>
          </div>
          <div class="col-xs-8">
            <select class="form-control" id="prov1" name="prov1"  value="" style="width: 100%;">
              
            </select>
          </div>
        </div>
        <br>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal" >Cancelar</button>
          <button type="button" class="btn btn-primary" id="reset" data-dismiss="modal" onclick="guardareditar()">Guardar</button> 
        </div>  <!-- /.modal footer -->
      </div>
    </div>  <!-- /.modal-body -->
  </div> <!-- /.modal-content -->
</div>  <!-- /.modal-dialog modal-lg -->
</div>  <!-- /.modal fade -->
<!-- / Modal -->

<!-- Modal Pedido-->
<div class="modal fade" id="modalpedido" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-lg" role="document" style="width: 45%">
    <div class="modal-content">

      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title"  id="myModalLabel"><span id="modalAction" class="fa fa-tags" style="color: #A4A4A4" > </span> Orden de Pedido</h4>
       </div> <!-- /.modal-header  -->

      <div class="modal-body input-group ui-widget" id="modalBodyArticle">
        
        <div class="row" >
          <div class="col-sm-12 col-md-12">
            <fieldset> </fieldset>
            <br>
            <div class="col-xs-8">Nro:
              <input type="text"  class="form-control" id="num1" name="num1" placeholder="Ingrese nro de orden de pedido..">
              <!--align=\"right\" -->
            </div>
            <div class="col-xs-8">Fecha:
              <input type="date"  class="datepicker fecha1 form-control" id="fecha1"  name="fecha1" size= "36" value="<?php echo date_format(date_create(date("Y-m-d ")), 'd/m/Y') ; ?>"  />
            </div>
            <div class="col-xs-8">Fecha de Entrega:
              <input type="date"  class="form-control" id="fecha_entrega2" name="fecha_entrega2" />
            </div>
            <div class="col-xs-8">Proveedor:
              <select type="text"  id="proveedor" name="proveedor" class="form-control" value="" ></select>
              <input type="hidden" id="id_proveedor" name="id_proveedor">
            </div>
            
            <div class="col-xs-8">Detalle del pedido:                    
            </div>
            <div class="col-xs-12">
              <textarea  class="form-control input-md" rows="6" cols="500" id="descripcion2" name="descripcion2"
              value="" placeholder="Ingrese detalle del pedido..."></textarea>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal" onclick="cerro()">Cancelar</button>     
          <button type="button" class="btn btn-primary" id="btnSave" data-dismiss="modal" onclick="guardarpedido()" >Guardar</button>
        </div>  <!-- /.modal footer -->
      </div>  <!-- /.modal-body -->
    </div> <!-- /.modal-content -->
  </div>  <!-- /.modal-dialog modal-lg -->
</div>  <!-- /.modal fade -->
<!-- / Modal -->


<!-- Modal mostrar pedido-->
<div class="modal fade" id="modallista" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-lg" role="document" style="width: 70%">
    <div class="modal-content">

      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title"  id="myModalLabel"><span id="modalAction" class="fa fa-truck" style="color: #A4A4A4" > </span> Lista de Orden de Pedido</h4>
       </div> <!-- /.modal-header  -->

      <div class="modal-body input-group ui-widget" id="modalBodyArticle">
        
        <div class="row" >
          <div class="col-sm-12 col-md-12">
            <fieldset> </fieldset>
            <br>
            <table class="table table-bordered table-hover" id="tabladetalle">
              <thead>
                <tr>
                  <th width="10%"></th>                  
                  <th>Nro de orden</th>
                  <th>Fecha</th>
                  <th>Fecha de Entrega</th>
                  <th>Proveedor</th>
                  <th>Descripcion</th>
                  <th>Estado</th>

                </tr>
              </thead>
              <tbody>              
              </tbody>
            </table>    
          </div>
        </div>  
      </div>  <!-- /.modal-body -->
    </div> <!-- /.modal-content -->
  </div>  <!-- /.modal-dialog modal-lg -->
</div>  <!-- /.modal fade -->
<!-- / Modal -->

<!-- Modal agregar-->
<div class="modal fade" id="modalagregar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-lg" role="document" style="width: 40%">
    <div class="modal-content">

      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title"  id="myModalLabel"><span id="modalAction" class="fa fa-plus-square" style="color: #008000"  > </span> Orden de Trabajo</h4>
       </div> <!-- /.modal-header  -->

      <div class="modal-body input-group ui-widget" id="modalBodyArticle">

        <div class="row">
          <div class="col-xs-4">
           <label style="margin-top: 7px;">Nro <strong style="color: #dd4b39">*</strong>: </label>
          </div>
          <div class="col-xs-8">
            <input type="text" class="form-control"  id="nro1" name="nro1" placeholder="Ingrese Numero de OT">
          </div>
        </div><br>
        <div class="row">
          <div class="col-xs-4">
            <label style="margin-top: 7px;">Equipo <strong style="color: #dd4b39">*</strong>: </label>
          </div>
          <div class="col-xs-8">
            <select class="form-control " id="equipo" name="equipo" value="" style="width: 100%;">
               
            </select>
          </div>
        </div><br>

        <div class="row">
          <div class="col-xs-4">
              <label style="margin-top: 7px;">Fecha <strong style="color: #dd4b39">*</strong>: </label>
          </div>
          <div class="col-xs-8">
              <input type="text" class="form-control" id="vfech" name="vfech" value="<?php echo date_format(date_create(date("Y-m-d")), 'd-m-Y ') ; ?>"  disabled/>
          </div>
        </div><br>

        <div class="row">
          <div class="col-xs-4">
             <label style="margin-top: 7px;">Nota: </label>
          </div>
          <div class="col-xs-8">
            <textarea placeholder="Orden de trabajo" class="form-control" rows="10" id="vsdetal" name="vsdetal" value=""></textarea>
          </div>
        </div>
        <br>
        <div class="row">
          <div class="col-xs-4">
              <label style="margin-top: 7px;">Sucursal <strong style="color: #dd4b39">*</strong>: </label>
          </div>
          <div class="col-xs-8">
            <select class="form-control select2" id="suci" name="suci" style="width: 100%;">
              
            </select>
          </div>
        </div>
        <br>
        <div class="row">
          <div class="col-xs-4">
              <label style="margin-top: 7px;">Proveedor <strong style="color: #dd4b39">*</strong>: </label>
          </div>
          <div class="col-xs-8">
            <select class="form-control select2" id="prov" name="prov"  value="" style="width: 100%;">
              
            </select>
          </div>
        </div>
        <br>
        <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal" onclick="cerro()">Cancelar</button>
          <button type="button" class="btn btn-primary" id="reset" data-dismiss="modal" onclick="guardaragregar()">Guardar</button> 
          
        </div>  <!-- /.modal footer -->
      </div>  <!-- /.modal-body -->
    </div> <!-- /.modal-content -->
  </div>  <!-- /.modal-dialog modal-lg -->
</div>  <!-- /.modal fade -->
<!-- / Modal -->

<!-- Modal FINALIZAR-->
<div class="modal fade" id="modalfinalizar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-lg" role="document" style="width: 35%">
    <div class="modal-content">

      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title"  id="myModalLabel"><span id="modalAction" class="fa fa-fw fa fa-toggle-on" style="color: #3c8dbc" > </span> Finalización </h4>
       </div> <!-- /.modal-header  -->

      <div class="modal-body input-group ui-widget" id="modalBodyArticle">
        
        <div class="row" >
          <div class="col-sm-12 col-md-12">
            
           
            <div class="col-sm-12 ">Elija la opción de finalización de orden:
            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal" onclick="guardarparcial()"> PARCIAL</button>     
              <button type="button" class="btn btn-primary" id="btnSave" data-dismiss="modal" onclick="guardartotal()" >TOTAL</button>
            </div>  <!-- /.modal footer -->
           </div>
             
          </div>
        </div>  
      </div>  <!-- /.modal-body -->
    </div> <!-- /.modal-content -->
  </div>  <!-- /.modal-dialog modal-lg -->
</div>  <!-- /.modal fade -->
<!-- / Modal -->

<div class="modal fade" id="modalaviso">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" ><span class="fa fa-fw fa-times-circle" style="color:#A4A4A4"></span>  Eliminar</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true" >&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <center>
        <h4><p>¿ DESEA ELIMINAR ORDEN DE TRABAJO ?</p></h4>
        </center>
      </div>
      <div class="modal-footer">
        <center>
        <button type="button" class="btn btn-primary" data-dismiss="modal" onclick="eliminarpred()">SI</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">NO</button>
        </center>
      </div>
    </div>
  </div>
</div>