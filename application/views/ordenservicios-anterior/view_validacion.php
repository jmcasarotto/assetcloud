 <input type="hidden" id="permission" value="<?php echo $permission;?>">
<div class="row">
  <div class="col-xs-12">
    <div class="alert alert-danger alert-dismissable" id="error3" style="display: none">
          <h4><i class="icon fa fa-ban"></i> Error!</h4>
          Revise que todos los campos obligatorios esten seleccionados
      </div>
  </div>
</div>
 <div class="row">
  <div class="col-xs-12">
    <div class="alert alert-danger alert-dismissable" id="error" style="display: none">
          <h4><i class="icon fa fa-ban"></i> Error!</h4>
          Este articulo no esta en el deposito seleccionado
      </div>
  </div>
</div>
<div class="row">
  <div class="col-xs-12">
    <div class="alert alert-danger alert-dismissable"  id="error1" style="display: none">
          <h4><i class="icon fa fa-ban"></i> Error!</h4>
          NO HAY INSUMOS SUFICIENTES
      </div>
  </div>
</div>
<div class="row">
  <div class="col-xs-12">
    <div class="alert alert-success" id="error2" style="display: none">
          <h4></h4>
          HAY INSUMOS SUFICIENTES
      </div>
  </div>
</div>
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
        <h3 class="box-title">Orden de Servicio</h3>
        <?php
          // if (strpos($permission,'Add') !== false) {
          //   echo '<button class="btn btn-block btn-success" style="width: 100px; margin-top: 10px;" id="listado">Ver Listado</button>';
          //}
          ?>
        </div><!-- /.box-header -->


        <div class="box-body">
          <!-- form  -->
          <form class="form-horizontal" role="form" id="form_order" action="" accept-charset="utf-8">

            <!-- fecha y comprobante -->
            <div class="pull-right "> 
              <div class="form-group">
                <label for="comprobante" class="col-sm-6 control-label">Comprobante</label>
                <div class="col-sm-6">
                  <input type="text" name="comprobante" class="form-control comprobante" id="comprobante">
                </div>
              </div>
              <div class="form-group">
                <label for="fecha" class="col-sm-6 control-label">Fecha</label>
                <div class="col-sm-6">
                  <input type="text" name="fecha" class="form-control fecha" id="fechaOrden">
                </div>
              </div>
            </div>  
            <div class="clearfix"></div>
            <!-- / fecha y comprobante -->

            <style>
                p.titulos{
                  margin-left: 2%;
                  margin-bottom: -1% !important;
                  margin-top: 3%;
                }
                .icotitulo{margin-right: 5px;}
                .panel,.panel-default{padding-bottom: 17px;}
                .botones{margin-left: 27px;}
                #rowdetalle{margin-left: 26px;}
                .hidenn{display: none;}
                input.form_equipos, input.cant_insumos, input.nom_depo {border: none; padding-left: 15px;}
                select#numSolic, input#causa{width: 80%;}
                input#contratista{width: 100%;} 
            </style>

            <div class="row">
              <table class="table table-condensed table-responsive" id="tabequip">
                      <thead>
                        <tr>
                          <th width="2%"></th>                          
                          <th>Número de Solicitud</th>
                          <th>Descripción de la Falla</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td><label ></label></td> 
                          <td><input class="numSolic form_equipos" name ="numSolic" id="numSolic" value="<?php echo $id_solicitud;?>"> </input></td>
                          <td><input type="text" name="causa" class="causa form_equipos" id="causa" value="" placeholder=""></td>
                          <td class="hidenn"><input type="text" name="id_solicitudreparacion" class="id_solicitudreparacion " id="id_solicitudreparacion" value="<?php echo $id_solicitud;?>"></td>
                          <td class="hidenn"><input type="text" name="id_equipoSolic" class="id_equipoSolic" id="id_equipoSolic"></td>

                        </tr>
                      </tbody>
              </table>
            </div>

            <!--  EQUIPOS   -->            
            <div class="panel panel-default">

                <div class="panel-heading"><span class="fa fa-cogs icotitulo" aria-hidden="true"></span> Equipos</div>
                    <p class="titulos">Datos de Equipo</p>
                    <hr>                  

                    <table class="table table-condensed table-responsive" id="tabequip">
                      <thead>
                        <tr>
                          <th width="2%"></th>                          
                          <th>Nombre Equipo</th>
                          <th>Descripción</th> 
                          <th>Estado</th>                                                   
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td><label ></label></td>    
                          <!-- codigo en BD es el nombre del equipo -->                       
                          <td><input type="text" name="nomEquipo" class="nomEquipo form_equipos" id="nomEquipo" value="" placeholder=""></td>
                          <td><input type="text" name="descEquipo" class="descEquipo form_equipos" id="descEquipo" value="" placeholder=""></td>
                          <td><input type="text" name="estado" class="estado form_equipos" id="estado" value="" placeholder=""></td>
                          <td class="hidden"><input type="text" name="id_equipo" class="id_equipo" id="id_equipo" value="" placeholder=""></td>
                        </tr>
                      </tbody>

                      <thead>
                        <tr>
                          <th width="2%"></th>                          
                          <th>Sector</th>
                          <th>Grupo</th>
                          <th>Ubicación</th>
                        </tr>
                      </thead>                      
                      <tbody>
                        <tr>
                          <td><label ></label></td>                          
                          <td><input type="text" name="sector" class="sector form_equipos" id="sector" value="" placeholder=""></td>
                          <td><input type="text" name="grupo" class="grupo form_equipos" id="grupo" value="" placeholder=""></td>                     
                          <td><input type="text" name="ubicacion" class="ubicacion form_equipos" id="ubicacion" value="" placeholder=""></td>
                        </tr>
                      </tbody>

                      <thead>
                        <tr>
                          <th width="2%"></th>
                          <th>Fecha Ingreso</th>
                          <th>Fecha Baja</th>
                          <th>Fecha Garantía</th>
                        </tr>
                      </thead>

                      <tbody>
                        <tr>
                          <td><label ></label></td>
                          <td><input type="date" name="fecha_ingreso" class="fecha_ingreso form_equipos" id="fecha_ingreso" value="" placeholder=""></td>
                          <td><input type="date" name="fecha_baja" class="fecha_baja form_equipos" id="fecha_baja" value="" placeholder=""></td>
                          <td><input type="date" name="fecha_garantia" class="fecha_garantia form_equipos" id="fecha_garantia" value="" placeholder=""></td>
                        </tr>
                      </tbody> 

                      <thead>
                        <tr>
                          <th width="2%"></th>
                          <th>Contratista</th>
                          <th></th>
                        </tr>
                      </thead>

                      <tbody>
                        <tr>
                          <td><label ></label></td>
                          <td><select name="contratista" class="contratista" id="contratista">
                                <option value=""></option>
                          </select></td>
                          <td class="hidden"><input type="text" name="id_contratista" class="id_contratista" id="id_contratista" value="" placeholder="" disabled></td>
                        </tr>
                      </tbody> 

                    </table>                
            </div><!--  / <div class="panel panel-default"> -->   


            <!-- TABS -->

            <!-- Nav tabs -->
            <ul class="nav nav-tabs nav-justified" role="tablist">
              <li role="presentation" class="active"><a href="#tar" aria-controls="tar" role="tab" data-toggle="tab">Tareas</a></li>
              <li role="presentation"><a href="#herramientas" aria-controls="herramientas" role="tab" data-toggle="tab">Herramientas</a></li>
              <li role="presentation"><a href="#insumos" aria-controls="insumos" role="tab" data-toggle="tab">Insumo</a></li>
              <li role="presentation"><a href="#rrhh" aria-controls="rrhh" role="tab" data-toggle="tab">Recursos Humanos</a></li>       
            </ul>

            <!-- Tab panes -->
            <div class="tab-content">
              <div role="tabpanel" class="tab-pane active" id="tar">
                <!--  TAREAS REALIZADAS   -->
                      <div class="panel panel-default">
                          <div class="panel-heading"><span class="fa fa-file-text-o icotitulo" aria-hidden="true"></span>Tareas a Realizar</div>
                          <p class="titulos">Detalle de tareas</p>
                          <hr>                        
                          <br />

                          <table class="table table-condensed table-responsive tbl_tareas">
                              <thead>
                                <tr>
                                  <th width="2%"></th>
                                  <th>Tarea</th>
                                  <th>Componente</th>
                                  <th>Horas</th>
                                  <th>Costo</th>                                 
                                </tr>
                              </thead>
                              <tbody>
                                <tr>
                                  <td><label ></label></td>
                                  <td>
                                      <select name="tareas" class="tareas" id="tareas">
                                      <option value=""></option>
                                      </select>
                                  </td>                  
                                  <td>
                                      <select name="componentes" class="componentes" id="componentes">
                                        <option value=""></option>
                                      </select>
                                  </td>                    
                                  <td><input type="text" class="horas" id="horas" value="" placeholder=""></td>
                                  <td><input type="text" class="costo" id="costo" value="" placeholder=""></td>
                                   <td class="hidden"><input type="text" name="id-comp" class="id-comp" id="id-comp" value="" placeholder="" disabled></td>
                                </tr>
                              </tbody>
                          </table> 

                            <button type="button" class="botones btn btn-success btn-sm" onclick="javascript:armarTablaTareas()">Agregar</button>
                            <br/><br/>

                          <div class="form-group">
                            <table class="table table-condensed table-responsive tablalistareas" id="tablalistareas">
                              <thead>
                                <tr>
                                  <th width="2%"></th>
                                  <th>Tareas</th>
                                  <th>Componentes</th>
                                  <th>Horas</th>
                                  <th>Costo</th>
                                </tr>
                              </thead>

                              <tbody> </tbody>
                            
                            </table>
                          </div>  
                          <!-- btn ver detalle   -->
                          <!-- <button type="button" class="botones btn btn-success btn-sm" data-toggle="modal" data-target="#detalleTareas" >Detalle de Tareas</button> -->
                          <br/><br/>
                      </div><!--  / <div class="panel panel-default"> -->
              </div>

              <div role="tabpanel" class="tab-pane" id="herramientas">
                <!--  ORDEN DE HERRAMIENTAS   -->
                      <div class="panel panel-default">
                          <div class="panel-heading"><span class="fa fa-file-text-o icotitulo" aria-hidden="true"></span>Orden de Herramientas</div>
                          <p class="titulos">Detalle</p>
                          <hr>                        
                          <br />
                           <table class="table table-condensed table-responsive tablaherram">
                            <thead>
                              <tr>
                                <th width="2%"></th>
                                <th>Herramienta</th>
                                <th>Marca</th>
                                <th>Código</th>
                              </tr>
                            </thead>
                            <tbody>
                              <tr>
                                <td><label ></label></td>                      
                                <td><input type="text" class="herramienta" id="herramienta" value="" placeholder="Buscar..."></td>                      
                                <td><input type="text" class="marcaherram" id="marcaherram" value="" placeholder=""></td>
                                <td><input type="text" class="codherram" id="codherram" value="" placeholder=""></td>
                                <td class="hidden"><input type="text" name="herrId" class="herrId" id="herrId" value="" placeholder="" disabled></td>
                              </tr>
                            </tbody>
                          </table>

                          <button type="button" class="botones btn btn-success btn-sm" onclick="javascript:armartablistherr()">Agregar</button>
                          <br/><br/>

                          <table class="table table-condensed table-responsive tablalistherram" id="tablalistherram">
                            <thead>
                              <tr>
                                <th width="2%"></th>
                                <th>Herramienta</th>
                                <th>Marca</th>
                                <th>Código</th>
                              </tr>
                            </thead>
                            <tbody>
                              
                            </tbody>
                          </table><br /><br />
                      </div>
              </div>
             
              <div role="tabpanel" class="tab-pane" id="insumos">
                <!--  ORDEN DE INSUMOS   -->
                <div class="panel panel-default">
                    <div class="panel-heading"><span class="fa fa-file-text-o icotitulo" aria-hidden="true"></span>Orden de Insumo</div>
                    <p class="titulos">Detalle</p>
                    <hr> 
                     <!--    GUARDAR ESTOS CAMPOS POR DEFECTO 
                          orden id de orden de insumos
                          fecha la de arriba
                          solicitante el usr logueado
                      -->
                    <table class="table table-condensed table-responsive tabArmarInsum">
                      <thead>
                        <tr>
                          <th width="2%"></th>
                          <th>Artículo</th>
                          <th>Cantidad</th>
                          <th>Depósitos</th>                                
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td><label ></label></td>                      
                          <td><input type="text" class="artOrdInsum" id="artOrdInsum" value="" placeholder="Buscar..."></td>
                          <td><input type="text" class="cantOrdInsum" id="cantOrdInsum" value="" placeholder=""></td>
                          <td><select name="depositos" class="depositos" id="depositos">
                                    <option value=""></option>
                              </select>
                          </td>
                          <td class="hidden"><input type="text" name="id-artOrdIns" class="id-artOrdIns" id="id-artOrdIns" value="" placeholder="" disabled></td>
                          <td class="hidden"><input type="text" name="id-depositos" class="id-depositos" id="id-depositos" value="" placeholder="" disabled></td>
                        </tr>
                      </tbody>
                    </table>

                    <div class="">                            
                      <button type="button" class="botones btn btn-success btn-sm" onclick="javascript:validarCantidad()">Agregar</button>
                    </div> 
                     <br/><br/>
                    <table class="table table-condensed table-responsive tabModInsum" id="tabModInsum">
                      <thead>
                        <tr>
                          <th width="10%"></th>
                          <th>Artículo</th>
                          <th>Cantidad</th>
                          <th>Depósitos</th>
                        </tr>
                      </thead>
                      <tbody>
                        
                      </tbody>
                    </table>
                    <br /> <br />
                </div><!--  / <div class="panel panel-default"> -->
              </div> 

              <div role="tabpanel" class="tab-pane" id="rrhh">
                <!--  ORDEN DE RECURSOS HUMANOS   -->
                <div class="panel panel-default">
                    <div class="panel-heading"><span class="fa fa-file-text-o icotitulo" aria-hidden="true"></span>Orden de Recursos Humanos</div>
                    <p class="titulos">Detalle</p>
                    <hr> 
                    <table class="table table-condensed table-responsive tabArmarOperarios">
                      <thead>
                        <tr>
                          <th width="2%"></th>
                          <th>Apellido y Nombre</th>                          
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td><label ></label></td>                      
                          <td><input type="text" class="operario" id="operario" value="" placeholder="Buscar..."></td>
                          <td class="hidden"><input type="text" class="id-Operario" id="id-Operario" value="" placeholder="" disabled></td>                             
                        </tr>
                      </tbody>
                    </table>

                    <div class="">                            
                      <button type="button" class="botones btn btn-success btn-sm" onclick="javascript:armarTablaRecursos()">Agregar</button>
                    </div>
                    <br/><br/>                      
                    <table class="table table-condensed table-responsive tabModRecursos" id="tabModRecursos">
                      <thead>
                        <tr>
                          <th width="10%"></th>
                          <th>Apellido y Nombre</th>                           
                        </tr>
                      </thead>
                      <tbody>
                        
                      </tbody>
                    </table>
                    <br /><br />              
                </div><!--  / <div class="panel panel-default"> -->
              </div>

        </form>      


              <div class="pull-right">
                <button type="button" class="botones btn btn-primary" onclick="javascript:enviarOrden()">Guardar</button> 
              </div>           

          
        </div><!-- /.box-body -->
      </div><!-- /.box -->
    </div><!-- /.col -->
  </div><!-- /.row -->
