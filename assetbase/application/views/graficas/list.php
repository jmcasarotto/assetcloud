<section class="content">
    <div class="row">
        <div class="col-xs-12">

            <div class="box box-primary">

                <div class="box-header with-border">
                    <h3 class="box-title">Gráfica de parámetros de Equipos</h3>
                </div><!-- /.box-header -->

                <div class="box-body">
                    <div class="chart">
                        <div class="col-xs-12">
                            <div class="row">
                                <div class="col-xs-12 col-md-6">
                                    <div class="form-group">
                                        <label>Seleccione el equipo: </label>
                                        <input type="hidden" id="id_equipo" name="id_equipo">
                                        <select class="form-control input-medium" id="equipo" name="equipo" >
                                            <!--
                                            -->
                                        </select>
                                    </div>
                                </div>

                                <div class="col-xs-12 col-md-6">
                                    <div class="form-group parametro-equipo" style="display:none">
                                        <label>Seleccione el parámetro: </label>
                                        <select class="form-control input-medium" id="parametro_equipo" name="parametro_equipo" style="display:none">
                                            <!--
                                            -->
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row" style="display:none">
                                <div class="col-xs-4 col-md-4">
                                    <div class="form-group">
                                        <label>Fecha Inicial: </label>
                                        <input type="date" class="form-control input">
                                    </div>
                                </div>
                                <div class="col-xs-4 col-md-4">
                                    <div class="form-group">
                                        <label>Fecha Final: </label>
                                        <input type="date" class="form-control input">
                                    </div>
                                </div>
                                <div class="col-xs-4 col-md-4">
                                    <div class="form-group">
                                        <label>Nro lecturas: </label>
                                        <select class="form-control input-medium" id="nroMuestras" name="nroMuestras">
                                            <option value="14" title="14">14</option><!--
                                            -->
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-12">
                            <center style="display:none">
                                <button type="button" class="btn btn-default active" id="barchart"><i class="fa fa-bar-chart"></i></button>
                                <button type="button" class="btn btn-default" id="linechart"><i class="fa fa-line-chart"></i></button>
                            </center>
                        </div>

                        <div class="col-xs-12">
                            <div id="graph-container">
                                <canvas id="miGrafico" style="height: 66vh; width: 100%;"></canvas>
                            </div>
                        </div>

                    </div>
                </div><!-- /.box-body -->

            </div><!-- /.box -->
        </div><!-- /.col -->
    </div><!-- /.row -->
</section>

