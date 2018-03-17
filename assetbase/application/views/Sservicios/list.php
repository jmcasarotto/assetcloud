<input type="hidden" id="permission" value="<?php echo $permission;?>"> 
<section class="content">
    
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">

                <div class="box-header">
                    <h3 class="box-title">Solicitud de Servicios</h3>
                    <?php
                    // if (strpos($permission,'Add') !== false) {
                    echo '<button class="btn btn-block btn-success" style="width: 100px; margin-top: 10px;" data-toggle="modal" data-target="#modalservicio" id="btnAdd">Agregar</button>';
                    // }

                    // if () {
                       // echo '<button class="btn btn-block btn-success" style="width: 100px; margin-top: 10px;" id="activarSol">Activar</button>';
                    // }


                    ?>

                </div><!-- /.box-header -->

                <div class="box-body">
                    <table id="servicio" class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th width="20%">Acciones</th>
                                <th>Nro</th>
                                <th>fecha</th>
                                <th>Solicitante</th>
                                <th>Equipo</th>
                                <th>Sector</th>
                                <th>Grupo</th>
                                <th>Ubicacion</th>
                                <th>Causa</th>
                                <th>Estado</th>
                            </tr>
                        </thead>
                        <tbody>
                          <?php

                            $userdata = $this->session->userdata('user_data');
                            $usrId = $userdata[0]['usrId'];   
                            $grupoId = $userdata[0]["grpId"];

                              if(count($list) > 0) {
                                
                                foreach($list as $f){

                                    // usuario logueado o grupo administrador
                                  if (($f['usrId'] == $usrId) || ($grupoId == 1)) {
                                     
                                      $id_sol = $f['id_solicitud'];                                    
                                      $id_eq = $f['id_equipo'];

                                      echo '<tr id="'.$id_sol.'" class="'.$id_eq.'" data-idequipo="'.$id_eq.'" >' ;
                                      echo '<td>';

                                      if (strpos($permission,'Del') !== false) {

                                          echo '<i class="fa fa-fw fa-times-circle" style="color: #A4A4A4; cursor: pointer; margin-left: 15px;" title="Eliminar" onclick="Loadservicio('.$f['id_solicitud'].',\'Del\')"></i>';
                                      }

                                      if (strpos($permission,'Edit') !== false) {

                                          echo '<i class="fa fa-fw fa-pencil" style="color: #A4A4A4; cursor: pointer; margin-left: 15px;" title="Editar" onclick="Loadservicio('.$f['id_solicitud'].',\'Edit\')"></i>';
                                      }

                                      echo '<i class="fa fa-fw fa-print" style="color: #A4A4A4; cursor: pointer; margin-left: 15px;" title="Imprimir"  ></i> ';

                                      // echo '<i class="fa fa-picture-o" style="color: #A4A4A4; cursor: pointer; margin-left: 15px;" title="Imagen" onclick="Loadimag('.$f['id_solicitud'].',\'View\')"  ></i> '; 

                                      echo '<i class="fa fa-picture-o" style="color: #A4A4A4; cursor: pointer; margin-left: 15px;" title="Imagen" data-imagen ="'.$f['foto'].'" data-toggle="modal" data-target="#foto"></i> '; 

//


                                      if ($f['estado'] !== 'T') { 
                                      echo '<i class="fa fa-thumbs-up" data-toggle="modal" data-target="#modalConformidad" style="color: #A4A4A4; cursor: pointer; margin-left: 15px;" title="Conformidad"></i>';
                                      }

                                      if (strpos($permission,'Del') !== false) {
                                          //echo '<i class="fa fa-sticky-note-o" id="cargOrden" style="color: #A4A4A4; cursor: pointer; margin-left: 15px;" title="Informe de Servicios" ></i>';

                                          /*echo '<i class="fa fa-file-text" id="cargOrden" style="color: #A4A4A4; cursor: pointer; margin-left: 15px;" title="Orden de Trabajo" ></i>';*/
                                      }

                                      if (strpos($permission,'View') !== false) {

                                          // echo '<i class="fa fa-fw fa-search" style="color: #3c8dbc; cursor: pointer; margin-left: 15px;" title="Consultar" onclick="Loadservicio('.$f['id_solicitud'].',\'View\')"></i>';
                                      }

                                      echo '</td>';
                                      echo '<td style="text-align: left">'.$f['id_solicitud'].'</td>';
                                      echo '<td style="text-align: left">'.$f['f_solicitado'].'</td>';
                                      echo '<td style="text-align: left">'.$f['solicitante'].'</td>';
                                      echo '<td style="text-align: left">'.$f['equipo'].'</td>';
                                      echo '<td style="text-align: left">'.$f['sector'].'</td>';
                                      echo '<td style="text-align: left">'.$f['grupo'].'</td>';
                                      echo '<td style="text-align: left">'.$f['ubicacion'].'</td>';
                                      echo '<td style="text-align: left">'.$f['causa'].'</td>';
                                      /*echo '<td style="text-align: center">'.($f['estado'] == 'C' ? '<small class="label pull-left bg-green">Curso</small>' : '<small class="label pull-left bg-yellow">Solicitado</small>').'</td>';*/
                                      echo '<td style="text-align: center">'.($f['estado'] == 'C' ? '<small class="label pull-left bg-green">Curso</small>' :($f['estado'] == 'T' ? '<small class="label pull-left bg-blue">Terminado</small>' : '<small class="label pull-left bg-red">Solicitado</small>')).'</td>';
                                      echo '</tr>';

                                  } // if ($f['usrId'] == $usrId)
                                } // fin foreach($list as $f)   
                              } // fin if(count($list) > 0)

                          ?>
                        </tbody>
                    </table>
                </div><!-- /.box-body -->
            </div><!-- /.box -->
        </div><!-- /.col 8 -->
    </div><!-- /.row -->

