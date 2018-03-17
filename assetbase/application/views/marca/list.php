<input type="hidden" id="permission" value="<?php echo $permission;?>">
<section class="content">
  <div class="row">
    <div class="col-xs-12">
      <div class="box">
        <div class="box-header">
        <br>
          <h3 class="box-title">Marca</h3>
          <?php
            if (strpos($permission,'Add') !== false) {
              echo '<button class="btn btn-block btn-success" style="width: 100px; margin-top: 10px;" data-toggle="modal" data-target="#modalmarca" id="btnAdd">Agregar</button>';
            }
          ?>
        </div><!-- /.box-header -->
        <div class="box-body">
          <table id="marca" class="table table-bordered table-hover" style="text-align: center">
            <thead>
              <tr>
                <th  width="20%" style="text-align: center">Acciones</th>
                <th style="text-align: center">Descripción</th>
              </tr>
            </thead>
            <tbody>
              <?php
                foreach($list as $z)
                {
                  $id=$z['marcaid'];
                  if ($z['estado'] =='AC'){
                
                    echo '<tr id="'.$id.'" class="'.$id.'" >';
                    echo '<td>';
                  if (strpos($permission,'Edit') !== false) {
                      echo '<i class="fa fa-fw fa-pencil" style="color: #A4A4A4; cursor: pointer; margin-left: 15px;" title="Editar" data-toggle="modal" data-target="#modaleditar"></i>';
                  }
                  if (strpos($permission,'Del') !== false) {
                      echo '<i class="fa fa-fw fa-times-circle" style="color: #A4A4A4; cursor: pointer; margin-left: 15px;" title="Eliminar" data-toggle="modal" data-target="#modalaviso"></i>';
                  }
                    
                  echo '</td>';
                  echo '<td style="text-align: center">'.$z['marcadescrip'].'</td>';
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
var ed="";
var gloid="";
$(document).ready(function(event) {

  

   //Editar
  $(".fa-pencil").click(function (e) { 
     
    var id_mar = $(this).parent('td').parent('tr').attr('id');
    ed=id_mar;
    console.log("ID de marca");
    console.log(id_mar);
    console.log("Variable global con id d marca");
    console.log(ed);
   
    $.ajax({
        type: 'GET',
        data: { id_mar:id_mar},
        url: 'index.php/Marca/getpencil', //index.php/
        success: function(data){
                console.log("Estoy editando");           
                console.log(data);
                //console.log(data['descripcion']);
                console.log(data[0]['marcadescrip']);
                //console.log(data['datos'][0]['descripcion']);
               
                datos={

                  'descripcion':data[0]['marcadescrip']
                  
                  
                }

               
                
                console.log("datos a enviar");
                console.log(datos);

                completarEdit(datos);
                             
            
              },
          
        error: function(result){
              
              console.log(result);
            },
            dataType: 'json'
        });
  
  });

  //Cambio de estado a un equipo
  $(".fa-times-circle").click(function (e) { 
                 
         
    console.log("Esto eliminando"); 
    var idm = $(this).parent('td').parent('tr').attr('id');
    console.log("ESTOY ELIMINANDO , el id de marca es:");
    console.log(idm);
    gloid=idm;
    
  });

  $('#marca').DataTable({
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
 

function completarEdit(datos){

  console.log("datos que llegaron");
  $('#descripcionedit').val(datos['descripcion']);
}
  
function guardareditar(){
  console.log("Estoy editando");
  console.log("El id de marca es:"); 
  console.log(ed);
    
  var descripcion = $('#descripcionedit').val();

  var parametros = {
        'marcadescrip': descripcion
    
  };                                              
  console.log(parametros);
  var hayError = false; 

  if( parametros !=0)
    {                                     
    $.ajax({
      type:"POST",
      url: "index.php/Marca/edit_marca", //controlador /metodo
      data:{parametros:parametros, ed:ed},
      success: function(data){
        console.log("exito ");
        regresa();     
        },
      
      error: function(result){
          console.log("entro por el error");
          console.log(result);
      }
      // dataType: 'json'
    });
   
  }
  else 
  { 
    alert("Por favor complete la descripcion del grupo, es un campo obligatorio");
  }

}



function guardar(){

  console.log("Estoy guardando");
  var descripcion = $('#descripcion').val();
 

  var parametros = {
        'marcadescrip': descripcion,
        'estado': 'AC'
  };                                              
  console.log(parametros);
  var hayError = false; 

  if( parametros !=0)
    {                                     
    $.ajax({
      type:"POST",
      url: "index.php/Marca/agregar_marca", //controlador /metodo
      data:{parametros:parametros},
      success: function(data){
        console.log("exito ");
        
           regresa();

        },
      
      error: function(result){
          console.log("entro por el error");
          console.log(result);
      }
      // dataType: 'json'
    });
   
  }
  else 
  { 
    alert("Por favor complete toda la informacion para poder guardar");

  }

}

function regresa(){

  $("#content").load("<?php echo base_url(); ?>index.php/Marca/index/<?php echo $permission; ?>");
  WaitingClose();
}

function eliminarmarca(){

  //var idpre = $(this).parent('td').parent('tr').attr('id');
  console.log("Estoy por la opcion SI a eliminar")
  console.log(gloid);
          
  $.ajax({
    type: 'POST',
    data: { gloid: gloid},
    url: 'index.php/Marca/baja_marca', //index.php/
    success: function(data){
            //var data = jQuery.parseJSON( data );
            console.log(data);  
            regresa();
          },
      
    error: function(result){
          
          console.log(result);
        }
        //dataType: 'json'
  });

}

</script>


<!-- Modal alta de marca-->
 <div class="modal fade" id="modalmarca" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-lg" role="document" style="width: 60%">
    <div class="modal-content">

      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title"  id="myModalLabel"><span id="modalAction" class="fa fa-plus-square" style="color: #A4A4A4" > </span>  Agregar Marca</h4>
       </div> <!-- /.modal-header  -->

      <div class="modal-body input-group ui-widget" id="modalBodyArticle">
        
        <div class="row" >
          <div class="col-sm-12 col-md-12">
        <div class="col-xs-12">Descripción:
          <input type="text" id="descripcion" name="descripcion" class="form-control" placeholder="Ingrese Nombre o Descripción...">
        </div>
        <br>
        <br>
      </div>
      </div>
      </div>
      <div class="modal-footer">
       
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
        <button type="button" class="btn btn-primary" id="btnSave" data-dismiss="modal" onclick="guardar()" >Guardar</button>
      </div>  <!-- /.modal footer -->

       </div>  <!-- /.modal-body -->
    </div> <!-- /.modal-content -->

  </div>  <!-- /.modal-dialog modal-lg -->
</div>  <!-- /.modal fade -->
<!-- / Modal -->


<!-- Modal editar-->
 <div class="modal fade" id="modaleditar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-lg" role="document" style="width: 60%">
    <div class="modal-content">

      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title"  id="myModalLabel"><span id="modalAction" class="fa fa-fw fa-pencil" style="color: #A4A4A4" > </span> Editar Marca</h4>
       </div> <!-- /.modal-header  -->

      <div class="modal-body input-group ui-widget" id="modalBodyArticle">
        
        <div class="row" >
          <div class="col-sm-12 col-md-12">
        <div class="col-xs-12">Descripción:
          <input type="text" id="descripcionedit" name="descripcion" class="form-control" >
        </div>
        <br>
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

<div class="modal fade" id="modalaviso">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" ><span class="fa fa-fw fa-times-circle" style="color:#A4A4A4"></span>  Eliminar</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true" >&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <center>
        <h4><p>¿ DESEA ELIMINAR MARCA ?</p></h4>
        </center>
      </div>
      <div class="modal-footer">
        <center>
        <button type="button" class="btn btn-primary" data-dismiss="modal" onclick="eliminarmarca()">SI</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">NO</button>
        </center>
      </div>
    </div>
  </div>
</div>