<script>
    var tipoGrafico = "bar"; //tipo de grafico de barras
    var info        = "";    // informacion de equipos y parametros a graficar
    var equipo      = "";

    $(document).ready( function(event) {
        traerEquipos();
    });



    /* trae parametros al seleccionar el equipo */
    $("#equipo").on("change", function() {
        equipo = $(this).val();
        //console.info( 'Equipo: '+equipo );
        $("#parametro_equipo, .parametro-equipo").show();
        traerParametros( equipo );
    });

    /* trae valores al seleccionar parametros */
    $("#parametro_equipo").on("change", function() {
        var parametro = $(this).val();
        console.info( 'Equipo: '+equipo );
        console.info( 'Parametro: '+parametro );
        traerValoresParametro( equipo, parametro );
    });

    /* cambia grafico a grafico de barras */
    $("#barchart").on("click", function() {
        console.log("click en barchar");
        tipoGrafico = "bar";
        $("#linechart").toggleClass('active');
        $("#barchart").toggleClass('active');
        graficarParametro( info );
    });

    /* cambia grafico a grafico de líneas */
    $("#linechart").on("click", function() {
        console.log("click en linechar");
        tipoGrafico = "line";
        $("#linechart").toggleClass('active');
        $("#barchart").toggleClass('active');
        graficarParametro( info );
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

                var opcion  = "<option value='-1'>Seleccione el equipo...</option>";
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

    /* trae los parametros de un determinado equipo */
    function traerParametros( equipo ) {
        $.ajax({
            type: 'POST',
            data: {equipo},
            dataType: 'json',
            url: 'index.php/Grafica/getParametros',
            success: function(result){
                //console.info("trae los parámetros correctamente, del equipo seleccionado: "+result);
                var opcion  = "<option value='-1'>Seleccione el parámetro...</option>";
                $('#parametro_equipo').empty();
                $('#parametro_equipo').append(opcion);
                for(var i=0; i < result.length ; i++)
                {
                    var nombre = result[i]['paramdescrip'];
                    var opcion  = "<option value='"+result[i]['paramId']+"'>" +nombre+ "</option>" ;

                    $('#parametro_equipo').append(opcion);
                }
            },
            error: function(result){
                //alert(result);
                console.error("problemas al llenar el segundo select: " + result);
            },
        });
    }

    /* trae los valores del parametro especificado */
    function traerValoresParametro( equipo, parametro ) {
        var valor = [];
        var fecha = [];
        var parametr = [];
        var max = [];
        var min = [];
        console.log( "equipo: "+equipo+" - parametro: "+parametro);
        $.ajax({
            type: 'POST',
            data: { equipo, parametro },
            dataType: 'json',
            url: 'index.php/Grafica/getValoresParametro',
            success: function(result){
                console.info("trae los valores correctamente, del parametro seleccionado: "+result);
                console.log('valor'+i+': '+result.length);
                for(var i=0; i < result.length ; i++)
                {
                    valor[i] = result[i]['valor'];
                    fecha[i] = result[i]['fechahora'];
                    parametr[i] = result[i]['paramdescrip'];
                    max[i] = parseInt( result[i]['maximo'] );
                    min[i] = parseInt( result[i]['minimo'] );
                    //console.log('valor'+i+': '+result[i]['valor']+' - ');
                }

                info = { 'fecha':fecha, 'valor':valor, 'max':max[0], 'min':min[0], 'parametr':parametr[0] };

                graficarParametro( info );
            },
            error: function(result){
                //alert(result);
                console.error("problemas al traer los valores del parametro: " + result);
            },
        });
    }

    /* grafico usando charjs 2.5 */
    function graficarParametro( info ) {
        //muestro los botones para cambiar grafico
        $('#barchart').parent().show('400');

        //elimino el canvas, por si hay un grafico preexistente. Para que no haya conflicto entre graficos. Y lo vuelvo a crear.
        $('#miGrafico').remove();
        $('#graph-container').append('<canvas id="miGrafico" style="height: 66vh; width: 100%;"></canvas>');

        //guardo el canvas para trabajar con él
        var areaChartCanvas = document.getElementById("miGrafico");

        //si es grafico de barras cambio color cdo esta fuera de rango
        if( tipoGrafico == "bar") {
            var backgroundColors = cambiarColorFueraDeRango(info.valor, info.min, info.max, 'rgba(255, 0, 0, 0.85)', 'rgba(60, 141, 188, 1)');
        } else {
            var backgroundColors = 'rgba(60, 141, 188, 1)';
        }

        //guardo la configuracion del grafico
        var config = {
            type: tipoGrafico,
            data: {
                labels: info.fecha,
                datasets: [
                    {
                        backgroundColor: backgroundColors,
                        data: info.valor,
                        fill: false,
                        label: info.parametr,
                        lineTension: 0.2,
                        pointRadius: 2,
                        pointHitRadius: 10,
                        spanGaps: false,
                    }
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero:false,
                        }
                    }]
                }
            }
        }

        //creo el grafico  en areaChartCanvas con la configuracion config
        var myChart = new Chart(areaChartCanvas, config);
    }

    /* cambia de color cdo los valores estan fuera de rango */
    function cambiarColorFueraDeRango(valor, min, max, colorAlerta, colorNormal) {
        var color = [];
        for(var i = 0; i < valor.length; i++) {
            if( (valor[i] > min) && (valor[i] < max) ) {
                color.push(colorNormal);
            } else {
                color.push(colorAlerta);
            }
        }
        return color;
    }
</script>