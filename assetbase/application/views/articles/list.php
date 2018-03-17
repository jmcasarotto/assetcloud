<input type="hidden" id="permission" value="<?php echo $permission;?>">
<section class="content">
  <div class="row">
    <div class="col-xs-12">
      <div class="box">
        <div class="box-header">
          <h3 class="box-title">Artículos</h3>
          <?php
          if (strpos($permission,'Add') !== false) { 
            echo '<button class="btn btn-block btn-success" style="width: 100px; margin-top: 10px;" data-toggle="modal" onclick="LoadArt(0,\'Add\')" id="btnAdd">Agregar</button>';
          }
          ?>
        </div><!-- /.box-header -->
        <div class="box-body">
          <table id="articles" class="table table-bordered table-hover">
            <thead>
              <tr>
                <th width="20%">Acciones</th>
                <th width="5%">Código</th>
                <th>Descripción</th>
                <th>Familia</th>
                <th>Unidad de Medida</th>
                <th width="5%">Estado</th>
              </tr>
            </thead>
            <tbody>
              <?php
                if(isset($list)) { 
                  if(count($list) > 0)                 
                	foreach($list as $a){
                    if ($a['artEstado'] != "AN") {
  	                
                    $id=$a['artId'];
                    echo '<tr  id="'.$id.'" >';
                    echo '<td>';
                    if (strpos($permission,'Edit') !== false) {
  	                	//echo '<i class="fa fa-fw fa-pencil" style="color: #f39c12; cursor: pointer; margin-left: 15px;" onclick="LoadArt('.$a['artId'].',\'Edit\')"></i>';
                      echo '<i class="fa fa-fw fa-pencil" style="color: #A4A4A4; cursor: pointer; margin-left: 15px;" title="Editar" data-toggle="modal" data-target="#modaleditar"></i>';
                    }
                    if (strpos($permission,'Del') !== false) {
  	                	//echo '<i class="fa fa-fw fa-times-circle" style="color: #A4A4A4; cursor: pointer; margin-left: 15px;" onclick="LoadArt('.$a['artId'].',\'Del\')"></i>';
                      echo '<i class="fa fa-fw fa-times-circle" style="color: #A4A4A4; cursor: pointer; margin-left: 15px;" title="Eliminar" data-toggle="modal" data-target="#modaleliminar"></i>';
                    }
                    if (strpos($permission,'View') !== false) {
  	                	echo '<i class="fa fa-fw fa-search" style="color: #3c8dbc; cursor: pointer; margin-left: 15px;" onclick="LoadArt('.$a['artId'].',\'View\')"></i>';
                    }
  	                echo '</td>';
                    echo '<td style="text-align: center">'.$a['artBarCode'].'</td>';
  	                echo '<td style="text-align: left">'.$a['artDescription'].'</td>';
                    echo '<td style="text-align: left">'.$a['famName'].'</td>';
                    echo '<td style="text-align: left">'.$a['descripcion'].'</td>';
                    echo '<td style="text-align: left">'.($a['artEstado'] == 'AC' ? '<small class="label pull-left bg-green">Activo</small>' : ($a['artEstado'] == 'IN' ? '<small class="label pull-left bg-red">Inactivo</small>' : '<small class="label pull-left bg-yellow">Suspendido</small>')).'</td>';
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

    
  var idArt = 0;
  var acArt = '';
  var idelim ="";
  var ida ="";
  var estadovar="";
  var estadoid="";

$(document).ready(function(event) { 
   
$('#btnSave').click(function(){

  	if(acArt == 'View')
  	{
  		$('#modalArticle').modal('hide');
  		return;
  	}

  	var hayError = false;
    if($('#artBarCode').val() == '')
    {
      hayError = true;
    }

    if($('#artDescription').val() == '')
    {
      hayError = true;
    }

    

    if(hayError == true){
    	$('#errorArt').fadeIn('slow');
    	return;
    }

    $('#error').fadeOut('slow');
    WaitingOpen('Guardando cambios');
    	$.ajax({
          	type: 'POST',
          	data: { 
                    id :      idArt, 
                    act:      acArt, 
                    code:     $('#artBarCode').val(),
                    name:     $('#artDescription').val(),
                    fam:      $('#famId').val(),
                    status:   $('#artEstado').val(),
                    box:      $('#artIsByBox').prop('checked'),
                    boxCant:  $('#artCantBox').val(),
                    unidmed:  $('#unidmed').val(),
                    puntped:  $('#puntped').val()  
                  },
    		    url: 'index.php/Article/setArticle', 
    		success: function(result){
                  console.log("estoy Guardando");
                			WaitingClose();
                			$('#modalArticle').modal('hide');
                		setTimeout("cargarView('Article', 'index', '"+$('#permission').val()+"');",1000);
    					},
    		error: function(result){
    					WaitingClose();
    					alert("error");
    				},
          	dataType: 'json'
    		});
});

$(".fa-times-circle").click(function (e) { 
                 
         
    console.log("Esto eliminando"); 
    var idar = $(this).parent('td').parent('tr').attr('id');
    console.log("El id del articulo es:");
    console.log(idar);
    idelim=idar;
    
    
});

//Editar
$(".fa-pencil").click(function (e) { 
     
    var idartic = $(this).parent('td').parent('tr').attr('id');
    console.log("ID de articulo es:");
    console.log(idartic);
    ida=idartic;
    $('#artBarCode').val('');
    $('#artDescription').val('');
    $('#artIsByBox').val('');
    $('#artCantBox').val('');
    $('#famId').html('');
    $('#unidmed').html('');
    $('#artEstado').val('');
    $('#puntped').val('');
    $.ajax({
        type: 'POST',
        data: { idartic: idartic},
        url: 'index.php/Article/getpencil', //index.php/
        success: function(data){
              console.log("Estoy editando");           
              console.log(data);
              console.log(data[0]['artBarCode']);
               
              datos={
             
                  'codigoart':data[0]['artBarCode'],
                  'descripart':data[0]['artDescription'],
                  'artbox':data[0]['artIsByBox'],
                  'artcant':data[0]['artCantBox'],
                  'idfam':data[0]['famId'],
                  'famDsc':data[0]['famName'],
                  'estado':data[0]['artEstado'],
                  'idunidad':data[0]['unidadmedida'],
                  'unidadmedidades':data[0]['descripcion'],
                  'punto_pedido':data[0]['punto_pedido']  
                }
                if(data[0]['artEstado']=='AC'){
                  estadovar= 'Activo';
                  estadoid= 1;
                }
                else 
                {
                  estadovar= 'Suspendido';
                  estadoid= 2;
                }

              
              completarEdit(datos, estadovar, estadoid);
                             
              },
          
        error: function(result){
              
              console.log(result);
            },
        dataType: 'json'
        });
  
});

$('#artIsByBox').click(function() {
    if($('#artIsByBox').is(':checked')){
      $('#artCantBox').prop('disabled', false);
    } else {
    $('#artCantBox').val('');
    $('#artCantBox').prop('disabled', true);
    }
  CalcularPrecio();
});

$('#artMargin').keyup(function(){
  CalcularPrecio();
});

$('#artMarginIsPorcent').click(function() {
  CalcularPrecio();
});

$('#artCoste').keyup(function(){
  CalcularPrecio();
});

$('#artCantBox').keyup(function(){
  CalcularPrecio();
});

$('#articles').DataTable({
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
function completarEdit(datos ,estadovar, estadoid){

  console.log("datos que llegaron");
  $('#artBarCode').val(datos['codigoart']);
  $('#artDescription').val(datos['descripart']);
  $('#artIsByBox').val(datos['artbox']);
  $('#artCantBox').val(datos['artcant']);
  traer_unidad();
  traer_familia();
  $('select#famId').append($('<option />', { value: datos['idfam'],text: datos['famDsc']}));
  $('select#unidmed').append($('<option />', { value: datos['idunidad'],text: datos['unidadmedidades']}));
  //$('select#artEstado').append($('<option />', { value: datos['estadoid'],text: datos['estadovar']}));
  $('#puntped').val(datos['punto_pedido']);
  $('#artEstado').val(datos['estado']);
  
}

function CalcularPrecio(){
  var precioCosto = $('#artCoste').val() == '' ? 0 : parseFloat($('#artCoste').val()).toFixed(2);
  var margen      = $('#artMargin').val() == '' ? 0 : parseFloat($('#artMargin').val()).toFixed(2);
  var margenEsPor = $('#artMarginIsPorcent').is(':checked');
  var cantCaja    = $('#artCantBox').val() == '' ? 0 : parseFloat($('#artCantBox').val()).toFixed(2);
  var esPorCaja   = $('#artIsByBox').is(':checked');


  var costoUnitario = parseFloat(precioCosto);
  if(esPorCaja == true){
    costoUnitario = parseFloat(parseFloat(precioCosto) / parseFloat(cantCaja)).toFixed(2);
  }

  var pVenta = 0;
  if(margenEsPor){
    var importe = (parseFloat(margen) / 100) * parseFloat(costoUnitario);
    pVenta = parseFloat(parseFloat(importe) + parseFloat(costoUnitario)).toFixed(2);
  } else {
    pVenta = parseFloat(parseFloat(costoUnitario) + parseFloat(margen)).toFixed(2);
  }

  $('#pventa').html(pVenta);
}

function traer_unidad(){
    $.ajax({
        type: 'POST',
        data: { },
        url: 'index.php/Article/getdatosart', //index.php/
        success: function(data){
               
                
                $('#unidmed').append(opcion); 
                for(var i=0; i < data.length ; i++)  {    
                    
                    var nombre = data[i]['descripcion'];
                    var opcion  = "<option value='"+data[i]['id_unidadmedida']+"'>" +nombre+ "</option>" ; 

                    $('#unidmed').append(opcion); 
                                   
                }
              },
        error: function(result){
              
              console.log(result);
            },
            dataType: 'json'
    });
}

function traer_familia(){
    $.ajax({
        type: 'POST',
        data: { },
        url: 'index.php/Article/getdatosfam', //index.php/
        success: function(data){
               
                
                $('#famId').append(opcion); 
                for(var i=0; i < data.length ; i++) {

                    var nombre = data[i]['famName'];
                    var opcion  = "<option value='"+data[i]['famId']+"'>" +nombre+ "</option>" ; 

                    $('#famId').append(opcion); 
                                   
                }
              },
        error: function(result){
              
              console.log(result);
            },
            dataType: 'json'
    });
}
function LoadArt(id_, action){
    idArt = id_;
    acArt = action;
    LoadIconAction('modalAction',action);
    WaitingOpen('Cargando Artículo');
      $.ajax({
            type: 'POST',
            data: { id : id_, act: action },
        url: 'index.php/Article/getArticle', 
        success: function(result){
                      WaitingClose();
                      $("#modalBodyArticle").html(result.html);
                      //$("#artCantBox").maskMoney({allowNegative: true, thousands:'', decimal:'.'});
                      //$("#artCoste").maskMoney({allowNegative: true, thousands:'', decimal:'.'});
                      //$("#artMargin").maskMoney({allowNegative: true, thousands:'', decimal:'.'});
                      CalcularPrecio();
                      setTimeout("$('#modalArticle').modal('show')",800);
                      //$("[data-mask]").inputmask();
              },
        error: function(result){
              WaitingClose();
              alert("error");
            },
            dataType: 'json'
        });
}

function guardareliminar(){
    console.log("Estoy guardando el eliminar , el id de articulo es:");
    console.log(idelim);
    $.ajax({
            type: 'POST',
            data: { idelim: idelim},
            url: 'index.php/Article/baja_articulo', //index.php/
            success: function(data){
                    //var data = jQuery.parseJSON( data );
                    console.log(data);
                   
                    //$(tr).remove();
                    alert("Articulo Eliminado");
                    regresa();
                  
                  },
              
            error: function(result){
                  
                  console.log(result);
                }
               // dataType: 'json'
      });

   

} 

function guardareditar(){

    var codigo = $('#artBarCode').val();
    var desc = $('#artDescription').val();
    var box= $('#artIsByBox').val();
    var unidades = $('#artCantBox').val();
    var fam = $('#famId').val();
    var estado = $('#artEstado').val();
    var unmed = $('#unidmed').val();
    var punto = $('#puntped').val();
    

    var parametros = {
       // 'id_equipo': id_equipo,
        'artBarCode': codigo,
        'artDescription': desc,
        'artIsByBox': box,
        'artCantBox': unidades,
        'famId': fam,
        'artEstado': estado,
        'unidadmedida': unmed,
        'punto_pedido': punto
               
    };

        console.log("estoy editando");
        console.log("parametros");
        $.ajax({
          type: 'POST',
          data: {data:parametros, ida: ida},
          url: 'index.php/Article/editar_art',  //index.php/
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

function regresa(){
  
    $('#content').empty();
    $("#content").load("<?php echo base_url(); ?>index.php/Article/index/<?php echo $permission; ?>");
    WaitingClose();
}


</script>

<!-- Modal -->
<div class="modal fade" id="modalArticle" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel"><span id="modalAction"> </span> Artículo</h4> 
      </div>
      <div class="modal-body" id="modalBodyArticle">
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
        <button type="button" class="btn btn-primary" id="btnSave">Guardar</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal eliminar-->
<div class="modal fade" id="modaleliminar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-lg" role="document" style="width: 50%">
    <div class="modal-content">

      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title"  id="myModalLabel"><span id="modalAction" class="fa fa-fw fa-times-circle" style="color: #dd4b39" > </span> Eliminar Artículo</h4>
       </div> <!-- /.modal-header  -->

      <div class="modal-body input-group ui-widget" id="modalBodyArticle">
        
         
              <label >¿Realmente desea ELIMINAR ARTICULO?  </label>
            
         </div>  <!-- /.modal-body -->
          <div class="modal-footer">
           
            <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
            <button type="button" class="btn btn-primary" id="btnSave" data-dismiss="modal" onclick="guardareliminar()" >SI</button>
          </div>  <!-- /.modal footer -->

      
    </div> <!-- /.modal-content -->

  </div>  <!-- /.modal-dialog modal-lg -->
</div>  <!-- /.modal fade -->
<!-- / Modal -->

<!-- Modal editar-->
<div class="modal fade" id="modaleditar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-lg" role="document" style="width: 50%">
    <div class="modal-content">

      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title"  id="myModalLabel"><span id="modalAction" class="fa fa-fw fa-pencil" style="color: #f39c12" > </span> Editar Artículo</h4>
       </div> <!-- /.modal-header  -->

      <div class="modal-body input-group ui-widget" id="modalBodyArticle">
        
        <div class="row">
          <div class="col-xs-4">
            <label style="margin-top: 7px;">Código <strong style="color: #dd4b39">*</strong>: </label>
          </div>
          <div class="col-xs-5">
            <input type="text" class="form-control" id="artBarCode" value="<?php echo $data['article']['artBarCode'];?>" <?php echo ($data['read'] == true ? 'disabled="disabled"' : '');?> >
          </div>
        </div><br>

        <!-- Código del Artículo -->
        <div class="row">
          <div class="col-xs-4">
            <label style="margin-top: 7px;">Descripción <strong style="color: #dd4b39">*</strong>: </label>
          </div>
          <div class="col-xs-5">
            <input type="text" class="form-control" id="artDescription" value="<?php echo $data['article']['artDescription'];?>" <?php echo ($data['read'] == true ? 'disabled="disabled"' : '');?> >
          </div>
        </div><br>
      
        <!-- Descripción del Artículo -->
        <div class="row">
          <div class="col-xs-4">
            <label style="margin-top: 7px;">Se Compra x Caja <strong style="color: #dd4b39">*</strong>: </label>
          </div>
          <div class="col-xs-1">
            <input type="checkbox" id="artIsByBox" style="margin-top:10px;" <?php echo($data['article']['artIsByBox'] == true ? 'checked': ''); ?> <?php echo ($data['read'] == true ? 'disabled="disabled"' : '');?> >
          </div>
          <div class="col-xs-3">
            <label style="margin-top: 7px;">Unidades <strong style="color: #dd4b39">*</strong>: </label>
          </div>
          <div class="col-xs-4">
            <input type="text" class="form-control" id="artCantBox" value="<?php echo $data['article']['artCantBox'];?>" <?php echo (($data['article']['artIsByBox'] != true || ($data['action'] == 'View' || $data['action'] == 'Del'))? 'disabled="disabled"' : '');?>  >
          </div>
        </div><br>

      
        <div class="row">
          <div class="col-xs-4">
            <label style="margin-top: 7px;">Familia: </label>
          </div>
          <div class="col-xs-5">
            <select class="form-control" id="famId"  name="famId" value="" >
            
            </select>
          </div>
        </div><br>

        <!-- -->
        <div class="row">
          <div class="col-xs-4">
            <label style="margin-top: 7px;">Estado: </label>
          </div>
          <div class="col-xs-5">
            <select class="form-control" id="artEstado"  name="artEstado"  value="" >
              <?php 
                  echo '<option value="AC" '.($data['article']['artEstado'] == 'AC' ? 'selected' : '').'>Activo</option>';
                  echo '<option value="IN" '.($data['article']['artEstado'] == 'IN' ? 'selected' : '').'>Inactivo</option>';
                  echo '<option value="SU" '.($data['article']['artEstado'] == 'SU' ? 'selected' : '').'>Suspendido</option>';
              ?>
            </select>
          </div>
        </div>
        <br>
        <br>
        <div class="row">
          <div class="col-xs-4">
            <label style="margin-top: 7px;">Unidad de medida <strong style="color: #dd4b39">*</strong>: </label>
          </div>
          <div class="col-xs-5">
            <select  class="form-control" id="unidmed" name="unidmed" value="">
            </select>
          </div>
        </div>
        <br>
        <div class="row">
          <div class="col-xs-4">
            <label style="margin-top: 7px;">Punto de pedido<strong style="color: #dd4b39">*</strong>:</label>
        </div>
        <div class="col-xs-5">
          <input type="text" name="puntped" id="puntped" class="form-control">
        </div>
          
      </div>  <!-- /.modal-body -->
      <div class="modal-footer">
           
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
        <button type="button" class="btn btn-primary" id="btnSave" data-dismiss="modal" onclick="guardareditar()" >Guardar</button>
      </div>  <!-- /.modal footer -->

      
    </div> <!-- /.modal-content -->

  </div>  <!-- /.modal-dialog modal-lg -->
</div>  <!-- /.modal fade -->