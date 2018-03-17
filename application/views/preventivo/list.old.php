<input type="hidden" id="permission" value="<?php echo $permission;?>">
<section class="content">
  <div class="row">
    <div class="col-xs-12">
      <div class="box">
        <div class="box-header">
          <h3 class="box-title">Preventivo</h3>
          <?php

         if (strpos($permission,'Add') !== false) {
            
            ?>
              <button class="btn btn-block btn-success" style="width: 100px; margin-top: 10px;" data-toggle="modal" id="btnAgre" title="Agregar">Agregar</button>
            
         <? 
       }
          ?>
        </div><!-- /.box-header -->
        <div class="box-body">
          <table id="sales" class="table table-bordered table-hover">
            <thead>
              <tr>
                <th width="20%">Acciones</th>
                <!--<th>Equipo</th>-->
                <th>Tarea</th>
                <th>Periodo</th>
                <th>Fecha </th>
               <!-- <th>Componente </th>-->
                <th>Critico1</th>
                

              </tr>
            </thead>
            <tbody>
              <?php
                if(count($list['data']) > 0)                  
                  foreach($list['data'] as $a)
                  {if ($a['estadoprev'] == "curso") {
                    $id=$a['prevId'];
                    echo '<tr id="'.$id.'">';
                    echo '<td>';
                   
                    if (strpos($permission,'Add') !== false) {
                      echo '<i class="fa fa-fw fa-times-circle" style="color: #dd4b39; cursor: pointer; margin-left: 15px;" ></i>';

                      echo '<i class="fa fa-fw fa-pencil" style="color: #f39c12; cursor: pointer; margin-left: 15px;" ></i>';
                    }
                    
                    
                    echo '</td>';
                    //echo '<td style="text-align: right">'.$a['des'].'</td>';
                    echo '<td style="text-align: left">'.$a['descrip'].'</td>';
                    
                    echo '<td style="text-align: right">'.$a['perido'].'</td>';
                    echo '<td style="text-align: right">'.$a['ultimo'].'</td>';
                   // echo '<td style="text-align: right">'.$a['descripcion'].'</td>';
                    
                    echo '<td style="text-align: right">'.$a['critico1'].'</td>';
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
  var isOpenWindow = false;


$(document).ready(function(event) {

    edit=0;  datos=Array();

    $('#btnAgre').click(function(){  
       
      $('#equipo').val('');
      $('#marca').val('');
      $('#codigo').val('');
      $('#ubicacion').val('');
      $('#tarea').val('');   
      $('#periodo').val('');
      $('#cantidad').val('');
      $('#ultimo').val('');
      $('#componente').val('');
      $('#critico1').val('');
      $('#cantidadhm').val('');

      $('#tablacomp tbody tr').remove();

      $('#modalSale').modal('show');
       
       OpenSale();
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

   
  traer_equipo();
  

  $('#equipo').change(function(){
    
      var id_equipo = $(this).val();

      $.ajax({
          type: 'POST',
          data: { id_equipo: id_equipo},
          url: 'index.php/Preventivo/getcantidad', //index.php/
          success: function(data){
                  //var data = jQuery.parseJSON( data );
                  
                  console.log(data);
                 
                  var fecha_ingreso = data[0]['fecha_ingreso']; 
                  var marca = data[0]['marca']; 
                  var ubicacion = data[0]['ubicacion']; 
                  var criterio1 = data[0]['criterio1']; 
                  var descripcion = data[0]['descripcion']; 


                  $('#fecha_ingreso').val(fecha_ingreso);       
                  $('#marca').val(marca);   
                  $('#descripcion').val(descripcion);       
                  $('#ubicacion').val(ubicacion);  

                },
            
          error: function(result){
                
                console.log(result);
              },
              dataType: 'json'
          });
       traer_componente(id_equipo);      

  });

  function traer_equipo(){
      $.ajax({
        type: 'POST',
        data: { },
        url: 'index.php/Preventivo/getequipo', //index.php/
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

  traer_tarea();
  function traer_tarea(){
      $.ajax({
        type: 'POST',
        data: { },
        url: 'index.php/Preventivo/gettarea', //index.php/
        success: function(data){
               
                 var opcion  = "<option value='-1'>Seleccione...</option>" ; 
                  $('#tarea').append(opcion); 
                for(var i=0; i < data.length ; i++) 
                {    
                      var nombre = data[i]['descripcion'];
                      var opcion  = "<option value='"+data[i]['id_tarea']+"'>" +nombre+ "</option>" ; 

                    $('#tarea').append(opcion); 
                                   
                }
              },
        error: function(result){
              
              console.log(result);
            },
            dataType: 'json'
        });
  }

  traer_componente();
  function traer_componente(id_equipo){
      $.ajax({
        type: 'POST',
        data: {id_equipo: id_equipo },
        url: 'index.php/Preventivo/getcomponente', //index.php/
        success: function(data){
               
                var opcion  = "<option value='-1'>Seleccione...</option>" ; 
                $('#componente').append(opcion); 
                for(var i=0; i < data.length ; i++) 
                {    
                      var nombre = data[i]['descripcion'];
                      var opcion  = "<option value='"+data[i]['id_componente']+"'>" +nombre+ "</option>" ; 

                      $('#componente').append(opcion); 
                                   
                }
              },
        error: function(result){
              
              console.log(result);
            },
            dataType: 'json'
        });
  }
  
  traer_periodo();
  function traer_periodo(){
      $.ajax({
        type: 'POST',
        data: { },
        url: 'index.php/Preventivo/getperiodo', //index.php/
        success: function(data){
          console.log(data);
               
                 var opcion  = "<option value='-1'>Seleccione...</option>" ; 
                  $('#periodo').append(opcion); 
                for(var i=0; i < data.length ; i++) 
                {    
                    var nombre = data[i]['descrip'];
                    var opcion  = "<option value='"+data[i]['id_periodo']+"'>" +nombre+ "</option>" ; 

                    $('#periodo').append(opcion); 
                                   
                }
              },
        error: function(result){
              
              console.log(result);
            },
            dataType: 'json'
        });
  }

  

$("#herramienta").keydown(function (e) {
      if (e.keyCode == 13) {
        var id_herramienta = $(this).val();
        $.ajax({
            type: 'POST',
            data: { id_herramienta: id_herramienta},
            url: 'index.php/Preventivo/getdatos', //index.php/
            success: function(data){
                    
                  console.log(data);


                  var marca = data[0]['herrmarca']; 
                  //var descripcion = data[0]['abonodescrip']; 

                  $('#marcaherram').val(marca); 

                  var des = data[0]['herrdescrip'];
                  $('#descripcionherram').val(des); 

 

                   var codigo = data[0]['herrcodigo']; 
                    $('#herramienta').val(codigo);
                  
                    
                  },
              
            error: function(result){
                  
                  console.log(result);
                },
                dataType: 'json'
            });
      }
    });
 

$("#addcompo").click(function(){  

           bootbox.dialog({
            backdrop: true,
            title: "Agregar Componente",
            message:'<form role="form" id="agregarC" name="agregarC" >'+  
                      '<div class="row" >'+
                        '<div class="col-sm-12 col-md-12">'+
                          '<fieldset> </fieldset>'+
                            '<br>'+
                              '<div class="col-xs-8">Nombre de Componente'+
                                '<input type="text"   class="form-control input-md" id="descripcion"  name="descripcion" placeholder="Ingrese Nombre del componente" >'+
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
                                        'descripcion': $('#descripcion').val(),
                                        

                                      };
                                    

                                      $.ajax({
                                        type:"POST",
                                        url: "index.php/Preventivo/agregar_componente", //controlador /metodo
                                        data:{datos:datos},
                                        success: function(data){
                                            console.log(data);
                                            if(data > 0)
                                            {  
                                                var texto = '<option value="'+data+'">'+ datos.descripcion +'</option>';

                                                $('#componente').append(texto);
                                                
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

$('#insumo').keydown(function (e) {
      if (e.keyCode == 13) {
      var id_insumo = $(this).val();
      $.ajax({
          type: 'POST',
          data: { id_insumo: id_insumo},
            url: 'index.php/Preventivo/traerinsumo', //index.php/
            success: function(data){
                 console.log(data);


                  var d = data[0]['artDescription']; 
                  //var descripcion = data[0]['abonodescrip']; 

                  $('#descript').val(d);  
                  var insumo = data[0]['artBarCode']; 
                  $('#insumo').val(insumo);
                  
                    
                  },
              
            error: function(result){
                  
                  console.log(result);
                },
                dataType: 'json'
            });
      }

  });

$("#addherramienta").click(function(){  

           bootbox.dialog({
            backdrop: true,
            title: "Agregar Herramientas",
            message:'<form role="form" id="agregarH" name="agregarH" >'+  
                      '<div class="row" >'+
                        '<div class="col-sm-12 col-md-12">'+
                          '<fieldset> </fieldset>'+
                            '<br>'+
                              '<div class="col-xs-4">Codigo:'+
                                '<input type="text" name="codh" class="form-control" placeholder="Ingrese Codigo"   />'+
                                '<input type="hidden" id="herrId" name="herrId">'+
                              '</div>'+
                              '<div class="col-xs-4">Marca:'+
                                '<input type="text" id="marcah" name="marcah" class="form-control" placeholder="Ingrese Marca"  />'+
                              '</div>'+
                                               
                              '<div class="col-xs-4">Estado:'+
                                '<input type="text" id="estadoh"  name="estadoh" class="form-control input-md" placeholder="Ingrese Estado" />'+
                              '</div>'+
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
                                        'herrcodigo': $('#codigoh').val(),
                                        'herrmarca': $('#marcah').val(),
                                        'equip_est': $('#estadoh').val(),


                                      };
                                    

                                      $.ajax({
                                        type:"POST",
                                        url: "index.php/Preventivo/guardar_agregar", //controlador /metodo
                                        data:{datos:datos},
                                        success: function(data){
                                            console.log(data);
                                            if(data > 0)
                                            {  
                                                var texto = '<option value="'+data+'">'+ datos.herrcodigo +'</option>';

                                                $('#herramienta').append(texto);
                                                
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

  $("#addinsumo").click(function(){  

           bootbox.dialog({
            backdrop: true,
            title: "Agregar Insumos",
            message:'<form role="form" id="agregarE" name="agregarE" >'+  
                      '<div class="row" >'+
                        '<div class="col-sm-12 col-md-12">'+
                          '<fieldset> </fieldset>'+
                            '<br>'+
                              '<div class="col-xs-8">Codigo de Insumo'+
                                '<input type="text"   class="form-control input-md" id="codi"  name="codi" placeholder="Ingrese Codigo de Insumo" >'+
                                '<div class="col-xs-4">Descripcion:'+
                                '<input type="text" id="de" name="de" class="form-control" placeholder="Ingrese descripcion"  />'+
                                '</div>'+
                                               
                                '<div class="col-xs-4">Estado:'+
                                  '<input type="text" id="esti"  name="esti" class="form-control input-md" placeholder="Ingrese Estado" />'+
                                '</div>'+
                                '<div class="col-xs-4">Costo:'+
                                  '<input type="text" id="costo"  name="costo" class="form-control input-md" placeholder="Ingrese Costo" />'+
                                '</div>'+
                                '<div class="col-xs-4">Marginal:'+
                                  '<input type="text" id="marginal"  name="marginal" class="form-control input-md"  />'+
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
                                        'artBarCode': $('#codi').val(),
                                        'artDescription': $('#de').val(),
                                        'artCoste': $('#costo').val(),
                                        'artMargin': $('#marginal').val(),
                                        'artEstado': $('#esti').val(),
                                        

                                      };
                                    

                                      $.ajax({
                                        type:"POST",
                                        url: "index.php/Preventivo/agregar_insumo", //controlador /metodo
                                        data:{datos:datos},
                                        success: function(data){
                                            console.log(data);
                                            if(data > 0)
                                            {  
                                                var texto = '<option value="'+data+'">'+ datos.codi +'</option>';

                                                $('#insumo').append(texto);
                                                
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

  $(".fa-times-circle").click(function (e) { 
               
        var tr = $(this).parent('td').parent('tr');

        var idprev = $(this).parent('td').parent('tr').attr('id');
        console.log(idprev);
        bootbox.confirm("¿Realmente desea Dar de BAJA?", function(e) { 
          if(e)
            $.ajax({
              type: 'POST',
              data: { idprev: idprev},
              url: 'index.php/Preventivo/baja_preventivo', //index.php/
              success: function(data){
                      //var data = jQuery.parseJSON( data );
                      
                      console.log(data);
                     
                      $(tr).remove();

                       bootbox.alert("Se dio de baja", function() {});
                    },
                
              error: function(result){
                    
                    console.log(result);
                  },
                  dataType: 'json'
              });
          else alert('cancel');
        });
  
    });

$("#agregarherr").click(function (e) {


        var $id_herramienta= $('#id_herramienta').val();
        //var $herramienta = $("select#herramienta option:selected").html();

        var $herramienta = $('#herramienta').val();
        
        var $marcaherram = $('#marcaherram').val();
        var $descripcionherram = $('#descripcionherram').val();

        var $cantidadherram = $('#cantidadherram').val();
        //var datos=Array();
        //datos=marca.split('%%');  //class='quitarEquipo'
                

        var tr = "<tr>"+
                    "<td ><a id='quitarEquipo_"+$id_herramienta+"' class='quitarEquipo' style='cursor:pointer'>X</a></td>"+
                    "<td>"+$herramienta+"</td>"+
                    "<td>"+$marcaherram+"</td>"+
                    "<td>"+$descripcionherram+"</td>"+
                    "<td>"+$cantidadherram+"</td>"+
                    
                "</tr>";
   

        $('#tablaherramienta tbody').append(tr);
        
        $("#quitarEquipo_"+id_herramienta).click(function (e) {
          //alert('quitar');
          $(this).parent('td').parent('tr').remove();
        });
       
       $('#herramienta').val('');
       $('#marcaherram').val(''); 
       $('#descripcionherram').val(''); 
       $('#cantidadherram').val(''); 
       

 });

$("#agregarins").click(function (e) {

        var id_insumo= $('#id_insumo').val();
        var insumo = $('#insumo').val();
        var descript = $('#descript').val();
        var cant = $('#cant').val();
        //var datos=Array();
        //datos=marca.split('%%');  //class='quitarEquipo'
        console.log(insumo);
         

        var tr = "<tr>"+
                    "<td ><a id='quitarEquipo_"+insumo+"' class='quitarEquipo' style='cursor:pointer'>X</a></td>"+
                    "<td>"+insumo+"</td>"+
                    "<td>"+descript+"</td>"+
                    "<td>"+cant+"</td>"+
                    
                "</tr>";
   

        $('#tablainsumo tbody').append(tr);
        
        $("#quitarEquipo_"+insumo).click(function (e) {
          //alert('quitar');
          $(this).parent('td').parent('tr').remove();
        });
       
       $('#insumo').val('');
       $('#descript').val(''); 
       $('#cant').val(''); 
       

 });

$(".fa-pencil").click(function (e) { 
        
        $('#modalSale').modal('show');

        var idprev = $(this).parent('td').parent('tr').attr('id');
        console.log(idprev);
        
        $.ajax({
          type: 'GET',
          data: { idprev: idprev},
          url: 'index.php/Preventivo/geteditar', //index.php/
          success: function(data){
                  //var data = jQuery.parseJSON( data );
                  
                  console.log(data);
                 
                  datos={
                    'idprev':idprev,

                    'id_equipo':data['datos'][0]['id_equipo'],
                    'fecha_ingreso':data['datos'][0]['fecha_ingreso'],
                    'marca':data['datos'][0]['marca'],
                    'codigo':data['datos'][0]['codigo'],
                    'ubicacion':data['datos'][0]['ubicacion'],
                    'descripcion':data['datos'][0]['descripcion'],
                    
                    'id_tarea':data['datos'][0]['id_tarea'],
                    'perido':data['datos'][0]['perido'],
                    'cantidad':data['datos'][0]['cantidad'],
                    'ultimo':data['datos'][0]['ultimo'],
                    'id_componente':data['datos'][0]['id_componente'],
                    'critico1':data['datos'][0]['critico1'],



                  }

                  var herramienta = data['herramienta'];
                  var insumo = data['insumo'];
                  //var equipos = data['equipos'];
                  
                  edit=1;

                  completarEdit(datos, herramienta, insumo, edit);
                  OpenSale();               
              
                },
            
          error: function(result){
                
                console.log(result);
              },
              dataType: 'json'
          });
  
});

function completarEdit(datos, herramienta,insumo,edit){


    
    $('#equipo').val(datos['id_equipo']);
    $('#fecha_ingreso').val(datos['fecha_ingreso']);
    $('#marca').val(datos['marca']);
    $('#codigo').val(datos['codigo']);
    $('#ubicacion').val(datos['ubicacion']);
    $('#descripcion').val(datos['descripcion']);
    
    $('#tarea').val(datos['id_tarea']);
    $('#periodo').val(datos['perido']);
    $('#cantidad').val(datos['cantidad']);
    $('#ultimo').val(datos['ultimo']);
    
    $('#componente').val(datos['id_componente']);
    
    $('#critico1').val(datos['critico1']);

    

    $('#tablaherramienta tbody tr').remove();
    for (var i = 0; i < herramienta.length; i++) 
    {                                              //class=quitarEquipo
       
        var tr = "<tr id='"+herramienta[i]['herramienta']+"'>"+
                    "<td ><a class='quitarEquipo' style='cursor:pointer'>X</a></td>"+
                    "<td>"+herramienta[i]['herrcodigo']+"</td>"+
                    "<td>"+herramienta[i]['herrmarca']+"</td>"+
                    "<td>"+herramienta[i]['cantidad']+"</td>"+
                   
                "</tr>";

        $('#tablaherramienta tbody').append(tr);
      }
        
    $('#tablainsumo tbody tr').remove();
    for (var i = 0; i < insumo.length; i++) 
    {                                              //class=quitarEquipo
       
        var tr = "<tr id='"+insumo[i]['insumo']+"'>"+
                    "<td ><a class='quitarEquipo' style='cursor:pointer'>X</a></td>"+
                    "<td>"+insumo[i]['artBarCode']+"</td>"+
                    "<td>"+insumo[i]['artDescription']+"</td>"+
                    "<td>"+insumo[i]['cant']+"</td>"+
                   
                "</tr>";

        $('#tablainsumo tbody').append(tr);
    }

    $(".quitarEquipo").click(function (e) {
          //alert('quitar');
          $(this).parent('td').parent('tr').remove();
        
    });



  }

 
function guardar()
 {     //alert("si guardo ");

        //var id = $('#id').val();
        var equipo = $('#equipo').val();
        var tarea = $('#tarea').val();
        var periodo = $('#perido').val();
        var cantidad = $('#cantidad').val();
        var ultimo = $('#ultimo').val();
        var componente = $('#componente').val();
        var critico1 = $('#critico1').val();
        var  cantidadhm= $('#cantidadhm').val();

        
        var idsherramienta = new Array();     
        $("#tablaherramienta tbody tr").each(function (index) 
        {
            var ide = $(this).parent('td').parent('tr').attr('id');
            //var ide = $(this).attr('id_herramienta');
            idsherramienta.push(ide);            
          
          console.log(ide);
        }); 
        //var idsinsumo = new Array();     
        /*$("#tablainsumo tbody tr").each(function (index) 
        {
         
            var idi = $(this).attr('id_insumo');
            idsinsumo.push(idi);            
          
        
        }); */
        
        var parametros = {
            'id_equipo': equipo,
            'id_tarea': tarea,
            'perido': periodo,
            'cantidad': cantidad,
            'ultimo' : ultimo,
            'id_componente': componente,
            'critico1': critico1,
            'cantidadhm': cantidadhm,
            
                        
        };
        $('#sales').append(parametros);

         //console.log(parametros);
        //if(edit==0)
        //{
        $.ajax({
              type: 'POST',
              data: {data:parametros, idsherramienta:idsherramienta },
              url: 'index.php/Preventivo/guardar_preventivo',  //index.php/
              success: function(data){
                     // var data = jQuery.parseJSON( result );
                      
                      $('#modalSale').modal('hide');

                       setTimeout(function(){
                             var permisos = '<?php echo $permission; ?>';
                            cargarView('preventivo', 'index', permisos) ; 
                      },3000); // 3000ms = 3s
                     
                    },
              error: function(result){
                    
                    console.log(result);
                    $('#modalSale').modal('hide');
                  },
                  dataType: 'json'
        });
        //guardar_herramientas(idsherramienta);
        //guardar_insumos(); 
      //}
          
}
/*function guardar_herramientas()
  {     //alert("si guardo ");
        //var idpre = $(this).parent('td').parent('tr').attr('prevId');
        //console.log(idpre);
        
        var herramienta = $('#herramienta').val();
        var marcaherram = $('#marcaherram').val();
        var cantidad = $('#cantidad').val();
        
        
        
        var parametros = {
            
            'herrcodigo': herramienta,
            'herrmarca': marcaherram,
            'cantidad': cantidad,
            
            
                        
        };
        

         //console.log(parametros);
          $.ajax({
              type: 'POST',
              data: {data:parametros },
              url: 'index.php/Preventivo/guardar_tb_preventivo herramienta',  //index.php/
              success: function(data){
                     // var data = jQuery.parseJSON( result );
                      
                      $('#modalSale').modal('hide');

                       setTimeout(function(){
                             var permisos = '<?php //echo $permission; ?>';
                            cargarView('preventivo', 'index', permisos) ; 
                      },3000); // 3000ms = 3s
                     
                    },
              error: function(result){
                    
                    console.log(result);
                    $('#modalSale').modal('hide');
                  },
                  dataType: 'json'
          });
 
  }*/

$('#reset').click( function cargarVista(){
    WaitingOpen();
    $('#content').empty();
    $("#content").load("<?php echo base_url(); ?>index.php/Preventivo/index/<?php echo $permission; ?>");
    WaitingClose();
});

  
</script>


<!-- Modal -->
<div class="modal fade" id="modalSale" tabindex="2000" aria-labelledby="myModalLabel" >
  <div class="modal-dialog" role="document" style="width: 60%">
    <div class="modal-content">
      
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="cerro()"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel"><span id="modalActionSale"> </span> Preventivo</h4> 
      </div>

    <div class="modal-body" id="modalBodySale">
      
      <div class="row" >
        <div class="col-sm-12 col-md-12">
         <br>
          <fieldset><legend></legend></fieldset>
                <div class="form-group">
                  <label class="control-label col-xs-4">Datos del Equipo</label> 
                  <div class="col-xs-4">
                  
                  </div>
                </div>
                
                <br>
                <fieldset><legend></legend></fieldset>

                <div class="col-xs-4">Equipos:
                   <select  id="equipo" name="equipo" class="form-control" />
                   <input type="hidden" id="id_equipo" name="id_equipo">
                </div>
                <div class="col-xs-10">
                  
                </div>

                <div class="col-xs-4">Fecha:
                    <input type="text" id="fecha_ingreso"  name="fecha_ingreso" class="form-control input-md" disabled />
                </div>
                <div class="col-xs-4">Marca:
                    <input type="text" id="marca"  name="marca" class="form-control input-md"  disabled />
                </div>
               
                <div class="col-xs-4">Ubicacion:
                    <input type="text" id="ubicacion"  name="ubicacion" class="form-control input-md" disabled/>
                </div>
               
                <br>
                <div class="col-xs-8">Descripcion: 
                </div> 

                <div class="row">
                  <div class="col-lg-12">
                  
                  <textarea class="form-control" id="descripcion" name="descripcion" disabled></textarea>
                  </div>
                </div>

                
          
        
            <div class="row" >
              <div class="col-sm-12 col-md-12">
                <fieldset> </fieldset>
                <br>
                <fieldset><legend></legend></fieldset>
                    <div class="form-group">
                        <label class="control-label col-xs-4">Nueva Tarea</label> 
                      <div class="col-xs-4">
                      </div>
                    </div>
                    <fieldset><legend></legend></fieldset>
                    <br>
                    <div class="col-xs-4">Tarea:
                     <select id="tarea" name="tarea" class="form-control"   />
                     <input type="hidden" id="id_tarea" name="id_tarea">
                    </div>
                    <input type="hidden" id="id" name="id">

                    <div class="col-xs-4">Componente:
                      <select id="componente" name="componente" class="form-control"   />
                      <input type="hidden" id="id_componente" name="id_componente">
                    </div>
                                       
                    <div class="col-xs-4">Periodo:
                      <select id="periodo"  name="periodo" class="form-control input-md" />
                    </div>

                    <div class="col-xs-4">Cantidad:
                      <input type="text"  id="cantidad" name="cantidad" class="form-control input-md" placeholder="Ingrese cantidad" />
                    </div>
                    
                    <br>
                    
                    <div class="col-xs-4">Critico:
                      <input type="text" id="critico1"  name="critico1" class="form-control input-md"  placeholder="Ingrese Criterio"/>
                    </div>
                   
                    <div class="col-xs-4">Fecha:
                      <input type="date" id="ultimo"  name="ultimo" class="form-control input-md" />
                    </div>
                    <div class="col-xs-3">
                      
                    </div>                                      
              </div>
            </div>
            <br>
            <fieldset><legend></legend></fieldset>
                               
          <div>

            <!--tabs -->
            <ul class="nav nav-tabs" role="tablist">
              <li role="presentation" class="active"><a href="#choras" aria-controls="home" role="tab" data-toggle="tab">Cantidad Horas/Hombres</a></li>
              <li role="presentation"><a href="#herramin" aria-controls="profile" role="tab" data-toggle="tab">Herramientas</a></li>
              <li role="presentation"><a href="#insum" aria-controls="messages" role="tab" data-toggle="tab">Insumos</a></li>
              
            </ul>

            <!-- Tab panes -->
            <div class="tab-content">
                <div role="tabpanel" class="tab-pane active" id="choras">
                  <div class="row" >
                    <div class="col-sm-12 col-md-12">
                    <br>
                    <fieldset><legend></legend></fieldset>
                      <div class="col-xs-4">
                        <input type="text"  id="cantidadhm"  name="cantidadhm" class="form-control input-md" placeholder="Ingrese Cantidad de horas" />
                      </div>
                    </div>
                  </div>

                </div><!--cierre de choras-->
                <div role="tabpanel" class="tab-pane" id="herramin">
                  <br>
                  <fieldset><legend></legend></fieldset>
                   
                    <div class="col-xs-3">Codigo:
                        <input type="text"  id="herramienta"  name="herramienta" class="form-control input-md" />
                        <input type="hidden" id="id_herramienta" name="id_herramienta">
                    </div>
                    
                    <div class="col-xs-3">Marca:
                        <input type="text" id="marcaherram"  name="marcaherram" class="form-control input-md" />
                    </div>

                    <div class="col-xs-3">Descripcion:
                        <input type="text" id="descripcionherram"  name="descripcionherram" class="form-control input-md" />
                    </div>


                    <div class="col-xs-3">Cantidad:
                        <input type="text" id="cantidadherram"  name="cantidadherram" class="form-control input-md" placeholder="Ingrese Cantidad" />
                    </div>
                    <br>
                    <div class="col-xs-3"><label></label> 
                    <br>
                          <button type="button" class="btn btn-success" id="agregarherr"><i class="fa fa-check">Agregar</i></button>
                    </div>

                    <div class="row">
                          <div class="col-xs-10 col-xs-offset-1">
                            <table class="table table-bordered" id="tablaherramienta"> 
                              <thead>
                                <tr>                      
                                <br>
                                <th width="35px"></th>
                                <th width="10%">Código</th>
                                <th>Marca</th>
                                <th width="10%">Cantidad</th>
                                </tr>
                              </thead>
                              <tbody></tbody>
                            </table>  
                          </div>
                    </div>
                </div> <!-- cierre div herram-->
                <div role="tabpanel" class="tab-pane" id="insum">
                <br>
                <fieldset><legend></legend></fieldset>
                  <div class="col-xs-3">Codigo:
                        <input type="text"  id="insumo"  name="insumo" class="form-control input-md" />
                        <input type="hidden" id="id_insumo" name="id_insumo">

                        </div>
                        <div class="col-xs-3">Descripcion:
                            <input type="text" id="descript"  name="descript" class="form-control input-md" />
                        </div>
                        <div class="col-xs-3">Cantidad:
                            <input type="text" id="cant"  name="cant" class="form-control input-md" placeholder="Ingrese Cantidad"/>
                        </div>
                        <br>

                        <div class="col-xs-3"><label></label> 
                          <button type="button" class="btn btn-success" id="agregarins"><i class="fa fa-check">Agregar</i></button>
                        </div>
                        <br>
                        <div class="row">
                          <div class="col-xs-10 col-xs-offset-1">
                            <table class="table table-bordered" id="tablainsumo"> 
                              <thead>
                                <tr>                           
                                <br>
                                <th width="35px"></th>
                                <th width="10%">Código</th>
                                <th>Descripcion</th>
                                <th width="10%">Cantidad</th>
                               
                                </tr>
                              </thead>
                              <tbody></tbody>
                            </table>  
                          </div>
                        </div>

                </div><!--cierre div insum-->
              
            </div><!--tab-content-->
          </div>
          

            
           
                    

          
                  <!--  <div id="insum">
                    <br>
                    <fieldset><legend></legend></fieldset>
                    <div class="form-group">
                        <label class="control-label col-xs-4">Insumos</label> 
                        <button type="button" class="btn btn-success" id="addinsumo">Agregar</button>

                      <div class="col-xs-4">

                      </div>
                    </div> 
                      <fieldset><legend></legend></fieldset> 
                      
                  </div>
            </div>-->




            <!--OTRA OPCION DE BOTON <div class="btn-group" role="group" aria-label="...">
              <button type="button" class="btn btn-default">Herramientas</button>
              <button type="button" class="btn btn-default">Insumos</button>
            </div>--->


          <!-- AGREGAR HERRAMIENTAS 
            <div class="row" >
              <div class="col-sm-12 col-md-12">
                <fieldset> </fieldset>
                <br>
                <fieldset><legend></legend></fieldset>
                  <div class="form-group">

                      <label class="control-label col-xs-4">Herramientas</label> 

                     <button type="button" class="btn btn-success" id="addherramienta">Agregar</button>
                    <!--<button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#addherramienta" >Agregar</button>-->

                     <!-- <div class="col-xs-4">

                      </div>
                      <div class="col-xs-4">

                      </div>
                      <div class="col-xs-4">

                      </div>
                  </div>
                  
                  <!--<div class="col-xs-8">
                  <button type="button" class="btn btn-success" id="lista">Lista</button>
                 <!-- <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#modalherramienta" id="lista">Lista</button>-->
                    
                  <!--</div>-->
               <!--   <div class="row" >
                    <div class="col-sm-12 col-md-12">
                      <br>
                      <fieldset><legend></legend></fieldset>
                        <div class="col-xs-3">Codigo:
                          <input type="text"  id="herramienta"  name="herramienta" class="form-control input-md" />
                          <input type="hidden" id="id_herramienta" name="id_herramienta">
                        </div>
                  
                        <div class="col-xs-3">Marca:
                          <input type="text" id="marcaherram"  name="marcaherram" class="form-control input-md" />
                        </div>
                        <div class="col-xs-3">Cantidad:
                          <input type="text" id="cantidadherram"  name="cantidadherram" class="form-control input-md" />
                        </div>
                  
                        <div class="col-xs-3"><label></label> 
                          <button type="button" class="btn btn-success" id="agregarherr"><i class="fa fa-check"></i></button>
                        </div>

                                            
                  <!--class="fa fa-check"-->
                    <!--    <div class="row">
                          <div class="col-xs-10 col-xs-offset-1">
                            <table class="table table-bordered" id="tablaherramienta"> 
                              <thead>
                              <tr>                           <!--no encuentro la x <i class="fa fa-fw fa-times-circle" style="color: #dd4b39; cursor: pointer; margin-left: 15px;" -->
                             <!-- <br>
                              <th width="35px"></th>
                              <th width="10%">Código</th>
                              <th>Marca</th>
                              <th width="10%">Cantidad</th>
                             
                              </tr>
                            </thead>
                            <tbody></tbody>
                          </table>  
                      
                        </div>
                      </div>

                  
              </div>
            </div> --> 
              <!-- INSUMO
                <div class="row" >
                  <div class="col-sm-12 col-md-12">
                    <fieldset> </fieldset>
                    <br>
                    <fieldset><legend></legend></fieldset>
                    <div class="form-group">
                        <label class="control-label col-xs-4">Insumos</label> 
                        <button type="button" class="btn btn-success" id="addinsumo">Agregar</button>

                      <div class="col-xs-4">

                      </div>
                    </div> 
                    <fieldset><legend></legend></fieldset> 
                    <div class="col-xs-3">Codigo:
                      <input type="text"  id="insumo"  name="insumo" class="form-control input-md" />
                      <input type="hidden" id="id_insumo" name="id_insumo">

                      </div>
                      <div class="col-xs-3">Descripcion:
                          <input type="text" id="descript"  name="descript" class="form-control input-md" />
                      </div>
                      <div class="col-xs-3">Cantidad:
                          <input type="text" id="cant"  name="cant" class="form-control input-md" />
                      </div>

                      <div class="col-xs-3"><label></label> 
                    <button type="button" class="btn btn-success" id="agregarins"><i class="fa fa-check"></i></button>
                  </div>
                  <div class="row">
                    <div class="col-xs-10 col-xs-offset-1">
                      <table class="table table-bordered" id="tablainsumo"> 
                        <thead>
                        <tr>                           <!--no encuentro la x <i class="fa fa-fw fa-times-circle" style="color: #dd4b39; cursor: pointer; margin-left: 15px;" -->
                      <!--  <br>
                        <th width="35px"></th>
                        <th width="10%">Código</th>
                        <th>Descripcion</th>
                        <th width="10%">Cantidad</th>
                       
                        </tr>
                      </thead>
                      <tbody></tbody>
                    </table>  
                
                  </div>
                </div>
 
                  </div>
                </div>-->
              

        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal" onclick="cerro()">Cancelar</button>
          <button type="button" class="btn btn-primary" id="btnSave" onclick="guardar()">Guardar</button>
        </div>

      </div>
  </div>
</div>

<div class="modal fade" id="modalherramienta" tabindex="2000" aria-labelledby="myModalLabel" >
  <div class="modal-dialog" role="document" style="width: 60%">
    <div class="modal-content">
      
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="cerro()"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel"><span id="modalActionSale"> </span> Lista de Herramientas</h4> 
      </div>

      <div class="modal-body" id="modalBodySale">
        
        <div class="row" >
          <div class="col-sm-12 col-md-12">
           <br>
            <fieldset><legend></legend></fieldset>
            <div class="col-xs-3">Codigo:
              <input type="text"  id="herramienta"  name="herramienta" class="form-control input-md" />
              <input type="hidden" id="id_herramienta" name="id_herramienta">
            </div>
                  
            <div class="col-xs-3">Marca:
              <input type="text" id="marcaherram"  name="marcaherram" class="form-control input-md" />
            </div>
            <div class="col-xs-3">Cantidad:
              <input type="text" id="cantidadherram"  name="cantidadherram" class="form-control input-md" />
            </div>
                  
            <div class="col-xs-3"><label></label> 
              <button type="button" class="btn btn-success" id="agregarherr"><i class="fa fa-check"></i></button>
            </div>


          </div>
        </div>
      </div>
    </div>
  </div>
</div>

