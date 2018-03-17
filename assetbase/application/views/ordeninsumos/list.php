<input type="hidden" id="permission" value="<?php echo $permission;?>">
<section class="content">
  <div class="row">
    <div class="col-xs-12">
      <div class="box">
        <div class="box-header">
        <br>
          <h3 class="box-title">Orden de Insumo</h3>
          <?php
          if (strpos($permission,'Add') !== false) {
            echo '<button class="btn btn-block btn-success" style="width: 100px; margin-top: 10px;" id="btnAgre">Agregar</button>';
          }
          ?>
        </div><!-- /.box-header -->
        <div class="box-body">
          <table id="insumo" class="table table-bordered table-hover" style="text-align: center">
            <thead>
              <tr>                
                <th width="20%" style="text-align: center">Acciones</th>
                <th style="text-align: center">Orden de Insumo</th>
                <th style="text-align: center">Fecha</th>
            
               
              </tr>
            </thead>
            <tbody>
              <?php

                  
                  foreach($list['data'] as $a)
                  { 
                    
                
                    $id=$a['id_orden'];
                    echo '<tr id="'.$id.'">';
                    echo '<td>';

                     echo '<i class="fa fa-fw fa-print" style="color: #A4A4A4; cursor: pointer; margin-left: 15px;" title="Imprimir"  ></i> ';
                     echo '<i class="fa fa-fw fa-search-plus" style="color: #A4A4A4; cursor: pointer; margin-left: 15px;" data-toggle="modal" data-target="#modalvista" title="Consultar"></i> ';
                                      

                   
                    echo '</td>';
                    
                    echo '<td style="text-align: center">'.$a['id_orden'].'</td>';
                    echo '<td style="text-align: center">'.date_format(date_create($a['fecha']), 'd-m-Y').'</td>';
                    
                   
                    
                  
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
//  var isOpenWindow = false;
  var comglob="";
  var ide="";
  var edit=0;
    datos=Array();

$(document).ready(function(event) {

        datos=Array();
      $('#btnAgre').click( function cargarVista(){
        WaitingOpen();
        $('#content').empty();
        $("#content").load("<?php echo base_url(); ?>index.php/Ordeninsumo/cargarlista/<?php echo $permission; ?>");
        WaitingClose();
      });

      $(".fa-print").click(function (e) {

           e.preventDefault();
          var id_orden = $(this).parent('td').parent('tr').attr('id');
          console.log("El id de orden al imprimir es :");
          console.log(id_orden);
         // alert(id_orden);

        $.ajax({
              type: 'POST',
              data: { id_orden: id_orden},
              url: 'index.php/Ordeninsumo/getsolImp', //index.php/
              success: function(data){
                      //data = JSON.parse(data,true);
                      console.log("Entre a la impresion");
                      console.log(data);
                      console.log(data.datos.fecha);
                     // console.log(data['f_solicitado']);
                      //alert("entre");
                     // console.log(data['datos'][0]['fecha']);

                     datos={

                        'id_orden':id_orden,
                        'fecha':data.datos.fecha,
                        'id_orden_insumo':data.datos.id_ordeninsumo,

                        
                        'solicitante':data.datos.solicitante,

                        

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
                                              '<br>'+
                                            '</td>'+
                                           
                                            '<td colspan="2"  align="left" >'+
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
                                          '<br>'+
                                          '<tr>'+
                                            '<td height="2" colspan="2">'+
                                              '<div class="col-md-3 col-md-offset-9">Solicitado  '+
                                              '<textarea class="form-control" id="solicitante" name="solicitante" style="padding-left:15px"  value='+datos.solicitante+' rows="2" cols="90">'+datos.solicitante+'</textarea>'+
                                              '</div>'+
                                                
                                            '</td'+
                                          '</tr>'+
                                          '<br>'+
                                          
                                          '</tr>'+
                                        '</table>'+
                                      '</div>'+
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
                                              '<th width="5%">Item  (Tachar sino corresponde)</th>'+
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
                                            '<tr>'+
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
                                            '<tr>'+
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
                                            '<tr>'+
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
                                    '<br>'+
                                    '<br>'+
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

   $(".fa-search-plus").click(function (e) { 

       // $("#modalvista tbody tr").remove();
       
    
        $('#total').val(''); 
        $("#modalvista tbody tr").remove(); 
                       
        console.log("Esto Consultando"); 
        var idor = $(this).parent('td').parent('tr').attr('id');
        console.log(idor);
        
        $.ajax({
                type: 'POST',
                data: { idor: idor},
                url: 'index.php/Ordeninsumo/consultar', //index.php/
                success: function(data){
                        //var data = jQuery.parseJSON( data );
                        console.log("Estoy Consultando");
                        console.log(data);
                        console.log(data['datos'][0]['id_ordeninsumo']);
                         console.log(data['equipos'][0]['artBarCode']);
                         console.log(data['total'][0]['cantidad']);
                       // console.log(data.datos.abonodescrip);
                        //console.log(data['datos']['id_ordeninsumo']);
                        //console.log(data['datos'][1]['abonodescrip']);

                       datos={
                              'id':data['datos'][0]['id_orden'],

                              'fecha':data['datos'][0]['fecha'],
                              'solicitante':data['datos'][0]['solicitante'],
                              'comprobante':data['datos'][0]['comprobante'],

                              
                             

                              }
                  
                    $('#total').val(data['total'][0]['cantidad']);

                    $('#orden').val(data['datos'][0]['id_ordeninsumo']);
                    $('#fecha').val(data['datos'][0]['fecha']);

                 
                   

                    for (var i = 0; i < data['equipos'].length; i++) {  
                    var tabla = "<tr >"+
                              "<td ></td>"+
                              "<td>"+data['equipos'][i]['codigo']+"</td>"+
                              "<td>"+data['equipos'][i]['artBarCode']+"</td>"+
                              "<td>"+data['equipos'][i]['depositodescrip']+"</td>"+
                               "<td>"+data['equipos'][i]['cantidad']+"</td>"+
                              
                              
                              "</tr>";
                  $('#tablaconsulta tbody').append(tabla);

                  }
                  console.log(tabla);

                                
                      },
                  
                error: function(result){
                      
                      console.log(result);
                    },
                    dataType: 'json'
          });   
    });



    $('#insumo').DataTable({
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

      <!-- Modal CONSULTA-->
 <div class="modal fade" id="modalvista" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-lg" role="document" style="width: 60%">
    <div class="modal-content">

      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title"  id="myModalLabel"><span id="modalAction" class="fa fa-fw fa-search-plus" style="color: #0000FF" > </span> Consulta</h4>
      </div> <!-- /.modal-header  -->

      <div class="modal-body input-group ui-widget" id="modalBodyArticle">

      <div class="col-xs-6">Orden de insumo:
        <input type="text" class="form-control"  id="orden" name="orden" >
      </div>
       <div class="col-xs-6">Fecha:
        <input type="text" class="form-control"  id="fecha" name="fecha" >
      </div>

      
          <div class="row">
            <div class="col-xs-10 col-xs-offset-1">
              <table class="table table-bordered" id="tablaconsulta"> 
                <thead>
                  <tr>                           
                    <br>
                    <th width="35px"></th>
                    <th width="10%">Lote</th>
                    <th width="10%">Articulo </th>
                    <th width="10%">Deposito </th>
                    <th width="10%">Cantidad </th>
                  </tr>
                </thead>
                <tbody>
                  
                </tbody>
              </table>
            </div>
          </div> 
      <div class="col-xs-8">Total:
        <input type="text" class="form-control"  id="total" name="total" >
      </div>

     
       </div>  <!-- /.modal-body -->
    </div> <!-- /.modal-content -->

  </div>  <!-- /.modal-dialog modal-lg -->
</div>  <!-- /.modal fade -->
<!-- / Modal -->