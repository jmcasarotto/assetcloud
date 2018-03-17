<input type="hidden" id="permission" value="<?php echo $permission;?>">   
<div class="row">
  <div class="col-xs-12">
    <div class="alert alert-danger alert-dismissable" id="error" style="display: none">
          <h4><i class="icon fa fa-ban"></i> Error!</h4>
          Revise que todos los campos obligatorios esten seleccionados
      </div>
  </div>
</div>

<div class="row">
  <div class="col-xs-12">
    <div class="alert alert-success" id="error2" style="display: none">
          <h4></h4>
          EL EQUIPO POSEE COMPONENTES ASOCIADOS
      </div>
  </div>
</div>
<div class="row">
  <div class="col-xs-12">
    <div class="alert alert-success" id="error3" style="display: none">
          <h4></h4>
          EL EQUIPO NO POSEE COMPONENTES ASOCIADOS
      </div>
  </div>
</div>
<section class="content">
  <div class="row">
    <div class="col-xs-12">
      <div class="box">
        <div class="box-header">
          <h2 class="box-title ">Nota de Pedido</h2>
           <?php
          // if (strpos($permission,'Add') !== false) {
          //   echo '<button class="btn btn-block btn-success" style="width: 100px; margin-top: 10px;" id="listado">Ver Listado</button>';
          // }
          ?>
        </div><!-- /.box-header -->
        <div class="box-body">
                    
            <div class="row" >
              <div class="col-sm-12 col-md-12">
                <div role="tabpanel" class="tab-pane">
                    <div class="form-group">
                      <div class="panel panel-default">
                        <div class="panel-heading">
                          <h2 class="panel-title  fa fa-th-large" > Detalle del Pedido</h2>
                        </div>
       
                        <div class="panel-body">
                          <div class="tab-content">  
                            <div role="tabpanel" class="tab-pane active" id="choras">
                              
                              <div class="row" >
                                
                                <div class="col-xs-4"><label>Orden de Trabajo Nº</label> <strong style="color: #dd4b39">*</strong> : 
                                  <select id="id_ordTrabajo" name="" class="form-control select2" />
                                </div>
                                <div class="col-xs-8"><label>Detalle</label> <strong style="color: #dd4b39">*</strong> :  
                                  <input  id="detaorden" name="" class="form-control" placeholder="Detalle"/>
                                </div>
                                 
                              </div> <br>
                              <hr>

                              <div class="row" >
                                <div class="col-xs-4"><label>Código de Artículo</label> <strong style="color: #dd4b39">*</strong> :                                  
                                  <input type="hidden" id="id_articulo" name="">
                                  <input type="text" class="artOrdInsum form-control" id="artOrdInsum" value="" placeholder="Buscar...">
                                </div>  
                                <div class="col-xs-4"><label>Descripción de Artículo</label> <strong style="color: #dd4b39">*</strong> : 
                                  <input type="text" class="decripInsumo form-control" id="decripInsumo" value="" placeholder="Descripción">
                                  <input type="hidden" name="" class="id-artOrdIns form-control" id="id-artOrdIns" value="" disabled>
                                </div>
                                <div class="col-xs-4"><label>Proveedor</label> <strong style="color: #dd4b39">*</strong> :  
                                    <select  id="proveedor" name="" class="form-control" />
                                </div>
                                <br>  
                              </div> <br>

                              <div class="row" >
                                <div class="col-xs-4"><label>Cantidad</label> <strong style="color: #dd4b39">*</strong> :  
                                  <input  id="cantidad" name="" class="form-control" placeholder="Ingrese cantidad..."/>
                                </div>

                                <div class="col-xs-4"><label>Fecha de Entrega</label> <strong style="color: #dd4b39">*</strong> :  
                                  <input  type="date" id="fechaEnt" name="fechaEnt" class="form-control datepicker" placeholder="Selecciones fecha..."/>
                                </div><br>
                                
                                <div class="col-xs-4">
                                
                                  <button type="button" class="btn btn-success" id="addcompo" onclick="javascript:armarTabla()"><i class="fa fa-check"></i></button>
                                </div><br><br>


                                <!-- <div class="col-xs-8">
                                  <label>Observaciones:</label>
                                  <textarea class="form-control" id="descrip" name="descrip"></textarea>
                                </div> -->

                              </div><br><br>
                                
                              <!-- tabla-->
                                <div class="row" >
                                  <div class="col-sm-12 col-md-12">
                                    <form id = "form_order">
                                      <table class="table table-bordered tabModInsum" id="tabModInsum" border="1px">
                                        <thead>
                                           <tr>   
                                            <th width="2%"></th>                   
                                            <th>Ord. Trab.</th>
                                            <th>Artículos</th>
                                            <th>Cantidad</th>
                                            <th>Proveedor</th>
                                            <th>Fecha Entrega</th>                                            
                                          </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                      </table>
                                    </form>  
                                  </div>
                                </div>
                              <!-- / tabla--> 
                            </div>
               
                          </div>
                        </div>

                      </div>
                    </div>
                </div>
              </div>
            </div>

            <div class="modal-footer"> 

                <button type="button" class="botones btn btn-primary" onclick="javascript:enviarOrden()">Guardar</button>
            </div>  <!-- /.modal footer -->            
         
        </div><!-- /.box-body -->
      </div><!-- /.box -->
    </div><!-- /.col -->
  </div><!-- /.row -->
  <style>
    input.celda{border: none;}
  </style>
