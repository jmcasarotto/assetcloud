<input type="hidden" id="permission" value="<?php echo $permission;?>">
<section class="content">
  <div class="row">
    <div class="col-xs-12">
      <div class="box">
        <div class="box-header">
        <br>
          <h3 class="box-title">Ficha Tecnica de Servicio</h3>
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
                <th style="text-align: center">numero</th>
                <th style="text-align: center">Fecha de Ingreso</th>
                <th style="text-align: center">marca</th>
                <th style="text-align: center">modelo</th>
                <th style="text-align: center">dominio</th>
               
              </tr>
            </thead>
            <tbody>
              <?php

                  
                  foreach($list['data'] as $a){ 
                    if ($a['estado'] != "AN") {
                
                    $id=$a['id_fichaequip'];
                
                    echo '<tr id="'.$id.'" >';
                    echo '<td>';
                    if (strpos($permission,'Edit') !== false) {
                      echo '<i class="fa fa-fw fa-pencil" style="color: #f39c12; cursor: pointer; margin-left: 15px;" title="Editar" data-toggle="modal" data-target="#modaleditar"></i>' ;
                    }
                    if (strpos($permission,'Del') !== false) {
                      echo '<i href="#" class="fa fa-fw fa-times-circle" style="color: #dd4b39; cursor: pointer; margin-left: 15px;"  title="Eliminar"></i>';

                      echo '<i class="fa fa-fw  fa fa-user" style="color: #00008B; cursor: pointer; margin-left: 15px;" title="Contratista" data-toggle="modal" data-target="#modalasignar"></i>';
                      
                        if($a['estado'] == 'AC'){
                      echo '<i  href="#" class="fa fa-fw fa fa-toggle-on" style="color: #006400; cursor: pointer; margin-left: 15px;" title="Inhabilitar"></i>';
                        }
                        else {
                           echo '<i class="fa fa-fw fa fa-toggle-off" title="Habilitar" style="color: #006400; cursor: pointer; margin-left: 15px;"></i>';
                        }

                    }

                   
                    echo '</td>';
                    
                    echo '<td style="text-align: center">'.$a['marca'].'</td>';
                    echo '<td style="text-align: center">'.$a['modelo'].'</td>';
                    echo '<td style="text-align: center">'.$a['numero'].'</td>';
                    echo '<td style="text-align: center">'.$a['fecha_ingreso'].'</td>';
                    echo '<td style="text-align: center">'.$a['dominio'].'</td>';
                    

                   

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
  var isOpenWindow = false;
  var comglob="";
  var ide="";
$(document).ready(function(event) {
  
  edit=0;  datos=Array()  
  $('#btnAgre').click( function cargarVista(){
    WaitingOpen();
    $('#content').empty();
    $("#content").load("<?php echo base_url(); ?>index.php/Ficha/cargarequipo/<?php echo $permission; ?>");
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
            url: 'index.php/Equipo/baja_equipo', //index.php/
            success: function(data){
                    //var data = jQuery.parseJSON( data );
                    console.log(data);
                   
                    //$(tr).remove();
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
        url: 'index.php/Equipo/getpencil', //index.php/
        success: function(data){
                                  
                console.log(data);
                //console.log(data['descripcion']);
                console.log(data[0]['deemp']);
                //console.log(data['datos'][0]['descripcion']);
               
                datos={
                  'id_equipo':id_equipo,

                  'descripcion':data[0]['descripcion'],
                  'fecha_ingreso':data[0]['fecha_ingreso'],
                  'fecha_garantia':data[0]['fecha_garantia'],
                  'marca':data[0]['marca'],
                  'codigo':data[0]['codigo'],
                  'ubicacion':data[0]['ubicacion'],

                  'id_empresa':data[0]['id_empresa'], //deemp
                  'id_sector':data[0]['id_sector'], //desect
                  'id_grupo':data[0]['id_grupo'], //degrup
                  'id_criticidad':data[0]['id_criti'], //decriti

                  'estado':data[0]['estado'],
                  'fecha_ultimalectura':data[0]['fecha_ultimalectura'],
                  'ultima_lectura':data[0]['ultima_lectura'],
       
                }

               
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
    var ide=id_equipo;
    console.log("variable global");
    console.log(ide);
   
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
      url: 'index.php/Equipo/cambio_equipo', //index.php/
      success: function(data){
              //var data = jQuery.parseJSON( data );
              
              console.log(data);
             
              //$(tr).remove();

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
      url: 'index.php/Equipo/cambio_estado', //index.php/
      success: function(data){
              console.log(data);
             
              //$(tr).remove();
              alert("Se cambio el estado del equipo a ACTIVO");
              regresa();    
           },
        
      error: function(result){
            console.log(result);
          },
          dataType: 'json'
    });

  }); 

  $('#codigo').change(function(){

    var cod = $(this).val();
    console.log("El id de equipo es :");
    console.log(cod);

  /*$.ajax({
      type: 'POST',
      data: { idequipo: idequipo},
      url: 'Componente/getcompo', //index.php/ getcompo
      success: function(data){                  
          console.log(data); 
          
            var de = data[0]['descripcion']; 
            var comp = data[0]['dee11'];
          
      
            },
           
        
      error: function(result){
            //alert("error entr en la otra consulta");
            console.log(result);
           traer_descripcion(idequipo);
          },
          dataType: 'json'
    });*/


  });      

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
    $('#marca').val(datos['marca']);
    $('#codigo').val(datos['codigo']);
    $('#ubicacion').val(datos['ubicacion']);
    traer_empresa();
    traer_sector();
    traer_grupo();
    traer_criticidad();
    $('#empresa').val(datos['id_empresa']);
    $('#sector').val(datos['id_sector']);
    $('#grupo').val(datos['id_grupo']);
    $('#criticidad').val(datos['id_criticidad']);
    $('#estado').val(datos['estado']);
    $('#fecha_ultimalectura').val(datos['fecha_ultimalectura']);
    $('#ultima_lectura').val(datos['ultima_lectura']);


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
                  //cargarVista(); 
                  regresa();                    
                },
          error: function(result){
                
                console.log(result);
                //$('#modalSale').modal('hide');
              },
              //dataType: 'json'
          });
  }

  function guardarsi(){

    var idequipo = $(this).parent('td').parent('tr').attr('id');
    console.log("Equipo");
    console.log(idequipo);
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
       'id_equipo': $('#codigoe').val(),
              //'variab' : variable,
        };
    console.log(idscontra);
    console.log(parametros);

   $.ajax({
      type:"POST",
      url: "index.php/Equipo/guardarcontra", //controlador /metodo
      data:{data:parametros, idscontra:idscontra},
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

traer_sector();
function traer_sector(){
      $.ajax({
        type: 'POST',
        data: { },
        url: 'index.php/Equipo/getsector', //index.php/
        success: function(data){
               
                 var opcion  = "<option value='-1'>Seleccione...</option>" ; 
                  $('#sector').append(opcion); 
                for(var i=0; i < data.length ; i++) 
                {    
                      var nombre = data[i]['descripcion'];
                      var opcion  = "<option value='"+data[i]['id_sector']+"'>" +nombre+ "</option>" ; 

                    $('#sector').append(opcion); 
                                   
                }
              },
        error: function(result){
              
              console.log(result);
            },
            dataType: 'json'
        });
}

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
         //alert(data);
               
                 var opcion  = "<option value='-1'>Seleccione...</option>" ; 
                  $('#empresae').append(opcion); 
                for(var i=0; i < data.length ; i++) 
                {    
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

function click_empresa()
{
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
    
function click_co(id_equipo)
{
      //$("#codigoe").change(function(){
          
        //    var idequ = $(this).val();
            //alert(idequ);
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
                 
      //});
}



</script>

<!-- Modal ASIGNAR-->
<div id="modalasignar" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Asignacion de contratista a equipo</h4>
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

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Editar Equipo/Sector</h4>
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
                  <input type="text" id="marca" name="marca" class="form-control" placeholder="Ingrese Marca">
                  
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
                      <select id="sector" name="sector" class="form-control"   />
                      <input type="hidden" id="id_sector" name="id_sector">
                    </div>
                    <br>                    

                    <div class="col-xs-6">Criticidad <strong style="color: #dd4b39">*</strong>:
                      <select id="criticidad" name="criticidad" class="form-control"   />
                      <input type="hidden" id="id_criticidad" name="id_criticidad">
                    </div>
                    
                     <div class="col-xs-6">Grupo <strong style="color: #dd4b39">*</strong>:
                     <select id="grupo" name="grupo" class="form-control"   />
                      <input type="hidden" id="id_grupo" name="idgrupo">
                    </div>
                    <br>
                    
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