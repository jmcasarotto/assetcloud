<input type="hidden" id="permission" value="<?php echo $permission;?>">  
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
            <!-- nº factura  -->
            <div class="row" >
              <div class="col-sm-12 col-md-12">
                <br>

                  <fieldset><legend></legend></fieldset>  
                  <br>
                    <div class="col-xs-3">Equipos <strong style="color: #dd4b39">*</strong>:
                      <select id="equipo" name="equipo" class="form-control"  />
                      <input type="hidden" id="id_equipo" name="id_equipo"/>
                    </div>
                                  
                    <div class="col-xs-3">Parametro <strong style="color: #dd4b39">*</strong>:
                       <select id="parametro" name="parametro" class="form-control"  />
                       <input type="hidden" id="id_parametro" name="id_parametro"/>
                    </div>
                    <div class="col-xs-3">valor <strong style="color: #dd4b39">*</strong>:
                       <input type="text" name="valor" id="valor" class="form-control" placeholder="Ingrese Valor"  />
                      
                    </div>
                    <br>
                    <div class="col-xs-3">
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
                    <th width="5%"></th>
                    <th width="20%"></th>
                    <th width="20%"></th>
                    <th width="20%"></th>
                 
                  </tr>
                  </thead>
                  <tbody></tbody>
                </table> 
                <fieldset><legend></legend></fieldset> 
              </div>
            </div>
            <br>
            <div class="modal-footer">
                   <!--  <button type="button" class="btn btn-danger btn-sm delete" onclick="limpiarModal()">Cancelar</button>
                    <button type="button" class="btn btn-primary btn-sm" data-dismiss="modal" onclick="guardar()">Guardar</button> -->
              <button  type="button" class="btn btn-block btn-success" style="width: 100px; margin-top: 10px;"  data-dismiss="modal"  onclick="regresa()">LIMPIAR</button>
            </div>  <!-- /.modal footer -->
          </form>
        </div>
      </div>
    </div>
  </div>  <!-- /.modal fade -->
           
</section><!-- /.content -->


<!-- Ultimo id table -->
<script>
var gloparam="";
var gloequip="";
var glovalor="";
traer_equipo();

