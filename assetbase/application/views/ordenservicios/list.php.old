<input type="hidden" id="permission" value="<?php echo $permission;?>">
<section class="content">
  <div class="row">
    <div class="col-xs-12">
      <div class="box">
        <div class="box-header">
          <h3 class="box-title">Ordenes de Servicio</h3>
          
        </div><!-- /.box-header -->
        <div class="box-body">
          <table id="tblorden" class="table table-bordered table-hover">
            <thead>
              <tr>
                <th width="15%">Acciones</th> 
                <!-- <th style="text-align: center">Nº Orden</th>     -->         
                <th style="text-align: center">Nº Solicitud</th>
                <th style="text-align: center">Fecha de Solicitud</th>                
                <th style="text-align: center">Falla</th>
                <th style="text-align: center">Fecha de Orden</th>                
                <th style="text-align: center">Solicitante</th>
                <th style="text-align: center">Estado</th>    
                        
              </tr>
            </thead>
            <tbody>
              <?php
                if(count($list) > 0) {                  
                	foreach($list as $a){
      		        
  	                $id=$a['id_orden'];
                    echo '<tr id="'.$id.'">';                    
                    echo '<td class="icono">';                    
                    echo '<i class="fa fa-sticky-note-o" data-toggle="modal" data-target="#modalOrder" style="color: #006400; cursor: pointer; margin-left: 15px;" title="Ver Orden"></i>';                      
                     echo '<i class="fa fa-fw '.($a['estado'] == 'C' ? 'fa fa-toggle-on' : 'fa fa-toggle-off').' title="Terminar" style="color: #006400; cursor: pointer; margin-left: 15px;"></i>';
                     //if ($a['estado'] == 'C'){
                     echo '<i class="fa fa-fw fa-print" style="color: #A4A4A4; cursor: pointer; margin-left: 15px;" title="Imprimir"  ></i> ';
                   //}
                      echo '</td>';
                      //echo '<td style="text-align: center">'.$a['id_orden'].'</td>';  	    
                      echo '<td style="text-align: center">'.$a['id_solicitud'].'</td>';            
                      echo '<td style="text-align: center">'.$a['f_solicitado'].'</td>';
                      echo '<td style="text-align: center">'.$a['causa'].'</td>';
                      echo '<td style="text-align: center">'.$a['fecha'].'</td>';
                      echo '<td style="text-align: center">'.$a['solicitante'].'</td>';
                      echo '<td style="text-align: center">'.($a['estado'] == 'C' ? '<small class="label pull-left bg-green">Curso</small>' :($a['estado'] == 'T' ? '<small class="label pull-left bg-blue">Terminado</small>' : '<small class="label pull-left bg-red">Solicitado</small>')).'</td>';
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


<!-- Modal -->
           
<div class="modal fade" id="modalOrder" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">

      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel"><span id="modalAction"> </span> Orden de Servicio</h4>
      </div> <!-- /.modal-header  -->  
       
      <div class="modal-body">  
        <table id="modOrden" class="table table-bordered table-hover">
              <thead>
                <tr>
                  <!-- <th width="5%">Acciones</th> --> 
                  <!-- <th style="text-align: center">Nº Orden</th>  -->            
                  <th style="text-align: center">Nº Solicitud</th>
                  <th style="text-align: center">Fecha de Solicitud</th>                
                  <th style="text-align: center">Falla</th>
                  <th style="text-align: center">Fecha de Orden</th>                
                  <th style="text-align: center">Solicitante</th>
                  <th style="text-align: center">Estado</th>               
                </tr>
              </thead>
              <tbody>
              </tbody>
        </table>      
       
        <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
            <div class="panel panel-default">
              <div class="panel-heading" role="tab" id="headingOne">
                <h4 class="panel-title">
                  <a class="tarea"role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                    Tareas
                  </a>
                </h4>
              </div>
              <div id="collapseOne" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
                <div class="panel-body">
                  <table id="modTarea" class="table table-bordered table-hover">
                        <thead>
                          <tr>                            
                            <th style="text-align: left">Tareas</th>             
                            <th style="text-align: left">Componenetes</th>
                            <th style="text-align: left">Horas</th>                
                            <th style="text-align: left">Monto</th>                                          
                          </tr>
                        </thead>
                        <tbody>
                        </tbody>
                  </table> 
                </div>
              </div>
            </div>
            <div class="panel panel-default">
              <div class="panel-heading" role="tab" id="headingTwo">
                <h4 class="panel-title">
                  <a class="herramientas collapsed" id="herramientas" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                    Orden de Herramientas
                  </a>
                </h4>
              </div>
              <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
                <div class="panel-body">
                  <table id="modHerram" class="table table-bordered table-hover">
                        <thead>
                          <tr>                            
                            <th style="text-align: left">Herramientas</th>             
                            <th style="text-align: left">Marcca</th>
                            <th style="text-align: left">Código</th>     
                          </tr>
                        </thead>
                        <tbody>
                        </tbody>
                  </table>
                </div>
              </div>
            </div>
            <div class="panel panel-default">
              <div class="panel-heading" role="tab" id="headingThree">
                <h4 class="panel-title">
                  <a class=" insumos collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                    Orden de Insumos
                  </a>
                </h4>
              </div>
              <div id="collapseThree" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree">
                <div class="panel-body">
                 <table id="modInsum" class="table table-bordered table-hover">
                        <thead>
                          <tr>                            
                            <th style="text-align: left;">Artículo</th>             
                            <th style="text-align: left;">Cantidad</th>
                            <th style="text-align: left;">Depósito</th>                                       
                          </tr>
                        </thead>
                        <tbody>
                        </tbody>
                  </table>
                </div>
              </div>
            </div>
           <!--  <div class="panel panel-default">
              <div class="panel-heading" role="tab" id="headingFour">
                <h4 class="panel-title">
                  <a class=" insumos collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                    Recursos Humanos
                  </a>
                </h4>
              </div>
              <div id="collapseFour" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingFour">
                <div class="panel-body">
                 <table id="modRecurso" class="table table-bordered table-hover">
                        <thead>
                          <tr>                            
                            <th style="text-align: left;">Apellido y Nombre</th> 
                          </tr>
                        </thead>
                        <tbody>
                        </tbody>
                  </table>
                </div>
              </div>
            </div> -->
        </div> <!-- / .panel-group -->


      </div> <!-- /.modal-body -->

      <div class="modal-footer">                    
        <button type="button" class="btn btn-primary btn-sm" data-dismiss="modal">Aceptar</button>
      </div>  <!-- /.modal footer -->
    
    </div> <!-- /.modal-content -->

  </div>  <!-- /.modal-dialog modal-lg -->
</div>  <!-- /.modal fade -->
<!-- / Modal -->


<!-- Resetea Nº de orden al recargar la pagina -->
<script>
 $('#cargOrden').click( function cargarVista(){
    WaitingOpen();
    $('#content').empty();
    $("#content").load("<?php echo base_url(); ?>index.php/Ordenservicio/getOrdenInactiva/<?php echo $permission; ?>");
    WaitingClose();
  });
</script>
<!-- / Resetea Nº de orden al recargar la pagina -->



<!-- Cambia el estado de Orden servicio y de solicitud de servicio  -->
<script>   
  $(".fa-toggle-on").click(function () {  

    var id_orden = $(this).parent('td').parent('tr').attr('id'); // guarda el id de orden en var global id_orden
    $.ajax({
          type: 'POST',
          data: {id_orden: id_orden},
          url: 'index.php/Ordenservicio/setEstado', 
          success: function(data){                   
                   setTimeout("cargarView('Ordenservicio', 'index', '"+$('#permission').val()+"');",0);
                },            
          error: function(result){
                alert("Error en cambio de estado");
              },
              dataType: 'json'
          });
  });

  $(".fa-print").click(function (e) {

     e.preventDefault();
    var id_orden = $(this).parent('td').parent('tr').attr('id');
    console.log("El id de orden al imprimir es :");
    console.log(id_orden);

    $.ajax({
        type: 'POST',
        data: { id_orden: id_orden},
        url: 'index.php/Ordenservicio/getsolImp', //index.php/
        success: function(data){
                //data = JSON.parse(data,true);
                console.log("Entre a la impresion");
                console.log(data);
                console.log(data.datos.sec);
               // console.log(data['f_solicitado']);
                //alert("entre");
               // console.log(data['datos'][0]['fecha']);

                datos={

                  'id_orden':id_orden,
                  'fecha':data.datosfecha,
                  'id_orden_insumo':data.datosid_orden_insumo,

                  'f_solicitado':data.datos.f_solicitado,
                  'solicitante':data.datos.solicitante,
                  'hora_sug':data.datos.hora_sug,
                  'codigo':data.datos.codigo,

                  //'descripcion':data['datos'][0]['descripcion'],
                  'ubicacion':data.datos.ubicacion,
                  'sector':data.datos.sec,
                  'grupo':data.datos.degr,
                  'causa':data.datos.causa,

                }

                var trequipos = '';
                for(var i=0; i < data['equipos'].length ; i++) //aca solo listo niveles y especialidades
                {   
                    
                      trequipos  = trequipos+"<tr> <td width='1%'></td> <td width='10%'>"+ data['equipos'][i]['artBarCode']+"</td> <td width='10%'>"+data['equipos'][i]['artDescription']+"</td> <td width='10%'>"+data['equipos'][i]['cantidad']+"</td>  </tr>" ;
                                 
                }


    var  texto =

            '<div class="" id="vistaimprimir">'+
              '<div class="container">'+
                '<div class="thumbnail">'+

                  '<div class="caption">'+
                    '<div class="row" >'+
                      '<div class="panel panel-default">'+
                        '<div class="form-group">'+
                          '<h3 class="text-center" align="center"></h3>'+
                        '</div>'+
                        '<hr/>'+
                        '<div class="panel-body">'+
                          '<div class="container">'+
                            '<div class="thumbnail">'+
                              '<div class="row">'+
                                '<div class="col-sm-12 col-md-12">'+
                                  '<table width="100%" style="text-align:justify">'+
                                    '<tr>'+
                                    '<tr>'+
                                      '<td  colspan="1"  align="left" >'+
                                        '<div class="text-left"> <img src="img/logo.jpg" width="280" height="80" /> </div></td>'+
                                        //'<br>'+
                                      '</td>'+
                                      //class="col-md-1 col-md-offset-5" class="col-md-4 col-md-offset-4"
                                      //td colspan="2"  align="left"

                                      '<td >'+
                                        '<div class="col-xs-4">Orden Nº: '+datos.id_orden+
                                          
                                        '</div>'+

                                        '<div class="col-xs-4">Fecha: '+data.datos.fecha+
                            
                                        '</div>'+
                                      '</td>'+

                                    '</tr>'+
                                    '<tr>'+
                                      '<td >'+
                                      '</td>'+
                                    '<tr>'+
                                      '<td>'+
                                      '<td/>'+
                                      '<td height="2" colspan="2">'+
                                        '<div class="col-xs-8">'+
                                        '</h3>'+
                                        '</div>'+
                                      '</td>'+
                                    '</tr>'+
                                    '<tr>'+
                                      '<td height="2" colspan="2">'+
                                        '<div class="col-md-3 col-md-offset-9">Solicitado :  '+
                                        '<textarea class="form-control" id="solicitante" name="solicitante" style="padding-left:15px"  value='+datos.solicitante+' rows="2" cols="93">'+datos.solicitante+'</textarea>'+
                                        '</div>'+
                                          
                                      '</td'+
                                    '</tr>'+
                                   // '<br>'+
                                    '<tr>'+
                                      '<td>'+
                                      '<br>'+
                                        '<div class="col-md-3 col-md-offset-9">Equipo: '+
                                        '<textarea class="form-control" id="equipo" name="equipo" style="padding-left:15px"  value='+datos.codigo+' rows="2" cols="46">'+datos.codigo+'</textarea>'+
                                        '</div>'+
                                        '<br>'+
                                       // '<br>'+
                                        
                                        
                                        '<div class="col-md-3 col-md-offset-9">Ubicacion: '+
                                        '<textarea class="form-control" id="ubicacion" name="ubicacion" style="padding-left:15px"  value='+datos.ubicacion+' rows="2" cols="46">'+datos.ubicacion+'</textarea>'+
                                          
                                        '</div>'+
                                      '</td>'+
                                      
                                      '<td>'+
                                      '<br>'+
                                      
                                        '<div class="col-md-3 col-md-offset-9">Sector: '+
                                          '<textarea class="form-control" id="descripcion" name="descripcion" style="padding-left:15px"  value='+datos.sector+' rows="2" cols="50">'+datos.sector+'</textarea>'+
                                          
                                        '</div>'+
                                        '<br>'+
                                        
                                        '<div class="col-md-3 col-md-offset-9">Grupo: '+
                                         '<textarea class="form-control" id="grupo" name="grupo" style="padding-left:15px"  value='+datos.grupo+' rows="2" cols="46">'+datos.grupo+'</textarea>'+
                                          '</div>'+

                                      '</td>'+
                                    '</tr>'+
                                    '</tr>'+
                                  '</table>'+
                                '</div>'+
                              '</div>'+
                              '<br>'+
                              '<div class="row">'+
                                '<div class="col-xs-12">Causa: '+
                                
                                '</div>'+
                                
                                '<div class="col-xs-12">'+
                                  '<textarea class="form-control" id="descripcion" name="descripcion" style="padding-left:15px"  value='+datos.causa+' rows="4" cols="98">'+datos.causa+'</textarea>'+
                                '</div>'+ 
                              '</div>'+
                              '<br>'+
                              '<div class="row">'+
                                '<form class="form-horizontal">'+
                                  '<div class="form-group">'+
                                    '<label for="inputPassword3" class="col-sm-2 control-label">Realizado:</label>'+
                                    '<div class="col-sm-10">'+
                                      ' <input type="password" class="form-control" id="inputPassword3" size="40">'+
                                    '</div>'+
                                  '</div>'+
                                  '<div class="form-group">'+
                                    '<label for="inputPassword3" class="col-sm-2 control-label">Supervisado:</label>'+
                                    '<div class="col-sm-10">'+
                                      ' <input type="password" class="form-control" id="inputPassword3" size="40">'+
                                    '</div>'+
                                  '</div>'+
                                  '<div class="form-group">'+
                                    '<label for="inputPassword3" class="col-sm-2 control-label">Fecha Realizado:</label>'+
                                    
                                    '<div class="col-sm-10">'+
                                      ' <input type="password" class="form-control" id="inputPassword3" size="40">'+
                                    '</div>'+
                                  '</div>'+
                                  '<div class="form-group">'+
                                  '<label for="inputPassword3" class="col-sm-2 control-label">Conforme servicio</label>'+
                                  
                                    '<div class="col-sm-10">'+
                                      '__________________________________'+
                                    '</div>'+
                                  '</div>'+
                                  
                                '</form>'+
                              '</div>'+
                              '<br>'+
                              '<br>'+
                              
                              //
                              '<div class="row">'+
                                '<div class="col-xs-10 col-xs-offset-1" style="text-align: center">'+
                               
                                  '<table  class="table table-bordered table-hover" style="text-align: center" >'+ //class="table table-bordered"
                                 
                                    '<tr align="center" bottom="middle>'+
                                      '<td colspan="1"   align="center" >'+
                                        '<div class="text-center">'+
                                        ' <img src="img/logo.jpg" width="280" height="80"/>'+
                                        '</div>'+
                                      '</td>'+
                                      
                                    '</tr>'+
                                    '<tr>'+
                                      '<td><h3> Vale de Materiales:'+'</h3>'+
                                      '</td>'+
                                    '</tr>'+
                                  '</table>'+
                                '</div>'+
                              '</div>'+
                              
                              //style="text-align: center"
                              
                              '<div class="row">'+
                                '<div class="col-xs-10 col-xs-offset-1 text-center">'+
                               
                                  '<table class="table table-bordered"  border="1px solid black"  >'+ //class="table table-bordered"
                                    '<thead>'+
                                      '<tr colspan="2">'+
                                        '<th width="2%">Item  (Tachar sino corresponde)</th>'+
                                        '<th width="15%">Codigo</th>'+ 
                                        '<th width="40%">Descripcion</th>'+
                                        '<th width="5%">Cantidad</th>'+
                                      '</tr>'+
                                    '</thead>'+
                                    '<tbody style="text-align:center">'+trequipos+
                                    '<tr colspan="2">'+
                                      '<td style="text-align: center" ></td>'+
                                      '<td><br></td>'+
                                      '<td><br></td>'+
                                      '<td><br></td>'+
                                    '</tr>'+
                                    '<tr colspan="2">'+
                                      '<td style="text-align: center" ></td>'+
                                      '<td><br></td>'+
                                      '<td><br></td>'+
                                      '<td><br></td>'+
                                    '</tr>'+
                                    '<tr colspan="2">'+
                                      '<td style="text-align: center" ></td>'+
                                      '<td><br></td>'+
                                      '<td><br></td>'+
                                      '<td><br></td>'+
                                    '</tr>'+
                                    '<tr colspan="2">'+
                                      '<td style="text-align: center" ></td>'+
                                      '<td><br></td>'+
                                      '<td><br></td>'+
                                      '<td><br></td>'+
                                    '</tr>'+
                                    '<tr colspan="2">'+
                                      '<td style="text-align: center" ></td>'+
                                      '<td><br></td>'+
                                      '<td><br></td>'+
                                      '<td><br></td>'+
                                    '</tr>'+
                                    '<tr>'+
                                      '<td style="text-align: center" ></td>'+
                                      '<td><br></td>'+
                                      '<td><br></td>'+
                                      '<td><br></td>'+
                                    '</tr>'+
                                    '</tbody>'+
                                  '</table>'+    
                                '</div>'+
                              '</div>'+
                              //'<div class="container-fluid">'+
                              '<br>'+
                              '<div class="row">'+

                               // '<div class="col-sm-12 col-md-12">'+
                                  '<div class="col-md-4">Entrega (Firma y aclaracion): '+
                                  ' <input type="text" class="form-control" id="inputPassword3" size="40">'+
                                          
                                  '</div>'+
                                  '<br>'+
                                  
                                  '<div class="col-md-4 col-md-offset-4">Recibe (Firma y aclaracion): '+ 
                                  ' <input type="text" class="form-control" id="inputPassword3" size="40">'+
                                 
                                  '</div>'+
                                  //'</div>'+
                              '</div>'+

                            '</div>'+
                          '</div>'+
                        '</div>'+

                       
                      '</div>'+
                    '</div>'+
                  '</div>'+
                  '<style>'+
                     '.table, .table>tr, .table>td {border: 1px solid #f4f4f4;} '+
                  '</style>';


                   var mywindow = window.open('', 'Imprimir', 'height=700,width=900');
                    mywindow.document.write('<html><head><title></title>');
                    //mywindow.document.write('<link rel="stylesheet" href="main.css" type="text/css" />');
                    //mywindow.document.write('<link rel="stylesheet" href="main.css">
                    mywindow.document.write('</head><body onload="window.print();">');
                    mywindow.document.write(texto);
                    mywindow.document.write('</body></html>');

                    mywindow.document.close(); // necessary for IE >= 10
                    mywindow.focus(); // necessary for IE >= 10
                    //mywindow.print();
                    //mywindow.close();
                    return true;

                  },

            error: function(result){

                  console.log(result);
                  console.log("error en la vistaimprimir");
                },
                dataType: 'json'
            });
    });
</script>
<!-- / Cambia el estado de Orden servicio y de solicitud de servicio  -->



<script>  
  
  /////// Carga la tabla del Modal y valida que  no se duplique 
  var $flag = 0;    
  $(".fa-sticky-note-o").click(function () {     

    var row = $(this).parent("td").parent("tr").clone();
   //row.eq(0).css({"display:none"});
   row.find('td.icono').remove();
    
    var id_ord = row.attr('id'); // guardo el Id de la orden de servicio.
    console.log('id de orden');
    console.log(id_ord);

    if ($flag == 0) {     //primera vez
        mostrarOrd(row); 
        getTarOrden(id_ord);
        getHerrramOrden(id_ord);
        getInsumOrd(id_ord);
        //getRecOrden(id_ord);             
        $flag = 1;
    } 
    else{     //mas de una vez
        $("#modOrden tbody tr").remove();
        $("#modTarea tbody tr").remove();
        $("#modHerram tbody tr").remove();
        $("#modInsum tbody tr").remove();
        //$("#modRecurso tbody tr").remove();
        mostrarOrd(row);  
        getTarOrden(id_ord);
        getHerrramOrden(id_ord);
        getInsumOrd(id_ord);  
        //getRecOrden(id_ord);      
        $flag = 1;
    };
  });
</script>

<script>
   
  //// muestra el encabezado de la Orden de servicio en Modal
  function mostrarOrd(row){

    $("#modOrden tbody").append(row);      
  }

  //// trae tareas segun id de orden y arma tabla en modal 
  function getTarOrden(id_ord){
    //console.log('id de orden en funcion get tareas');
    //console.log(id_ord);
    var dataF = function () {
        var tmp = null;
        $.ajax({
                  'data' : {id_orden:id_ord },// viene de variable global id_orden.
                  'async': false,
                  'type': "POST",
                  'global': false,
                  'dataType': 'json',
                  'url': "Ordenservicio/getTareaOrden",
                  'success': function (data) {
                      tmp = data;
                  }
              });
              return tmp;
        }();  

      // Asigna opciones al select #tareas      
      var tblTareas= $("#modTarea");
      $.each(dataF, function(i, val){           
          tblTareas.append(
              '<tr>'+                     
                     '<td>'+ val.descripcion +'</td>'+
                     '<td>'+ val.componente +'</td>'+
                     '<td>'+ val.horas +'</td>'+
                     '<td>'+ val.monto +'</td>'+                     
              '<tr>'
          )
      });
  }

  //// trae herramientas segun id de orden y arma tabla en modal 
  function getHerrramOrden(id_ord){

      var dataF = function () {
          var tmp = null;
          $.ajax({
                    'data' : {id_orden:id_ord },
                    'async': false,
                    'type': "POST",
                    'global': false,
                    'dataType': 'json',
                    'url': "Ordenservicio/getHerramOrden",
                    'success': function (data) {
                        tmp = data;
                    }
                });
                return tmp;
          }();        
      
      var tblHerram= $("#modHerram"); 
      $.each(dataF, function(i, val){           
            tblHerram.append(
                '<tr>'+                     
                       '<td>'+ val.herrdescrip +'</td>'+
                       '<td>'+ val.herrmarca +'</td>'+
                       '<td>'+ val.herrcodigo +'</td>'+                                         
                '<tr>'
            )
      });
  }

  //// trae Insumos segun id de orden y arma tabla en modal 
  function getInsumOrd(id_ord){

      var dataF = function () {
          var tmp = null;
          $.ajax({
                    'data' : {id_orden:id_ord },
                    'async': false,
                    'type': "POST",
                    'global': false,
                    'dataType': 'json',
                    'url': "Ordenservicio/getInsumOrden",
                    'success': function (data) {
                        tmp = data;
                    }
                });
                return tmp;
          }();        
      
      var tblHerram= $("#modInsum"); 
      $.each(dataF, function(i, val){           
            tblHerram.append(
                '<tr>'+                     
                       '<td>'+ val.descripcion +'</td>'+
                       '<td>'+ val.cantidad +'</td>'+
                       '<td>'+ val.deposito +'</td>'+                                         
                '<tr>'
            )
      });
  }

  //// trae RRHH segun id de orden y arma tabla en modal 
  function getRecOrden(id_ord){

      var dataF = function () {
          var tmp = null;
          $.ajax({
                    'data' : {id_orden:id_ord },
                    'async': false,
                    'type': "POST",
                    'global': false,
                    'dataType': 'json',
                    'url': "Ordenservicio/getOperarioOrden",
                    'success': function (data) {
                        tmp = data;
                    }
                });
                return tmp;
          }();        
      
      var tblHerram= $("#modRecurso"); 
      $.each(dataF, function(i, val){           
            tblHerram.append(
                '<tr>'+                     
                       '<td>'+ val.operario +'</td>'+                               
                '<tr>'
            )
      });
  }

   
</script>

<script>
$(document).ready(function(event){    
    $('#tblorden').DataTable({
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
     

</script>
