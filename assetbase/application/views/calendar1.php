<section class="content">
    <style>
      input.prevent{border: none; padding-left: 5px; width: 100%;}
    </style>

    <div class="row">

        <div class="col-md-8">
            <div class="box box-primary">
                <div class="box-body">

                    <!-- THE CALENDAR -->
                    <div id="calendar"></div>
                </div><!-- /.box-body -->
            </div><!-- /. box -->




        </div><!-- /.col -->

      <div class="col-md-4">


              <div class="box box-primary">
                <div class="box-header">
                  <h3 class="box-title">Tareas Correctivo</h3>
                </div>

                <div class="box-body">

                    <table id="sales" class="table table-bordered table-hover">
                      <thead>
                        <tr>
                          <th style="text-align: center">Codigo</th>
                          <th style="text-align: center">Descripcion</th>
                          <th style="text-align: center">sector</th>
                          <th style="text-align: center">Tipo</th>
                          
                                                  </tr>
                      </thead>
                      <tbody>
                        <?php
                         if( count($list4) > 0) {

                          foreach( $list4 as $c ) {
                            // curso, critico, vencido
                            $estado = 'bg-gray';
                            if( $c['estadoprev'] == 'C'  ) { $estado = 'bg-green'; }
                            if( $c['estadoprev'] == 'CR' ) { $estado = 'bg-orange'; }
                            if( $c['estadoprev'] == 'VE' ) { $estado = 'bg-red'; }

                            echo "<tr>";
                            echo "<td style='text-align: center'>".$c['codigo']."</td>";
                            echo "<td style='text-align: center'>".$c['codigo']."</td>";
                            echo "<td style='text-align: center'>".$c['codigo']."</td>";
                            echo "<td style='text-align: center'>".$c['causa']."</td>";
                            
                            echo "</tr>";
                          }
                        }
                        ?>
                      </tbody>
                    </table>
                </div><!-- /.box-body -->
            </div><!-- /. box -->
        </div><!-- /.col -->   

        <div class="col-md-4">


              <div class="box box-primary">
                <div class="box-header">
                  <h3 class="box-title">Tareas Preventivo</h3>
                </div>

                <div class="box-body">

                    <table id="sales" class="table table-bordered table-hover">
                      <thead>
                        <tr>
                          <th style="text-align: center">Equipo</th>
                          <th style="text-align: center">Tarea</th>
                          <th style="text-align: center">Fecha</th>
                          <th style="text-align: center">Horas h</th>
                          
                                                  </tr>
                      </thead>
                      <tbody>
                        <?php
                        if( count($list3) > 0) {

                          foreach( $list3 as $p ) {
                            // curso, critico, vencido
                            $estado = 'bg-gray';
                            if( $p['estadoprev'] == 'C'  ) { $estado = 'bg-green'; }
                            if( $p['estadoprev'] == 'CR' ) { $estado = 'bg-orange'; }
                            if( $p['estadoprev'] == 'VE' ) { $estado = 'bg-red'; }

                            echo "<tr>";
                            echo "<td style='text-align: center'>".$p['codigo']."</td>";
                            echo "<td style='text-align: center'>".$p['descripcion']."</td>";
                            echo "<td style='text-align: center'>".$p['prox']."</td>";
                            echo "<td style='text-align: center'>".$p['horash']."</td>";
                                        echo "</tr>";
                          }
                        }
                        ?>
                      </tbody>
                    </table>
                </div><!-- /.box-body -->
            </div><!-- /. box -->
        </div><!-- /.col --> 

        <div class="col-md-4">


              <div class="box box-primary">
                <div class="box-header">
                  <h3 class="box-title">Tareas Preventivo x hora</h3>
                </div>

                <div class="box-body">

                    <table id="sales" class="table table-bordered table-hover">
                      <thead>
                        <tr>
                          <th style="text-align: center">Codigo</th>
                          <th style="text-align: center">Descripcion</th>
                          <th style="text-align: center">sector</th>
                          <th style="text-align: center">Tipo</th>
                          
                                                  </tr>
                      </thead>
                      <tbody>
                        <?php
                        if( count($list['data']) > 0) {
                          foreach( $list['data'] as $a ) {
                            // curso, critico, vencido
                            $estado = 'bg-gray';
                            if( $a['estadoprev'] == 'C'  ) { $estado = 'bg-green'; }
                            if( $a['estadoprev'] == 'CR' ) { $estado = 'bg-orange'; }
                            if( $a['estadoprev'] == 'VE' ) { $estado = 'bg-red'; }

                            echo "<tr>";
                            echo "<td style='text-align: center'>".$a['codigo']."</td>";
                            echo "<td style='text-align: center'>".$a['descripcion']."</td>";
                            echo "<td style='text-align: center'>".$a['descripSector']."</td>";
                            echo "<td style='text-align: center'>".$a['perido']."</td>";
                            
                            echo "</tr>";
                          }
                        }
                        ?>
                      </tbody>
                    </table>
                </div><!-- /.box-body -->
            </div><!-- /. box -->
        </div><!-- /.col --> 
