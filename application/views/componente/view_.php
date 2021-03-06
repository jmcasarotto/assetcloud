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
          <h2 class="box-title ">Asociar Componentes a Equipo</h2>
           <?php
          if (strpos($permission,'Add') !== false) {
            echo '<button class="btn btn-block btn-success" style="width: 100px; margin-top: 10px;" id="listado">Ver Listado</button>';
          }
          ?>
        </div><!-- /.box-header -->
        <div class="box-body">
         
          <form  id="form_comp" action="" accept-charset="utf-8">
            
            <div class="row" >
              <div class="col-sm-12 col-md-12">
                <div role="tabpanel" class="tab-pane">
                  <div class="form-group">
                    <div class="panel panel-default">
                      <div class="panel-heading">
                        <h2 class="panel-title  fa fa-cogs" >   Datos de Equipo</h2>
                      </div>
                      <div class="panel-body">
                        <div class="tab-content">
                          <div role="tabpanel" class="tab-pane active" id="choras">
                            <div class="row" >
                              <div class="col-xs-4"><label>Equipo <strong style="color: #dd4b39">*</strong> :</label>
                                <select id="equipo" name="equipo" class="form-control select2" />
                                <input type="hidden" id="id_equipo" name="id_equipo">
                              </div>
                              <br>
                              <br>
                              <div class="col-xs-12">
                              </div>
                              <br>
                              <br>
                              <div class="col-xs-6"><label>Descripción:</label>
                                <textarea class="form-control" id="descrip" name="descrip"  cols="18" rows="3" disabled></textarea>
                              </div>
                              <div class="col-xs-6">
                                <table class="table table-bordered table-responsive" id="tablacompo">
                                  <thead>
                                    <tr>
                                      <th width="2%"></th>                  
                                      <th>Componente:</th>
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
                  </div>
                </div>
                <div role="tabpanel" class="tab-pane">
                  <div class="form-group">
                    <div class="panel panel-default">
                      <div class="panel-heading">
                        <h2 class="panel-title  fa  fa-th-large">  Asociar Componentes</h2>
                      </div>
                      <div class="panel-body">
                        <div class="tab-content">
                          <div role="tabpanel" class="tab-pane active" id="choras">
                            <div class="row" >
                              <div class="col-xs-4"><label>Componente <strong style="color: #dd4b39">*</strong> :</label>  
                                <select  id="componente" name="componente" class="form-control" />
                              </div> 
                              <br> 
                              <div class="col-xs-4">
                                <button type="button" class="btn btn-success"  data-toggle="modal" data-target="#modalOrder"><i class="fa fa-plus"> Nuevo</i></button> 
                              </div>
                              <div class="col-xs-8">
                              </div>     
                              <br>
                              <div class="col-xs-12">
                              </div>
                              <br>
                              <div >              
                              </div>
                              <br>
                              <br>
                              <div class="col-xs-4"><label></label>  
                                <button type="button" class="btn btn-success" id="addcompo"><i class="fa fa-check"> Asociar</i></button>
                              </div>
                              <br>
                              <div class="row" >
                              <div class="col-sm-12 col-md-12">
                                <table class="table table-bordered" id="tablaequipos" border="1px"> 
                                  <br>
                                  <thead>
                                  <tr>                       
                                    <th width="1%"></th>
                                    <th width="2%">Equipo</th>
                                    <th width="5%">Componente</th>
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
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-danger btn-sm delete" onclick="javascript:limpiarModal()">Cancelar</button>
            <button type="button" class="btn btn-primary btn-sm" onclick="guardar()">Guardar</button>
          </div>  <!-- /.modal footer -->
            <!-- / Modal -->
        </form>
      </div><!-- /.box-body -->
    </div><!-- /.box -->
  </div><!-- /.col -->
</div><!-- /.row -->
</section><!-- /.content -->

