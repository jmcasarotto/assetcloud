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
  <div class="row" id="param">
    <div class="col-xs-12">
      <div class="box">
        <div class="box-header">
          <h3 class="box-title">Carga de Parametros</h3>
            <br>
            <br>
            <div class="row" >
              <div class="col-sm-12 col-md-12">
                <div role="tabpanel" class="tab-pane">
                  <div class="form-group">
                    <div class="panel panel-default">
                      <div class="panel-heading">
                          <h2 class="panel-title"><br></h2>
                      </div>
                      <div class="panel-body">
                        <br>
                        <div class="col-xs-2">Equipos <strong style="color: #dd4b39">*</strong>:
                          <select id="equipo" name="equipo" class="form-control"  />
                          <input type="hidden" id="id_equipo" name="id_equipo"/>
                        </div>
                        <div class="col-xs-2">Parametro <strong style="color: #dd4b39">*</strong>:
                          <select id="parametro" name="parametro" class="form-control" placeholder="Ingrese Descripcion">
                          <input type="hidden" id="id_parametro" name="id_parametro">
                        </div>
                      
                        <div class="col-xs-2">
                        <br>
                           <button type="button" class="btn btn-success"  data-toggle="modal" data-target="#modalOrder"><i class="fa fa-plus"> Nuevo</i></button>
                        </div>

                        <div class="col-xs-2">Maximo <strong style="color: #dd4b39">*</strong>:
                           <input type="text" name="maximo" id="maximo" class="form-control" placeholder="Ingrese Valor Maximo"  /> 
                        </div>
                        <div class="col-xs-2">Minimo <strong style="color: #dd4b39">*</strong>: 
                           <input type="text" name="minimo" id="minimo" class="form-control" placeholder="Ingrese Valor Minimo"  /> 
                        </div>
                        
                        <br>
                        <div class="col-xs-4">
                        <br>
                           <button type="button" class="btn btn-success" id="addcompo"><i class="fa fa-check"> Agregar</i></button>
                        </div>
                      </div>

                    </div>
                  </div>
                </div>
              </div>
            </div>


        </div><!-- /.box-header -->
        <div class="box-body">
          <table id="tablaparametros" class="table table-bordered table-hover">
            <thead>
              <tr>
                <th width="2%">Acciones</th>
                <th width="2%"></th>
                <th>Equipo</th>
                <th>Parametro</th>
                <th>Maximo</th>
                <th>Minimo</th>
                                                

              </tr>
            </thead>
             <tbody>
             </tbody>
           
          </table>
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
        <h4 class="modal-title" id="myModalLabel"><span id="modalAction"> </span> Agregar Parametro</h4>
       </div> <!-- /.modal-header  -->

      <div class="modal-body input-group ui-widget" id="modalBodyArticle">
        
        <div class="row" >
          <div class="col-sm-12 col-md-12">
            <div role="tabpanel" class="tab-pane">
              <div class="form-group">
                
                  <br>
                    <div class="col-xs-8"><h4>Descripcion: * </h4>
                    </div>
                     
                      <div class="col-lg-12">  
                      <input  type="text" id="descripcion1" name="descripcion1"  class="form-control" placeholder="Ingrese Descripcion">
                      
                      </div>
                 
                    
                    
                
         
              </div>
            </div>
          </div>
        </div>
       
     

      <div class="modal-footer">
       
        <button type="button" class="btn btn-primary btn-sm" data-dismiss="modal" onclick="guardar()" >Guardar</button>
      </div>  <!-- /.modal footer -->

       </div>  <!-- /.modal-body -->
    </div> <!-- /.modal-content -->

  </div>  <!-- /.modal-dialog modal-lg -->
</div>  <!-- /.modal fade -->
<!-- / Modal -->


<script>