</section><!-- /.content -->


<!-- Carga vista Orden de Servicio -->
<script>
 $('#listado').click( function cargarVista(){
    WaitingOpen();
    $('#content').empty();
    $("#content").load("<?php echo base_url(); ?>index.php/ordenservicio/index/<?php echo $permission; ?>/");
    WaitingClose();
  });
</script>
<!-- / Carga vista Orden de Servicio -->

<!-- Datepicker -->
<script>     
  $("#fechaOrden").datepicker({
    dateFormat: 'dd/mm/yy',
    firstDay: 1
  }).datepicker("setDate", new Date());
</script>
<!-- / Datepicker -->

<!-- Trae Causa y equipos componentes segun Solc de servicio -->
<script>

  $(function() {

      var id_solicitud = $("#numSolic").val();
      $.ajax({
          'data':{id_solic: id_solicitud},
          'async': false,
          'type': "POST",
          'global': false,
          'dataType': 'json',
          'url': "ordenservicio/getSolEquipCausa",
          'success': function (data) {
              $("#id_solicitudreparacion").val(data[0].id_solicitud);
              $("#causa").val(data[0].causa);
              $("#id_equipoSolic").val(data[0].id_equipo);
              console.log('causa en ajax');
              console.log(data[0].causa);              
          }
      });

      var id_eq = $("#id_equipoSolic").val(); 
      $.ajax({
            'data' : {id_equipo : id_eq },
            'async': true,
            'type': "POST",
            'global': false,
            'dataType': 'json',
            'url': "ordenservicio/getEquipo",
            'success': function (data) {
                console.log(data);
                $("#nomEquipo").val(data.nomb_equipo);              
                $("#descEquipo").val(data.desc_equipo);
                $("#estado").val(data.estado);
                $("#marca").val(data.marca);
                $("#sector").val(data.sector);
                $("#ubicacion").val(data.ubicacion)
                $("#fecha_ingreso").val(data.fecha_ingreso);
                $("#fecha_baja").val(data.fecha_baja);
                $("#fecha_garantia").val(data.fecha_garantia);                 
                $("#grupo").val(data.grupo_desc);

            }
      });

     var comp_select= $("#componentes"); 
     $.ajax({
              'data' : {id_equipo : id_eq },
              'async': true,
              'type': "POST",
              'global': false,
              //'dataType': 'json',
              'url': "ordenservicio/getComponente",
              'success': function (data) {
                  data = JSON.parse(data,true);

                  console.log('componentes por equipo');                  
                  console.log(data['datos'][0]['descripcion']); 
                  console.log(data['datos'][0]['id_componente']);

                  for (var i = 0; i< data['datos'].length; i++) {
                    comp_select.append($('<option />', 
                      { value: data['datos'][i]['id_componente'], 
                        text: data['datos'][i]['descripcion'] }
                        ));
                  };                                     
              },
              'error': function(data){
                console.log("No hay componentes asociados en BD");
              }
      });        
  });    