</section><!-- /.content -->


<!-- carga solicitudes inactivas -->
<script>
 $('#activarSol').click( function cargarVista(){
    WaitingOpen();
    $('#content').empty();
    $("#content").load("<?php echo base_url(); ?>index.php/Sservicio/get_SolicTerminada/<?php echo $permission; ?>");
    WaitingClose();
  });
</script>
<!-- / carga solicitudes inactivas -->



<script>
  // Genera Orden de Servicio
  $('.fa-sticky-note-o').click( function cargarVista(){
      
      var id_sol = parseInt($(this).parent('td').parent('tr').attr('id'));
      var id_eq = parseInt($(this).parent('td').parent('tr').attr('class')); 
      WaitingOpen();
      $('#content').empty();
      $("#content").load("<?php echo base_url(); ?>index.php/Ordenservicio/cargarOrden/<?php echo $permission; ?>/"+id_sol+"/"+id_eq+"");
      WaitingClose();
  });
  $('.fa-times-circle').click( function cargarVista(){
    var id_solic = parseInt($(this).parent('td').parent('tr').attr('id'));
    alert(id_solic);
    $.ajax({
            type: 'POST',
            data: { id_solic: id_solic},
            url: 'index.php/Sservicio/elimSolicitud',
            success: function(result){
                        WaitingClose('Guardado exitosamente...');
                        //var permisos = '<?php //echo $permission; ?>';
                        var permisos = 'Add-Edit-Del-View-Asignar-Finalizar-OP-';
                        cargarView('Sservicio', 'index', permisos) ;                        
                  },
            error: function(result){
                  WaitingClose();
                  alert("Error en guardado...");
                },
                dataType: 'json'
      });

 });

  // Genera Orden de Trabajo y la guarda automaticamente 
  $('.fa-file-text').click( function cargarVista(){
     WaitingOpen('Guardando Orden de Trabajo...');
     // console.log($(this).parents("tr").data("idequipo"));

      $.ajax({
            type: 'POST',
            data: { id : $(this).parents("tr").attr('id'),  //id de solicitud de servicios
                    nro: $(this).parents("tr").find("td").eq(1).html(),                    
                    fech: $(this).parents("tr").find("td").eq(2).html(),
                    deta: $(this).parents("tr").find("td").eq(8).html(),                    
                    id_equipo: $(this).parents("tr").data("idequipo"),
                    act: 'Add',
                    cli: 1,     // Es 1 xq se crea el cliente por defecto al poner en funcionamiento
                    sucid:1
                  },
            url: 'index.php/Otrabajo/setotrabajo',
            success: function(result){
                        WaitingClose('Guardado exitosamente...');
                        //var permisos = '<?php //echo $permission; ?>';
                        var permisos = 'Add-Edit-Del-View-Asignar-Finalizar-OP-';
                        cargarView('Otrabajo', 'listOrden', permisos) ;                        
                  },
            error: function(result){
                  WaitingClose();
                  alert("Error en guardado...");
                },
                dataType: 'json'
      });
  });

  // Imprime Solicitud de Servicios
  $(".fa-print").click(function (e) {

    e.preventDefault();
    var idservicio = $(this).parent('td').parent('tr').attr('id');
    console.log("El id de solicitud de servicio al imprimir es :");
    console.log(idservicio);

    $.ajax({
        type: 'POST',
        data: { idservicio: idservicio},
        url: 'index.php/Sservicio/getsolImp', //index.php/
        success: function(data){
                    data = JSON.parse(data,true);
                    console.log(data);
                    console.log(data.datos.sec);
                    // console.log(data['f_solicitado']);
                    //alert("entre");
                    var fecha = new Date(data.datos.f_solicitado);
                    var day = fecha.getDate();
                    var month = fecha.getMonth() + 1;
                    var year = fecha.getUTCFullYear();
                    fecha = day + ' - ' + month + ' - ' + year;

                    datos={

                      'idservicio':idservicio,

                      'f_solicitado':data.datos.f_solicitado,
                      'solicitante':data.datos.solicitante,
                      'hora_sug':data.datos.hora_sug,
                      'codigo':data.datos.codigo,

                      //'descripcion':data['datos'][0]['descripcion'],
                      'ubicacion':data.datos.ubicacion,
                      'sector':data.datos.sec,
                      'grupo':data.datos.degr,
                      'causa':data.datos.causa,
                    };


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
                                              '<table width="100%" style="text-align:justify">'+
                                                '<tr>'+
                                                '<tr>'+
                                                  '<td  colspan="1"  align="left" valign="top">'+
                                                    '<div class="text-left"> <img src="img/logo.jpg" width="280" height="80" />'+
                                                     '</div>'+
                                                    '</td>'+
                                                    '<td>'+     
                                                    '<div class="col-xs-4" align="rigth">Solicitud Nº: '+datos.idservicio+
                                                      
                                                    '</div>'+

                                                    '<div class="col-xs-4">Fecha: '+fecha+
                                        
                                                    '</div>'+
                                                  '</td>'+

                                                '</tr>'+
                                                '<tr>'+
                                                  '<td >'+
                                                  '</td>'+
                                                '<tr>'+
                                                  '<td>'+
                                                  '<td/>'+
                                                  '<td height="4" colspan="4">'+
                                                    '<div class="col-xs-8">'+
                                                    '</h3>'+
                                                    '</div>'+
                                                  '</td>'+
                                                '</tr>'+
                                                '<tr>'+
                                                  '<td height="4" colspan="4">'+
                                                    '<div class="col-md-3 col-md-offset-9">Solicitado :  '+
                                                    '<br>'+
                                                    '<textarea class="form-control" id="solicitante" name="solicitante" style="padding-left:15px"  value='+datos.solicitante+' rows="2" cols="98">'+datos.solicitante+'</textarea>'+
                                                    '</div>'+
                                                      
                                                  '</td'+
                                                '</tr>'+
                                                
                                                '<tr>'+
                                                  '<td>'+
                                                  '<br>'+
                                                 
                                                    '<div class="col-md-3 col-md-offset-9">Equipo: '+
                                                    '<textarea class="form-control" id="equipo" name="equipo" style="padding-left:15px"  value='+datos.codigo+' rows="2" cols="46">'+datos.codigo+'</textarea>'+
                                                    '</div>'+
                                                    '<br>'+
                                                   
                                                    '<div class="col-md-3 col-md-offset-9">Ubicacion: '+
                                                    '<textarea class="form-control" id="ubicacion" name="ubicacion" style="padding-left:15px"  value='+datos.ubicacion+' rows="2" cols="46">'+datos.ubicacion+'</textarea>'+
                                                      
                                                    '</div>'+
                                                  '</td>'+
                                                 // '<br>'+
                                                  '<td>'+
                                                  '<br>'+
                                                  //'<br>'+
                                                                                       
                                                    '<div class="col-md-3 col-md-offset-9">Sector: '+
                                                      '<textarea class="form-control" id="sector" name="sector" style="padding-left:15px"  value='+datos.sector+' rows="2" cols="46">'+datos.sector+'</textarea>'+
                                                      
                                                    '</div>'+
                                                    '<br>'+
                                                    //'<br>'+
                                                    
                                                    
                                                    '<div class="col-md-3 col-md-offset-9">Grupo: '+
                                                    '<textarea class="form-control" id="grupo" name="grupo" style="padding-left:15px"  value='+datos.grupo+' rows="2" cols="46">'+datos.grupo+'</textarea>'+

                                                   '</td>'+
                                                '</tr>'+
                                                '</tr>'+
                                              '</table>'+
                                            '</div>'+
                                          '</div>'+
                                          '<br>'+
                                          '<div class="row">'+
                                            '<div class="col-xs-12">Causa: '+
                                            
                                            '</div>'+
                                            '<br>'+
                                            '<div class="col-xs-12">'+
                                              '<textarea class="form-control" id="descripcion" name="descripcion" style="padding-left:15px"  value='+datos.causa+' rows="4" cols="98">'+datos.causa+'</textarea>'+
                                            '</div>'+ 
                                          '</div>'+
                                          '<br>'+
                                          '<div class="row">'+
                                          '<div class="col-xs-3">'+
                                                                         
                                            
                                          // causa 93 '<div class="col-sm-12 col-md-12">'+
                                            
                                              //'<div class="col-sm-1>'+
                                                '<label for="inputPassword3" >Realizado:</label>'+
                                                
                                                  ' <input type="text" class="form-control" id="inputPassword3" size="32">'+
                                                '</div>'+
                                                '<br>'+
                                              
                                              '<div class="col-xs-3">'+
                                                '<label for="inputPassword3" >Supervisado:</label>'+
                                                
                                                  ' <input type="text" class="form-control" id="inputPassword3" size="30">'+
                                                '</div>'+
                                                '<br>'+
                                              
                                              
                                              '<div class="col-xs-3" align="rigth">'+
                                                '<label for="inputPassword3"  control-label">Fecha Realizado:</label>'+
                                         
                                                  ' <input type="text" class="form-control" id="inputPassword3" size="27">'+
                                                '</div>'+
                                                '<br>'+
                                              
                                              '<div class="col-xs-3">'+
                                              '<label for="inputPassword3" >Conforme servicio:</label>'+
                                              
                                                
                                                  '__________________________________'+
                                                '</div>'+    
                                            
                                          '</div>'+
                                          
                                          '<br>'+
                                          '<br>'+
                                          //
                                          '<div class="row">'+
                                            '<div class="col-xs-10 col-xs-offset-1" style="text-align: center">'+
                                           
                                              '<table  class="table table-bordered table-hover" style="text-align: center" >'+ //class="table table-bordered"
                                             
                                                '<tr align="center" bottom="middle>'+
                                                  '<td align="center" colspan="1" >'+
                                                    '<div class="text-center">'+
                                                    ' <img src="img/logo.jpg" width="280" height="80" align="right"/>'+
                                                    '</div>'+
                                                  '</td>'+
                                                  //'<br>'+
                                                '</tr>'+
                                                '<tr>'+
                                                  '<td><h3> Vale de Materiales:'+'</h3>'+
                                                  '</td>'+
                                                '</tr>'+
                                              '</table>'+
                                            '</div>'+
                                          '</div>'+
                                          //'<br>'+
                                          //style="text-align: center"
                                          
                                          '<div class="row">'+
                                            '<div class="col-xs-10 col-xs-offset-1 text-center">'+
                                           
                                              '<table class="table table-bordered"  border="1px solid black"  >'+ //class="table table-bordered"
                                             
                                                '<tr colspan="8">'+
                                                  '<th width="2%">Item  (Tachar sino corresponde)</th>'+
                                                  '<th width="15%">Codigo</th>'+ 
                                                  '<th width="40%">Descripcion</th>'+
                                                  '<th width="5%">Cantidad</th>'+
                                                '</tr>'+
                                                '<tr>'+
                                                  '<td style="text-align: center" >1</td>'+
                                                  '<td><br></td>'+
                                                  '<td><br></td>'+
                                                  '<td><br></td>'+
                                                '</tr>'+
                                                '<tr>'+
                                                  '<td style="text-align: center" >2</td>'+
                                                  '<td><br></td>'+
                                                  '<td><br></td>'+
                                                  '<td><br></td>'+
                                                '</tr>'+
                                                '<tr>'+
                                                  '<td style="text-align: center" >3</td>'+
                                                  '<td><br></td>'+
                                                  '<td><br></td>'+
                                                  '<td><br></td>'+
                                                '</tr>'+
                                                '<tr>'+
                                                  '<td style="text-align: center" >4</td>'+
                                                  '<td><br></td>'+
                                                  '<td><br></td>'+
                                                  '<td><br></td>'+
                                                '</tr>'+
                                                '<tr>'+
                                                  '<td style="text-align: center" >5</td>'+
                                                  '<td><br></td>'+
                                                  '<td><br></td>'+
                                                  '<td><br></td>'+
                                                '</tr>'+
                                                
                                              '</table>'+ 
                                            '</div>'+
                                          '</div>'+
                                          '<br>'+
                                          '<div class="row">'+
                                            '<div class="col-sm-12 col-md-12">'+
                                              '<div class="col-sm-2-2">Entrega (Firma y aclaracion): '+ 
                                              '<input type="text"  size="30">'+
                                                      
                                              '</div>'+
                                              '<br>'+
                                              '<div class="col-sm-2-2">Recibe (Firma y aclaracion): '+ '<input type="text"  size="30">'+
                                             
                                              '</div>'+
                                            '</div>'+
                                          '</div>'+                                                            

                                        '</div>'+
                                      '</div>'+
                                    '</div>'+
                                   
                                  '</div>'+
                                '</div>'+
                              '</div>'+
                              '<style>'+
                                 '.table, .table>tr, .table>td {border: 2px solid #f4f4f4;} '+
                              '</style>';


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
                //dataType: 'json'
    });
  });

  // Levanta imagen de solicitud
  $('.fa-picture-o').click(function(){
     var imag = $(this).data('imagen');
     $('#imgSolServ').attr('src',imag)
    //alert(imag);
  });

</script>

<!-- Datepicker -->
<script>  
  $("#vstFecha").datepicker({    
      firstDay: 0      
    }).datepicker("setDate", "+1d"); // agrega la cantidad de dias o meses a partir de hoy

 
  $("#fecha_conformidad").datepicker({
    dateFormat: 'yy/mm/dd',
    firstDay: 1
  }).datepicker("setDate", new Date());
</script>
<!-- / Datepicker -->

<!-- Trae Sectores y autocompleta el campo -->
<script>
  $( function() {

      var dataF = function () {
          var tmp = null;
          $.ajax({
              'async': false,
              'type': "POST",
              'global': false,
              'dataType': 'json',
              'url': "Sservicio/getSector",
              'success': function (data) {
                  tmp = data;
              }
          });
          return tmp;
      }();

      $(function() {
          $(".buscSector").autocomplete({
              source: dataF,
              delay: 100,
              minLength: 1,
              focus: function(event, ui) {
                  // prevent autocomplete from updating the textbox
                  event.preventDefault();
                  // manually update the textbox
                  $(this).val(ui.item.label);
              },
              select: function(event, ui) {
                  // prevent autocomplete from updating the textbox
                  event.preventDefault();
                  // manually update the textbox and hidden field
                  $(this).val(ui.item.label);
                  $("#idSector").val(ui.item.value);

                  $("#equipSelec").html("");
                  // guardo el id de sector
                  var idSect =  $("#idSector").val();
                  getEquiSector(idSect);

                  //console.log("id sector en autocompletar: ");
                  //console.log(ui.item.value);
              },
          });
      });

      function getEquiSector(idSect){

        var id =  idSect;
        console.log("id de sector para traer equipos");
        console.log(id);

        $.ajax({
                'data' : {id_sector : id },
                'async': true,
                'type': "POST",
                'global': false,
                'dataType': 'json',
                'url': "Sservicio/getEquipSector",
                'success': function (data) {
                    console.log("Entro por getEquiSector ok");
                    //console.log(data[0]['id_equipo']);

                     // Asigna opciones al select Equipo en modal
                    var $select = $("#equipSelec");

                    for (var i = 0; data[i]['id_equipo'].length; i++) {

                      $select.append($('<option />', { value: data[i]['id_equipo'], text: data[i]['descripcion'] }));
                    }

                 },
                'error' : function (data){
                  console.log('Error en getEquiSector');
                  alert('error');
                 },

        });
      }
  });
</script>
<!--  / Trae Sectores y autocompleta el campo -->


<!-- Guardado de datos y validaciones -->
<script>

  $("#btnSave").click(function(){

  	var hayError = false;
    if($('#nombre').val() == '')
    {
    	hayError = true;
    }
    if($('#equipId').val() == '')
    {
      hayError = true;
    }
    if($('#vstsolicita').val() == '')
    {
      hayError = true;
    }
    if($('#vstNote').val() == '')
    {
      hayError = true;
    }

    if(hayError == true){
    	$('#error').fadeIn('slow');
    	return;
    }

    $('#error').fadeOut('slow');
    //WaitingOpen('Guardando cambios');
    	$.ajax({
          	type: 'POST',
          	data: {
                    equip: $('#equipSelec').val(),
                    solici: $('#vstsolicita').val(),
                    fecha: $('#vstFecha').val(),
                    hora: $('#vstHora').val(),
                    min: $('#vstMinutos').val(),
                    falla: $('#vstNote').val(),
                  },
        		url: 'index.php/Sservicio/setservicios',
        		success: function(result){
                    		//WaitingClose('Guardado exitosamente...');
                    		var permisos = '<?php echo $permission; ?>';
                        cargarView('Sservicio', 'index', permisos) ;
                        //alert("guardado con exito");
        					},
        		error: function(result){
        					//WaitingClose();
        					alert("Error en guardado...");
        				},
              	dataType: 'json'
    		});
  });
</script>
<!-- / Guardado de datos y validaciones -->

<!-- Guardar conformidad -->
<script>
  $('.fa-thumbs-up').click(function(){
      var id = $(this).parent('td').parent('tr').attr('id'); 
      $('.clear').val('');
      $('#id_sol').val(id);

  });
  function guardarConf(){
    
    var hayError = false;
    if($('#fecha_conformidad').val() == '')
    {
      hayError = true;
    }
    if($('#id_sol').val() == '')
    {
      hayError = true;
    }    

    if(hayError == true){
      $('#errorconf').fadeIn('slow');
      return;
    }

    $('#errorconf').fadeOut('slow');

    WaitingOpen('Guardando...');
    var data = $('#formConform').serializeArray();
    $.ajax({
            type: 'POST',
            data: data,
            url: 'index.php/Sservicio/confSolicitud',
            success: function(result){
                        WaitingClose('Guardado exitosamente...');
                        var permisos = '<?php echo $permission; ?>';
                        cargarView('Sservicio', 'index', permisos) ;
                        //alert("guardado con exito");
                  },
            error: function(result){
                  WaitingClose();
                  alert("Error en guardado...");
                },
                dataType: 'json'
        });
  }

</script>

<!-- Datatable -->
<script>
  $(function () {
    
    $('#servicio').DataTable({
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
</script>
<!-- / Datatable -->

<!-- Modal -->
<div class="modal fade" id="modalservicio" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel"><span id="modalAction"> </span> Solicitud Servicios</h4>
      </div>
      <div class="modal-body" id="modalBodyservicio">
        <div class="row">

            <div class="col-xs-12">
                <div class="alert alert-danger alert-dismissable" id="error" style="display: none">
                    <h4><i class="icon fa fa-ban"></i> Error!</h4>
                        Revise que todos los campos esten completos...
                </div>
            </div>
                <style>
                  .ui-autocomplete{
                      z-index:1050;
                  }
                </style>
                <div class="col-xs-3">
                    <label style="margin-top: 7px;">Sector<strong style="color: #dd4b39">*</strong>: </label>
                </div>
                <div class="col-xs-9">
                    <input type="text" class="form-control buscSector" placeholder="Buscar Sector..." id="buscSector" name="buscSector" style="width: 80%;">
                    <input type="text" class="hidden idSector" id="idSector" name="idSector">
                </div> <br> <br>

                <div class="col-xs-3">
                    <label style="margin-top: 7px;">Equipo <strong style="color: #dd4b39">*</strong>: </label>
                </div>
                <div class="col-xs-9">
                    <select name="equipSelec" class="form-control equipSelec" id="equipSelec" style="width: 80%;">
                      <option value="-1" placeholder="Seleccione..."></option>
                    </select>

                </div>
                <br/><br/>
                <br>
                <div class="col-xs-3">
                    <label style="margin-top: 7px;">Solicitante: </label>
                </div>
                <div class="col-xs-9">
                    <input placeholder="Solicitante" class="form-control" rows="3" id="vstsolicita" value="">
                </div>
                <br><br>
                <div class="col-xs-3">
                    <label style="margin-top: 7px;">Fecha Sugerido <strong style="color: #dd4b39">*</strong>: </label>
                </div>
                <div class="col-xs-9">
                    <input class="form-control datepicker" placeholder="dd-mm-aaaa" name="datepicker" id="vstFecha">
                </div>
                <br><br>

                <div class="col-xs-3">
                    <label style="margin-top: 7px;">Horario sugerido <strong style="color: #dd4b39">*</strong>: </label>
                </div>
                <div class="col-xs-2">
                    <select class="form-control" id="vstHora" style="width: 100%;">
                      <option value="08">08</option>
                      <option value="09">09</option>
                      <option value="10">10</option>
                      <option value="11">11</option>
                      <option value="12">12</option>
                      <option value="13">13</option>
                      <option value="14">14</option>
                      <option value="15">15</option>
                      <option value="16">16</option>
                      <option value="17">17</option>
                      <option value="18">18</option>
                      <option value="19">19</option>
                      <option value="20">20</option>
                      <option value="21">21</option>
                      <option value="22">22</option>
                    </select>
                </div>
                <div class="col-xs-1">
                  :
                </div>
                <div class="col-xs-2">
                    <select class="form-control select_equip" id="vstMinutos" style="width: 100%;">
                      <option value="00">00</option>
                      <option value="15">15</option>
                      <option value="30">30</option>
                      <option value="45">45</option>
                    </select>
                </div>
                <br><br>

                <div class="col-xs-3">
                    <label style="margin-top: 7px;">Falla: </label>
                </div>
                <div class="col-xs-9">
                    <textarea placeholder="Agregar una Nota" class="form-control" rows="3" id="vstNote" value=""></textarea>
                </div>
                <br>
        </div>
      </div> <!--/ .modal-body -->
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
        <button type="button" class="btn btn-primary" data-dismiss="modal" id="btnSave">Guardar</button>
      </div>
    </div> <!-- / .modal-conten -->
  </div>
</div>


<!-- Modal Conformidad -->
<div class="modal fade" id="modalConformidad" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-lg" role="document" style="width: 40%">
    <div class="modal-content">
      
      <div class="row">
        <div class="col-xs-12">
          <div class="alert alert-danger alert-dismissable" id="errorconf" style="display: none">
                <h4><i class="icon fa fa-ban"></i> Error!</h4>
                Revise que todos los campos esten completos
            </div>
        </div>
      </div>


      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel"><span id="modalAction"> </span>Conformidad</h4>
      </div> <!-- /.modal-header  -->

      <div class="modal-body input-group ui-widget" id="modalBodyArticle"> 
        <form id="formConform">
          <div class="row" >
           
            <div class="col-sm-12 col-md-12">                               
              <div class="col-xs-4 clear">Fecha</div> <!-- <strong style="color: #dd4b39">*</strong>: -->
                <input type="text" id="fecha_conformidad" name="fecha_conformidad" class="form-control">
                <input type="hidden" id="id_sol" name="id_sol" class="form-control clear">
            </div><br><br>
            <div class="clearfix"></div>
            <br><br><!-- <div class="clearfix"></div> -->    
            <div class="col-sm-12 col-md-12">Observaciones<strong style="color: #dd4b39">*</strong>:                      
                <textarea class="form-control clear" id="observ_conformidad" name="observ_conformidad" placeholder="Observaciones..."></textarea>
            </div> 
          </div>      
        </form>
      </div> 
      
      <div class="modal-footer">
        <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Cancelar</button>       
        <button type="button" class="btn btn-primary btn-sm" data-dismiss="modal" onclick="guardarConf()">Guardar</button>
      </div>  <!-- /.modal footer -->

    </div>  <!-- /.modal-content --><!-- /.modal-body -->
  </div> <!-- /.modal-dialog modal-lg -->
</div>  <!-- /.modal fade -->
<!-- / Modal Conformidad -->

<!-- Modal Foto-->
<div class="modal fade" id="foto" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Imagen de Solicitud de Servicio</h4>
      </div>
      <div class="modal-body">
        
        <div class="row">
  
          <div class="col-md-6 col-md-offset-3">
            <img id="imgSolServ" src="" style="max-width: 300px; float: center;">
          </div>
        </div>        



        
      </div>
      <div class="modal-footer">
        
        <button type="button" class="btn btn-primary" data-dismiss="modal">Aceptar</button>
      </div>
    </div>
  </div>
</div>


 