$(document).ready(function(event) {

    edit=0;  datos=Array();


id_equip="";
id_param="";
campo4="";
$('#equipo').change(function(){
  
      var id_equipo = $(this).val();
      console.log(id_equipo);
      id_equip=id_equipo;
        console.log(id_equip);

      /*traer_parametro(id_equipo);*/

      $.ajax({
            type: 'POST',
            data: { id_equipo: id_equipo},
            url: 'index.php/Parametro/getparametros', //index.php/
            success: function(data){
                    //var data = jQuery.parseJSON( data );
                    
                  console.log(data);
                  var j=1;
                  var comp={};
                    for(var i=0; i < data.length ; i++){
                        id_param=j;
                    var tr = "<tr id='"+id_param+"'>"+
                    "<td><i class='fa fa-fw fa-times-circle' style='color: #dd4b39' cursor: 'pointer' margin-left: '15px' title='Eliminar'></i></td>"+
                              "<td ><i class='fa fa-fw fa-pencil' style='color: #f39c12' cursor: 'pointer' margin-left: '15px' title='Editar'</i> </td>"+
                              
                              "<td>"+data[i]['codigo'] +"</td>"+
                              "<td >"+data[i]['paramdescrip']+"</td>"+
                              "<td class='hidden' id='"+id_param+"'>"+data[i]['id_parametro']+"</td>"+
                              "<td>"+data[i]['maximo']+"</td>"+
                              "<td>"+data[i]['minimo']+"</td>"+
                              
                            "</tr>";
                            j++;
                            comp[id_param]=data[i]['id_parametro'];
                  $('#tablaparametros tbody').append(tr);
                  console.log(tr);
                }
                console.log("para identificar el j es :"+ id_param);
                console.log(comp);


                

                
                      
                      $(document).on("click",".fa-times-circle",function(){

                            var parent = $(this).closest('tr').attr('id');
                            console.log(parent);
                           /* var idspa = new Array();   
                            $("#tablaparametros tbody tr").each(function (index) 
                            {
                                var idpa = $(this).attr('id');
                                idspa.push(idpa); 
   
                            }); 
                           console.log(idspa);*/
                           
                                   
                            bootbox.confirm("¿Realmente desea Eliminar ?", function(e) { 
                                if(e)
                                  $.ajax({
                                    type: 'POST',
                                    data: { id_equipo: id_equipo,comp:comp, parent:parent},
                                    url: 'index.php/Parametro/baja_parametro', //index.php/
                                    success: function(data){
                                            //var data = jQuery.parseJSON( data );
                                            console.log("Exito");
                                            console.log(data);
                                           
                                            $(tr).remove();

                                             bootbox.alert("Parametro eliminado", function() {});
                                             cargarVista();
                                          },
                                      
                                    error: function(result){
                                          console.log("Entre por el error");
                                          console.log(result);
                                        },
                                        //dataType: 'json'
                                    });
                                else alert('cancel');
                              });     
                         
                      });

                      $(document).on("click",".fa-pencil",function(){

                        var parent = $(this).closest('tr').attr('id');
                        console.log(parent);
                        $.ajax({
                          type: 'GET',
                          data: { id_equip:id_equip, parent:parent, comp:comp},
                          url: 'index.php/Parametro/editar', //index.php/
                          success: function(data){
                                  //var data = jQuery.parseJSON( data );
                                  console.log("exito");
                                  console.log(data);
                                 
                                  datos={
                                    'id_equipo':id_equipo,

                                    'codigo':data['datos'][0]['codigo'],
                                    'parametro':data['datos'][0]['paramdescrip'],
                                    'maximo':data['datos'][0]['maximo'],
                                    'minimo':data['datos'][0]['minimo'],
                                    'id_param':data['datos'][0]['id_parametro'],
                                    


                                  }


                                  bootbox.dialog({
                                      backdrop: true,
                                      title: "Modificar parametro",
                                      message:'<form role="form" id="agregarC" name="agregarC" >'+  
                                                '<div class="row" >'+
                                                  '<div class="col-sm-12 col-md-12">'+
                                                    '<fieldset> </fieldset>'+
                                                      '<br>'+
                                                        '<div class="col-xs-3">Equipo'+
                                                          '<input type="text"   class="form-control input-md" id="equ"  name="equ" value='+datos.codigo+' disabled>'+
                                                          '<input type="hidden" class="form-control input-md" id="id_equipo"  name="id_equipo" value='+datos.id_equipo+' >'+
                                                        '</div>'+
                                                        '<div class="col-xs-3">Parametro'+
                                                          '<input type="text"   class="form-control input-md" id="param"  name="param" value='+datos.parametro+' disabled>'+
                                                          '<input type="hidden" class="form-control input-md" id="id_param"  name="id_param" value='+datos.id_param+' >'+

                                                        '</div>'+
                                                        '<div class="col-xs-3">Maximo'+
                                                          '<input type="text"   class="form-control input-md" id="maxi"  name="maxi" value='+datos.maximo+'>'+
                                                        '</div>'+
                                                        '<div class="col-xs-3">Minimo'+
                                                          '<input type="text"   class="form-control input-md" id="mini"  name="mini" value='+datos.minimo+' >'+
                                                        '</div>'+

                                                        
                                                      '</div>'+
                                                    '</div>'+
                                                    '<form>',
                                            

                                        buttons: {
                                                  success: {
                                                  label: "guardar",
                                                  className:"btn-primary guardar" ,
                                                  callback: function (e) {
                                                  
                                                      var datos={
                                                          
                                                          
                                                          'maximo': $('#maxi').val(),
                                                          'minimo': $('#mini').val(),
                                                          'id_parametro': $('#id_param').val(),

                                                        
                                                                };


                                                      $.ajax({
                                                        type:"POST",
                                                        url: "index.php/Parametro/agregar_componente", //controlador /metodo
                                                        data:{datos:datos, id_equip: id_equip},
                                                        success: function(data){
                                                            console.log(data);
                                                            console.log("hola estoy en exito");
                                                            if (data >0) {
                                                            $('#tablaparametros  tbody ').append(data);

                                                            }

                                                            cargarVista(); 
                                                        },
                                                        
                                                        error: function(result){
                                
                                                        console.log(result);
                                                        console.log("hola entre por el error");
                                                        //cargarVista();
                                                        },
                                                        // dataType: 'json'
                                                    });
                                                              

                                                              
                                                  }//fin calback
                                              }//fin success
                                          },//fin Buttons
                                          onEscape: function() {return ;},
                                      });  //FIN DIALOG  

                                                      
                              
                                },
                            
                          error: function(result){
                                
                                console.log(result);
                              },
                              dataType: 'json'
                          });
               
                   });

                  },
                    error: function(result){
                                
                          console.log(result);
                    },
                    dataType: 'json'
         });

        var parentid = $(this).closest('tr').attr('id');
                            console.log(parentid);         
     if(id_equipo=parentid)       
       {  $('#tablaparametros tbody tr').remove();

       }
});

var equipoglob="";
var paramglob="";
$("#addcompo").click(function (e) {

    //var equipo = $('#equipo').val();
    var $equipo = $("select#equipo option:selected").html();
    var id_equipo= $('#equipo').val();
    var $parametro = $("select#parametro option:selected").html();
    //var compo = $('#compo').val()
    var id_parametro= $('#parametro').val();
    var maximo = $('#maximo').val()
   var minimo = $('#minimo').val()
    equipoglob = id_equipo;
    paramglob = id_parametro;
    console.log("el id del equipo es :" +id_equipo);
    console.log("el id del parametro es :" +id_parametro);
    console.log("el maximo es :" +maximo);
    console.log("el minimo es :" +minimo);
   
    var tr = "<tr id='"+id_equipo+"'>"+
                "<td > <i class='fa fa-fw fa-times-circle' style='color: #dd4b39' cursor: 'pointer' margin-left: '15px' title='Eliminar'></i></td>"+
                "<td><i class='fa fa-fw fa-pencil' style='color: #f39c12' cursor: 'pointer' margin-left: '15px' title='Editar'</i></td>"+
                "<td>"+$equipo +"</td>"+
                "<td>"+$parametro+"</td>"+
                "<td>"+maximo+"</td>"+
                "<td>"+minimo+"</td>"+
                
            "</tr>";
    
   
         $(document).on("click",".fa-times-circle",function(){

                            var parent = $(this).closest('tr');
                            console.log(parent);
                           /* var idspa = new Array();   
                            $("#tablaparametros tbody tr").each(function (index) 
                            {
                                var idpa = $(this).attr('id');
                                idspa.push(idpa); 
   
                            }); 
                           console.log(idspa);*/
                           
                                   
                            bootbox.confirm("¿Realmente desea Eliminar ?", function(e) { 
                                if(e)
                                  $.ajax({
                                    type: 'POST',
                                    data: { id_equipo: id_equipo,id_parametro:id_parametro},
                                    url: 'index.php/Parametro/bajaparametro', //index.php/
                                    success: function(data){
                                            //var data = jQuery.parseJSON( data );
                                            console.log("Exito");
                                            console.log(data);
                                           
                                            $(parent).remove();

                                             bootbox.alert("Parametro eliminado", function() {});
                                             //cargarVista();
                                          },
                                      
                                    error: function(result){
                                          console.log("Entre por el error");
                                          console.log(result);
                                        },
                                        //dataType: 'json'
                                    });
                                else alert('cancel');
                              });     
                         
          });
            /* $('#error').fadeOut('slow');
                 guardar_todo();
             
             WaitingOpen('Guardando cambios');*/
        $(document).on("click",".fa-pencil",function(){

              $.ajax({
                type: 'GET',
                data: { equipoglob:equipoglob, id_parametro:id_parametro},
                url: 'index.php/Parametro/geteditar', //index.php/
                success: function(data){
                        //var data = jQuery.parseJSON( data );
                        console.log("exito");
                        console.log(data);
                       
                        datos={
                          'id_equipo':id_equipo,

                          'codigo':data['datos'][0]['codigo'],
                          'parametro':data['datos'][0]['paramdescrip'],
                          'maximo':data['datos'][0]['maximo'],
                          'minimo':data['datos'][0]['minimo'],
                          'id_param':data['datos'][0]['id_parametro'],
                          


                        }


                        bootbox.dialog({
                            backdrop: true,
                            title: "Modificar parametro",
                            message:'<form role="form" id="agregarC" name="agregarC" >'+  
                                      '<div class="row" >'+
                                        '<div class="col-sm-12 col-md-12">'+
                                          '<fieldset> </fieldset>'+
                                            '<br>'+
                                              '<div class="col-xs-3">Equipo'+
                                                '<input type="text"   class="form-control input-md" id="equ"  name="equ" value='+datos.codigo+' disabled>'+
                                                '<input type="hidden" class="form-control input-md" id="id_equipo"  name="id_equipo" value='+datos.id_equipo+' >'+
                                              '</div>'+
                                              '<div class="col-xs-3">Parametro'+
                                                '<input type="text"   class="form-control input-md" id="param"  name="param" value='+datos.parametro+' disabled>'+
                                                '<input type="hidden" class="form-control input-md" id="id_param"  name="id_param" value='+datos.id_param+' >'+

                                              '</div>'+
                                              '<div class="col-xs-3">Maximo'+
                                                '<input type="text"   class="form-control input-md" id="maxi"  name="maxi" value='+datos.maximo+'>'+
                                              '</div>'+
                                              '<div class="col-xs-3">Minimo'+
                                                '<input type="text"   class="form-control input-md" id="mini"  name="mini" value='+datos.minimo+' >'+
                                              '</div>'+

                                              
                                            '</div>'+
                                          '</div>'+
                                          '<form>',
                                  

                              buttons: {
                                        success: {
                                        label: "guardar",
                                        className:"btn-primary guardar" ,
                                        callback: function (e) {
                                        
                                            var datos={
                                                
                                                
                                                'maximo': $('#maxi').val(),
                                                'minimo': $('#mini').val(),
                                                'id_parametro': $('#id_param').val(),

                                              
                                                      };


                                            $.ajax({
                                              type:"POST",
                                              url: "index.php/Parametro/agregarcomponente", //controlador /metodo
                                              data:{datos:datos, equipoglob: equipoglob},
                                              success: function(data){
                                                  console.log(data);
                                                  console.log("hola estoy en exito");
                                                  if (data >0) {
                                                  $('#tablaparametros  tbody').append(data);
                                                  }
                                                  cargarVista(); 
                                              },
                                              
                                              error: function(result){
                      
                                              console.log(result);
                                              console.log("hola entre por el error");
                                              //cargarVista();
                                              },
                                             // dataType: 'json'
                                          });
                                                    

                                                    
                                        }//fin calback
                                    }//fin success
                                },//fin Buttons
                                onEscape: function() {return ;},
                            });  //FIN DIALOG  

                                            
                    
                      },
                  
                error: function(result){
                      
                      console.log(result);
                    },
                    dataType: 'json'
                });
     
                      
        });


 var hayError = false;
    if (id_equipo >0 && id_parametro >0) {

          if (maximo !='' && minimo!= '') {
              $('#tablaparametros tbody').append(tr);
                 guardar_todo();
            }
        else 
          { var hayError = true;
            $('#error').fadeIn('slow');
             return;
           }

      }
    else 
      {
        var hayError = true;
         $('#error').fadeIn('slow');
             return;
      
           }
        
      
           if(hayError == false){
            $('#error').fadeOut('slow');
               //  guardar_todo();
           }


       
       $('#equipo').val('');
       $('#parametro').val(''); 
       $('#maximo').val(''); 
       $('#minimo').val(''); 
        
 

});





  });