</script>
<!-- / Trae Causa y equipos segun Solc de servicio -->

<!-- Trae Herrammientas -->
<script>
  $( function() {
      var dataF = function () {
          var tmp = null;
          $.ajax({
              'async': false,
              'type': "POST",
              'global': false,
              'dataType': 'json',
              'url': "ordenservicio/getHerramienta",
              'success': function (data) {
                  tmp = data;
              }
          });
          return tmp;
      }();

      $(function() {
          $(".herramienta").autocomplete({
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
                  $(".marcaherram").val(ui.item.value);
                  $(".codherram").val(ui.item.codherram);
                  $(".herrId").val(ui.item.herrId);
                  console.log("id de herramienta: ");
                  console.log(ui.item.herrId);
                  
              }
          });
      });
  });
</script>
<!-- / Trae Herrammientas -->

<!-- Trae Contratistas -->
<script>
  $( function() {
      var dataF = function () {
          var tmp = null;
          $.ajax({
              'async': false,
              'type': "POST",
              'global': false,
              'dataType': 'json',
              'url': "ordenservicio/getContratista",
              'success': function (data) {
                  tmp = data;
              }
          });
          return tmp;
      }();   

      // Asigna opciones al select #tareas
      var cont_selec= $("#contratista");
      $.each(dataF, function(i, val){
                      cont_selec.append($('<option />', { value: val.id_contratista, text: val.nombre }));
                  });

      $(cont_selec).change(
          function(){
            var cont_id = $("#contratista option:selected").val();
            $("#id_contratista").val(cont_id);
            console.log("id contratista selec")
            console.log(cont_id);
          }
      );

  });
