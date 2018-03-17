<input type="hidden" id="permission" value="<?php echo $permission;?>">
<section class="content">
  <div class="row">
    <div class="col-xs-12">
      <div class="box">
        <div class="box-header">
          <h3 class="box-title">Deposito</h3>
          <?php
            if (strpos($permission,'Add') !== false) {
              echo '<button class="btn btn-block btn-success" style="width: 100px; margin-top: 10px;" data-toggle="modal" data-target="#modaldeposito" id="btnAdd">Agregar</button>';
            }
          ?>
        </div><!-- /.box-header -->
        <div class="box-body">
          <table id="deposito" class="table table-bordered table-hover" style="text-align: center">
            <thead>
              <tr>
                <th  width="20%" style="text-align: center">Acciones</th>
                <th style="text-align: center">Descripción</th>
                <th style="text-align: center">Direccion</th>
              </tr>
            </thead>
            <tbody>
              <?php
                foreach($list as $z)
                {
                  $id=$z['depositoId'];
                
                    echo '<tr id="'.$id.'" class="'.$id.'" >';
                    echo '<td>';
                  if (strpos($permission,'Edit') !== false) {
                      echo '<i class="fa fa-fw fa-pencil" style="color: #A4A4A4; cursor: pointer; margin-left: 15px;" title="Editar" data-toggle="modal" data-target="#modaleditar"></i>';
                  }
                  if (strpos($permission,'Del') !== false) {
                      echo '<i class="fa fa-fw fa-times-circle" style="color: #A4A4A4; cursor: pointer; margin-left: 15px;"></i>';
                  }
                  
                      
                  echo '</td>';
                  echo '<td style="text-align: center">'.$z['depositodescrip'].'</td>';
                  echo '<td style="text-align: center">'.$z['direccion'].'</td>';
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
$(document).ready(function(event) {

  

   //Editar
  $(".fa-pencil").click(function (e) { 
     
    var id_depo = $(this).parent('td').parent('tr').attr('id');
    ed=id_depo;
    console.log("ID de deposito");
    console.log(id_depo);
    console.log("Variable global con id d deposito");
    console.log(ed);
   
    $.ajax({
        type: 'GET',
        data: { id_depo:id_depo},
        url: 'index.php/Deposito/getpencil', //index.php/
        success: function(data){
                console.log("Estoy editando");           
                console.log(data);
                //console.log(data['descripcion']);
                console.log(data[0]['depositodescrip']);
                //console.log(data['datos'][0]['descripcion']);
               
                datos={
                  

                  'descripcion':data[0]['depositodescrip'],
                  'direccion':data[0]['direccion'],
                  
       
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
    var id_depo = $(this).parent('td').parent('tr').attr('id');
    console.log(id_depo);
    
    $.ajax({
            type: 'POST',
            data: { id_depo: id_depo},
            url: 'index.php/Deposito/baja_deposito', //index.php/
            success: function(data){
                    //var data = jQuery.parseJSON( data );
                    console.log(data);
                   
                    //$(tr).remove();
                    alert("Deposito Eliminado");
                    regresa();
                  
                  },
              
            error: function(result){
                  
                  console.log(result);
                },
                dataType: 'json'
      });

   
    
  });

  $('#deposito').DataTable({
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

  $('#direccionedit').val(datos['direccion']);
  $('#descripcionedit').val(datos['descripcion']);
}
  
function guardareditar(){
  console.log("Estoy editando");
  console.log("El id de deposito es:"); 
  console.log(ed);
    
  var descripcion = $('#descripcionedit').val();
  var direccion = $('#direccionedit').val(); 

  var parametros = {
        'depositodescrip': descripcion,
        'direccion': direccion
        
  };                                              
  console.log(parametros);
  var hayError = false; 

  if( parametros !=0)
    {                                     
    $.ajax({
      type:"POST",
      url: "index.php/Deposito/edit_deposito", //controlador /metodo
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



function guardar(){
  console.log("Estoy guardando");
  var descripcion = $('#descripcion').val();
  var direccion = $('#direccion').val(); 

  var parametros = {
        'depositodescrip': descripcion,
        'direccion': direccion
        
  };                                              
  console.log(parametros);
  var hayError = false; 

  if( parametros !=0)
    {                                     
    $.ajax({
      type:"POST",
      url: "index.php/Deposito/agregar_deposito", //controlador /metodo
      data:{parametros:parametros},
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
    alert("Por favor complete toda la informacion para poder guardar");

  }

}

function regresa(){

  //WaitingOpen();
  //$('#modaldeposito').empty();
  //$('#modaleditar').empty(); 
  //$('#content').empty();
  $("#content").load("<?php echo base_url(); ?>index.php/Deposito/index/<?php echo $permission; ?>");
   WaitingClose();
}

  

</script>


<!-- Modal alta de deposito-->
 <div class="modal fade" id="modaldeposito" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-lg" role="document" style="width: 60%">
    <div class="modal-content">

      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title"  id="myModalLabel"><span id="modalAction" class="fa fa-plus-square" style="color: #008000" > </span>  Agregar Deposito</h4>
       </div> <!-- /.modal-header  -->

      <div class="modal-body input-group ui-widget" id="modalBodyArticle">
        
        <div class="row" >
          <div class="col-sm-12 col-md-12">
        <div class="col-xs-12">Descripcion:
          <input type="text" id="descripcion" name="descripcion" class="form-control" placeholder="Ingrese Descripcion de desposito...">
        </div>
        <br>
        <div class="col-xs-12">Direccion:
        <input type="text" id="direccion" name="direcciont" class="form-control" placeholder="Ingrese Direccion..." >
                                      
        </div>
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
        <h4 class="modal-title"  id="myModalLabel"><span id="modalAction" class="fa fa-fw fa-pencil" style="color: #f39c12" > </span> Editar Deposito</h4>
       </div> <!-- /.modal-header  -->

      <div class="modal-body input-group ui-widget" id="modalBodyArticle">
        
        <div class="row" >
          <div class="col-sm-12 col-md-12">
        <div class="col-xs-12">Descripcion:
          <input type="text" id="descripcionedit" name="descripcion" class="form-control" placeholder="Ingrese Descripcion de desposito">
        </div>
        <br>
        <div class="col-xs-12">Direccion:
        <input type="text" id="direccionedit" name="direccionedit" class="form-control" placeholder="Ingrese Direccion" >
                                      
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