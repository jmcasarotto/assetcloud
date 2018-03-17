<input type="hidden" id="permission" value="<?php echo $permission;?>">
<div class="row">
  <div class="col-xs-12">
    <div class="alert alert-danger alert-dismissable" id="error1" style="display: none">
          <h4><i class="icon fa fa-ban"></i> ALERTA!</h4>
          Este equipo! SI tiene datos tecnicos cargados
      </div>
  </div>
</div>
<section class="content">
  <div class="row">
    <div class="col-xs-12">
      <div class="box">
        <div class="box-header">
        <br>
          <h3 class="box-title">Equipo/Sector</h3>
          <?php
          if (strpos($permission,'Add') !== false) {
            echo '<button class="btn btn-block btn-success" style="width: 100px; margin-top: 10px;" id="btnAgre">Agregar</button>';
          }
          ?>
        </div><!-- /.box-header -->
        <div class="box-body">
          <table id="sales" class="table table-bordered table-hover" style="text-align: center">
            <thead>
              <tr>                
                <th width="20%" style="text-align: center">Acciones</th>
                <th style="text-align: center">Equipo</th>
                <th style="text-align: center">Descripción</th>
                <th style="text-align: center">Área</th>
                <th style="text-align: center">Proceso</th>
                <th style="text-align: center">Sector</th>
                <th style="text-align: center">Criticidad</th>
                <th style="text-align: center">Estado</th>
              </tr>
            </thead>
            <tbody>
              <?php


                  
                foreach($list as $a){ 
                  // var_dump($a);
                
                  //if ($a['estado'] !=="AN") {
                    //var_dump($a['codigo']);
                
                    $id=$a['id_equipo'];
                  // var_dump($id);
                    echo '<tr id="'.$id.'" >';
                    echo '<td>';

                    if (strpos($permission,'Del') !== false) {

                      echo '<i href="#" class="fa fa-fw fa-times-circle" style="color: #A4A4A4; cursor: pointer; margin-left: 15px;"  title="Eliminar"></i>';
                    }


                    if (strpos($permission,'Edit') !== false) {
                      
                      echo '<i class="fa fa-fw fa-pencil" style="color: #A4A4A4; cursor: pointer; margin-left: 15px;" title="Editar" data-toggle="modal" data-target="#modaleditar"></i>' ;
                      echo '<i class="fa fa-sticky-note-o" style="color: #A4A4A4; cursor: pointer; margin-left: 15px;" title="Datos Tecnicos" data-toggle="modal" data-target="#modaltecnico"></i>' ;
                      echo '<i class="fa fa-fw fa-print" style="color: #A4A4A4; cursor: pointer; margin-left: 15px;" title="Imprimir"  ></i> ';                      
                    }

                    if (strpos($permission,'Del') !== false) {
                       
                       echo '<i class="fa fa-fw  fa fa-user" style="color: #A4A4A4; cursor: pointer; margin-left: 15px;" title="Contratista" data-toggle="modal" data-target="#modalasignar"></i>';
                       //antes estaba el estado R por que ERA REPARACION pero ahora reparacion es R
                         if( ($a['estado'] == 'AC') || ($a['estado'] == 'RE') ){
                       echo '<i  href="#"class="fa fa-fw fa fa-toggle-on" style="color: #A4A4A4; cursor: pointer; margin-left: 15px;" title="Inhabilitar"></i>';
                         }
                         else {
                            echo '<i class="fa fa-fw fa fa-toggle-off" title="Habilitar" style="color: #A4A4A4; cursor: pointer; margin-left: 15px;"></i>';
                         }
                    }

                    if (strpos($permission,'Lectura') !== false) {
                       echo '<i class="fa fa-hourglass-half" style="color: #A4A4A4; cursor: pointer; margin-left: 15px;" title="Lectura Horaria" data-toggle="modal" data-target="#modalectura"></i>';
                       
                       echo '<i class="fa fa-history" style="color: #A4A4A4; cursor: pointer; margin-left: 15px;" title="Historial de Lecturas" data-toggle="modal" data-target="#modalhistlect"></i>';
                    }
                   
                    echo '</td>';
                    '<input type="hidden" id="id_equipo" name="id_equipo">';
                    echo '<td class="maquin" style="text-align: center">'.$a['codigo'].'</td>';
                    echo '<td style="text-align: center">'.$a['deeq'].'</td>';
                    echo '<td style="text-align: center">'.$a['dear'].'</td>';
                    echo '<td style="text-align: center">'.$a['depro'].'</td>';
                    echo '<td style="text-align: center">'.$a['desec'].'</td>';
                    echo '<td style="text-align: center">'.$a['decri'].'</td>';

                    // echo '<td style="text-align: center">'.($a['estado'] == 'AC' ? '<small class="label pull-left bg-green" >Activo</small>' :($a['estado'] == 'IN' ? '<small class="label pull-left bg-blue">Inhabilitado</small>' : '<small class="label pull-left bg-red">Anulado</small>')).'</td>';


                    echo '<td style="text-align: center">'
                    .($a['estado'] == 'AC' ? '<small class="label pull-left bg-green" >Activo</small>' 
                      :($a['estado'] == 'IN' ? '<small class="label pull-left bg-blue">Inhabilitado</small>'
                      :($a['estado'] == 'RE' ? '<small class="label pull-left bg-yellow">Reparación</small>' 
                        : '<small class="label pull-left bg-red">Anulado</small>'))).'</td>';
                    echo '</tr>';

                  //}
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
  var isOpenWindow = false;
  var comglob="";
  var ide="";
  var idglob= "";
$(document).ready(function(event) {
  
  $( function() {
    $( ".datepicker" ).datepicker();
  } );


  edit=0;  datos=Array()  
  $('#btnAgre').click( function cargarVista(){
    WaitingOpen();
    $('#content').empty();
    $("#content").load("<?php echo base_url(); ?>index.php/Equipo/cargarequipo/<?php echo $permission; ?>");
    WaitingClose();
  });

  //Cambio de estado a un equipo
  $(".fa-times-circle").click(function (e) { 
 
    console.log("Esto eliminando"); 
    var idequipo = $(this).parent('td').parent('tr').attr('id');
    console.log(idequipo);
    
    $.ajax({
            type: 'POST',
            data: { idequipo: idequipo},
            url: 'index.php/Equipo/baja_equipo', 
            success: function(data){                    
                    //console.log(data);/
                    alert("Equipo/sector ANULADO");
                    regresa();                  
                  },
              
            error: function(result){
                  
                  console.log(result);
                },
                dataType: 'json'
      });
  });
  
  //Editar
  $(".fa-pencil").click(function (e) { 
     
    var id_equipo = $(this).parent('td').parent('tr').attr('id');
    comglob= id_equipo;
    console.log(id_equipo);
    console.log(comglob);
    $.ajax({
        type: 'GET',
        data: { id_equipo: id_equipo},
        url: 'index.php/Equipo/getpencil', 
        success: function(data){                                  
                console.log(data);               
                //console.log(data[0]['deemp']); 
                datos={
                  'id_equipo':id_equipo,

                  'descripcion':data[0]['descripcion'],
                  'fecha_ingreso':data[0]['fecha_ingreso'],
                  'fecha_garantia':data[0]['fecha_garantia'],
                  'marca':data[0]['marcadescrip'],
                  'codigo':data[0]['codigo'],
                  'ubicacion':data[0]['ubicacion'],

                  'id_empresa':data[0]['id_empresa'], //deemp
                  'id_sector':data[0]['id_sector'], //desect
                  'id_grupo':data[0]['id_grupo'], //degrup
                  'id_criticidad':data[0]['id_criti'], //decriti

                  'estado':data[0]['estado'],
                  'fecha_ultimalectura':data[0]['fecha_ultimalectura'],
                  'ultima_lectura':data[0]['ultima_lectura']       
                },
               
                edit=1;
                console.log("datos a enviar");
                console.log(datos);

                completarEdit(datos,edit);
                OpenSale();  
              },
          
        error: function(result){
              
              console.log(result);
            },
            dataType: 'json'
        });  
  });

 
  $(".fa-user ").click(function (e) { 
    
    var id_equipo = $(this).parent('td').parent('tr').attr('id');
    console.log(id_equipo);
   idglob=id_equipo;
    console.log("variable global- id de equipo");
    console.log(idglob);
   
    click_empresa();
    click_co(id_equipo);
    traer_empresa2();        
  });
   
  // Cambiar a estado inactivo
  $(".fa-toggle-on").click(function (e) { 

    var idequipo = $(this).parent('td').parent('tr').attr('id');
    console.log(idequipo);
    
    $.ajax({
      type: 'POST',
      data: { idequipo: idequipo},
      url: 'index.php/Equipo/cambio_equipo', 
      success: function(data){
             
              console.log(data);
              alert("Se cambio el estado del equipo a INACTIVO");            
              regresa();          
            },
        
      error: function(result){
            
            console.log(result);
          },
          dataType: 'json'
      });
  });

  $(".fa-toggle-off").click(function (e) { 

    var idequipo = $(this).parent('td').parent('tr').attr('id');
    console.log(idequipo);
    $.ajax({
      type: 'POST',
      data: { idequipo: idequipo},
      url: 'index.php/Equipo/cambio_estado', 
      success: function(data){
              console.log(data);
              alert("Se cambio el estado del equipo a ACTIVO");
              regresa();    
           },
        
      error: function(result){
            console.log(result);
          },
          dataType: 'json'
    });
  });
 
  $(".fa-sticky-note-o").click(function(e){
   
    var cod = $(this).parent('td').parent('tr').attr('id');
    console.log("El id de equipo es:");
    console.log(cod);
    idglob= cod;
    console.log(idglob);
    var hayError = false;

     $.ajax({
      type: 'POST',
      data: { idglob: idglob},
      url: 'index.php/Equipo/getequipoficha', //index.php/
      success: function(data){
                   if(data!== 'nada' ){
                      $('#error1').fadeIn('slow');
                      alert("El equipo , SI tiene datos tecnicos cargados");
                       llamar_ficha(); 

                        }
                       // ingresar_ficha();

                    },
        
      error: function(result){
            console.log(result);
          },
          dataType: 'json'
    });

     $("#content").load("<?php echo base_url(); ?>index.php/Ficha/cargarequipo/<?php echo $permission; ?>/"+idglob+"");
  }); 

  $(".fa-print").click(function (e) {

        e.preventDefault();
        var idequip = $(this).parent('td').parent('tr').attr('id');
        console.log("El id de orden al imprimir es :");
        console.log(idequip);
         // alert(id_orden);

        $.ajax({
              type: 'POST',
              data: { idequip: idequip},
              url: 'index.php/Equipo/getsolImp', //index.php/
              success: function(data){
                   
                    console.log("Entre a la impresion");
                    console.log(data);
                    console.log(data.datos.codigo);
                    console.log(data.equipos.asegurado);
                    console.log(data.orden.nombre);
                 

                    var fecha = new Date(data.datos.fechain);
                    var day = fecha.getDate();
                    var month = fecha.getMonth();
                    var year = fecha.getUTCFullYear();
                    fecha = day + '-' + month + '-' + year;
                    //data.equipos.fecha_vigencia
                    //data.equipos.fecha_inicio
                    var fechav = new Date(data.equipos.fecha_vigencia);
                    var day = fechav.getDate();
                    var month = fechav.getMonth();
                    var year = fechav.getUTCFullYear();
                    fechav = day + '-' + month + '-' + year;

                    var fechai = new Date(data.equipos.fecha_inicio);
                    var day = fechai.getDate();
                    var month = fechai.getMonth();
                    var year = fechai.getUTCFullYear();
                    fechai = day + '-' + month + '-' + year;

                   
                    var trequipos = '';
                    for(var i=0; i < data['orden'].length ; i++){   

                      var fecha1 = new Date(data['orden'][i]['fecha']);
                      var day = fecha1.getDate();
                      var month = fecha1.getMonth();
                      var year = fecha1.getUTCFullYear();
                      fecha1 = day + '-' + month + '-' + year;
                        
                      trequipos  = trequipos+"<tr>  <td width='10%'>"+ fecha1+"</td> <td width='10%'>"+data['orden'][i]['causa']+"</td> <td width='10%'>"+data['orden'][i]['causa']+"</td> <td width='10%'>"+data['orden'][i]['nombre']+"</td><td width='10%'>"+data['orden'][i]['estado']+"</td>  </tr>" ;                           
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
                                                            '<div  class="col-md-4 "><h3> FICHA TECNICA DE SERVICIO</h3>'+
                                                            '</div>'+
                                                            
                                                          '</td>'+

                                                        '</tr>'+
                                                        '</tr>'+
                                                      '</table>'+
                                                    '</div>'+
                                                  '</div>'+
                                                  '<div class="row">'+
                                                    '<div class="col-sm-12 col-md-12">'+
                                                      '<table width="100%" style="text-align:justify" border="1px solid black" >'+  
                                                        '<tr>'+
                                                            '<td>Numero de serie</td>'+
                                                            '<td>'+data.datos.numero_serie+'</td>'+
                                                            '<td style="text-align: left"" >Codigo del equipo</td>'+
                                                            '<td>'+data.datos.codigo+'</td>'+
                                                            '</tr>'+

                                                            '<tr>'+
                                                            '<td>Marca del motor</td>'+
                                                            '<td>'+data.datos.marca+'</td>'+
                                                            '<td align="left" >Estado del equipo</td>'+
                                                            '<td>'+data.datos.estado+'</td>'+
                                                            '</tr>'+

                                                            '<tr>'+
                                                            '<td>Modelo del motor</td>'+
                                                            '<td>'+data.datos.modelo+'</td>'+
                                                            '<td>Dominio</td>'+
                                                            '<td>'+data.datos.dominio+'</td>'+
                                                            '</tr>'+

                                                            '<tr>'+
                                                            '<td>Numero de motor</td>'+
                                                            '<td>'+data.datos.numero_motor+'</td>'+
                                                            '<td>Marca de equipo</td>'+
                                                            '<td>'+data.datos.marcaeq+'</td>'+
                                                            '</tr>'+

                                                            '<tr>'+
                                                            '<td>Año de fabricacion</td>'+
                                                            '<td>'+data.datos.fabricacion+'</td>'+
                                                            '<td>Modelo de equipo</td>'+
                                                            '<td>'+data.datos.modelo+'</td>'+
                                                            '</tr>'+

                                                            '<tr>'+
                                                            '<td>Baterias</td>'+
                                                            '<td>'+data.datos.bateria+'</td>'+
                                                            '<td>Ubicacion</td>'+
                                                            '<td>'+data.datos.ubicacion+'</td>'+
                                                            '</tr>'+

                                                            '<tr>'+
                                                            '<td>Peso Operativo</td>'+
                                                            '<td>'+data.datos.ubicacion+'</td>'+
                                                            '<td>Sector</td>'+
                                                            '<td>'+data.datos.sector+'</td>'+
                                                            '</tr>'+

                                                            '<tr>'+
                                                            '<td>Ingreso a la Reparacion</td>'+
                                                            '<td>'+fecha+'</td>'+  //data.datos.fechain
                                                            '<td>Horas del equipo a la fecha</td>'+
                                                            '<td>'+data.datos.hora_lectura+'</td>'+
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
                                                            '<td colspan="4" align="center">Datos de Poliza de Seguro</td>'+   
                                                        '</tr>'+
                                                        '<tr>'+
                                                            '<td colspan="4" align="left">Seguro Obligatorio Automotor</td>'+   
                                                        '</tr>'+
                                                         '<tr>'+
                                                            '<td colspan="4" align="left">Decreto 1716/08 - Reclamo Ley: 26.363</td>'+   
                                                        '</tr>'+
                                                        '<tr>'+
                                                            '<td>Asegurado</td>'+ 
                                                            '<td colspan="4">'+data.equipos.asegurado+'</td>'+

                                                        '</tr>'+

                                                            '<tr>'+
                                                            '<td>Ref</td>'+
                                                            '<td>'+data.equipos.ref+'</td>'+
                                                            '<td >Poliza</td>'+
                                                            '<td>'+data.equipos.numero_pliza+'</td>'+
                                                            '</tr>'+

                                                            '<tr>'+
                                                            '<td>Vigencia desde</td>'+
                                                            '<td>'+fechav+'</td>'+ //data.equipos.fecha_vigencia
                                                            '<td>Hasta</td>'+
                                                            '<td>'+fechai+'</td>'+ //data.equipos.fecha_inicio
                                                            '</tr>'+

                                                           
                                                            
                                                      
                                                      '</table>'+
                                                    '</div>'+
                                                  '</div>'+
                                                  '<div class="col-sm-6 col-md-6" border="1" >'+
                                                  '</div>'+
                                              
                                                  '<br>'+
                                                  '<br>'+

                                                 //aca va la tabla 

                                                  '<div class="row">'+
                                                    '<div class="col-xs-10 col-xs-offset-1 text-center">'+
                                                   
                                                      '<table class="table table-bordered"  style="text-align:justify" border="1px solid black" >'+ //class="table table-bordered"
                                                        '<thead>'+
                                                          '<tr colspan="6" height="30">'+
                                                            '<th width="20%">Fecha </th>'+
                                                            '<th width="40%">Descripcion del arreglo</th>'+
                                                            '<th width="25%">Diagnostico realizado por </th>'+
                                                            '<th width="25%">Reparacion realizado por </th>'+
                                                            '<th width="10%">Estado de la reparacion </th>'+
                                                          '</tr>'+
                                                        '</thead>'+
                                                        
                                                        '<tbody style="text-align:center">'+trequipos+
                                                        '<tr colspan="2">'+
                                                          '<td style="text-align: center" ></td>'+
                                                          '<td><br></td>'+
                                                          '<td><br></td>'+
                                                          '<td><br></td>'+
                                                          '<td><br></td>'+
                                                        '</tr>'+
                                                        '<tr colspan="2">'+
                                                          '<td style="text-align: center" ></td>'+
                                                          '<td><br></td>'+
                                                          '<td><br></td>'+
                                                          '<td><br></td>'+
                                                          '<td><br></td>'+
                                                        '</tr>'+
                                                        '<tr colspan="2">'+
                                                          '<td style="text-align: center" ></td>'+
                                                          '<td><br></td>'+
                                                          '<td><br></td>'+
                                                          '<td><br></td>'+
                                                          '<td><br></td>'+
                                                        '</tr>'+
                                                        '<tr colspan="2">'+
                                                          '<td style="text-align: center" ></td>'+
                                                          '<td><br></td>'+
                                                          '<td><br></td>'+
                                                          '<td><br></td>'+
                                                          '<td><br></td>'+
                                                        '</tr>'+
                                                        '<tr colspan="2">'+
                                                          '<td style="text-align: center" ></td>'+
                                                          '<td><br></td>'+
                                                          '<td><br></td>'+
                                                          '<td><br></td>'+
                                                          '<td><br></td>'+
                                                        '</tr>'+
                                                        '<tr colspan="2">'+
                                                          '<td style="text-align: center" ></td>'+
                                                          '<td><br></td>'+
                                                          '<td><br></td>'+
                                                          '<td><br></td>'+
                                                          '<td><br></td>'+
                                                        '</tr>'+
                                                          '<tr colspan="2">'+
                                                          '<td style="text-align: center" ></td>'+
                                                          '<td><br></td>'+
                                                          '<td><br></td>'+
                                                          '<td><br></td>'+
                                                          '<td><br></td>'+
                                                        '</tr>'+
                                                          '<tr colspan="2">'+
                                                          '<td style="text-align: center" ></td>'+
                                                          '<td><br></td>'+
                                                          '<td><br></td>'+
                                                          '<td><br></td>'+
                                                          '<td><br></td>'+
                                                        '</tr>'+
                                                          '<tr>'+
                                                          '<td style="text-align: center" ></td>'+
                                                          '<td><br></td>'+
                                                          '<td><br></td>'+
                                                          '<td><br></td>'+
                                                          '<td><br></td>'+
                                                        '</tr>'+
                                                          '<tr>'+
                                                          '<td style="text-align: center" ></td>'+
                                                          '<td><br></td>'+
                                                          '<td><br></td>'+
                                                          '<td><br></td>'+
                                                          '<td><br></td>'+
                                                        '</tr>'+
                                                        '<tr>'+
                                                          '<td style="text-align: center" ></td>'+
                                                          '<td><br></td>'+
                                                          '<td><br></td>'+
                                                          '<td><br></td>'+
                                                          '<td><br></td>'+
                                                        '</tr>'+
                                                        '<tr colspan="2">'+
                                                          '<td style="text-align: center" ></td>'+
                                                          '<td><br></td>'+
                                                          '<td><br></td>'+
                                                          '<td><br></td>'+
                                                          '<td><br></td>'+
                                                        '</tr>'+
                                                        '</tbody>'+
                                                      '</table>'+    
                                                    '</div>'+
                                                  '</div>'+
                                                  //'<div class="container-fluid">'+
                                           
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

  /// Lectura Hugo 
  
  $(".fa-hourglass-half").click(function(e){
   
      $(".clear").val("");
      var $id_equipo = $(this).parent('td').parent('tr').attr('id');      

      console.log("id de equipo: ");
      console.log($id_equipo);
      $.ajax({
            type: 'POST',
            data: { idequipo: $id_equipo},
            url: 'index.php/Equipo/getEqPorId', 
            success: function(data){   

                  $('#maquina').val(data[0]['codigo']);  
                  $('#id_maquina').val(data[0]['id_equipo']);                                    
                  estBoton(data);       //agrega boton de estados
                  },
              
            error: function(result){
                  
                  console.log(result);
                },
                dataType: 'json'
      });   
  });

  /// agrega el estado del boton en modal
  function estBoton(data){
    
    var estado = data[0]['estado'];
    
    if (estado == 'RE') {  //reparacion
      inhabilitar();          
    }
    if (estado == 'AC') {  //activo
      habilitar();
    }
  }

  /// cambio de estado desde el boton
  $(".llave").click(function(e){

    var estadobton = $(this).attr("class");
    
    if (estadobton == 'fa fa-fw llave fa-toggle-on') {
      inhabilitar();
    }
    if (estadobton == 'fa fa-fw llave fa-toggle-off') {         
      habilitar();
    }  
  });  

  function habilitar(){
    $(".llave").removeClass("fa-toggle-off");  
    $(".llave").addClass("fa-toggle-on");
    $("label#botestado").text('Activo');
    $("input#estado").val('AC'); // Estado Activo
  }

  function inhabilitar(){
    $(".llave").removeClass("fa-toggle-on");  
    $(".llave").addClass("fa-toggle-off");
    $("label#botestado").text('Reparación');
    $("input#estado").val('RE'); // Estado Reparacion
  }
  

  $('#sales').DataTable({
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

function completarEdit(datos ,edit){

  console.log("datos que llegaron");
  $('#equipo').val(datos['id_equipo']);
  $('#descripcion').val(datos['descripcion']);
  $('#fecha_ingreso').val(datos['fecha_ingreso']);
  $('#fecha_garantia').val(datos['fecha_garantia']);
  $('#marca1').val(datos['marca']);
  $('#codigo').val(datos['codigo']);
  $('#ubicacion').val(datos['ubicacion']);
  
  $('#empresa').val(datos['id_empresa']);
  $('#etapa').val(datos['id_sector']);
  $('#grupo').val(datos['id_grupo']);
  $('#criticidad').val(datos['id_criticidad']);
  $('#estado').val(datos['estado']);
  $('#fecha_ultimalectura').val(datos['fecha_ultimalectura']);
  $('#ultima_lectura').val(datos['ultima_lectura']);
  traer_empresa();
  traer_etapa();
  traer_grupo();
  traer_criticidad();
  traer_marca();
}

function OpenSale(){

  var btn = $('#btnAgre');
  if(btn.is(':enabled')){
    //Abrir ventana de facturación
    if(isOpenWindow == false){
      isOpenWindow = true;
      LoadIconAction('modalActionSale','Add');
      WaitingOpen('Cargando...');
      $('#modalSale').modal({ backdrop: 'static', keyboard: false });
      $('#modalSale').modal('show');
      // $('#modalbaja').modal('show');
      setTimeout(function () { $('#artId').focus(); }, 1000);
      $('#saleDetail > tbody').html('');
     
      WaitingClose();
     
    }
  }
}

function regresa(){

  $('#content').empty();
  $("#content").load("<?php echo base_url(); ?>index.php/Equipo/index/<?php echo $permission; ?>");
  WaitingClose();
}

function cerro(){
  
  isOpenWindow = false;
}

function guardar(){

  var codigo = $('#codigo').val();
  var ubicacion = $('#ubicacion').val();
  var marca= $('#marca').val();
  var descripcion = $('#descripcion').val();
  var fecha_ingreso = $('#fecha_ingreso').val();
  var fecha_ultimalectura = $('#fecha_ultimalectura').val();
  var ultima_lectura = $('#ultima_lectura').val();
  var fecha_garantia = $('#fecha_garantia').val();
  //var estado = $('#estado').val();
  var empresa = $('#empresa').val();
  var sector = $('#sector').val();
  var criticidad = $('#criticidad').val();
  var grupo = $('#grupo').val();

  var parametros = {
     // 'id_equipo': id_equipo,
      'codigo': codigo,
      'ubicacion': ubicacion,
      'marca': marca,
      'descripcion': descripcion,
      'fecha_ingreso': fecha_ingreso,
      'fecha_ultimalectura': fecha_ultimalectura,
      'ultima_lectura': ultima_lectura,
      'fecha_garantia': fecha_garantia,
      'id_empresa' : empresa,
      'id_sector' : sector,
      'id_criticidad' : criticidad,
      'id_grupo' : grupo,
      'estado' : 'AC',

      
  };

  console.log("estoy editando");
  console.log("parametros");
  $.ajax({
      type: 'POST',
      data: {data:parametros, comglob: comglob},
      url: 'index.php/Equipo/editar_equipo',  //index.php/
      success: function(data){
               
              console.log(data);
              regresa();                    
              },
      error: function(result){
              
              console.log(result);
              
            }
            //dataType: 'json'
  });
}

function guardarsi(){

  var idequipo = $(this).parent('td').parent('tr').attr('id');
  console.log("Equipo");
  console.log(idglob);
  var ideq = $(this).parent('td').parent('tr').attr('class');
  console.log(ideq);
  datos= parseInt(ideq);
  console.log(datos);

  var idscontra = new Array();     
  $("#tablaempresa tbody tr").each(function (index) 
  {
    var id_contratista = $(this).attr('id');
    idscontra.push(id_contratista);
         
  }); 

  var parametros = {
     'id_equipo': idglob
     //$('#codigoe').val(),
            //'variab' : variable,
  };
  console.log(idglob);
  console.log(parametros);
   console.log(idscontra);


  $.ajax({
    type:"POST",
    url: 'index.php/Equipo/guardarcontra', //controlador /metodo
    data:{ idglob:idglob, idscontra:idscontra},
    success: function(data){
      console.log("guarde con exito");

        console.log(data);
        },
        
        error: function(result){  

        console.log(result);
        },
         dataType: 'json'
    });

}

traer_grupo();
function traer_grupo(){
      $.ajax({
        type: 'POST',
        data: { },
        url: 'index.php/Equipo/getgrupo', //index.php/
        success: function(data){
               
                 var opcion  = "<option value='-1'>Seleccione...</option>" ; 
                  $('#grupo').append(opcion); 
                for(var i=0; i < data.length ; i++) 
                {    
                      var nombre = data[i]['descripcion'];
                      var opcion  = "<option value='"+data[i]['id_grupo']+"'>" +nombre+ "</option>" ; 

                    $('#grupo').append(opcion); 
                                   
                }
              },
        error: function(result){
              
              console.log(result);
            },
            dataType: 'json'
      });
}

traer_criticidad();
function traer_criticidad(){
    $.ajax({
        type: 'POST',
        data: { },
        url: 'index.php/Equipo/getcriti', //index.php/
        success: function(data){
               
                 var opcion  = "<option value='-1'>Seleccione...</option>" ; 
                  $('#criticidad').append(opcion); 
                for(var i=0; i < data.length ; i++) 
                {    
                      var nombre = data[i]['descripcion'];
                      var opcion  = "<option value='"+data[i]['id_criti']+"'>" +nombre+ "</option>" ; 

                    $('#criticidad').append(opcion); 
                                   
                }
              },
        error: function(result){
              
              console.log(result);
            },
            dataType: 'json'
    });
}

function traer_etapa(){
      $.ajax({
        type: 'POST',
        data: { },
        url: 'index.php/Equipo/getetapa', //index.php/
        success: function(data){
               
                 var opcion  = "<option value='-1'>Seleccione...</option>" ; 
                  $('#etapa').append(opcion); 
                for(var i=0; i < data.length ; i++) 
                {    
                      var nombre = data[i]['descripcion'];
                      var opcion  = "<option value='"+data[i]['id_sector']+"'>" +nombre+ "</option>" ; 

                    $('#etapa').append(opcion); 
                                   
                }
                
              },
        error: function(result){
              
              console.log(result);
            },
            dataType: 'json'
        });
}

function traer_marca(){

    $('#marca1').html('');
    $.ajax({
      type: 'POST',
      data: { },
      url: 'index.php/Equipo/getmarca', //index.php/
      success: function(data){
             
               //var opcion  = "<option value='-1'>Seleccione...</option>" ; 
              $('#marca1').append(opcion); 
              for(var i=0; i < data.length ; i++) 
              {    
                  var nombre = data[i]['marcadescrip'];
                  var opcion  = "<option value='"+data[i]['marcaid']+"'>" +nombre+ "</option>" ; 
                  $('#marca1').append(opcion); 
                                 
              }
              
            },
      error: function(result){
            
            console.log(result);
          },
          dataType: 'json'
      });
}
// traer_sector();
// function traer_sector(){
//     $.ajax({
//         type: 'POST',
//         data: { },
//         url: 'index.php/Equipo/getsector', //index.php/
//         success: function(data){
               
//                  var opcion  = "<option value='-1'>Seleccione...</option>" ; 
//                   $('#sector').append(opcion); 
//                 for(var i=0; i < data.length ; i++) 
//                 {    
//                       var nombre = data[i]['descripcion'];
//                       var opcion  = "<option value='"+data[i]['id_sector']+"'>" +nombre+ "</option>" ; 

//                     $('#sector').append(opcion); 
                                   
//                 }
//               },
//         error: function(result){
              
//               console.log(result);
//             },
//             dataType: 'json'
//     });
// }

traer_empresa();
function traer_empresa(){
    $.ajax({
        type: 'POST',
        data: { },
        url: 'index.php/Equipo/getempresa', //index.php/
        success: function(data){
               
                 var opcion  = "<option value='-1'>Seleccione...</option>" ; 
                  $('#empresa').append(opcion); 
                for(var i=0; i < data.length ; i++) 
                {    
                      var nombre = data[i]['descripcion'];
                      var opcion  = "<option value='"+data[i]['id_empresa']+"'>" +nombre+ "</option>" ; 

                    $('#empresa').append(opcion); 
                                   
                }
                
              },
        error: function(result){
              
              console.log(result);
            },
            dataType: 'json'
    });
}

function traer_empresa2(){
    
    $.ajax({
        type: 'POST',
        data: { },
        url: 'index.php/Equipo/getcontra', //index.php/
        success: function(data){
                       
                var opcion  = "<option value='-1'>Seleccione...</option>" ; 
                $('#empresae').append(opcion); 
                for(var i=0; i < data.length ; i++) {    
                      
                      var nombre = data[i]['nombre'];
                      var opcion  = "<option value='"+data[i]['id_contratista']+"'>" +nombre+ "</option>" ; 
                      $('#empresae').append(opcion);                     
                }
              },
        error: function(result){
              
              console.log(result);
            },
            dataType: 'json'
    });
}

function click_empresa(){
      
      $("#adde").click(function (e) {

          var $empresae = $("select#empresae option:selected").html();
          var id_equipo= $('#codigoe').val();
          var id_contratista= $('#empresae').val();

          console.log(id_contratista);
          console.log(id_equipo);
          var tr = "<tr id='"+id_contratista+"' >"+
                            "<td><i class='fa fa-ban elirow' style='color: #f39c12'; cursor: 'pointer'></i></td>"+
                            "<td>"+id_equipo+"</td>"+
                            "<td>"+$empresae+"</td>"+
                            
                        "</tr>";
           

          $('#tablaempresa tbody').append(tr);
                
          $(document).on("click",".elirow",function(){
          var parent = $(this).closest('tr');
          $(parent).remove();
          });
               
          $('#empresae').val(''); 
           
      });
}
    
function click_co(id_equipo){
      
  console.log(id_equipo);

  $.ajax({
      type: 'POST',
      data: { id_equipo: id_equipo},
      url: 'index.php/Equipo/getco', //index.php/
      success: function(data){
              //var data = jQuery.parseJSON( data );
              
              //console.log(data);
             
              var fechai = data[0]['fecha_ingreso'];
              var fechag= data[0]['fecha_garantia']; 
              var mar = data[0]['marca']; 
              var ubica = data[0]['ubicacion']; 
              var descrip = data[0]['descripcion'];
              var codigoe= data[0]['codigo']; 

              $('#codigoe').val(codigoe);
              $('#fecha_ingresoe').val(fechai); 
              $('#fecha_garantiae').val(fechag);      
              $('#marcae').val(mar);   
              $('#descripcione').val(descrip);       
              $('#ubicacione').val(ubica);  

            },
        
      error: function(result){
            
            console.log(result);
          },
          dataType: 'json'
  });
   
}

function traer_codigo(){
    $.ajax({
        type: 'POST',
        data: { },
        url: 'index.php/Ficha/getcodigo', //index.php/
        success: function(data){
               
                 //var opcion  = "<option value='-1'>Seleccione...</option>" ; 
                $('#codigo').append(opcion); 
                for(var i=0; i < data.length ; i++) 
                {    
                  var nombre = data[i]['codigo'];
                  var opcion  = "<option value='"+data[i]['id_equipo']+"'>" +nombre+ "</option>" ; 

                  $('#codigo').append(opcion); 
                                   
                }
                
              },
        error: function(result){
              
              console.log(result);
            },
            dataType: 'json'
    });
}
traer_asegurado();
function traer_asegurado(){
    $.ajax({
        type: 'POST',
        data: { },
        url: 'index.php/Equipo/getasegurado', //index.php/
        success: function(data){
               
                 //var opcion  = "<option value='-1'>Seleccione...</option>" ; 
                $('#asegurado').append(opcion); 
                for(var i=0; i < data.length ; i++) 
                {    
                  var nombre = data[i]['codigo'];
                  var opcion  = "<option value='"+data[i]['id_equipo']+"'>" +nombre+ "</option>" ; 

                  $('#asegurado').append(opcion); 
                                   
                }
                
              },
        error: function(result){
              
              console.log(result);
            },
            dataType: 'json'
    });
}
function guardarficha(){

  console.log("El id de equipo es:");
  console.log(idglob);

    var marca = $('#marcamoto').val();
    var modelo = $('#modelomoto').val();
    var numerose= $('#numserie').val();
    var nummoto = $('#numeromoto').val();
    var fecha_ingreso = $('#fechrep').val();
    var dominio = $('#dom').val();
    var peso = $('#peso').val();
    var bateria = $('#bater').val();
    //var estado = $('#estado').val();
    var ano = $('#anfa').val();
    
    var parametros = {
       // 'id_equipo': id_equipo,
        'id_equipo': idglob,
        'marca': marca,
        'modelo': modelo,
        'numero_motor': nummoto,
        'numero_serie': numerose,
        'fecha_ingreso': fecha_ingreso,
        'dominio': dominio,
        'fabricacion': ano,
        'peso': peso,
        'bateria': bateria,
        'id_lectura' : 1,
        'id_seguro' : 1
       
    };

        console.log("estoy editando");
        console.log("parametros");
        $.ajax({
          type: 'POST',
          data: {data:parametros},
          url: 'index.php/Equipo/guardar_ficha',  //index.php/
          success: function(data){
                 
                  console.log(data);
                  //cargarVista(); 
                  regresa();                    
                },
          error: function(result){
                
                console.log(result);
                //$('#modalSale').modal('hide');
              }
              //dataType: 'json'
          });
}

// function guardarseguro(){

//     var asegurado1 = $('#asegurado').val();
//     var ref1 = $('#ref').val();
//     var poliza1 = $('#poliza').val();
//     var fechainicial= $('#fechaini').val();
//     var fechahasta = $('#fechahasta').val();
//     var cobertura1 = $('#cobertura').val();
       
//     var parametros = {
//        // 'id_equipo': id_equipo,
//         'asegurado': asegurado1,
//         'ref': ref1,
//         'numero_pliza': poliza1,
//         'fecha_inicio': fechainicial,
//         'fecha_vigencia': fechahasta,
//         'cobertura': cobertura1
               
//     };

//     console.log("Estoy Guardando seguro");
//     console.log(parametros);
//     $.ajax({
//           type: 'POST',
//           data: {data:parametros},
//           url: 'index.php/Equipo/guardar_seguro',  //index.php/
//           success: function(data){
                 
//                   console.log(data);
//                   //cargarVista(); 
//                   regresa();                    
//                 },
//           error: function(result){
                
//                 console.log(result);
//                 //$('#modalSale').modal('hide');
//               }
//               //dataType: 'json'
//     });
// }

function guardarseguro(){ 
 
    var asegurado1 = $('#asegurado').val();
    var ref1 = $('#ref').val();
    var poliza1 = $('#poliza').val();
    var fechainicial= $('#fechaini').val();
    var fechahasta = $('#fechahasta').val();
    var cobertura1 = $('#cobertura').val();
       
    var parametros = {
       // 'id_equipo': id_equipo,
        'asegurado': asegurado1,
        'ref': ref1,
        'numero_pliza': poliza1,
        'fecha_inicio': fechainicial,
        'fecha_vigencia': fechahasta,
        'cobertura': cobertura1
               
    };

    console.log("Estoy Guardando seguro");
    console.log(parametros);
    var hayError = false; 
    if( parametros !=0){                                     
      $.ajax({
          type:"POST",
          url: "index.php/Equipo/agregar_seguro", //controlador /metodo
          data:{parametros:parametros},
          success: function(data){
            console.log("exito");
            var datos= parseInt(data);
            console.log(datos);
              //alert(data);
              if(data > 0) //Agrego la descripcion dinamicamte en el select con id componente
              {  
                
                  var texto = '<option value="'+data+'">'+ parametros.asegurado +'</option>';
                  console.log(texto);

                  $('#asegurado').append(texto);
              }
               

            },
          
          error: function(result){
              console.log("entro por el error");
              console.log(result);
          },
           dataType: 'json'
     });
   
    }
    else { 
      alert("Por favor complete el nombre de la empresa, es un campo obligatorio");

    }

}

function guardarlectura() {
    
    var lectura = $("#formlectura").serializeArray();  
    $.ajax({
            type:"POST",
            url: "index.php/Equipo/setLectura", 
            data:lectura,
            success: function(data){
              console.log("Guardado con exito...");
              regresa();
            },          
            error: function(result){
                console.log("Error en guardado de Lectura...");
                console.log(result);
                 
            },
            dataType: 'json'
    });
}

function llamar_ficha(){
  
  $("#content").load("<?php echo base_url(); ?>index.php/Ficha/cargarequipoDos/<?php echo $permission; ?>/"+idglob+"");
}
 
function ingresar_ficha(){
  
  $("#content").load("<?php echo base_url(); ?>index.php/Ficha/cargarequipo/<?php echo $permission; ?>/"+idglob+"");
}
  /// Hitorial de lecturas
  $(".fa-history").click(function(e){
   
       $("tr.registro").remove();
       var $id_equipo = $(this).parent('td').parent('tr').attr('id');      

       console.log("id de equipo: ");
       console.log($id_equipo);
       $.ajax({
             type: 'POST',
             data: { idequipo: $id_equipo},
             url: 'index.php/Equipo/getHistoriaLect', 
             success: function(data){   
                   llenarModal(data);
                   console.log(data);
                   },
              
             error: function(result){
                  
                   console.log(result);
                 },
                 dataType: 'json'
       });   
   });

   /// llena modal historial de lecturas
  function llenarModal(data){

      $("#codEquipo").text(data[0]['codigo']);

      for (var i=0; i< data.length; i++) {      
        $("#tblhistorial tbody").append(  
         '<tr class="registro">'+         
              '<td class="clear">'+ data[i]['lectura'] +'</td>'+
              '<td class="clear">'+ data[i]['fecha'] +'</td>'+                            
              '<td class="clear">'+ data[i]['turno'] +'</td>'+
              '<td class="clear">'+ data[i]['operario'] +'</td>'+
              '<td class="clear">'+ data[i]['observacion'] +'</td>'+
          '</tr>'
       );
      }
  }    


</script>


<!-- Modal ASIGNAR-->
<div id="modalasignar" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Asignación de contratista a equipo</h4>
      </div>
      <div class="modal-body">
        <div class="row" >
          <div class="col-sm-12 col-md-12">
            <div role="tabpanel" class="tab-pane">
              <div class="form-group">
                <div class="panel panel-default">
                    <div class="panel-heading">
                      <h4 class="panel-title fa fa-cogs">   Datos del Equipo</h4>
                    </div>

                    <div class="panel-body">

                      <div class="col-xs-4">Codigo:
                         <input  id="codigoe" name="codigoe" class="form-control"/>
                            <input type="hidden" id="id_equipo" name="id_equipo">
                      </div>

                      <div class="col-xs-4">Ubicacion:
                        <input type="text" id="ubicacione" name="ubicacione" class="form-control" disabled>
                      </div>
                      <div class="col-xs-4">Marca:
                       <input type="text" id="marcae" name="marcae" class="form-control" disabled>
                        
                      </div>
                      
                      <div class="col-xs-4">Fecha de Ingreso:
                        <input type="date" id="fecha_ingresoe"  name="fecha_ingresoe" class="form-control input-md" disabled>
                      </div>
  
                      <div class="col-xs-4">Fecha de Garantia:
                          <input type="date" id="fecha_garantiae"  name="fecha_garantiae" class="form-control input-md" disabled>
                      </div>
  
                      <div class="col-xs-8">Descripcion: 
                      </div>        

                      <div class="row">
                        <div class="col-lg-12">
                        
                        <textarea class="form-control" id="descripcione" name="descripcione" disabled></textarea>
                        </div>
                      </div>

                    </div>
                 </div>
                </div>
              </div>
          </div>
        </div>
        <div>
          <ul class="nav nav-tabs" role="tablist">
            <li role="presentation" class="active"><a href="#choras" aria-controls="home" role="tab" data-toggle="tab" class="fa fa-file-text-o icotitulo">   Contratista</a></li>
          </ul>
          <div class="tab-content">
            <div role="tabpanel" class="tab-pane active" id="choras">
              <div class="row" >
                <div class="col-sm-12 col-md-12">
                  <br>
                  <fieldset><legend></legend></fieldset>
                    <div class="col-xs-4">
                      <select id="empresae" name="empresae" class="form-control"/>
                      <input type="hidden" id="id_contratista" name="id_contratista">
                    </div>
                                
                    <div class="col-xs-4">
                      <button type="button" class="btn btn-success" id="adde"><i class="fa fa-check">Agregar</i></button>
                    </div>
                </div>
              </div>
            </div>                             
            <div class="row" >
              <div class="col-sm-12 col-md-12">
                <table class="table table-bordered" id="tablaempresa"> 
                    <thead>
                      <tr>                     
                        <br>
                        <th width="2%"></th>
                        <th width="10%">Equipo</th>
                        <th width="10%">Contratistas Asignados</th>
                      </tr>
                    </thead>
                    <tbody></tbody>
                </table>
              </div>
            </div>
          </div>       
        </div>       
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal" onclick="cerro()">Cancelar</button>
        <button type="button" class="btn btn-primary" id="reset" data-dismiss="modal" onclick="guardarsi()">Guardar</button>
      </div>
    </div>
  </div>
</div>


<!-- Modal EDITAR-->
<div id="modaleditar" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title"><span class="fa fa-fw fa-pencil" style="color: #A4A4A4" > </span>Editar Equipo/Sector</h4>
          </div>
          <div class="modal-body">
            <div class="row" >
              <div class="col-sm-12 col-md-12">
                <div role="tabpanel" class="tab-pane">
                  <div class="form-group">
                      <div class="panel panel-default">
                          <div class="panel-heading">
                            <h4 class="panel-title  fa fa-cogs">  Datos del Equipo/ Sector </h4>
                          </div>
                          <div class="panel-body">
                            <div class="col-xs-12">
                              <div class="alert alert-danger alert-dismissable" id="error" style="display: none">
                                      <h4><i class="icon fa fa-ban"></i> Error!</h4>
                                      Revise que todos los campos esten completos...                  
                              </div>
                            </div>
                            <div class="col-xs-4">Codigo <strong style="color: #dd4b39">*</strong>:
                              <input type="text" id="codigo" name="codigo" class="form-control" placeholder="Ingrese Codigo">
                              <input type="hidden" id="id_equipo" name="id_equipo">
                            </div>
                            <div class="col-xs-4">Ubicacion <strong style="color: #dd4b39">*</strong>:
                              <input type="text" id="ubicacion" name="ubicacion" class="form-control" placeholder="Ingrese Ubicacion">
                            </div>
                            <div class="col-xs-4">Marca <strong style="color: #dd4b39">*</strong>:
                              <select id="marca1" name="marca1" class="form-control" value="" ></select> 
                            </div>                
                            <div class="col-xs-4">Fecha de Ingreso:
                              <input type="date" id="fecha_ingreso"  name="fecha_ingreso" class="form-control input-md">
                            </div>                
                            <div class="col-xs-4">Fecha de Ultima lectura:
                                <input type="date" id="fecha_ultimalectura"  name="fecha_ultima" class="form-control input-md">
                            </div>                
                            <div class="col-xs-4">Ultima Lectura:
                                <input type="text" id="ultima_lectura"  name="ultima_lectura" class="form-control input-md" placeholder="Ingrese Ultima Lectura">
                            </div>
                      
                            <div class="col-xs-4">Fecha de Garantia:
                                <input type="date" id="fecha_garantia"  name="fecha_garantia" class="form-control input-md">
                            </div>
                            <br>
                            <div class="col-xs-4">
                               <!-- <input type="text" id="estado"  name="estado" class="form-control input-md">-->
                            </div>
                            <div class="col-xs-8">                          
                            </div>
                            <div class="col-xs-10">
                            </div>   
                            <div class="col-xs-8">Descripcion <strong style="color: #dd4b39">*</strong>: 
                            </div>           

                            <div class="row">
                              <div class="col-lg-12">                  
                                <textarea class="form-control" id="descripcion" name="descripcion" placeholder="Ingrese Descripcion..."></textarea>
                              </div>
                            </div>
                          </div>
                      </div>
                  </div>
                  <div class="row" >
                    <div class="col-sm-12 col-md-12">
                      <div role="tabpanel" class="tab-pane">
                        <div class="form-group">
                          <div class="panel panel-default">
                              <div class="panel-heading">
                                <h4 class="panel-title  fa fa-globe">   Ubicacion del Equipo / Sector </h4>
                              </div>

                              <div class="panel-body">
                                <div class="col-xs-6">Empresa <strong style="color: #dd4b39">*</strong>:
                                  <select  id="empresa" name="empresa" class="form-control" />
                                  <!-- <input type="text" name="empresa" id="empresa" value="" placeholder="" class='ui-autocomplete-input' autocomplete='off'>
                                  class="selectpicker" data-size="5"-->
                                  <input type="hidden" id="id_empresa" name="id_empresa">
                                </div>
                                                   
                                <div class="col-xs-6">Sector <strong style="color: #dd4b39">*</strong> :
                                  <select id="etapa" name="etapa" class="form-control"   />
                                  <input type="hidden" id="id_sector" name="id_sector">
                                </div>
                                <br>                    

                                <div class="col-xs-6">Criticidad <strong style="color: #dd4b39">*</strong>:
                                  <select id="criticidad" name="criticidad" class="form-control"   />
                                  <input type="hidden" id="id_criticidad" name="id_criticidad">
                                </div>
                                
                                <div class="col-xs-6">Grupo <strong style="color: #dd4b39">*</strong>:
                                  <select id="grupo" name="grupo" class="form-control"></select>
                                  <input type="hidden" id="id_grupo" name="id_grupo">
                                </div>
                                <br>                    
                              </div>
                          </div>        
                        </div>
                      </div>    
                    </div>
                  </div>

                </div>
              </div>
              <div class="modal-footer">
                 <button type="button" class="btn btn-default" data-dismiss="modal" onclick="cerro()">Cancelar</button>
                  <button type="button" class="btn btn-primary" id="reset" data-dismiss="modal" onclick="guardar()">Guardar</button>
              </div>
            </div>
          </div>
    </div>
  </div>
</div>
<!-- / Modal EDITAR-->


<!-- Modal SEGURO -->
 <div class="modal fade" id="modalasegurado" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-lg" role="document" style="width: 40%">
    <div class="modal-content">

      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel"><span id="modalAction"> </span>Agregar Seguro </h4>
       </div> <!-- /.modal-header  -->

      <div class="modal-body input-group ui-widget" id="modalBodyArticle">
        
        <div class="row" >
          <div class="col-sm-12 col-md-12">
                               
           <div class="col-xs-4">Asegurado <strong style="color: #dd4b39">*</strong>:
            <input type="text" id="asegurado" name="asegurado" class="form-control"  placeholder="Ingrese Nombre del asegurado...">     
          </div>
          <div class="col-xs-4">Ref <strong style="color: #dd4b39">*</strong>:
            <input type="text" id="ref" name="ref" class="form-control"  placeholder="Ingrese Ref...">     
          </div>
          <div class="col-xs-4">Poliza <strong style="color: #dd4b39">*</strong>:
            <input type="text" id="poliza" name="poliza" class="form-control"  placeholder="Ingrese Poliza...">     
          </div>
          <div class="col-xs-4">Vigencia desde <strong style="color: #dd4b39">*</strong>:
            <input type="date" id="fechaini" name="fechaini" class="form-control" >     
          </div>
          <div class="col-xs-4">Hasta <strong style="color: #dd4b39">*</strong>:
              <input type="date" id="fechahasta" name="fechahasta" class="form-control" >     
          </div>
          <div class="col-xs-4">Cobertura <strong style="color: #dd4b39">*</strong>:
              <input type="text" id="cobertura" name="cobertura" class="form-control" >     
          </div>
                    
                    
          </div>
        </div>
      </div>
      <div class="modal-footer">
       
        <button type="button" class="btn btn-primary btn-sm" data-dismiss="modal" onclick="guardarseguro()" >Guardar</button>
      </div>  <!-- /.modal footer -->

       </div>  <!-- /.modal-body -->
    </div> <!-- /.modal-content -->

  </div>  <!-- /.modal-dialog modal-lg -->
</div>  <!-- /.modal fade -->
<!-- / Modal SEGURO -->


<!-- Modal LECTURA -->
<div class="modal fade" id="modalectura" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-lg" role="document" style="width: 40%">
    <div class="modal-content">
      
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel"><span id="modalAction"> </span>Lectura Equipo</h4>
      </div> <!-- /.modal-header  -->

      <div class="modal-body input-group ui-widget" id="modalBodyArticle"> 
        <form id="formlectura">
          <div class="row" >
            
            <div class="col-sm-12 col-md-12 col-xs-offset-6">                                      
              <label class="radio-inline" id="botestado"></label>
              <i href="#" class="fa fa-fw llave" style="color: #006400; cursor: pointer; margin-left: 15px;" title=""></i>
              <input type="hidden" name="estado" id="estado">
            </div>  <br><br>             

            <div class="col-sm-12 col-md-12">                               
              <div class="col-xs-12 clear">Equipo</div> <!-- <strong style="color: #dd4b39">*</strong>: -->
                <input type="text" id="maquina" class="form-control clear" disabled>
                <!-- id_equipo = id_maquina -->
                <input type="text" id="id_maquina" name="id_equipo" class="form-control hidden clear">     
            </div><br><br>
            <div class="clearfix"></div>

            <div class="col-sm-12 col-md-12">Lectura <strong style="color: #dd4b39">*</strong>:
                <input type="text" id="lectura" name="lectura" class="form-control clear"> 
            </div>
            <div class="col-sm-12 col-md-12">Operario <strong style="color: #dd4b39">*</strong>:
                <input type="text" id="operario" name="operario" class="form-control clear"> 
            </div>
            <div class="col-sm-12 col-md-12">Turno <strong style="color: #dd4b39">*</strong>:
                <input type="text" id="turno" name="turno" class="form-control clear"> 
            </div>
            <br><br><!-- <div class="clearfix"></div> -->             
              
            <div class="col-sm-12 col-md-12">Observaciones<strong style="color: #dd4b39">*</strong>:                      
                <textarea class="form-control clear" id="observacion" name="observacion" placeholder="Observaciones..."></textarea>
            </div> 
          </div>      
        </form>
      </div> 
      
      <div class="modal-footer">
        <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Cancelar</button>       
        <button type="button" class="btn btn-primary btn-sm" data-dismiss="modal" onclick="guardarlectura()">Guardar</button>
      </div>  <!-- /.modal footer -->

    </div>  <!-- /.modal-content --><!-- /.modal-body -->
  </div> <!-- /.modal-dialog modal-lg -->
</div>  <!-- /.modal fade -->
<!-- / Modal LECTURA -->

<!-- Modal Historial de Lecturas --> 
  <div class="modal fade" id="modalhistlect" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">

        <div class="modal-header">

          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="myModalLabel"><span id="modalAction"> </span> Historial de Lecturas</h4>
          <br>
          <label>Equipo: <span id="codEquipo"></span></label>
        </div> <!-- /.modal-header  -->


        <div class="modal-body">

          <table id="tblhistorial" class="table table-condensed table-responsive">
            <thead>                        
              <tr>                          
                <th>Lectura</th>
                <th>Fecha</th>                
                <th>Operario</th>
                <th>Turno</th>
                <th>Observación</th> 
              </tr>  
            </thead>
            <tbody>   </tbody>
          </table>                  

        </div> <!-- /.modal-body -->

        <div class="modal-footer">  

            <button type="button" class="btn btn-primary btn-sm" data-dismiss="modal">Aceptar</button>
        </div>  <!-- /.modal footer -->
      </div> <!-- /.modal-content -->

    </div>  <!-- /.modal-dialog modal-lg -->
  </div>  <!-- /.modal fade -->
        <!-- / Modal -->
<!-- / Modal Historial de Lecturas -->