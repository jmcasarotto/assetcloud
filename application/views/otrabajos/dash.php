<input type="hidden" id="permission" value="<?php echo $permission;?>">
<section class="content">
  <div class="row">
    <div class="col-xs-12">
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">KPIs</h3>
          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
              <i class="fa fa-minus"></i></button>
          </div>
        </div><!-- /.box-header -->

        <div class="box-body">
          <div class="row">
              <div class="col-md-6 col-xs-12"> <!-- class="daterange"-->
                <h3><center>Disponibilidad [%]</center></h3>
                  <?php $disponibilidad = calcularDisponibilidad('all');
                  /*
                  echo "<pre>";
                  echo json_encode(array_values($disponibilidad["tiempo"]));
                  echo "</pre>";
                  */
                  ?>
                  <script type="text/javascript">
                    var porcentajeHorasOperativas = <?php echo json_encode( array_values($disponibilidad["porcentajeHorasOperativas"]) ) ?>;
                    var tiempo = <?php echo json_encode( array_values($disponibilidad["tiempo"]) ) ?>;
                  </script>

                <div class="row">
                  <div class="col-md-6 col-xs-12">
                    <div data-disponibilidad="">
                      <label>Seleccione el equipo: </label>
                      <input type="hidden" id="id_equipo" name="id_equipo">
                      <select class="form-control input-medium" id="equipo" name="equipo" >
                          <!--
                          -->
                      </select>
                    </div>
                  </div>

                  <div class="col-md-6 col-xs-12 daterange-disponibilidad">
                    <label>Rango de fechas: </label>
                    <input type="text" id="daterange-disponibilidad" class="form-control">
                    <i class="glyphicon glyphicon-calendar fa fa-calendar"></i>

                    <style>
                    .daterange-disponibilidad i {
                        position: absolute;
                        bottom: 10px;
                        right: 24px;
                        top: auto;
                        cursor: pointer;
                    }
                    </style>
                 </div>
                </div>

                <div id="graph-container">
                  <canvas id="graficoDisponibilidad" style="width: 100%; margin:0 auto"></canvas>
                </div>
              </div>

              <div class="col-md-3 col-xs-12 daterange">
                <h3><center>Mantenimiento [%]</center></h3>
                <div class="graph-container-1" style="width:100%; max-width: 250px; margin:0 auto 20px;">
                      <canvas id="graficoMantenimiento"></canvas>
                  </div>
              </div>

              <div class="col-md-3 col-xs-12 daterange">
                <h3><center>Equipos Operativos [%]</center></h3>
                <div class="graph-container-2" style="width:100%; max-width: 250px; margin:0 auto 20px;">
                      <canvas id="graficoEquiposOperativos"></canvas>
                  </div>
              </div>


          </div><!-- /.row -->
        </div>

      </div><!-- /.box -->
      <div class="box collapsed-box">

        <div class="box-header">
          <h3 class="box-title">Orden de trabajo</h3>
          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
              <i class="fa fa-plus"></i></button>
          </div>
        </div><!-- /.box-header -->
        <div class="box-body">
          <?php
          if (strpos($permission,'Add') !== false) {
            echo '<button class="btn btn-block btn-success" style="width: 100px; margin-top: 10px;"  data-toggle="modal" data-target="#modalagregar" id="btnAdd">Agregar</button><br>';
          }
          ?>
          <table id="otrabajo" class="table table-bordered table-hover">
            <thead>
              <tr>
                <th width="20%">Acciones</th>
                <th>Nro</th>
                <th>Fecha</th>
                <th>Fecha Entrega</th>
                <th>Fecha Terminada </th>
                <th>Detalle </th>
                <th>Cliente </th>
                <th>Solicita </th>
                <th>Asignado </th>
                <th>Estado </th>

              </tr>
            </thead>
            <tbody>
              <?php
                if(count($list) > 0) {

                  $userdata = $this->session->userdata('user_data');
                  $usrId= $userdata[0]['usrId'];
                  foreach($list as $a){
                    if(($a['id_usuario_a'] == $usrId) && ($usrId != 1)  && ($a['id_usuario_a'] != 1)){

                      if($a['estado'] =='As'){
                        $id=$a['id_orden'];
                        echo '<tr id="'.$id.'" class="'.$id.'">';
      	                echo '<td>';

                        //  if ($a['estado']!='E'){
                        if (strpos($permission,'Edit') !== false) {
      	                	echo '<i class="fa fa-fw fa-pencil" style="color: #f39c12; cursor: pointer; margin-left: 15px;" title="Editar" data-toggle="modal" data-target="#modaleditar" ></i>';

                        }
                        if (strpos($permission,'Del') !== false) {
      	                	echo '<i class="fa fa-fw fa-times-circle" style="color: #dd4b39; cursor: pointer; margin-left: 15px;" title="Eliminar"></i>';
                        }

                        if (strpos($permission,'Asignar') !== false) {
                          echo '<i class="fa fa-thumb-tack " style="color: #006400; cursor: pointer; margin-left: 15px;" title="Asignar a Taller"></i>';
                        }

                        if (strpos($permission,'OP') !== false) {
                          echo '<i class="fa fa-tags" style="color: #3c8dbc; cursor: pointer; margin-left: 15px;"  title="Cargar Pedido " data-toggle="modal" data-target="#modalpedido"></i>';

                         echo '<i class="fa fa-sticky-note-o" style="color: #D2691E; cursor: pointer; margin-left: 15px;"  title="Asignar tarea " id="btnAddtarea"></i>';
                        }

                        if (strpos($permission,'Pedidos') !== false) {
                          echo '<i class="fa fa-truck" style="color: #3c8dbc; cursor: pointer; margin-left: 15px;"  title="Mostrar Perdido " data-toggle="modal" data-target="#modallista"></i>';

                          if(($a['estado'] == 'As') || ($a['estado'] == 'P')) {

                            echo '<i  href="#" class="fa fa-fw fa fa-toggle-on" style="color: #3c8dbc; cursor: pointer; margin-left: 15px;" title="Finalizar Orden" data-toggle="modal" data-target="#modalfinalizar"></i>';

                          }

                        }

      	                echo '</td>';
                        echo '<td style="text-align: right">'.$a['nro'].'</td>';
      	                echo '<td style="text-align: left">'.$a['fecha_inicio'].'</td>';
                        echo '<td style="text-align: right">'.$a['fecha_entrega'].'</td>';
                        echo '<td style="text-align: right">'.$a['fecha_terminada'].'</td>';
                        echo '<td style="text-align: right">'.$a['descripcion'].'</td>';
                        echo '<td style="text-align: left">'.$a['cliLastName'].' , '.$a['cliName'].'</td>';
                        echo '<td style="text-align: right">'.$a['usrName'].'</td>';
                        echo '<td style="text-align: right">'.$a['nombre'].'</td>';
                        echo '<td style="text-align: center">'.($a['estado'] == 'C' ? '<small class="label pull-left bg-green">Curso</small>' : ($a['estado'] == 'P' ? '<small class="label pull-left bg-red">Pedido</small>' : ($a['estado'] == 'As' ? '<small class="label pull-left bg-yellow">Asignado</small>' : '<small class="label pull-left bg-blue">Terminado</small>'))).'</td>';
      	                echo '</tr>';
                      }

                    }

                      if( $usrId == 1 ||  $a['id_usuario_a'] == 1 ){
                        if($a['estado'] !='T' && $a['estado'] !='E'  && $a['estado'] !='TE'){
                          $id=$a['id_orden'];
                          echo '<tr id="'.$id.'" class="'.$id.'">';
                          echo '<td>';

                          //  if ($a['estado']!='E'){
                          if (strpos($permission,'Edit') !== false) {
                            echo '<i class="fa fa-fw fa-pencil" style="color: #f39c12; cursor: pointer; margin-left: 15px;" title="Editar" data-toggle="modal" data-target="#modaleditar" ></i>';

                          }
                          if (strpos($permission,'Del') !== false) {
                            echo '<i class="fa fa-fw fa-times-circle" style="color: #dd4b39; cursor: pointer; margin-left: 15px;" title="Eliminar"></i>';
                          }

                          if (strpos($permission,'Asignar') !== false) {
                            echo '<i class="fa fa-thumb-tack " style="color: #006400; cursor: pointer; margin-left: 15px;" title="Asignar a Taller"></i>';
                          }
                         /* if (strpos($permission,'Finalizar') !== false) {
                            echo '<i class="fa fa-thumbs-up" style="color: #3c8dbc; cursor: pointer; margin-left: 15px;" title="Finalizar Orden" onclick="finalOT('.$a['id_orden'].',\'View\')"></i>';
                          }*/
                          if (strpos($permission,'OP') !== false) {
                            echo '<i class="fa fa-tags" style="color: #3c8dbc; cursor: pointer; margin-left: 15px;"  title="Cargar Pedido " data-toggle="modal" data-target="#modalpedido"></i>';

                           echo '<i class="fa fa-sticky-note-o" style="color: #D2691E; cursor: pointer; margin-left: 15px;"  title="Asignar tarea " id="btnAddtarea"></i>';
                          }

                          if (strpos($permission,'Pedidos') !== false) {
                            echo '<i class="fa fa-truck" style="color: #3c8dbc; cursor: pointer; margin-left: 15px;"  title="Mostrar Perdido " data-toggle="modal" data-target="#modallista"></i>';

                            if(($a['estado'] == 'As' || $a['estado'] == 'P') && $a['id_usuario_a'] == $usrId){

                              echo '<i  href="#" class="fa fa-fw fa fa-toggle-on" style="color: #3c8dbc; cursor: pointer; margin-left: 15px;" title="Finalizar Orden" data-toggle="modal" data-target="#modalfinalizar"></i>';

                            }

                          }

                          echo '</td>';
                          echo '<td style="text-align: right">'.$a['nro'].'</td>';
                          echo '<td style="text-align: left">'.$a['fecha_inicio'].'</td>';
                          echo '<td style="text-align: right">'.$a['fecha_entrega'].'</td>';
                          echo '<td style="text-align: right">'.$a['fecha_terminada'].'</td>';
                          echo '<td style="text-align: right">'.$a['descripcion'].'</td>';
                          echo '<td style="text-align: left">'.$a['cliLastName'].' , '.$a['cliName'].'</td>';
                          echo '<td style="text-align: right">'.$a['usrName'].'</td>';
                          echo '<td style="text-align: right">'.$a['nombre'].'</td>';
                          echo '<td style="text-align: center">'.($a['estado'] == 'C' ? '<small class="label pull-left bg-green">Curso</small>' : ($a['estado'] == 'P' ? '<small class="label pull-left bg-red">Pedido</small>' : ($a['estado'] == 'As' ? '<small class="label pull-left bg-yellow">Asignado</small>' : '<small class="label pull-left bg-blue">Terminado</small>'))).'</td>';
                          echo '</tr>';
                        }

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


<?php
  $cantTipoOT = cantTipoOrdenTrabajo();
  // $cantTipoOT[0]['CantidadTipoOT'] = correctivo;
  // $cantTipoOT[2]['CantidadTipoOT'] = preventivo;
  // $cantTipoOT[3]['CantidadTipoOT'] = predictivo;
  // $cantTipoOT[4]['CantidadTipoOT'] = backlog;
  /* En DB tabla orden_trabajo, en el campi tipo */
  // 1 = correctivo
  // 2 = preventivo
  // 3 = predictivo
  // 4 = backlog

  $equipoOperativo = sacarEquiposOperativos();
?>

<style type="text/css">
  .daterange { position: relative; }
  .daterange i {
    position: relative; right: 24px; cursor: pointer;
  }
</style>



<script>
$(document).ready( function(event) {
    traerEquipos();
});

/* Trae todos los equipos */
function traerEquipos() {
    $.ajax({
        type: 'POST',
        data: {},
        dataType: 'json',
        url: 'index.php/Grafica/getEquipos',
        success: function(data){
            console.info("equipos cargados exitosamente");

            var opcion  = "<option value='all'>Todos los equipos</option>";
            $('#equipo').append(opcion);
            for(var i=0; i < data.length ; i++)
            {
                var nombre = data[i]['codigo'];
                var opcion  = "<option value='"+data[i]['id_equipo']+"' title='"+data[i]['descripcion']+"' data-toggle='tooltip'>" +nombre+ "</option>" ;

                $('#equipo').append(opcion);
            }
        },
        error: function(result){
            //alert(result);
            console.error("problemas al traer los equipos: " + result);
        },
    });
}
</script>



<script>
var equipos                   = 'all';
var porcentajeHorasOperativas = <?php echo json_encode( array_values($disponibilidad["porcentajeHorasOperativas"]) ) ?>;
var tiempo                    = <?php echo json_encode( array_values($disponibilidad["tiempo"]) ) ?>;

var locale = {
  "format": "DD/MM/YYYY",
  "separator": " - ",
  "applyLabel": "Ok",
  "cancelLabel": "Cancelar",
  "fromLabel": "Desde",
  "toLabel": "Hasta",
  "customRangeLabel": "Custom",
  "daysOfWeek": [
    "Do",
    "Lu",
    "Ma",
    "Mi",
    "Ju",
    "Vi",
    "Sa"
  ],
  "monthNames": [
    "Enero",
    "Febrero",
    "Marzo",
    "Abril",
    "Mayo",
    "Junio",
    "Julio",
    "Agusto",
    "Septiembre",
    "Octubre",
    "Noviembre",
    "Diciembre"
  ],
  "firstDay": 1
};

var date = new Date();
var dateToday      = new Date(date.getFullYear(), date.getMonth(), date.getDate());
//var date7days      = moment().subtract(7,'d').format('YYYY/MM/DD');
//alert(date7days);
var date7days      = new Date(date.getFullYear(), date.getMonth(), -6);
var date30days     = new Date(date.getFullYear(), date.getMonth(), -30);
var dateThisMonth1 = new Date(date.getFullYear(), date.getMonth(), 1);     // dia 1 de mes actual
var dateThisMonth2 = new Date(date.getFullYear(), date.getMonth() + 1, 0); // ultimo dia del mes actual
var dateLastMonth1 = new Date(date.getFullYear(), date.getMonth() -1, 1);  // dia 1 del mes anterior
var dateLastMonth2 = new Date(date.getFullYear(), date.getMonth(), 0);     // ultimo dia del mes anterior
var date6months    = new Date(date.getFullYear(), date.getMonth() -5);     // 6 meses = este mes + 5
var date1year      = new Date(date.getFullYear(), date.getMonth() -11);    // 12 meses = este mes + 11

var fechainicio = moment(date1year).format('YYYY/MM/DD');
var fechafin    = dateToday;

/*
var fechainicio = moment(date1year).format('YYYY/MM/DD');
var fechafin    = moment(dateToday).format('YYYY/MM/DD');
dateToday      = moment(dateToday).format('YYYY/MM/DD');
date7days      = moment(date7days).format('YYYY/MM/DD');
date30days     = moment(date30days).format('YYYY/MM/DD');
dateThisMonth1 = moment(dateThisMonth1).format('YYYY/MM/DD');
dateThisMonth2 = moment(dateThisMonth2).format('YYYY/MM/DD');
dateLastMonth1 = moment(dateLastMonth1).format('YYYY/MM/DD');
dateLastMonth2 = moment(dateLastMonth2).format('YYYY/MM/DD');
date6months    = moment(date6months).format('YYYY/MM/DD');
date1year      = moment(date1year).format('YYYY/MM/DD');
*/
var ranges = {
  "Últimos 7 días": [
    date7days,
    dateToday
  ],
  "Últimos 30 días": [
    date30days,
    dateToday
  ],
  "Este mes": [
    dateThisMonth1,
    dateThisMonth2
  ],
  "Mes anterior": [
    dateLastMonth1,
    dateLastMonth2
  ],
  "Últimos 6 meses": [
    date6months,
    dateThisMonth2
  ],
  "Último año": [
    date1year,
    dateThisMonth2
  ]
};

//alert(ranges["Últimos 7 días"]);
$('#daterange-disponibilidad').daterangepicker({
  "locale": locale,
    "ranges": ranges,
    "startDate": date1year,
    "endDate": dateToday
}, function(start, end, label) {
  console.log('New date range selected: ' + start.format('YYYY/MM/DD') + ' to ' + end.format('YYYY/MM/DD') + ' (predefined range: ' + label + ')');
  fechainicio = start.format('YYYY/MM/DD');
  fechafin    = end.format('YYYY/MM/DD');
  var parametros = {
    'idEquipo'    : equipos,
    'fechaInicio' : fechainicio,
    'fechaFin'    : fechafin,
  };
  $.ajax({
      data: { parametros: parametros },
      dataType: 'json',
      type: 'POST',
      url: 'index.php/dash/disponibilidad',  //index.php/

      success: function(data){
          equipos = 1;
          tiempo = data.tiempo;
          porcentajeHorasOperativas = data.porcentajeHorasOperativas;
          graficarDisponibilidad();
      },
      error: function(result){
          console.log('Error');
      }
  });
});

/* trae parametros al seleccionar el equipo */
$("#equipo").on("change", function() {
  //console.info('New date range selected: ' + start.format('YYYY/MM/DD') + ' to ' + end.format('YYYY/MM/DD') + ' (predefined range: ' + label + ')');
  //alert('fecha inicio: '+fechaInicio+' - fecha fin: '+fechafin);
  var parametros = {
    'idEquipo'    : $(this).val(),
    'fechaInicio' : fechainicio,
    'fechaFin'    : fechafin,
  };
  $.ajax({
      data: { parametros: parametros },
      dataType: 'json',
      type: 'POST',
      url: 'index.php/dash/disponibilidad',  //index.php/

      success: function(data){
          equipos = 1;
          tiempo = data.tiempo;
          porcentajeHorasOperativas = data.porcentajeHorasOperativas;
          graficarDisponibilidad();
      },
      error: function(result){
          console.log('Error');
      }
  });

});



graficarDisponibilidad();
/**/
function graficarDisponibilidad() {

  //elimino el canvas, por si hay un grafico preexistente. Para que no haya conflicto entre graficos. Y lo vuelvo a crear.
  $('#graficoDisponibilidad').remove();
  $('#graph-container').append('<canvas id="graficoDisponibilidad" style="width: 100%; margin:0 auto"></canvas>');

  var ctx = document.getElementById("graficoDisponibilidad");
  //var ctx = canvas.getContext("2d");

  var horizonalLinePlugin = {
    afterDraw: function(chartInstance) {
      var yScale = chartInstance.scales["y-axis-0"];
      var canvas = chartInstance.chart;
      var ctx = canvas.ctx;
      var index;
      var line;
      var style;

      if (chartInstance.options.horizontalLine) {
        for (index = 0; index < chartInstance.options.horizontalLine.length; index++) {
          line = chartInstance.options.horizontalLine[index];

          if (!line.style) {
            style = "#86888e";
          } else {
            style = line.style;
          }

          if (line.y) {
            yValue = yScale.getPixelForValue(line.y);
          } else {
            yValue = 0;
          }

          ctx.lineWidth = 2;

          if (yValue) {
            ctx.beginPath();
            ctx.moveTo(0, yValue);
            ctx.lineTo(canvas.width, yValue);
            ctx.strokeStyle = style;
            ctx.stroke();
          }

          if (line.text) {
            ctx.fillStyle = style;
            ctx.fillText(line.text, 0, yValue + ctx.lineWidth);
          }
        }
        return;
      };
    }
  };
  Chart.pluginService.register(horizonalLinePlugin);

  porcentajeHorasOperativas = [80].concat( porcentajeHorasOperativas );
  tiempo = ["meta"].concat( tiempo );

  var data = {
    labels: tiempo,
    //labels: ['Meta', '2017-04', '2017-05'],
    //['Meta', 'Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
    datasets: [{
      backgroundColor: ["#009900"],
      data: porcentajeHorasOperativas,
      //data : [80, 100, 52],//[80, 66, 70, 71, 75, 81, 77, 78, 77, 82, 81, 78, 80],
      fill: false,
      label: ['Meta'],
      lineTension: 0.2,
      pointRadius: 2,
      pointHitRadius: 10,
      spanGaps: false,
    }],
  };

  var miGrafico = new Chart(ctx, {
    type: 'bar',
    data: data,
    options: {
      "horizontalLine": [{
        "y": 80,
        "style": "#009900",
        "text": "meta"
      }],
      responsive: true,
      maintainAspectRatio: true,
      scales: {
        yAxes: [{
          ticks: {
            //max: 100,
            //beginAtZero:true,
          }
        }]
      },
      tooltips: {
        callbacks: {
          label: function(tooltipItem, data) {
            //get the concerned dataset
            var dataset = data.datasets[tooltipItem.datasetIndex];
            //get the current items value
            var currentValue = dataset.data[tooltipItem.index];
            return currentValue + "%";
          }
        }
      }
    }
  });
}








</script>





<script>
graficarMantenimiento();
/* grafico  usando charjs 2.5 */
function graficarMantenimiento() {
    var areaChartCanvas = document.getElementById("graficoMantenimiento");

    var myChart = new Chart(areaChartCanvas, {
        type: 'doughnut',
        data: {
            // programado: [preventivo, predictivo y backlog], correctivo
            labels: ["Correctivo", "Preventivo", "Predictivo", "backlog"],
            datasets: [{
                data: [ <?php echo $cantTipoOT[0]['CantidadTipoOT']?>,
                        <?php echo $cantTipoOT[1]['CantidadTipoOT']?>,
                        <?php echo $cantTipoOT[2]['CantidadTipoOT']?>,
                        <?php echo $cantTipoOT[3]['CantidadTipoOT']?>],
                backgroundColor: [
                "#dd1100",
                "#006612",
                "#009933",
                "#00CC00"
                ],
                hoverBackgroundColor: [
                "#ee2211",
                "#117723",
                "#11aa44",
                "#11dd11"
                ]
            }]
        },
        options: {
            cutoutPercentage: 40,
            legend: {
              position: 'bottom',
            },
            animation: {
              animateScale: true,
              animateRotate: true
            },
            tooltips: {
              callbacks: {
                label: function(tooltipItem, data) {
                  //get the concerned dataset
                  var dataset = data.datasets[tooltipItem.datasetIndex];
                  //calculate the total of this data set
                  var total = dataset.data.reduce(function(previousValue, currentValue, currentIndex, array) {
                    return previousValue + currentValue;
                  });
                  //get the current items value
                  var currentValue = dataset.data[tooltipItem.index];
                  //calculate the precentage based on the total and current item, also this does a rough rounding to give a whole number
                  var precentage = Math.floor(((currentValue/total) * 100)+0.5);

                  return currentValue + " (" + precentage + "%)";
                }
              }
            }
        }
    });
}

graficarEquiposOperativos();
/**/
function graficarEquiposOperativos() {
    var areaChartCanvas = document.getElementById("graficoEquiposOperativos");

    var myChart = new Chart(areaChartCanvas, {
        type: 'doughnut',
        data: {
            labels: ["Operativo", "No Operativo"],
            datasets: [{
                data: [ <?php echo $equipoOperativo[0]['cantEstadoActivo']?>,
                        <?php echo $equipoOperativo[1]['cantEstadoActivo']?>],
                backgroundColor: [
                "#146bb6",
                "#FF9600"
                ],
                hoverBackgroundColor: [
                "#257cc7",
                "#ffa711"
                ]
            }]
        },
        options: {
            cutoutPercentage: 40,
            legend: {
              position: 'bottom',
            },
            animation: {
              animateScale: true,
              animateRotate: true
            },
            tooltips: {
              callbacks: {
                label: function(tooltipItem, data) {
                  //get the concerned dataset
                  var dataset = data.datasets[tooltipItem.datasetIndex];
                  //calculate the total of this data set
                  var total = dataset.data.reduce(function(previousValue, currentValue, currentIndex, array) {
                    return previousValue + currentValue;
                  });
                  //get the current items value
                  var currentValue = dataset.data[tooltipItem.index];
                  //calculate the precentage based on the total and current item, also this does a rough rounding to give a whole number
                  var precentage = Math.floor(((currentValue/total) * 100)+0.5);

                  return currentValue + " (" + precentage + "%)";
                }
              }
            }
        }
    });
}
</script>


<script>
var ido ="";
var idp ="";
var idArt = 0;
var acArt = '';
var i ="";
var idord ="";
$(document).ready(function(event) {

  //Al apretar la opcion asignar tareas , esto lleva a esa pantalla
  $(".fa-sticky-note-o").click(function (e) {

    var id = $(this).parent('td').parent('tr').attr('id');
    console.log("El id de OT es:");
    console.log(id);
    iort= id;
    WaitingOpen();
    $('#content').empty();
    $("#content").load("<?php echo base_url(); ?>index.php/Otrabajo/cargartarea/<?php echo $permission; ?>/"+iort+"");
    WaitingClose();

  });


  //Asignar
  $(".fa-thumb-tack").click(function (e) {

    $('#modalAsig').modal('show');
    var id_orden = $(this).parent('td').parent('tr').attr('id');
    $.ajax({
        type: 'GET',
        data: { id_orden: id_orden},
        url: 'index.php/Otrabajo/getasigna',
        success: function(data){

                console.log(data);
                datos={
                  'id_orden':id_orden,
                  'nro':data['datos'][0]['nro'],
                  'fecha_inicio':data['datos'][0]['fecha_inicio'],
                  'estado':data['datos'][0]['estado'],
                  'descripcion':data['datos'][0]['descripcion'],
                  'cliente': data['datos'][0]['cliLastName']+' '+data['datos'][0]['cliName'],
                  'cliId':data['datos'][0]['cliId'],
                  'id_usuario':data['datos'][0]['id_usuario'],

                };

                var arre = new Array();
                arre=datos['fecha_inicio'].split(' ');

                $('#id_orden').val(datos['id_orden']);
                $('#nro').val(datos['nro']);
                $('#fecha_inicio').val(arre[0]);
                $('#estado').val(datos['estado']);
                $('#cliente').val(datos['cliente']);
                $('#id_cliente').val(datos['cliId']);
                $('#descripcion').val(datos['descripcion']);
                $('#id_usuario').val(datos['id_usuario']);

                click_pedent();
              },

        error: function(result){

              console.log(result);
            },
            dataType: 'json'
        });
  });

  //cargar pedido
  $(".fa-tags").click(function (e) {

    var id_orden = $(this).parent('td').parent('tr').attr('id');
    ido=id_orden; //aca esta el id de orden de trabajo
    console.log("El id de orden para la carga de pedido es :");
    console.log(ido);
    i=1;
    var opcion =i;
    $('#num1').append(opcion);
    i=i+1;

  });


  $(".fa-truck").click(function (e) {

    $("#modallista tbody tr").remove();
    var idorde = $(this).parent('td').parent('tr').attr('id');
    console.log("ID de orden de trabajo para mostrar pedido es :");
    console.log(idorde);
    $.ajax({
        type: 'POST',
        data: { idorde:idorde},
        url: 'index.php/Otrabajo/getmostrar', //index.php/
          success: function(data){
            console.log("llego el detalle");
            console.log(data);

            for (var i = 0; i < data.length; i++) {

              if (data[i]['estado']== 'P'){
              var estado= '<small class="label pull-left bg-green">Pedido</small>';
              }
              else
                if (data[i]['estado']== 'C'){
                var estado= '<small class="label pull-left bg-blue">Curso</small>';
                }
                else
                  if (data[i]['estado']== 'E'){
                  var estado= '<small class="label pull-left bg-red">Entregado</small>';
                  }
                    else{
                      var estado= '<small class="label pull-left bg-yellow">Terminado</small>';
                    }
              var tr = "<tr >"+
                      "<td ></td>"+
                      "<td>"+data[i]['nro_trabajo']+"</td>"+
                      "<td>"+data[i]['fecha']+"</td>"+
                      "<td>"+data[i]['fecha_entrega']+"</td>"+
                      "<td>"+data[i]['provnombre']+"</td>"+
                      "<td>"+data[i]['descripcion']+"</td>"+
                      "<td>"+estado+"</td>"+
                      "</tr>";
              $('#tabladetalle tbody').append(tr);

            }
            console.log(tr);

          },

          error: function(result){
                console.log("Entro x el error de detalle");

                console.log(result);
              },
              dataType: 'json'
    });

  });



  $(".fa-times-circle").click(function (e) {

      console.log("Esto eliminando");
      var idord = $(this).parent('td').parent('tr').attr('id');
      console.log(idord);
      $.ajax({
              type: 'POST',
              data: { idord: idord},
              url: 'index.php/Otrabajo/baja_orden', //index.php/
              success: function(data){
                      console.log("ORDEN DE TRABAJO ELIMINADA");
                      console.log(data);
                      alert("ORDEN DE TRABAJO Eliminada");
                      regresa1();

                    },

              error: function(result){
                    console.log(result);
                 }
      });
  });

 $(".fa-toggle-on").click(function (e) {

    var idord = $(this).parent('td').parent('tr').attr('id');
    console.log(idord);
    idfin=idord;


  });

  $('.vfecha').datepicker({

      changeMonth: true,
      changeYear: true
  });

  $(".fa-pencil").click(function (e) {

    console.log("Estoy editado ");
    var idord = $(this).parent('td').parent('tr').attr('id');
    idp=idord;
    console.log(idord);
    console.log(idp);
    $.ajax({
        type: 'GET',
        data: { idord: idord},
        url: 'index.php/Otrabajo/getpencil', //index.php/
        success: function(data){

              console.log(data);
              console.log(data[0]['nro']);
              datos={
                  'nro':data[0]['nro'],
                  'cli' :data[0]['cliId'],
                  'clientena':data[0]['cliName'],
                  'cliap':data[0]['cliLastName'],
                  'fecha_inicio':data[0]['fecha_inicio'],
                  'idusuario':data[0]['id_usuario'],
                  'nota':data[0]['descripcion'],
                  'id_sucu':data[0]['id_sucursal'],
                  'sucursal':data[0]['descripc'],
                }
              console.log("datos a enviar");
              console.log(datos);
              completarEdit(datos);
              OpenSale();

              },

        error: function(result){

              console.log(result);
            },
            dataType: 'json'
    });

  });
  $(".datepicker").datepicker({

      changeMonth: true,
      changeYear: true
  });

  $('#otrabajo').DataTable({
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
  console.log(datos);
  $('#nroedit').val(datos['nro']);
  $('select#cliidedit').append($('<option />', { value: datos['cli'],text: datos['cliap']+'.'+datos['clientena']+'.'}));
  traer_cli2();
  $('#vfecha').val(datos['fecha_inicio']);
  $('#vsdetalleedit').val(datos['nota']);
  $('select#sucidedit').append($('<option />', { value: datos['id_sucu'],text: datos['sucursal']+'.'}));
  traer_sucursal2();
}

function traer_clientes(idcliente) {
    $('#cliente').html("");
    $.ajax({
          type: 'POST',
          data: { idcliente: idcliente},
          url: 'index.php/Otrabajo/getcliente',  //index.php/
          async:false,
          success: function(data){

                  $('#cliente option').remove();
                   var opcion  = "<option value='-1'>Seleccione...</option>" ;
                  $('#cliente').append(opcion);
                  for(var i=0; i < data.length ; i++) {

                      var apellido = data[i]['cliLastName'];
                      var opcion  = "<option value='"+data[i]['cliId']+"'>" +apellido+ "</option>" ;
                      $('#cliente').append(opcion);
                  }
                },
          error: function(result){

                console.log(result);
              },
              dataType: 'json'
    });
}

traer_usuario();
function traer_usuario(){

      $.ajax({
        type: 'POST',
        data: { },
        url: 'index.php/Otrabajo/getusuario', //index.php/
        success: function(data){

                var opcion  = "<option value='-1'>Seleccione...</option>" ;
                $('#usuario').append(opcion);
                for(var i=0; i < data.length ; i++) {

                      var nombre = data[i]['usrName'];
                      var opcion  = "<option value='"+data[i]['usrId']+"'>" +nombre+ "</option>" ;

                    $('#usuario').append(opcion);

                }
              },
        error: function(result){

              console.log(result);
            },
            dataType: 'json'
      });
}

traer_cli();
function traer_cli(){

    $('#cli').html('');
    $.ajax({
        type: 'POST',
        data: { },
        url: 'index.php/Otrabajo/traer_cli', //index.php/
        success: function(data){
          console.log(data);

                 //var opcion  = "<option value='-1'>Seleccione...</option>" ;
                  $('#cli').append(opcion);
                for(var i=0; i < data.length ; i++)
                {
                      var nombre = data[i]['cliLastName']+' '+data[i]['cliName'];
                      var opcion  = "<option value='"+data[i]['cliId']+"'>" +nombre+ "</option>" ;

                    $('#cli').append(opcion);

                }
              },
        error: function(result){

              console.log(result);
            },
            dataType: 'json'
        });
}

function traer_cli2(){
  $('#cli').html('');
  $.ajax({
    type: 'POST',
    data: { },
    url: 'index.php/Otrabajo/traer_cli', //index.php/
    success: function(data){
      console.log(data);

             //var opcion  = "<option value='-1'>Seleccione...</option>" ;
              $('#cliidedit').append(opcion);
            for(var i=0; i < data.length ; i++)
            {
                  var nombre = data[i]['cliLastName']+' '+data[i]['cliName'];
                  var opcion  = "<option value='"+data[i]['cliId']+"'>" +nombre+ "</option>" ;

                $('#cliidedit').append(opcion);

            }
          },
    error: function(result){

          console.log(result);
        },
        dataType: 'json'
    });
  }

function traer_sucursal2(){
  $('#sucidedit').html('');
    $.ajax({
      type: 'POST',
      data: { },
      url: 'index.php/Otrabajo/traer_sucursal', //index.php/
      success: function(data){

               //var opcion  = "<option value='-1'>Seleccione...</option>" ;
                $('#sucidedit').append(opcion);
              for(var i=0; i < data.length ; i++)
              {
                    var nombre = data[i]['descripc'];
                    var opcion  = "<option value='"+data[i]['id_sucursal']+"'>" +nombre+ "</option>" ;

                  $('#sucidedit').append(opcion);

              }
            },
      error: function(result){

            console.log(result);
          },
          dataType: 'json'
      });
}

traer_proveedor();
function traer_proveedor(){
  $.ajax({
    type: 'POST',
    data: {},
    url: 'index.php/Otrabajo/getproveedor', //index.php/
    success: function(data){

             var opcion  = "<option value='-1'>Seleccione...</option>" ;
              $('#proveedor').append(opcion);
            for(var i=0; i < data.length ; i++)
            {
                  var nombre = data[i]['provnombre'];
                  var opcion  = "<option value='"+data[i]['provid']+"'>" +nombre+ "</option>" ;

                $('#proveedor').append(opcion);
            }
          },
    error: function(result){

          console.log(result);
        },
        dataType: 'json'
    });
}

traer_clientes()
function traer_clientes(){
  $.ajax({
    type: 'POST',
    data: { },
    url: 'index.php/Otrabajo/traer_cli', //index.php/
    success: function(data){

             var opcion  = "<option value='-1'>Seleccione...</option>" ;
              $('#cli').append(opcion);
            for(var i=0; i < data.length ; i++)
            {
                  var nombre = data[i]['cliLastName']+'.,.'+datos['cliName'];
                  var opcion  = "<option value='"+data[i]['cliId']+"'>" +nombre+ "</option>" ;

                $('#cli').append(opcion);

            }
          },
    error: function(result){

          console.log(result);
        },
        dataType: 'json'
    });
  }

traer_sucursal()
function traer_sucursal(){
      $.ajax({
        type: 'POST',
        data: { },
        url: 'index.php/Otrabajo/traer_sucursal', //index.php/
        success: function(data){

                 var opcion  = "<option value='-1'>Seleccione...</option>" ;
                  $('#suci').append(opcion);
                for(var i=0; i < data.length ; i++)
                {
                      var nombre = data[i]['descripc'];
                      var opcion  = "<option value='"+data[i]['id_sucursal']+"'>" +nombre+ "</option>" ;

                    $('#suci').append(opcion);

                }
              },
        error: function(result){

              console.log(result);
            },
            dataType: 'json'
        });
}

function click_pedent(){  var fechai= $("#fecha_inicio").val(); //optengo el valor del campo fecha
   $.ajax({
        type: 'GET',
        data: {fechai:fechai }, // destinodo
        url: 'index.php/Otrabajo/getpedidos', //index.php/
        success: function(data){

                console.log(data);
                var direccion = data[0]['destinodireccion'];
                var contacto = data[0]['destinocontacto'];
                $('#domicilio').val(direccion);
                $('#contacto').val(contacto);

              },
         error: function(result){

              console.log(result);
            },
            dataType: 'json'
        });
}

function guardareditar(){

  console.log("estoy guardando lo editado ");
  var id_orden = $('#id_orden').val();
  var nro = $('#nroedit').val();
  var fecha_inicio = $('#vfecha').val();
  var descripcion = $('#vsdetalleedit').val();
  var id_sucu= $('#sucidedit').val();
  var cliente = $('#cliidedit').val();
  var parametros = {
      //'id_orden': id_orden,
      'nro': nro,
      'fecha_inicio': fecha_inicio,
      'descripcion': descripcion,
      'cliId': cliente,
      'id_sucursal': id_sucu

  };
  console.log(parametros);
  console.log(idp);
    $.ajax({
        type: 'POST',
        data: {parametros:parametros, idp:idp},
        url: 'index.php/Otrabajo/guardar_editar',  //index.php/
        success: function(data){
               // var data = jQuery.parseJSON( result );
               console.log("Exito en la edicion");
                console.log(data);
               /* $('#modalAsig').modal('hide'); */

                 setTimeout(function(){
                       var permisos = '<?php //echo $permission; ?>';
                      cargarView('otrabajos', 'index', permisos) ;
                },3000); // 3000ms = 3s
                regresa1();

              },
        error: function(result){

              console.log(result);
             // $('#modalAsig').modal('hide');
            }
           // dataType: 'json'
    });
}

function guardarpedido(){

  console.log("si guardo pedido");
  var id_orden = $(this).parent('td').parent('tr').attr('id');
  var numero = $('#num1').val();
  var fecha = $('#fecha1').val();
  var fechae = $('#fecha_entrega2').val();
  var proveedor= $('#proveedor').val();
  var descripcion2 = $('#descripcion2').val();
  var parametros = {

      'id_proveedor': proveedor,
      'nro_trabajo': numero,
      'descripcion': descripcion2,
      'fecha' : fecha,
      'fecha_entrega': fechae,
      'estado': 'P',
      'id_trabajo' :ido

  };
  console.log(parametros);
  console.log(ido);
  $.ajax({
        type: 'POST',
        data: {parametros:parametros, ido:ido},
        url: 'index.php/Otrabajo/agregar_pedido',  //index.php/
        success: function(data){
                console.log("Estoy guardando pedido");
                regresa1();

              },
        error: function(result){

              console.log(result);

           }
           // dataType: 'json'
  });
}

//guardar asignacion
function orden(){

  console.log("si guardo ");
  var id_orden = $('#id_orden').val();
  var nro = $('#nro').val();
  var fecha_inicio = $('#fecha_inicio').val();
  var fecha_entrega = $('#fecha_entrega').val();
  var usuario= $('#usuario').val();
  var estado= $('#estado').val();
  var cliente = $('#id_cliente').val();
  var parametros = {
      //'id_orden': id_orden,
      'nro': nro,
      'fecha_inicio': fecha_inicio,
      'fecha_entrega': fecha_entrega,
      'id_usuario_a': usuario,
      'estado': 'As',
      'cliId': cliente
  };
  console.log(parametros);
  console.log(id_orden);
  $.ajax({
      type: 'POST',
      data: {data:parametros, id_orden:id_orden},
      url: 'index.php/Otrabajo/guardar',
      success: function(data){
              console.log(data);
              regresa1();

            },
      error: function(result){

            console.log(result);

          },
          dataType: 'json'
  });
}

//Guarda OT
function guardaragregar(){

  console.log("Guarda OT");
  var id_orden = $('#id_orden').val();
  var num = $('#nro1').val();
  var fecha_inicio = $('#vfech').val();
  var fecha_i = $('#vfechi').val();
  var cliente = $('#cli').val();
  var descripcion= $('#vsdetal').val();
  var sucursal = $('#suci').val();
  var parametros = {
      //'id_orden': id_orden,
      'nro': num,
      'fecha_inicio': fecha_i,
      'descripcion' : descripcion,
      'cliId': cliente,
      'estado': 'C' ,
      'id_usuario': 1,
      'id_usuario_a': 1,
      'id_usuario_e': 1,
      'id_sucursal' : sucursal

  };
  console.log(parametros);
  console.log(id_orden);
  $.ajax({
        type: 'POST',
        data: {parametros:parametros},
        url: 'index.php/Otrabajo/guardar_agregar',  //index.php/
        success: function(data){

                console.log(data);
                regresa1();

              },
        error: function(result){

              console.log(result);

            }

  });
}

//OT TOTAL, pasa a la partalla de ot terminadas
function guardartotal(){

  console.log("Estoy finalizando total la ot ");
  console.log(idfin);
  $.ajax({
        type: 'POST',
        data: { idfin: idfin},
        url: 'index.php/Otrabajo/FinalizaOt', //index.php/
        success: function(data){
                console.log(data);
                alert("Se Finalizando la ORDEN TRABAJO");
                regresa1();
              },

        error: function(result){
              console.log(result);
            }
            //dataType: 'json'
    });
}

//OT PARCIAL, pasa a la partalla de ot PARCIAL
function guardarparcial(){

  console.log("Estoy finalizando parcial la ot ");
  console.log(idfin);
  $.ajax({
        type: 'POST',
        data: { idfin: idfin},
        url: 'index.php/Otrabajo/CambioParcial', //index.php/
        success: function(data){
                console.log(data);
                alert("Se Finalizando PARCIAL LA ORDEN TRABAJO");
                regresa1();
              },

        error: function(result){
              console.log(result);
            }
            //dataType: 'json'
    });
}

//Refresca
function regresa(){

  $('#content').empty(); //listOrden
  $("#content").load("<?php echo base_url(); ?>index.php/Otrabajo/index/<?php echo $permission; ?>");
  WaitingClose();
}

function regresa1(){

    //$('#content').empty();
    //$('#modalOT').empty();
   // $('#modalAsig').empty();
    $("#content").load("<?php echo base_url(); ?>index.php/Otrabajo/listOrden/<?php echo $permission; ?>");
    //WaitingClose();
    //WaitingClose();
}
</script>

<!-- Modal ASIGNA-->
<div id="modalAsig" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title"><span  class="fa fa-thumb-tack " style="color: #006400"></span>   Asignacion Orden de trabajo</h4>
      </div>
      <div class="modal-body">
        <div class="row" >
            <div class="col-sm-12 col-md-12">
              <fieldset> </fieldset>
                <br>
                  <div class="col-xs-8">Nro:
                    <input type="text" class="form-control" id="nro"  name="nro"   disabled >
                  </div>
                  <input type="hidden" id="id_orden" name="id_orden">

                  <div class="col-xs-8">Fecha de inicio:
                    <input type="date" class="form-control" id="fecha_inicio" name="fecha_inicio" disabled>
                  </div>

                  <div class="row" >
                    <div class="col-sm-12 col-md-12">
                      <div class="col-xs-8">Cliente:
                        <input type="text"  id="cliente" name="cliente" class="form-control " disabled >
                        <input type="hidden" id="id_cliente" name="id_cliente">

                      </div>
                      <div class="col-xs-8">Descripcion:

                      </div>
                      <div class="col-xs-12">
                        <textarea  class="form-control" rows="6" cols="500" id="descripcion" name="descripcion" value="" disabled ></textarea>
                      </div>
                    </div>
                  </div>
                  <div class="row" >
                    <div class="col-sm-12 col-md-12">
                      <div class="col-xs-8">Fecha de entrega:
                        <input type="date" id="fecha_entrega" name="fecha_entrega" class="form-control input-md" / >
                      </div>
                      <br>
                      <br>
                      <div  class="col-xs-8">Usuario:
                        <select id="usuario" name="usuario" class="form-control " placeholder="Seleccione usuario" value="" ></select>
                      <input type="hidden" id="id_usuario" name="id_usuario">
                      </div>
                      <br>
                      <br>
                      <div class="col-xs-3">

                      </div>
                    </div>
                  </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
           <button type="button" class="btn btn-default" data-dismiss="modal" onclick="cerro()">Cancelar</button>
            <button type="button" class="btn btn-primary" id="reset" data-dismiss="modal" onclick="orden()">Guardar</button>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Modal editar-->
<div class="modal fade" id="modaleditar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-lg" role="document" style="width: 40%">
    <div class="modal-content">

      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title"  id="myModalLabel"><span id="modalAction" class="fa fa-fw fa-pencil" style="color: #f39c12" > </span> Editar Orden de Trabajo</h4>
       </div> <!-- /.modal-header  -->

      <div class="modal-body input-group ui-widget" id="modalBodyArticle">

        <div class="row">
          <div class="col-xs-4">
           <label style="margin-top: 7px;">Nro <strong style="color: #dd4b39">*</strong>: </label>
          </div>
          <div class="col-xs-8">
            <input type="text" class="form-control" placeholder="Nro Orden de trabajo" id="nroedit" name="nroedit">
          </div>
        </div><br>
        <div class="row">
          <div class="col-xs-4">
            <label style="margin-top: 7px;">Cliente <strong style="color: #dd4b39">*</strong>: </label>
          </div>
          <div class="col-xs-8">
            <select class="form-control select2" id="cliidedit" name="cliidedit" style="width: 100%;">

            </select>
          </div>
        </div><br>

        <div class="row">
          <div class="col-xs-4">
              <label style="margin-top: 7px;">Fecha <strong style="color: #dd4b39">*</strong>: </label>
          </div>
          <div class="col-xs-8">
              <input type="text" class="vfecha" id="vfecha" placeholder="dd-mm-aaaa" name="vfecha">
          </div>
        </div><br>

        <div class="row">
          <div class="col-xs-4">
             <label style="margin-top: 7px;">Nota: </label>
          </div>
          <div class="col-xs-8">
            <textarea placeholder="Orden de trabajo" class="form-control" rows="10" id="vsdetalleedit" name="vsdetalleedit" value=""></textarea>
          </div>
        </div>
        <br>
        <div class="row">
          <div class="col-xs-4">
              <label style="margin-top: 7px;">Sucursal <strong style="color: #dd4b39">*</strong>: </label>
          </div>
          <div class="col-xs-8">
            <select class="form-control select2" id="sucidedit" name="sucidedit" style="width: 100%;">

            </select>
          </div>
        </div>
        <br>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal" onclick="cerro()">Cancelar</button>
          <button type="button" class="btn btn-primary" id="reset" data-dismiss="modal" onclick="guardareditar()">Guardar</button>
        </div>  <!-- /.modal footer -->
      </div>
    </div>  <!-- /.modal-body -->
  </div> <!-- /.modal-content -->
</div>  <!-- /.modal-dialog modal-lg -->
</div>  <!-- /.modal fade -->
<!-- / Modal -->

<!-- Modal Pedido-->
<div class="modal fade" id="modalpedido" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-lg" role="document" style="width: 45%">
    <div class="modal-content">

      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title"  id="myModalLabel"><span id="modalAction" class="fa fa-tags" style="color: #3c8dbc" > </span> Orden de Pedido</h4>
       </div> <!-- /.modal-header  -->

      <div class="modal-body input-group ui-widget" id="modalBodyArticle">

        <div class="row" >
          <div class="col-sm-12 col-md-12">
            <fieldset> </fieldset>
            <br>
            <div class="col-xs-8">Nro:
              <input type="text"  id="num1" name="num1" placeholder="Ingrese nro de orden de pedido.." size= "36">
              <!--align=\"right\" -->
            </div>
            <div class="col-xs-8">Fecha:
              <input type="text"   class=" datepicker" id="fecha1"  name="fecha1" size= "36"/>
            </div>
            <div class="col-xs-8">Fecha de Entrega:
              <input type="text"  class=" datepicker"   id="fecha_entrega2" name="fecha_entrega2" size= "36" />
            </div>
            <div class="col-xs-8">Proveedor:
              <select type="text"  class="form-control"  id="proveedor" name="proveedor"  value="" ></select>
              <input type="hidden" id="id_proveedor" name="id_proveedor">
            </div>

            <div class="col-xs-8">Detalle del pedido:
            </div>
            <div class="col-xs-12">
              <textarea  class="form-control input-md" rows="6" cols="500" id="descripcion2" name="descripcion2" value="" placeholder="Ingrese detalle del pedido..."></textarea>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal" onclick="cerro()">Cancelar</button>
          <button type="button" class="btn btn-primary" id="btnSave" data-dismiss="modal" onclick="guardarpedido()" >Guardar</button>
        </div>  <!-- /.modal footer -->
      </div>  <!-- /.modal-body -->
    </div> <!-- /.modal-content -->
  </div>  <!-- /.modal-dialog modal-lg -->
</div>  <!-- /.modal fade -->
<!-- / Modal -->


<!-- Modal mostrar pedido-->
<div class="modal fade" id="modallista" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-lg" role="document" style="width: 70%">
    <div class="modal-content">

      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title"  id="myModalLabel"><span id="modalAction" class="fa fa-truck" style="color: #3c8dbc" > </span> Lista de Orden de Pedido</h4>
       </div> <!-- /.modal-header  -->

      <div class="modal-body input-group ui-widget" id="modalBodyArticle">

        <div class="row" >
          <div class="col-sm-12 col-md-12">
            <fieldset> </fieldset>
            <br>
            <table class="table table-bordered table-hover" id="tabladetalle">
              <thead>
                <tr>
                  <th width="10%"></th>
                  <th>Nro de orden</th>
                  <th>Fecha</th>
                  <th>Fecha de Entrega</th>
                  <th>Proveedor</th>
                  <th>Descripcion</th>
                  <th>Estado</th>

                </tr>
              </thead>
              <tbody>
              </tbody>
            </table>
          </div>
        </div>
      </div>  <!-- /.modal-body -->
    </div> <!-- /.modal-content -->
  </div>  <!-- /.modal-dialog modal-lg -->
</div>  <!-- /.modal fade -->
<!-- / Modal -->

<!-- Modal agregar-->
<div class="modal fade" id="modalagregar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-lg" role="document" style="width: 40%">
    <div class="modal-content">

      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title"  id="myModalLabel"><span id="modalAction" class="fa fa-plus-square" style="color: #008000"  > </span> Orden de Trabajo</h4>
       </div> <!-- /.modal-header  -->

      <div class="modal-body input-group ui-widget" id="modalBodyArticle">

        <div class="row">
          <div class="col-xs-4">
           <label style="margin-top: 7px;">Nro <strong style="color: #dd4b39">*</strong>: </label>
          </div>
          <div class="col-xs-8">
            <input type="text" class="form-control"  id="nro1" name="nro1" placeholder="Ingrese Numero de OT">
          </div>
        </div><br>
        <div class="row">
          <div class="col-xs-4">
            <label style="margin-top: 7px;">Cliente <strong style="color: #dd4b39">*</strong>: </label>
          </div>
          <div class="col-xs-8">
            <select class="form-control " id="cli" name="cli" style="width: 100%;">

            </select>
          </div>
        </div><br>

        <div class="row">
          <div class="col-xs-4">
              <label style="margin-top: 7px;">Fecha <strong style="color: #dd4b39">*</strong>: </label>
          </div>
          <div class="col-xs-8">
               <input type="text" class="form-control" id="vfech" name="vfech" value="<?php echo date_format(date_create(date("Y-m-d ")), 'd-m-Y') ; ?>"  disabled/>
               <input type="hidden" class="form-control" id="vfechi" name="vfechi" value="<?php echo date('Y-m-d H:i:s') ; ?>"  disabled/>
          </div>
        </div><br>

        <div class="row">
          <div class="col-xs-4">
             <label style="margin-top: 7px;">Nota: </label>
          </div>
          <div class="col-xs-8">
            <textarea placeholder="Orden de trabajo" class="form-control" rows="10" id="vsdetal" name="vsdetal" value=""></textarea>
          </div>
        </div>
        <br>
        <div class="row">
          <div class="col-xs-4">
              <label style="margin-top: 7px;">Sucursal <strong style="color: #dd4b39">*</strong>: </label>
          </div>
          <div class="col-xs-8">
            <select class="form-control select2" id="suci" name="suci" style="width: 100%;">

            </select>
          </div>
        </div>
        <br>
        <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal" onclick="cerro()">Cancelar</button>
          <button type="button" class="btn btn-primary" id="reset" data-dismiss="modal" onclick="guardaragregar()">Guardar</button>

        </div>  <!-- /.modal footer -->
      </div>  <!-- /.modal-body -->
    </div> <!-- /.modal-content -->
  </div>  <!-- /.modal-dialog modal-lg -->
</div>  <!-- /.modal fade -->
<!-- / Modal -->

<!-- Modal FINALIZAR-->
<div class="modal fade" id="modalfinalizar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-lg" role="document" style="width: 35%">
    <div class="modal-content">

      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title"  id="myModalLabel"><span id="modalAction" class="fa fa-fw fa fa-toggle-on" style="color: #3c8dbc" > </span> Finalización </h4>
       </div> <!-- /.modal-header  -->

      <div class="modal-body input-group ui-widget" id="modalBodyArticle">

        <div class="row" >
          <div class="col-sm-12 col-md-12">


            <div class="col-sm-12 ">Elija la opción de finalización de orden:
            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal" onclick="guardarparcial()"> PARCIAL</button>
              <button type="button" class="btn btn-primary" id="btnSave" data-dismiss="modal" onclick="guardartotal()" >TOTAL</button>
            </div>  <!-- /.modal footer -->
           </div>

          </div>
        </div>
      </div>  <!-- /.modal-body -->
    </div> <!-- /.modal-content -->
  </div>  <!-- /.modal-dialog modal-lg -->
</div>  <!-- /.modal fade -->
<!-- / Modal -->