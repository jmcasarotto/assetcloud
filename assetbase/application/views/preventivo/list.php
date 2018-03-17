﻿<input type="hidden" id="permission" value="<?php echo $permission;?>">
<section class="content">
 
  <div class="row">
    <div class="col-xs-12">
      <div class="box">
        <div class="box-header">
          <h3 class="box-title">Tareas Preventivas por frecuencia</h3>
          <?php

            if (strpos($permission,'Add') !== false) {
            
          ?>
              <button class="btn btn-block btn-success" style="width: 100px; margin-top: 10px;"  id="btnAgre">Agregar</button>             
            
          <?php 
            }
          ?>
        </div><!-- /.box-header -->
        <div class="box-body">
          <table id="tabprev" class="table table-bordered table-hover">
            <thead>
              <tr>
                <th width="5%" style="text-align: center">Acciones</th>
                <th  width="18%" style="text-align: center">Tarea</th>
                <th width="13%" style="text-align: center">Equipo</th>
                <th style="text-align: center">Grupo</th>
                <th style="text-align: center">Componente</th>
                <th style="text-align: center">Periodo</th>
                <th width="5%" style="text-align: center">Frecuencia</th>
                <th style="text-align: center">Fecha Base</th>
              
              </tr>
            </thead>
            <tbody>
              <?php
                if(count($list['data']) > 0){                
                  
                    foreach($list['data'] as $a){

                      if ($a['estadoprev'] !== "AN") {
                          $id=$a['prevId'];
                          $ide=$a['id_equipo'];

                          echo '<tr id="'.$id.'" class="'.$ide.'">';
                          echo '<td style="text-align: center" >';
                         
                          if (strpos($permission,'Add') !== false) {
                            echo '<i class="fa fa-fw fa-times-circle" style="color: #A4A4A4; cursor: pointer; margin-left: 15px;" title="Eliminar" ></i>';

                            echo '<i class="fa fa-fw fa-pencil" style="color: #A4A4A4; cursor: pointer; margin-left: 15px;" title="Editar" ></i>';

                         // echo '<i class="fa fa-file-text" id="cargOrden" style="color: #A4A4A4; cursor: pointer; margin-left: 15px;" title="Orden de Trabajo" ></i>';
                          }
                          
                          
                          echo '</td>';
                          echo '<td style="text-align: center">'.$a['deta'].'</td>';
                          echo '<td style="text-align: center">'.$a['des'].'</td>';
                          echo '<td style="text-align: center">'.$a['des1'].'</td>';
                          echo '<td style="text-align: center">'.$a['descripcion'].'</td>';
                          
                          echo '<td style="text-align: center">'.$a['perido'].'</td>';
                           echo '<td style="text-align: center">'.$a['cantidad'].'</td>';
                          echo '<td style="text-align: center">'.date_format(date_create($a['ultimo']), 'd-m-Y').'</td>';
                         // echo '<td style="text-align: right">'.$a['descripcion'].'</td>';
                         
                          echo '</tr>';
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
var isOpenWindow = false;
var codhermglo="";
var codinsumolo="";
var preglob="";

$(document).ready(function(event) {

  edit=0;  datos=Array();
  $('#btnAgre').click( function cargarVista(){
    WaitingOpen();
    $('#content').empty();
    $("#content").load("<?php echo base_url(); ?>index.php/Preventivo/cargarpreventivo/<?php echo $permission; ?>");
    WaitingClose();
  });
  //Eliminar
  $(".fa-times-circle").click(function (e) { 
                 
          var tr = $(this).parent('td').parent('tr');

          var idprev = $(this).parent('td').parent('tr').attr('id');
          console.log(idprev);
          
              $.ajax({
                type: 'POST',
                data: { idprev: idprev},
                url: 'index.php/Preventivo/baja_preventivo', //index.php/
                success: function(data){
                        //var data = jQuery.parseJSON( data );
                        
                        console.log(data);
                       
                        $(tr).remove();

                        alert("Preventivo ANULADO");
                        cargarVista();
                      },
                  
                error: function(result){
                      
                      console.log(result);
                    },
                    dataType: 'json'
                });
            
    
  });    
  //Editar
  $(".fa-pencil").click(function (e) { 
            
            $('#modalSale').modal('show');

            var idprev = $(this).parent('td').parent('tr').attr('id');
            console.log(idprev);
            preglob= idprev;
            console.log(preglob);

            $.ajax({
              type: 'GET',
              data: { idprev: idprev},
              url: 'index.php/Preventivo/geteditar', //index.php/
              success: function(data){
                      //var data = jQuery.parseJSON( data );
                      
                      console.log(data);
                      console.log("codigo");
                      console.log(data['datos'][0]['descripta']);
                      console.log(data['datos'][0]['id_tarea ']);
                     
                      datos={
                        'idprev':data['datos'][0]['idprev'],

                        'id_equipo':data['datos'][0]['id_equipo'], //codigo id_equipo
                        'fecha_ingreso':data['datos'][0]['fecha_ingreso'],
                        'marca':data['datos'][0]['marcadescrip'],
                        'codigo':data['datos'][0]['codigo'],
                        'ubicacion':data['datos'][0]['ubicacion'],
                        'descripcion':data['datos'][0]['descripcion'],
                        
                        'id_tarea':data['datos'][0]['id_tarea'], //iria  id_tarea descripta
                        'perido':data['datos'][0]['perido'],
                        'cantidad':data['datos'][0]['cantidad'],
                        'ultimo':data['datos'][0]['ultimo'],
                        'id_componente':data['datos'][0]['id_componente'],
                        'critico1':data['datos'][0]['critico1'],
                        'horash':data['datos'][0]['horash'],
                        'ultimo':data['datos'][0]['ultimo'],



                      }
                     

                      var herram = data['herramientas']
                      //var herram = data['herramienta'];
                      var insum = data['insumos'];
                      //var equipos = data['equipos'];
                      console.log(herram);
                      console.log(insum);
                      completarEdit(datos, herram, insum);
                      //OpenSale();               
                  
                    },
                
              error: function(result){
                    
                    console.log(result);
                  },
                  dataType: 'json'
              });
      
  });
  $("#herramienta").change(function(){     
    var id_herramienta = $(this).val();
    console.log("El id de la herramienta que seleccione es:");
    console.log(id_herramienta); 
    codhermglo=id_herramienta;
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
    });
   

   /* $("#addcompo").click(function(){  

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
               
    }); */

    $("#insumo").change(function(){
       
      var id_insumo = $(this).val();
      codinsumolo=id_insumo;
      console.log("El id de insumo que seleccione es:");
      console.log(id_insumo);
      console.log(codinsumolo);
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

    });

  var cod="";
  $("#agregarherr").click(function (e) {   
      var id_herramienta= $("#herramienta").val(codhermglo);    
      var id_her=codhermglo;
     //alert(id_herramienta);
     console.log("herramienta:"+id_her);
     var id_herramienta1= $("#herramienta").val();
     console.log("herramienta de prueba :"+id_herramienta1);

      var $herramienta = $("select#herramienta option:selected").html(); 

      var marcaherram = $('#marcaherram').val();
      var descripcionherram = $('#descripcionherram').val();
      var cantidadherram = $('#cantidadherram').val();
      
     /* var id_ca=$('#cantidadherram').val();
      alert(id_ca);   id_her*/
      var tr = "<tr id='"+id_her+"'>"+
                    "<td ><i class='fa fa-ban elirow' style='color: #f39c12'; cursor: 'pointer'></i></td>"+
                    "<td>"+$herramienta+"</td>"+
                    "<td>"+marcaherram+"</td>"+
                    "<td>"+descripcionherram+"</td>"+
                    "<td>"+cantidadherram+"</td>"+
                    
                "</tr>";
        console.log(tr);
        
        $('#tablaherramienta tbody').append(tr);
      

        $(document).on("click",".elirow",function(){
          var parent = $(this).closest('tr');
          $(parent).remove();
          });


        $('#herramienta').val('');
       $('#marcaherram').val(''); 
       $('#descripcionherram').val(''); 
       $('#cantidadherram').val('');
         
     

  });

  $("#agregarins").click(function (e) {

    var id_insumo= $('#insumo').val(codinsumolo);
    var id_in= codinsumolo;
    //var id_insumo1= $('#insumo').val();
    
    var $insumo = $("select#insumo option:selected").html();
    var descript = $('#descript').val();
    var cant = $('#cant').val();
      //var datos=Array();
      //datos=marca.split('%%');  //class='quitarEquipo'
    

    var tr = "<tr id='"+id_in+"'>"+
                  "<td ><i class='fa fa-ban elirow' style='color: #f39c12'; cursor: 'pointer'></i></td>"+
                  "<td>"+$insumo+"</td>"+
                  "<td>"+descript+"</td>"+
                  "<td>"+cant+"</td>"+
                  
              "</tr>";

    console.log(tr); 
    console.log("el id de insumo");
    console.log(id_in);
    

    $('#tablainsumo tbody').append(tr);


       
    $(document).on("click",".elirow",function(){
      var parent = $(this).closest('tr');
      $(parent).remove();
    });
     
    $('#insumo').val('');
    $('#descript').val(''); 
    $('#cant').val(''); 
         

  });

  // $(".fa-file-text").click(function(){
    
  //   var idp=$(this).parent('td').parent('tr').attr('id'); 
  //   var ide = $(this).parent('td').parent('tr').attr('class');
  //   console.log("El id de preventivo es:");
  //   console.log(idp);
  //   console.log("El id de equipo es:");
  //   console.log(ide);
  //   datos= parseInt(ide);
  //   console.log(datos); 

  //   $.ajax({
  //     type: 'POST',
  //     data: { idp: idp, datos:datos},
  //     url: 'index.php/Preventivo/getpreventivo', //index.php/
  //     success: function(data){
                          
  //             console.log(data);

             
  //             var equipo=data[0]['id_equipo'];
  //             var tarea=data[0]['id_tarea'];
  //             var fecha=data[0]['ultimo'];//fecha
  //              console.log(fecha);

  //             $.ajax({
  //                 type: 'POST',
  //                 data: { idp:idp, equipo: equipo, tarea:tarea, fecha:fecha},
  //                 url: 'index.php/Preventivo/preventivoinertot', //index.php/
  //                 success: function(data){
  //                         console.log("Inserte una orden");          
  //                         console.log(data);
                         

  //                         $('#content').empty();
  //                         $("#content").load("<?php echo base_url(); ?>index.php/Preventivo/volver/<?php echo $permission; ?>");
  //                         WaitingClose();               
                         
  //                       },
                    
  //                 error: function(result){
                                
  //                         console.log(result);
  //                       }
  //                 //dataType: 'json'
  //               });

  //           },
        
  //     error: function(result){
                    
  //             console.log(result);
  //           },
  //     dataType: 'json'
  //   });

  // });


  $('#tabprev').DataTable({
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


     
// function OpenSale(){

//   var btn = $('#btnAgre');
//   if(btn.is(':enabled')){
//     //Abrir ventana de facturación
//     if(isOpenWindow == false){
//       isOpenWindow = true;
//       LoadIconAction('modalActionSale','Add');
//       WaitingOpen('Cargando...');
//       $('#modalSale').modal({ backdrop: 'static', keyboard: false });
//       $('#modalSale').modal('show');
//       setTimeout(function () { $('#artId').focus(); }, 1000);
//       $('#saleDetail > tbody').html('');
     
//       WaitingClose();
     
//     }
//   }
// }


// function cerro(){
  
//   isOpenWindow = false;
// }

function traer_componente(id_equipo){
    $('#componente').html("");
    $.ajax({
      type: 'POST',
      data: {id_equipo: id_equipo },
      url: 'index.php/Preventivo/getcomponente', //index.php/
      async:false,
      success: function(data){
             
             $('#componente option').remove();
              var opcion  = "<option value='-1'>Seleccione...</option>" ; 
              $('#componente').append(opcion); 
              for(var i=0; i < data.length ; i++) 
              {    
                    var nombre = data[i]['descripcion'];
                    var opcion  = "<option value='"+data[i]['id_componente']+"'>" +nombre+ "</option>" ; 

                    $('#componente').append(opcion); 
                                 
              }
             //$('#componente').html("");

             
            },
      error: function(result){
            
            console.log(result);
          },
          dataType: 'json'
      });

}

function completarEdit(datos, herram,insum){


    $('#equipo').val(datos['id_equipo']);
    $('#fecha_ingreso').val(datos['fecha_ingreso']);
    $('#marca').val(datos['marca']);
//$('#codigo').val(datos['codigo']);
    $('#ubicacion').val(datos['ubicacion']);
    $('#descripcion').val(datos['descripcion']);
    traer_componente(datos['id_equipo']);
    $('#tarea').val(datos['id_tarea']);
    traer_tarea();
    traer_equipo();
    $('#periodo').val(datos['perido']);
    $('#cantidad').val(datos['cantidad']);
    $('#ultimo').val(datos['ultimo']);
    
    $('#componente').val(datos['id_componente']);
    
    $('#critico1').val(datos['critico1']);
    $('#cantidadhm').val(datos['horash']);

    

    $('#tablaherramienta tbody tr').remove();
    for (var i = 0; i < herram.length; i++) 
    {                                              //class=quitarEquipo
       
        var tr = "<tr id='"+herram[i]['herramienta']+"'>"+
                    "<td ><i class='fa fa-ban elirow' style='color: #f39c12'; cursor: 'pointer'></i></td>"+
                    "<td>"+herram[i]['herrcodigo']+"</td>"+
                    "<td>"+herram[i]['herrmarca']+"</td>"+
                    "<td>"+herram[i]['herrdescrip']+"</td>"+
                    "<td>"+herram[i]['cantidad']+"</td>"+
                   
                "</tr>";

        $('#tablaherramienta tbody').append(tr);
      }
        
    $('#tablainsumo tbody tr').remove();
    for (var i = 0; i < insum.length; i++) 
    {                                              //class=quitarEquipo
       
        var tr = "<tr id='"+insum[i]['insumo']+"'>"+
                    "<td ><i class='fa fa-ban elirow' style='color: #f39c12'; cursor: 'pointer'></i></td>"+
                    "<td>"+insum[i]['artBarCode']+"</td>"+
                    "<td>"+insum[i]['artDescription']+"</td>"+
                    "<td>"+insum[i]['cantidad']+"</td>"+
                   
                "</tr>";

        $('#tablainsumo tbody').append(tr);
    }

    $(document).on("click",".elirow",function(){
          var parent = $(this).closest('tr');
          $(parent).remove();
    });
       



  }

function guardar(){

    var equipo = $('#equipo').val();
    var tarea = $('#tarea').val();
    var periodo = $('#periodo').val();
    var cantidad = $('#cantidad').val();
    var ultimo = $('#ultimo').val();
    //traer_componente(datos['equipo']);
    var componente = $('#componente').val();
    var critico1 = $('#critico1').val();
    var cantidadhm= $('#cantidadhm').val();


    var idsherramienta = new Array();     
    $("#tablaherramienta tbody tr").each(function (index) 
    {
        var id_her = $(this).attr('id');
        idsherramienta.push(id_her);            
        
    }); 


    comp = {};
    $("#tablaherramienta tbody tr").each(function (index) 
    {
        var campo1, campo2, campo3, campo4;
        var id_her = $(this).attr('id'); 
        console.log(id_her); 
        $(this).children("td").each(function (index2) 
        {
            if (index2) {
              comp[id_her]=$(this).text();     
            }
             
        });

        console.log(comp); 

    });

    var idsinsumo = new Array();     
    $("#tablainsumo tbody tr").each(function (index) 
    {
        var id_in = $(this).attr('id');
        idsinsumo.push(id_in);            
      
    }); 

     comp2 = {};
    $("#tablainsumo tbody tr").each(function (index) 
    {
        var id_in = $(this).attr('id'); 
        console.log(id_in);
          
          
        $(this).children("td").each(function (index2) 
        {
            if (index2) {
              
              comp2[id_in]=$(this).text();
             
            }
            
        });

       console.log(comp2);

    });


    var parametros = {
        'id_equipo': equipo,
        'id_tarea': tarea,
        'perido': periodo,
        'cantidad': cantidad,
        'ultimo' : ultimo,
        'id_componente': componente,
        'critico1': critico1,
        'horash': cantidadhm,
        'estadoprev':"C",
        
                    
    };


    console.log("estoy editando");
    console.log(parametros);
    console.log(preglob); //ID del preventivo
    console.log(idsinsumo);
    console.log(idsherramienta);
    console.log(comp);
    console.log(comp2);
    $.ajax({
      type: 'POST',
      data: {data:parametros, preglob:preglob, idsherramienta:idsherramienta,comp:comp, idsinsumo:idsinsumo, comp2:comp2},
      url: 'index.php/Preventivo/editar_preventivo',  //index.php/
      success: function(data){
             
              console.log(data);
              console.log("exito");
              cargarVista();                     
            },
      error: function(result){
            
            console.log(result);
            console.log("Entre por el error");
            //$('#modalSale').modal('hide');
          }
         // dataType: 'json'
      });
}

traer_herramienta();

function traer_herramienta(){
      $.ajax({
        type: 'POST',
        data: { },
        url: 'index.php/Preventivo/getherramienta', //index.php/
        success: function(data){
               
                 var opcion  = "<option value='-1'>Seleccione...</option>" ; 
                  $('#herramienta').append(opcion); 
                for(var i=0; i < data.length ; i++) 
                {    
                      var nombre = data[i]['herrcodigo'];
                      var opcion  = "<option value='"+data[i]['herrId']+"'>" +nombre+ "</option>" ; 

                    $('#herramienta').append(opcion); 
                                   
                }
              },
        error: function(result){
              
              console.log(result);
            },
            dataType: 'json'
        });
}

traer_insumo();

function traer_insumo(){
      $.ajax({
        type: 'POST',
        data: { },
        url: 'index.php/Preventivo/getinsumo', //index.php/
        success: function(data){
               
                 var opcion  = "<option value='-1'>Seleccione...</option>" ; 
                  $('#insumo').append(opcion); 
                for(var i=0; i < data.length ; i++) 
                {    
                      var nombre = data[i]['artBarCode'];
                      var opcion  = "<option value='"+data[i]['artId']+"'>" +nombre+ "</option>" ; 

                    $('#insumo').append(opcion); 
                                   
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

//traer_equipo();

function traer_equipo(){
    $.ajax({
      type: 'POST',
      data: { },
      url: 'index.php/Preventivo/getequipo', //index.php/
      success: function(data){
             
               //var opcion  = "<option value='-1'>Seleccione...</option>" ; 
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

function cargarVista(){
  $('#content').empty();
  //$('#modalSale').empty();
  $("#content").load("<?php echo base_url(); ?>index.php/Preventivo/index/<?php echo $permission; ?>");
  WaitingClose();
  //WaitingClose();
}
  
</script>

<!-- Modal editar-->
<div class="modal fade" id="modalSale" tabindex="2000" aria-labelledby="myModalLabel" style="display: none;">
  <div class="modal-dialog" role="document" style="width: 60%">
    <div class="modal-content">
      
      <div class="modal-header">


        <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="cerro()"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel"><span id="modalActionSale"> </span> Preventivo</h4> 
      </div>

      <div class="modal-body" id="modalBodySale">
      
        <div role="tabpanel" class="tab-pane">
            <div class="form-group">
              <div class="panel panel-default">
                <div class="panel-heading">
                  <h3 class="panel-title fa fa-cogs">  Datos del Equipo </h3>
                </div>
     
                    <div class="panel-body">

                        <div class="col-xs-4">Equipos <strong style="color: #dd4b39">*</strong>
                           <select  id="equipo" name="componente" class="form-control" value=""></select>
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
                              <h4 class="panel-title">Nueva Tarea </h4>
                            </div>

                            <div class="panel-body">  

                              <div class="col-xs-4">Tarea <strong style="color: #dd4b39">*</strong>:
                               <select id="tarea" name="tarea" class="form-control" value=""></select>
                               <input type="hidden" id="id_tarea" name="id_tarea">
                              </div>
                              <input type="hidden" id="id" name="id">

                              <div class="col-xs-4">Componente <strong style="color: #dd4b39">*</strong>:
                                <select id="componente" name="equipo" class="form-control input-md"   />
                                <input type="hidden" id="id_componente" name="id_componente" />
                              </div>
                              <div class="col-xs-4">Fecha:
                                <input type="date" id="ultimo"  name="ultimo" class="form-control " />
                              </div>

                                                 
                              <div class="col-xs-4">Periodo <strong style="color: #dd4b39">*</strong>:
                                
                                <select id="periodo"  name="periodo" class=" selectpicker form-control input-md">
                                      <option >Anual</option>
                                      <option >Diario</option>
                                      <option >Mensual</option>
                                      <option >Periodos</option>
                                      <option >Ciclos</option>
                                      <option >Semestral</option>
                                      
                                </select>
                              </div>

                              <div class="col-xs-4">Frecuencia <strong style="color: #dd4b39">*</strong>:
                                <input type="text"  id="cantidad" name="cantidad" class="form-control input-md" placeholder="Ingrese valor" />
                              </div>
                              
                              <br>
                              

                              <div class="col-xs-3">
                                
                              </div>                                      
                          </div>
                      </div>
                      <!--<br>-->
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
                             
                              <div class="col-xs-3">Codigo <strong style="color: #dd4b39">*</strong>:
                                  <select  id="herramienta"  name="herramienta" class="form-control input-md" value=""></select>
                                  <input type="hidden" id="id_herramienta" name="id_herramienta">
                              </div>
                              
                              <div class="col-xs-3">Marca:
                                  <input type="text" id="marcaherram"  name="marcaherram" class="form-control input-md" />
                              </div>

                              <div class="col-xs-3">Descripcion:
                                  <input type="text" id="descripcionherram"  name="descripcionherram" class="form-control input-md" />
                              </div>


                              <div class="col-xs-3">Cantidad <strong style="color: #dd4b39">*</strong>:
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
                                          <th>Descripcion</th>
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
                                  <select  id="insumo"  name="insumo" class="form-control input-md" value=""></select>
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




