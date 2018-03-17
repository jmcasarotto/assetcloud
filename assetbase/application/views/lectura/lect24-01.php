  <!--   <input type="hidden" id="permission" value="<?php //echo $permission;?>">   -->
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
          <h2 class="box-title ">Carga de Lectura</h2>
        </div><!-- /.box-header -->
        <div class="box-body">
          <!-- form  -->
          <form  id="form_order" action="" accept-charset="utf-8">
            
            <div class="row" >
              <div class="col-sm-12 col-md-12">
                <br>
                <fieldset><legend></legend></fieldset>
                <br>
                  <div class="col-xs-4">Equipos:
                    <select id="equipo" name="equipo" class="form-control"  />
                    <input type="hidden" id="id_equipo" name="id_equipo">
                  </div>
                  
                  <div class="col-xs-4">Parametro:
                    <select id="parametro" name="parametro" class="form-control"  />
                  </div>
                  <div class="col-xs-4">valor:
                    <input type="text" name="valor" id="valor" class="form-control"  />
                  </div>
                  <div class="col-xs-4">
                    <button type="button" class="btn btn-success" id="add"><i class="fa fa-check"></i>Agregar</button>
                  </div>
                
              </div>
            </div>

            <div class="row">
              <div class="col-xs-10 col-xs-offset-1">
                <table class="table table-bordered" id="tablaparametro"> 
                  <thead>
                    <tr>                           <!--no encuentro la x <i class="fa fa-fw fa-times-circle" style="color: #dd4b39; cursor: pointer; margin-left: 15px;" -->
                      <br>
                      <th width="35px"></th>
                      <th width="10%"></th>
                      <th></th>
                      <th width="10%"></th>
                       
                      </tr>
                  </thead>
                  <tbody></tbody>
                </table> 
                <fieldset><legend></legend></fieldset> 
              </div>
            </div>      
            <div class="modal-footer">
              <button type="button" class="btn btn-danger btn-sm delete">Cancelar</button>
              <button type="button" class="btn btn-primary btn-sm" onclick="guardar()">Guardar</button>
            </div>  <!-- /.modal footer -->

            <!-- / Modal -->
          </form>
        </div><!-- /.box-body -->
      </div><!-- /.box -->
    </div><!-- /.col -->
  </div><!-- /.row -->
</section><!-- /.content -->


<script>

traer_equipo();

$('#equipo').change(function(){
      var id_equipo = $(this).val();
      console.log(id_equipo);
      traer_parametro(id_equipo);
  });

function traer_equipo(){
      $.ajax({
        type: 'POST',
        data: { },
        url: 'index.php/Lectura/getequipo', //index.php/
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

  function traer_parametro(id_equipo){
    $.ajax({
          type: 'POST',
          data: { id_equipo: id_equipo},
          url: 'index.php/Lectura/getparametros',  //index.php/
          async:false,
          success: function(data){
                  //var data = jQuery.parseJSON( data );
                  
                  //console.log(data);
                  $('#parametro option').remove();
                   var opcion  = "<option value='-1'>Seleccione...</option>" ; 
                  $('#parametro').append(opcion); 
                  for(var i=0; i < data.length ; i++) 
                  {   
                    //console.log( data[i]);
                        var nombre = data[i]['paramdescrip']; 
                        var opcion  = "<option value='"+data[i]['paramId']+"'>" +nombre+ "</option>" ; 

                      $('#parametro').append(opcion);                
                  }
                },
          error: function(result){
                
                console.log(result);
              },
              dataType: 'json'
          });
  }


  $("#add").click(function (e) {

        var $equipo = $("select#equipo option:selected").html();

        var id_equipo= $('#id_equipo').val();
        var equipo = $('#equipo').val();
        //var parametro = $('#parametro').val();
        var $parametro = $("select#parametro option:selected").html();
        var $valor = $('#valor').val();
        //var datos=Array();
        //datos=marca.split('%%');  //class='quitarEquipo'
        //var datos=Array();
        //datos=parametro.split('');
         
        /*<a id='quitarEquipo_"+id_equipo+"' class=' glyphicon glyphicon-remove-circle' style='cursor:pointer'>x</a>
        ' glyphicon glyphicon-remove-circle' */
        var tr = "<tr>"+
                    "<td ><a id='quitarEquipo_"+id_equipo+"' class='quitarEquipo' style='cursor:pointer'>X</a></td>"+
                    "<td>"+$equipo+"</td>"+
                    "<td>"+$parametro+"</td>"+
                    //"<td>"+parametro[1]+"</td>"+
                    "<td>"+$valor+"</td>"+
                    
                "</tr>";
   

        $('#tablaparametro tbody').append(tr);
        
        $("#quitarEquipo_"+id_equipo).click(function (e) {
          //alert('quitar');
          $(this).parent('td').parent('tr').remove();
        });
       
       $('#equipo').val('');
       /*$('#parametro').val(''); 
       $('#valor').val(''); */
       

    });

  function guardar()
  { 

        var equipo = $('#equipo').val();
        var parametro= $('#parametro').val();
        var valor = $('#valor').val();
        
        var idsparametro = new Array();     
        $("#tablaequipos tbody tr").each(function (index) 
        {
         
            //var ide = $(this).attr('id');
            var ide = $(this).parent('td').parent('tr').attr('id');
            idsparametro.push(ide);            
          
        });  

       // console.log(idsequipos);

        var parametros = {
            'id_equipo': equipo,
            'paramId': parametro,     
            'valor': valor,
            //'variab' : variable,
        };

         
          $.ajax({
              type: 'POST',
              data: {data:parametros, idsparametro:idsparametro },
              url: 'index.php/Lectura/guardar_lectura',  //index.php/
              success: function(data){
                     // var data = jQuery.parseJSON( result );
                      
                      $('#modalSale').modal('hide');

                       setTimeout(function(){
                             var permisos = '<?php //echo $permission; ?>';
                            cargarView('lectura', 'index', permisos) ; 
                      },3000); // 3000ms = 3s
                     
                    },
              error: function(result){
                    
                    console.log(result);
                    $('#modalSale').modal('hide');
                  },
                  dataType: 'json'
              });

</script>




























 