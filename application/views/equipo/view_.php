<input type="hidden" id="permission" value="<?php echo $permission;?>">
<div class="row">
  <div class="col-xs-12">
    <div class="alert alert-danger alert-dismissable" id="error" style="display: none">
          <h4><i class="icon fa fa-ban"></i> Error!</h4>
          Revise que todos los campos obligatorios esten seleccionados
      </div>
  </div>
</div>
<section class="content">
  <div class="row">
    <div class="col-sm-12 col-md-12">
      <div class="box">
        <div class="box-header">
          <h3 class="box-title">Equipo/Sector</h3>
          <?php
            if (strpos($permission,'Add') !== false) {
            echo '<button class="btn btn-block btn-success" style="width: 100px; margin-top: 10px;" id="listado">Ver Listado</button>';
            }
          ?>
        </div><!-- /.box-header -->
        <div class="box-body">
          <div role="tabpanel" class="tab-pane">
            <div class="form-group">
              <div class="panel panel-default">
                <div class="panel-heading">
                  <h2 class="panel-title  fa fa-globe">   Ubicación del Equipo / Sector </h2>
                </div>
                <div class="panel-body" style="height: 250px;">
                  <!--   <form class="form-inline" role="form"> -->
                    <div class="col-sm-12 col-md-12" style="height: 240px;"> 
                      <div class="row">
                        <div class="col-xs-4"><label>Empresa<strong style="color: #dd4b39">*</strong>: </label>
                          <br>
                          <select  id="empresa" name="empresa" class="form-control" value="" style="width:70%" ></select>
                        </div>
                        <br>
                        <div class="col-xs-2">
                          <button type="button" class="btn btn-success" id="addempresa"  data-toggle="modal" data-target="#modalOrder"><i class="fa fa-plus"> Agregar</i></button>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-xs-4"><label>Unidad Industrial<strong style="color: #dd4b39">*</strong> :</label>
                          <br>
                          <select id="unin" name="unin" class="form-control" value="" style="width:70%"></select>
                        </div>
                        <br>
                        <div class="col-xs-2">
                          <button type="button" class="btn btn-success" id="addunidad"  data-toggle="modal" data-target="#modalunidad"><i class="fa fa-plus"> Agregar</i></button> 
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-xs-4"><label>Área:</label>
                          <br>
                          <select id="area" name="area" class="form-control" value="" style="width:70%" ></select>
                        </div>
                        <br>
                        <div class="col-xs-2">
                          <button type="button" class="btn btn-success" id="addarea"  data-toggle="modal" data-target="#modalarea"><i class="fa fa-plus"> Agregar</i></button> 
                        </div>
                      </div>
                    </div>
                      <!-- </form> -->
                      <!--   <form class="form-group" role="form"  > -->
                    <div class="col-sm-12 col-md-12" style="position:absolute;  right: -60px; width:560px;  float: left; height: 2400px; "> 
                      <div class="row">
                        <div class="col-xs-6"><label>Proceso:</label>
                          <select  id="proceso" name="proceso" class="form-control" value="" style="width:200px" ></select>
                        </div>
                        <br>
                        <div class="col-xs-2">
                          <button type="button" class="btn btn-success" id="addproceso"  data-toggle="modal" data-target="#modalproceso"><i class="fa fa-plus"> Agregar</i></button>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-xs-6"><label>Sector/Etapa<strong style="color: #dd4b39">*</strong>:</label>
                          <br>
                          <select id="etapa" name="etapa" class="form-control"  value="" style="width:200px"></select>
                        </div>
                        <br>
                        <div class="col-xs-2">
                          <button type="button" class="btn btn-success" id="addetapa"  data-toggle="modal" data-target="#modaletapa"><i class="fa fa-plus"> Agregar</i></button> 
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-xs-6"><label>Grupo:</label>
                          <br>
                          <select id="grupo" name="grupo" class="form-control" style="width:200px"></select>
                        </div>
                        <br>
                        <div class="col-xs-2">
                          <button type="button" class="btn btn-success" id="addgrupo"  data-toggle="modal" data-target="#modalgrupo"><i class="fa fa-plus"> Agregar</i></button> 
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-xs-6"><label>Criticidad:</label>
                          <br>
                          <select id="criticidad" name="criticidad" class="form-control" style="width:200px"></select>
                        </div>
                        <br>
                        <div class="col-xs-2">
                          <button type="button" class="btn btn-success" id="addcriti"  data-toggle="modal" data-target="#modalcrit"><i class="fa fa-plus"> Agregar</i></button> 
                        </div>
                        <br>
                        <br>
                      </div>
                    </div>
                    <br>
                    <br>
                    <!--         </form> -->
                </div><!--fin de body-->
                <div class="panel panel-default">
                  <div class="panel-heading">
                    <h3 class="panel-title fa fa-cogs">   Datos del Equipo/ Sector </h3>
                  </div>
       
                  <div class="panel-body">
              
                    <div class="col-xs-4"><label>Código</label> <strong style="color: #dd4b39">*</strong>:
                      <input type="text" id="codigo" name="codigo" class="form-control" placeholder="Ingrese Código de Equipo">
                      <input type="hidden" id="id_equipo" name="id_equipo">
                    </div>
                    <div class="col-xs-4"><label>Marca</label> <strong style="color: #dd4b39">*</strong>:
                      <!--   <input type="text" id="marca" name="marca" class="form-control" placeholder="Ingrese Marca"> -->
                      <select id="marca" name="marca" class="form-control" value="" ></select>   
                    </div>
                    <div class="col-xs-4"><label>Descripción</label> <strong style="color: #dd4b39">*</strong>:
                      <textarea class="form-control" id="descripcion" name="descripcion" placeholder="Ingrese breve Descripción (Tamaño Máx 255 caracteres) ..." cols="20" rows="3"></textarea>
                    </div>
                    <div class="col-xs-4"><label>Número de serie:</label>
                      <input type="text" id="numse"  name="numse" class="form-control input-md" placeholder="Ingrese Número de serie">
                    </div>
                    <div class="col-xs-4"><label>Ubicación</label><strong style="color: #dd4b39">*</strong>:
                      <input type="text" id="ubicacion" name="ubicacion" class="form-control" placeholder="Ingrese Ubicación">
                    </div>
                    
                    <div class="col-xs-4"><label>Fecha de Ingreso:</label>
                      <input type="date" id="fecha_ingreso"  name="fecha_ingreso" class="form-control input-md">
                    </div>
                    <div class="col-xs-4"><label>Fecha de Garantía:</label>
                      <input type="date" id="fecha_garantia"  name="fecha_garantia" class="form-control input-md">
                    </div>
                    
                    <div class="col-xs-4"><label>Fecha de Última lectura:</label>
                      <input type="date" id="fecha_ultimalectura"  name="fecha_ultima" class="form-control input-md">
                    </div>
                    
                    <div class="col-xs-4"><label>Última Lectura:</label>
                      <input type="text" id="ultima_lectura"  name="ultima_lectura" class="form-control input-md" placeholder="Ingrese Ultima Lectura">
                    </div>
                    <br>
                    <div class="col-xs-10">
                    </div>
                    <div class="col-xs-12"><label>Descripción Técnica:</label>
                      <textarea class="form-control" id="destec" name="destec" placeholder="Ingrese Descripción Técnica..."></textarea>
                      <br>
                    </div>
                    <br>
                    <br>
                    <div class="container">
                      <br>
                      <br>
                      <div id="exTab1" class="container"> 
                        <br>
                        <ul  class="nav nav-tabs">
                              <li>
                                <a  href="#1a" id="ag" data-toggle="tab" class="glyphicon glyphicon-plus" >Agregar Información</a>
                              </li>
                        </ul>
                        <div class="tab-content clearfix">
                          <div class="tab-pane" id="1a">
                            <br>
                            <div class="row">
                              <div class="col-xs-12 col-md-12 ">
                                <div class="col-xs-4">
                                  <br>
                                  <input type="text" id="tit" name="tit" class="form-control" placeholder="Ingrese Título ..." style="border:none">
                                  <br>
                                  <input type="text" id="info" name="info" class="form-control" placeholder="Ingrese Descripción ...">
                                </div>
                                <br>
                                <br>
                                <br>
                                <br>
                                <div class="col-xs-2">
                                  <button type="button" class="btn btn-success" id="agregar" ><i class="fa fa-plus"> Agregar</i></button> 
                                </div>
                                <br>
                                <br>
                                <table id="sales" class="table table-bordered table-hover" style="text-align: center; width: 80%">
                                  <thead>
                                    <tr>                
                                      <th width="3%" style="text-align: center"></th>
                                      <th  style="text-align: center">Título</th>
                                      <th style="text-align: center">Descripción</th>
                                    </tr>
                                  </thead>
                                  <tbody>
                                  </tbody>
                                </table>
                              </div>
                            </div> 
                          </div>        
                        </div>
                      </div>
                    </div>

                  </div> <!-- fin body style="font:16px Arial,Helvetica,sans-serif; "-->   
                </div>
                
                <button type="button" class="btn btn-default" data-dismiss="modal" onclick="limpiar()" >Cancelar</button>
                <button type="button" class="btn btn-primary btn-sm" data-dismiss="modal" onclick="guardar()" >Guardar</button>
                
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- Carga vista -->
<script>
var eq="";
  $(document).ready(function() {

    $('#1a').click(function (e) {

      $(".tab_content").hide();
      $("#ag").addClass("active");
        
    });

    $('#listado').click( function cargarVista(){
      WaitingOpen();
      $('#content').empty();
      $("#content").load("<?php echo base_url(); ?>index.php/Equipo/index/<?php echo $permission; ?>");
      WaitingClose();
    });

    $('#agregar').click(function (e){
      console.log("Estoy agregando ");
      var des= $('#info').val();
      var tit= $('#tit').val();
     
      console.log("La descripcion de la tarea es :");
      console.log(des);
      console.log(tit);
      var i=1;

      var tr = "<tr id='"+i+"'>"+
                "<td  style='text-align: center' ><i class='fa fa-ban elirow' style='color: #f39c12'; cursor: 'pointer' title='Eliminar Información'></i></td>"+
                "<td title='Título'>"+tit+"</td>"+
                "<td  title='Descripción'>"+des+"</td>"+
                               
              "</tr>";  
            i++;        
      console.log(tr); 
      $('#sales tbody').append(tr);
      $(document).on("click",".elirow",function(){
        var parent = $(this).closest('tr');
        $(parent).remove();
      });

      $('#tit').val('');
      $('#info').val('');
    });

    $('#clonar').click( function cargarVista(){

      $.ajax({
          type: 'POST',
          data: { },
          url: 'index.php/Equipo/traerco', //index.php/
          success: function(data){
                  //var data = jQuery.parseJSON( data );
                  
                  
                 console.log("Entre ");
                 console.log(data);
                 console.log(data[0]);

                 $.ajax({
                    type: 'POST',
                    data: { },
                    url: 'index.php/Equipo/traercodigo', //index.php/
                    success: function(data){
                            //var data = jQuery.parseJSON( data );
                            
                            
                           console.log("Entre al codigo");
                           console.log(data);
                           console.log(data[0]);
                      
                  },
                  error: function(result){
                        
                        console.log(result);
                      },
                      dataType: 'json'
                });

            
                },
          error: function(result){
                
                console.log(result);
              },
              dataType: 'json'
      });               
    });
   

  });

  // function guardar(){

  //      // alert("si guardo ");
     
  //       var codigo = $('#codigo').val();
  //       var ubicacion = $('#ubicacion').val();
  //       var marca= $('#marca').val();
  //       var descripcion = $('#descripcion').val();
  //       var fecha_ingreso = $('#fecha_ingreso').val();
  //       var fecha_ultimalectura = $('#fecha_ultimalectura').val();
  //       var ultima_lectura = $('#ultima_lectura').val();
  //       var fecha_garantia = $('#fecha_garantia').val();
  //       //var estado = $('#estado').val();
  //       var empresa = $('#empresa').val();
  //       var unidad = $('#unin').val();
  //       var criticidad = $('#criticidad').val();
  //       var area = $('#area').val();
  //       var proceso = $('#proceso').val();
  //       var detec= $('#destec').val(); //descripcion tecnica
  //       var num= $('#numse').val();
  //       var grupo=$('#grupo').val();
  //       var sector=$('#etapa').val();

  //       var parametros = {
           
  //           'descripcion': descripcion,
  //           'fecha_ingreso': fecha_ingreso,
  //           'fecha_garantia': fecha_garantia,
  //           'marca': marca,
  //           'codigo': codigo,
  //           'ubicacion': ubicacion,
  //           'id_empresa' : empresa,
  //           'id_sector' : sector,
  //           'id_grupo' : grupo,
  //           'id_criticidad' : criticidad,
  //           'estado' : 'AC',
  //           'fecha_ultimalectura': fecha_ultimalectura,
  //           'ultima_lectura': ultima_lectura,
  //           'descrip_tecnica': detec,
  //           'id_unidad': unidad,
  //           'id_area' : area,
  //           'id_proceso' : proceso,
  //           'numero_serie':num
            
     
  //       };

     
  //       var comp = new Object();
  //       var j=0;

  //       $("#sales tbody tr").each(function (index){
  //           var campo2, campo3;
             

  //             var id_her = $(this).attr('id'); 
  //             console.log(id_her);
              
              
  //           $(this).children("td").each(function (index2){
              
  //             if (index2) {
  //                   campo2 = $(this).text();
  //                   comp[j]=campo2;  
                          
                
  //                   campo3 = $(this).text();
  //                   comp[j]=campo3;  
  //                   j++;
                   
  //               }

  //           });
  //       });
        
        
  //       //    var hayError = false;
  //       //  console.log(parametros);
  //       // if(edit==0)
  //       // { 
  //       // if(codigo !=0 && empresa >0 && sector >0 && unidad >0)
  //       //    {
          
  //         console.log("estoy  guardando");
  //         console.log("Datos de equipo a guardar");
  //         console.log(parametros);
  //          console.log("informacion extra");
  //         console.log(comp);
  //         // console.log("codigo");
  //         // console.log(codigo);
  //         // console.log("marca");
  //         // console.log(marca);
  //         console.log(j);




  //         $.ajax({
  //             type: 'POST',
  //             data: {data:parametros, codigo:codigo, marca:marca, comp:comp, j:j},
  //             url: 'index.php/Equipo/guardar_equipo',  //index.php/
  //             success: function(data){

                  
  //                   regresa();
  //                   },
  //             error: function(result){
  //                   console.log ("entre por error");
  //                   console.log(result);
               
  //                 },
  //                dataType: 'json'
  //         });

  //         regresa();
      
  //      //  else {
  //      //    hayError=true;
  //      //    $('#error').fadeIn('slow');
  //      //   return;
  //      //  }
  //      //  if(hayError == false){
  //      //          $('#error').fadeOut('slow');
  //      //   }       
  // }
  

    function guardar(){

        alert("si guardo");
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
        var unidad = $('#unin').val();
        var criticidad = $('#criticidad').val();
        var area = $('#area').val();
        var proceso = $('#proceso').val();
        var detec= $('#destec').val(); //descripcion tecnica
        var num= $('#numse').val();
        var grupo=$('#grupo').val();
        var sector=$('#etapa').val();

        var parametros = {
           
            'descripcion': descripcion,
            'fecha_ingreso': fecha_ingreso,
            'fecha_garantia': fecha_garantia,
            'marca': marca,
            'codigo': codigo,
            'ubicacion': ubicacion,
            'id_empresa' : empresa,
            'id_sector' : sector,
            'id_grupo' : grupo,
            'id_criticidad' : criticidad,
            'estado' : 'AC',
            'fecha_ultimalectura': fecha_ultimalectura,
            'ultima_lectura': ultima_lectura,
            'descrip_tecnica': detec,
            'id_unidad': unidad,
            'id_area' : area,
            'id_proceso' : proceso,
            'numero_serie':num
            
        };

     
        var comp = new Array();  
        var i=0;
        var j=0;
        var item = new Array();  
        $("#sales tbody tr").each(function (index){

            $(this).children("td").each(function (index2){
              if (index2) {
                item.push(i); //arreglo de indices 
                i++; 
              } 
            });         
          
        }); 

        $("#sales tbody tr").each(function (index){
            var campo2, campo3;
            $(this).children("td").each(function (index2){
              
              if (index2) {
                  if(j<=item.length-1){
                    campo2 = $(this).text();
                    comp[j]=campo2;  
                          
                
                    campo3 = $(this).text();
                    comp[j]=campo3;  
                    // j++;
                    j++;
                  }     
              }
            });
        });
        
        
        //    var hayError = false;
        //  console.log(parametros);
        // if(edit==0)
        // { 
        // if(codigo !=0 && empresa >0 && sector >0 && unidad >0)
        //    {
          
          console.log("estoy  guardando");
          console.log("Datos de equipo a guardar");
          console.log(parametros);
          console.log("informacion extra");
          console.log(comp);
          // console.log("codigo");
          // console.log(codigo);
          // console.log("marca");
          // console.log(marca);
          console.log(j);
          $.ajax({
              type: 'POST',
              data: {data:parametros, codigo:codigo, marca:marca, comp:comp, j:j},
              url: 'index.php/Equipo/guardar_equipo',  //index.php/
              success: function(data){

                  
                    regresa();
                    },
              error: function(result){
                    console.log ("entre por error");
                    console.log(result);
               
                  },
                 dataType: 'json'
          });
          //regresa();
      
       //  else {
       //    hayError=true;
       //    $('#error').fadeIn('slow');
       //   return;
       //  }
       //  if(hayError == false){
       //          $('#error').fadeOut('slow');
       //   }       
  }

  function regresa(){
   // $('#listado').click( function cargarVista(){
   // WaitingOpen();
  $('#content').empty();
  $("#content").load("<?php echo base_url(); ?>index.php/Equipo/index/<?php echo $permission; ?>");
  WaitingClose();
   // });
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
  
  traer_area();
  function traer_area(){
      $.ajax({
        type: 'POST',
        data: { },
        url: 'index.php/Equipo/getarea', //index.php/
        success: function(data){
          console.log("estoy en area");
          console.log(data);
               
                 var opcion  = "<option value='-1'>Seleccione...</option>" ; 
                  $('#area').append(opcion); 
                for(var i=0; i < data.length ; i++) 
                {    
                      var nombre = data[i]['descripcion'];
                      var opcion  = "<option value='"+data[i]['id_area']+"'>" +nombre+ "</option>" ; 

                    $('#area').append(opcion); 
                                   
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
          console.log("estoy en area");
          console.log(data);
               
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
  
  traer_unidad();
  function traer_unidad(){
    
      $.ajax({
        type: 'POST',
        data: { },
        url: 'index.php/Equipo/getunidad', //index.php/
        success: function(data){
               
                 var opcion  = "<option value='-1'>Seleccione...</option>" ; 
                  $('#unin').append(opcion); 
                for(var i=0; i < data.length ; i++) 
                {    
                      var nombre = data[i]['descripcion'];
                      var opcion  = "<option value='"+data[i]['id_unidad']+"'>" +nombre+ "</option>" ; 

                    $('#unin').append(opcion); 
                                   
                }
              },
        error: function(result){
              
              console.log(result);
            },
            dataType: 'json'
      });
  }

  traer_proceso();
  function traer_proceso(){
      $.ajax({
        type: 'POST',
        data: { },
        url: 'index.php/Equipo/getproceso', //index.php/
        success: function(data){
               
                 var opcion  = "<option value='-1'>Seleccione...</option>" ; 
                  $('#proceso').append(opcion); 
                for(var i=0; i < data.length ; i++) 
                {    
                      var nombre = data[i]['descripcion'];
                      var opcion  = "<option value='"+data[i]['id_proceso']+"'>" +nombre+ "</option>" ; 

                    $('#proceso').append(opcion); 
                                   
                }
                
              },
        error: function(result){
              
              console.log(result);
            },
            dataType: 'json'
        });
  }

  traer_etapa();
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

  traer_marca();
  function traer_marca(){
      $.ajax({
        type: 'POST',
        data: { },
        url: 'index.php/Equipo/getmarca', //index.php/
        success: function(data){
               
                 var opcion  = "<option value='-1'>Seleccione...</option>" ; 
                  $('#marca').append(opcion); 
                for(var i=0; i < data.length ; i++) 
                {    
                    var nombre = data[i]['marcadescrip'];
                    var opcion  = "<option value='"+data[i]['id_empresa']+"'>" +nombre+ "</option>" ; 
                    $('#marca').append(opcion); 
                                   
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
    
  function click_co(){

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

  function limpiar(){
      $("#equipo").val("");
      $("#codigo").val("");
      $("#ubicacion").val("");
      $("#marca").val("");
      $("#fecha_ingreso").val("");
      $("#descripcion").val("");
      $("#fecha_ultimalectura").val("");
      $("#ultima_lectura").val("");
      $("#fecha_garantia").val("");
      $("#empresa").val("");
      $("#sector").val("");
      $("#criticidad").val("");
      $("#grupo").val("");
  }
function guardaremp(){ 
 
    var descripcion= $('#nombre').val(); 
    var parametros = {
        'descripcion': descripcion
        
    };                                              
    console.log(parametros);
    var hayError = false; 
    if( parametros !=0)
      {                                     
      $.ajax({
        type:"POST",
        url: "index.php/Equipo/agregar_empresa", //controlador /metodo
        data:{parametros:parametros},
        success: function(data){
          console.log("exito");
          var datos= parseInt(data);
          console.log(datos);
            //alert(data);
            if(data > 0) //Agrego la descripcion dinamicamte en el select con id componente
            {  
              
                var texto = '<option value="'+data+'">'+ parametros.descripcion +'</option>';
                console.log(texto);

                $('#empresa').append(texto);
            }
             

          },
        
        error: function(result){
            console.log("entro por el error");
            console.log(result);
        },
         dataType: 'json'
      });
     
    }
    else 
    { 
      alert("Por favor complete el nombre de la empresa, es un campo obligatorio");

    }

}
//etapay sector 
 traer_etapa();
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


function guardarunidad(){ 

     
  var descripcion= $('#nombreunidad').val(); 
  var datos = {
    'descripcion': descripcion
        
    };                                              
    console.log(datos);
    var hayError = false; 

    if( datos !=0)
      {                                     
      $.ajax({
        type:"POST",
        url: "index.php/Equipo/agregar_unidad", //controlador /metodo
        data:{datos:datos},
        success: function(data){
          console.log("exito");
          var dat= parseInt(data);
          console.log(dat);
            //alert(data);
            if(dat > 0) //Agrego la descripcion dinamicamte en el select con id componente
            {  
              
                var texto = '<option value="'+dat+'">'+ datos.descripcion +'</option>';
                console.log(texto);

                $('#unin').append(texto);
            }
             

          },
        
        error: function(result){
            console.log("entro por el error");
            console.log(result);
        },
         dataType: 'json'
      });
     
    }
    else 
    { 
      alert("Por favor complete el nombre del sector, es un campo obligatorio");

    }

}


function guardarcri(){ 

     
    var descripcion= $('#de').val(); 
    var parametros = {
        'descripcion': descripcion
        
    };                                              
    console.log(parametros);
    var hayError = false; 

    if( parametros !=0)
      {                                     
      $.ajax({
        type:"POST",
        url: "index.php/Equipo/agregar_criti", //controlador /metodo
        data:{parametros:parametros},
        success: function(data){
          console.log("exito");
          var datos= parseInt(data);
          console.log(datos);
            //alert(data);
            if(data > 0) //Agrego la descripcion dinamicamte en el select con id componente
            {  
              
                var texto = '<option value="'+data+'">'+ parametros.descripcion +'</option>';
                console.log(texto);

                $('#criticidad').append(texto);
            }
             

          },
        
        error: function(result){
            console.log("entro por el error");
            console.log(result);
        },
         dataType: 'json'
      });
     
    }
    else 
    { 
      alert("Por favor complete criticidad, es un campo obligatorio");

    }

}

function guardararea(){ 

     
    var descripcion= $('#nomarea').val(); 
    var parametros = {
        'descripcion': descripcion
        
    };                                              
    console.log(parametros);
    var hayError = false; 

    if( parametros !=0)
      {                                     
      $.ajax({
        type:"POST",
        url: "index.php/Equipo/agregar_area", //controlador /metodo
        data:{parametros:parametros},
        success: function(data){
          console.log("exito");
          var datos= parseInt(data);
          console.log(datos);
            //alert(data);
            if(data > 0) //Agrego la descripcion dinamicamte en el select con id componente
            {  
              
                var texto = '<option value="'+data+'">'+ parametros.descripcion +'</option>';
                console.log(texto);

                $('#area').append(texto);
            }
             

          },
        
        error: function(result){
            console.log("entro por el error");
            console.log(result);
        },
         dataType: 'json'
      });
     
    }
    else 
    { 
      alert("Por favor complete la descripcion del grupo, es un campo obligatorio");

    }

}
function guardargrupo(){ 

     
    var descripcion= $('#nomgrupo').val(); 
    var parametros = {
        'descripcion': descripcion
        
    };                                              
    console.log(parametros);
    var hayError = false; 

    if( parametros !=0)
      {                                     
      $.ajax({
        type:"POST",
        url: "index.php/Equipo/agregar_grupo", //controlador /metodo
        data:{parametros:parametros},
        success: function(data){
          console.log("exito");
          var datos= parseInt(data);
          console.log(datos);
            //alert(data);
            if(data > 0) //Agrego la descripcion dinamicamte en el select con id componente
            {  
              
                var texto = '<option value="'+data+'">'+ parametros.descripcion +'</option>';
                console.log(texto);

                $('#grupo').append(texto);
            }
             

          },
        
        error: function(result){
            console.log("entro por el error");
            console.log(result);
        },
         dataType: 'json'
      });
     
    }
    else 
    { 
      alert("Por favor complete la descripcion del grupo, es un campo obligatorio");

    }

}

function guardarproceso(){ 

     
    var descripcion= $('#nomproceso').val(); 
    var parametros = {
        'descripcion': descripcion
        
    };                                              
    console.log(parametros);
    var hayError = false; 

    if( parametros !=0)
      {                                     
      $.ajax({
        type:"POST",
        url: "index.php/Equipo/agregar_proceso", //controlador /metodo
        data:{parametros:parametros},
        success: function(data){
          console.log("exito");
          var datos= parseInt(data);
          console.log(datos);
            //alert(data);
            if(data > 0) //Agrego la descripcion dinamicamte en el select con id componente
            {  
              
                var texto = '<option value="'+data+'">'+ parametros.descripcion +'</option>';
                console.log(texto);

                $('#proceso').append(texto);
            }
             

          },
        
        error: function(result){
            console.log("entro por el error");
            console.log(result);
        },
         dataType: 'json'
      });
     
    }
    else 
    { 
      alert("Por favor complete la descripcion del grupo, es un campo obligatorio");

    }

}

function guardaretapa(){ 

     
    var descripcion= $('#nometapa').val(); 
    var parametros = {
        'descripcion': descripcion
        
    };                                              
    console.log(parametros);
    var hayError = false; 

    if( parametros !=0)
      {                                     
      $.ajax({
        type:"POST",
        url: "index.php/Equipo/agregar_etapa", //controlador /metodo
        data:{parametros:parametros},
        success: function(data){
          console.log("exito");
          var datos= parseInt(data);
          console.log(datos);
            //alert(data);
            if(data > 0) //Agrego la descripcion dinamicamte en el select con id componente
            {  
              
                var texto = '<option value="'+data+'">'+ parametros.descripcion +'</option>';
                console.log(texto);

                $('#etapa').append(texto);
            }
             

          },
        
        error: function(result){
            console.log("entro por el error");
            console.log(result);
        },
         dataType: 'json'
      });
     
    }
    else 
    { 
      alert("Por favor complete la descripcion del grupo, es un campo obligatorio");

    }

}

/*function cargarVista(){
    //WaitingOpen();

    $('#modalSale').empty();
    $('#content').empty();
    $("#content").load("<?php //echo base_url(); ?>index.php/Equipo/index/<?php //echo $permission; ?>");
    WaitingClose();
  }*/


</script>

<!-- Modal empresa -->
 <div class="modal fade" id="modalOrder" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-lg" role="document" style="width: 40%">
    <div class="modal-content">

      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel"><span id="modalAction" class="fa fa-plus-square" style="color: #A4A4A4"  ></span>  Agregar Empresa </h4>
       </div> <!-- /.modal-header  -->

      <div class="modal-body input-group ui-widget" id="modalBodyArticle">
        
        <div class="row" >
          <div class="col-sm-12 col-md-12">
                               
            <div class="col-xs-12"><h4>Nombre de la empresa <strong style="color: #dd4b39">*</strong>: </h4>
              <input type="text"  id="nombre"  name="nombre" placeholder="Ingrese Nombre o Descripción" class="form-control input-md" size="30"/>
            </div>
                    
                    
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary btn-sm" data-dismiss="modal" onclick="guardaremp()" >Guardar</button>
      </div>  <!-- /.modal footer -->
    </div>  <!-- /.modal-body -->
  </div> <!-- /.modal-content -->
</div>  <!-- /.modal-dialog modal-lg -->
</div>  <!-- /.modal fade -->
<!-- / Modal -->

<!-- Modal Unidad indus.-->
 <div class="modal fade" id="modalunidad" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-lg" role="document" style="width: 40%">
    <div class="modal-content">

      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title"  id="myModalLabel"><span id="modalAction" class="fa fa-plus-square" style="color: #A4A4A4"  ></span>     Agregar Unidad Industrial </h4>
       </div> <!-- /.modal-header  -->

      <div class="modal-body input-group ui-widget" id="modalBodyArticle">
        
        <div class="row" >
          <div class="col-sm-12 col-md-12">
                               
            <div class="col-xs-12"><h4>Nombre de la unidad industrial <strong style="color: #dd4b39">*</strong>: </h4>
              <input type="text"  id="nombreunidad"  name="nombreunidad" placeholder="Ingrese Nombre o Descripción" class="form-control input-md" size="30"/>
            </div>
                    
                    
          </div>
        </div>
      </div>
       
     

      <div class="modal-footer">
       
        <button type="button" class="btn btn-primary btn-sm" data-dismiss="modal" onclick="guardarunidad()" >Guardar</button>
      </div>  <!-- /.modal footer -->

       </div>  <!-- /.modal-body -->
    </div> <!-- /.modal-content -->

  </div>  <!-- /.modal-dialog modal-lg -->
</div>  <!-- /.modal fade -->
<!-- / Modal -->


<!-- Modal criticidad-->
 <div class="modal fade" id="modalcrit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-lg" role="document" style="width: 40%">
    <div class="modal-content">

      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title"  id="myModalLabel"><span id="modalAction" class="fa fa-plus-square" style="color: #A4A4A4"  ></span> Agregar Sector </h4>
       </div> <!-- /.modal-header  -->

      <div class="modal-body input-group ui-widget" id="modalBodyArticle">
        
        <div class="row" >
          <div class="col-sm-12 col-md-12">
                               
            <div class="col-xs-12"><h4>Criticidad <strong style="color: #dd4b39">*</strong>: </h4>
              <input type="text"  id="de"  name="de" placeholder="Ingrese criticidad" class="form-control input-md" size="30"/>
            </div>
                    
                    
          </div>
        </div>
      </div>
       
     

      <div class="modal-footer">
       
        <button type="button" class="btn btn-primary btn-sm" data-dismiss="modal" onclick="guardarcri()" >Guardar</button>
      </div>  <!-- /.modal footer -->

       </div>  <!-- /.modal-body -->
    </div> <!-- /.modal-content -->

  </div>  <!-- /.modal-dialog modal-lg -->
</div>  <!-- /.modal fade -->
<!-- / Modal -->

<!-- Modal area-->
 <div class="modal fade" id="modalarea" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-lg" role="document" style="width: 40%">
    <div class="modal-content">

      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title"  id="myModalLabel"><span id="modalAction" class="fa fa-plus-square" style="color: #A4A4A4"  ></span>    Agregar Área </h4>
       </div> <!-- /.modal-header  -->

      <div class="modal-body input-group ui-widget" id="modalBodyArticle">
        
        <div class="row" >
          <div class="col-sm-12 col-md-12">
                               
            <div class="col-xs-12"><h4>Nombre de Área: <strong style="color: #dd4b39">*</strong>: </h4>
              <input type="text"  id="nomarea"  name="nomarea" placeholder="Ingrese Nombre o Descripción" class="form-control input-md" size="30"/>
            </div>
                    
                    
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary btn-sm" data-dismiss="modal" onclick="guardararea()" >Guardar</button>
      </div>  <!-- /.modal footer -->
    </div>  <!-- /.modal-body -->
  </div> <!-- /.modal-content -->
</div>  <!-- /.modal-dialog modal-lg -->
</div>  <!-- /.modal fade -->
<!-- / Modal -->

<!-- Modal Proceso-->
 <div class="modal fade" id="modalproceso" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-lg" role="document" style="width: 40%">
    <div class="modal-content">

      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title"  id="myModalLabel"><span id="modalAction" class="fa fa-plus-square" style="color: #A4A4A4"  ></span>   Agregar Proceso </h4>
       </div> <!-- /.modal-header  -->

      <div class="modal-body input-group ui-widget" id="modalBodyArticle">
        
        <div class="row" >
          <div class="col-sm-12 col-md-12">
                               
            <div class="col-xs-12"><h4>Nombre de Proceso: <strong style="color: #dd4b39">*</strong>: </h4>
              <input type="text"  id="nomproceso"  name="nomproceso" placeholder="Ingrese Nombre o Descripción" class="form-control input-md" size="30"/>
            </div>
                    
                    
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary btn-sm" data-dismiss="modal" onclick="guardarproceso()" >Guardar</button>
      </div>  <!-- /.modal footer -->
    </div>  <!-- /.modal-body -->
  </div> <!-- /.modal-content -->
</div>  <!-- /.modal-dialog modal-lg -->
</div>  <!-- /.modal fade -->
<!-- / Modal -->

<!-- Modal Etapa-->
 <div class="modal fade" id="modaletapa" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-lg" role="document" style="width: 40%">
    <div class="modal-content">

      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title"  id="myModalLabel"><span id="modalAction" class="fa fa-plus-square" style="color: #A4A4A4"  ></span>   Agregar Sector/Etapa de Proceso </h4>
       </div> <!-- /.modal-header  -->

      <div class="modal-body input-group ui-widget" id="modalBodyArticle">
        
        <div class="row" >
          <div class="col-sm-12 col-md-12">
                               
            <div class="col-xs-12"><h4>Nombre de Sector/Etapa de Proceso: <strong style="color: #dd4b39">*</strong>: </h4>
              <input type="text"  id="nometapa"  name="nometapa" placeholder="Ingrese Nombre o Descripcion" class="form-control input-md" size="30"/>
            </div>
                    
                    
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary btn-sm" data-dismiss="modal" onclick="guardaretapa()" >Guardar</button>
      </div>  <!-- /.modal footer -->
    </div>  <!-- /.modal-body -->
  </div> <!-- /.modal-content -->
</div>  <!-- /.modal-dialog modal-lg -->
</div>  <!-- /.modal fade -->
<!-- / Modal -->

<!-- Modal Grupo-->
 <div class="modal fade" id="modalgrupo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-lg" role="document" style="width: 40%">
    <div class="modal-content">

      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title"  id="myModalLabel"><span id="modalAction" class="fa fa-plus-square" style="color: #A4A4A4"  ></span>   Agregar Grupo </h4>
       </div> <!-- /.modal-header  -->

      <div class="modal-body input-group ui-widget" id="modalBodyArticle">
        
        <div class="row" >
          <div class="col-sm-12 col-md-12">
                               
            <div class="col-xs-12"><h4>Nombre de Grupo: <strong style="color: #dd4b39">*</strong>: </h4>
              <input type="text"  id="nomgrupo"  name="nomgrupo" placeholder="Ingrese Nombre o Descripción" class="form-control input-md" size="30"/>
            </div>
                    
                    
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary btn-sm" data-dismiss="modal" onclick="guardargrupo()" >Guardar</button>
      </div>  <!-- /.modal footer -->
    </div>  <!-- /.modal-body -->
  </div> <!-- /.modal-content -->
</div>  <!-- /.modal-dialog modal-lg -->
</div>  <!-- /.modal fade -->
<!-- / Modal -->

  