traer_equipo();

function traer_equipo(){

      $.ajax({
        type: 'POST',
        data: { },
        url: 'index.php/Parametro/getequipo', //index.php/
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
traer_parametro();

function traer_parametro(){
    
    $('#parametro').html(""); 
    $.ajax({
          type: 'POST',
          data: {},
          url: 'index.php/Parametro/traerparametro',  //index.php/
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
}



function guardar(){ 
       
    
    var parametros = {
        'paramdescrip': $('#descripcion1').val(),
        
    };
    console.log(parametros);
    
          $.ajax({
              type: 'POST',
              data: {data:parametros},
              url: 'index.php/Parametro/guardar',  //index.php/
              success: function(data){
                      console.log("exito");
                      console.log(data);
                      
                      if(data > 0)
                       {  
                        var texto = '<option value="'+data+'">'+ parametros.paramdescrip +'</option>';

                        $('#parametro').append(texto);
                        
                      }
                      
                    },
              error: function(result){
                    console.log("entro por el error");
                    console.log(result);

                    
                  },
                 dataType: 'json'
              });

}



function guardar_todo(){ 
       
    console.log("estoy guardadno");
    var parametros = {
        'id_equipo': $('#equipo').val(),
        'id_parametro': $('#parametro').val(),
        'maximo': $('#maximo').val(),
        'minimo': $('#minimo').val(),
        
    };

     /*var idsparam = new Array();     
        $("#tablaparametros tbody tr").each(function (index) 
        {
            //var ide = $(this).parent('td').parent('tr').attr('id');
            var id_equipo = $(this).attr('id');
            idsparam.push(id_equipo);            
          
         
        }); */
    console.log(parametros);
    //console.log(idsparam)

    
          $.ajax({
              type: 'POST',
              data: {data:parametros},
              url: 'index.php/Parametro/guardar_todo',  //index.php/
              success: function(data){
                      console.log("exito");
                      console.log(data);
                      

                                                       
                    },
              error: function(result){
                    console.log("entro por el error");
                    console.log(result);

                    
                  },
                  dataType: 'json'
              });

}

function eliminar(id_equipo, id_parametro){
     
}

function editar($id_equipo){
 $.ajax({
      type: 'GET',
      data: { id_equipo: id_equipo, id_parametro:id_parametro},
      url: 'index.php/Parametro/geteditar', //index.php/
      success: function(data){
              //var data = jQuery.parseJSON( data );
              console.log("exito");
              console.log(data);
             
              datos={
                'id_equipo':id_equipo,

                'codigo':data['datos'][0]['codigo'],
                'parametro':data['datos'][0]['paramdescrip'],
                'maximo':data['datos'][0]['maximo'],
                'minimo':data['datos'][0]['minimo'],
                'id_param':data['datos'][0]['id_parametro'],
  
              }


            bootbox.dialog({
                backdrop: true,
                title: "Modificar parametro",
                message:'<form role="form" id="agregarC" name="agregarC" >'+  
                          '<div class="row" >'+
                            '<div class="col-sm-12 col-md-12">'+
                              '<fieldset> </fieldset>'+
                                '<br>'+
                                  '<div class="col-xs-3">Equipo'+
                                    '<input type="text"   class="form-control input-md" id="equ"  name="equ" value='+datos.codigo+' >'+
                                    '<input type="hidden" class="form-control input-md" id="id_equipo"  name="id_equipo" value='+datos.id_equipo+' >'+
                                  '</div>'+
                                  '<div class="col-xs-3">Parametro'+
                                    '<input type="text"   class="form-control input-md" id="param"  name="param" value='+datos.parametro+' >'+
                                    '<input type="hidden" class="form-control input-md" id="id_param"  name="id_param" value='+datos.id_param+' >'+

                                  '</div>'+
                                  '<div class="col-xs-3">Maximo'+
                                    '<input type="text"   class="form-control input-md" id="maxi"  name="maxi" value='+datos.maximo+'>'+
                                  '</div>'+
                                  '<div class="col-xs-3">Minimo'+
                                    '<input type="text"   class="form-control input-md" id="mini"  name="mini" value='+datos.minimo+' >'+
                                  '</div>'+

                                  
                                '</div>'+
                              '</div>'+
                              '<form>',
                      

                  buttons: {
                          success: {
                          label: "guardar",
                          className:"btn-primary guardar" ,
                          callback: function (e) {
                          
                              var datos={
                                  
                                  
                                  'maximo': $('#maxi').val(),
                                  'minimo': $('#mini').val(),
                                  'id_parametro': $('#id_param').val(),

                                
                                        };


                              $.ajax({
                                type:"POST",
                                url: "index.php/Parametro/agregar_componente", //controlador /metodo
                                data:{datos:datos, id_equipo: id_equipo},
                                success: function(data){
                                    console.log(data);
                                    console.log("hola estoy en exito");
                                    if (data >0) {
                                    $('#tablaparametros  tbody').append(data);
                                    }
                                    //cargarVista(); 
                                },
                                
                                error: function(result){
        
                                console.log(result);
                                console.log("hola entre por el error");
                                //cargarVista();
                                },
                                 dataType: 'json'
                            });
                                      

                                      
                          }//fin calback
                      }//fin success
                  },//fin Buttons
                  onEscape: function() {return ;},
              });  //FIN DIALOG  

                  },
              
            error: function(result){
                  
                  console.log(result);
                },
                dataType: 'json'
            });
 
 

}

function cargarVista(){
    //WaitingOpen();

    //$('#tablaparametros').empty();
    $('#content').empty();
    $("#content").load("<?php echo base_url(); ?>index.php/Parametro/index/<?php echo $permission; ?>");
    WaitingClose();
  }
</script>