</script> 
<!--  / Trae Contratistas -->

<!-- Trae Articulos -->
<script>
  $( function() {
      var dataF = function () {
          var tmp = null;
          $.ajax({
              'async': false,
              'type': "POST",
              'global': false,
              'dataType': 'json',
              'url': "ordenservicio/getArticulo",
              'success': function (data) {
                  tmp = data;
              }
          });
          return tmp;
      }();

      $(function() {
          $(".artOrdInsum").autocomplete({
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
                  $("#id-artOrdIns").val(ui.item.value); 
                  //console.log("id articulo de orden insumo: ") 
                  //console.log(ui.item.value);                
              },
              
          });
      });
  } );
</script>
<!--  / Trae Articulos -->

<!-- Trae Depósitos -->
<script>
  $( function() {
      var dataF = function () {
          var tmp = null;
          $.ajax({
              'async': false,
              'type': "POST",
              'global': false,
              'dataType': 'json',
              'url': "Ordenservicio/getDeposito",
              'success': function (data) {
                  tmp = data;
              }
          });
          return tmp;
      }();   

      // Asigna opciones al select #tareas
      var dep_selec= $("#depositos");
      $.each(dataF, function(i, val){
                      dep_selec.append($('<option />', { value: val.depositoId, text: val.depositodescrip }));
                  });

      $(dep_selec).change(
          function(){
            var dep_id = $("#depositos option:selected").val();
            $("#id_depositos").val(dep_id);
            //console.log("id depositos selec")
            //console.log(dep_id);
          }
      );
  });