<div class="col-md-4">


              <div class="box box-primary">
                <div class="box-header">
                  <h3 class="box-title">Tareas Backlog</h3>
                </div>

                <div class="box-body">

                    <table id="sales" class="table table-bordered table-hover">
                      <thead>
                        <tr>
                          <th style="text-align: center">Id</th>
                          <th style="text-align: center">Descripcion</th>
                          <th style="text-align: center">Equipo</th>
                          <th style="text-align: center">Fecha</th>
                          
                                                  </tr>
                      </thead>
                      <tbody>
                        <?php
                        if( count($list2) > 0) {

                          foreach( $list2 as $b ) {

                            // curso, critico, vencido
                            $estado = 'bg-gray';
                            if( $b['estado'] == 'C'  ) { $estado = 'bg-green'; }
                            if( $b['estado'] == 'CR' ) { $estado = 'bg-orange'; }
                            if( $b['estado'] == 'VE' ) { $estado = 'bg-red'; }

                            echo "<tr>";
                            echo "<td style='text-align: center'>".$b['backId']."</td>";
                            echo "<td style='text-align: center'>".$b['tarea_descrip']."</td>";
                            echo "<td style='text-align: center'>".$b['codigo']."</td>";
                            echo "<td style='text-align: center'>".$b['fecha']."</td>";
                            
                            echo "</tr>";
                          }
                        }
                        ?>
                      </tbody>
                    </table>
                </div><!-- /.box-body -->
            </div><!-- /. box -->
        </div><!-- /.col --> 
        
<div class="col-md-4">


              <div class="box box-primary">
                <div class="box-header">
                  <h3 class="box-title">Tareas Predictivo</h3>
                </div>

                <div class="box-body">

                    <table id="sales" class="table table-bordered table-hover">
                      <thead>
                        <tr>
                          <th style="text-align: center">Codigo</th>
                          <th style="text-align: center">Descripcion</th>
                          <th style="text-align: center">sector</th>
                          <th style="text-align: center">Tipo</th>
                          
                                                  </tr>
                      </thead>
                      <tbody>
                        <?php
                        
                        if( count($list1) > 0) {
                          foreach( $list1 as $p ) {

                            // curso, critico, vencido
                            $estado = 'bg-gray';
                            if( $a['estado'] == 'C'  ) { $estado = 'bg-green'; }
                            if( $a['estado'] == 'CR' ) { $estado = 'bg-orange'; }
                            if( $a['estado'] == 'VE' ) { $estado = 'bg-red'; }

                            echo "<tr>";
                            echo "<td style='text-align: center'>".$p['id_equipo']."</td>";
                            echo "<td style='text-align: center'>".$p['id_equipo']."</td>";
                            echo "<td style='text-align: center'>".$p['id_equipo']."</td>";
                            echo "<td style='text-align: center'>".$p['id_equipo']."</td>";
                            
                            echo "</tr>";
                          }
                        }
                        ?>
                      </tbody>
                    </table>
                </div><!-- /.box-body -->
            </div><!-- /. box -->
        </div><!-- /.col --> 

    </div><!-- /.row -->
