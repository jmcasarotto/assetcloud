<input type="hidden" id="permission" value="<?php echo $permission;?>">
<section class="content">
  <div class="row">
    <div class="col-xs-12">
      <div class="box">
        <div class="box-header">
          <h3 class="box-title">Contratistas</h3>
          <?php
          if (strpos($permission,'Add') !== false) {
            echo '<button class="btn btn-block btn-success" style="width: 100px; margin-top: 10px;" data-toggle="modal" onclick="Loadcontratista(0,\'Add\')" id="btnAdd" title="Nueva">Agregar</button>';
          }
          ?>
        </div><!-- /.box-header -->
        <div class="box-body">
          <table id="contratista" class="table table-bordered table-hover">
            <thead>
              <tr>
                <th width="20%">Acciones</th>
                <th>Descripción</th>
                <th>Direccion</th>
                <th>Email</th>
                <th>Email Alternativo </th>
                <th>Celular 1</th>
                <th>Celular 2</th>
                <th>telefono</th>
                <th>Contacto</th>
              </tr>
            </thead>
            <tbody>
              <?php
                foreach($list as $f)
                {
                  //var_dump($u);
                    $id=$f['id_contratista'];
                
                    echo '<tr id="'.$id.'" class="'.$id.'" >';
                    echo '<td>';

                  if (strpos($permission,'Edit') !== false) {
                
                    echo '<i class="fa fa-fw fa-pencil" style="color: #A4A4A4; cursor: pointer; margin-left: 15px;" title="Editar" data-toggle="modal" data-target="#modaleditar"></i>';
                    
                    }
                  if (strpos($permission,'Del') !== false) {
                   echo '<i class="fa fa-fw fa-times-circle" title="Eliminar" style="color: #A4A4A4; cursor: pointer; margin-left: 15px;" ></i>';
                  }
                  
                  echo '</td>';
                  echo '<td style="text-align: left">'.$f['nombre'].'</td>';
                  echo '<td style="text-align: left">'.$f['contradireccion'].'</td>';
                  echo '<td style="text-align: left">'.$f['contramail'].'</td>';
                  echo '<td style="text-align: left">'.$f['contramail1'].'</td>';
                  echo '<td style="text-align: left">'.$f['contracelular1'].'</td>';
                  echo '<td style="text-align: left">'.$f['contracelular2'].'</td>';
                  echo '<td style="text-align: left">'.$f['contratelefono'].'</td>';
                  echo '<td style="text-align: left">'.$f['contracontacto'].'</td>';
                  echo '</tr>';
                  
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
var ed="";
var idFamily = 0;
var acFamily = '';
$(document).ready(function(event) {
 
  //Cambio de estado a un contratista
  $(".fa-times-circle").click(function (e) { 
                 
         
    console.log("Esto eliminando"); 
    var idpa = $(this).parent('td').parent('tr').attr('id');
    console.log(idpa);
    
    $.ajax({
            type: 'POST',
            data: { idpa: idpa},
            url: 'index.php/Contratista/baja_contratista', //index.php/
            success: function(data){
                    //var data = jQuery.parseJSON( data );
                    console.log(data);
                   
                    //$(tr).remove();
                    alert("CONTRATISTA Eliminado");
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
     
    var id_pa = $(this).parent('td').parent('tr').attr('id');
    console.log("ID de contratista");
    console.log(id_pa);
    ed=id_pa;
    $.ajax({
        type: 'GET',
        data: { id_pa:id_pa},
        url: 'index.php/Contratista/getpencil', //index.php/
        success: function(data){
                console.log("Estoy editando");           
                console.log(data);
               
               
                datos={
             
                  'nombre':data[0]['nombre'],
                  'direccion':data[0]['contradireccion'],
                  'mail':data[0]['contramail'],
                  'mail1':data[0]['contramail1'],
                  'celu1':data[0]['contracelular1'],
                  'celu2':data[0]['contracelular2'],
                  'tel':data[0]['contratelefono'],
                  'contacto':data[0]['contracontacto'],
               
                }

              
                completarEdit(datos);
                             
            
              },
          
        error: function(result){
              
              console.log(result);
            },
            dataType: 'json'
        });
  
  });

  $('#btnSave').click(function(){
    
    if(acCobrador== 'View')
    {
      $('#modalCobrador').modal('hide');
      return;
    }

    var hayError = false;
    if($('#nombre').val() == '')
    {
      hayError = true;
    }
    if($('#direccion').val() == '')
    {
      hayError = true;
    }
    if($('#mail').val() == '')
    {
      hayError = true;
    }
    if($('#telefono').val() == '')
    {
      hayError = true;
    }

    if(hayError == true){
      $('#error').fadeIn('slow');
      return;
    }

    $('#error').fadeOut('slow');
    WaitingOpen('Guardando cambios');
      $.ajax({
            type: 'POST',
            data: { 
                    id : idCobrador, 
                    act: acCobrador, 
                    name: $('#nombre').val(),
                    dir: $('#direccion').val(),
                    mai: $('#mail').val(),
                    mai1: $('#mail').val(),
                    cel1: $('#cel1').val(),
                    cel2: $('#cel2').val(),
                    tel: $('#telefono').val(),
                    cont: $('#cont').val(),
                  },
        url: 'index.php/Contratista/setcontratista', 
        success: function(result){
                      WaitingClose();
                      $('#modalContratista').modal('hide');
                      setTimeout("cargarView('Contratista', 'index', '"+$('#permission').val()+"');",1000);
              },
        error: function(result){
              WaitingClose();
              alert("error");
            },
            dataType: 'json'
        });
  });

  $('#contratista').DataTable({
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
  
function Loadcontratista(id_, action){
  idCobrador = id_;
  acCobrador = action;
  LoadIconAction('modalAction',action);
  WaitingOpen('Cargando Contratista');
    $.ajax({
          type: 'POST',
          data: { id : id_, act: action },
      url: 'index.php/Contratista/getcontratista', 
      success: function(result){
                    WaitingClose();
                    $("#modalBodycontratista").html(result.html);
                    setTimeout("$('#modalContratista').modal('show')",800);
            },
      error: function(result){
            WaitingClose();
            alert("error");
          },
          dataType: 'json'
      });
}

function completarEdit(datos){

  console.log("datos que llegaron");
  $('#nombre').val(datos['nombre']);
  $('#direccion').val(datos['direccion']);
  $('#mail').val(datos['mail']);
  $('#mail1').val(datos['mail1']);
  $('#tel1').val(datos['celu1']);
  $('#cel2').val(datos['celu2']);
  $('#telefono').val(datos['tel']);
  $('#cont').val(datos['contacto']);
}

function regresa(){

  $("#content").load("<?php echo base_url(); ?>index.php/Contratista/index/<?php echo $permission; ?>");
   WaitingClose();
}

function guardareditar(){
  console.log("Estoy editando");
  console.log("El id de contratista es:"); 
  console.log(ed);
    
  var nombre = $('#nombre').val();
  var direccion = $('#direccion').val();
  var mail = $('#mail').val();
  var mail1 = $('#mail1').val();
  var cel1 = $('#tel1').val();
  var cel = $('#cel2').val();
  var telefono = $('#telefono').val();
  var contacto = $('#cont').val();

  
  var parametros = {
        'nombre': nombre,
        'contradireccion': direccion,
        'contramail': mail,
        'contramail1': mail1,
        'contracelular1': cel1,
        'contracelular2': cel,
        'contratelefono': telefono,
        'contracontacto': contacto

        
        
  };                                              
  console.log(parametros);
  var hayError = false; 

  if( parametros !=0)
    {                                     
    $.ajax({
      type:"POST",
      url: "index.php/Contratista/edit_contratista", //controlador /metodo
      data:{parametros:parametros, ed:ed},
      success: function(data){
        console.log("exito ");
        regresa();     
        },
      
      error: function(result){
          console.log("entro por el error");
          console.log(result);
      },
      // dataType: 'json'
    });
   
  }
  else 
  { 
    alert("Por favor complete la descripcion del grupo, es un campo obligatorio");
  }

}



</script>


<!-- Modal -->
<div class="modal fade" id="modalContratista" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel"><span id="modalAction"> </span> Contratista</h4> 
      </div>
      <div class="modal-body" id="modalBodycontratista">
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
        <button type="button" class="btn btn-primary" id="btnSave">Guardar</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal editar-->
 <div class="modal fade" id="modaleditar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-lg" role="document" style="width: 60%">
    <div class="modal-content">

      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title"  id="myModalLabel"><span id="modalAction" class="fa fa-fw fa-pencil" style="color: #f39c12" > </span>  Editar Contratista</h4>
       </div> <!-- /.modal-header  -->

      <div class="modal-body input-group ui-widget" id="modalBodyArticle">
        
        <div class="row" >
          <div class="col-sm-12 col-md-12">
       

        <div class="col-xs-8">Nombre <strong style="color: #dd4b39">*</strong>: </label>
          <input type="text" class="form-control"  id="nombre" name="nombre" >
        </div>
    
        <div class="col-xs-8"> Direccion <strong style="color: #dd4b39">*</strong>: </label>
          <input type="text" class="form-control"  id="direccion" name="direccion">
        </div>

        <div class="col-xs-8">Mail <strong style="color: #dd4b39">*</strong>: </label>
          <input type="text" class="form-control"  id="mail" name="mail"  >
        </div>

      <div class="col-xs-8">Mail Alternativo<strong style="color: #dd4b39">*</strong>: </label>
        <input type="text" class="form-control"  id="mail1" nme="mail1">
      </div>

      <div class="col-xs-8"> Celular 1 <strong style="color: #dd4b39">*</strong>: </label>
        <input type="text" class="form-control"  id="cel1" name="cel1" >
    </div>
    
    <div class="col-xs-8">Celular 2 <strong style="color: #dd4b39">*</strong>: </label>
     
        <input type="text" class="form-control"  id="cel2" name="cel2" >
    </div>
    <div class="col-xs-8">Telefono <strong style="color: #dd4b39">*</strong>: </label>
   
        <input type="text" class="form-control"  id="telefono" name="telefono" >
      </div>

    <div class="col-xs-8">Contacto <strong style="color: #dd4b39">*</strong>: </label>
        <input type="text" class="form-control" id="cont" name="cont">
    </div>
    
        
      </div>
      </div>
      </div>
      
     

      <div class="modal-footer">
       
        <button type="button" class="btn btn-primary btn-sm" data-dismiss="modal" ata-dismiss="modal" onclick="guardareditar()" >Guardar</button>
      </div>  <!-- /.modal footer -->

       </div>  <!-- /.modal-body -->
    </div> <!-- /.modal-content -->

  </div>  <!-- /.modal-dialog modal-lg -->
</div>  <!-- /.modal fade -->
<!-- / Modal -->