</script>
<!--   / Trae Depósitos -->

<!-- Trae Tareas -->
<script>
  $( function() {
      var dataF = function () {
          var tmp = null;
          $.ajax({
              'async': false,
              'type': "POST",
              'global': false,
              'dataType': 'json',
              'url': "ordenservicio/getTarea",
              'success': function (data) {
                  tmp = data;               

              }
          });
          return tmp;
      }();
     
      // Asigna opciones al select #tareas
      var tarea_selec= $("#tareas");
      $.each(dataF, function(i, val){
                      tarea_selec.append($('<option />', { value: val.id_tarea, text: val.descripcion }));
                  });

      $(tarea_selec).change(
          function(){
            var tareas_id = $("#tareas option:selected").val();
            $("#id_contratista").val(tareas_id);
            console.log("id tareas selec")
            console.log(tareas_id);
          }
      );
  });
</script>
<!-- / Trae Tareas -->

<!-- Trae Operarios -->
<script>
  $( function() {
      var dataF = function () {
                      var tmp = null;
                      $.ajax({
                          'async': false,
                          'type': "POST",
                          'global': false,
                          'dataType': 'json',
                          'url': "ordenservicio/getOperario",
                          'success': function (data) {
                              tmp = data;
                          }
                      });
                      return tmp;
                  }();   

      
      $(function() {
          $(".operario").autocomplete({
              source: dataF,
              delay: 100,
              minLength: 1,
              focus: function(event, ui) {
                  // prevent autocomplete from updating the textbox
                  event.preventDefault();
                  // manually update the textbox
                  $(this).val(ui.item.label);
                  $("#id-Operario").val(ui.item.value);
                  console.log("id de operario: ");
                  console.log(ui.item.value);
              },
              select: function(event, ui) {
                  // prevent autocomplete from updating the textbox
                  event.preventDefault();
                  // manually update the textbox and hidden field
                  $(this).val(ui.item.label);                  
              },
              open: function( event, ui ) {
                  $("#ui-id-3").css('z-index',1050);
              }
          });
      });
  });