</section><!-- /.content -->


<script>

  $( "#fechaEnt" ).datepicker();
  
  // Trae Ordenes en curso
  $(function(){  

      $.ajax({
            type: 'POST',
            //data: { },
            url: 'index.php/Notapedido/getOrdenesCursos', 
            success: function(data){               
                    
                    var opcion  = "<option value='-1'>Seleccione una Orden...</option>" ; 
                    $('#id_ordTrabajo').append(opcion);                 
                    
                    for(var i=0; i < data.length ; i++){ 
                        //var nombre = data[i]['codigo'];
                        var opcion  = "<option value='"+data[i]['id_orden']+"'>" +data[i]['id_orden']+ "</option>" ; 
                        $('#id_ordTrabajo').append(opcion);                                   
                    }
                  },
            error: function(result){              
                  console.log(result);
                },
               dataType: 'json'
      });
  });

  // Trae descripcion segun orden de servicio
  $('#id_ordTrabajo').change(
       
    function(){   

          var id_orden = $("#id_ordTrabajo").val();
          $.ajax({
                'data' : {id_orden : id_orden },
                'async': true,
                'type': "POST",
                'global': false,
                'dataType': 'json',
                'url': "Notapedido/getDetalle",
                'success': function (data) {
                          $("#detaorden").val(data[0]['descripcion']);
                         
                },
                'error': function(data){
                  console.log("No hay componentes asociados en BD");
                }
          });          
    }
  ); 

  //Trae Articulos y autocompleta campo 
  $(function() {
      $(".artOrdInsum").autocomplete({
          source:function(request, response) {
                    $.ajax( {
                      url: "Notapedido/getArticulo",
                      dataType: "json",
                      success: function(data) {
                        response(data);
                      }
                    });
          },
          //delay: 100,
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
              $("#id_articulo").val(ui.item.value);
              $("#decripInsumo").val(ui.item.descripcion);                              
          },
          
      });
  });

  // Trae Proveedores y llena select
  $(function(){  

      $.ajax({
            type: 'POST',
            url: 'index.php/Notapedido/getProveedor', 
            success: function(data){               
                    
                    var opcion  = "<option value='-1'>Seleccione...</option>" ; 
                    $('#proveedor').append(opcion); 
                    for(var i=0; i < data.length ; i++){ 
                        //var nombre = data[i]['codigo'];
                        var opcion  = "<option value='"+data[i]['provid']+"'>" +data[i]['provnombre']+ "</option>" ; 
                        $('#proveedor').append(opcion);                                   
                    }
                  },
            error: function(result){              
                  console.log(result);
                },
               dataType: 'json'
      });
  });

  // Arma tabla dinamica
  var regInsum = 0;         // variable incrementable en func, para diferenciar los inputs
  function armarTabla(){   // inserta valores de inputs en la tabla   

    var $id_Orden = $("#id_ordTrabajo").val();
    var $desCripInsum = $("#decripInsumo").val();
    var $id_Insumo = $("#id_articulo").val();      
    var $cantOrdInsum = $("#cantidad").val();    
    var $proveedor = $("select#proveedor option:selected").html();
    var $id_proveedor = $("select#proveedor option:selected").val();      
    var $fecha = $("#fechaEnt").val();      
    
    $(".tabModInsum tbody").append(
                  '<tr>'+
                    '<td><i class="fa fa-ban elimrow" style="color: #f39c12; cursor: pointer; margin-left: 15px;"></i></td>'+

                     '<td class=""><input type="text" name="orden_Id'+ '['+ regInsum+']' +'" class="celda ord_Id" id="ord_Id" value=" '+ $id_Orden +' " placeholder=""></td>'+ 
                     
                     '<td class=""><input type="text" class="celda insum_Desc" id="insum_Desc" value=" '+ $desCripInsum +' " placeholder=""></td>'+

                     '<td class="hidden id_Insumo" id="id_Insumo"><input type="text" name="insum_Id'+ '['+ regInsum+']' +'" class="celda insum_Id" id="insum_Id" value=" '+ $id_Insumo +' " placeholder=""></td>'+
                     
                     '<td class="cant_insumos" id="cant_insumos"><input type="text" name="cant_insumos'+ '['+ regInsum+']' +'" class="celda cant_insumos" id="cant_insumos" value=" '+ $cantOrdInsum +' " placeholder=""></td>'+
                     
                     '<td class="nom_prov" id="nom_prov"><input type="text" class="celda nom_proveed" id="nom_proveed" value=" '+ $proveedor +' " placeholder=""></td>'+

                     '<td class="hidden id_prov" id="id_prov"><input type="text" name="proveedid'+ '['+ regInsum+']' +'" class="celda proveedid" id="proveedid" value=" '+ $id_proveedor +' " placeholder=""></td>'+

                     '<td class=" fecha" id="fecha"><input type="text" name="fechaentrega'+ '['+ regInsum+']' +'" class="celda fechaentrega" id="fechaentrega" value=" '+ $fecha +' " placeholder=""></td>'+

                  '<tr>');
    
    $("#cantidad").val("");
    $("#proveedor").val("-1");    
    $("#fechaEnt").val("");
    $("#artOrdInsum").val("");
    $("#decripInsumo").val("");
    
    regInsum++;
  }
   
  // Evento que selecciona la fila y la elimina 
  $(document).on("click",".elimrow",function(){
      var parent = $(this).closest('tr');
      $(parent).remove();
  });

  // Guarda Nota de Pedido
  function enviarOrden() {  

    
    /////  VALIDACIONES

    var hayError = false;
      
    // if ($('#numSolic').val() == '') {
    //         hayError = true;
    //     }

    // if(hayError == true){
    //    $('#error').fadeIn('slow');
    //    return;
    // }
    // else{
    //     $('#error').fadeOut('slow');
        //var id_equipo = $("#numSolic").val();
      
      var datos = $("#form_order").serializeArray();

      WaitingOpen('Guardando cambios');
      
      $.ajax({    
                  data: datos,
                  type: 'POST',             
                  dataType: 'json',
                  url: 'index.php/Notapedido/setNotaPedido',                
                  success: function(result){                                                    
                          WaitingClose("Guardado con Exito...");
                          setTimeout("cargarView('Notapedido', 'index', '"+$('#permission').val()+"');",0);
                  },
                  error: function(result){
                          WaitingClose();                                                    
                          alert("Error en guardado...");
                  },
      });
          
  }
</script>
<!-- / Validacion de campos y Envio form -->