$('#equipo').change(function(){

    var id_equipo = $(this).val();
    console.log(id_equipo);
    // traer_parametro(id_equipo);

    $('#parametro').html("");
    console.log("el ultimo ");
    console.log(id_equipo);
    $.ajax({
          type: 'POST',
          data: { id_equipo: id_equipo},
          url: 'index.php/Lectura/getparametros',  //index.php/
          //async:false,
          success: function(data){
                  //var data = jQuery.parseJSON( data );
                  console.log(data);
                  //console.log(data);
                  //$('#parametro option').remove();
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
    });

function traer_equipo(){
   $('#equipo').html(''); 
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

/*function traer_parametro(id_equipo){
    $('#parametro').html("");
    console.log("el ultimo ");
    console.log(id_equipo);
    $.ajax({
          type: 'POST',
          data: { id_equipo: id_equipo},
          url: 'index.php/Lectura/getparametros',  //index.php/
          //async:false,
          success: function(data){
                  //var data = jQuery.parseJSON( data );
                  console.log(data);
                  //console.log(data);
                  //$('#parametro option').remove();
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
}*/


    var valorglob="";
    var paramglob="";
$("#add").click(function (e) {

    var $equipo = $("select#equipo option:selected").html();

    var id_equipo= $('#equipo').val();  //obtengo el valor del select parametro
    var equipo = $('#equipo').val();
    //var parametro = $('#parametro').val();
    var $parametro = $("select#parametro option:selected").html();
    var parametro= $('#parametro').val(); //obtengo el valor del select parametro
    var id_parametro= $('#parametro').val();
    var valor = $('#valor').val();  //obtengo el valor de la variable valor
    //valorglob=valor;
    //paramglob=parametro;

    console.log("el quipo seleccionado es:"+ id_equipo);
    console.log("el valor ingresado es :" + valor);
    console.log("el parametro seleccionado es :" + parametro);
    console.log("el id del parametro es :" + id_parametro);
    //</i><i class='fa fa-ban elirow' style='color: #f39c12'; cursor: 'pointer'></i>

    var tr = "<tr id='"+id_parametro+"'>"+
                "<td ><i class='fa fa-fw fa-times-circle' style='color: #A4A4A4' cursor: 'pointer' margin-left: '15px' title='Eliminar' ></td>"+
                "<td>"+$equipo+"</td>"+
                "<td>"+$parametro+"</td>"+
                "<td>"+valor+"</td>"+
                
            "</tr>";

var hayError = false;
gloparam=id_equipo;
gloequip=id_parametro;
glovalor=valor;
 if (id_parametro >0 && id_equipo >0 ){ 

    if (valor !=0 ) {
      $('#tablaparametro tbody').append(tr);
      $.ajax({
          type: 'POST',
          data: {id_equipo:id_equipo, id_parametro:id_parametro, valor:valor },
          url: 'index.php/Lectura/guardar_parametro',  //index.php/
          success: function(data){
                  console.log(data);
                  console.log("EXITO");
                  
                },
          error: function(result){
                
                console.log(result);
                
              }
              //dataType: 'json'
      });


    }
    else
      {  hayError=true;
     $('#error').fadeIn('slow');
         return;
      }

  }
  else {  
    hayError=true;
    $('#error').fadeIn('slow');
    return;
  }
   
   $(document).on("click",".fa-times-circle",function(){

      var parent = $(this).closest('tr');
      console.log(parent);
      console.log(gloparam);
      console.log(gloequip);
      console.log(glovalor);


      $.ajax({
              type: 'POST',
              data: { gloequip: gloequip,gloparam:gloparam, glovalor:glovalor},
              url: 'index.php/Lectura/bajaparametro', //index.php/
              success: function(data){
                      console.log("Exito");
                      console.log(data);
                      $(parent).remove();
                      alert("Lectura ELIMINADA");
                      //regresa();
                      // var parent = $(this).closest('tr');
                      
                       
                    },
                
              error: function(result){
                    console.log("Entre por el error");
                    console.log(result);
                  }
             // dataType: 'json'
      });


    });     
              
  
  // $(document).on("click",".elirow",function(){
  //     var parent = $(this).closest('tr');
  //     $(parent).remove();
  // });
   
  if(hayError == false){
     $('#error').fadeOut('slow');
  }

  $('#equipo').val('');
  $('#parametro').val(''); 
  $('#valor').val(''); 
   

  });

// function guardar(){ 
       
        
//   var idparam = new Array();     
//   $("#tablaparametro tbody tr").each(function (index) 
//   {
   
//       var id_parametro = $(this).attr('id');
      
        
//       idparam.push(id_parametro);
        
//   });  

//   comp2 = {};
//   $("#tablaparametro tbody tr").each(function (index) 
//   {
//     var id_parametro = $(this).attr('id'); 
//    // console.log(id_parametro);  
//     $(this).children("td").each(function (index2) 
//     {
//       if (index2) {
                  
//         comp2[id_parametro]=$(this).text();
//       }
                
//     });

//     console.log(comp2);

//   });

//   var parametros = {
      
//       'id_equipo': $('#equipo').val(),
     
//   };
//   console.log("id de Equipos:");
//   console.log(parametros);
//   console.log("id del param:");
//   console.log(idparam);
//   console.log("id de param:");
//   console.log(comp2);

//  var hayError = false;
// if (parametros != -1  && idparam != -1 && comp2 != -1)
//   { 
//     $.ajax({
//         type: 'POST',
//         data: {data:parametros, idparam:idparam, comp2:comp2 },
//         url: 'index.php/Lectura/guardar_parametro',  //index.php/
//         success: function(data){
//                 console.log(data);
//                 console.log("EXITO");
                
//               },
//         error: function(result){
              
//               console.log(result);
              
//             },
//             dataType: 'json'
//         });

//     limpiarModal();
//   }
//   else 
//     { 
//       hayError=true;
//       $('#error').fadeIn('slow');

//     }


//     if(hayError == false){
//           $('#error').fadeOut('slow');
//        }

// }


</script>
<script>
function limpiarModal(){
      $("#equipo").val("");
      $("#valor").val("");
       $("#parametro").val("");
      //$("#tablacompo").val("");
      //$("#tablaequipos").val("");
      //$('#tablacompo tbody tr').remove();

      $('#tablaparametro tbody tr').remove();
}

// function eliminarpred(){

//   console.log("Estoy por la opcion SI a eliminar")
//   console.log(gloparam);
//   console.log(gloequip);
//   console.log(glovalor);
          
//   $.ajax({
//           type: 'POST',
//           data: { gloequip: gloequip,gloparam:gloparam, glovalor:glovalor},
//           url: 'index.php/Lectura/bajaparametro', //index.php/
//           success: function(data){
//                   console.log("Exito");
//                   console.log(data);
//                   alert("Lectura ELIMINADA");
//                   regresa();
                   
//                 },
            
//           error: function(result){
//                 console.log("Entre por el error");
//                 console.log(result);
//               }
//          // dataType: 'json'
//   });

// }
function regresa(){

 //$('#content').empty(); //listOrden  modalaviso
  //$('#modalaviso').empty();
  $("#content").load("<?php echo base_url(); ?>index.php/Lectura/index/<?php echo $permission; ?>");
 // WaitingClose();
  // WaitingClose();
}

</script>


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
        <h4><p>¿ DESEA ELIMINAR LECTURA ?</p></h4>
        </center>
      </div>
      <div class="modal-footer">
        <center>
        <button type="button" class="btn btn-primary" data-dismiss="modal" onclick="eliminarpred()">SI</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">NO</button>
        </center>
      </div>
    </div>
  </div>
</div>
























 