</script>
<!--  / Trae Operarios -->

<!-- Tablas armado -->
<script>

// TAREAS
  
  var regTar = 0;                  // variable incrementable en func, para diferenciar los inputs
  function armarTablaTareas(){    // inserta valores de inputs en la tabla 

    var $tareas = $("select#tareas option:selected").html();
    var $id_tareas = $("#tareas").val();
    
    var $componentes = $("select#componentes option:selected").html();
    var $id_comp = $("#componentes").val();    // muestra e id de componente
    
    var $horas = $("#horas").val();
    var $costo = $("#costo").val(); 
    
    $(".tablalistareas tbody").append(
                    '<tr>'+'<td><i class="fa fa-ban elirow" style="color: #f39c12; cursor: pointer; margin-left: 15px;"></i></td>'+
                     '<td class="tareas"><input type="text" class="tareas_a_real" id="tareas_a_real" value=" '+ $tareas +' " placeholder=""></td>'+
                     '<td class="componentes" id="componentes"><input type="text" class="comp" id="comp" value=" '+ $componentes +' " placeholder=""></td>'+
                     '<td class="hidden id_tareas" id="id_tareas"><input type="text" name="tarea_id'+ '['+ regTar+']' +'" class="tarea_id" id="tarea_id" value=" '+ $id_tareas +' " placeholder=""></td>'+
                     '<td class="hidden id_comp" id="id_comp"><input type="text" name="comp_id'+ '['+ regTar+']' +'" class="comp_id" id="comp_id" value=" '+ $id_comp +' " placeholder=""></td>'+
                     '<td class="horas" id="horas"><input type="text" name="cant_horas'+ '['+ regTar+']' +'" class="cant_horas" id="cant_horas" value=" '+ $horas +' " placeholder=""></td>'+
                     '<td class="costo" id="costo"><input type="text" name="costos'+ '['+ regTar+']' +'" class="costos" id="costos" value=" '+ $costo +' " placeholder=""></td>'+'</tr>');


    $("#tareas").val("");
    $("#componentes").val("");
    $("#horas").val("");
    $("#costo").val(""); 

    regTar++;
  }
  // Evento que selecciona la fila y la elimina 
  $(document).on("click",".elirow",function(){
      var parent = $(this).closest('tr');
      $(parent).remove();
  });

