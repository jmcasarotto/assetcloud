<input type="hidden" id="permission" value="<?php echo $permission;?>">
<section class="content">
  <div class="row">

    <div class="col-md-12">
          <div class="box box-primary">
              <div class="box-header with-border">
                  <h3 class="box-title">Notificaciones</h3>
                  <!--<span class="label label-primary pull-right"><i class="fa fa-info"></i></span>-->
                  <div class="box-tools pull-right">
                      <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                  </div><!-- /.box-tools -->
              </div><!-- /.box-header -->
              <div class="box-body">

                  <div class="row">
                      <div class="col-md-4 col-xs-12">
                        <div id="graph-container" style="width:100%; max-width: 250px; margin:0 auto 20px;">
                          <canvas id="miGrafico" ></canvas>
                        </div>
                      </div>


                      <div class="col-md-4 col-xs-12">
                          <!-- Apply any bg-* class to to the info-box to color it -->
                          <div class="info-box bg-green">
                              <span class="info-box-icon"><i class="ion ion-information-circled"></i></span>
                              <div class="info-box-content">
                                  <span class="info-box-text">Ordenes en curso</span>
                                  <span class="info-box-number"><?php cantOrdenesEnCurso(); ?></span>
                                  <!-- The progress section is optional -->
                                  <div class="progress">
                                      <div class="progress-bar" style="width: 100%"></div>
                                  </div>
                                  <span class="progress-description">
                                      Hay <?php cantOrdenesEnCurso(); ?> ordenes en curso.
                                  </span>
                              </div><!-- /.info-box-content -->
                          </div><!-- /.info-box -->

                          <div class="small-box bg-blue">
                                <div class="inner">
                                    <h3>96%</h3>
                                    <p>Cumplimiento</p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-information-circled"></i>
                                </div>
                                <span class="small-box-footer"> EL x96%x de las órdenes se solucionaron antes de su vencimiento.</span>
                            </div>
                      </div>

                      <div class="col-md-4 col-xs-12">
                          <div class="info-box bg-yellow">
                              <span class="info-box-icon"><i class="ion ion-information-circled"></i></span>
                              <div class="info-box-content">
                                  <span class="info-box-text">Órdenes Asignadas</span>
                                  <span class="info-box-number"><?php echo date('d-m-Y'); ?></span>
                                  <!-- The progress section is optional -->
                                  <div class="progress">
                                      <div class="progress-bar" style="width: 100%"></div>
                                  </div>
                                  <span class="progress-description">
                                      Hay <?php cantOrdenesAsignadas(); ?> órdenes de servicio asignadas.
                                  </span>
                              </div><!-- /.info-box-content -->
                          </div><!-- /.info-box -->

                          <div class="small-box bg-red">
                                <div class="inner">
                                    <h3><?php echo round( cantOrdenesVencidas(false)/cantOrdenesServicio(false)*100, 2); ?>%</h3>
                                    <p>Es la morosidad actualmente.</p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-android-warning"></i>
                                </div>
                                <!--<a href="#" class="small-box-footer">Más info <i class="fa fa-arrow-circle-right"></i></a>-->
                            </div>
                      </div>

                  </div>
              </div><!-- /.box-body -->
          </div><!-- /.box -->
     </div><!-- /.col -->

    <div class="col-xs-12">
      <div class="box">
        <div class="box-header">
          <h3 class="box-title">Orden de trabajo</h3>
          <?php
          if (strpos($permission,'Add') !== false) {
            echo '<button class="btn btn-block btn-success" style="width: 100px; margin-top: 10px;" data-toggle="modal" onclick="LoadOT(0,\'Add\')" id="btnAdd">Agregar</button>';
          }
          ?>
        </div><!-- /.box-header -->
        <div class="box-body">
          <table id="otrabajo" class="table table-bordered table-hover">
            <thead>
              <tr>
                <th width="20%">Acciones</th>
                <th>Nro</th>
                <th>Fecha</th>
                <th>Fecha Entrega</th>
                <th>Fecha Terminada </th>
                <th>Detalle </th>
                <th>Cliente </th>
                <th>Solicita </th>
                <th>Estado </th>

              </tr>
            </thead>
            <tbody>
              <?php
                if(count($list) > 0) {
                	foreach($list as $a)
      		        {
                    $id=$a['id_orden'];
                    echo '<tr id="'.$id.'">';
  	                echo '<td>';
                    if (strpos($permission,'Edit') !== false) {
  	                	echo '<i class="fa fa-fw fa-pencil" style="color: #f39c12; cursor: pointer; margin-left: 15px;" onclick="LoadOT('.$a['id_orden'].',\'Edit\')"></i>';
                    }
                    if (strpos($permission,'Del') !== false) {
  	                	echo '<i class="fa fa-fw fa-times-circle" style="color: #dd4b39; cursor: pointer; margin-left: 15px;" onclick="LoadOT('.$a['id_orden'].',\'Del\')"></i>';
                    }
                    if (strpos($permission,'View') !== false) {
  	                	echo '<i class="fa fa-fw fa-search" style="color: #3c8dbc; cursor: pointer; margin-left: 15px;"  title="Mostrar Orden" onclick="LoadOT('.$a['id_orden'].',\'View\')"></i>';
                    }
                    if (strpos($permission,'Asignar') !== false) {
                      echo '<i class="fa fa-thumb-tack " style="color: #3c8dbc; cursor: pointer; margin-left: 15px;" title="Asignar a Taller"></i>';
                    }
                    if (strpos($permission,'Finalizar') !== false) {
                      echo '<i class="fa fa-thumbs-up" style="color: #3c8dbc; cursor: pointer; margin-left: 15px;" title="Finalizar Orden" onclick="finalOT('.$a['id_orden'].',\'View\')"></i>';
                    }
                    if (strpos($permission,'OP') !== false) {
                      echo '<i class="fa fa-tags" style="color: #3c8dbc; cursor: pointer; margin-left: 15px;"  title="Cargar Pedido "  onclick="LoadOT('.$a['id_orden'].',\'View\')"></i>';
                    }
                    if (strpos($permission,'Pedidos') !== false) {
                      echo '<i class="fa fa-truck" style="color: #3c8dbc; cursor: pointer; margin-left: 15px;"  title="Mostrar Perdido " onclick="LoadOT('.$a['id_orden'].',\'View\')"></i>';
                    }
  	                echo '</td>';
                    echo '<td style="text-align: right">'.$a['nro'].'</td>';
  	                echo '<td style="text-align: left">'.$a['fecha_inicio'].'</td>';
                    echo '<td style="text-align: right">'.$a['fecha_entrega'].'</td>';
                    echo '<td style="text-align: right">'.$a['fecha_terminada'].'</td>';
                    echo '<td style="text-align: right">'.$a['descripcion'].'</td>';
                    echo '<td style="text-align: left">'.$a['cliLastName'].' , '.$a['cliName'].'</td>';
                    echo '<td style="text-align: right">'.$a['usrName'].'</td>';
                    echo '<td style="text-align: center">'
                    .($a['estado'] == 'C' ? '<small class="label pull-left bg-green">Curso</small>' :
                     ($a['estado'] == 'P' ? '<small class="label pull-left bg-blue">Pedido</small>' :
                     ($a['estado'] == 'Cr' ? '<small class="label pull-left bg-yellow">Critico</small>' :
                     ($a['estado'] == 'V' ? '<small class="label pull-left bg-red">Vencido</small>' :
                     ($a['estado'] == 'T' ? '<small class="label pull-left bg-purple">Terminado</small>' :
                      '<small class="label pull-left bg-teal">Asignado</small>'))))).'</td>';
  	                echo '</tr>';

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
  graficarParametro();
  /* grafico usando charjs 2.5 */
  function graficarParametro() {
    var areaChartCanvas = document.getElementById("miGrafico");

    var myChart = new Chart(areaChartCanvas, {
      type: 'doughnut',
      data: {
        labels: ["En curso", "Asignado", "Crítico", "Vencido"],
        datasets: [{
          data: [<?php cantOrdenesEnCurso(); ?>, <?php cantOrdenesAsignadas(); ?>, <?php cantOrdenesCritico(); ?>, <?php cantOrdenesVencidas(); ?>],
          backgroundColor: [
          "#00a65a",
          "#f39c12",
          "#D81B60",
          "#dd4b39",
          ],
          hoverBackgroundColor: [
          "#00a65a",
          "#f39c12",
          "#D81B60",
          "#dd4b39",
          ]
        }]
      },
      options: {
        cutoutPercentage: 40
      }
    });
  }


  $(function () {
    //$("#groups").DataTable();
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

  var idArt = 0;
  var acArt = '';

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

//Asignar

$(".fa-thumb-tack").click(function (e) {

        $('#modalAsig').modal('show');

        var id_orden = $(this).parent('td').parent('tr').attr('id');

        $.ajax({
          type: 'GET',
          data: { id_orden: id_orden},
          url: 'index.php/Otrabajo/getasigna', //index.php/
          success: function(data){
                  //var data = jQuery.parseJSON( data );

                  console.log(data);

                  datos={
                    'id_orden':id_orden,

                    'nro':data['datos'][0]['nro'],
                    'fecha_inicio':data['datos'][0]['fecha_inicio'],
                    'estado':data['datos'][0]['estado'],
                    'descripcion':data['datos'][0]['descripcion'],

                    'cliente': data['datos'][0]['cliLastName']+' '+data['datos'][0]['cliName'],

                    'cliId':data['datos'][0]['cliId'],
                    'id_usuario':data['datos'][0]['id_usuario'],

                  };

                  var arre = new Array();
                  arre=datos['fecha_inicio'].split(' ');

                  //edit=1;
                  $('#id_orden').val(datos['id_orden']);
                  $('#nro').val(datos['nro']);
                  $('#fecha_inicio').val(arre[0]);

                  $('#estado').val(datos['estado']);
                  $('#cliente').val(datos['cliente']);
                  $('#id_cliente').val(datos['cliId']);

                  $('#descripcion').val(datos['descripcion']);
                   $('#id_usuario').val(datos['id_usuario']);


                  //completarEdit(datos, edit);
                  //OpenSale();
                  click_pedent();
                },

          error: function(result){

                console.log(result);
              },
              dataType: 'json'
          });

    });

 /*$('#btnorden').click(function(){

      $('#nro').val('');
      $('#fecha_inicio').val('');
      $('#fecha_entrega').val('');
      $('#descripcion').val('');
      $('#estado').val('');
      $('#cliente').val('');
      $('#usuario').val('');


      $('#modalAsig').modal('show');


       //OpenSale();
    });*/


  function traer_clientes(idcliente){
    $.ajax({
          type: 'POST',
          data: { idcliente: idcliente},
          url: 'index.php/otrabajo/getcliente',  //index.php/
          async:false,
          success: function(data){
                  //var data = jQuery.parseJSON( data );

                  //console.log(data);
                  $('#cliente option').remove();
                   var opcion  = "<option value='-1'>Seleccione...</option>" ;
                  $('#cliente').append(opcion);
                  for(var i=0; i < data.length ; i++)
                  {
                    //console.log( data[i]);
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
    		url: 'index.php/otrabajo/setotrabajo',
    		success: function(result){
                			WaitingClose();
                			$('#modalOT').modal('hide');
                			setTimeout("cargarView('otrabajos', 'index', '"+$('#permission').val()+"');",1000);
    					},
    		error: function(result){
    					WaitingClose();
    					alert("error");
    				},
          	dataType: 'json'
    		});
  });
traer_usuario();


  function traer_usuario(){
      $.ajax({
        type: 'POST',
        data: { },
        url: 'index.php/otrabajo/getusuario', //index.php/
        success: function(data){

                 var opcion  = "<option value='-1'>Seleccione...</option>" ;
                  $('#usuario').append(opcion);
                for(var i=0; i < data.length ; i++)
                {
                      var nombre = data[i]['usrName'];
                      var opcion  = "<option value='"+data[i]['usrId']+"'>" +nombre+ "</option>" ;

                    $('#usuario').append(opcion);

                }
              },
        error: function(result){

              console.log(result);
            },
            dataType: 'json'
        });
  }



  // trae grupo en el select  // esto no estaria funcionando
  function traer_grupo(){

      //var id_usuario= $("#usuario").val();
      //console.log(id_usuario);
      $.ajax({
        type: 'POST',
        data: {},
        url: 'index.php/otrabajo/getgrupo', //index.php/
        success: function(data){

                var opcion  = "<option value='-1'>Seleccione...</option>" ;
                $('#grupo').append(opcion);

                for(var i=0; i < data.length ; i++)
                {
                      var nombre = data[i]['grpName'];
                      var opcion  = "<option value='"+data[i]['grpId']+"'>" +nombre+ "</option>" ;

                    $('#grupo').append(opcion);

                }
              },
        error: function(result){

              console.log(result);
            },
            dataType: 'json'
        });
  }




  function traer_proveedor(){
    //var id_proveedor = $(this).val();
    //console.log(id_proveedor);
    //var id_proveedor= $("#proveedor").val()
      $.ajax({
        type: 'POST',
        data: {},
        url: 'index.php/otrabajo/getproveedor', //index.php/
        success: function(data){

                 var opcion  = "<option value='-1'>Seleccione...</option>" ;
                  $('#proveedor').append(opcion);
                for(var i=0; i < data.length ; i++)
                {
                      var nombre = data[i]['razon_social'];
                      var opcion  = "<option value='"+data[i]['id_proveedor']+"'>" +nombre+ "</option>" ;

                    $('#proveedor').append(opcion);
                }
              },
        error: function(result){

              console.log(result);
            },
            dataType: 'json'
        });


  }


 function click_pedent()
  {  var fechai= $("#fecha_inicio").val(); //optengo el valor del campo fecha
     $.ajax({
          type: 'GET',
          data: {fechai:fechai }, /* destinodo*/
          url: 'index.php/Otrabajo/getpedidos', //index.php/
          success: function(data){
                  //var data = jQuery.parseJSON( data );

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

   /* $("#pedent").click(function(){

         bootbox.dialog({
          backdrop: true,
          title: "Pedidos a Entregar",
          message: '<label>hoolaaaa</label>',
            buttons: {
                  success: {
                      label: "Aceptar",
                className:"btn-primary guardar" ,
                      callback: function (e) {
                        var fechai= $("#fecha_inicio").val(); //optengo el valor del campo fecha

                        //aca se mete una peticion ajax los valores del formularios dentro del sucess
                        //aca va el arreglo

                        // armar un strping que simula un option y se agrega el select con el id del select .append
                          return ;

                      }//fin calback
                  }//fin success
              },//fin Buttons
              onEscape: function() {return ;},
          });  //FIN DIALOG

    }); */
  }

  function click_addproveedor()
  {
      $("#addproveedor").click(function(){
            alert('click');
           bootbox.dialog({
            backdrop: true,
            title: "Agregar Proveedor",
            message:'<form role="form" id="agregarP" name="agregarP" >'+
                      '<div class="row" >'+
                        '<div class="col-sm-12 col-md-12">'+
                          '<fieldset> </fieldset>'+
                            '<br>'+
                              '<div class="col-xs-8">Razon Social:'+
                                '<input type="text"   class="form-control input-md" id="nomb"  name="nomb" placeholder="Ingrese Nombre de la empresa" >'+
                              '</div>'+

                              '<div class="col-xs-8">Direccion:'+
                                '<input type="text"  class="form-control input-md" id="dire" name="dire" placeholder="Ingrese Direccion" >'+
                              '</div>'+

                              '<div class="col-xs-8">Telefono:'+
                                '<input type="text"  id="tel" name="tel" class="form-control input-md" placeholder="Ingrese telefono" >'+
                              '</div>'+

                              '<div class="col-xs-8">Email:'+
                                '<input type="text"  id="correo" name="correo" class="form-control input-md" placeholder="Ingrese correo electronico" >'+
                              '</div>'+

                              '<div class="col-xs-8">Aviso:'+
                                '<input type="text"  id="aviso" name="aviso" class="form-control input-md" placeholder="Ingrese Avis" >'+
                              '</div>'+
                            '</div>'+
                          '</div>'+
                          '<form>',


              buttons: {
                        success: {
                        label: "guardar",
                        className:"btn-primary guardar" ,
                        callback: function (e) {

                                     var datos={
                                        'razon_social': $('#nomb').val(),
                                        'direccion': $('#dire').val(),
                                        'telefono': $('#tel').val(),
                                        'email': $('#correo').val(),
                                        'aviso': $('#aviso').val(),

                                      };


                                      $.ajax({
                                        type:"POST",
                                        url: "index.php/Otrabajo/agregar_proveedor", //controlador /metodo
                                        data:{datos:datos},
                                        success: function(data){
                                            console.log(data);
                                            if(data > 0)
                                            {
                                                var texto = '<option value="'+data+'">'+ datos.razon_social +'</option>';

                                                $('#proveedor').append(texto);

                                            }
                                        },

                                        error: function(result){

                                        console.log(result);
                                        },
                                         dataType: 'json'
                                    });
                        }//fin calback
                   }//fin success
                },//fin Buttons
                onEscape: function() {return ;},
            });  //FIN DIALOG
          traer_proveedor(); //provando si a aqui

    });

  }


// agregar usuario
/*$("#add").click(function(){

         bootbox.dialog({
          backdrop: true,
          title: "Agregar Usuario",
          message:'<form role="form" id="agregar" name="agregar" action="Otrabajo/agregar">'+
                    '<div class="row" >'+
                      '<div class="col-sm-12 col-md-12">'+
                        '<fieldset> </fieldset>'+
                          '<br>'+
                            '<div class="col-xs-8">Nombre de Usuario:'+
                              '<input type="text"   class="form-control input-md" id="nick"  name="nick" placeholder="Ingrese Nombre de Usuario" >'+
                            '</div>'+

                            '<div class="col-xs-8">Nombre:'+
                              '<input type="text"  class="form-control input-md" id="nombre" name="nombre" placeholder="Ingrese Nombre" >'+
                            '</div>'+

                            '<div class="col-xs-8">Apelliido:'+
                              '<input type="text"  id="apellido" name="apellido" class="form-control input-md" placeholder="Ingrese Apellido" >'+
                            '</div>'+

                            '<div class="col-xs-8">Contraseña:'+
                              '<input type="text"  id="contra" name="contra" class="form-control input-md" placeholder="Ingrese contraseña" >'+
                            '</div>'+

                            '<div class="col-xs-8">Grupo:'+
                              '<select type="text"  id="grupo" name="grupo" class="form-control input-md" placeholder="Ingrese grupo" ></select>'+
                            '</div>'+
                          '</div>'+
                        '</div>'+
                        '<form>',


            buttons: {
                      success: {
                      label: "guardar",
                      className:"btn-primary guardar" ,
                      callback: function (e) {

                                  $.ajax({
                                      type:"POST",
                                      url:"<? //echo site_url('Otrabajo/agregar');?>", //controlador /metodo
                                      data:$("#agregar").serialize(),
                                      success: function(result){
                                      console.log(result);
                                      location.reload();
                                      },

                                      error: function(result){

                                      console.log(result);
                                      },
                                       dataType: 'json'
                                  });
                      }//fin calback
                  }//fin success
              },//fin Buttons
              onEscape: function() {return ;},
          });  //FIN DIALOG
  });  */

  $("#add").click(function(){

           bootbox.dialog({
            backdrop: true,
            title: "Agregar Usuario",
            message:'<form role="form" id="agregarU" name="agregarU" >'+
                      '<div class="row" >'+
                        '<div class="col-sm-12 col-md-12">'+
                          '<fieldset> </fieldset>'+
                            '<br>'+
                              '<div class="col-xs-8">Nombre de Usuario:'+
                                '<input type="text"   class="form-control input-md" id="nick"  name="nick" placeholder="Ingrese Nombre de Usuario" >'+
                              '</div>'+

                              '<div class="col-xs-8">Nombre:'+
                                '<input type="text"  class="form-control input-md" id="nombre" name="nombre" placeholder="Ingrese Nombre" >'+
                              '</div>'+

                              '<div class="col-xs-8">Apelliido:'+
                                '<input type="text"  id="apellido" name="apellido" class="form-control input-md" placeholder="Ingrese Apellido" >'+
                              '</div>'+

                              '<div class="col-xs-8">Contraseña:'+
                                '<input type="text"  id="contra" name="contra" class="form-control input-md" placeholder="Ingrese contraseña" >'+
                              '</div>'+

                              '<div class="col-xs-8">Grupo:'+
                                '<select type="text"  id="grupo" name="grupo" class="form-control input-md" placeholder="Ingrese grupo" ></select>'+
                              '</div>'+
                            '</div>'+
                          '</div>'+
                          '<form>',


              buttons: {
                        success: {
                        label: "guardar",
                        className:"btn-primary guardar" ,
                        callback: function (e) {

                                     var datos={
                                        'usrNick': $('#nick').val(),
                                        'usrName': $('#nombre').val(),
                                        'usrLastName': $('#apellido').val(),
                                        'usrPassword': $('#contra').val(),
                                        'grpId': $('#grupo').val(),

                                      };


                                      $.ajax({
                                        type:"POST",
                                        url: "index.php/Otrabajo/agregar_usuario", //controlador /metodo
                                        data:{datos:datos},
                                        success: function(data){
                                            console.log(data);
                                            if(data > 0)
                                            {
                                                var texto = '<option value="'+data+'">'+ datos.usrNick +'</option>';

                                                $('#usuario').append(texto);

                                            }
                                        },

                                        error: function(result){

                                        console.log(result);
                                        },
                                         dataType: 'json'
                                    });
                        }//fin calback
                    }//fin success
                },//fin Buttons
                onEscape: function() {return ;},
            });  //FIN DIALOG
           traer_grupo();
    });


  //Agregar pedidos
$("#pedidos").click(function(){   alert('alta pedido');

         bootbox.dialog({
          backdrop: true,
          title: "Orden de Pedido",
          message:'<form role="form" id="guardar" name="guardar" >'+
                    '<div class="row" >'+
                      '<div class="col-sm-12 col-md-12">'+
                        '<fieldset> </fieldset>'+
                          '<br>'+
                           '<div class="col-md-3 col-md-offset-9">Nro:'+
                             '<input type="text" align=\"right\"  class="form-control" id="num"  >'+
                            '</div>'+
                            '<div class="col-xs-8">Fecha:'+
                              '<input type="date"   class="form-control input-md" id="fecha"  name="fecha" />'+
                            '</div>'+

                            '<div class="col-xs-8">Fecha de Entrega:'+
                              '<input type="date"  class="form-control input-md" id="fecha_entrega2" name="fecha_entrega2" />'+
                            '</div>'+
                            '<div class="col-xs-8">Estado:'+
                              '<input type="text"  class="form-control input-md" id="est" name="est" />'+
                            '</div>'+

                            '<div class="col-xs-8">Proveedor:'+
                              '<select type="text"  id="proveedor" name="proveedor" class="form-control" ></select>'+
                              '<input type="hidden" id="id_proveedor" name="id_proveedor">'+
                            '</div>'+
                            '<br>'+
                            '<div class="col-xs-2">'+
                            '<button type="button" class="btn btn-success" id="addproveedor" value="addproveedor">Agregar</button>'+
                            '</div>'+


                            '<div class="col-xs-8">Detalle del pedido:'+

                            '</div>'+
                            '<div class="col-xs-12">'+
                            '<textarea  class="form-control input-md" rows="6" cols="500" id="descripcion2" name="descripcion2" value=""></textarea>'+
                            '</div>'+

                          '</div>'+
                        '</div>'+
                        '<form>',


            buttons: {
                      success: {
                      label: "guardar",
                      className:"btn-primary guardar" ,
                      callback: function (e) {


                            var datos={
                                      'nro_trabajo': $('#num').val(),
                                      'fecha': $('#fecha').val(),
                                      'fecha_entrega': $('#fecha_entrega2').val(),
                                      'estado': $('#est').val(),
                                      'id_proveedor': $('#proveedor').val(),
                                      'descripcion': $('#descripcion2').val(),

                                    };


                            $.ajax({
                              type:"POST",
                              url: "index.php/Otrabajo/guardarorden", //controlador /metodo
                              data:{datos:datos},
                              success: function(data){

                                  //console.log(data);

                                  var texto = '<tr id="'+data[0]['id_orden']+'">'+
                                              '<td>'+data[0]['nro_trabajo']+'</td>'+
                                              '<td>'+data[0]['fecha']+'</td>'+
                                              '<td>'+data[0]['fecha_entrega']+'</td>'+
                                              '<td>'+data[0]['estado']+'</td>'+
                                              '<td>'+data[0]['id_proveedor']+'</td>'+
                                              '<td>'+data[0]['descripcion']+'</td>'+

                                              '<tr>';


                                  $('#tablaPedidos tbody').append(texto);


                              },

                      error: function(result){

                      console.log(result);
                                 },
                      dataType: 'json'
                                    });
                    }//fin calback
                  }//fin success
              },//fin Buttons
              onEscape: function() {return ;},
          });  //FIN DIALOG
          traer_proveedor();
          //agregar proveedor

          click_addproveedor();

         });



//guardar asignacion
function orden()
  {     alert("si guardo ");
        var id_orden = $('#id_orden').val();
        var nro = $('#nro').val();
        var fecha_inicio = $('#fecha_inicio').val();
        var fecha_entrega = $('#fecha_entrega').val();
        var usuario= $('#id_usuario').val();
        var estado= $('#estado').val();
        var cliente = $('#id_cliente').val();


        var parametros = {
            //'id_orden': id_orden,
            'nro': nro,
            'fecha_inicio': fecha_inicio,
            'fecha_entrega': fecha_entrega,
            'id_usuario': usuario,
            'estado': 'Asignado',
            'cliId': cliente,
        };
        console.log(parametros);
          $.ajax({
              type: 'POST',
              data: {data:parametros, id_orden:id_orden},
              url: 'index.php/Otrabajo/guardar',  //index.php/
              success: function(data){
                     // var data = jQuery.parseJSON( result );
                      console.log(data);
                      $('#modalAsig').modal('hide');

                       setTimeout(function(){
                             var permisos = '<?php echo $permission; ?>';
                            cargarView('otrabajos', 'index', permisos) ;
                      },3000); // 3000ms = 3s

                    },
              error: function(result){

                    console.log(result);
                    $('#modalAsig').modal('hide');
                  },
                  dataType: 'json'
              });

        }







</script>



<!-- Modal -->
<div class="modal fade" id="modalOT" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel"><span id="modalAction"> </span> Orden trabajo</h4>
      </div>
      <div class="modal-body" id="modalBodyOT">

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
        <button type="button" class="btn btn-primary" id="btnSave">Guardar</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal asigna -->
<div class="modal fade" id="modalAsig" tabindex="2000" aria-labelledby="myModalLabel" >
  <div class="modal-dialog" role="document" style="width: 60%">
    <div class="modal-content">

      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="cerro()"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel"><span id="modalActionSale"> </span> Asignacion Orden de trabajo</h4>
      </div>

      <div class="modal-body" id="modalBodySale">

       <div class="row" >
          <div class="col-sm-12 col-md-12">
            <fieldset> </fieldset>
              <br>
                <div class="col-md-3 col-md-offset-9">Nro:
                  <input type="text" align=\"right\"  class="form-control" id="nro"  name="nro"  min="1" size="35" disabled >
                </div>
                <input type="hidden" id="id_orden" name="id_orden">

                <div class="col-md-3 col-md-offset-9">Fecha de inicio:
                  <input type="date" align=\"right\" class="form-control" id="fecha_inicio" name="fecha_inicio" min="1" size="35" >
                </div>

                <div class="row" >
                  <div class="col-sm-12 col-md-12">

                    <div class="col-xs-8">Estado:
                      <input type="text"  id="estado" name="estado" class="form-control input-md" disabled >
                    </div>

                    <div class="col-xs-8">Cliente:
                      <input type="text"  id="cliente" name="cliente" class="form-control input-md" disabled ></select>
                      <input type="hidden" id="id_cliente" name="id_cliente">

                    </div>

                    <div class="col-xs-8">Descripcion:

                    </div>
                  <div class="col-xs-12">
                    <textarea  class="form-control input-md" rows="6" cols="500" id="descripcion" name="descripcion" value=""></textarea>
                  </div>
                </div>
              </div>



           <div class="row" >
              <div class="col-sm-12 col-md-12">

                  <br>
                  <div class="col-xs-8">Fecha de entrega:
                  <input type="date" id="fecha_entrega" name="fecha_entrega" class="form-control input-md" / >
                  </div>

                  <!--<br>
                  <div class="btn-group">
                    <button type="button" class="btn btn-success" id="pedent">Pedidos a Entregar</button>
                  </div>-->
                  <br>
                  <br>
                  <div  class="col-xs-8">Usuario:
                  <select id="usuario" name="usuario" class="form-control " placeholder="Seleccione usuario" />
                  <input type="hidden" id="id_usuario" name="id_usuario">
                  </div>
                  <br>
                  <br>
                  <div class="col-xs-3">

                  </div>
                  <div class="col-xs-2">
                  <div class="btn-group"> <!--<span class="glyphicon glyphicon-plus"></span>-->
                  <button type="button" class="btn btn-success" id="add" value="agregar">Agregar</button>
                  </div>
                  </div>

                  <br>
                  <br>
                  <div  class="col-xs-8">Pedidos:<label></label>
                  <input type="hidden" name="pedido" id="pedido">

                    <div class="btn-group">
                    <button type="button" class="btn btn-success" id="pedidos">Agregar</button>
                    </div>
                    </div>

                    <div class="row">
                    <div class="col-xs-10 col-xs-offset-1">
                    <table class="table table-bordered" id="tablaPedidos">
                        <thead>
                          <tr>
                            <br>
                            <!--<th width="35px"></th>-->
                            <th width="10%">Numero</th>
                            <th width="10%">Fecha</th>
                            <th width="10%">F.Entrega</th>
                            <th width="10%">Estado</th>

                            <th width="10%">Proveedor</th>
                            <th width="10%">Descripcion</th>
                          </tr>
                        </thead>
                      <tbody></tbody>
                    </table>
                   </div>
                </div>

              </div>
          </div>
      </div>

    </div>
    </div>

     <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal" >Cancelar</button>
          <button type="button" class="btn btn-primary" onclick="guarda()">Guardar</button>
        </div>

      </div> <!-- fin modal conteiner -->
  </div> <!-- fin modal - dialog -->
</div><!-- fin modal asigna -->