<!-- Modal -->
 <div class="modal fade" id="modalOrder" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-lg" role="document" style="width: 40%">
    <div class="modal-content">

      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel"><span id="modalAction"> </span> </h4>
       </div> <!-- /.modal-header  -->

      <div class="modal-body input-group ui-widget" id="modalBodyArticle">
        
        <div class="row" >
          <div class="col-sm-12 col-md-12">
            <div role="tabpanel" class="tab-pane">
              <div class="form-group">
                <div class="panel panel-default">
                  <div class="panel-heading">
                      <h2 class="panel-title">Agregar Componente</h2>
                  </div>
                  <div class="panel-body">

                    <div class="alert alert-danger alert-dismissable" id="error1" style="display: none">
                            <h4><i class="icon fa fa-ban"></i> Error!</h4>
                            Revise que todos los campos esten completos...                  
                    </div>
            
                  <br>
                    <div class="col-xs-8"><h4>Descripcion <strong style="color: #dd4b39">*</strong>: </h4>
                      <input type="text"   class="form-control input-md" id="descrip1"  name="descrip1" placeholder="Ingrese Descripcion" />
                    </div>
                    
                    <div class="col-xs-8"><h4>Informacion:</h4>
                     
                      <textarea class="form-control" id="informacion" name="informacion" placeholder="Ingrese Informacion Adicional"></textarea>
                    </div>
                    <br>
                    <div class="col-xs-8"><h4>Marca <strong style="color: #dd4b39">*</strong>: </h4>
                      <select  class="form-control input-md" id="ma"  name="ma" />
                    </div>
                  </div>
                <fieldset><legend></legend></fieldset>
                    <div>
                      <ul class="nav nav-tabs" role="tablist">
                        <li role="presentation" class="active"><a href="#adj" aria-controls="home" role="tab" data-toggle="tab" class="fa fa-folder-open-o"> Adjuntar</a></li>
                        <!--class="fa fa-folder-open-o"-->
                      </ul>
                      
                      <div class="tab-content">
                        <div role="tabpanel" class="tab-pane active" id="adj">
                        <br>
                        <fieldset><legend></legend></fieldset>
                          
                          <input id="input-4" name="input4[]" type="file"  class="form-control input-md">
                        </div>
                        
                      </div>

                    </div><!--  multiple class="file-loading" cierro div del tab-->
                  </div>
                
         </div>
              </div>
            </div>
          </div>
        </div>
       
     

      <div class="modal-footer">
       
        <button type="button" class="btn btn-primary btn-sm" data-dismiss="modal" onclick="guardarcompo()" >Guardar</button>
      </div>  <!-- /.modal footer -->

       </div>  <!-- /.modal-body -->
    </div> <!-- /.modal-content -->

  </div>  <!-- /.modal-dialog modal-lg -->
</div>  <!-- /.modal fade -->
<!-- / Modal -->




<script>
var di="";
var ge="";
traer_equipo();