// HERRAMIENTAS
  var regHerr = 0;                // variable incrementable en func, para diferenciar los inputs
  function armartablistherr(){   // inserta valores de inputs en la tabla 

    var $herramienta = $("#herramienta").val();
    var $marcaherram = $("#marcaherram").val();
    var $codherram = $("#codherram").val(); 
    var $herrId = $("#herrId").val();
    $(".tablalistherram tbody").append(
                  '<tr>'+ 
                    '<td><i class="fa fa-ban eliminrow" style="color: #f39c12; cursor: pointer; margin-left: 15px;"></i></td>'+
                     '<td>'+ $herramienta +'</td>'+
                     '<td>'+ $marcaherram +'</td>'+
                     '<td>'+ $codherram +'</td>'+
                     '<td class="hidden" id=""><input type="text" name="herrid'+ '['+ regHerr+']' +'" class="herrid" id="herrid" value=" '+ $herrId +' " placeholder=""></td>'+
                  '<tr>');
    $("#herramienta").val("");
    $("#marcaherram").val("");
    $("#codherram").val("");
    $("#herrId").val(); 

    regHerr++;
  }
   
   // Evento que selecciona la fila y la elimina 
   $(document).on("click",".eliminrow",function(){
      var parent = $(this).closest('tr');
      $(parent).remove();
   });

// RECURSOS
  
  regOper = 0;                       // variable incrementable en func, para diferenciar los inputs
  function armarTablaRecursos(){   // inserta valores de inputs en la tabla  
   
    var $operario = $("#operario").val();
    var $id_operario = $("#id-Operario").val();
    //var error = validaOperario($operario); 
    console.log('variable error en armar tabla: ');
    console.log(error);


    //if (error == true) {      
      $(".tabModRecursos tbody").append(
                    '<tr>'+
                      '<td><i class="fa fa-ban elimrowrec" style="color: #f39c12; cursor: pointer; margin-left: 15px;"></i></td>'+
                       '<td>'+ $operario +'</td>'+
                       '<td class="hidden operario_id id-Operario"><input type="text" name="usrid'+ '['+ regOper+']' +'" class="usrid" id="usrid" value=" '+ $id_operario +' " placeholder=""></td>'+
                    '<tr>');
      $("#operario").val("");
      $("#id-Operario").val(""); 
      regOper++;

    //}else{
      //alert("El usuario no esta registrado en el Sistema");
    //}
    
  }

  /*function validaOperario($operario){
     
    var flag = "";
    //function () {
                    
                   var error =  $.ajax({
                            'data' : {operario: $operario},
                            'async': true,
                            'type': "POST",
                            'global': false,
                            'dataType': 'json',
                            'url': "ordenservicio/validaOperario",
                            'success': function (data) {                
                              flag = data.resp;                              
                              console.log('Entra por success');
                              console.log(data.resp);
                              console.log('despues de sentrar');
                              return flag;
                            },
                            'error':function(data){
                              alert('estas in the oven');
                            }
                            

                    });
                  console.log('flag: ');
                  console.log(flag);  
                //   return flag;
                // }(); 

    console.log('error saliendo de ajax: ');
    console.log(error.resp);
    return error;
  }*/

   
   // Evento que selecciona la fila y la elimina 
  $(document).on("click",".elimrowrec",function(){
      var parent = $(this).closest('tr');
      $(parent).remove();
  });