</section><!-- /.content -->

<script>

$(function () {

  $('#btnAdd').click(function() {
      //Cargar clientes
      //Elegir fecha y hora(de mañana para adelante )
      //Registrar visita
      LoadIconAction('modalAction','Program');
      WaitingOpen('Cargando Clientes');
      $.ajax({
          type: 'POST',
          data: null,
          url: 'index.php/dash/getCustommers',
          success: function(result){
              WaitingClose();
              $("#modalBodyProgrammer").html(result.html);
              $('#vstFecha').datepicker({minDate: '0'});
              setTimeout("$('#modalProgrammer').modal('show');",800);
              $(".select2").select2();
          },
          error: function(result){
              WaitingClose();
              alert("error");
          },
          dataType: 'json'
      });
  });

  

 
  /* initialize the external events
   -----------------------------------------------------------------*/
  function ini_events(ele) {
    ele.each(function () {
      // create an Event Object (http://arshaw.com/fullcalendar/docs/event_data/Event_Object/)
      // it doesn't need to have a start or end
      var eventObject = {
        title: $.trim($(this).text()) // use the element's text as the event title
      };

      // store the Event Object in the DOM element so we can get to it later
      $(this).data('eventObject', eventObject);

      // make the event draggable using jQuery UI
      $(this).draggable({
        zIndex: 1070,
        revert: true, // will cause the event to go back to its
        revertDuration: 0  //  original position after the drag
      });

    });
  }
  ini_events($('#external-events div.external-event'));

  /* initialize the calendar
   -----------------------------------------------------------------*/
  //Date for the calendar events (dummy data)
  var date = new Date();
  var d = date.getDate(),
      m = date.getMonth(),
      y = date.getFullYear();

  $('#calendar').fullCalendar({
    header: {
      left  : 'prev,next today',
      center: 'title',
      right : 'month,agendaWeek,agendaDay'
    },
    buttonText: {
      today: 'Hoy',
      month: 'Mes',
      week : 'Semana',
      day  : 'Día'
    },
    // desde aca busca los preventivos
    events: function(start, end, timezone, callback) {
      WaitingOpen('Cargando trabajo');
      var date_ = new Date($("#calendar").fullCalendar('getDate'));
      var month_ = date_.getMonth();
      var evento = $.ajax({
        url: 'index.php/Calendario/getcalendarot',
        data: { month: month_ },
        dataType: 'json',
        type: 'POST',
        success: function(doc) {
          var events = [];

          $(doc).each(function() {

            var from = $(this).attr('fecha_entrega'); //ultimo preventivo hecho
            var to = new Date(from);
            var hoy = new Date();
            var mes_actual = hoy.getMonth();

            console.log('dia de hoy por sistema');
            console.log(hoy);
            
            events.push({
              // title: $(this).attr('descripcion') + ',' + $(this).attr('id_tarea'),
              start:to,
              title: $(this).attr('descripcion'),
              codigo:$(this).attr('nro'),
              //id: $(this).attr('id_equipo'),
              //id_ot: $(this).attr('id_tarea'),
              allDay: false,
              backgroundColor: 'green',
              
            });
          });
          callback(events);
            WaitingClose();
          },
          error: function(doc) {
            WaitingClose();
            alert('Sin datos para este mes')
            //alert("Error en ajax calendario:" + doc);
          }
        });
      },

      eventClick: function(event) {
        // console.log('eventossss');
        // console.log(evento);

        console.log('Titulo:');
        console.log(event.title);
        //setTimeout("$('#modalPrevent').modal('show')",0);
        $('#title').remove();
        $('#codigo_equipo').remove();
        $('#modal_prev tbody').append(

          '<tr>'+
               '<td class="tit"><input type="text" class="title prevent" id="title" value=" '+ event.title +' " placeholder=""></td>'+
               '<td class="cod" id="cod"><input type="text" class="codigo_equipo prevent" id="codigo_equipo" value=" '+ event.codigo +' " placeholder=""></td>'+

               '<td class="id_equipo hidden" id="id_equipo"><input type="text" class="equip prevent" id="equip" name="equip" value="'+ event.id +'" placeholder=""></td>'+

               '<td class="solicitante hidden" id="solicitante"><input type="text" class="solici" id="solici" name="solici"value="Preventivo" placeholder=""></td>'+

               '<td class="fallas hidden" id="fallas"><input type="text" class="falla" id="falla" name="falla" value="Preventivo" placeholder=""></td>'+

               '<td class="fech hidden" id="fech"><input type="text" class="fecha" id="fecha" name="fecha" value="01-02-17" placeholder=""></td>'+

               '<td class="hor hidden" id="hor"><input type="text" class="hora" id="hora" name="hora" value="00" placeholder=""></td>'+
               '<td class="minutos hidden" id="minutos"><input type="text" class="min" id="min" name="min" value="00" placeholder=""></td>'+
          '</tr>'
          );

        $('#modalPrevent').modal('show');

      },

      editable: true,
      droppable: true, // this allows things to be dropped onto the calendar !!!
      drop: function (date, allDay) { // this function is called when something is dropped
        // retrieve the dropped element's stored Event Object
        var originalEventObject = $(this).data('eventObject');

        // we need to copy it, so that multiple events don't have a reference to the same object
        var copiedEventObject = $.extend({}, originalEventObject);

        // assign it the date that was reported
        copiedEventObject.start = date;
        copiedEventObject.allDay = allDay;
        copiedEventObject.backgroundColor = $(this).css("background-color");
        copiedEventObject.borderColor = $(this).css("border-color");

        // render the event on the calendar
        // the last `true` argument determines if the event "sticks" (http://arshaw.com/fullcalendar/docs/event_rendering/renderEvent/)
        $('#calendar').fullCalendar('renderEvent', copiedEventObject, true);

        // is the "remove after drop" checkbox checked?
        if ($('#drop-remove').is(':checked')) {
          // if so, remove the element from the "Draggable Events" list
          $(this).remove();
        }
      }
    });

    /* ADDING EVENTS */
    var currColor = "#3c8dbc"; //Red by default
    //Color chooser button
    var colorChooser = $("#color-chooser-btn");
    $("#color-chooser > li > a").click(function (e) {
      e.preventDefault();
      //Save color
      currColor = $(this).css("color");
      //Add color effect to button
      $('#add-new-event').css({"background-color": currColor, "border-color": currColor});
    });
    $("#add-new-event").click(function (e) {
      e.preventDefault();
      //Get value and make sure it is not null
      var val = $("#new-event").val();
      if (val.length == 0) {
        return;
      }

      //Create events
      var event = $("<div />");
      event.css({"background-color": currColor, "border-color": currColor, "color": "#fff"}).addClass("external-event");
      event.html(val);
      $('#external-events').prepend(event);

      //Add draggable funtionality
      ini_events(event);

      //Remove event from text input
      $("#new-event").val("");
    });
  });




</script>
<!-- Guardado de datos y validaciones -->




<!-- Modal -->
<div class="modal fade bs-example-modal-lg" id="modalPrevent" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
        <h4 class="modal-title"><span id="modalAction_2">Mantenimiento Preventivo</span></h4>
      </div>
      <div class="modal-body" id="modalPrev">
        <table class="table table-condensed table-responsive modal_prev" id="modal_prev">
            <thead>
              <tr>
                <th>Tarea</th>
                <th>Equipo</th>
                <!-- <th>Depósitos</th> -->
              </tr>
            </thead>
            <tbody>

            </tbody>
        </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
        <button type="button" class="btn btn-primary" data-dismiss="modal" id="btnSave">Generar Solicitud</button>
      </div>
    </div>
  </div>
</div>
