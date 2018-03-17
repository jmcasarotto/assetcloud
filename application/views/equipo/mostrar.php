<input type="hidden" id="permission" value="<?php echo $permission;?>">
<div class="row">
  <div class="col-xs-12">
    <div class="alert alert-danger alert-dismissable" id="error" style="display: none">
          <h4><i class="icon fa fa-ban"></i> Error!</h4>
          Revise que todos los campos obligatorios esten completos
      </div>
  </div>
</div>
<section class="content">
  <div class="row">
    <div class="col-xs-12">
      <div class="box">
        <div class="box-header">
          <h3 class="box-title">Equipo/Sector</h3>
          <?php

          if (strpos($permission,'Add') !== false) {
               
            
              echo '<button class="btn btn-block btn-success" style="width: 100px; margin-top: 10px;" data-toggle="modal" id="btnAgre" title="Agregar">Agregar</button>';
             
              
          }
          ?>
        </div><!-- /.box-header -->
        <div class="box-body">
          <table id="sales" class="table table-bordered table-hover">
            <thead>
              <tr>
                <th width="20%">Acciones</th>
                <th>Equipo</th>
                <th>Grupo</th>
                <th>Sector</th>
                <th>Empresa</th>
                <th>Criticidad</th>
                <th>Estado</th>
                                

              </tr>
            </thead>
            <tbody>
              <?php

                  
                  foreach($list['data'] as $a)
                  { 
                    if ($a['estado'] != "AN") {
                
                    $id=$a['id_equipo'];
                    echo '<tr id="'.$id.'">';
                    echo '<td>';
                    if (strpos($permission,'Edit') !== false) {
                      echo '<i class="fa fa-fw fa-pencil" style="color: #f39c12; cursor: pointer; margin-left: 15px;" title="Editar"></i>' ;
                    }
                    if (strpos($permission,'Del') !== false) {
                      echo '<i class="fa fa-fw fa-times-circle" style="color: #dd4b39; cursor: pointer; margin-left: 15px;" title="Eliminar"></i>';

                      echo '<i class="fa fa-fw  fa fa-user" style="color: #00008B; cursor: pointer; margin-left: 15px;" title="Contratista"></i>';
                      

                      echo '<i class="fa fa-fw fa fa-toggle-on" style="color: #006400; cursor: pointer; margin-left: 15px;" title="Inhabilitar"></i>';


                    }

                   
                    echo '</td>';
                    '<input type="hidden" id="id_equipo" name="id_equipo">';
                    echo '<td style="text-align: right">'.$a['codigo'].'</td>';
                    echo '<td style="text-align: right">'.$a['de12'].'</td>';
                    echo '<td style="text-align: left">'.$a['de13'].'</td>';
                    echo '<td style="text-align: right">'.$a['de11'].'</td>';
                    echo '<td style="text-align: right">'.$a['de14'].'</td>';
                    

                    echo '<td style="text-align: center">'.($a['estado'] == 'AC' ? '<small class="label pull-left bg-green">Activo</small>' :($a['estado'] == 'IN' ? '<small class="label pull-left bg-blue">Inhabilitado</small>' : '<small class="label pull-left bg-red">Anulado</small>')).'</td>';

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

$(document).ready(function(event) {

  edit=0;  datos=Array();

  $('#btnAgre').click(function(){  

      $('#codigo').val('');
      $('#ubicacion').val('');
      $('#marca').val('');
      $('#descripcion').val('');
      $('#fecha_ingreso').val('');   
      $('#fecha_ultimalectura').val('');
      $('#ultima_lectura').val('');
      $('#fecha_garantia').val('');
      $('#estado').val('');
      $('#empresa').val('');
      $('#sector').val('');
      $('#grupo').val('');
      

      $('#tablacomp tbody tr').remove();

      $('#modalSale').modal('show');
       
       OpenSale();
  });

  $("#addempresa").click(function(){  

     bootbox.dialog({
            backdrop: true,
            title: "Agregar Empresa",
            message:'<form role="form" id="agregarE" name="agregarE" >'+  
                      '<div class="row" >'+
                        '<div class="col-sm-12 col-md-12">'+
                          '<fieldset> </fieldset>'+
                            '<br>'+
                              '<div class="col-xs-8">Nombre de la Empresa'+
                                '<input type="text"   class="form-control input-md" id="descrip"  name="descrip" placeholder="Ingrese Nombre de la empresa" >'+
                                '<input type="hidden" id="id_empresa" name="id_empresa">'+
                              '</div>'+

                              
                            '</div>'+
                          '</div>'+
                          '<form>',
                  

              buttons: {
                        success: {
                 

                        className:"btn-primary guardar" ,
                        callback: function (e) {
                        
                                     var datos={
                                        'descripcion': $('#descrip').val(),
                                        

                                      };
                                    

                                      $.ajax({
                                        type:"POST",
                                        url: "index.php/Equipo/agregar_empresa", //controlador /metodo
                                        data:{datos:datos},
                                        success: function(data){
                                            console.log(data);
                                            if(data > 0)
                                            {  
                                                var texto = '<option value="'+data+'">'+ datos.descripcion +'</option>';

                                                $('#empresa').append(texto);
                                                
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
   }); 

  $("#addsector").click(function(){  

           bootbox.dialog({
            backdrop: true,
            title: "Agregar Sector",
            message:'<form role="form" id="agregarS" name="agregarS" >'+  
                      '<div class="row" >'+
                        '<div class="col-sm-12 col-md-12">'+
                          '<fieldset> </fieldset>'+
                            '<br>'+
                              '<div class="col-xs-8">Nombre del Sector'+
                                '<input type="text"   class="form-control input-md" id="desc"  name="desc" placeholder="Ingrese Sector" >'+
                                '<input type="hidden" id="id_sector" name="id_sector">'+
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
                                        'descripcion': $('#desc').val(),
                                        

                                      };
                                    console.log(datos);

                                      $.ajax({
                                        type:"POST",
                                        url: "index.php/Equipo/agregar_sector", //controlador /metodo
                                        data:{datos:datos},
                                        success: function(data){
                                            console.log(data);
                                            if(data > 0)
                                            {  
                                                var texto = '<option value="'+data+'">'+ datos.descripcion +'</option>';

                                                $('#sector').append(texto);
                                                
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
         
  }); 

  $("#addcriti").click(function(){  

           bootbox.dialog({
            backdrop: true,
            title: "Agregar Criticidad",
            message:'<form role="form" id="agregarS" name="agregarS" >'+  
                      '<div class="row" >'+
                        '<div class="col-sm-12 col-md-12">'+
                          '<fieldset> </fieldset>'+
                            '<br>'+
                              '<div class="col-xs-8">Descripcion de criticidad'+
                                '<input type="text"   class="form-control input-md" id="de"  name="de" placeholder="Ingrese criticidad" >'+
                                '<input type="hidden" id="id_criti" name="id_criti">'+
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
                                        'descripcion': $('#de').val(),
                                        

                                      };
                                    

                                      $.ajax({
                                        type:"POST",
                                        url: "index.php/Equipo/agregar_criti", //controlador /metodo
                                        data:{datos:datos},
                                        success: function(data){
                                            console.log(data);
                                            if(data > 0)
                                            {  
                                                var texto = '<option value="'+data+'">'+ datos.descripcion +'</option>';

                                                $('#criticidad').append(texto);
                                                
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
         
  }); 

  $("#addgrupo").click(function(){  

           bootbox.dialog({
            backdrop: true,
            title: "Agregar Grupo",
            message:'<form role="form" id="agregarS" name="agregarS" >'+  
                      '<div class="row" >'+
                        '<div class="col-sm-12 col-md-12">'+
                          '<fieldset> </fieldset>'+
                            '<br>'+
                              '<div class="col-xs-8">Nombre :'+
                                '<input type="text"   class="form-control input-md" id="des1"  name="des1" placeholder="Ingrese Nombre o Descripcion" >'+
                                '<input type="hidden" id="id_criti" name="id_criti">'+
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
                                        'descripcion': $('#des1').val(),
                                        

                                      };
                                    

                                      $.ajax({
                                        type:"POST",
                                        url: "index.php/Equipo/agregar_grupo", //controlador /metodo
                                        data:{datos:datos},
                                        success: function(data){
                                            console.log(data);
                                            if(data > 0)
                                            {  
                                                var texto = '<option value="'+data+'">'+ datos.descripcion +'</option>';

                                                $('#grupo').append(texto);
                                                
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
         
  }); 

  //Cambio de estado a un equipo
  $(".fa-times-circle").click(function (e) { 
               
        var tr = $(this).parent('td').parent('tr');

        var idequipo = $(this).parent('td').parent('tr').attr('id');
        console.log(idequipo);
        
        bootbox.confirm("¿Realmente desea ANULAR?", function(e) { 
          if(e)
            $.ajax({
              type: 'POST',
              data: { idequipo: idequipo},
              url: 'index.php/Equipo/baja_equipo', //index.php/
              success: function(data){
                      //var data = jQuery.parseJSON( data );
                      
                      console.log(data);
                     
                      $(tr).remove();

                       bootbox.alert("Equipo/sector ANULADO", function() {});
                    },
                
              error: function(result){
                    
                    console.log(result);
                  },
                  dataType: 'json'
              });
          else alert('cancel');
        });
  
  });
  //Editar
  
  $(".fa-pencil").click(function (e) { 
      
      $('#modalSale').modal('show');
        //var tr = $(this).parent('td').parent('tr');
        //var idequipo = $(this).val();
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
                  console.log(data[0]['descripcion']);
                  //console.log(data['datos'][0]['descripcion']);
                 
                  datos={
                    'id_equipo':id_equipo,

                    'descripcion':data[0]['descripcion'],
                    'fecha_ingreso':data[0]['fecha_ingreso'],
                    'fecha_garantia':data[0]['fecha_garantia'],
                    'marca':data[0]['marca'],
                    'codigo':data[0]['codigo'],
                    'ubicacion':data[0]['ubicacion'],

                    'id_empresa':data[0]['id_empresa'],
                    'id_sector':data[0]['id_sector'],
                    'id_grupo':data[0]['id_grupo'],
                    'id_criticidad':data[0]['id_criticidad'],

                    'estado':data[0]['estado'],
                    'fecha_ultimalectura':data[0]['fecha_ultimalectura'],
                    'ultima_lectura':data[0]['ultima_lectura'],
         
                  }

                 
                  edit=1;

                  completarEdit(datos,edit);
                  OpenSale();               
              
                },
            
          error: function(result){
                
                console.log(result);
              },
              dataType: 'json'
          });
  
  });

  //Asignar contratista
 $(".fa-user").click(function (e) { 

    var tr = $(this).parent('td').parent('tr');

    var idequipo = $(this).parent('td').parent('tr').attr('id');
    bootbox.dialog({
            backdrop: true,
            title: "Agregar Contratista",
            message:'<form role="form" id="agregarC" name="agregarC" >'+  
                      '<div class="row" >'+
                        '<div class="col-sm-12 col-md-12">'+
                          '<div role="tabpanel" class="tab-pane">'+
                            '<div class="form-group">'+
                              '<div class="panel panel-default">'+
                                  '<div class="panel-heading">'+
                                    '<h4 class="panel-title">Datos del Equipo</h4>'+
                                  '</div>'+
     
                                  '<div class="panel-body">'+

                                    '<div class="col-xs-4">Codigo:'+
                                       '<select id="codigoe" name="codigoe" class="form-control">'+
                                          '<input type="hidden" id="id_equipo" name="id_equipo">'+
                                    '</div>'+

                                    '<div class="col-xs-4">Ubicacion:'+
                                      '<input type="text" id="ubicacione" name="ubicacione" class="form-control" disabled>'+
                                    '</div>'+
                                    '<div class="col-xs-4">Marca:'+
                                      '<input type="text" id="marcae" name="marcae" class="form-control" disabled>'+
                                      
                                    '</div>'+
                                    
                                    '<div class="col-xs-4">Fecha de Ingreso:'+
                                      '<input type="date" id="fecha_ingresoe"  name="fecha_ingresoe" class="form-control input-md" disabled>'+
                                    '</div>'+
                
                                    '<div class="col-xs-4">Fecha de Garantia:'+
                                        '<input type="date" id="fecha_garantiae"  name="fecha_garantiae" class="form-control input-md" disabled>'+
                                    '</div>'+
                
                                    '<div class="col-xs-8">Descripcion:'+ 
                                    '</div> '+         

                                    '<div class="row">'+
                                      '<div class="col-lg-12">'+
                                      
                                      '<textarea class="form-control" id="descripcione" name="descripcione" disabled></textarea>'+
                                      '</div>'+
                                    '</div>'+

                                  '</div>'+
                                '</div>'+
                              '</div>'+
                            '</div>'+
                          '</div>'+
                          '</div>'+
                          '<div>'+
                          '<ul class="nav nav-tabs" role="tablist">'+
                            '<li role="presentation" class="active"><a href="#choras" aria-controls="home" role="tab" data-toggle="tab">Contratista</a></li>'+

                          '</ul>'+

                          '<div class="tab-content">'+
                            '<div role="tabpanel" class="tab-pane active" id="choras">'+

                          '<div class="row" >'+
                            '<div class="col-sm-12 col-md-12">'+
                              '<br>'+
                              '<fieldset><legend></legend></fieldset>'+
                                '<div class="col-xs-4">'+
                                  '<select id="empresae" name="empresae" class="form-control">'+
                                  '<input type="hidden" id="id_contratista" name="id_contratista">'+
                                '</div>'+
                                            
                                '<div class="col-xs-4">'+
                                  '<button type="button" class="btn btn-success" id="adde"><i class="fa fa-check">Agregar</i></button>'+
                                '</div>'+

                                '</div>'+

                              '</div>'+
                            '</div>'+
                             
                            '<div class="row" >'+
                              '<div class="col-sm-12 col-md-12">'+

                                '<table class="table table-bordered" id="tablaempresa">'+ 
                                    '<thead>'+
                                      '<tr>'+                      
                                        '<br>'+
                                        '<th width="2%"></th>'+
                                        '<th width="10%">Contratistas Asignados</th>'+
                                      '</tr>'+
                                    '</thead>'+
                                    '<tbody></tbody>'+
                                '</table>'+
                              '</div>'+
                          '</div>'+


                          '<form>',
                  

              buttons: {
                        success: {
                        label: "guardar",
                        className:"btn-primary guardar" ,
                        callback: function (e) {
                                    
                        
                               /*var datos={
                                  'id_equipo': $('#id_equipo').val(),
                                  

                                      };*/
                                   
                                    var idscontra = new Array();     
                                    $("#tablaempresa tbody tr").each(function (index) 
                                    {
                                        var id_contratista = $(this).attr('id');
                                        idscontra.push(id_contratista);
                                       
                                    }); 
                                   //alert(idscontra); 

                                    var parametros = {
                                          'id_equipo': $('#codigoe').val(),
                                          //'variab' : variable,
                                    };
                                    console.log(parametros);
                                    console.log(idscontra);

                                  $.ajax({
                                    type:"POST",
                                    url: "index.php/Equipo/guardarcontra", //controlador /metodo
                                    data:{data:parametros, idscontra:idscontra},
                                    success: function(data){
                   
                                        console.log(data);
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
  traer_codigo();
  click_co();
  traer_empresa2();
  click_empresa();

  });

  // Cambiar a estado inactivo

  $(".fa-toggle-on").click(function (e) { 

    var tr = $(this).parent('td').parent('tr');

        var idequipo = $(this).parent('td').parent('tr').attr('id');
       //console.log(idequipo);
        
        bootbox.confirm("¿Realmente desea cambiar el estado del equipo a INACTIVO ?", function(e) { 
          if(e)
            $.ajax({
              type: 'POST',
              data: { idequipo: idequipo},
              url: 'index.php/Equipo/cambio_equipo', //index.php/
              success: function(data){
                      //var data = jQuery.parseJSON( data );
                      
                      console.log(data);
                     
                      $(tr).remove();

                       bootbox.alert("Se cambio de estado", function() {});
                    },
                
              error: function(result){
                    
                    console.log(result);
                  },
                  dataType: 'json'
              });
          else alert('cancel');
        });
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
            "info": "Mostrando página _PAGE_ de _PAGES_",
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
        setTimeout(function () { $('#artId').focus(); }, 1000);
        $('#saleDetail > tbody').html('');
       
        WaitingClose();
       
      }
    }
  }


  function cerro(){
    
    isOpenWindow = false;
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
  traer_codigo();
  function traer_codigo(){
      $.ajax({
        type: 'POST',
        data: { },
        url: 'index.php/Equipo/getcodigo', //index.php/
        success: function(data){
               
                var opcion  = "<option value='-1'>Seleccione...</option>" ; 
                $('#codigoe').append(opcion); 
                for(var i=0; i < data.length ; i++) 
                {    
                      var nombre = data[i]['codigo'];
                      var opcion  = "<option value='"+data[i]['id_equipo']+"'>" +nombre+ "</option>" ; 

                      $('#codigoe').append(opcion); 
                                   
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
            var id_equipo= $('#id_equipo').val();
            var id_contratista= $('#empresae').val();

            alert(id_contratista);
            var tr = "<tr id='"+id_contratista+"' >"+
                        "<td><i class='fa fa-ban elirow' style='color: #f39c12'; cursor: 'pointer'></i></td>"+
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
    
  function click_co()
  {
      $("#codigoe").change(function(){
          
            var idequ = $(this).val();
            //alert(idequ);

            $.ajax({
                type: 'POST',
                data: { idequ: idequ},
                url: 'index.php/Equipo/getco', //index.php/
                success: function(data){
                        //var data = jQuery.parseJSON( data );
                        
                        //console.log(data);
                       
                        var fechai = data[0]['fecha_ingreso'];
                        var fechag= data[0]['fecha_garantia']; 
                        var mar = data[0]['marca']; 
                        var ubica = data[0]['ubicacion']; 
                        var descrip = data[0]['descripcion']; 


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
                 
      });
  }

  function completarEdit(datos ,edit){

    $('#equipo').val(datos['id_equipo']);
    $('#descripcion').val(datos['descripcion']);
    $('#fecha_ingreso').val(datos['fecha_ingreso']);
    $('#fecha_garantia').val(datos['fecha_garantia']);
    $('#marca').val(datos['marca']);
    $('#codigo').val(datos['codigo']);
    $('#ubicacion').val(datos['ubicacion']);

    $('#empresa').val(datos['id_empresa']);
    $('#sector').val(datos['id_sector']);
    $('#grupo').val(datos['id_grupo']);
    $('#criticidad').val(datos['id_criticidad']);
    $('#estado').val(datos['estado']);
    $('#fecha_ultimalectura').val(datos['fecha_ultimalectura']);
    $('#ultima_lectura').val(datos['ultima_lectura']);


  }

  function guardar()
  {    // alert("si guardo ");
        var id_equipo= $('#equipo').val();
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
            'id_equipo': id_equipo,
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
            var hayError = false;
         //console.log(parametros);
         if(edit==0)
        { 
          if(codigo >0 && ubicacion>0 && marca >0 && id_empresa >0 && id_sector >0 && id_grupo >0 && id_criticidad > 0)
          {
          console.log("estoy  guardando");
          $.ajax({
              type: 'POST',
              data: {data:parametros },
              url: 'index.php/Equipo/guardar_equipo',  //index.php/
              success: function(data){

                      /*var permisos = '<?php// echo $permission; ?>';
                      cargarView('Equipo', 'index', permisos );*/
                     cargarVista();
                    },
              error: function(result){
                    console.log ("entre por error");
                    console.log(result);
                    $('#modalSale').modal('hide');
                  },
                  dataType: 'json'
              });
        }
        else {
          hayError=true;
          $('#error').fadeIn('slow');
         return;
        }
       }
       else
          { 
            console.log("estoy editando");
            $.ajax({
              type: 'POST',
              data: {data:parametros, comglob: comglob},
              url: 'index.php/Equipo/editar_equipo',  //index.php/
              success: function(data){
                     
                      console.log(data);
                      cargarVista();                     
                    },
              error: function(result){
                    
                    console.log(result);
                    $('#modalSale').modal('hide');
                  },
                  //dataType: 'json'
              });
          }

            
  }

function cargarVista(){
    //WaitingOpen();

    $('#modalSale').empty();
    $('#content').empty();
    $("#content").load("<?php echo base_url(); ?>index.php/Equipo/index/<?php echo $permission; ?>");
    WaitingClose();
  }

</script>



<!-- Modal modalSale -->
<div class="modal fade" id="modalSale" tabindex="2000" aria-labelledby="myModalLabel" >
  <div class="modal-dialog" role="document" style="width: 60%">
    <div class="modal-content">
      
      <div class="modal-header">


        <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="cerro()"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel"><span id="modalActionSale"> </span> Equipo/Sector</h4> 
      </div>

      <div class="modal-body" id="modalBodySale">
      
        <div class="row" >
          <div class="col-sm-12 col-md-12">
             <div role="tabpanel" class="tab-pane">
              <div class="form-group">
                  <div class="panel panel-default">
                      <div class="panel-heading">
                        <h4 class="panel-title">Datos del Equipo/ Sector </h4>
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
                        <h4 class="panel-title">Ubicacion del Equipo / Sector </h4>
                      </div>

                    <div class="panel-body">             
                    
                    <div class="col-xs-4">Empresa <strong style="color: #dd4b39">*</strong>:
                    <select  id="empresa" name="empresa" class="form-control" />
                    <!-- <input type="text" name="empresa" id="empresa" value="" placeholder="" class='ui-autocomplete-input' autocomplete='off'>
                    class="selectpicker" data-size="5"-->
                     <input type="hidden" id="id_empresa" name="id_empresa">
                    </div>
                    <div class="col-xs-2">
                      <button type="button" class="btn btn-success" id="addempresa">Agregar</button>
                    </div>
                    <div class="col-xs-4">Sector <strong style="color: #dd4b39">*</strong> :
                      <select id="sector" name="sector" class="form-control"   />
                      <input type="hidden" id="id_sector" name="id_sector">
                    </div>
                    <div class="col-xs-2">
                      <button type="button" class="btn btn-success" id="addsector">Agregar</button>
                    </div>

                    <div class="col-xs-4">Criticidad <strong style="color: #dd4b39">*</strong>:
                      <select id="criticidad" name="criticidad" class="form-control"   />
                      <input type="hidden" id="id_criticidad" name="id_criticidad">
                    </div>
                    <div class="col-xs-2">
                      <button type="button" class="btn btn-success" id="addcriti">Agregar</button>
                    </div>
                     <div class="col-xs-4">Grupo <strong style="color: #dd4b39">*</strong>:
                     <select id="grupo" name="grupo" class="form-control"   />
                      <input type="hidden" id="id_grupo" name="idgrupo">
                    </div>
                    <br>
                    <div class="col-xs-2">
                      <button type="button" class="btn btn-success" id="addgrupo">Agregar</button>
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

<!-- Modal -->
<!--<div class="modal fade" id="contra" tabindex="2000" aria-labelledby="myModalLabel" >
  <div class="modal-dialog" role="document" style="width: 60%">
    <div class="modal-content">
      
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="cerro()"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel"><span id="modalActionSale"> </span> Equipo/Sector</h4> 
      </div>

      <div class="modal-body" id="modalBodySale">
        
        <div class="row" >
          <div class="col-sm-12 col-md-12">
             <div role="tabpanel" class="tab-pane">
              <div class="form-group">
                  <div class="panel panel-default">
                      <div class="panel-heading">
                        <h4 class="panel-title">Datos del Equipo/ Sector </h4>
                      </div>
                      
                
  
              <div class="panel-body">

                <div class="col-xs-4">Codigo:
                   <input type="text" id="codigo" name="codigo" class="form-control">
                    <input type="hidden" id="id_equipo" name="id_equipo">
                </div>
                

                <div class="col-xs-4">Ubicacion:
                  <input type="text" id="ubicacion" name="ubicacion" class="form-control">
                </div>
                <div class="col-xs-4">Marca:
                  <input type="text" id="marca" name="marca" class="form-control">
                  
                </div>
                
                <div class="col-xs-4">Fecha de Ingreso:
                  <input type="date" id="fecha_ingreso"  name="fecha_ingreso" class="form-control input-md">
                </div>
                
                <div class="col-xs-4">Fecha de Ultima lectura:
                    <input type="date" id="fecha_ultimalectura"  name="fecha_ultima" class="form-control input-md">
                </div>
                
                <div class="col-xs-4">Ultima Lectura:
                    <input type="text" id="ultima_lectura"  name="ultima_lectura" class="form-control input-md">
                </div>
                
                <div class="col-xs-4">Fecha de Garantia:
                    <input type="date" id="fecha_garantia"  name="fecha_garantia" class="form-control input-md">
                </div>
                <br>
                <div class="col-xs-4">Estado:
                    <input type="text" id="estado"  name="estado" class="form-control input-md">
                </div>
                
                  
                <div class="col-xs-8">Descripcion: 
                </div>           

                <div class="row">
                  <div class="col-lg-12">
                  
                  <textarea class="form-control" id="descripcion" name="descripcion"></textarea>
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
                        <h4 class="panel-title">Ubicacion del Equipo / Sector </h4>
                      </div>

                    <div class="panel-body">             
                    
                    <div class="col-xs-4">Empresa:
                    <select  id="empresa" name="empresa" class="form-control" />
                     <input type="text" name="empresa" id="empresa" value="" placeholder="" class='ui-autocomplete-input' autocomplete='off'>
                    class="selectpicker" data-size="5"-->
                    <!-- <input type="hidden" id="id_empresa" name="id_empresa">
                    </div>
                    <div class="col-xs-2">
                      <button type="button" class="btn btn-success" id="addempresa">Agregar</button>
                    </div>
                    <div class="col-xs-4">Sector:
                      <select id="sector" name="sector" class="form-control"   />
                      <input type="hidden" id="id_sector" name="id_sector">
                    </div>
                    <div class="col-xs-2">
                      <button type="button" class="btn btn-success" id="addsector">Agregar</button>
                    </div>

                    <div class="col-xs-4">Criticidad:
                      <select id="criticidad" name="criticidad" class="form-control"   />
                      <input type="hidden" id="id_criticidad" name="id_criticidad">
                    </div>
                    <div class="col-xs-2">
                      <button type="button" class="btn btn-success" id="addcriti">Agregar</button>
                    </div>
                     <div class="col-xs-4">Grupo:
                     <select id="grupo" name="grupo" class="form-control"   />
                      <input type="hidden" id="id_grupo" name="idgrupo">
                    </div>
                    <br>
                    <div class="col-xs-2">
                      <button type="button" class="btn btn-success" id="addgrupo">Agregar</button>
                    </div>
            </div>
          </div>        
        </div>
      </div>    
    </div>
    </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal" onclick="cerro()">Cancelar</button>
          <button type="button" class="btn btn-primary" onclick="guardar()">Guardar</button>
        </div>

    </div>
  </div>
</div>  --><!-- /.modal-dialog modal-lg -->
           <!--</div>   /.modal fade -->
            <!-- / Modal -->