// INSUMOS
  
  function validarCantidad(){
    
    var iddepositos = $("#depositos").val();
    var idinsum = $("#id-artOrdIns").val();
    var cantInsum = $("#cantOrdInsum").val();
    cantInsum = parseInt(cantInsum); 

    $.ajax({
                type: 'POST',
                data:{ 
                      depoid : iddepositos,
                      id_insum : idinsum
                    },
                dataType: 'json',     
                cache: false,
                url: 'index.php/Ordenservicio/getLoteActivo',                
                success: function(data){
                      
                      console.log('cantidad desde server: ');                      
                      var cantidad = parseInt(data.cantidad);
                      if (cantInsum <= cantidad) {                          
                        armarTablaInsumos();
                      }
                      else{
                        alert("No hay insumos suficientes...");
                      }                       
                  },                        
                error: function(data){

                        console.log('devolucion de ajax por error'); 
                  },                 
                complete : function(jqXHR, status) {
                //alert(jqXHR);
                //alert(status);
                }
           });
  };

  var regInsum = 0;          //incrementable en func, para diferenciar los inputs
  function armarTablaInsumos(){   // inserta valores de inputs en la tabla 

    var $artOrdInsum = $("#artOrdInsum").val();
    var $id_Insumo = $("#id-artOrdIns").val();
    var $cantOrdInsum = $("#cantOrdInsum").val();
    var $precioOrdInsum = $("#precioOrdInsum").val(); 
    var $componentes = $("select#componentes option:selected").html();
    var $depos = $("select#depositos option:selected").html();
    var $id_deposito = $("#depositos").val();    // muestra e id de componente
    
    $(".tabModInsum tbody").append(
                  '<tr>'+
                    '<td><i class="fa fa-ban elimrow" style="color: #f39c12; cursor: pointer; margin-left: 15px;"></i></td>'+
                     '<td class="">'+ $artOrdInsum +'</td>'+
                     '<td class="hidden id_Insumo" id="id_Insumo"><input type="text" name="insum_Id'+ '['+ regInsum+']' +'" class="insum_Id" id="insum_Id" value=" '+ $id_Insumo +' " placeholder=""></td>'+
                     
                     '<td class="cant_insumos" id="cant_insumos"><input type="text" name="cant_insumos'+ '['+ regInsum+']' +'" class="cant_insumos" id="cant_insumos" value=" '+ $cantOrdInsum +' " placeholder=""></td>'+
                     
                     '<td class="nom_depos" id="nom_depos"><input type="text" class="nom_depo" id="nom_depo" value=" '+ $depos +' " placeholder=""></td>'+

                     '<td class="hidden id_depo" id="id_depo"><input type="text" name="depositoid'+ '['+ regInsum+']' +'" class="depositoid" id="depositoid" value=" '+ $id_deposito +' " placeholder=""></td>'+

                  '<tr>');
    $("#artOrdInsum").val("");
    $("#cantOrdInsum").val("");
    $("#precioOrdInsum").val("");   
    $("#id-artOrdIns").val("");
    $("#depositos").val("");

    regInsum++;
  }
   
   // Evento que selecciona la fila y la elimina 
   $(document).on("click",".elimrow",function(){
      var parent = $(this).closest('tr');
      $(parent).remove();
   });
 

</script>

<!-- Validacion de campos y Envio form -->
<script>

  function enviarOrden() {  
      
      /////  VALIDACIONES
    var hayError = false;
      
    if ($('#numSolic').val() == '') {
            hayError = true;
        }

    if(hayError == true){
       $('#error').fadeIn('slow');
       return;
    }
    else{
        $('#error').fadeOut('slow');
        var id_equipo = $("#numSolic").val();
        var datos = $("#form_order").serializeArray();
        // console.log("Orden array serializado");
        // console.log(datos);

        WaitingOpen('Guardando cambios');
        $.ajax({    
                    data: datos,
                    type: 'POST',             
                    dataType: 'json',
                    url: 'index.php/Ordenservicio/setOrdenServ',                
                    success: function(result){
                                                      
                            WaitingClose();
                            setTimeout("cargarView('Ordenservicio', 'index', '"+$('#permission').val()+"');",0);
                    },
                    error: function(result){
                            WaitingClose();
                                                      
                            alert("Error en guardado...");
                    },
              });
        }    
  }
</script>
<!-- / Validacion de campos y Envio form -->