function traer_equipo(){
 
  $.ajax({
    type: 'POST',
    data: { },
    url: 'index.php/Componente/traerequipo', //index.php/
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

traer_componente();
function traer_componente(){
  $.ajax({
    type: 'POST',
    data: { },
    url: 'index.php/Componente/getcomponente', //index.php/
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
traer_marca();
function traer_marca(){
  $.ajax({
    type: 'POST',
    data: { },
    url: 'index.php/Componente/getmarca', //index.php/
    success: function(data){
           
             var opcion  = "<option value='-1'>Seleccione...</option>" ; 
              $('#ma').append(opcion); 
            for(var i=0; i < data.length ; i++) 
            {    
                  var nombre = data[i]['marcadescrip'];
                  var opcion  = "<option value='"+data[i]['marcaid']+"'>" +nombre+ "</option>" ; 

                $('#ma').append(opcion); 
                               
            }
          },
    error: function(result){
          
          console.log(result);
        },
        dataType: 'json'
    });
}

function traer_descripcion(idequipo){
  $.ajax({
    type: 'POST',
    data: { idequipo: idequipo},
    url: 'index.php/Componente/getequipo', //index.php/ getcompo
    success: function(data){
            console.log(data);
            console.log(data.datos);

            
            if(data=='nada'){
              var d='No hay Descripcion cargada';
              $('#descrip').append(d);
            }
             $('#descrip').val(data.datos);

        },
    error: function(result){
          console.log(result);
            },
           dataType: 'json'
        });   
}

function limpiarModal(){

  $("#equipo").val("");
  $("#descrip").val("");
  $("#componente").val("");
  $('#tablacompo tbody tr').remove();
  $('#tablaequipos tbody tr').remove();
}
 
function guardar(){ 
         
  var id_equipo = new Array();     
  $("#tablaequipos tbody tr").each(function (index){
    var idequipo = $(this).attr('id');
    id_equipo.push(idequipo);            
      
  });  

  comp = {};
  var j=1;
  var f=1;
  $("#tablaequipos tbody tr").each(function (index){
    var campo1, campo2, campo3, campo4;
    $(this).children("td").each(function (index2){
      switch (index2){
        case 0: campo1 = $(this).text();
                break;
        case 1: campo2 = $(this).text();
                break;
        case 2: campo3 = $(this).text();

                break;
        case 3: campo4 = $(this).text();
        comp[j]=campo4;
        j++;
        break;
         
        }
 
    });
    console.log(comp);
  });

  var eq= $('#equipo').val();
  console.log(eq);
  var parametros = {
        'id_equipo': $('#equipo').val(),
        
  };
  console.log("parametros");
  console.log(parametros);
  console.log("componentes");
  console.log(comp);
  console.log("equipos");
  console.log(id_equipo);
  console.log("bandera");
  console.log(x); 
  var hayError = false;
  if(eq!==0 && comp !==0){   
    $.ajax({
        type: 'POST',
        data: {data:parametros, comp:comp, x:x, ge:ge},
        url: 'index.php/Componente/guardar_componente',  //index.php/
        success: function(data){
          console.log("entre por el guardado del componente equipo");
                console.log(data);
                alert ("guardado con exito");
                cargarVista();
              },
        error: function(result){
          console.log("entre por el error del componente equipo");
              
              console.log(result);
              
            }
           // dataType: 'json'
        });
        limpiarModal();
        }
  else{
    hayError=true;
    $('#error').fadeIn('slow');
  }
  if(hayError == false){
    $('#error').fadeOut('slow');
  }
}

function guardarcompo(){ 

  var id_equipo= $('#equipo').val(); 
  var descripcion= $('#descrip1').val();
  var informacion = $('#informacion').val();
  var marcaid = $('#ma').val();
  var pdf= $('#input-4').val();
  var parametros = {
      'descripcion': descripcion,
      'informacion': informacion,
      'marcaid': marcaid,
      'id_equipo': id_equipo,
      'pdf': pdf,

  };                                              
  console.log(parametros);
  var hayError = false; 
  if( id_equipo>0 && marcaid >0){                                     
    $.ajax({
      type:"POST",
      url: "index.php/Componente/agregar_componente", //controlador /metodo
      data:{parametros:parametros},
      success: function(data){
        console.log("exito");
        var datos= parseInt(data);
        console.log(datos);
          
          if(data > 0) //Agrego la descripcion dinamicamte en el select con id componente
          {  
            var texto = '<option value="'+data+'">'+ parametros.descripcion +'</option>';
            console.log(texto);
            $('#componente').append(texto);
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
    alert("Los campos obligatorios deben estar completos: EQUIPO, COMPONENTE Y MARCA deben estar");
  }

}

var equipoglob="";
var x=0;
$('#addcompo').click(function (e) {

  var $equipo = $("select#equipo option:selected").html();
  var id_equipo= $('#equipo').val();
  var $componente = $("select#componente option:selected").html();
  var id_componente= $('#componente').val();
  equipoglob = id_equipo;
  var tr = "<tr id='"+id_equipo+"'>"+
              "<td ><i class='fa fa-ban elirow' style='color: #f39c12'; cursor: 'pointer'></i></td>"+
              "<td>"+$equipo +"</td>"+
              "<td>"+$componente+"</td>"+
              "<td class='hidden' >"+id_componente+"</td>"+
             
              
            "</tr>";

            // "<td class='hidden' id='"+id_componente+"'>"+id_componente+"</td>"+

         // console.log(tr);
          //console.log("el id del equipo es :" +equipoglob);
          //console.log("el id del componente es :" +id_componente);
           // var i=0;
         // var hayError = false;

       
        
  if(id_componente >0 && equipoglob >0) {

    $('#tablaequipos tbody').append(tr);
    $('#error').fadeOut('slow');

    $('#descrip').val('');
    $('#tablacompo tbody tr').remove('');
    $('#equipo').val('');
    $('#componente').val('');
  }
  else{
      
        var hayError = true;
        $('#error').fadeIn('slow')
  }
  if(hayError == false){ 
    $('#error').fadeOut('slow');
  }
  x++;
  console.log(tr);
  $(document).on("click",".elirow",function(){
  var parent = $(this).closest('tr');
  $(parent).remove();
  });

});

$('#listado').click( function cargarVista(){
    WaitingOpen();
    $('#content').empty();
    $("#content").load("<?php echo base_url(); ?>index.php/Componente/index/<?php echo $permission; ?>");
    WaitingClose();
  });

var s=0; 
$('#equipo').change(function(){

  var idequipo = $(this).val();
  var d=$(this).parent('td').parent('tr').attr('id');
  di=d;
  ge=idequipo;
  console.log("id de equipo");
  console.log(idequipo);
  $('#tablacompo tbody tr').html("");
  var Error1=false;
  $.ajax({
      type: 'POST',
      data: { idequipo: idequipo},
      url: 'Componente/getcompo', //index.php/ getcompo
      success: function(data){                  
          console.log(data); 
          if (data!= 0) {
            var de = data[0]['descripcion']; 
            var comp = data[0]['dee11'];
            $('#descrip').val(de); 
            
            for(var i=0; i < data.length ; i++){
              
            var  table= "<tr id='"+i+"'>"+   
                          "<td ></td>"+
                         "<td>"+data[i]['dee11']+"</td>"+
                         "<td class='hidden' id='"+data[i]['id_componente']+"' >"+data[i]['id_componente']+"</td>"+
                         
                       "</tr>";
              $('#tablacompo').append(table); 
              s++;
          }
         
         
          console.log(table);
          console.log(s);
          $('#tablacompo').val('');

          }
           else{
           traer_descripcion(idequipo); 

              //var d='NO HAY Descripción CARGADA';
             // $('#tablacompo').append(d); 
              
        
            
          } 

            },
           
        
      error: function(result){
            //alert("error entr en la otra consulta");
            console.log(result);
           traer_descripcion(idequipo);
          },
          dataType: 'json'
      });


});

</script>
  


























 